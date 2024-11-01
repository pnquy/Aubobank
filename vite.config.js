import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
                'resources/sass/guest.scss',
                'resources/css/style.css',
                'resources/sass/nav.scss',
                'resources/sass/menu.scss',
                'resources/sass/tool.scss',
                'resources/sass/overview.scss',
                'resources/sass/purchase.scss',
                'resources/sass/intergrated.scss',
                'resources/sass/upgrade.scss',
                'resources/sass/profile.scss',
                'resources/sass/apidata.scss',
                'resources/sass/webhook.scss',
                'resources/js/profile.js', 
                'resources/js/nav.js',
                'resources/js/form.js',
                'resources/js/overview.js',
                'resources/js/intergrated.js',
                'resources/js/upgrade.js',
                'resources/js/apidata.js',
                'resources/js/webhook.js',
            ],
            refresh: true,
        }),
    ],
});
