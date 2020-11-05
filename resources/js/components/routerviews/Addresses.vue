<template>
  <div>
    <v-container>
      <v-row>
        <ul>
          <li>
            <label for="parkdate">駐車場日時:</label>
            <input type="date" name="parkdate" id="parkdate" v-model="parkdate" />
          </li>
          <li>
              <label for="member_name">担当者</label>
              <select name="member_name" id="menber_name" v-model="member_name">
                  <option disabled value="">選択してください</option>
                  <option v-for="member in members" v-bind:key="member.id" v-bind:value="member.name">
                      {{ $data.name }}
                  </option>
              </select>
              <input type="text" name="" id="">
          </li>
          <li></li>
          <li></li>
          <li></li>
        </ul>
      </v-row>
    </v-container>
    <v-contai>
      <v-row>
        <table></table>
      </v-row>
    </v-contai>
  </div>
</template>

<script>
export default {
  name: "Addresses",
  components: {},
  data: function () {
    return {
        parkdate: "",
        member_name: "",
        members: [],
        car_name: "",
        cars: [],
        address: "",
        comment: "",
    };
  },
  mounted: {},
  computed: {},
  methods: {
    getAddresses() {
      axios.get('/api/addresses');
    },
    getMembers() {},
    getCars() {},
  },
};
</script>

<style lang="" scoped>

</style>
