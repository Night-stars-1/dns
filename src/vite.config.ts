/*
 * @Date: 2024-02-05 23:05:24
 * @LastEditors: Night-stars-1 nujj1042633805@gmail.com
 * @LastEditTime: 2024-02-13 15:48:30
 */
import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";
import vuetify from "vite-plugin-vuetify";
import vue from "@vitejs/plugin-vue";
import compressionPlugin from "vite-plugin-compression";
import Components from "unplugin-vue-components/vite";
import { VuetifyResolver } from "unplugin-vue-components/resolvers";

export default defineConfig({
    plugins: [
        compressionPlugin({
            // 这里是插件选项
            verbose: true, // 启用详细输出
            disable: false, // 不禁用压缩
            threshold: 10240, // 只处理大于此大小的资源（以字节为单位）。这是可选的。
            algorithm: "gzip", // 使用gzip压缩
            ext: ".gz", // 默认情况下，生成`.gz`扩展名的文件
        }),
        laravel({
            input: ["resources/js/app.ts"],
        }),
        vue(),
        vuetify({ autoImport: true }),
        Components({
            resolvers: [VuetifyResolver()],
        }),
    ],
    build: {
        outDir: "../build",
    },
});
