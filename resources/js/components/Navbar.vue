<template>
    <div>
        <router-link to="/">
            <span>Home</span>
        </router-link>
        <router-link to="members">
            <span>Members</span>
        </router-link>
        <router-link to="cars">
            <span>Cars</span>
        </router-link>
        <router-link to="example">
            <span>Example</span>
        </router-link>
    </div>
</template>

<script>
    export default {
        name: 'Navbar',

    }
</script>

<style lang="" scoped>

</style>
