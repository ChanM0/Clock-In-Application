import Vue from "vue";
import VueRouter from "vue-router";
Vue.use(VueRouter);

import login from "../components/Forms/Login";
import logout from "../components/Forms/logout";
import signup from "../components/Forms/signup";
import clockIn from "../components/ClockInForms//ClockIn";

const routes = [
    {
        path: "/",
        name: "landingPage"
    },
    {
        path: "/login",
        component: login,
        name: "login"
    },
    {
        path: "/logout",
        component: logout,
        name: "logout"
    },
    {
        path: "/signup",
        component: signup,
        name: "signup"
    },
    {
        path: "/clock/in",
        component: clockIn,
        name: "clockIn"
    }
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
    // mode: history,
    routes // short for `routes: routes`
});
export default router;
