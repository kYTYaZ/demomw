
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

window.Event = new Vue();


const moment = require('moment')
require('moment/locale/es')
 
Vue.use(require('vue-moment'), {
    moment
})
var VueScrollTo = require('vue-scrollto');
 
Vue.use(VueScrollTo)

import VueSwal from 'vue-swal'
 
Vue.use(VueSwal)  


Vue.component('example-component', require('./components/ExampleComponent.vue'));


/** home components */
Vue.component('feed-component', require('./components/home/FeedComponent.vue'));
Vue.component('newsfeed-component', require('./components/home/NewsFeedComponent.vue'));
Vue.component('feedlist-component', require('./components/home/FeedListComponent.vue'));
Vue.component('lefthome-component', require('./components/home/LeftHome.vue'));
Vue.component('righthome-component', require('./components/home/RightHome.vue'));
/** home components */


/** feed components */
Vue.component('video-component', require('./components/feed/VideoComponent.vue'));
Vue.component('simple-feed-component', require('./components/feed/SimpleComponent.vue'));
Vue.component('simple-feed-no-comments-component', require('./components/feed/SimpleNoComments.vue'));
Vue.component('simple-feed-thumbnail-component', require('./components/feed/ThumnailFeedComponent.vue'));
Vue.component('dinamic-component', require('./components/feed/DinamicComponent.vue'));
Vue.component('feed-comment-component', require('./components/feed/FeedCommentComponent.vue'));
Vue.component('like-component', require('./components/feed/LikeComponent.vue'));



/** feed components */
   
/** profile */

Vue.component('about-profile-component', require('./components/profile/AboutComponent.vue'));
Vue.component('profile-tabs', require('./components/profile/TabsProfileComponent.vue'));
Vue.component('profile-header', require('./components/profile/HeaderProfileComponent.vue'));
Vue.component('profile-friends', require('./components/profile/FriendsComponent.vue'));
Vue.component('profile-projects', require('./components/profile/ProjectsComponent.vue'));
Vue.component('profile-challenges', require('./components/profile/ChallengesComponent.vue'));
Vue.component('profile-events', require('./components/profile/EventsComponent.vue'));
Vue.component('profile-index', require('./components/profile/IndexComponent.vue'));


/** profile */


/** places */
Vue.component('places-index', require('./components/place/IndexComponent.vue'));
Vue.component('filter-map-desktop', require('./components/place/FilterMapComponent.vue'));
Vue.component('filter-top-map-desktop', require('./components/place/FilterTopMapComponent.vue'));
Vue.component('places-profile', require('./components/place/ProfileComponent.vue'));


/** places */

/** announcements */

Vue.component('announcements-form', require('./components/announcements/FormComponent.vue'));
/** announcements */

Vue.component('loading', require('./components/LoadingComponent.vue'));


const app = new Vue({
    el: '#app'
});
  
  
  
  