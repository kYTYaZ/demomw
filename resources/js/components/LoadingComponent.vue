<template>
    <div v-if="loadingComponent>0">
        
   
    <div class="container-loading" v-if="loadingComponent==1">
        <div class="lds-ripple"><div></div><div></div></div>
        <p>{{loading}}</p>
    </div>
    
     <div class="container-loading icon-success" v-if="loadingComponent==2">
         <img src="/icon_confirmation.png"/>
    </div>
         </div>
</template>
   
<script>
    export default {
        mounted() {

  Event.$on('loading', (data, response) => {
            this.loadingComponent=data.loading;
        });

        },props: {
            loading: {
                type: String
            },
            isloading:{ 
                type:String 
            }
        },
        data: function() {
            return {
                loadingComponent:0
            }  
            
        }
        ,
        watch:{
            isloading (val) {
                this.loadingComponent=val;
                            console.log(this.loadingComponent,"loaddd")

           }
        }
    }
</script>
