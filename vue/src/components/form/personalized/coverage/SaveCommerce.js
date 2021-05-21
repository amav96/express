Vue.component('save-commerce',{
    template : //html 
        `
        <div>
             <v-container>
                <h6 class="ml-4 my-5"> Comercio </h6>
                <v-row class="d-flex justify-start flex-row" >
                    <v-col  cols="12" xl="4" lg="4" md="6" sm="6" xs="4"  >
                        <select-auto-complete-simple-id 
                        @exportVal="setUser($event)"
                        :title="save.commerce.title_field" 
                        :url="save.commerce.url_users" />
                    </v-col>
                    <v-col  cols="12" xl="4" lg="4" md="6" sm="6" xs="4"  >
                        <span> {{infoUser}} </span>
                    </v-col>
                    
                </v-row>

                <h6 class="ml-4 my-5"> Dirección del comercio (Geocodificar)</h6>
                 <template>
                    <geocoding-simple
                    :save="save"
                    />
                 </template>


                <h6 class="ml-4 my-5"> Zona a cubir </h6>
                <v-row class="d-flex justify-center flex-row" >
                    <v-col  cols="12" xl="4" lg="4" md="6" sm="6" xs="4"  >
                        <select-auto-complete-simple-id 
                        title="Ingrese País" 
                        :url="save.zone.url_country"
                        @exportVal="setCountry($event)"
                            />
                    </v-col>
                    <v-col  cols="12" xl="4" lg="4" md="6" sm="6" xs="4"  >
                        <select-auto-complete-search-id 
                        :searchID="id_country"
                        title="Ingrese Provincia" 
                        :url="save.zone.url_province"
                        @exportVal="setProvince($event)" 
                        />
                    </v-col>

                    <v-col  cols="12" xl="4" lg="4" md="6" sm="6" xs="4"  >
                        <select-auto-complete-search-id 
                        :searchID="id_province"
                        title="Ingrese Localidad" 
                        :url="save.zone.url_locate"
                        @exportVal="getPostalCodes($event)"
                        />
                    </v-col>
                   
                </v-row>
                
                    <template v-if="save.zone.postal_codes.length > 0" >
                        <h6 class="ml-4 my-5" > Seleccione codigos postales</h6>
                            <switches-common
                            :options="save.zone.postal_codes"
                            @setOptions="chosenPostalCodes = $event"
                            />
                    </template>

                </v-container>
        </div>
        `,
    props:{
        save : {
            type : Object
        }
    },
    data () {
        return {
         id_country : '',
         text_country : '',
         id_province : '',
         text_province : '',
         locate : '',
         text_locate:'',
         id_user : '',
         chosenPostalCodes: [],
         infoUser : []
        }
      },
      methods : {
        setUser(user){
            this.infoUser = user
        },
        setCountry(country){
            this.id_country = country.id
            this.text_country = country.slug
          },
        setProvince(province){
            this.id_province = province.id
            this.text_province = province.slug
        },
        getPostalCodes(locate){
            const url = this.save.zone.url_postalCode
            axios.get(url,{
                params : {
                    id_country : this.id_country,
                    id_province : this.id_province,
                    locate : locate.slug
                }
            })
            .then(res => {
                if(res.data.error){
                    alertNegative("No hay datos disponibles")
                    return
                }
                const postal_codes = res.data.map(key => key.postal_code)
                this.chosenPostalCodes = []
                this.save.zone.postal_codes = []
                this.save.zone.postal_codes = postal_codes
               
            })
            .catch(err => {
                console.log(err)
            })
        }
      },

      
     
    
    })