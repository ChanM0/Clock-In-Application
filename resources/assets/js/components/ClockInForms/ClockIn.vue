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
    addZero(i) {
      if (i < 10) {
        i = "0" + i;
      }
      return i;
    },
    getTime() {
      var d = new Date();
      var h = this.addZero(d.getHours());
      var m = this.addZero(d.getMinutes());
      var s = this.addZero(d.getSeconds());
      return h + ":" + m + ":" + s;
    },
    clockin() {
      let data = {
        user_id: this.$store.getters.getUserId,
        time: this.getTime()
      };
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
