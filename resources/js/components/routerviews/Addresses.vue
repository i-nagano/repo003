<template>
    <div>
        <v-container class="mt-2" justify="start">
            <v-row class="mt-2" justify="start">
                <h2>Addresses Test</h2>
            </v-row>
            <v-row>
                <ul>
                    <li>
                        <label for="parkdate">駐車日時:</label>
                        <input type="date" name="parkdate" id="parkdate" v-model="$data.parkdate" />
                    </li>
                    <li>
                        <label for="member_name">担当者:</label>
                        <select name="member_name" id="member_name" v-model="$data.member_name">
                            <option disabled value="">選択してください</option>
                            <option v-for="member in members" v-bind:key="member.id" v-bind:value="member.name">
                                {{ member.name }}
                            </option>
                        </select>
                    </li>
                    <li>
                        <label for="car_name">自車名:</label>
                        <select name="car_name" id="car_name" v-model="$data.car_name">
                            <option disabled value="">選択してください</option>
                            <option v-for="car in cars" v-bind:key="car.id" v-bind:value="car.name">
                                {{ car.name }}
                            </option>
                        </select>
                    </li>
                    <li>
                        <label for="place">駐車場所:</label>
                        <input type="text" name="place" id="place" v-model="$data.place" />
                    </li>
                    <li>
                        <label for="comment">コメント:</label>
                        <input type="text" name="comment" id="comment" v-model="$data.comment" />
                    </li>
                </ul>
            </v-row>
            <v-row class="mt-2" justify="start">
                <button v-on:click="postAddress" class="btn btn-outline-dark">
                    登録
                </button>
            </v-row>
            <br>
            <v-row>
                <table class="table table-sm table-responsive">
                    <thead>
                        <tr>
                            <th>駐車日時</th>
                            <th>担当者名</th>
                            <th>自車名</th>
                            <th>駐車場所</th>
                            <th>コメント</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="address in addresses" v-bind:key="address.id">
                            <td>
                                {{ address.parkdate }}
                            </td>
                            <td>
                                {{ address.member_name }}
                            </td>
                            <td>
                                {{ address.car_name }}
                            </td>
                            <td>
                                {{ address.place }}
                            </td>
                            <td>
                                {{ address.comment }}
                            </td>
                            <td>
                                <a href="">編集</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
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
                place: "",
                addresses: [],
                comment: "",
                message: "",
            };
        },
        mounted: function () {
            this.getAddresses();
            this.getMembers();
            this.getCars();
        },
        computed: {},
        methods: {
            getAddresses() {
                axios
                    .get("/api/addresses")
                    .then(response => {
                        this.addresses = response.data;
                        return console.log(response.data);
                    })
                    .catch(error => {
                        this.message = error.response.data;
                        return console.log(error.response.data);
                    });
            },
            getMembers() {
                axios
                    .get("/api/members")
                    .then(response => {
                        this.members = response.data;
                        return console.log(response.data);
                    })
                    .catch(error => {
                        this.message = error.response.data;
                        return console.log(error.response.data);
                    });
            },
            getCars() {
                axios
                    .get("/api/cars")
                    .then(response => {
                        this.cars = response.data;
                        return console.log(response.data);
                    })
                    .catch(error => {
                        this.message = error.response.data;
                        return console.log(error.response.data);
                    });
            },
            postAddress() {
                axios
                    .post("/api/addresses", {
                        parkdate: this.parkdate,
                        member_name: this.member_name,
                        car_name: this.car_name,
                        place: this.place,
                        comment: this.comment,
                    })
                    .then(response => {
                        this.getAddresses();
                        this.parkdate = "";
                        this.member_name = "";
                        this.car_name = "";
                        this.place = "";
                        this.comment = "";
                        this.address = response.data;
                        return console.log(response.data);
                    })
                    .catch(error => {
                        this.message = error.response.data;
                        return console.log(error.response.data);
                    });
            },
        },
    };
</script>

<style scoped>
    ul {
        list-style: none;
    }
</style>
