<template>
    <div class="row">

 
        <div class="container">
            <div class="row">
                <div class="col col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="ui-block responsive-flex">
                        <div class="ui-block-title">
                            <div class="h6 title">Contactos de {{userAuth.name}} ({{friendsCount}})</div>
                            <form v-if="friendsCount>0" class="w-search">
                                <div class="form-group with-button">
                                    <input class="form-control" type="text" placeholder="Search Friends...">
                                    <button>
                                        <svg class="olymp-magnifying-glass-icon"><use xlink:href="/svg-icons/sprites/icons.svg#olymp-magnifying-glass-icon"></use></svg>
                                    </button>
                                </div>
                            </form>
                            <a href="#" class="more"><svg class="olymp-three-dots-icon"><use xlink:href="/svg-icons/sprites/icons.svg#olymp-three-dots-icon"></use></svg></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <!-- Friends -->

        <div class="container">
            <div class="row">
                <div v-for="(item, index)  in users" class="col col-xl-3 col-lg-6 col-md-6 col-sm-6 col-6">
                    <div class="ui-block">

                        <!-- Friend Item -->

                        <div class="friend-item">

                            <div class="friend-item-content">

                                <div class="more">
                                    <svg class="olymp-three-dots-icon"><use xlink:href="/svg-icons/sprites/icons.svg#olymp-three-dots-icon"></use></svg>
                                    <ul class="more-dropdown">
                                        <li>
                                            <a href="javascript:void(0)" v-on:click="deleteFriend(item.user,index)">Borrar Contacto</a>
                                        </li>
                                       
                                    </ul>
                                </div>
                                <div class="friend-avatar">
                                    <div class="author-thumb">
                                        <img :src="item.user.image" alt="author">
                                    </div>
                                    <div class="author-content">
                                        <a href="#" class="h5 author-name">{{item.user.name}}</a>
                                       <!-- <div class="country">San Francisco, CA</div>-->
                                    </div>
                                </div>

                                <div class="swiper-container" data-slide="fade">
                                    <div class="swiper-wrapper">
                                        <div class="swiper-slide">
                                            <div class="friend-count" data-swiper-parallax="-500">
                                                <a href="#" class="friend-count-item">
                                                    <div class="h6">{{item.user.friends_count}}</div>
                                                    <div class="title">Contactos</div>
                                                </a>
                                               
                                            </div>
                                           
                                        </div>

                                    </div>

                                    <!-- If we need pagination -->
                                    <div class="swiper-pagination"></div>
                                </div>
                            </div>
                        </div>

                        <!-- ... end Friend Item -->			
                    </div>
                </div>
             
            </div>
        </div>

        <!-- ... end Friends -->


    </div>
</template>

<script>
    export default {
        mounted() {
            
               this.userAuth=this.user.user;
                        this.userAuth.profile=this.user;
            
            this.getUserFriends();
        },
        data:function(){
             return {
                 users:[] ,
                 friendsCount:0,
                userAuth:{image:"",name:"",profile:{slug:""}}

             };
        },
        methods:{
            getUserFriends:function (){
                 axios.get('/friends?user_id='+this.user.id).then(response => {
                    this.friendsCount=response.data.total;
                    this.users=response.data.data;
                    })
            },
            deleteFriend:function (user,index){
                
                  axios.post('/deleteFriend',{user_id:user.id}).then(response => {
                     
                     
                     if(response.data.response){
                         this.friendsCount=response.data.data.friends_count;
                        this.users.splice(index, 1); 
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
