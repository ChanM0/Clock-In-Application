<template>
  <v-container>
    <v-form @submit.prevent="populateLogsOnThisDay">
      <v-text-field v-model="form.date" label="Date: " type="date" required></v-text-field>
      <v-btn color="green" type="submit">Get Logs</v-btn>
    </v-form>
    <div>
      <ul>
        <li v-for="log in logsOnThisDay" :key="log.id">
          <ol>
            <li>{{log.time_in}}</li>
            <li>{{log.time_out}}</li>
            <li>{{log.day_of}}</li>
          </ol>
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
      logsOnThisDay: null,
      form: {
        date: null
      }
    };
  },
  computed: {
    ...mapGetters(["getLoggedInStatus", "getLogsOnThisDay"])
  },
  watch: {
    getLogsOnThisDay() {
      this.logsOnThisDay = this.$store.getters.getLogsOnThisDay;
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
    populateLogsOnThisDay() {
      let data = this.form;
      this.$store.dispatch("getLogsOnThisDay", data);
    },
    redirectToNavigation(status) {
      // if the user is logged out then return to landing page, if the user is logged then rediredct to welcome page
      if (status == false) {
        this.$router.push({ name: "landingPage" });
      }
    }
  },
  mounted() {
    console.log("mounted");
    this.$store.dispatch("fetchLogsOnThisDay");
  }
};
</script>

<style>
</style>
