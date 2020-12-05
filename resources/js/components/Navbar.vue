<template>
  <div>
    <v-container class="mt-2">
      <v-row class="mt-2" justify="start">
        <router-link to="/">
          <span>Home</span>|
        </router-link>
        <router-link to="members">
          <span>Members</span>|
        </router-link>
        <router-link to="cars">
          <span>Cars</span>|
        </router-link>
        <router-link to="addresses">
          <span>Addresses</span>
        </router-link>
      </v-row>
    </v-container>
  </div>
</template>

<script>
export default {
  name: "Navbar",
};
</script>

<style scoped>

</style>
