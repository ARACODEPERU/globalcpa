import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";
import vue from "@vitejs/plugin-vue";
import path from 'path';

export default defineConfig({
    plugins: [
        laravel({
            input: "resources/js/app.js",
            ssr: "resources/js/ssr.js",
            refresh: true,
        }),
        vue({
            template: {
                transformAssetUrls: {
                    base: null,
                    includeAbsolute: false,
                },
            },
        }),
    ],
    resolve: {
        alias: {
            'Modules': path.resolve(__dirname, './Modules'),
            '@Public': path.resolve(__dirname, './public'),
        },
    },
    build: {
        sourcemap: false,
        rollupOptions: {
            external: ['vue-clipboard3'] // Añade vue-clipboard3 como un módulo externo
        }
    },
    server: {
        sourcemap: true,
        cors: true
    }
});

