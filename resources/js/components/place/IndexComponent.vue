<template>

    <div>

        <transition name="fade">

            <div v-bind:class="'container-filter-spaces shadow-lg size_'+markersInMap.length"  v-if="markersInMap.length>0" v-show="!placeIn">
                <div v-bind:class="'container-inner-filter-spaces'">

                    <div v-for="(m,index) in markersInMap"  v-if="m.place_images.length>0" >
                        <div class="row container-card-map"  >
                            <div class="col-5 container-card-image">
                                <img :src="m.place_images[0].url"/>
                                <img class="icon-card-map" :src="m.icon"/>
                            </div>
                            <div class="col-7">
                                <div class="row">
                                    <div class="col-8 container-text-card-map">
                                        <p><strong>{{m.name}}</strong> <span>/</span> <span class="category-card-map">{{m.types.name}}</span></p>
                                        <p>{{m.address}}</p>
                                        <div><p v-for="service in m.services">{{service.name}}</p></div>
                                        <p v-if="m.hours[dayOfTheWeek]">{{m.hours[dayOfTheWeek].hour_open}} {{m.hours[dayOfTheWeek].hour_close}}</p>

                                        <div class="row container-general-assistants">
                                            <div class="container-assistants col-3"> 
                                                <img  v-for=" user in m.assistansUsers['users']" class="rounded-circle" :src="user.image"/>
                                            </div> 
                                            <div v-if="m.assistansUsers['users'].length>0" class="container-name-assistants col-9">
                                                <span v-for=" (user, index) in m.assistansUsers['users']"> {{user.name.split(" ")[0]}}  <span v-if="index<m.assistansUsers['users'].length-1">, </span></span>
                                                <span> han reservado acá</span>
                                            </div> 
                                        </div>

                                    </div>
                                    <div class="col-4 container-rating-view">
                                        <div class="container-content-rating">
                                            <div class="container-rating">
                                                <star-rating :round-start-rating="false" :rating="m.rating" :read-only="true" :show-rating="false"  :star-size="19" active-color="#00d983"></star-rating>
                                                <p><strong>Calificación:</strong> {{m.rating}} </p>
                                            </div>
                                        </div>


                                    </div>
                                    <div class="col-12">
                                        <button class="btn btn-default button-view-space"  v-on:click="goToPlace(m)">Ver Espacio</button>

                                    </div>
                                </div>
                            </div>



                        </div> 
                    </div>
                </div>
            </div>
        </transition>  


        <transition name="fade">

            <div class="container-filter-spaces shadow-lg individual-filter-content-map" v-if="placeIn">
                <div class="container-inner-filter-spaces">

                    <div class="row container-card-map"  >
                        <div class="col-12 container-card-image ">
                            <carousel :perPage="1" paginationActiveColor="#34D785">
                                <slide v-for="(imageSlide, index) in placeSelected.images"   :key="index">
                                    <img :src="imageSlide"/>
                                </slide>

                            </carousel>


                        </div>
                        <div class="col-12 card-individual-map">
                            <div class="row">
                                <div class="col-2 detail-card-place">
                                    <img  class="icon-card-map" :src="placeSelected.icon"/>
                                </div>
                                <div class="col-5 container-text-card-map">
                                    <p><strong>{{placeSelected.name}}</strong> <span>/</span> <span class="category-card-map">{{placeSelected.types.name}}</span></p>
                                    <p>{{placeSelected.address}}</p>
                                    <div><p v-for="service in placeSelected.services">{{service.name}}</p></div>
                                    <p v-if="placeSelected.hours[dayOfTheWeek]">{{placeSelected.hours[dayOfTheWeek].hour_open}} {{placeSelected.hours[dayOfTheWeek].hour_close}}</p>

                                    <div class="row container-general-assistants">
                                        <div class="container-assistants col-3"> 
                                            <img  v-for=" user in placeSelected.assistansUsers['users']" class="rounded-circle" :src="user.image"/>
                                        </div> 
                                        <div v-if="placeSelected.assistansUsers['users'].length>0" class="container-name-assistants col-9">
                                            <span v-for=" (user, index) in placeSelected.assistansUsers['users']"> {{user.name.split(" ")[0]}}  <span v-if="index<placeSelected.assistansUsers['users'].length-1">, </span></span>
                                            <span> han reservado acá</span>
                                        </div> 
                                    </div>

                                </div>
                                <div class="col-5 container-rating-view">
                                    <div class="container-content-rating">
                                        <div class=" row">
                                            <div class="col-6 rating-detail-card">
                                                <p><span>Calificación:</span> {{placeSelected.rating}} </p>
                                            </div>
                                            <div class="col-6">
                                                <star-rating :round-start-rating="false" :rating="placeSelected.rating" :read-only="true" :show-rating="false"  :star-size="19" active-color="#00d983"></star-rating>
                                            </div>


                                        </div>
                                        <div class="row">
                                            <div class="col-12 container-view-space ">
                                                <button class="btn btn-default  button-card-individual" v-on:click="goToPlace(placeSelected)">Ver Espacio</button>
                                            </div>
                                        </div>
                                    </div>


                                </div>

                            </div>
                        </div>



                    </div> 
                </div>
            </div>
        </transition>

        <GmapMap
            :center="{lat:10, lng:10}"
            :zoom="15"
            map-type-id="terrain"
            ref="mapRef"
            class="places-map"
            @dragend="filterMarkers"
            @tilesloaded="filterMarkers"
            @click="resetIndividual"
            >




            <GmapMarker
                :key="index"
                v-for="(m, index) in placesProp"
                :position="m.position"
                :clickable="true"
                :draggable="false"
                :icon="{ url: m.icon}"
                @click="iconClickMap(m)"


                />

    </GmapMap>


</div>        


</template>

<script>
   import * as VueGoogleMaps from 'vue2-google-maps'
import GmapCluster from 'vue2-google-maps/dist/components/cluster'
import StarRating from 'vue-star-rating'
Vue.component('star-rating', StarRating);

import VueCarousel from 'vue-carousel';
Vue.use(VueCarousel);

Vue.use(VueGoogleMaps, {
    load: {
        key: 'AIzaSyDcq1A1sW6jfx54cAvR9TlGO1RRHIPwuw8',
        libraries: 'places',
        v: '3.26'
    },

})

Vue.component('GmapCluster', GmapCluster)

export default {
    mounted() {

        this.placesArray = this.places;
        Event.$on('itemFind', (item, response) => {
            this.findById(item.id);
        });

        Event.$on('filterMap', (filters, response) => {
            this.filterPlaces(filters);
        });

        Event.$on('findNeighborhood', (neighborhood, response) => {
            this.panToNeighborhood(neighborhood);
        });




        var d = new Date();
        var n = d.getDay();
        this.dayOfTheWeek = n;

        this.$refs.mapRef.$mapPromise.then((map) => {
 
            map.setOptions({
    styles: [
            {   
                "elementType": "geometry",
                "stylers": [
                    {
                         "color": "#d8dfea"
                    }, 
                    {
                        "visibility": "on"
                    }
                ]
            },
            {
                "elementType": "labels.text.fill",
                "stylers": [
                    {
                        "color": "#434e6c"
                    }
                ]
            },
            {
                "featureType": "administrative",
                "elementType": "geometry",
                "stylers": [
                    {
                        "visibility": "off"
                    }
                ]
            },
            {
                "featureType": "administrative",
                "elementType": "geometry.stroke",
                "stylers": [
                    {
                        "color": "#434e6c"
                    }
                ]
            },
            {
                "featureType": "administrative.land_parcel",
                "elementType": "geometry.stroke",
                "stylers": [
                    {
                        "color": "#434e6c"
                    }
                ]
            },
            {
                "featureType": "administrative.land_parcel",
                "elementType": "labels",
                "stylers": [
                    {
                        "color": "#9aacc5"
                    }
                ]
            },
            {
                "featureType": "administrative.land_parcel",
                "elementType": "labels.text.fill",
                "stylers": [
                    {
                        "color": "#ae9e90"
                    }
                ]
            },
            {
                "featureType": "landscape.man_made",
                "elementType": "geometry",
                "stylers": [
                    {
                        "visibility": "on"
                    }
                ]
            },
            {
                "featureType": "landscape.natural",
                "elementType": "geometry",
                "stylers": [
                    {
                        "color": "#9aacc5"
                    }
                ]
            },
            {
                "featureType": "poi",
                "stylers": [
                    {
                        "visibility": "off"
                    }
                ]
            },
            {
                "featureType": "poi",
                "elementType": "geometry",
                "stylers": [
                    {
                        "color": "#63718b"
                    }
                ]
            },
            {
                "featureType": "poi",
                "elementType": "labels.text.fill",
                "stylers": [
                    {
                        "color": "#434e6c"
                    }
                ]
            },
            {
                "featureType": "poi.park",
                "elementType": "labels.text.fill",
                "stylers": [
                    {
                        "color": "#63718b"
                    }
                ]
            },
            {
                "featureType": "road",
                "elementType": "geometry",
                "stylers": [
                    {
                        "color": "#ffffff"
                    }
                ]
            },
            {
                "featureType": "road",
                "elementType": "labels.icon",
                "stylers": [
                    {
                        "visibility": "off"
                    }
                ]
            },
            {
                "featureType": "road.arterial",
                "elementType": "geometry",
                "stylers": [
                    {
                        "color": "#ffffff"
                    }
                ]
            },
            {
                "featureType": "road.highway",
                "elementType": "geometry",
                "stylers": [
                    {
                        "color": "#63718b"
                    },
                    {
                        "saturation": -5
                    },
                    {
                        "visibility": "simplified"
                    }
                ]
            },
            {
                "featureType": "road.highway.controlled_access",
                "elementType": "geometry",
                "stylers": [
                    {
                        "color": "#63718b"
                    }
                ]
            },
            {
                "featureType": "road.highway.controlled_access",
                "elementType": "geometry.fill",
                "stylers": [
                    {
                        "color": "#434e6c"
                    }
                ]
            },
            {
                "featureType": "road.local",
                "elementType": "labels.text.fill",
                "stylers": [
                    {
                        "color": "#434e6c"
                    }
                ]
            },
            {
                "featureType": "transit",
                "stylers": [
                    {
                        "visibility": "off"
                    }
                ]
            },
            {
                "featureType": "transit.line",
                "elementType": "geometry",
                "stylers": [
                    {
                        "color": "#63718b"
                    }
                ]
            },
            {
                "featureType": "transit.line",
                "elementType": "labels.text.fill",
                "stylers": [
                    {
                        "color": "#63718b"
                    }
                ]
            },
            {
                "featureType": "transit.line",
                "elementType": "labels.text.stroke",
                "stylers": [
                    {
                        "color": "#63718b"
                    }
                ]
            },
            {
                "featureType": "transit.station",
                "elementType": "geometry",
                "stylers": [
                    {
                        "color": "#63718b"
                    }
                ]
            },
            {
                "featureType": "water",
                "elementType": "geometry.fill",
                "stylers": [
                    {
                        "color": "#9aacc5"
                    }
                ]
            },
            {
                "featureType": "water",
                "elementType": "labels.text.fill",
                "stylers": [
                    {
                        "color": "#63718b"
                    }
                ]
            }
        ]
  });
            var markers = map.markers;
            map.panTo({
                lat: -34.5734283,
                lng: -58.456035
            })

        })


    },
    data: function() {
        return {
            markers: [],
            markersInMap: [],
            dayOfTheWeek: 0,
            placeIn: false,
            placesArray: [],
            placeSelected: {
                "name": null,
                images: [],
                types: null,
                address: null,
                services: [],
                hours: [],
                rating: []
            }
        };
    },
    computed: {
        placesProp: {
            get: function() {
                return this.placesArray;
            },
            set: function(array) {
                //this.places=array;
                this.placesArray = array;
                this.filterMarkers();
            }
        }
    },
    methods: {

        fromfar() {
            alert("ss");
        },
        changeTabProfile: function(tab) {
            this.showTab = tab;
        },
        panToNeighborhood(latlon) {
            this.$refs.mapRef.$mapPromise.then((map) => {
                map.panTo({
                    lat: parseFloat(latlon.lat),
                    lng: parseFloat(latlon.lng)
                })
            });
            this.goToNearMarker();

        },
        goToPlace(place){
            window.open("/"+place.slug);
        },
        resetIndividual() {
            this.placeIn = false;

            if (this.placeSelected.name != null) {
                this.placeSelected.icon = "https://s3.amazonaws.com/meetworks/" + this.placeSelected.type + "_normal.png";
            }
            this.placeSelected = {
                "name": null,
                images: [],
                types: null,
                address: null,
                services: [],
                hours: [],
                rating: []
            };
        },
        filterPlaces(filters) {


            axios.post('/filterPlaces', filters).then(response => {
                this.placesArray = response.data;
                this.filterMarkers();

            })
        },
        findById(id) {
            axios.post('/findById', {
                id: id
            }).then(response => {
                this.iconClickMap(response.data);
            })

        },
        rad2degr(rad) {
            return rad * 180 / Math.PI;
        },
        degr2rad(degr) {
            return degr * Math.PI / 180;
        },
        getLatLngCenter(latLngInDegr) {
            var LATIDX = 0;
            var LNGIDX = 1;
            var sumX = 0;
            var sumY = 0;
            var sumZ = 0;

            for (var i=0; i<latLngInDegr.length; i++) {
                var lat = this.degr2rad(latLngInDegr[i][LATIDX]);
                var lng = this.degr2rad(latLngInDegr[i][LNGIDX]);
                // sum of cartesian coordinates
                sumX += Math.cos(lat) * Math.cos(lng);
                sumY += Math.cos(lat) * Math.sin(lng);
                sumZ += Math.sin(lat);
            }

            var avgX = sumX / latLngInDegr.length;
            var avgY = sumY / latLngInDegr.length;
            var avgZ = sumZ / latLngInDegr.length;

            // convert average x, y, z coordinate to latitude and longtitude
            var lng = Math.atan2(avgY, avgX);
            var hyp = Math.sqrt(avgX * avgX + avgY * avgY);
            var lat = Math.atan2(avgZ, hyp);

            return ([this.rad2degr(lat), this.rad2degr(lng)]);
        },
        goToNearMarker() {
            var markersInNeighborhood = [];
            this.$refs.mapRef.$mapPromise.then((map) => {

                var bounds = map.getBounds();  

                this.placesArray.forEach(marker => {


                    let m = new window.google.maps.Marker(marker);

                    if (bounds.contains(m.getPosition())) {
                        markersInNeighborhood.push([marker.lat,marker.lng]);
                    }



                });
                
                
            
                var nearMaker =this.getLatLngCenter(markersInNeighborhood);
                map.panTo({
                    lat: nearMaker[0],
                    lng: nearMaker[1]
                })
                
                var w = window.innerWidth;

                map.panBy(((w / 2) / 2) * (-1), -50);

            });
        },
        filterMarkers() {
            this.$refs.mapRef.$mapPromise.then((map) => {


                var bounds = map.getBounds();

                this.markersInMap = [];
                this.placesArray.forEach(marker => {


                    let m = new window.google.maps.Marker(marker);

                    if (bounds.contains(m.getPosition())) {

                        this.markersInMap.push(marker);

                    }

                });
                console.log("desues ", this.markersInMap);

                console.log(this.markersInMap);

            });


        },
        
        
        iconClickMap(icon) {

             
            this.placeIn = false;
            this.$refs.mapRef.$mapPromise.then((map) => {

                var w = window.innerWidth;
                map.panTo({
                    lat: parseFloat(icon.lat),
                    lng: parseFloat(icon.lng)
                })
                console.log(((w / 2) / 2) * (-1));
                map.panBy(((w / 2) / 2) * (-1), -50);

            })

            var images = [];
            for (var i = 0; i < icon.place_images.length; i++) {
                images.push(icon.place_images[i].url.replace("thumbnails", "full"))
            }
            icon.images = images;
            this.placeSelected = icon;

            
            
             this.placesArray.forEach(marker => {


                    if(marker.id==icon.id){
                        marker.icon = "https://s3.amazonaws.com/meetworks/" + marker.type + "_hover.png";
                    }else{
                        marker.icon = "https://s3.amazonaws.com/meetworks/" + marker.type + "_normal.png";

                    }
                    

                });
                this.placeSelected.icon="https://s3.amazonaws.com/meetworks/" + this.placeSelected.type + "_hover.png";


            this.placeIn = true;

        }
    },
    props: {
        places: {
            type: Array
        }
    }
}
</script>
