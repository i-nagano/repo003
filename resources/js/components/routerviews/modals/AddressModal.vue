<template>
    <div class="bg" v-on:click.self="$emit('close')">
        <div class="modal">
            <div class="modal-header">
                <p class="modal-title">
                    <slot name="header">タイトル</slot>
                </p>
                <i class="modal-close" fas fa-teimes v-on:click="$emit('close')"></i>
            </div>
            <div class="modal-body">
                <slot name="body"></slot>
            </div>
            <div class="modal-footer">
                <slot name="footer"></slot>
            </div>
        </div>
    </div>
</template>

<script>
    import axios from '../axios-auth.js';
    export default {
        name: 'AddressModal',
        components: {},
        data: function () {
            return {

            };
        },
        created: function () {},
    };
</script>

<style scoped>

</style>
