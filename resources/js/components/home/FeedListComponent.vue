<template>
    <div>
        <newsfeed-component @loadFeeds="loadAllFeeds" v-if="showInputWall==true"  @clearAttachFeed="clearAttachFeed"></newsfeed-component>

        <div id="newsfeed-items-grid">

            <dinamic-component @deleteFeed="deleteFeed" @focusComment="focusComment"    v-for="(item, index) in dataArray"  :datafeed="item" :indexFeed="index"  :id="'container_feed_'+item.id"  :key="item.id"></dinamic-component>

        </div>
        <div class="row">
            <a id="load-more-button" v-show="nextUrl" href="javascript:void(0)" v-on:click="nextPage" class="btn btn-control btn-more" data-load-link="items-to-load.html" data-container="newsfeed-items-grid"><svg class="olymp-three-dots-icon"><use xlink:href="/svg-icons/sprites/icons.svg#olymp-three-dots-icon"></use></svg></a>
        </div>

        <div class="modal fade" id="update-header-photo" tabindex="-1" role="dialog" aria-labelledby="update-header-photo" aria-hidden="true">
            <div class="modal-dialog window-popup update-header-photo" role="document">
                <div class="modal-content">
                    <a href="#" class="close icon-close" data-dismiss="modal" aria-label="Close">
                        <svg class="olymp-close-icon"><use xlink:href="/svg-icons/sprites/icons.svg#olymp-close-icon"></use></svg>
                    </a>

                    <div class="modal-header">
                        <h6 class="title">Ingresa la url del video de youtube</h6>
                    </div>

                    <div class="modal-body">
                        <div class="col">


                            <form>
                                <div class="form-group">
                                    <br/>
                                    <input  v-on:change="processUrlyoutube" type="url" v-model="url" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Url del video">
                                    <small id="emailHelp" class="form-text text-muted">Ej. https://www.youtube.com/watch?v=aXHcRiSK_ys</small>
                                </div>

                                <div class="form-group">
                                    <textarea v-model="siteData.message"  rows="2"  class="form-control" placeholder="Escribe algo..."></textarea>
                              
                                
                                
                                </div>

                                <button  v-on:click="saveFeedAttachment"  v-show="url" type="button" class="btn btn-primary">Publicar Video</button>
                            </form>

                             <div class="post-video" v-show="siteData.title">
                                <div class="video-thumb" v-show="siteData.image">
                                    <img :src="siteData.image" alt="photo"> 
                                    <a :href="siteData.url" target="_blank" class="play-video">
                                        <svg class="olymp-play-icon">
                                            <use xlink:href="/svg-icons/sprites/icons.svg#olymp-play-icon">

                                            </use>
                                        </svg>
                                    </a>
                                </div> 
                                <div class="video-content">
                                    <a target="_blank" :href="siteData.url" class="h4 title">{{siteData.title}}</a> 
                                    <p>
                                        {{siteData.description}}
                                    </p> 
                                    <a href="#" class="link-site">{{siteData.site}}</a>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        
        
        
         <div class="modal fade" id="update-header-web" tabindex="-1" role="dialog" aria-labelledby="update-header-photo" aria-hidden="true">
            <div class="modal-dialog window-popup update-header-photo" role="document">
                <div class="modal-content">
                    <a href="#" class="close icon-close" data-dismiss="modal" aria-label="Close">
                        <svg class="olymp-close-icon"><use xlink:href="/svg-icons/sprites/icons.svg#olymp-close-icon"></use></svg>
                    </a>

                    <div class="modal-header">
                        <h6 class="title">Ingresa la url del sitio web</h6>
                    </div>

                    <div class="modal-body">
                        <div class="col">


                            <form>
                                <div class="form-group">
                                    <br/>
                                    <input  v-on:change="processWebSite" type="url" v-model="urlSite" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Url del sitio web">
                                    <small id="emailHelp" class="form-text text-muted">Ej. https://www.lanacion.com.ar/emprendedores-t53673</small>
                                </div>

                                <div class="form-group">
                                    <textarea  v-model="siteData.message"  rows="2"  class="form-control" placeholder="Escribe algo..."></textarea>
                                </div>

                                <button v-show="urlSite" v-on:click="saveFeedAttachment" type="button" class="btn btn-primary">Publicar Url</button>
                            </form>

                            <div class="post-video" v-show="siteData.title">
                                <div class="video-thumb" v-show="siteData.image">
                                    <img :src="siteData.image" alt="photo"> 
                                    <a :href="siteData.url" target="_blank" class="play-video">
                                        <i class="fas fa-link"  data-toggle="modal" data-target="#update-header-web"></i>                                                    

                                    </a>
                                </div> 
                                <div class="video-content">
                                    <a target="_blank" :href="siteData.url" class="h4 title">{{siteData.title}}</a> 
                                    <p>
                                        {{siteData.description}}
                                    </p> 
                                    <a href="#" class="link-site">{{siteData.site}}</a>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
</template>

<script>
    export default {
        mounted() {
            this.userFeed=this.user;            
            console.log(this.userFeed);
            
            if(this.userFeed){
                if(this.userFeed.ownProfile){
                    this.showInputWall=true;
                }else{
                    this.showInputWall=false;
                }
                console.log("existe el usuario")
            }else{
                console.log("no existe");
            }
            this.getFeeds();
        },
        created() {

        },

        data: function ()
        {
            return {
                userFeed:null,
                showInputWall:true,
                nextUrl:null,
                dataArray: [],
                url: null,
                urlSite:null,
                videoData: {title: "", url: "", image: null},
                siteData: {title: "", url: "", image: null,site:"",description:"",type:1}
            }
        },
        props: {
            user: {
                type: Object
            }
        },

        methods: {
            loadAllFeeds(value) {
                this.dataArray.unshift(value);

            },
            clearAttachFeed(){
                this.siteData= {title: "", url: "", image: null,site:"",description:"",type:1}
                this.url=null;
                this.urlSite=null
            },
            saveFeedAttachment(){
               axios.post('/feedAattachment',this.siteData).then(response => {
                this.dataArray.unshift(response.data);
                $("#update-header-photo").modal("hide")
                $("#update-header-web").modal("hide")
                this.siteData= {title: "", url: "", image: null,site:"",description:"",type:1}
               })  
            },
            processUrlyoutube() {
                axios.post('/processWebSite?url=' + this.url).then(response => {
                    this.siteData = {
                        title: response.data.title, 
                        image: response.data.thumbnail_url, 
                        url: this.url, 
                        description: response.data.description,
                        site:response.data.site,
                        type:2
                    }
                    console.log(this.videoData);
                })

            },
            processWebSite(){
                axios.post('/processWebSite?url=' + this.urlSite).then(response => {
                    this.siteData = {
                        title: response.data.title, 
                        image: response.data.thumbnail_url, 
                        url: this.urlSite, 
                        description: response.data.description,
                        site:response.data.site,
                        type:3
                    }
                    console.log(this.siteData)
                })
            },
            focusComment:function (){
              alert("aqui");  
            },
            focusComment:function (){
                alert("focusComment aqui ");
            },
            postFeed: function () {
                alert("posting");
            },
            nextPage:function (){
                var user=0;
                if(this.userFeed){
                    user=this.userFeed.id;
                }
              axios.post(this.nextUrl+"&user="+user).then(response => {
                  
                    this.dataArray=this.dataArray.concat(response.data.data);
                    this.nextUrl=response.data.next_page_url;

                })  
            },
            deleteFeed:function (feed){
                this.dataArray.splice(feed.index, 1); 
            },
            getFeeds: function () {
                var user=0;
                if(this.userFeed){
                    user=this.userFeed.id;
                }
                
                axios.post('/feedWall?page=1&user='+user).then(response => {
                    this.nextUrl=response.data.next_page_url;
                    this.dataArray = response.data.data

                })

            }
        }
    }
</script>
