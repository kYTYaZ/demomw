<template>
    <div class="filter-city-component">
        <p class="subtitle" v-on:click="focus">Búscar en barrio</p>
        <p class="placeholder-input-filters">{{placeholderText}}</p>
        <input class="input-text-filters" ref="search" v-on:keydown.9="tabResoult" v-on:keyup.13="tabResoult" v-on:keyup="findNeighborhood" v-model="inputSearchFilter" value="Palermo"/>
    </div>
</template>

<script> 
    export default {
        mounted() {
            console.log('Component mounted.')
        },
        data: function () {
            return {
                placeholderText:"Palermo",
                inputSearchFilter:"Palermo",
                currentNeighborhood:null
            };
        },
        methods: {
            focus(){
                               this.$refs.search.focus();
 
            },
            tabResoult(){
                this.inputSearchFilter=this.placeholderText;
                
              
                Event.$emit('findNeighborhood', this.currentNeighborhood, [])
                    
                     setTimeout(() => {
                        this.$refs.search.focus();
                    }, 100);
                    

            },
            findNeighborhood(event){
                
                if(this.inputSearchFilter.length==0){
                    this.placeholderText="Escribe un Barrio";
                }
                if(this.inputSearchFilter.length>0){
                    this.placeholderText="";
                }
                if(this.inputSearchFilter.length>2){
                    this.inputSearchFilter=this.inputSearchFilter.replace(/\b\w/g, l => l.toUpperCase());
                    axios.post('/findNeighborhood', {q: this.inputSearchFilter}).then(response => {

                           if(response.data.length>0){
                               this.placeholderText=response.data[0].name;
                               this.currentNeighborhood=response.data[0];
                           }

                   })
                }
                
            }
        }
    }
</script>
