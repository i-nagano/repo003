<template>
    <div>
        <v-container class="mt-2" justify="start">
            <v-row class="mt-2" justify="start">
                <ul>
                    <li>
                        <label for="address">住所入力:</label>
                        <input type="text" v-model="address.place">
                    </li>
                    <!-- <li>
                        <label for="apiKey">キー入力:</label>
                        <input type="text" v-model="apiKey">
                    </li> -->
                    <li>
                        <button v-on:click="mapGenerate" class="btn btn-outline-dark">地図</button>
                    </li>
                </ul>
            </v-row>
            <v-row class="mt-2" justify="start">
                <ul>
                    <li>
                        <label for="lat">緯度:</label>
                        <input type="text" v-model="lat">
                    </li>
                    <li>
                        <label for="lat">経度:</label>
                        <input type="text" v-model="lng">
                    </li>
                    <li v-show="$data.active">
                        <div id="map" class="map"></div>
                    </li>
                </ul>
            </v-row>
        </v-container>
    </div>
</template>

<script>
    import GoogleMapsApiLoader from 'google-maps-api-loader';
    import axios from './axios-auth.js';
    export default {
        name: 'DestinationMap',
        components: {},
        props: {},
        data: function () {
            return {
                apiKey: "AIzaSyDJtNib0zPv9am7TfY36kE_lKBi-mB4e7o",
                address: [],
                map: {},
                geocoder: {},
                marker: null,
                lat: '',
                lng: '',
                active: false,
            };
        },
        mounted: function () {
            this.initializeMap();
        },
        created: function () {
            this.getAddress();
        },
        computed: {},
        methods: {
            getAddress() {
                axios
                    .get('/api/addresses/' + this.$route.params.id)
                    .then(response => {
                        this.address = response.data;
                        return console.log(response.data);
                    })
                    .catch(erorr => {
                        this.message = error.response.data;
                        return console.log(error.response.data);
                    });
            },
            initializeMap() {
                this.map = new google.maps.Map(document.getElementById('map'), {
                    zoom: 15,
                });
                this.geocoder = new google.maps.Geocoder();
            },
            async mapSearch() {
                let google = await GoogleMapsApiLoader({
                    apiKey: this.apiKey,
                    libraries: ['places'],
                });
                this.geocoder.geocode({
                    address: this.address.place,
                    region: 'jp'
                    },
                    (results, status) => {
                        if (status === google.maps.GeocoderStatus.OK) {
                            this.map.setCenter(results[0].geometry.location);
                            this.lat = results[0].geometry.location.lat();
                            this.lng = results[0].geometry.location.lng();
                            let location = results[0].address_components;
                            this.marker = new google.maps.Marker({
                                map: this.map,
                                position: results[0].geometry.location
                            });
                            return console.log(location);
                        };
                    });
                return this.initializeMap();
            },
            isActive() {
                return this.active = !this.active;
            },
            mapGenerate() {
                this.mapSearch();
                this.isActive();
            },
        },
    };
</script>

<style scoped>
    ul {
        list-style: none;
    }

    .map {
        width: 90vw;
        height: 80vh;
    }
</style>
