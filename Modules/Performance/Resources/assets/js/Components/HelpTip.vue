<script setup>
    defineProps({
        text: { type: String, required: true },
    });
</script>

<template>
    <span
        class="group relative ml-1 inline-flex h-4 w-4 cursor-help select-none items-center justify-center rounded-full bg-slate-200 text-[10px] font-bold text-slate-600 align-middle dark:bg-slate-700 dark:text-slate-300"
        :title="text" tabindex="0">
        ?
        <span
            class="pointer-events-none absolute bottom-full left-1/2 z-50 mb-1 hidden w-60 -translate-x-1/2 rounded-lg bg-slate-900 px-2.5 py-1.5 text-left text-[11px] font-normal leading-snug text-white shadow-lg group-hover:block group-focus:block">
            {{ text }}
        </span>
    </span>
</template>
