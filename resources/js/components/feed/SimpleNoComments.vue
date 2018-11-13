<template>

    <div class="ui-block">

        <article class="hentry post video">

            <div class="post__author author vcard inline-items">
                <a :href="'/profile/'+user.profile.slug"><img :src="user.image" :alt="user.name"></a>

                <div class="author-date">

                    <a class="h6 post__author-name fn" :href="'/profile/'+user.profile.slug">{{user.name}} </a> 

                    <div class="post__date">
                        <time class="published" :datetime="feed.created_at">
                            {{ feed.created_at | moment("from", "now", true) }}
                        </time>
                    </div>
                </div>

                <div class="more" v-if="feed.can_delete_posts_count==1"><svg class="olymp-three-dots-icon"><use xlink:href="/svg-icons/sprites/icons.svg#olymp-three-dots-icon"></use></svg>
                    <ul class="more-dropdown">
                        <!-- <li>
                             <a href="#">Edit Post</a>
                         </li>-->
                        <li>
                            <a href="javascript:void(0)" v-on:click="deletePost(feed)">Borrar Publicación</a>
                        </li>
                        <!-- <li>
                             <a href="#">Turn Off Notifications</a>
                         </li>
                         <li>
                             <a href="#">Select as Featured</a>
                         </li>-->
                    </ul>
                </div>

            </div>

            <p>{{feed.text}}</p>



            <div class="post-additional-info inline-items">

                <like-component @emitLikes="emitLikes" :source="feed" :sourceType="1"></like-component>


                <ul class="friends-harmonic">
                    <li v-for="item  in feed.likes_people">
                        <a href="#">
                            <img :src="item.user.image" :alt="item.user.name">
                        </a>
                    </li>

                </ul>

                <div class="names-people-likes"  v-if="feed.likes_people">
                    <span  v-if="feed.likes_people.length>1">
                        <a href="#" v-for="item  in feed.likes_people">{{item.user.name}} </a> <span v-if="feed.likes_people.length>6">y a
                            <br>{{feed.likes_count}}</span> Les gusta esto
                    </span>
                </div>

                <div class="comments-shared">
                    <a  v-scroll-to="{
                        el: '#comment_'+feed.id,
                        offset: -200,

                        }" v-on:click="focusComment"   class="post-add-icon inline-items">
                        <svg class="olymp-speech-balloon-icon"><use xlink:href="/svg-icons/sprites/icons.svg#olymp-speech-balloon-icon"></use></svg>

                        <span>{{feed.comments_count}}</span>
                    </a>   

                </div>


            </div>

            <div class="control-block-button post-control-button">

                <!--  <a href="#" class="btn btn-control">
                      <svg class="olymp-like-post-icon"><use xlink:href="/svg-icons/sprites/icons.svg#olymp-like-post-icon"></use></svg>
                  </a>-->

                <a   v-scroll-to="{
                     el: '#comment_'+feed.id,
                     offset: -200,

                     }" v-on:click="focusComment"  class="btn btn-control">
                    <svg class="olymp-comments-post-icon"><use xlink:href="/svg-icons/sprites/icons.svg#olymp-comments-post-icon"></use></svg>
                </a>



            </div>

        </article>


        <feed-comment-component @emitComment="emitComment" :dataIndividualFeed="dataObject" ref="comment"></feed-comment-component>

    </div>

</template>


<script>
    export default {
        mounted() {
            this.feed = this.dataObject;
            this.user = this.dataObject.user;

        },
        data: function ()
        {
            return {
                feed: {
                    text: null,
                    created_at: "2018-09-19T00:02:50+00:00",
                    id: null,
                    attachment: {
                        title: null,
                        description: null,
                        image: null,
                        url: null,
                        site: null,
                        type: null
                    }
                },
                user: {name: null,profile:{slug:""}}
            }
        },
        methods: {
            focusComment: function () {
                this.$refs.comment.focusTextArea()

            },
            emitLikes: function (valor) {
                this.feed.likes_count = valor.likes_count
                this.feed.likes_people = valor.likes_people
            },
            emitComment: function (value) {
                this.feed.comments_count = value.comments_count;
            },
            deletePost: function (feed) {
                this.$swal({
                    title: "¿Estas seguro de borrar esta publicación?",
                    text: "Una vez que se elimine, ¡no se podrá recuperar esta publicación",
                    icon: "warning",
                    buttons: ["Cancelar", "Borrar"],                    
                    dangerMode: true,
                })
                        .then((willDelete) => {
                            if (willDelete) {

                                axios.delete('/feeds/' + feed.id, feed).then(response => {
                                    this.$emit('deleteFeed', feed)

                                    swal("La publicación ha sido borrado", {
                                        icon: "success",
                                    });
                                })


                            }
                        });

            }
        },
        props: {
            dataObject: {
                type: Object
            }
        },
    }
</script>
