<template>
    <div>
        <v-container class="mt-2" justify="start">
            <v-row class="mt-2" justify="start">
                <ul>
                    <li>
                        <label for="address">住所入力:</label>
                        <input type="text" v-model="address.place">
                    </li>
                    <li>
                        <label for="apiKey">キー入力:</label>
                        <input type="text" v-model="apiKey">
                    </li>
                    <li>
                        <button v-on:click="mapSearch" class="btn btn-outline-dark">取得</button>
                    </li>
                </ul>
            </v-row>
            <v-row class="mt-2" justify="start">
                <ul>
                    <li>
                        <label for="lat">緯度:</label>
                        <input type="text" v-model="mapConfig.center.lat">
                    </li>
                    <li>
                        <label for="lat">経度:</label>
                        <input type="text" v-model="mapConfig.center.lng">
                    </li>
                    <li>
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
        name: 'GooglemapSample',
        components: {},
        props: {},
        data: function () {
            return {
                apiKey: "AIzaSyDJtNib0zPv9am7TfY36kE_lKBi-mB4e7o",
                address: [],
                map: {},
                marker: null,
                mapConfig: {
                    center: {
                        lat: 35.68,
                        lng: 139.76,
                    },
                    zoom: 15,
                },
            };
        },
        mounted: function () {
            this.mapSearch();
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
            async mapSearch() {
                let google = await GoogleMapsApiLoader({
                    apiKey: this.apiKey,
                    libraries: ['places'],
                });
                let geocoder = new google.maps.Geocoder();
                geocoder.geocode({
                        address: this.address.place,
                        region: 'jp'
                    },
                    (results, status) => {
                        if (status === google.maps.GeocoderStatus.OK) {
                            let lat = this.mapConfig.center.lat = results[0].geometry.location.lat();
                            let lng = this.mapConfig.center.lng = results[0].geometry.location.lng();
                            let address = results[0].address_components;
                            let latlng = results[0].geometry.location;
                            return console.log(address, latlng, lat, lng);
                        };
                    });
                return this.initializeMap();
            },
            initializeMap() {
                this.map = new google.maps.Map(document.getElementById('map'), this.mapConfig);
            },
        },
    };
</script>

<style scoped>
    ul {
        list-style: none;
    }

    .map {
        width: 70vw;
        height: 50vh;
    }
</style>
