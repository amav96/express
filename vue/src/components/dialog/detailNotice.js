Vue.component('dialog-detail-notice',{
    template : //html 
        `       
                <div>
                    <v-dialog
                    v-model="detailNotice.dialog"
                    persistent
                    max-width="500px"
                    
                    >
                        <v-card>
                        <v-card-title class="headline" >
                            <h4>Detalle de aviso</h4>
                        </v-card-title>
    
                        <v-card-text>
                            <v-container fluid >
                                <v-row align="center"  class="d-flex justify-center" >

                                        <v-list-item three-line>
                                            <v-list-item-content>
                                                <v-row>
                                                    <v-col cols="12" lg="6">
                                                        <v-list-item-title class="caption mb-1">
                                                            <strong>Nombre Cliente</strong>
                                                        </v-list-item-title>
                                                        <v-list-item-subtitle>
                                                            {{detailNotice.data.nombre_cliente}}
                                                        </v-list-item-subtitle>
                                                    </v-col>

                                                    <v-col cols="12" lg="6">
                                                        <v-list-item-title class="caption mb-1">
                                                            <strong>Identificacion</strong>
                                                        </v-list-item-title>
                                                        <v-list-item-subtitle>
                                                            {{detailNotice.data.identificacion}}
                                                        </v-list-item-subtitle>
                                                    </v-col>

                                                    <v-col cols="12" lg="6">
                                                        <v-list-item-title class="caption mb-1">
                                                            <strong>Ubicaciòn</strong>
                                                        </v-list-item-title>
                                                        <v-list-item-subtitle>
                                                            {{detailNotice.data.direccion}} - {{detailNotice.data.localidad}} -{{detailNotice.data.provincia}} 
                                                        </v-list-item-subtitle>
                                                    </v-col>

                                                    <v-col cols="12" lg="6">
                                                        <v-list-item-title class="caption mb-1">
                                                            <strong>Contacto</strong>
                                                        </v-list-item-title>
                                                        <v-list-item-subtitle>
                                                            {{detailNotice.data.contacto}}
                                                        </v-list-item-subtitle>
                                                    </v-col>

                                                    <v-col cols="12" lg="6">
                                                        <v-list-item-title class="caption mb-1">
                                                            <strong>Fecha de envio</strong>
                                                        </v-list-item-title>
                                                        <v-list-item-subtitle>
                                                            {{detailNotice.data.fecha_aviso_visita}}
                                                        </v-list-item-subtitle>
                                                    </v-col>

                                                </v-row>
                                            </v-list-item-content>
                                        </v-list-item>

                                        <v-col cols="12" md="12">
                                            <v-btn
                                            color="success"
                                            block
                                            @click="showMap"
                                            >
                                            Ubicación de envio
                                                <v-icon right>
                                                    mdi-crosshairs-gps
                                                </v-icon>
                                            </v-btn>
                                        </v-col>
                                </v-row>
                                    
                            </v-container>
                        </v-card-text>
    
                        <v-card-actions>
                            
                            <v-spacer></v-spacer>
                            <v-btn
                            color="error"
                            @click="closeDialog"
                            >
                            Salir
                            </v-btn>
                        </v-card-actions>
                        </v-card>
                </v-dialog>
               
            </div>
        `,
    props:['detailNotice',],
    data (){
    return {
    }
    },
    methods : {
    
        closeDialog(){
            this.$emit('openDialog', false)
        },
        showMap(){
            const lat = this.detailNotice.data.latAviso
            const lng = this.detailNotice.data.lngAviso
            const coordinates = lat +','+ lng
            
             window.open('https://google.com.sa/maps/search/'+coordinates+'',"_blank")
        }
    },
   
    })