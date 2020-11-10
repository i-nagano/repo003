<template>
    <div id="overlay">
        <div id="content">
            <div class="row mt-2" justify="start">
                <ul>
                    <li>
                        <label>ID: </label>
                        <input type="text" v-model="childCar.id">
                    </li>
                    <li>
                        <label>自車名: </label>
                        <input type="text" v-model="childCar.name">
                    </li>
                    <li>
                        <label>自車No.: </label>
                        <input type="text" v-model="childCar.number">
                    </li>
                    <button v-on:click="updateCar">更新</button>
                    <button v-on:click="deleteCar">削除</button>
                    <button v-on:click="$emit('close')">閉じる</button>
                </ul>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'CarModal',
        components: {},
        data: function () {
            return {
            };
        },
        props: {
            carData: '',
        },
        methods: {
            updateCar() {
                let id = this.childCar.id;
                let modify = {
                    name: this.childCar.name,
                    number: this.childCar.number,
                };
                axios
                    .put('/api/cars/' + id, modify)
                    .then(response => {
                        alert("「" + modify.name + ", " + modify.number + "」更新完了");
                        this.$emit('close');
                        this.$emit('update');
                    })
                    .catch(error => {
                        alert("「" + modify.name + ", " + modify.number + "」更新失敗");
                        console.log(error, id, modify);
                    });
            },
            deleteCar() {
                let id = this.childCar.id;
                let params = {
                    name: this.childCar.name,
                    number: this.childCar.number,
                };
                axios
                    .delete('/api/cars/' + id, {
                        data: params
                    })
                    .then(response => {
                        alert("「" + params.name + ", " + params.number + "」削除完了");
                        this.$emit('close');
                        this.$emit('update');
                    })
                    .catch(error => {
                        alert("「" + params.name + ", " + params.number + "」削除失敗");
                        console.log(error, id, params);
                    });
            },
        },
        computed: {
            childCar: {
                get: function () {
                    return this.carData;
                },
                set: function (newCarData) {
                    this.$emit("input", newCarData);
                }
            },
        },
    };
</script>

<style scoped>
    ul {
        list-style: none;
    }

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
