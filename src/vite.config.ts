/*
 * @Date: 2024-02-05 23:05:24
 * @LastEditors: Night-stars-1 nujj1042633805@gmail.com
 * @LastEditTime: 2024-02-11 15:09:34
 */
import { resolve } from 'path'
import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vuetify from 'vite-plugin-vuetify';
import vue from '@vitejs/plugin-vue';
import Components from 'unplugin-vue-components/vite';
import { VuetifyResolver } from 'unplugin-vue-components/resolvers';

export default defineConfig({
  plugins: [
    laravel({
      input: ['resources/js/app.ts']
    }),
    vue(),
    vuetify({ autoImport: true }), 
    Components({
      resolvers: [
        VuetifyResolver()
      ]
    }),
  ],
  build: {
    outDir: '../build'
  },
});
