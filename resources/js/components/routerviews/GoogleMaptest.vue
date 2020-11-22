<template>
    <div>
        <v-container class="mt-2" justify="start">
            <v-row class="mt-2" justify="start">
                <ul>
                    <li>
                        <label for="address">住所入力:</label>
                        <input type="text" v-model="address">
                    </li>
                    <li>
                        <label for="apiKey">キー入力:</label>
                        <input type="text" v-model="apiKey">
                    </li>
                    <li>
                        <button v-on:click="getLatlng" class="btn btn-outline-dark">送信</button>
                    </li>
                    <li>
                        <button v-on:click="getGeo" class="btn btn-outline-dark">取得</button>
                    </li>
                    <li>
                        <label for="locarion">緯度経度:</label>
                        <p v-for="location in result" v-bind:key="location.lat">{{ location }}</p>
                    </li>
                    <li>
                        <label for="message">メッセージ:</label>
                        <p>{{ message }}</p>
                    </li>
                </ul>
            </v-row>
        </v-container>
    </div>
</template>

<script>
    import GoogleMapsApiLoader from 'google-maps-api-loader';
    export default {
        name: 'GoogleMaptest',
        data: function () {
            return {
                address: "",
                apiKey: "AIzaSyDJtNib0zPv9am7TfY36kE_lKBi-mB4e7o",
                location: "",
                result: "",
                message: "",
            };
        },
        mounted: function () {},
        created: function () {},
        methods: {
            getLatlng() {
                let address = this.address;
                let apiKey = this.apiKey;
                let getUrl = 'https://maps.googleapis.com/maps/api/geocode/json?address=' + address + '&language=Ja&key=' + apiKey;
                axios
                    .get(getUrl)
                    .then(response => {
                        this.location = response.data;
                        return console.log(response.data);
                    })
                    .catch(error => {
                        this.message = error.response;
                        return console.log(error.response);
                    })
            },
            getGeo() {
                let apiKey = this.apiKey;
                let src = "https://maps.google.com/maps/api/js?key=" + apiKey;
                let geocoder = new google.maps.Geocoder();
                geocoder.geocode({
                        address: this.address,
                        language: 'japanese',
                        region: 'jp',
                    },
                    function (results, satus) {
                        if (status === google.map.Geocoder.OK) {
                            // 結果の表示範囲。結果が１つとは限らないので、LatLngBoundsで用意。
                            let bounds = new google.maps.LatLngBounds();
                            for (let i in results) {
                                if (results[i].geometry) {
                                    // 緯度経度を取得。
                                    let latlng = results[i].geometry.location;
                                    return console.log(latlng);
                                    // 住所を取得(日本の場合だけ「日本, 」を削除)。
                                    let address = results[0].formatted_address.replace(/^日本, /, '');
                                    return console.log(address);
                                };
                            };
                        }
                    }
                );
            },
        },
    };
</script>

<style scoped>
    ul {
        list-style: none;
    }
</style>
