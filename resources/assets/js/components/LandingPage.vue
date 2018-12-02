<template>
  <div>
    <app-nav-bar></app-nav-bar>
    <!-- <router-view></router-view> -->
    <app-footer></app-footer>
  </div>
</template>
 <script>
import AppNavBar from "./AppNavBar";
import AppFooter from "./AppFooter";
export default {
  components: { AppNavBar, AppFooter }
};
</script>
 <style>
</style>