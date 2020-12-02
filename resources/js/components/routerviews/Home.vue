<template>
    <div>
        <v-container class="mt-2">
            <v-row class="mt-2" justify="start">
                <h4>Home</h4>
            </v-row>
            <v-row class="mt-2" justify="start">
                <ul>
                    <li>Test1</li>
                    <li>Test2</li>
                    <li>Test3</li>
                    <li>
                        <googlemap-sample></googlemap-sample>
                    </li>
                </ul>
            </v-row>
        </v-container>
    </div>
</template>

<script>
    import GooglemapSample from './GooglemapSample.vue';
    export default {
        name: "Home",
        components: {
            GooglemapSample,
        },
    };
</script>

<style scoped>
    ul {
        list-style: none;
    };
</style>>
