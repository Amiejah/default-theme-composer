import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import path from 'path';

const ROOT = path.resolve('../../../');
const BASE = __dirname.replace(ROOT, '');

export default defineConfig({
    base: process.env.NODE_ENV === 'production' ? `${BASE}/assets/build/` : BASE,
    plugins: [
        laravel({
            input: [
                'resources/styles/main.css',
                'resources/scripts/main.js'
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