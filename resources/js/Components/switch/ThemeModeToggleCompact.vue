<script setup>
import { computed } from 'vue';
import { useAppStore } from '@/stores/index';
import IconSun from '@/Components/vristo/icon/icon-sun.vue';
import IconMoon from '@/Components/vristo/icon/icon-moon.vue';

const props = defineProps({
    onToggleTheme: {
        type: Function,
        default: null,
    },
});

const store = useAppStore();

const isDark = computed(() => store.theme === 'dark');

function handleToggle() {
    const newChecked = !isDark.value;
    if (props.onToggleTheme) {
        props.onToggleTheme(newChecked);
    }
}
</script>

<template>
    <button
        type="button"
        class="theme-mode-toggle-compact"
        :class="{ 'is-dark': isDark }"
        :aria-label="isDark ? 'Cambiar a modo claro' : 'Cambiar a modo oscuro'"
        @click="handleToggle"
    >
        <IconSun v-if="!isDark" class="theme-mode-toggle-compact__icon" />
        <IconMoon v-else class="theme-mode-toggle-compact__icon" />
    </button>
</template>

<style scoped>
.theme-mode-toggle-compact {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 2.25rem;
    height: 2.25rem;
    border: 1px solid #e2e8f0;
    border-radius: 0.5rem;
    background: #f8fafc;
    cursor: pointer;
    transition: all 0.2s ease;
    outline: none;
}

.theme-mode-toggle-compact:hover {
    border-color: #94a3b8;
    background: #f1f5f9;
}

.theme-mode-toggle-compact:focus-visible {
    box-shadow: 0 0 0 2px rgba(59, 130, 246, 0.5);
}

.theme-mode-toggle-compact.is-dark {
    border-color: #334155;
    background: #1e293b;
}

.theme-mode-toggle-compact.is-dark:hover {
    border-color: #475569;
    background: #334155;
}

.theme-mode-toggle-compact__icon {
    width: 1.125rem;
    height: 1.125rem;
    color: #64748b;
    transition: color 0.2s ease;
}

.theme-mode-toggle-compact.is-dark .theme-mode-toggle-compact__icon {
    color: #facc15;
}

.theme-mode-toggle-compact:not(.is-dark) .theme-mode-toggle-compact__icon {
    color: #f59e0b;
}
</style>
