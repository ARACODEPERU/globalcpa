<script setup>
import { onBeforeUnmount, onMounted, ref, watch } from 'vue';

const props = defineProps({
    modelValue: {
        type: String,
        default: ''
    },
    placeholder: {
        type: String,
        default: 'Antes S/ 1800'
    }
});

const emit = defineEmits(['update:modelValue']);

const editor = ref(null);
const color = ref('#c3121b');
const active = ref({
    bold: false,
    italic: false,
    underline: false,
    strikeThrough: false
});

const buttonClass = 'rounded px-2 py-1 text-sm font-semibold text-gray-700 hover:bg-gray-100 focus:outline-none dark:text-gray-200 dark:hover:bg-gray-600';
const activeClass = 'bg-gray-200 dark:bg-gray-600 text-gray-900 dark:text-white';

const normalize = (html) => {
    const value = (html || '').trim();

    return value === '<br>' || value === '<div><br></div>' ? '' : value;
};

const sync = () => emit('update:modelValue', normalize(editor.value?.innerHTML));

const refreshActive = () => {
    const selection = window.getSelection();

    if (!editor.value || !selection || !editor.value.contains(selection.anchorNode)) {
        return;
    }

    try {
        active.value = {
            bold: document.queryCommandState('bold'),
            italic: document.queryCommandState('italic'),
            underline: document.queryCommandState('underline'),
            strikeThrough: document.queryCommandState('strikeThrough')
        };
    } catch (error) {
        // Algunos navegadores no exponen queryCommandState: el formato sigue funcionando.
    }
};

const command = (name, value = null) => {
    if (!editor.value) {
        return;
    }

    editor.value.focus();
    document.execCommand('styleWithCSS', false, true);
    document.execCommand(name, false, value);
    sync();
    refreshActive();
};

const pickColor = (event) => {
    color.value = event.target.value;
    command('foreColor', color.value);
};

const paste = (event) => {
    event.preventDefault();

    const text = (event.clipboardData || window.clipboardData)?.getData('text/plain') ?? '';
    document.execCommand('insertText', false, text);
    sync();
};

const onSelectionChange = () => refreshActive();

onMounted(() => {
    if (editor.value) {
        editor.value.innerHTML = props.modelValue || '';
    }

    document.addEventListener('selectionchange', onSelectionChange);
});

onBeforeUnmount(() => document.removeEventListener('selectionchange', onSelectionChange));

watch(() => props.modelValue, (value) => {
    if (editor.value && editor.value.innerHTML !== (value || '')) {
        editor.value.innerHTML = value || '';
    }
});
</script>

<template>
    <div class="rounded-md border border-gray-300 bg-white dark:border-gray-600 dark:bg-gray-700">
        <div class="flex flex-wrap items-center gap-1 border-b border-gray-200 px-2 py-1.5 dark:border-gray-600">
            <button type="button" title="Negrita" :class="[buttonClass, active.bold ? activeClass : '']"
                @mousedown.prevent="command('bold')">
                <b>B</b>
            </button>
            <button type="button" title="Cursiva" :class="[buttonClass, active.italic ? activeClass : '']"
                @mousedown.prevent="command('italic')">
                <i>I</i>
            </button>
            <button type="button" title="Subrayado" :class="[buttonClass, active.underline ? activeClass : '']"
                @mousedown.prevent="command('underline')">
                <u>U</u>
            </button>
            <button type="button" title="Tachado" :class="[buttonClass, active.strikeThrough ? activeClass : '']"
                @mousedown.prevent="command('strikeThrough')">
                <s>S</s>
            </button>
            <span class="mx-1 h-5 w-px bg-gray-300 dark:bg-gray-600"></span>
            <label class="inline-flex cursor-pointer items-center gap-1 rounded px-1 py-1 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-200 dark:hover:bg-gray-600"
                title="Color del texto">
                <span aria-hidden="true">A</span>
                <input v-model="color" type="color"
                    class="h-5 w-6 cursor-pointer border-0 bg-transparent p-0"
                    @input="pickColor" />
            </label>
            <span class="mx-1 h-5 w-px bg-gray-300 dark:bg-gray-600"></span>
            <button type="button" title="Quitar formato" :class="buttonClass" @mousedown.prevent="command('removeFormat')">
                Quitar formato
            </button>
        </div>

        <div ref="editor" contenteditable="true" role="textbox" aria-multiline="true"
            class="price-note-editor min-h-[46px] px-3 py-2 text-sm text-gray-900 outline-none dark:text-white"
            :data-placeholder="placeholder" @input="sync" @blur="sync" @paste="paste"></div>
    </div>
</template>

<style scoped>
.price-note-editor:empty::before {
    content: attr(data-placeholder);
    color: #9ca3af;
    pointer-events: none;
}

.price-note-editor:focus {
    box-shadow: inset 0 0 0 1px #4b5563;
}
</style>
