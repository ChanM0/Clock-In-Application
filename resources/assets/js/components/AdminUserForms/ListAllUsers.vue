<template>
  <v-container>
    <v-form @submit.prevent="populateUsersTable">
      <v-btn color="green" type="submit">Get All Users</v-btn>
    </v-form>
    <div>
      <ul v-for="user in users" :key="user.id">
        <li>
          <h4>
            <router-link
              :to="{name:'getAllUsersLogs', params:{username:user.username}}"
            >Get all logs from: {{user.username}}</router-link>
          </h4>
        </li>
        <br>
      </ul>
    </div>
  </v-container>
</template>

<script>
import { mapGetters } from "vuex";
export default {
  data() {
    return {
      users: []
    };
  },
  computed: {
    ...mapGetters(["getLoggedInStatus", "getUserList"])
  },
  watch: {
    getUserList() {
      this.users = this.$store.getters.getUserList;
    },
    getLoggedInStatus() {
      console.log("hello redirect");
      this.redirectToNavigation(this.$store.getters.getLoggedInStatus);
    }
  },
  created() {
    // if the user is logged out then redirect to landing page
    if (this.$store.getters.getLoggedInStatus == false) {
      this.$router.push({ name: "landingPage" });
    }
    this.users = this.$store.getters.getUserList;
  },
  methods: {
    populateUsersTable() {
      this.$store.dispatch("populateUsersList");
    },
    redirectToNavigation(status) {
      // if the user is logged out then return to landing page, if the user is logged then rediredct to welcome page
      if (status == false) {
        this.$router.push({ name: "landingPage" });
      }
    }
  },
  mounted() {
    console.log("hello kmounted");
    this.$store.dispatch("fetchUserList");
  }
};
</script>

<style>
</style>
