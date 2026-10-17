<script setup>
    import { ref, watch, onMounted, onUnmounted, computed, nextTick, reactive } from 'vue';
    import { useSharedStore } from '../useSharedStore';
    import IconMaximizer from '@/Components/vristo/icon/icon-maximizer.vue';
    import IconMinimizer from '@/Components/vristo/icon/icon-minimizer.vue';
    import IconX from '@/Components/vristo/icon/icon-x.vue';
    import IconSend from '@/Components/vristo/icon/icon-send.vue';
    import IconPencil from '@/Components/vristo/icon/icon-pencil.vue';
    import AudioPlayer from '@/Components/AudioPlayer.vue';
    import { usePage, router, Link } from '@inertiajs/vue3';
    import FileDownload from '../Pages/Chat/Partials/FileDownload.vue';
    import Swal from 'sweetalert2';

    // Instancia del store
    const appCodeUnique = import.meta.env.VITE_APP_CODE ?? 'ARACODE';
    const channelListenChat = "message-notification-" + appCodeUnique;

    const storeChatBox = useSharedStore();

      const privateChat = ref({
        conversation: null,
        full_name: null,
        avatar: null,
        loading: false,
        messages: []
    });

    const privateChatText = ref(null);
    const authUser = usePage().props.auth.user;
    const xasset = assetUrl;
    const isShowLoadingSend = ref(false);

    // Edicion del propio mensaje dentro de los primeros SEGUNDOS_EDICION
    // segundos: el boton aparece al pasar el mouse y el backend vuelve a
    // validar la ventana antes de guardar.
    const SEGUNDOS_EDICION = 90;
    // Holgura del viaje de la peticion: la interfaz deja de ofrecer la edicion
    // un par de segundos antes de que venza la ventana del servidor, para que
    // un clic "a ultimo segundo" no caiga fuera de los 90 segundos al llegar.
    const SEGUNDOS_MARGEN = 3;
    const hoverId = ref(null);
    const editState = reactive({ id: null, texto: '', procesando: false, error: null });

    const canEditMessage = (message) => {
        if (!message || !message.id || message.type !== 'text') return false;
        if (authUser.person_id != message.person_id) return false;
        const creado = new Date(message.created_at);
        if (isNaN(creado.getTime())) return false;
        return Date.now() - creado.getTime() < (SEGUNDOS_EDICION - SEGUNDOS_MARGEN) * 1000;
    };

    const startEditMessage = (message) => {
        if (!canEditMessage(message)) {
            showMessage(`Solo puedes editar tus mensajes durante los primeros ${SEGUNDOS_EDICION} segundos.`, 'info');
            return;
        }
        editState.id = message.id;
        editState.texto = message.text ?? '';
        editState.error = null;
        editState.procesando = false;
    };

    const cancelEditMessage = () => {
        editState.id = null;
        editState.texto = '';
        editState.error = null;
        editState.procesando = false;
    };

    const saveEditMessage = (message) => {
        // Un Enter repetido no debe disparar varias peticiones a la vez.
        if (editState.procesando) return;

        const texto = editState.texto.trim();

        if (!texto) {
            editState.error = 'El mensaje no puede quedar vacío.';
            return;
        }

        if (!canEditMessage(message)) {
            showMessage(`Solo puedes editar tus mensajes durante los primeros ${SEGUNDOS_EDICION} segundos.`, 'info');
            cancelEditMessage();
            return;
        }

        editState.procesando = true;
        editState.error = null;

        axios.post(route('crm_chat_message_update'), {
            message_id: message.id,
            text: texto,
        }).then(({ data }) => {
            if (data.success) {
                message.text = data.message.content;
                message.edited = true;
                showMessage('Mensaje actualizado.', 'success');
                cancelEditMessage();
            } else {
                editState.error = data.message || 'No se pudo editar el mensaje.';
            }
        }).catch((error) => {
            // Separamos tres casos: el servidor respondio y lo rechazo (mostramos
            // su mensaje), no llego respuesta (timeout/red) y errores de la propia
            // interfaz, para no pintar nunca el mismo aviso genérico.
            if (!error.isAxiosError) {
                editState.error = 'No se pudo actualizar la vista: ' + (error.message || 'error inesperado en la interfaz.');
            } else if (error.response) {
                editState.error = error.response.data?.message || `No se pudo editar el mensaje (código ${error.response.status}).`;
            } else {
                editState.error = 'No hubo respuesta del servidor. Revisa tu conexión e inténtalo de nuevo.';
            }
        }).finally(() => {
            editState.procesando = false;
        });
    };

    const getImage = (path) => {
        return xasset + 'storage/'+ path;
    }

    const hideChatBox = () => {
        storeChatBox.toggleChatBoxVisibility();
        storeChatBox.updateChatBox(null);
        privateChat.value.loading = false;
        privateChat.value.conversation = null;
        privateChat.value.messages = [];
    }

    watch(() => storeChatBox.notification, (newValue) => {
        if(newValue && privateChat.value.conversation !== newValue.id){
            privateChat.value.conversation = newValue.id;
            privateChat.value.person_id = newValue.person_id;
            privateChat.value.full_name = newValue.full_name;
            privateChat.value.avatar = newValue.image;
            privateChat.value.email = newValue.email;
        }
    });

    watch(() => privateChat.value.conversation, () => {
        getMessagesChat();
    });


    const getMessagesChat = () => {
        privateChat.value.loading = true;
        let myDiv = document.getElementById('header-total-news');

        // Verifica si el div existe
        if (myDiv) {
            myDiv.style.display = 'none'; // Oculta el div
        }
        try {
            axios.post(route('crm_list_message'),{
                conversationId: privateChat.value.conversation,
                personId: privateChat.value.person_id
            }).then((response) => {
                return response.data;
            }).then((res) => {
                privateChat.value.messages = res;

                privateChat.value.loading = false;
                return true;
            }).then(() => {
                scrollToBottomChatBox();
            });
        } catch (error) {
            console.log(error);
            privateChat.value.loading = false;
        }
    }

    const scrollToBottomChatBox = () => {
        const chatbox = document.getElementById('crm-chatbox-list');
        if (!privateChat.value.loading && chatbox) {
            setTimeout(() => {
                chatbox.scrollTop = chatbox.scrollHeight;
            });
        }
    };

    const sendMessageChatBox = () => {
        if (privateChatText.value.trim()) {
            isShowLoadingSend.value = true;
            const msg = {
                fromUserId: privateChat.value.person_id,
                toUserId: 0,
                text: privateChatText.value,
                time: 'En este momento',
                type: 'text',
                person_id: authUser.person_id,
                id: null,
                // Fecha real de envio: habilita el boton Editar durante 90 s.
                created_at: new Date().toISOString()
            };
            axios.post(route('crm_send_message'),msg).then((response) => {
                return response.data;
            }).then((res) => {
                if(res.success){
                    // El id real permite reconocer el eco que llega por socket y no
                    // pintar el mismo mensaje dos veces (en cualquier orden de llegada).
                    msg.id = res.message?.id ?? null;
                    const mensajes = privateChat.value.messages ?? (privateChat.value.messages = []);
                    const porId = mensajes.find(m => m.id != null && String(m.id) === String(msg.id));
                    // Si el eco se adelantó sin id, se completa ese mensaje en pantalla
                    // (con su id real) en vez de agregar un duplicado.
                    const sinId = porId ?? mensajes.find(m => m.id == null && m.text === msg.text && m.type === msg.type);

                    if (sinId) {
                        sinId.id = msg.id;
                        sinId.person_id = msg.person_id ?? sinId.person_id;
                    } else {
                        mensajes.push(msg);
                    }
                    privateChatText.value = '';
                    scrollToBottomChatBox();
                }else{
                    showMessage('No puede enviar mensajes en este momento. Por favor, complete su información personal en su perfil para habilitar esta función.','info');
                }
                isShowLoadingSend.value = false;
            });
        }
    };

    const showMessage = (msg = '', type = 'success') => {
        const toast = Swal.mixin({
            toast: true,
            position: 'top',
            showConfirmButton: false,
            timer: 3000,
            customClass: { container: 'toast' },
        });
        toast.fire({
            icon: type,
            title: msg,
            padding: '10px 20px',
        });
    };

    onMounted(() => {
        window.socketIo.on(channelListenChat, (result) => {
            let participants = result.data.participants;
            let conversationId = result.data.message.conversation_id;

            // Eco de un mensaje editado por su autor: se actualiza el texto en
            // pantalla (y se marca "Editado") sin pintar un mensaje nuevo.
            if (result.data.message.is_edition) {
                const abierto = privateChat.value
                    && String(conversationId) === String(privateChat.value.conversation);
                if (abierto) {
                    const mensajes = privateChat.value.messages ?? (privateChat.value.messages = []);
                    const existente = mensajes.find(m => m.id != null && String(m.id) === String(result.data.message.id));
                    if (existente) {
                        existente.text = result.data.message.content;
                        existente.edited = true;
                    }
                }
                return;
            }

            const newmsg = {
                fromUserId: result.data.ofUserId,
                toUserId: 0,
                text: result.data.message.content,
                time: 'En este momento',
                type: result.data.message.type,
                id: result.data.message.id,
                created_at: result.data.message.created_at ?? null,
                // El widget decide el lado comparando authUser.person_id con el
                // person_id del mensaje, asi que hay que conservarlo: sin el, mis
                // propios mensajes se pintaban como si los hubiera escrito el otro.
                person_id: result.data.message.person_id,
            };

            participants.forEach(item => {
                if(authUser.id == item){
                    if(privateChat.value){
                        if(conversationId == privateChat.value.conversation){
                            const mensajes = privateChat.value.messages ?? (privateChat.value.messages = []);
                            const yaPintado = mensajes.find(m => m.id != null && String(m.id) === String(newmsg.id));
                            // Sin id (o antes de la respuesta del POST) se reconoce el
                            // mensaje ya pintado por contenido y tipo, no se duplica.
                            const sinId = yaPintado ?? mensajes.find(m => m.id == null && m.text === newmsg.text && m.type === newmsg.type);

                            if (sinId) {
                                if (newmsg.id != null) sinId.id = newmsg.id;
                                sinId.person_id = newmsg.person_id ?? sinId.person_id;
                            } else {
                                mensajes.push(newmsg);
                            }
                            scrollToBottomChatBox();
                        }
                    }

                }
            });
        });
    });

    onUnmounted(() => {
        window.socketIo.off(channelListenChat); // Dejar el canal cuando se desmonte el componente
    });

    onMounted(() => {
        storeChatBox.loadPersistedData();
    });

    onMounted(() => {
        displayNoneDivs();
    });

    const displayNoneDivs = () => {
        let crmlist = document.getElementById('crm-chatbox-list');
        let crmform = document.getElementById('crm-chatbox-form');

        if (crmlist) {
            crmlist.classList.remove('chat-maximizer');
            crmlist.classList.add('chat-minimizer');
        }

        if (crmform) {
            crmform.classList.remove('chat-maximizer');
            crmform.classList.add('chat-minimizer');
        }
    }
    const displayBlockDivs = () => {
        let crmlist = document.getElementById('crm-chatbox-list');
        let crmform = document.getElementById('crm-chatbox-form');

        if (crmlist) {
            crmlist.classList.remove('chat-minimizer');
            crmlist.classList.add('chat-maximizer');
        }

        if (crmform) {
            crmform.classList.remove('chat-minimizer');
            crmform.classList.add('chat-maximizer');
        }
    }

    const goMessengerMode = () => {
        router.visit(route('crm_application_ai_prompt'), {
            method: 'get',
            replace: false,
            data: {conv: privateChat.value.conversation},
            onFinish: () => {
                hideChatBox();
                setTimeout(() => {
                    window.scrollTo(0, document.body.scrollHeight);
                }, 100);
            },
        });
    }
</script>
<template>
    <div v-if="storeChatBox.showDiv" id="crm-chat-container" class="fixed bottom-0 right-4 w-96" style="z-index: 9999;">
        <form @submit.prevent="sendMessageChatBox" class="bg-white shadow-md rounded-t-lg max-w-lg w-full">
            <div class="p-2 border-b bg-blue-500 text-white rounded-t-lg">
                <div class="flex justify-between items-center w-full">
                    <div @click="goMessengerMode" class="flex items-center cursor-pointer space-x-2 rtl:space-x-reverse">
                        <div class="relative flex-none">
                            <img v-if="privateChat.avatar" :src="getImage(privateChat.avatar)" class="rounded-full w-6 h-6 sm:h-8 sm:w-8 object-cover" />
                            <img v-else :src="`https://ui-avatars.com/api/?name=${privateChat.full_name}&size=150&rounded=true`" class="rounded-full w-6 h-6 sm:h-8 sm:w-8 object-cover" />
                            <!-- <div class="absolute bottom-0 ltr:right-0 rtl:left-0">
                                <div class="w-4 h-4 bg-success rounded-full"></div>
                            </div> -->
                        </div>
                        <div class="mx-3">
                            <p class="text-lg font-semibold">{{ privateChat.full_name }}</p>
                            <p class="text-white text-xs">
                                {{ privateChat.email }}
                            </p>
                        </div>
                    </div>
                    <div class="flex sm:gap-2 gap-2">
                        <button @click="displayNoneDivs"  v-tippy:top type="button">
                            <icon-minimizer class="w-6 h-6 hover:text-gray-300" />
                        </button>
                        <tippy target="top" placement="top">Minimizar</tippy>
                        <button @click="displayBlockDivs"  v-tippy:top type="button">
                            <icon-maximizer class="w-6 h-6 hover:text-gray-300" />
                        </button>
                        <tippy target="top" placement="top">Maximizar</tippy>
                        <button @click="hideChatBox"  v-tippy:top type="button">
                            <icon-x class="w-6 h-6 hover:text-gray-300" />
                        </button>
                        <tippy target="top" placement="top">Cerrar</tippy>
                    </div>
                </div>
            </div>
            <div id="crm-chatbox-list" class="p-4 h-80 overflow-y-auto">
                <!-- Chat messages will be displayed here -->
                 <template v-if="privateChat.messages.length > 0">
                    <template v-for="(message, index) in privateChat.messages">
                        <div v-if="authUser.person_id == message.person_id" class="mb-2 text-right group" @mouseenter="hoverId = message.id">
                            <button
                                v-if="hoverId === message.id && canEditMessage(message)"
                                type="button"
                                class="hidden group-hover:inline-flex items-center justify-center text-white/80 hover:text-white mr-1 align-middle"
                                title="Editar mensaje"
                                @click="startEditMessage(message)"
                            >
                                <icon-pencil class="w-3.5 h-3.5" />
                            </button>
                            <div v-if="editState.id === message.id" class="bg-white dark:bg-gray-900 border border-blue-400 rounded-lg p-2 space-y-2 inline-block text-left shadow">
                                <textarea
                                    v-model="editState.texto"
                                    rows="2"
                                    class="form-textarea w-56 text-sm text-gray-900 dark:text-white"
                                    title="Enter para guardar · Shift+Enter para salto de línea"
                                    @keydown.enter.exact.prevent="saveEditMessage(message)"
                                ></textarea>
                                <p v-if="editState.error" class="text-xs text-danger">{{ editState.error }}</p>
                                <div class="flex items-center justify-end gap-2">
                                    <button
                                        type="button"
                                        class="px-2 py-1 text-xs rounded bg-gray-100 hover:bg-gray-200 text-gray-700 dark:bg-gray-800 dark:text-gray-200"
                                        :disabled="editState.procesando"
                                        @click="cancelEditMessage"
                                    >
                                        Cancelar
                                    </button>
                                    <button
                                        type="button"
                                        class="px-2 py-1 text-xs rounded bg-blue-500 text-white hover:bg-blue-600 disabled:opacity-50"
                                        :disabled="editState.procesando || !editState.texto.trim()"
                                        @click="saveEditMessage(message)"
                                    >
                                        {{ editState.procesando ? 'Guardando...' : 'Guardar' }}
                                    </button>
                                </div>
                            </div>
                            <template v-else>
                                <div
                                    v-if="message.type == 'text'"
                                    class="bg-blue-500 text-white rounded-lg rounded-br-none py-2 px-4 inline-block"
                                    v-html="message.text"
                                >
                                </div>
                                <span v-if="message.edited" class="block text-[10px] italic text-white/80">Editado</span>
                                <p v-if="message.type == 'audio'" class="bg-blue-500 text-white rounded-lg rounded-br-none py-2 px-4 inline-block">
                                    <AudioPlayer :audioSrc="message.text" :position="'right'" />
                                </p>
                                <p v-if="message.type == 'file'" class="bg-blue-500 text-white rounded-lg rounded-br-none py-2 px-4 inline-block">
                                    <FileDownload
                                        :fileDate="message.text"
                                        :position="'right'"
                                    />
                                </p>
                            </template>
                        </div>
                        <div v-else class="mb-2">
                            <template v-if="message.type == 'text'">
                                <div v-html="message.text" class="bg-gray-200 text-gray-700 rounded-lg rounded-tl-none py-2 px-4 inline-block"></div>
                                <span v-if="message.edited" class="block text-[10px] italic text-white-dark">Editado</span>
                            </template>
                            <p v-if="message.type == 'audio'" class="bg-gray-200 text-gray-700 rounded-lg rounded-tl-none py-2 px-4 inline-block">
                                <AudioPlayer :audioSrc="message.text" :position="'left'" />
                            </p>
                            <p v-if="message.type == 'file'" class="bg-gray-200 text-gray-700 rounded-lg rounded-tl-none py-2 px-4 inline-block">
                                <FileDownload
                                    :fileDate="message.text"
                                    :position="'left'"
                                />
                            </p>
                        </div>
                    </template>
                </template>
                <template v-else>
                    <div class="mb-2">
                        <div class="h-8 bg-gray-100 rounded-lg dark:bg-gray-700 w-full mb-2"></div>
                        <div class="h-8 bg-gray-100 rounded-lg dark:bg-gray-700 w-full mb-2"></div>
                    </div>
                    <div class="mb-2 flex justify-end">
                        <div class="h-8 bg-blue-300 rounded-lg dark:bg-gray-700 w-32 mb-2"></div>
                    </div>
                    <div class="mb-2">
                        <div class="h-8 bg-gray-100 rounded-lg dark:bg-gray-700 w-full mb-2"></div>
                    </div>
                    <div class="mb-2 flex justify-end">
                        <div class="h-8 bg-blue-300 rounded-lg dark:bg-gray-700 w-32 mb-2"></div>
                    </div>
                    <div class="mb-2">
                        <div class="h-8 bg-gray-100 rounded-lg dark:bg-gray-700 w-full mb-2"></div>
                    </div>
                </template>
            </div>
            <div id="crm-chatbox-form" >
                <div class="p-4 border-t flex">
                    <input v-model="privateChatText" id="user-input" type="text" placeholder="Escribe un mensaje" class="w-full px-3 py-2 border rounded-l-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <button @click="sendMessageChatBox" type="button" id="send-button" class="bg-blue-500 text-white px-4 py-2 rounded-r-md hover:bg-blue-600 transition duration-300">
                    <icon-send />
                    </button>
                </div>
            </div>
        </form>
    </div>
</template>
<style>
.chat-maximizer {
    display: block;
}
.chat-minimizer {
    display: none;
}
</style>
