<template>
  <div>
    <v-container class="mt-12">
      <v-row class="mt-12" justify="start">
        <router-link to="/">
          <span> | Home | </span>
        </router-link>
        <router-link to="members">
          <span> Members | </span>
        </router-link>
        <router-link to="cars">
          <span> Cars | </span>
        </router-link>
        <router-link to="address">
          <span> Address | </span>
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

<style lang="" scoped>

</style>
