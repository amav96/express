Vue.component('save-commerce',{
    template : //html 
        `
        <div>
             <v-container>
                <h5 class="ml-4"> Zona a cubir </h5>
                <v-row class="d-flex justify-center flex-row" >
                        <v-col  cols="12" xl="4" lg="4" md="4" sm="4" xs="4"  >
                            <select-auto-complete-simple-id 
                            @exportVal="id_user = $event"
                            title="Ingrese País" 
                            :url="save.zone.url_country" />
                        </v-col>
                        <v-col  cols="12" xl="4" lg="4" md="4" sm="4" xs="4"  >
                            <select-auto-complete-simple-id 
                            @exportVal="id_user = $event"
                            title="Ingrese Provincia" 
                            :url="save.commerce.url_users" />
                        </v-col>
                        <v-col  cols="12" xl="4" lg="4" md="4" sm="4" xs="4"  >
                            <select-auto-complete-simple-id 
                            @exportVal="id_user = $event"
                            title="Ingrese Localidad" 
                            :url="save.commerce.url_users" />
                        </v-col>
                    </v-row>
                    <v-row class="d-flex justify-start flex-row" >
                        <v-col  cols="12" xl="4" lg="4" md="4" sm="8" xs="4"  >
                            <select-auto-complete-simple-id 
                            @exportVal="id_user = $event"
                            :title="save.commerce.title_field" 
                            :url="save.commerce.url_users" />
                        </v-col>
                    </v-row>
                    
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
         id_user : ''
        }
      },
     
    
    })