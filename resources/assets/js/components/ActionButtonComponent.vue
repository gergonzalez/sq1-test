<template>
    <form :action="url" method="POST">
        <input type="hidden" name="_token" :value="token">
        <button type="submit" :class="['btn btn-block', active?'btn-danger':'btn-success']" 
        @mouseover="active=true" @mouseleave="active=false">{{msg}}</button>
    </form>
</template>

<script>
    export default {
        mounted() {
        },
        computed: {
            msg: function () {
                return this.active?this.hover:this.idle;
            }
        },
        props: {
            url: {
              type: String,
              required: true,
            },
            token: {
              type: String,
              required: true,
            },
            idle: {
              type: String,
              required: true,
            },
            hover: {
              type: String,
              required: true,
            },
            blocked: {
              type: Boolean,
              default: false,
            },
        },
        data(){
            return{
                active:false
            }
        }
    }
</script>
