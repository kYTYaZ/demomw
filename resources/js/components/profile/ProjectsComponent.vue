<template>
    <div class="row">

        <div class="container">
            <div class="row">
                <div class="col col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="ui-block responsive-flex">
                        <div class="ui-block-title">
                            <div class="h6 title">James’s Friends (86)</div>
                            <div class="w-select">
                                <div class="title">Order By:</div>
                                <fieldset class="form-group">
                                    <select class="selectpicker form-control">
                                        <option value="NU">Number of Favourites</option>
                                        <option value="NU">Number of Photos</option>
                                        <option value="NU">Number of Videos</option>
                                    </select>
                                </fieldset>
                            </div>

                            <form class="w-search">
                                <div class="form-group with-button">
                                    <input class="form-control" type="text" placeholder="Search Fav Pages...">
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

        <div class="container">
            <div class="row">
                <div class="col col-xl-3 col-lg-6 col-md-6 col-sm-6 col-6" v-for="item in projects">
                    <div class="ui-block">


                        <!-- Friend Item -->

                        <div class="friend-item fav-page">
                            <div class="friend-header-thumb">
                                <img src="/img/fav1.jpg" alt="friend">
                            </div>

                            <div class="friend-item-content">

                                <div class="more">
                                    <svg class="olymp-three-dots-icon"><use xlink:href="/svg-icons/sprites/icons.svg#olymp-three-dots-icon"></use></svg>
                                    <ul class="more-dropdown">
                                        <li>
                                            <a href="#">Report Profile</a>
                                        </li>
                                        <li>
                                            <a href="#">Block Profile</a>
                                        </li>
                                        <li>
                                            <a href="#">Turn Off Notifications</a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="friend-avatar">
                                    <div class="author-thumb">
                                        <img src="/img/avatar9.jpg" alt="author">
                                    </div>
                                    <div class="author-content">
                                        <a href="#" class="h5 author-name">Green Goo Rock</a>
                                        <div class="country">Rock Band</div>
                                    </div>
                                </div>

                                <div class="swiper-container">
                                    <div class="swiper-wrapper">
                                        <div class="swiper-slide">
                                            <div class="friend-count" data-swiper-parallax="-500">
                                                <a href="#" class="friend-count-item">
                                                    <div class="h6">48</div>
                                                    <div class="title">Photos</div>
                                                </a>
                                               
                                                <a href="#" class="friend-count-item">
                                                    <div class="h6">12</div>
                                                    <div class="title">Videos</div>
                                                </a>
                                            </div>
                                            <div class="control-block-button" data-swiper-parallax="-100">
                                                <a href="#" class="btn btn-control bg-primary">
                                                    <svg class="olymp-star-icon"><use xlink:href="/svg-icons/sprites/icons.svg#olymp-star-icon"></use></svg>
                                                </a>

                                                <a href="#" class="btn btn-control bg-purple">
                                                    <svg class="olymp-chat---messages-icon"><use xlink:href="/svg-icons/sprites/icons.svg#olymp-chat---messages-icon"></use></svg>
                                                </a>

                                            </div>
                                        </div>

                                        <div class="swiper-slide">
                                            <p class="friend-about" data-swiper-parallax="-500">
                                                We are Rock Band from Los Angeles, now based in San Francisco, come and listen to us play!
                                            </p>

                                            <div class="friend-since" data-swiper-parallax="-100">
                                                <div>Website:</div>
                                                <a href="#" class="h6">www.ggrock.com</a>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- If we need pagination -->
                                    <div class="swiper-pagination"></div>
                                </div>
                            </div>
                        </div>


                        <!-- ... end Friend Item -->			</div>
                </div>
               
            </div>
        </div>


    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        },
        
        data:function(){
             return {
                 projects:[1,2,3,4,5]
             };
        }
    }
</script>
