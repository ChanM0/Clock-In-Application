import Vue from "vue";
import Vuex from "vuex";
import axios from "axios";

Vue.use(Vuex);

const store = new Vuex.Store({
    state: {
        isLoggedIn: !!localStorage.getItem("token"),
        username: localStorage.getItem("username"),
        userId: localStorage.getItem("userId"),
        userList: {},
        allUsersLogs: {}
    },
    mounted() {
        if (localStorage.getItem("userList")) {
            try {
                this.userList = JSON.parse(localStorage.getItem("userList"));
            } catch (e) {
                localStorage.removeItem("userList");
            }
        }
    },
    mutations: {
        VALIDATE_LOGIN(state, res) {
            const token = res.data.access_token;
            const payload = JSON.parse(atob(token.split(".")[1]));
            const username = res.data.username;
            const userId = res.data.user_id;

            let api_auth_login = "http://localhost:8000/";
            api_auth_login += "api/jwt/auth/login";

            let api_auth_signup = "http://localhost:8000/";
            api_auth_signup += "api/jwt/auth/signup";

            if (payload) {
                let login = payload.iss == api_auth_signup;
                let signup = payload.iss == api_auth_login;
                if (login || signup) {
                    localStorage.setItem("token", token);
                    localStorage.setItem("username", username);
                    localStorage.setItem("userId", userId);

                    state.isLoggedIn = localStorage.getItem("token")
                        ? true
                        : false;
                    state.username = username;
                    state.userId = userId;
                }
            }
        },
        LOGOUT(state) {
            localStorage.clear();
            state.isLoggedIn = localStorage.getItem("token") ? true : false;
            state.username = null;
            state.userId = null;
            // console.log(res);/
        },
        CLOCKIN(state, res) {
            console.log(res);
        },
        CLOCKOUT(state, res) {
            console.log(res);
        },
        POPULATEUSERSLIST(state, res) {
            state.userList = res;
            console.log(res);
            res = JSON.stringify(res);
            localStorage.setItem("userList", res);
        },
        FETCHUSERLIST(state) {
            var data = JSON.parse(localStorage.getItem("userList"));
            state.userList = data;
        },
        GETALLUSERSLOGS(state, res) {
            state.allUsersLogs = res;
            console.log(res);
            res = JSON.stringify(res);
            localStorage.setItem("allUsersLogs", res);
        },
        FETCHALLUSERSLOGS(state) {
            var data = JSON.parse(localStorage.getItem("allUsersLogs"));
            state.allUsersLogs = data;
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
            // var path = "http://localhost:8000/";
            // path += "api/jwt/auth/logout";
            // axios
            //     .post(path)
            //     .then(res => commit("LOGOUT", res))
            //     .catch(error => {
            //         console.log(error.response);
            //     });
            commit("LOGOUT");
        },
        signup({ commit }, formData) {
            var path = "http://localhost:8000/";
            path += "api/jwt/auth/signup";
            axios
                .post(path, formData)
                .then(res => commit("VALIDATE_LOGIN", res))
                .catch(error => console.log(error.response.data));
        },
        clockin({ commit }, data) {
            console.log(data);
            var path = "http://localhost:8000/";
            path += "api/empl/clock/in";
            axios
                .post(path, data)
                .then(res => commit("CLOCKIN", res))
                .catch(error => console.log(error.response.data));
        },
        clockout({ commit }, data) {
            console.log(data);
            var path = "http://localhost:8000/";
            path += "api/empl/clock/out";
            axios
                .put(path, data)
                .then(res => commit("CLOCKOUT", res))
                .catch(error => console.log(error.response.data));
        },
        populateUsersList({ commit }) {
            var path = "http://localhost:8000/";
            path += "api/jwt/auth/users";
            axios
                .post(path)
                .then(res => {
                    commit("POPULATEUSERSLIST", res.data);
                })
                .catch(error => console.log(error.response.data));
        },
        fetchUserList({ commit }) {
            commit("FETCHUSERLIST");
        },
        getAllUsersLogs({ commit }, data) {
            var path = "http://localhost:8000/";
            path += "api/empl/clock/all/logs";
            console.log("BEGIN: GetAllUsersLog");
            console.log(data);
            console.log("END: GetAllUsersLog");
            axios
                .post(path, data)
                .then(res => {
                    console.log(res);
                    commit("GETALLUSERSLOGS", res.data);
                })
                .catch(error => console.log(error.response.data));
        },
        fetchAllUsersLogs({ commit }) {
            commit("FETCHALLUSERSLOGS");
        }
    },
    getters: {
        getUserId: state => {
            return state.userId;
        },
        getUsername: state => {
            return state.username;
        },
        getLoggedInStatus: state => {
            return state.isLoggedIn;
        },
        getToken: state => {
            return localStorage.getItem("token");
        },
        getUserList: state => {
            console.log(state.userList);
            return state.userList;
        },
        getAllUserLogs: state => {
            console.log(state.allUsersLogs);
            return state.allUsersLogs;
        }
    }
});

export default store;
