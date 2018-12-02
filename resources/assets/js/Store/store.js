import Vue from "vue";
import Vuex from "vuex";
import axios from "axios";

Vue.use(Vuex);

const store = new Vuex.Store({
    state: {
        isLoggedIn: !!localStorage.getItem("token"),
        user: null,
        routeList: [
            { title: "Clock in", to: "/clock/in", show: state.isLoggedIn },
            { title: "Clock out", to: "/clock/out", show: state.isLoggedIn },
            { title: "Sign up", to: "/signup", show: !state.isLoggedIn },
            { title: "Login", to: "/login", show: !state.isLoggedIn },
            { title: "Logout", to: "/logout", show: state.isLoggedIn }
        ]
    },
    mutations: {
        VALIDATE_LOGIN(state, res) {
            const token = res.data.access_token;
            const payload = JSON.parse(atob(token.split(".")[1]));

            let api_auth_login = "http://localhost:8000/";
            api_auth_login += "api/jwt/auth/login";

            let api_auth_signup = "http://localhost:8000/";
            api_auth_signup += "api/jwt/auth/signup";

            if (payload) {
                let login = payload.iss == api_auth_signup;
                let signup = payload.iss == api_auth_login;
                if (login || signup) {
                    localStorage.setItem("token", token);
                    state.user = res.data.username;
                }
            }
        },
        LOGOUT(state) {
            localStorage.removeItem("token");
            state.user = null;
        }
    },
    actions: {
        login(formData) {
            var path = "http://localhost:8000/";
            path += "api/jwt/auth/login";
            axios
                .post(path, formData)
                .then(res => commit("VALIDATE_LOGIN", res))
                .catch(error => console.log(error.response));
        },
        logout() {
            commit("LOGOUT");
        }
    },
    getters: {
        getUser() {
            return this.$state.user;
        },
        getLoggedInStatus() {
            return this.$state.isLoggedIn;
        },
        getRouteList() {
            return this.$state.routeList;
        }
    }
});

export default store;
