<template>
    <div>
        <v-container class="mt-2" justify="start">
            <v-row class="mt-2" justify="start">
                <h2>Addresses Test</h2>
            </v-row>
            <v-row>
                <ul>
                    <li>
                        <label for="parkdate">駐車日:</label>
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
                        <label for="car_name">車名:</label>
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
                            <th>
                                <button v-on:click="sortBy('parkdate')" v-bind:class="sortedClass('parkdate')">
                                    駐車日
                                </button>
                            </th>
                            <th>
                                <button v-on:click="sortBy('member_name')" v-bind:class="sortedClass('member_name')">
                                    担当者
                                </button>
                            </th>
                            <th>
                                <button v-on:click="sortBy('car_name')" v-bind:class="sortedClass('car_name')">
                                    自車名
                                </button>
                            </th>
                            <th>
                                <button v-on:click="sortBy('place')" v-bind:class="sortedClass('place')">
                                    駐車場所
                                </button>
                            </th>
                            <th>
                                <button v-on:click="sortBy('comment')" v-bind:class="sortedClass('comment')">
                                    コメント
                                </button>
                            </th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="address in sortedAdresses" v-bind:key="address.id">
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
                                <router-link :to="{name: 'DestinationMap', params: { id: address.id }}">
                                    {{ address.place }}
                                </router-link>
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
            <v-row id="message" v-show="message" class="mt-2" justify="start">
                <p>エラーメッセージ: {{ message }}</p>
            </v-row>
        </v-container>
    </div>
</template>

<script>
    import axios from './axios-auth.js';
    import DestinationMap from './DestinationMap.vue';
    import AddressModal from './modals/AddressModal.vue';
    export default {
        name: "Addresses",
        components: {
            DestinationMap,
            AddressModal,
        },
        props: {},
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
                sort: {
                    key: "", // ソートキー
                    isAsc: false, // 昇順ならtrue,降順ならfalse
                },
            };
        },
        mounted: function () {
            this.getAddresses();
            this.getMembers();
            this.getCars();
        },
        computed: {
            sortedAdresses: function () {
                let list = this.addresses.slice();
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
            getAddresses() {
                axios
                    .get('/api/addresses')
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
                    .get('/api/members')
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
                    .get('/api/cars')
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
                    .post('/api/addresses', {
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
            // sort用キーをセットし、昇順・降順を入れ替える
            sortBy: function (key) {
                this.sort.isAsc = this.sort.key === key ? !this.sort.isAsc : false;
                this.sort.key = key;
            },
            sortedClass: function (key) {
                return this.sort.key === key ?
                    `sorted ${this.sort.isAsc ? "asc" : "desc"}` :
                    "";
            },
        },
    };

</script>

<style scoped>
    ul {
        list-style: none;
    }
</style>
