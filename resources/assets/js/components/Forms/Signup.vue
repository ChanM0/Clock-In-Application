	<template>
  <v-container>
    <v-form @submit.prevent="signup">
      <v-text-field v-model="form.username" label="username" type="text" required></v-text-field>
      <v-text-field v-model="form.email" label="E-mail" type="email" required></v-text-field>
      <v-text-field v-model="form.password" label="Password" type="password" required></v-text-field>
      <v-text-field
        v-model="form.password_confirmation"
        label="Password Confirmation"
        type="password"
        required
      ></v-text-field>
      <v-btn color="green" type="submit">Signup</v-btn>
    </v-form>
  </v-container>
</template>
 <script>
import { mapGetters } from "vuex";
export default {
  data() {
    return {
      form: {
        username: null,
        email: null,
        password: null,
        password_confirmation: null
      }
    };
  },
  computed: {
    ...mapGetters(["getLoggedInStatus"])
  },
  watch: {
    getLoggedInStatus() {
      console.log("hello i am beeing watch:signup");
      this.redirectToNavigation(this.$store.getters.getLoggedInStatus);
    }
  },
  created() {
    if (this.$store.getters.getLoggedInStatus != false) {
      this.$router.push({ name: "landingPage" });
    }
  },
  methods: {
    signup() {
      this.$store.dispatch("signup", this.form);
      if (this.$store.getters.getLoggedInStatus) {
        this.$router.push({ name: "navigation" });
      }
    },
    redirectToNavigation(status) {
      if (status == false) {
        this.$router.push({ name: "landingPage" });
      } else {
        this.$router.push({ name: "navigation" });
      }
    }
  }
};
</script>