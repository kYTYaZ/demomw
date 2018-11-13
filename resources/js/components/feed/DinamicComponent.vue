
<template>
    <component @deleteFeed="deleteFeed"  @focusCommentEmit="focusCommentEmitt" :is="dynamicComponent"  :dataObject="dataObject"></component>
</template>

<script>
    export default {
        mounted() {
            this.dataObject.index=this.indexFeed;
        },
        data: function ()
        {
            return {
                dataObject: this.datafeed
            }
        },
        props: {  
            datafeed: {
                type: Object
            },
            indexFeed:{
                type:Number
            }
        },
        methods:{
          focusCommentEmitt:function (value){
              this.$emit('focusComment')
          },
          deleteFeed:function (feed){
              this.$emit('deleteFeed',feed)
          }
        },
        computed: {
            dynamicComponent() {
                if (this.datafeed.type == 2) {
                    return 'video-component';
                } else if (this.datafeed.type == 1) {
                    return 'simple-feed-no-comments-component';
                } else if (this.datafeed.type == 3) {
                    return 'video-component';
                }
            }
        }
    }
</script>
