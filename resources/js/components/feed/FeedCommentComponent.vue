<template>
    <div>
        
   
     <!-- Comments -->

        <ul class="comments-list">
            <li class="comment-item" v-for="(item, index) in dataIndividualFeed.comments" > 
                <div class="post__author author vcard inline-items">
                    <a  :href="'/profile/'+item.user.profile.slug"><img  :src="item.user.image" :alt="item.user.name"></a>

                    <div class="author-date">
                        <a class="h6 post__author-name fn" :href="'/profile/'+item.user.profile.slug">{{item.user.name}}</a>
                        <div class="post__date">
                            <time class="published" :datetime="item.created_at">
                                {{ item.created_at | moment("from", "now", true) }}
                            </time>
                        </div>
                    </div>

                    <a href="javascript:void(0)" v-if="item.can_delete_comments_count==1" v-on:click="deleteComment(item,index)" class="more delete_coment">
                        <i class="fas fa-times"></i>
                    </a>

                </div>

                <p>{{item.comment}}
                </p>

                <like-component :source="item" :sourceType="2"></like-component>
               <!--- <a href="#" class="reply">Reply</a>-->
            </li>
        </ul>

        <!-- ... end Comments -->

        <a href="#" v-if="dataIndividualFeed.comments.length>5" class="more-comments">View more comments <span>+</span></a>


        <!-- Comment Form  -->
    
    
    <!-- Comment Form  -->

        <form class="comment-form inline-items">

            <div class="post__author author vcard inline-items">
                <img :src="dataIndividualFeed.user.image" :alt="dataIndividualFeed.user.name">

                <div class="form-group with-icon-right ">
                    <textarea :id="'comment_'+dataIndividualFeed.id"  ref="search" placeholder="Escribe un comentario" v-model="commentData.comment" v-on:keyup.enter="sendComment" class="form-control" ></textarea>
                    <div class="add-options-message"  v-show="commentData.comment">
                        <a href="javascript:void(0)" class="options-message" v-on:click="sendComment" >
                            <i class="fas fa-comment-dots"></i>
                        </a>
                    </div>
                </div>
            </div>
 
        </form>

        <!-- ... end Comment Form  -->
         </div>
</template>
  
<script>
    export default {
        mounted() {
         // this.getCommentsBySourceAndType();
         
        },  

       props: {
            dataIndividualFeed: {
                type: Object
            } 
        },  
        data: function ()
        {
            return {
                commentData:{comment:"",source_type:"1",source_id:null}
            }
        },
        methods:{
           focusTextArea:function (){
               var searach=this.$refs.search;
                setTimeout(function () {
                           searach.focus();
                }, 500);

           },
            sendComment:function (){
                  this.commentData.source_id=this.dataIndividualFeed.id;            
                 axios.post('/comments',this.commentData).then(response => {
                      this.dataIndividualFeed.comments.unshift(response.data.comment);
                      this.commentData.comment="";                      
                      this.$emit('emitComment',response.data);

                })  
            },
            getCommentsBySourceAndType:function (){
                
                axios.post('/getCommentsBySourceAndType',this.dataIndividualFeed).then(response => {
                    
                 })  
            },
            deleteComment:function (value,index){
                this.$swal({
                title: "¿Estas seguro de borrar este comentario?",
                text: "Una vez que se elimine, ¡no se podrá recuperar este comentario",
                icon: "warning",
                    buttons: ["Cancelar", "Borrar"],                    
                dangerMode: true,
              })
              .then((willDelete) => {
                if (willDelete) {
                  
                  
                  axios.delete('/comments/'+value.id,value).then(response => {
                     this.dataIndividualFeed.comments.splice(index, 1); 
             
                    swal("El Comentario ha sido borrado", {
                        icon: "success",
                      });
                 })  
                  
                }
              });
              
                
            }
           
           
        }
    }
</script>
