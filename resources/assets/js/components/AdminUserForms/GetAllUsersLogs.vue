<template>
  <v-container>
    <v-form @submit.prevent="populateUsersLogs">
      <v-btn color="green" type="submit">Get All logs for user: {{username}}</v-btn>
    </v-form>
    <div>
      <ul>
        <li v-for="log in userlogs" :key="log.id">
          <ul>
            <li>User: {{log.user_id_to_username.username}}</li>
            <li>Time In: {{log.time_in}}</li>
            <li>Time Out: {{log.time_out}}</li>
          </ul>
          <br>
          <br>
        </li>
      </ul>
    </div>
  </v-container>
</template>

<script>
import { mapGetters } from "vuex";
export default {
  data() {
    return {
      username: this.$route.params.username,
      userlogs: null
    };
  },
  computed: {
    ...mapGetters(["getLoggedInStatus", "getAllUserLogs"])
  },
  watch: {
    getAllUserLogs() {
      this.userlogs = this.$store.getters.getAllUserLogs;
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
    populateUsersLogs() {
      let data = { username: this.username };
      this.$store.dispatch("getAllUsersLogs", data);
    },
    redirectToNavigation(status) {
      // if the user is logged out then return to landing page, if the user is logged then rediredct to welcome page
      if (status == false) {
        this.$router.push({ name: "landingPage" });
      }
    }
  },
  mounted() {
    this.$store.dispatch("fetchAllUsersLogs");
  }
};
</script>

<style>
</style>
