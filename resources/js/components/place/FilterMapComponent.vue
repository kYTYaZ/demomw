<template>
    <div class="container-fluid">
       <nav class="navbar navbar-expand-lg nav-bar-filters">
        
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
          <ul class="navbar-nav">
            <li class="nav-item dropdown">
                <span>Tipo de servicio</span>

              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  {{selected_services_text}}
              </a>

              <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                  <a class="dropdown-item" v-if="selected_services!=-1"   href="javascript:void(0)" v-on:click="filterBy('services',-1,'Todos los servicios')">Todos los servicios</a>

                  <a class="dropdown-item " v-for="service in services" href="javascript:void(0)" v-on:click="filterBy('services',service.id,service.name)">
                      {{service.name}}</a>
              </div>
            </li>
            
            <li class="nav-item dropdown">
            <span>Establecimiento</span>

              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
               {{selected_types_text}}

              </a>

              <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                <a class="dropdown-item"  v-if="selected_types!=-1"   href="javascript:void(0)" v-on:click="filterBy('types',-1,'Todos los establecimientos')">Todos los establecimientos</a>
                <a class="dropdown-item" v-for="type in types"  href="javascript:void(0)" v-on:click="filterBy('types',type.id,type.name)">{{type.name}}</a>
                
              </div>
            </li>
            
            <li class="nav-item dropdown">
                <span></span>

              <a class="nav-link dropdown-toggle no-border" href="#"  id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                {{selected_extra_text}}
              </a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                <a class="dropdown-item " v-for="extra in extras"  href="javascript:void(0)"  v-on:click="filterBy('extras',extra.id,extra.name)">{{extra.name}}</a>
               
              </div>
            </li>
          </ul>
        </div>
        <form class="form-inline">
            <input class="form-control mr-sm-2 input-search-head" v-on:keyup="searchSpace" v-model="search_text" type="search" placeholder="Buscar Espacio de Trabajo" aria-label="Search">
      
            <div class="results-search shadow-lg" v-if="search_result_array.length>0 && search_text.length>3">
                <div v-for="result in search_result_array" v-on:click="emitSearch(result)" class='row individual_result_search' >
                    <div class="col-7">
                        <img :src="'/img/placeIcon_'+result.type+'.png'"/> {{result.name}}  
                    </div>
                    <div class="col-5">
                        <star-rating :round-start-rating="false" :rating="result.rating" :read-only="true" :show-rating="false"  :star-size="19" active-color="#00d983"></star-rating>
                    </div>                                            
                </div>
            </div>
        </form>
      </nav>  
    </div>
</template>

<script>
    
      import StarRating from 'vue-star-rating'
            Vue.component('star-rating', StarRating);
    export default {
        mounted() {
            console.log('Component mounted.')
            this.getServicesAndSpaces();
        },
        data: function () {
             return {
                services: [],
                types: [],
                extras: [],
                selected_services:-1,
                selected_types:-1,
                selected_extras:0,
                selected_services_text:"Todos los servicios",
                selected_types_text:"Todos los establecimientos",
                selected_extra_text:"Recomendados",
                search_text:null,
                search_result_array:[]
              
            };
            
        },
        methods: {
            filterBy(filter,value,text){
                
                if(filter=="services"){
                    this.selected_services=value;
                    this.selected_services_text=text;
                }else if(filter=="types"){
                    this.selected_types=value;
                    this.selected_types_text=text;

                }else if(filter=="extras"){
                    this.selected_extras=value;
                    this.selected_extra_text=text;

                }
                
                Event.$emit('filterMap', {services:this.selected_services,types:this.selected_types,extras:this.selected_extras}, [])

                console.log(this.selected_services,this.selected_types,this.selected_extras);
            },
            getServicesAndSpaces(){
                 axios.post('/getServicesAndSpaces',{}).then(response => {
                     this.services=response.data.services;
                     this.types=response.data.types;
                     this.extras=response.data.extras;
                    console.log(response.data);
                 })  
            },
            emitSearch(place){
            
                Event.$emit('itemFind', place, [])
                this.search_text=place.name;
                this.search_result_array=[];

            },
            searchSpace(){
                
                if(this.search_text.length>3){
                    axios.post('/searchSpace',{"q":this.search_text}).then(response => {
                        
                        this.search_result_array=response.data;
                 }) 
                }else{
                        this.search_result_array=[];
                }
                  
            } 
        }
    }
</script>
