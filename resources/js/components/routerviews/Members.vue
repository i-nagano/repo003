<template>
  <div>
    <v-container class="mt-12">
      <v-row class="mt-6" justify="start">
        <h2>Members Test</h2>
        <label for="name">名前:</label>
        <input type="text" name="name" id="name" v-model="name" />
        <label for="email">E-mail</label>
        <input type="email" name="email" id="email" v-model="email">
      </v-row>
    </v-container>
  </div>
</template>

<script>
export default {
  name: "Members",
  components: {},
  data: function() {
      return {
          name: '',
          email: '',
          members: [],
      };
  },
  methods: {
      getMember() {
          axios
          .get('/members')
          .then(response =>{
              this.members = response.data;
              return console.log(response.data);
              })
          .catch(error =>{
             this.message = error.response.data;
             return console.log(error.response.data);
            })
      }
  },
};
</script>

<style lang="" scoped>

</style>
