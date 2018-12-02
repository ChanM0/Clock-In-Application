
<template>
  <v-toolbar>
    <v-toolbar-title>SPA-Forum</v-toolbar-title>
    <v-spacer></v-spacer>
    <div class="hidden-sm-and-down">
      <router-link v-for="item in routeList" :key="item.title" :to="item.to" v-if="item.show">
        <v-btn flat>{{item.title}}</v-btn>
      </router-link>
    </div>
  </v-toolbar>
</template>
 <script>
export default {
  computed: {
    routeList: store.getters.getRoutelList()
  }
};
</script>
 <style>
</style>