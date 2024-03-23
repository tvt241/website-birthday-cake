import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';
 
export default defineConfig({
    resolve: {
        alias: {
          '~': '/resources/js/modules',
        },
    },
    plugins: [
        laravel([
            'resources/js/app.js',
        ]),
        vue({
            template: {
                transformAssetUrls: {
                    base: null,
                    includeAbsolute: false,
                },
            },
        }),
    ],
});