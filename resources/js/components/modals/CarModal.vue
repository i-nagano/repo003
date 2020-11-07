<template>
    <div id="overlay">
        <div id="content">
            <p>ID: {{ data.id }}</p>
            <p>自車名: {{ data.name }}</p>
            <p>自車No.: {{ data.number }}</p>
            <button v-on:click="$emit('close')">更新</button>
            <button v-on:click="$emit('close')">削除</button>
            <button v-on:click="$emit('close')">閉じる</button>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'CarModal',
        components: {},
        props: ['data'],
        methods: {
            updateCar() {
                const id = '1000';  //'id'を仮に設定
                const modify = { name: 'hoge' };  //'modify'を仮に設定
                axios
                    .put('/api/sample/' + id, modify)
                    .then(res => {
                        alert("「" + modify.name + "」更新完了");
                        this.$router.push({
                            path: '/articles/list'
                        });
                    })
                    .catch(error => {
                        alert("「" + modify.name + "」更新失敗");
                        console.log(error, id, modify);
                    });
            }
        },
    }
</script>

<style scoped>
    #overlay {
        z-index: 1;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.2);
        display: flex;
        align-items: center;
        justify-content: center;
    }

    #content {
        z-index: 2;
        width: 50%;
        padding-top: 5em;
        padding-bottom: 5em;
        text-align: center;
        background-color: rgba(250, 250, 250, 0.800);
    }
</style>
