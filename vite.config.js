import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/user/extra.css',
                'resources/css/user/app.css',
                'resources/js/user/scripts.js',
                'resources/js/user/main.js',
            ],
            refresh: true,
        }),
    ],
});
