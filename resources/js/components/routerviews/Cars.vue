<template>
    <div>
        <v-container class="mt-2">
            <v-row class="mt-2" justify="start">
                <h2>Cars Test</h2>
            </v-row>
            <v-row class="mt-2" justify="start">
                <ul>
                    <li>
                        <label for="name">自車名: </label>
                        <input type="text" v-model="$data.name" />
                    </li>
                    <li>
                        <label for="number">自車No.: </label>
                        <input type="text" v-model="$data.number" />
                    </li>
                </ul>
            </v-row>
            <v-row>
                <button v-on:click="postCar" class="btn btn-outline-dark">登録</button>
            </v-row>
            <br>
            <v-row class="mt-2" justify="start">
                <label for="keyword">検索:</label>
                <input type="text" name="keyword" id="keyword" v-model="keyword" placeholder="Search..." />
            </v-row>
            <v-row class="mt-2" justify="start">
                <table class="table table-sm table-responsive">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>自車名</th>
                            <th>自車No.</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="car in filterCars" v-bind:key="car.id">
                            <td>
                                {{ car.id }}
                            </td>
                            <td>
                                {{ car.name }}
                            </td>
                            <td>
                                {{ car.number }}
                            </td>
                            <td>
                                <button v-on:click="openModal(car)">編集</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </v-row>
            <car-modal v-bind:carData="carUpdate" v-on:input="childCar=$event" v-show="showContent" v-on:close="closeModal" v-on:update="getCars"></car-modal>
            <v-row id="message" v-show="message" class="mt-2" justify="start">
                <p>エラーメッセージ: {{ message }}</p>
            </v-row>
        </v-container>
    </div>
</template>

<script>
    import CarModal from './modals/CarModal.vue';
    export default {
        name: 'Cars',
        components: {
            CarModal,
        },
        data: function () {
            return {
                showContent: false,
                message: "",
                name: "",
                number: "",
                cars: [],
                carUpdate: "",
                keyword: "",
            };
        },
        mounted: function () {
            this.getCars();
        },
        methods: {
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
            postCar() {
                axios
                    .post("/api/cars", {
                        name: this.name,
                        number: this.number,
                    })
                    .then(response => {
                        this.getCars();
                        this.name = "";
                        this.number = "";
                        this.car = response.data;
                        return console.log(response.data);
                    })
                    .catch(error => {
                        this.message = error.response.data;
                        return console.log(error.response.data);
                    });
            },
            filteredCars() {
                let cars = [];
                for (let i in this.cars) {
                    let car = this.cars[i];
                    if (car.name.indexOf(this.keyword) !== -1 ||
                        car.number.indexOf(this.keyword) !== -1) {
                        cars.push(car);
                    }
                }
                return cars;
            },
            openModal(car) {
                this.showContent = true;
                this.carUpdate = car;
            },
            closeModal(car) {
                this.showContent = false;
            },
        },
        computed: {
            filterCars: function () {
                return this.filteredCars();
            },
        },
    };
</script>

<style scoped>
    ul {
        list-style: none;
    }
</style>
