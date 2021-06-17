Vue.component('alert-info-user', {
    template: //html 
        `
        <div>
            <v-alert
            class="py-3"
            border="right"
            colored-border
            type="info"
            elevation="2"
            icon="mdi-map-marker-right"
            >
            <v-row class="mx-1 d-flex justify-between ">
                <template  v-if="info.name_assigned && info.name_assigned !== '' && info.name_assigned !== null && info.name_assigned !== ' '" >
                    <v-col cols="12" lg="6" class="pa-1 " >
                    <strong>Nombre :</strong> {{info.name_assigned}} {{info.name_alternative}}
                    </v-col>
                </template>
            
                <v-col cols="12" lg="6" class="pa-1 ">
                    <strong>Pais :</strong> {{info.name_country}}
                </v-col>
                <v-col cols="12" lg="6" class="pa-1 ">
                    <strong>Provincia :</strong> {{info.province}}
                </v-col>
                <v-col cols="12" lg="6" class="pa-1 ">
                    <strong>Localidad :</strong> {{info.locate}}
                </v-col>

                <template  v-if="info.home_address && info.home_address !== '' && info.home_address !== null && info.home_address !== ' '" >
                    <v-col cols="12" lg="6" class="pa-1 ">
                        <strong>Dirección :</strong> {{info.home_address}}
                    </v-col>
                </template>
                <template  v-if="info.type" >
                    <v-col cols="12" lg="6" class="pa-1 ">
                    <strong>Tipo :</strong> {{info.type}}
                    </v-col>
                </template>
                <template v-if="info.postal_code">
                    <v-col cols="12" lg="6" class="pa-1 ">
                    <strong>CP :</strong> {{info.postal_code}}
                    </v-col>
                </template>
                
            </v-row>
            </v-alert>    
        </div>
        `,
    props: ['info'],
    data() {
        return {

        }
    },


    // agregar dos input para colocar el rango de codigo postal, buscar y mostrar


})