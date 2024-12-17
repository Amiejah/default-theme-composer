import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import path from 'path';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/scripts/main.js',
                'resources/styles/main.css'
            ],
            publicDirectory: 'assets',
        }),
        {
            name: 'php',
            handleHotUpdate({ file, server }) {
                if (file.endsWith('.php')) {
                    server.ws.send({ 
                        type: 'full-reload',
                        path: '*',
                    });
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