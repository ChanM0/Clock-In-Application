<template></template>

<script>
import { mapGetters } from "vuex";
export default {
  created() {
    this.$store.dispatch("logout");
  }
};
</script>

<style>
</style>
