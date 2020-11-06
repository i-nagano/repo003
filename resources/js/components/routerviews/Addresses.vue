<template>
  <div>
    <v-container>
      <v-row>
        <ul class="list-unstyled">
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
      <v-row>
        <table></table>
      </v-row>
    </v-container>
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
        addresses: [],
        comment: "",
        message: "",
    };
  },
  mounted: function() {
      this.getAddresses();
      this.getMembers();
      this.getCars();
  },
  computed: function() {
  },
  methods: {
    getAddresses() {
      axios
        .get('/api/addresses')
        .then(response => {
            this.Addresses = response.data;
            return console.log(response.data);
        })
        .catch(error => {
            this.message = error.response.data;
            return console.log(error.response.data);
        });
    },
    getMembers() {
        axios
          .get('/members')
          .then(response => {
              this.members = response.data;
              return console.log(response.data);
          })
          .cacth(error => {
              this.message = error.response.data;
              return console.log(error.response.data);
          })
    },
    getCars() {
        axios
          .get('/cars')
          .then(response => {
              this.cars = response.data;
              return console.log(response.data);
          })
          .cacth(error => {
              this.message = error.response.data;
              return console.log(error.response.data);
          });
    },
  },
};
</script>

<style scoped>

</style>
