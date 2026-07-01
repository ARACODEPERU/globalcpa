<script setup>
import { ref, onMounted, onBeforeUnmount, watch, nextTick } from 'vue';
import AracodeEditor from '@elmerrodriguez/editor-aracode';
import '@elmerrodriguez/editor-aracode/style.css';

const props = defineProps({
    modelValue: { type: String, default: '' },
    minHeight: { type: String, default: '400px' },
    placeholder: { type: String, default: 'Escribe aquí...' },
    imageUploadUrl: { type: String, default: '' },
});

const emit = defineEmits(['update:modelValue']);

const host = ref(null);
let editor = null;
let isInternalChange = false;

function initEditor() {
    if (!host.value) return;

    // Set initial content on the host element before initializing
    host.value.innerHTML = props.modelValue || '';

    const options = {
        locale: 'es',
        height: parseInt(props.minHeight) || 400,
    };

    if (props.imageUploadUrl) {
        options.imageUploadUrl = props.imageUploadUrl;
    }

    if (props.placeholder) {
        options.placeholder = props.placeholder;
    }

    editor = new AracodeEditor(host.value, options);

    // Listen for content changes using the editor's custom event system
    editor.on('change', onEditorChange);
}

function onEditorChange() {
    if (!editor) return;
    isInternalChange = true;
    const html = editor.getHTML();
    emit('update:modelValue', html);
    nextTick(() => {
        isInternalChange = false;
    });
}

function destroyEditor() {
    if (editor) {
        editor.off('change', onEditorChange);
        editor.destroy();
        editor = null;
    }
}

watch(
    () => props.modelValue,
    async (newVal) => {
        if (isInternalChange || !editor) return;
        const currentHtml = editor.getHTML();
        if (newVal !== currentHtml) {
            destroyEditor();
            await nextTick();
            initEditor();
        }
    }
);

onMounted(() => {
    initEditor();
});

onBeforeUnmount(() => {
    destroyEditor();
});
</script>

<template>
    <div
        ref="host"
        class="aracode-editor-wrapper"
        :style="{ minHeight }"
    />
</template>

<style scoped>
.aracode-editor-wrapper {
    width: 100%;
    border: 1px solid #e2e8f0;
    border-radius: 0.5rem;
    overflow: hidden;
}

.aracode-editor-wrapper:deep(.aracode-editor) {
    border: none !important;
}
</style>
