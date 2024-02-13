import {
    createRouter,
    createWebHistory,
    createWebHashHistory,
} from "vue-router";

import Login from "../components/login.vue";
import Register from "../components/register.vue";
import HomeLayout from "../components/homeLayout.vue";
import Home from "../components/home/index.vue";
import Profile from "../components/home/profile.vue";
import Point from "../components/home/point.vue";
import Red from "../components/home/red.vue";
import Pay from "../components/home/pay.vue"
import PayResult from "../components/pay/return.vue"

const routes = [
    {
        path: "/register",
        name: "register",
        component: Register,
        meta: { title: "注册" },
    },
    {
        path: "/login",
        name: "login",
        component: Login,
        meta: { title: "登录" },
    },
    {
        path: "/home",
        name: "homeLayout",
        component: HomeLayout,
        children: [
            {
                path: "",
                name: "home",
                component: Home,
                meta: { title: "主页" },
            },
            {
                path: "profile",
                name: "profile",
                component: Profile,
                meta: { title: "个人资料" },
            },
            {
                path: "point",
                name: "point",
                component: Point,
                meta: { title: "积分明细" },
            },
            {
                path: "red",
                name: "red",
                component: Red,
                meta: { title: "公益防红" },
            },
            {
                path: "pay",
                name: "pay",
                component: Pay,
                meta: { title: "积分充值" },
            },
        ],
    },
    {
        path: "/payReturn/:uid",
        name: "payReturn",
        component: PayResult,
        meta: { title: "支付结果" },
    },
];
const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;