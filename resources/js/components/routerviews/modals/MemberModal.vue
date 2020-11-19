<template>
    <div id="overlay">
        <div id="content">
            <div class="row mt-2" justify="start">
                <ul>
                    <li>
                        <label>ID: </label>
                        <input type="text" v-model="childMember.id">
                    </li>
                    <li>
                        <label>担当者: </label>
                        <input type="text" v-model="childMember.name">
                    </li>
                    <li>
                        <label>E-mail: </label>
                        <input type="text" v-model="childMember.email">
                    </li>
                    <button v-on:click="updateMember">更新</button>
                    <button v-on:click="deleteMember">削除</button>
                    <button v-on:click="$emit('close')">閉じる</button>
                </ul>
            </div>
        </div>
    </div>
</template>

<script>
    import axios from '../axios-auth.js';
    export default {
        name: 'MemberModal',
        components: {},
        data: function () {
            return {};
        },
        props: {
            memberData: '',
        },
        methods: {
            updateMember() {
                let id = this.childMember.id;
                let modify = {
                    name: this.childMember.name,
                    email: this.childMember.email,
                };
                axios
                    .put('/api/members/' + id, modify)
                    .then(response => {
                        alert("「" + modify.name + ", " + modify.email + "」更新完了");
                        this.$emit('close');
                        this.$emit('update');
                    })
                    .catch(error => {
                        alert("「" + modify.name + ", " + modify.email + "」更新失敗");
                        console.log(error, id, modify);
                    });
            },
            deleteMember() {
                let id = this.childMember.id;
                let params = {
                    name: this.childMember.name,
                    email: this.childMember.email,
                };
                axios
                    .delete('/api/members/' + id, {
                        data: params
                    })
                    .then(response => {
                        alert("「" + params.name + ", " + params.email + "」削除完了");
                        this.$emit('close');
                        this.$emit('update');
                    })
                    .catch(error => {
                        alert("「" + params.name + ", " + params.email + "」削除失敗");
                        console.log(error, id, params);
                    });
            },
        },
        computed: {
            childMember: {
                get: function () {
                    return this.memberData;
                },
                set: function (newMemberData) {
                    this.$emit('input', newMemberData);
                },
            },
        },
    };

</script>

<style>
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
