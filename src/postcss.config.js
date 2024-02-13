import purgecssBase from "@fullhuman/postcss-purgecss";

// 配置 PurgeCSS
const purgecss = purgecssBase({
    content: [
        "./resources/js/*.{vue,js,ts,jsx,tsx}",
        "./resources/js/**/*.{vue,js,ts,jsx,tsx}",
        "./resources/js/**/**/*.{vue,js,ts,jsx,tsx}",
        './node_modules/vuetify/dist/*.js',
        './node_modules/vuetify/dist/*.css',
        './node_modules/vuetify/src/**/*.ts',
        './node_modules/@mdi/fonts/*',
    ],
});

export default {
    plugins: [
        // 仅在生产环境中启用 PurgeCSS
        ...(process.env.NODE_ENV === "production" ? [purgecss] : []),
    ],
};
