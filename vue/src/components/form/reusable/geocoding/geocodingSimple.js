Vue.component('geocoding-simple',{
    template : //html 
        `
        <div>
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
                    @exportVal="setLocate($event)"
                    />
                </v-col>
            </v-row>
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
             chosenPostalCodes: []
            }
          },
          methods : {
            setCountry(country){
                this.id_country = country.id
                this.text_country = country.slug
              },
            setProvince(province){
                this.id_province = province.id
                this.text_province = province.slug
            },
            setLocate(locate){
                console.log(locate)
                return
            }
          },
        
    })