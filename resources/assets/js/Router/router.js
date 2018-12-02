import Vue from "vue";
import VueRouter from "vue-router";
Vue.use(VueRouter);
const routes = [
    // {
    //     path: "/login",
    //     component: login
    //     // name:""
    // },
    // {
    //     path: "/signUp",
    //     component: login
    //     // name:""
    // },
    // {
    //     path: "/clockIn",
    //     component: login
    //     // name:""
    // },
    // {
    //     path: "/clockOut",
    //     component: login
    //     // name:""
    // },
    // {
    //     path: "/admin/all/logs",
    //     component: login
    //     // name:""
    // },
    // {
    //     path: "/admin/user/logs",
    //     component: login
    //     // name:""
    // }
];
const router = new VueRouter({
    mode: history,
    routes // short for `routes: routes`
});
export default router;
