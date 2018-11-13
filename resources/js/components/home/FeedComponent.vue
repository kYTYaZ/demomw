<template>


    <main class="col col-xl-6 order-xl-2 col-lg-12 order-lg-1 col-md-12 col-sm-12 col-12">
        <feedlist-component :user="user"></feedlist-component>
    </main>


</template>
getparent
<script>
    export default {
        mounted() {
            console.log(this.user);
        },
        methods: {

        },  
        data: function ()
        {
            return {
              //  user:null
            }
        },
        props: {
            user: {
                type: Object
            }
        }
    }
</script>
