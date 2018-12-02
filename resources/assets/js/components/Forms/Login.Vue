<template>
  <v-container>
    <v-form @submit.prevent="login">
      <v-text-field v-model="form.email" label="E-mail" type="email" required></v-text-field>

      <v-text-field v-model="form.password" label="Password" type="password" required></v-text-field>

      <v-btn color="green" type="submit">Login</v-btn>

      <router-link to="/signup">
        <v-btn color="blue" type="submit">Sign Up</v-btn>
      </router-link>
    </v-form>
  </v-container>
</template>

<script>
import { mapGetters } from "vuex";
export default {
  data() {
    return {
      form: {
        email: null,
        password: null
      }
    };
  },
  created() {
    if (this.$store.getters.getLoggedInStatus) {
      this.$router.push({ name: "landingPage" });
    }
  },
  methods: {
    login() {
      this.$store.dispatch("login", this.form);
      this.$router.push({ name: "navigation" });
    },
    recomputeItems() {
      return this.$store.dispatch("setItems");
    }
  }
};
</script>

<style>
</style>
