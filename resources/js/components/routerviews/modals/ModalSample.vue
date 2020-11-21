<template>
    <div class="bg" v-on:click="$emit('close')">
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
export default {

}
</script>

<style scoped>

</style>
