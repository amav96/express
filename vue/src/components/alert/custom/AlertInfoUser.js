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
            icon="mdi-store"
            >
            <v-row class="mx-1 d-flex justify-between ">
                <template  v-if="info.data.name_assigned !== '' && info.data.name_assigned !== null" >
                    <v-col cols="12" lg="6" class="pa-1 " >
                    <strong>Nombre :</strong> {{info.data.name_assigned}} {{info.data.name_alternative}}
                    </v-col>
                </template>
            
                <v-col cols="12" lg="6" class="pa-1 ">
                    <strong>Pais :</strong> {{info.data.name_country}}
                </v-col>
                <v-col cols="12" lg="6" class="pa-1 ">
                    <strong>Provincia :</strong> {{info.data.province}}
                </v-col>
                <v-col cols="12" lg="6" class="pa-1 ">
                    <strong>Localidad :</strong> {{info.data.locate}}
                </v-col>

                <template  v-if="info.data.home_address !== '' && info.data.home_address !== null" >
                    <v-col cols="12" lg="6" class="pa-1 ">
                        <strong>Dirección :</strong> {{info.data.home_address}}
                    </v-col>
                </template>
                <v-col cols="12" lg="6" class="pa-1 ">
                    <strong>Tipo :</strong> {{info.data.type}}
                </v-col>
                <v-col cols="12" lg="6" class="pa-1 ">
                    <strong>CP :</strong> {{info.data.postal_code}}
                </v-col>

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