<template>
    <div class="container">
        <ul class="tab">
            <li class="tab-item" v-for="(item, index) in items" v-bind:key="index" v-bind:class="{ active: active === index }">
                <a href="#" v-on:click.prevent="active(index)">{{ item.tab }}</a>
            </li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane" v-for="(item, index) in items" v-bind:key="index" v-show="active === index" v-html="item.content"></div>
        </div>
    </div>
</template>

<script>
    export default {
        data: function () {
            return {
                active: 0,
                items: [
                    {
                      tab: '',
                      content: '',
                    },
                ],
            };
        },
        methods: {
            active: function(index) {
                this.active = index;
            },
        },
        mounted: function() {
            let self = this;
            axios
              .get('/api/...')
              .then(response =>{
                  self.items = response.data;
                  return console.log(response.data);
              })
              .catch(error =>{
              })
        },
    };
</script>

<style lang="" scoped>
    .tab {
        list-style: none;
        border-bottom: 1px solid #ccc;
    }

    .tab-item {
        border: 1px solid transparent;
        border-bottom: none;
        display: inline-block;
        margin: 0 0 -1px;
        border-radius: 4px 4px 0 0;
    }

    .tab-item:hover {
        border-color: #ccc;
    }

    .tab-item a {
        display: block;
        padding: 10px 15px;
    }

    .tab-item.active {
        border-color: #ccc;
        background-color: #fff;
    }

    .tab-item.active a {
        color: #600c76;
    }
</style>
