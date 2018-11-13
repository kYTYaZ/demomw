<template>


    <div class="col col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="ui-block">
            <div class="top-header">
                <div class="top-header-thumb">
                    <img src="https://s3.amazonaws.com/meetworks/cover.jpg" :alt="userAuth.name">
                </div>
                <div class="profile-section">
                    <div class="row">
                        <div class="col col-lg-5 col-md-5 col-sm-12 col-12">
                            <ul class="profile-menu">
                                <li>
                                    <a href="javascript:void(0)"  v-on:click="showTab('feed')">Lo que esta pasando...</a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)"   v-on:click="showTab('about')">Sobre mi</a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)"  v-on:click="showTab('networking')">Networking</a>
                                </li>
                            </ul>
                        </div>
                        <div class="col col-lg-5 ml-auto col-md-5 col-sm-12 col-12">
                            <ul class="profile-menu">  
                                <li>
                                    <a href="javascript:void(0)"  v-on:click="showTab('projects')">Proyectos</a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)"  v-on:click="showTab('challenges')">Convocatorias</a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)"  v-on:click="showTab('events')">Eventos</a>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="control-block-button actions-profile">
                        <a href="javascript:void(0)" v-on:click="addFriend" v-if="!ownProfile  && !friend" class="btn btn-control bg-blue contact-user">
                            <svg class="olymp-happy-face-icon"><use xlink:href="/svg-icons/sprites/icons.svg#olymp-happy-face-icon"></use></svg>
                            Agregar contacto
                        </a>
                         
                         <a href="javascript:void(0)" v-on:click="deleteFriend" v-if="!ownProfile  && friend" class="btn btn-control bg-google contact-user">
                            <svg class="olymp-happy-face-icon"><use xlink:href="/svg-icons/sprites/icons.svg#olymp-happy-face-icon"></use></svg>
                            Eliminar contacto
                        </a>
                        
                        
                        <a href="#" class="btn btn-control bg-purple">
                            <svg class="olymp-chat---messages-icon"><use xlink:href="/svg-icons/sprites/icons.svg#olymp-chat---messages-icon"></use></svg>
                        </a>

                        <div class="btn btn-control bg-primary more">
                            <svg class="olymp-settings-icon"><use xlink:href="/svg-icons/sprites/icons.svg#olymp-settings-icon"></use></svg>

                            <ul class="more-dropdown more-with-triangle triangle-bottom-right">
                                <li>
                                    <a href="#" data-toggle="modal" data-target="#update-header-photo">Update Profile Photo</a>
                                </li>
                                <li>
                                    <a href="#" data-toggle="modal" data-target="#update-header-photo">Update Header Photo</a>
                                </li>
                                <li>
                                    <a href="29-YourAccount-AccountSettings.html">Account Settings</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div> 
                <div class="top-header-author">
                    <a :href="'/profile/'+userAuth.profile.slug" class="author-thumb">
                        <img :src="userAuth.image" :alt="userAuth.name" width="120px" >
                    </a>
                    <div class="author-content">
                        <a :href="'/profile/'+userAuth.profile.slug" class="h4 author-name">{{userAuth.name}}</a>
                        <!---<div class="country">San Francisco, CA {{userAuth.friend}}</div>-->
                    </div>
                </div>
            </div>
        </div>
    </div>

 
</template>

<script>
    export default {
        mounted() {
            this.ownProfile=this.user.ownProfile;
            this.friend=this.user.friend;
            
                        console.log('perfil .',this.ownProfile,this.friend)

                        this.userAuth=this.user.user;
                        this.userAuth.profile=this.user;
                        
        },
        data:function(){
             return {
                 message:"" ,
                 ownProfile:false,
                 friend:false,
                 userAuth:{image:"",name:"",profile:{slug:""}}
             };
        },
        methods:{
            showTab:function (value){
                
                console.log(value);
                this.$emit('changeTabProfile',value)
            },
            addFriend:function (){ 
                
                  axios.post('/addFriend',{user_id:this.userAuth.id}).then(response => {
                      if(response.data.response){
                         this.friend=true;
                         swal("Contacto Agregado", "Agregaste a "+this.userAuth.name+" con éxito!", "success");
                     }

                    })  
 
            },
            deleteFriend:function (){
                  axios.post('/deleteFriend',{user_id:this.userAuth.id}).then(response => {
                     
                     
                     if(response.data.response){
                         this.friend=false;
                        swal("Contacto Eliminado", "Eliminaste a "+this.userAuth.name+" con éxito!", "success");

                     }

                    })  
            }
        },  

       props: {
            user: {
                type: Object
            } 
        }
     
    }
</script>
