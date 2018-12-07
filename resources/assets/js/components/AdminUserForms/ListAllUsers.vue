<template>
  <v-container>
    <v-form @submit.prevent="populateUsersTable">
      <v-btn color="green" type="submit">Get All Users</v-btn>
    </v-form>
    <!-- <v-data-table :items="users" class="elevation-1">
      <template slot="items" slot-scope="props">
        <td>{{ props.item.id }}</td>
        <td class="text-xs-right">{{ props.item.username }}</td>
      </template>
    </v-data-table>-->
  </v-container>
</template>

<script>
import { mapGetters } from "vuex";
export default {
  data() {
    return {
      users: null
    };
  },
  computed: {
    ...mapGetters(["getLoggedInStatus", "getUserList"])
  },
  watch: {
    getUserList() {
      console.log(this.$store.getters.userList);
      this.users = this.$store.getters.userList;
    }
  },
  created() {},
  methods: {
    populateUsersTable() {
      this.$store.dispatch("populateUsersList");
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
