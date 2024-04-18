import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/css/collapsable.css',
                'resources/js/app.js',
                'resources/js/collapsable.js',
                'resources/js/slug_generator.js',
                'resources/js/gmail.js',
                'resources/js/email.js' 
            ],
            refresh: true,
        }),
    ],
});
