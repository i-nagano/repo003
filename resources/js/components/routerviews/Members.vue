<template>
  <div>
    <div class="container mt-12">
      <div class="row mt-6" justify="start">
        <h2>Members Test</h2>
      </div>
      <div class="row mt-6" justify="start">
        <ul>
          <li>
            <label for="name">名前:</label>
            <input type="text" name="name" id="name" v-model="name" />
          </li>
          <li>
            <label for="email">E-mail:</label>
            <input type="email" name="email" id="email" v-model="email" />
          </li>
        </ul>
      </div>
      <div class="row mt-6" justify="start">
        <div class="card" color="" width="">
          <p>New Member is . . .</p>
        </div>
        <div class="card" color="" width="">
          <p> {{ $data.name }}</p>
        </div>
        <div class="card" color="" width="">
          <p> {{ $data.email }}</p>
        </div>
      </div>
      <br />
      <div class="row mt-6" justify="start">
        <button v-on:click="postMember" class="btn btn-outline-dark">
          登録
        </button>
      </div>
    </div>
    <br />
    <div class="container mt-10">
      <div class="row mt-6" justify="start">
        <table class="table table-sm table-responsive table-bordered">
          <thead>
            <tr>
              <th>
                <button
                  v-on:click="sortBy('id')"
                  v-bind:ckass="sortedClass('id')"
                >
                  ID
                </button>
              </th>
              <th>
                <button
                  v-on:click="sortBy('name')"
                  v-bind:ckass="sortedClass('name')"
                >
                  名前
                </button>
              </th>
              <th>
                <button
                  v-on:click="sortBy('email')"
                  v-bind:ckass="sortedClass('email')"
                >
                  E-mail
                </button>
              </th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="member in eventedAction" v-bind:key="member.id">
              <td>
                {{ member.id }}
              </td>
              <td>
                {{ member.name }}
              </td>
              <td>
                {{ member.email }}
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "Members",
  components: {},
  data: function () {
    return {
      name: "",
      email: "",
      members: [],
      sort: {
        key: "", // ソートキー
        isAsc: false, // 昇順ならtrue,降順ならfalse
      },
    };
  },
  mounted: function () {
    this.getMembers();
  },
  computed: {
    eventedAction: function () {
      let list = this.members.slice();
      // ソート実施
      if (this.sort.key) {
        list.sort((a, b) => {
          a = a[this.sort.key];
          b = b[this.sort.key];
          return (a === b ? 0 : a > b ? 1 : -1) * (this.sort.isAsc ? 1 : -1);
        });
      }
      return list;
    },
  },
  methods: {
    getMembers() {
      axios
        .get("/api/members")
        .then((response) => {
          this.members = response.data;
          return console.log(response.data);
        })
        .catch((error) => {
          this.message = error.response.data;
          return console.log(error.response.data);
        });
    },
    postMember() {
      axios
        .post("/api/members", {
          name: this.name,
          email: this.email,
        })
        .then((response) => {
          this.getMembers(), (this.name = "");
          this.email = "";
        })
        .catch((error) => {
          this.message = error.response.data;
          return console.log(error.message.data);
        });
    },
    // sort用キーをセットし、昇順・降順を入れ替える
    sortBy: function (key) {
      this.sort.isAsc = this.sort.key === key ? !this.sort.isAsc : false;
      this.sort.key = key;
    },
    sortedClass: function (key) {
      return this.sort.key === key
        ? `sorted ${this.sort.isAsc ? "asc" : "desc"}`
        : "";
    },
  },
};
</script>

<style lang="" scoped>
</style>
