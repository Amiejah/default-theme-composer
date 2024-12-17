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
        })
    ],
    // server: {
    //     hmr: {
    //         host: 'localhost',
    //     }
    // },
    resolve: {
        alias: {
            '@': path.resolve(__dirname, 'resources'),
        },
    },
});