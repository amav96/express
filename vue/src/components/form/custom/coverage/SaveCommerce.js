Vue.component('save-commerce', {
    template: //html 
        `
            <div>
                <v-container>
                    <template v-if="!saveSuccess">
                        <h6 class="ml-4 my-5"> Comercio </h6>
                        <v-row class="d-flex justify-center flex-row" >
                            <v-col  cols="12" xl="4" lg="4" md="6" sm="6" xs="4"  >
                                <select-auto-complete-simple-id 
                                @exportVal="setUser($event)"
                                :title="save.commerce.title_field" 
                                :url="save.commerce.url_users" 
                                :outlined="save.commerce.select.outlined"
                                :classCustom="save.commerce.select.class"
                                :dense="save.commerce.select.dense"
                                />
                            </v-col>
                            <v-col  cols="12" xl="8" lg="8" md="6" sm="6" xs="8"  >
                                <template v-if="infoUser.length !== 0">
                                    <v-alert
                                    class="py-5"
                                    border="right"
                                    colored-border
                                    type="info"
                                    elevation="2"
                                    icon="mdi-store"
                                    >
                                    <v-row class="mx-1 d-flex justify-between ">
                                        <v-col cols="12" lg="6" class="pa-1 " >
                                            <strong>Nombre :</strong> {{infoUser.name_user}}
                                        </v-col>
                                        <v-col cols="12" lg="6" class="pa-1 ">
                                            <strong>Pais :</strong> {{infoUser.country}}
                                        </v-col>
                                        <v-col cols="12" lg="6" class="pa-1 ">
                                            <strong>Provincia :</strong> {{infoUser.province}}
                                        </v-col>
                                        <v-col cols="12" lg="6" class="pa-1 ">
                                            <strong>Localidad :</strong> {{infoUser.locate}}
                                        </v-col>
                                        <v-col cols="12" lg="6" class="pa-1 ">
                                            <strong>Dirección :</strong> {{infoUser.home_address}}
                                        </v-col>
                                    </v-row>
                                    </v-alert>
                                </template>  
                            </v-col> 
                        </v-row>
                            <template v-if="errorGeocoding !== ''">
                                <v-row class="d-flex justify-center mx-2" >
                                    <v-col cols="12">
                                        <v-alert
                                        dense
                                        outlined
                                        type="error"
                                        >
                                            {{errorGeocoding}}
                                        </v-alert>
                                    </v-col>
                                </v-row>
                            </template>
                        <h6 class="ml-4 my-5"> Dirección del comercio a geocodificar</h6>
                            <geocoding-simple
                            @setErrorGeocoding="errorGeocoding = $event"
                            @setResultGeocoding="resultGeocoding = $event"
                            @setCountryID="id_country = $event"
                            @setProvinceID="id_province = $event"
                            @setLocateID="id_locate = $event"
                            :save="save"
                            :outlined="save.commerce.select.outlined"
                            :classCustom="save.commerce.select.class"
                            :dense="save.commerce.select.dense"
                            />
                            <v-row class="d-flex justify-between flex-row" >
                                <v-col  cols="12" xl="4" lg="4" md="6" sm="6" xs="4"  >
                                    <v-text-field 
                                    label="latitud"
                                    v-model="lat"
                                    outlined
                                    dense
                                    required
                                    type="text"
                                    color="black"
                                    class="info--text mx-2"
                                    >
                                    </v-text-field>
                                </v-col>
                                <v-col  cols="12" xl="4" lg="4" md="6" sm="6" xs="4"  >
                                    <v-text-field 
                                    label="longitud"
                                    v-model="lng"
                                    outlined
                                    dense
                                    required
                                    type="text"
                                    color="black"
                                    class="info--text mx-2"
                                    >
                                    </v-text-field>
                                </v-col>

                                <v-col  cols="12" xl="4" lg="4" md="6" sm="6" xs="4"  >
                                    <v-btn
                                    class="mx-2"
                                    fab
                                    small
                                    color="primary"
                                    :disabled="lng === '' || lat === ''"
                                    @click="reverseGeocodingManualToMap()"
                                    >
                                        <v-icon dark>
                                        mdi-refresh
                                        </v-icon>
                                    </v-btn>
                                </v-col>
                            </v-row>

                            <template v-if="srcMap !== ''" >
                                <v-row class="d-flex justify-center flex-column align-content-center" >
                                    <v-col  cols="12" xl="8" lg="8" >
                                        <iframe
                                        width="100%"
                                        height="450"
                                        style="border:0"
                                        loading="lazy"
                                        allowfullscreen
                                        :src="srcImgMap()">
                                        </iframe>
                                    </v-col>
                                </v-row>
                            </template>
                        
                            <h6  class="ml-4 my-5"> Zona a cubir  (Es la zona donde operara el {{returnType()}})</h6>
                          
                            <v-row class="d-flex justify-start flex-row" >
                                <v-col  cols="12" xl="4" lg="4" md="6" sm="6" xs="4"  >
                                    <select-auto-complete-search-id 
                                    :searchID="id_province"
                                    title="Ingrese Localidad" 
                                    :url="save.zone.url_locate"
                                    @exportVal="getZoneByPostalCode($event)"
                                    :outlined="save.commerce.select.outlined"
                                    :classCustom="save.commerce.select.class"
                                    :dense="save.commerce.select.dense"
                                    />
                                </v-col>
                            
                            </v-row>
                            <template v-if="error.display" >
                                <v-alert
                                class="ml-4 my-5" 
                                color="error"
                                dark
                                type="error"
                                elevation="2"
                                >
                                {{error.text}}
                                </v-alert>
                            </template>
                        
                            <template v-if="save.zone.postal_codes.length > 0" >
                                <h6 class="ml-4 my-5" > Seleccione codigos postales</h6>
                                    <switches-common
                                    :options="save.zone.postal_codes"
                                    @setOptions="chosenPostalCodes = $event"
                                    />
                            </template>
                      
                           
                            <v-row class="d-flex justify-center my-4 mx-4" >
                                <template v-if="saveLoading">
                                    <v-progress-linear
                                    color="info"
                                    indeterminate
                                    rounded
                                    height="6"
                                    ></v-progress-linear>
                                </template>
                                <v-btn 
                                class="success"
                                block
                                :disabled="validateFormComplete()"
                                @click="saveData()"
                                >
                                Siguiente
                                </v-btn>
                            </v-row>
                    </template>
                    
                </v-container>
            </div>
        `,
    props: {
        admin: {
            type: String
        },
        save: {
            type: Object
        },
        pagination: {
            type: Object
        },
        dialogFullScreen: {
            type: Object
        }

    },
    data() {
        return {
            time: false,
            id_country: '',
            id_province: '',
            id_locate: '',
            home_address: '',
            lat: '',
            lng: '',
            srcMap: '',
            id_user: '',
            chosenPostalCodes: [],
            infoUser: [],
            errorGeocoding: '',
            resultGeocoding: '',
            saveLoading: false,
            error: {
                display: false,
                text: ''
            },
            cp_start: '',
            cp_end: '',
            saveSuccess: false,
            saveFlag: false
        }
    },
    methods: {
        returnType() {
            if (this.save.type === 'comercio') {
                return "Comercio";
            }

        },
        setUser(user) {
            this.infoUser = user
            this.id_user = user.id
        },

        getZoneByPostalCode(locate) {
            console.log(locate)
            const url = this.save.zone.url_postalCode
            axios.get(url, {
                    params: {
                        id_country: this.id_country,
                        id_province: this.id_province,
                        locate: locate.slug
                    }
                })
                .then(res => {
                    if (res.data.error) {
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
        },
        srcImgMap() {

            return this.srcMap
        },
        validateFormComplete() {

            if (this.id_country === '' || this.id_province === '' || this.id_locate === '' || this.home_address === '' || this.lat === '' || this.lng === '' || this.id_user === '' || this.chosenPostalCodes.length === 0) {
                return true
            } else {
                return false
            }

        },
        validateButtonSearchCPbyRange() {
            if (this.cp_start === '' || this.cp_start.length < 4 || this.cp_end === '' || this.cp_end.length < 4 || this.id_country === '' || this.id_province === '') {
                return true
            } else {
                return false
            }

        },
        reverseGeocodingManualToMap() {
            this.srcMap = 'https://www.google.com/maps/embed/v1/place?key=AIzaSyDasdhwGs_A9SbZUezcx9VhSSGkxl46bko&q=' + this.lat + ',' + this.lng;
        },
        async saveData() {
            this.saveLoading = true
            const url = this.save.url.save
            await axios.get(url, {
                    params: {
                        id_country: this.id_country,
                        id_province: this.id_province,
                        id_locate: this.id_locate,
                        postal_code: this.chosenPostalCodes,
                        home_address: this.home_address,
                        lat: this.lat,
                        lng: this.lng,
                        id_user: this.id_user,
                        type: this.save.type,
                        admin: this.admin,
                        created_at: this.getDateTime()
                    }
                })
                .then(res => {

                    if (res.data[0].error === "exist") {
                        this.exist(res)
                        this.saveLoading = false
                        return
                    }

                    if (res.data.error) {
                        alertNegative("Mensaje CODIGO 45");
                        this.saveLoading = false
                        return
                    }

                    this.$emit("setDialogDisplay", false)
                    this.$nextTick(() => {
                        this.setResponseWhenFinally(res)
                        this.saveFlag = true
                    })

                })
                .catch(err => {
                    this.saveLoading = false
                    console.log(err)
                })
        },
        setResponseWhenFinally(res) {
            this.$emit('setPaginateDisplay', false)
            this.$emit('response', res.data)
            this.$emit('showTable', true)
        },
        finish() {
            if (this.saveFlag) {
                this.saveFlag = false
                setTimeout(() => {
                    this.saveSuccess = true
                    this.saveLoading = false
                    this.id_country = ''
                    this.id_province = ''
                    this.id_locate = ''
                    this.id_user = ''
                    this.save.zone.postal_codes = []
                    this.chosenPostalCodes = []
                    this.infoUser = []
                    this.home_address = ''
                    this.lat = ''
                    this.lng = ''
                    this.srcMap = ''
                    this.error.display = false
                    this.error.text = ''

                    this.$nextTick(() => {

                        this.saveSuccess = false
                            // setting flag filtering
                        this.$emit('filtering', false)
                        const snack = { display: true, timeout: 2000, text: 'Comercio creado exitosamente', color: 'success' }
                        this.$emit("setSnack", snack)
                        this.saveFlag = false
                    })
                }, 700);
            }
        },
        exist(res) {

            var text = res.data[0].name_user + ' ya tiene asignado el codigo '
            res.data.forEach((val) => {
                text = text + ' ' + val.postal_code
            })

            this.error.display = true
            this.error.text = text
        },
        getDateTime() {
            var today = new Date();
            var getMin = today.getMinutes();
            var getSeconds = today.getSeconds()
            var getHours = today.getHours()

            if (getMin < 10) { getMin = '0' + today.getMinutes() }
            if (getSeconds < 10) { getSeconds = '0' + today.getSeconds() }
            if (getHours < 10) { getHours = '0' + today.getHours() }

            var created_at = today.getFullYear() + '-' + ("0" + (today.getMonth() + 1)).slice(-2) + '-' +
                ("0" + today.getDate()).slice(-2) + ' ' + getHours + ':' + getMin + ':' + getSeconds;

            return created_at
        },
        cleanDialog() {
            if (this.save.action === 'create') {
                this.save.zone.postal_codes = []
            }
        },

    },
    destroyed() {
        this.cleanDialog()
    },
    watch: {
        resultGeocoding(val) {
            this.home_address = val.formatted_addess
            this.lat = val.lat
            this.lng = val.lng

            this.srcMap = 'https://www.google.com/maps/embed/v1/place?key=AIzaSyDasdhwGs_A9SbZUezcx9VhSSGkxl46bko&q=' + this.lat + ',' + this.lng;
            // this.srcMap = 'https://maps.googleapis.com/maps/api/staticmap?key=AIzaSyDasdhwGs_A9SbZUezcx9VhSSGkxl46bko&center=' + this.lat + ',' + this.lng + '&zoom=16&size=360x230&maptype=roadmap&markers=color:red%7C' + this.lat + ',' + this.lng;

        },
        dialogFullScreen: {
            handler() {
                this.$nextTick(() => {
                    this.finish()
                })
            },
            deep: true
        }
    },

})