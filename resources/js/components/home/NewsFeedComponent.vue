<template>
    <div class="ui-block">
				
				<!-- News Feed Form  -->
				
        <div class="news-feed-form">

             

                <!-- Tab panes -->
                <div class="tab-content">
                        <div class="tab-pane active" id="home-1" role="tabpanel" aria-expanded="true">
                                <form>
                                        <div class="author-thumb">
                                                <img :src="userAuth.image" :alt="userAuth.name">
                                        </div>
                                        <div class="form-group with-icon label-floating is-empty">
                                                <textarea placeholder="Comparte con la comunidad" class="form-control" v-model="message" ></textarea>
                                        </div>
                                        <div class="add-options-message">
                                                <a href="#" class="options-message" data-toggle="tooltip" data-placement="top"   data-original-title="ADD PHOTOS">
                                                    <i class="fab fa-youtube" v-on:click="clearAttachFeed" data-toggle="modal" data-target="#update-header-photo"></i>
                                                </a>
                                                <a href="#" class="options-message" data-toggle="tooltip" data-placement="top"   data-original-title="TAG YOUR FRIENDS">
                                                    <i class="fas fa-link" v-on:click="clearAttachFeed"  data-toggle="modal" data-target="#update-header-web"></i>                                                    
                                                </a>
                                                <a href="#" class="options-message" data-toggle="tooltip" data-placement="top"   data-original-title="TAG YOUR FRIENDS">
                                                    <img width="35px" src="https://s3.amazonaws.com/meetworks/logo_header.png"/>
                                                </a>

                                            
                                                 

                                            <button  v-on:click="postFeed" class="btn btn-primary btn-md-2" type="button">Compartir Comentario</button>

                                        </div>

                                </form>
                        </div>

                      
                </div>
        </div>

        <!-- ... end News Feed Form  -->			
        </div>
</template>

<script>
const axios = require('axios');

 export default {
         data:function(){
             return {
                 message:"" ,
                 userAuth:{image:"",name:""}
             };
        }
     ,
        mounted() {
            this.userAuth=window.App.user;
            },
        created(){
            
        },
        methods:{
            clearAttachFeed:function (){
                this.$emit('clearAttachFeed')
            },
            postFeed:function (){
                  
                  if(!this.message){
                      this.$swal('Ingresa un mensaje',' ',"error")

                      return false;
                  }
                  
                  axios.post('/feeds', {
                    message:this.message
                  }).then(response => {
                      this.message="";
                     this.$emit('loadFeeds',response.data)
               })
                
            }
        }
    }
</script>
