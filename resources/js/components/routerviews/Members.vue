<template>
    <div>
        <div class="container mt-2">
            <div class="row mt-2" justify="start">
                <h4>Members</h4>
            </div>
            <div class="row mt-2" justify="start">
                <ul>
                    <li>
                        <label for="name">担当者:</label>
                        <input type="text" name="name" id="name" v-model="name" />
                    </li>
                    <li>
                        <label for="email">E-mail:</label>
                        <input type="email" name="email" id="email" v-model="email" />
                    </li>
                </ul>
            </div>
            <div class="row mt-2" justify="start">
                <div class="card" color="" width="">
                    <p>New Member is . . .</p>
                </div>
                <div class="card" color="" width="">
                    <p> {{ $data.name }}</p>
                </div>
                <div class="card" color="" width="">
                    <p> {{ $data.email }}</p>
                </div>
            </div>
            <br>
            <div class="row mt-2" justify="start">
                <button v-on:click="postMember" class="btn btn-outline-dark">
                    登録
                </button>
            </div>
        </div>
        <div class="container mt-2">
            <div class="row mt-2" justify="start">
                <table class="table table-sm table-responsive">
                    <thead>
                        <tr class="table-row">
                            <th>
                                <button v-on:click="sortBy('id')" v-bind:class="sortedClass('id')">
                                    ID
                                </button>
                            </th>
                            <th>
                                <button v-on:click="sortBy('name')" v-bind:class="sortedClass('name')">
                                    担当者
                                </button>
                            </th>
                            <th>
                                <button v-on:click="sortBy('email')" v-bind:class="sortedClass('email')">
                                    E-mail
                                </button>
                            </th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="member in eventedAction" v-bind:key="member.id">
                            <td>
                                {{ member.id }}
                            </td>
                            <td>
                                {{ member.name }}
                            </td>
                            <td>
                                {{ member.email }}
                            </td>
                            <td>
                                <button v-on:click="openModal(member)">編集</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <member-modal v-bind:memberData="memberUpdate" v-on:input="childMember=$event" v-show="showContent" v-on:close="closeModal" v-on:update="getMembers"></member-modal>
                <div class="row mt-2" justify="start" id="message" v-show="message">
                    <p>エラーメッセージ: {{ message }}</p>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import axios from './axios-auth.js';
    import MemberModal from './modals/MemberModal.vue';
    export default {
        name: "Members",
        components: {
            MemberModal,
        },
        data: function () {
            return {
                showContent: false,
                name: "",
                email: "",
                members: [],
                memberUpdate: "",
                message: "",
                sort: {
                    key: "", // ソートキー
                    isAsc: false, // 昇順ならtrue,降順ならfalse
                },
                keyword: "",
            };
        },
        mounted: function () {
            this.getMembers();
        },
        computed: {
            eventedAction: function () {
                let list = this.members.slice();
                // ソート実施
                if (this.sort.key) {
                    list.sort((a, b) => {
                        a = a[this.sort.key];
                        b = b[this.sort.key];
                        return (a === b ? 0 : a > b ? 1 : -1) * (this.sort.isAsc ? 1 : -1);
                    });
                }
                return list;
            },
            // 検索"filteredMembers()"を実施
            filterMembers() {
                return this.filteredMembers();
            },
        },
        methods: {
            getMembers() {
                axios
                    .get('/api/members')
                    .then(response => {
                        this.members = response.data;
                        return console.log(response.data);
                    })
                    .catch(error => {
                        this.message = error.response.data;
                        return console.log(error.response.data);
                    });
            },
            postMember() {
                axios
                    .post('/api/members', {
                        name: this.name,
                        email: this.email,
                    })
                    .then(response => {
                        this.getMembers(),
                            this.name = "";
                        this.email = "";
                    })
                    .catch(error => {
                        this.message = error.response.data;
                        return console.log(error.response.data);
                    });
            },
            // sort用キーをセットし、昇順・降順を入れ替える
            sortBy: function (key) {
                this.sort.isAsc = this.sort.key === key ? !this.sort.isAsc : false;
                this.sort.key = key;
            },
            sortedClass: function (key) {
                return this.sort.key === key ?
                    `sorted ${this.sort.isAsc ? "asc" : "desc"}` :
                    "";
            },
            // 検索キーワード"keyword"に一致する項目のみ表示"push"する
            filteredMembers() {
                let members = [];
                for (let i in this.members) {
                    let member = this.member[i];
                    if (member.name.indexOf(this.keyword) !== -1 ||
                        member.email.indexOf(this.keyword) !== -1) {
                        members.push(member);
                    }
                }
                return members;
            },
            openModal(member) {
                this.showContent = true;
                this.memberUpdate = member;
            },
            closeModal(member) {
                this.showContent = false;
            },
        },
    };
</script>

<style scoped>
    ul {
        list-style: none;
    }

    .table-row {
        background-color: #fff;
    }

    .table-row:hover {
        background-color: #ddd;
    }
</style>
