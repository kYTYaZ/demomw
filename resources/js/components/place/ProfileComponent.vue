<template>
    <div>
       
<div class="row pop-up" id="popup" ref="popup" v-if="showModal==1 || showModal==3" v-on:click="hidePopUp($event)">
  <div class="popup small-6 large-centered" id="Innerpopup" ref="innerpop"  v-on:click="showFastPopUp($event)" >
      <div v-bind:class="'inner-popup '+successCatch ">
          <div class="headCard"> 
              <loading loading="Cargando" isloading="isLoading"></loading>
              <p class="popup-place-title">{{place.name}}</p>
              <p class="popup-place-type">{{place.types.name}}</p>
              <h3 class="wellcome-text" v-if="isLoading==2">!Bienvenid@!</h3>
              <hr/>
          </div>
          <div class="bodyCard row">
              <div class="col-12">    
                <p class="confirmation-text-sucess" v-if="isLoading==2">Tu Reserva ha sido generada</p>
              </div>
              <div class="col popup-serivice-required">
                  <p class="bold title">Tipo de Servicio</p>
                  <p>Puesto de trabajo {{successCatch}}</p>
              </div>
              <div class="col-4" v-if="isLoading!=2">
                    <img :src="'https://s3.amazonaws.com/meetworks/' + place.type + '_normal.png'"/>
              </div>
          </div>   
          <div class="row">
              <div class="col-12 container-date-time-popup">
                  <p><span class="bold title">Fecha: </span><span class="sub-title-popup">{{datetime}}</span></p>
                  <p><span class="bold title">Hora: </span><span class="sub-title-popup">{{time}}</span></p>
              </div>
              <div class="col-12 assistants-list">
                  <p>
                  <span>Invitados:</span> <span v-for="(email,index) in emailsArray" class="bold">{{email}}<span v-if="emailsArray.length-1 != index">, </span> </span>
                </p>
                <button class="btn btn-default btn-block reservation-button green-button" v-on:click="reservationPost" v-if="isLoading==0 || isLoading==1">Confirmar Reserva</button>
              </div>
          </div>
      </div>
  </div>
</div>       
        
        <div v-bind:class="'cover '+blurFunction()" >
            <div class="container-fluid container-profile-space">
            <div class="row">
                <div class="col-12">
                    <carousel :paginationEnabled="false" :autoplay="false" :perPage="2" paginationActiveColor="#34D785">
                        <slide v-for="(imageSlide, index) in images"   :key="index">
                           <img :src="imageSlide"/>
                        </slide>

                    </carousel>
                </div>
            </div>
        </div>
        <div class="container">
            
        
        <div class="row justify-content-center container-individual-description shadow-lg">
            <div class="col-8 inner-individual-description">
                <div class="container-inner-indificual-desc">
                    
                
                <div class="row">
                    <div class="col-9">
                         <p class="place-name">{{place.name}} <span class="place-type">- {{place.types.name}}</span></p>
                         <p class="location">{{place.neighborhood.name}} - {{place.city.name}} <span v-if="openNow" class="open-text">- <span class="open">Abierto Ahora</span></span></p>
                         <p class="address">{{place.address}} </p>
                    </div>
                    <div class="col-3 container-icon-type-profile">
                        <img :src="'https://s3.amazonaws.com/meetworks/' + place.type + '_normal.png'"/>
                    </div>
                </div>
                
                <div class="services">
                      
                    
                    <p>Características</p>
                    <span v-for="service in place.services">{{service.name}}</span>
                </div>
                
                <div class="description">
                    <p class="description-title">Descripción</p>

                    <div>{{place.description}}</div>
                </div>
                </div>
                
            </div>
            <div class="col-4 adicional-place-info">
                <div class="inner-aditional-place-info">
                    <div class="row">
                        <div class="col-4 container-rating">
                            <p class="rating-number">{{rating}}</p>
                            <p>Calificación</p>
                        </div>
                        <div class="col">
                            <star-rating :round-start-rating="false" :rating="place.rating" :read-only="true" :show-rating="false"  :star-size="19" active-color="#00d983"></star-rating>
                        </div>
                    </div>
                    <div class="row ">
                        <div class=" col-12 ">
                            <div class="separator-individual">
                                
                            </div>
                        </div> 
                    </div> 
                    
                    <div class="row">
                        <div class="col-7 container-datepicker">
                            <vue-ctk-date-time-picker :auto-close="true" format="YYYY-MM-DD" formatted="ddd D MMM YYYY"  disable-time :without-header="false" :overlay-background="true" :min-date="minDate"   v-model="datetime" label="Fecha de la Reserva" color="#37466E"></vue-ctk-date-time-picker>
                        </div>
                        <div class="col-5   container-hours" v-on:click="selectHours" >
                            
                            <v-select  
                                v-model="time"
                                label="Hora" 
                                placeholder="Hora"
 
                                :options="hoursOpened" 
                                ref="dropdown"></v-select>
 
                            
                        </div>
                         
                    </div>
                    <div class="row container-assistants">
                        <div class="col-7">
                            <p>Numero de asistentes</p>
                        </div>
                        <div class="col-5">
                                <number-input v-model="assistants" :min="1" :max="10" inline controls></number-input>

                        </div>
                        
                        <div class="col-12 container-emails-assistants">
                            <div class="individual-container-email" v-for="(index,assistant) in totalAssistants">
                                
                                <img src="/img/email.png"/>
                                <input  type="email" v-on:keyup="validateEmail" v-model="emails[index-1]" placeholder="Correo Electrónico"/>
                            </div>
                            
                            
                        </div>
                        
                         <div class="col-12 container-button-reserv">
                             <div class="alert alert-danger" v-for="emails in emailError" role="alert">
                                 Emails erroneos: <br/>
                                 <strong>{{emails}}</strong>
                              </div>
                             <button class="btn btn-default btn-block reservation-button green-button" @click="reservation">Reservar sin costo</button>
                             <p>Este es un servicio freemium, no tiene 
                                ningun costo generar esta reserva.</p>
                             
                             <p class="container-terms">
                                                                 <a href="/terms">Terminos y condiciones</a>

                             </p>
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
    import StarRating from 'vue-star-rating'
   
   import VueCtkDateTimePicker from 'vue-ctk-date-time-picker';
import 'vue-ctk-date-time-picker/dist/vue-ctk-date-time-picker.min.css';

Vue.component('vue-ctk-date-time-picker', VueCtkDateTimePicker);
   
   
    Vue.component('star-rating', StarRating);
 import VueCarousel from 'vue-carousel';
Vue.use(VueCarousel);

import VueNumberInput from '@chenfengyuan/vue-number-input';

Vue.component(VueNumberInput.name, VueNumberInput);


import vSelect from 'vue-select'
Vue.component('v-select', vSelect) 
    export default {
        mounted() {
            

            this.minDate=this.dateFormat();
                        
                        console.log(this.user,"userrrr")
         
            var images = [];
            for (var i = 0; i < this.place.place_images.length; i++) {
                images.push(this.place.place_images[i].url.replace("thumbnails", "full"))
            }
            setTimeout(() => {
                this.images=images;
            }, 1000);
            
            var d = new Date();
            var n = d.getDay();
            var hour = d.getHours();
            console.log(this.place);
            
            this.rating= parseInt(this.place.rating).toFixed(1);
            
            
            
            if(this.place.hours.length>0){
                var hourHopen=this.place.hours[n-1].hour_open.split(":");
                var hourClose=this.place.hours[n-1].hour_close.split(":");

                var hourTo=0;
                if(hourClose[1]!="00"){
                    hourTo=hourClose[0];
                }
                
                this.hoursOpened=[];

                for (var h = hourHopen[0]; h <= hourTo; h++) {
                    console.log(h,hour);
                    if(h>=hour  ){
                        
                        if(h<=hour){
                            this.openNow=true;
                        }
                    }
                    this.hoursOpened.push(h+":00");
                    this.hoursOpened.push(h+":30");
                }
            }else{
                 for (var h = 10; h <= 23; h++) {
                    
                    this.hoursOpened.push(h+":00");
                    this.hoursOpened.push(h+":30");
                }
            }
           
                   
            console.log('Component mounted.',this.place,this.images,this.hoursOpened)
        },
        methods: {
            reservationPost(){
                this.isLoading=1;
                Event.$emit('loading', {loading:1}, [])
               axios.post('/reservation', {time:this.datetime,hour:this.time,assistants:this.emailsArray,place:this.place.id}).then(response => {
                Event.$emit('loading', {loading:2}, [])
                this.isLoading=2;
                this.successCatch="success"
            })  
            },
            hidePopUp(ev){  
                if(ev.target.id=="popup"){
                    this.showModal=2;
                }
            },
            showFastPopUp(ev){
                this.showModal=3;
            },
            blurFunction(){
                console.log(this.showModal);
                if(this.showModal==1){
                 return "blur-in";
                }else if(this.showModal==2){
                 return "blur-out";
                }else if(this.showModal==3){
                 return "blur-in-fast";
                }else{ 
                 return "blur-out-no";
                }
            },
            validateEmail(){
                
            },
             validateEmail(email) {
                var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
                return re.test(String(email).toLowerCase());
            },
            reservation(){
                Event.$emit('loading', {loading:0}, [])

                this.emailsArray=[];
                this.emailError=[];
                this.emailsArray[0]=this.user.email;
                
                
                
                var emptyEmails=0;
                for(var i=0; i<this.totalAssistants; i++){
                    
                    
                    if(this.emails[i]){    
                        

                        if(this.validateEmail(this.emails[i])){
                            this.emailsArray.push(this.emails[i]);                       
                        }else{
                            
                            this.emailError.push(this.emails[i]);
                        } 
                        
                    }else{
                         emptyEmails++; 

                    }   
                }
               
                if(this.emailError.length>0){
                    return false;
                }
                

                if(!this.datetime){
                    this.$swal("Falta algo", "Ingresá la Fecha de la reserva", "error");
                    return false;
                }
                
                if(!this.time){
                    this.$swal("Falta algo", "Ingresá la Hora de la reserva", "error");
                    return false;
                }

                this.showModal=1;


            },
            selectHours(){
                /* const dropdown  = this.$refs.dropdown
    dropdown.select()*/ 
            },
            chunckImages(array, size){
               var results = [];
                while (array.length) {
                  results.push(array.splice(0, size));
                }
                return results;  
            },
            dateFormat(){
                var x = new Date();
                var y = x.getFullYear().toString();
                var m = (x.getMonth() + 1).toString();
                var d = x.getDate().toString();
                (d.length == 1) && (d = '0' + d);
                (m.length == 1) && (m = '0' + m);
                var yyyymmdd = y +"-"+ m +"-"+ d;
                return yyyymmdd;
            }
        },
        watch:{
            assistants (val) {
                this.totalAssistants=val-1;
           }
        },
    data: function() {
        return {
            datetime: null,
            minDate:null,
            images:[],
            hoursOpened:[],
            time:null,
            assistants:0,
            openNow:false,
            rating:0,
            showModal: 4,
            emails:[],
            emailsArray:[],
            emailError:[],
            totalAssistants:0, 
            isLoading:0,
            successCatch:"no-success"
            
              
            
  
        };
    },
        props: {
            place: {
                type: Object
            },user: {
                type: Object
            }
        }
    }
</script>
 