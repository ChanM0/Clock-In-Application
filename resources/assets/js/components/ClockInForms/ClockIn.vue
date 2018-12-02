<template>
  <v-container fluid class="pa-0">
    <v-form @submit.prevent="clockin">
      <v-layout row wrap align-center>
        <v-flex m12>
          <div class="text-xs-center">Clock In
            <div>
              <v-btn color="primary" type="submit" fab large>
                <v-icon>alarm</v-icon>
              </v-btn>
            </div>
          </div>
        </v-flex>
      </v-layout>
    </v-form>
  </v-container>
</template>


<script>
import { mapGetters } from "vuex";
export default {
  computed: {
    ...mapGetters(["getLoggedInStatus"])
  },
  watch: {
    getLoggedInStatus() {
      console.log("hello i am beeing watch:clockin");
      this.redirectToNavigation(this.$store.getters.getLoggedInStatus);
    }
  },
  created() {
    // if (this.$store.getters.getLoggedInStatus != false) {
    //   this.$router.push({ name: "landingPage" });
    // }
  },
  methods: {
    getDateTime() {
      var dateTime = new Date(),
        dformat =
          [
            dateTime.getMonth() + 1,
            dateTime.getDate(),
            dateTime.getFullYear()
          ].join("/") +
          "__" +
          [
            dateTime.getHours() + 14,
            dateTime.getMinutes(),
            dateTime.getSeconds()
          ].join(":");
      return dateTime;
    },
    clockin() {
      let data = [
        {
          time_in: this.getDateTime(),
          token: this.$store.getters.getToken
        }
      ];
      this.$store.dispatch("clockin", data);
    },
    redirectToNavigation(status) {
      console.log(status);
      if (status == false) {
        this.$router.push({ name: "landingPage" });
      }
    }
  }
};
</script>

<style>
.text-xs-center {
  padding: 15%;
  text-emphasis: size;
  font-size: 25pt;
}
</style>
