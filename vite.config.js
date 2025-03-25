import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/user/app.css',
                'resources/css/user/extra.css',
                'resources/js/user/main.js',
                'resources/js/user/scripts.js',
            ],
            refresh: true,
        }),
    ],
});
