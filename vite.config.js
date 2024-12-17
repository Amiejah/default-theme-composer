import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from 'tailwindcss';
import path from 'path';

console.log();
export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/scripts/main.js',
                'resources/styles/main.css'
            ],
            publicDirectory: 'assets',
            refresh: true,
        }),
        {
            name: 'php',
            handleHotUpdate({ file, server }) {
                if (file.endsWith('.php')) {
                    server.ws.send({ type: 'full-reload' });
                }
            },
        },
    ],
    server: {
        hmr: {
            host: 'localhost',
        }
    },
    resolve: {
        alias: {
            '@': path.resolve(__dirname, 'resources'),
        },
    },
    build: {
        assetsDir: '.',
    },
});