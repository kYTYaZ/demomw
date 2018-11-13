<template>
    
    <div>
        
   
    <div class="row">
        <profile-header :user="user"  @changeTabProfile="changeTabProfile"></profile-header>
        
        <feed-component v-if="showTab=='feed'" :user="user"></feed-component>
        <lefthome-component v-if="showTab=='feed'"></lefthome-component>
        <righthome-component v-if="showTab=='feed'"></righthome-component>
        </div>
        <about-profile-component v-if="showTab=='about'"></about-profile-component>

        <profile-friends  :user="user"  v-if="showTab=='networking'"></profile-friends>
        <profile-projects   v-if="showTab=='projects'"></profile-projects>
        <profile-challenges v-if="showTab=='challenges'"></profile-challenges>
        <profile-events  v-if="showTab=='events'"></profile-events>
 </div>
</template>

<script>
    export default {
        mounted() {  
            
        },
        data:function(){
             return {
                 showTab:"feed" 
             };
        },
        methods:{
          changeTabProfile:function (tab){
              this.showTab=tab;
          }  
        },
        props: {  
            user: {
                type: Object
            } 
        }
    }
</script>
