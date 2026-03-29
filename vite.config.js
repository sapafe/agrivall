import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    plugins: [
        laravel({
            input: [
              'resources/css/app.css', 
              'resources/js/app.js', 
              'resources/js/cart.js',
              'resources/css/base.css',
              'resources/css/home.css',
              'resources/css/shop.css',
              'resources/css/cart.css',
              'resources/css/blog.css',
              'resources/css/casella.css',
              'resources/css/checkout.css',
              'resources/css/admin.css'
            ],
            refresh: true,
        }),
        tailwindcss(),
    ],
    server: {
        watch: {
            ignored: ['**/storage/framework/views/**'],
        },
    },
});
