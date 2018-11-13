<template>
    <a href="javascript:void(0)" v-on:click="likesource" class="post-add-icon inline-items">
        <svg class="olymp-heart-icon"><use xlink:href="/svg-icons/sprites/icons.svg#olymp-heart-icon"></use></svg>
        <span>{{source.likes_count}}</span>
    </a>
</template>

<script>
    export default {
        mounted() {
          
        },
        props: {
            source: {
                type: Object
            },
            sourceType:{
                type:Number
            }
        },
        methods:{
            likesource:function (){
                 this.source.like_type=this.sourceType;
                 axios.post('/likes',this.source).then(response => {
                    this.source.likes_count=response.data.likes_count;
                     
                        this.$emit('emitLikes',response.data);

                    })  
            }
            
        }
    }
</script>
