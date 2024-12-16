import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import path from 'path';

const ROOT = path.resolve('./');
const BASE = __dirname.replace(ROOT, '');
const APP_URL = process.env.APP_URL || 'https://humpff.test';

console.log('BASE', BASE);
console.log('APP_URL', APP_URL);
console.log('ROOT', ROOT);

export default defineConfig({
    base: process.env.NODE_ENV === 'production' ? `${BASE}/resource/` : BASE,
    plugins: [
        laravel({
            input: [
                'resources/scripts/main.js',
                'resources/styles/main.css'
            ],
            publicDirectory: 'assets',
            env: {
                APP_URL: APP_URL,
            },
        }),
        {
            name: 'php',
            handleHotUpdate({ file, server }) {
                if (file.endsWith('.php')) {
                    server.ws.send({ type: 'full-reload' });
                }
            }
        }
    ],
    resolve: {
        alias: {
            '@': path.resolve(__dirname, 'resources'),
        },
    },
    build: {
        assetsDir: '.',
    },
});