/*
 * @Date: 2024-02-05 23:05:46
 * @LastEditors: Night-stars-1 nujj1042633805@gmail.com
 * @LastEditTime: 2024-02-11 13:12:05
 */
import { createApp } from "vue";

import axios from "axios";

import App from "./App.vue";

import store from './store';
import router from './plugins/router';
import vuetify from './plugins/vuetify';



// axios
axios.defaults.headers.post["X-Requested-With"] = "XMLHttpRequest";
//axios.defaults.headers.post['X-CSRF-TOKEN'] = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
axios.defaults.headers.post["Content-Type"] =
    "application/x-www-form-urlencoded; charset=UTF-8";


const app = createApp(App);

async function getUser() {
    const response = await axios.post("/user");
    app.config.globalProperties.user = response.data;
}

router.beforeEach(async (to, from, next) => {
    // 在每次路由切换前设置页面标题
    document.title = to.meta.title
        ? `${to.meta.title} - ${window.webName}`
        : window.webName;
    if (
        !app.config.globalProperties.user ||
        app.config.globalProperties.user.status == 0
    )
        await getUser();
    if (to.path == "/login" || to.path == "/register") {
        if ([1, 2].includes(app.config.globalProperties.user.status))
            return next("/home");
    } else {
        if (app.config.globalProperties.user.status == -1002)
            return next("/login");
    }
    next();
});

app.config.globalProperties.$axios = axios;
app.use(vuetify);
app.use(router);
app.use(store);
app.mount("#app");
