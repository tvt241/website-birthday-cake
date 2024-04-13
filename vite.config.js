import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";
import vue from "@vitejs/plugin-vue";

import { createRequire } from 'node:module';
const require = createRequire( import.meta.url );

import ckeditor5 from '@ckeditor/vite-plugin-ckeditor5';

export default defineConfig({
    resolve: {
        alias: {
            "~": "/resources/js/modules",
        },
    },
    plugins: [
        laravel(["resources/js/app.js"]),
        vue({
            template: {
                transformAssetUrls: {
                    base: null,
                    includeAbsolute: false,
                },
            },
        }),
        ckeditor5( { theme: require.resolve( '@ckeditor/ckeditor5-theme-lark' ) } )
    ]
});
