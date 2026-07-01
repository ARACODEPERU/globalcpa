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
        class="theme-mode-switch"
        :class="{ 'is-dark': isDark }"
        :aria-label="isDark ? 'Cambiar a modo claro' : 'Cambiar a modo oscuro'"
        @click="handleToggle"
    >
        <span class="theme-mode-switch__track">
            <span class="theme-mode-switch__thumb">
                <IconSun v-if="!isDark" class="theme-mode-switch__icon theme-mode-switch__icon--sun" />
                <IconMoon v-else class="theme-mode-switch__icon theme-mode-switch__icon--moon" />
            </span>
        </span>
        <span class="theme-mode-switch__label">
            {{ isDark ? 'Oscuro' : 'Claro' }}
        </span>
    </button>
</template>

<style scoped>
.theme-mode-switch {
    display: inline-flex;
    align-items: center;
    gap: 0.625rem;
    padding: 0.375rem 0.75rem;
    border: 1px solid #e2e8f0;
    border-radius: 9999px;
    background: #f8fafc;
    cursor: pointer;
    transition: all 0.25s ease;
    outline: none;
    user-select: none;
}

.theme-mode-switch:hover {
    border-color: #94a3b8;
    background: #f1f5f9;
}

.theme-mode-switch:focus-visible {
    box-shadow: 0 0 0 2px rgba(59, 130, 246, 0.5);
}

.theme-mode-switch.is-dark {
    border-color: #334155;
    background: #1e293b;
}

.theme-mode-switch.is-dark:hover {
    border-color: #475569;
    background: #1e293b;
}

.theme-mode-switch__track {
    position: relative;
    display: inline-flex;
    align-items: center;
    width: 2.25rem;
    height: 1.25rem;
    border-radius: 9999px;
    background: #cbd5e1;
    transition: background 0.25s ease;
    flex-shrink: 0;
}

.is-dark .theme-mode-switch__track {
    background: #475569;
}

.theme-mode-switch__thumb {
    position: absolute;
    top: 0.125rem;
    left: 0.125rem;
    display: flex;
    align-items: center;
    justify-content: center;
    width: 1rem;
    height: 1rem;
    border-radius: 9999px;
    background: #ffffff;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.15);
    transition: transform 0.25s ease;
}

.is-dark .theme-mode-switch__thumb {
    transform: translateX(1rem);
    background: #facc15;
}

.theme-mode-switch__icon {
    width: 0.625rem;
    height: 0.625rem;
}

.theme-mode-switch__icon--sun {
    color: #f59e0b;
}

.theme-mode-switch__icon--moon {
    color: #1e293b;
}

.is-dark .theme-mode-switch__icon--moon {
    color: #1e293b;
}

.theme-mode-switch__label {
    font-size: 0.8125rem;
    font-weight: 500;
    color: #475569;
    transition: color 0.25s ease;
    white-space: nowrap;
}

.is-dark .theme-mode-switch__label {
    color: #cbd5e1;
}
</style>
