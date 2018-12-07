<template>
  <v-toolbar>
    <v-toolbar-title>SPA-Forum</v-toolbar-title>
    <v-spacer></v-spacer>
    <div class="hidden-sm-and-down">
      <router-link
        v-for="routeView in routeList"
        :key="routeView.title"
        :to="routeView.to"
        v-if="routeView.show"
      >
        <v-btn flat>{{routeView.title}}</v-btn>
      </router-link>
    </div>
  </v-toolbar>
</template>
 <script>
import { mapGetters } from "vuex";
export default {
  data() {
    return {
      routeList: [
        {
          title: "All Users",
          to: "/admin/all/users",
          show: this.$store.getters.getLoggedInStatus
        },
        {
          title: "Get Logs From This Day",
          to: "/admin/day/logs",
          show: this.$store.getters.getLoggedInStatus
        },
        {
          title: "Clock in",
          to: "/clock/in",
          show: this.$store.getters.getLoggedInStatus
        },
        {
          title: "Clock out",
          to: "/clock/out",
          show: this.$store.getters.getLoggedInStatus
        },
        {
          title: "Sign up",
          to: "/signup",
          show: !this.$store.getters.getLoggedInStatus
        },
        {
          title: "Login",
          to: "/login",
          show: !this.$store.getters.getLoggedInStatus
        },
        {
          title: "Logout",
          to: "/logout",
          show: this.$store.getters.getLoggedInStatus
        }
      ]
    };
  },
  computed: {
    ...mapGetters(["getLoggedInStatus"])
  },
  watch: {
    getLoggedInStatus() {
      console.log("hello i am beeing watch");
      var show = this.$store.getters.getLoggedInStatus;
      this.routeList = [
        {
          title: "Get Logs From This Day",
          to: "/admin/day/logs",
          show: show
        },
        {
          title: "All Users",
          to: "/admin/all/users",
          show: show
        },
        {
          title: "Clock in",
          to: "/clock/in",
          show: show
        },
        {
          title: "Clock out",
          to: "/clock/out",
          show: show
        },
        {
          title: "Sign up",
          to: "/signup",
          show: !show
        },
        {
          title: "Login",
          to: "/login",
          show: !show
        },
        {
          title: "Logout",
          to: "/logout",
          show: show
        }
      ];
    }
  }
};
</script>
 <style>
</style>