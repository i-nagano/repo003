<template>
    <div>
        <v-container class="mt-2">
            <v-row class="mt-2" justify="start">
                <h2>Home Test</h2>
            </v-row>
            <v-row class="mt-2" justify="start">
                <ul>
                    <li>Test1</li>
                    <li>Test2</li>
                    <li>Test3</li>
                </ul>
            </v-row>
        </v-container>
        <google-maptest></google-maptest>
    </div>
</template>

<script>
    import GoogleMaptest from './GoogleMaptest.vue'
    export default {
        name: "Home",
        components: {
            GoogleMaptest,
        },
    };
</script>

<style scoped>
    ul {
        list-style: none;
    };
</style>>
