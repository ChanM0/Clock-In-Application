import Vue from "vue";
import Vuex from "vuex";
import axios from "axios";

Vue.use(Vuex);

const store = new Vuex.Store({
    state: {
        isLoggedIn: !!localStorage.getItem("token"),
        user: null
    },
    mutations: {
        VALIDATE_LOGIN(state, res) {
            const token = res.data.access_token;
            const payload = JSON.parse(atob(token.split(".")[1]));
            const user = res.data.username;

            let api_auth_login = "http://localhost:8000/";
            api_auth_login += "api/jwt/auth/login";

            let api_auth_signup = "http://localhost:8000/";
            api_auth_signup += "api/jwt/auth/signup";

            if (payload) {
                let login = payload.iss == api_auth_signup;
                let signup = payload.iss == api_auth_login;
                if (login || signup) {
                    localStorage.setItem("token", token);
                    state.isLoggedIn = localStorage.getItem("token")
                        ? true
                        : false;
                    state.user = user;
                }
            }
        },
        LOGOUT(state) {
            localStorage.removeItem("token");
            state.isLoggedIn = localStorage.getItem("token") ? true : false;
            state.user = null;
        }
    },
    actions: {
        login({ commit }, formData) {
            console.log(formData);
            var path = "http://localhost:8000/";
            path += "api/jwt/auth/login";
            axios
                .post(path, formData)
                .then(res => commit("VALIDATE_LOGIN", res))
                .catch(error => {
                    console.log(formData);
                    console.log(error.response);
                });
        },
        logout({ commit }) {
            commit("LOGOUT");
        },
        signup({ commit }, formData) {
            var path = "http://localhost:8000/";
            path += "api/jwt/auth/signup";
            axios
                .post(path, formData)
                .then(res => commit("VALIDATE_LOGIN", res))
                .catch(error => console.log(error.response.data));
        }
    },
    getters: {
        getUser: state => {
            return state.user;
        },
        getLoggedInStatus: state => {
            return state.isLoggedIn;
        }
    }
});

export default store;
