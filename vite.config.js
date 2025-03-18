import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";

export default defineConfig({
    plugins: [laravel(["resources/js/app.js"])],
    server: {
        host: "localhost",
        port: 5173, // Default Laravel Vite port
    },
});
