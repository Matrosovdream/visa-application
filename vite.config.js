import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/assets/admin/css/style.bundle.css',
                'resources/assets/admin/plugins/global/plugins.bundle.css',
            ],
            refresh: true,
        }),
    ],
});
