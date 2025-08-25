import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import react from '@vitejs/plugin-react';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/css/about-us.css',
                'resources/css/home.css',
                'resources/css/mymiro.css',
                'resources/css/product-blog.css',
                'resources/css/blog-page2.css',
                'resources/css/product-details.css',
                'resources/css/services.css',
                'resources/css/Project.css',
                'resources/css/ProjectDetails.css',
                'resources/css/admin.css',
                'resources/js/app.jsx',
            ],
            refresh: true,
        }),
        react(),
    ],
    build: {
        outDir: 'public/build',
        assetsDir: 'assets',
        rollupOptions: {
            output: {
                assetFileNames: (assetInfo) => {
                    if (assetInfo.name.endsWith('.ttf') || assetInfo.name.endsWith('.woff') || assetInfo.name.endsWith('.woff2')) {
                        return 'assets/fonts/[name][extname]';
                    }
                    return 'assets/[name]-[hash][extname]';
                }
            }
        }
    }
});