<template>
    <div>
        <header>
            <navbar></navbar>
        </header>
        <main>
            <router-view></router-view>
        </main>
        <foot></foot>
    </div>
</template>

<script>
import Navbar from './components/Navbar.vue';
import Foot from './components/Footer.vue';

export default {
    name: 'App',
    components: {
        Navbar,
        Foot,
    },
};
</script>

<style lang="" scoped>

</style>

