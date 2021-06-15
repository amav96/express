Vue.component('save-point', {
    template: //html 
        `
            <div>
                <v-container>

                    <template>
                        <d-small-screen :dialogSmallScreen="dialogSmallScreen">
                            <template>
                                <d-continue 
                                :content="continueSave"
                                @setContinue="$_continue($event)"
                                />
                            </template>
                        </d-small-screen>
                    </template>

                    <template v-if="!saveSuccess">
                        <h6 class="ml-4 my-5"> Dirección del {{returnType()}} a geocodificar</h6>
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
                            <template>
                                <geocoding-simple
                                @setErrorGeocoding="errorGeocoding = $event"
                                @setResultGeocoding="resultGeocoding = $event"
                                @setCountryID="id_country = $event"
                                @setProvinceID="id_province = $event"
                                @setLocateID="id_locate = $event"
                                :outlined="save.point.select.outlined"
                                :classCustom="save.point.select.class"
                                :dense="save.point.select.dense"
                                :save="save"
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
                                        class="info--text "
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
                                        class="info--text "
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
                            </template>
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
                      
                            <template >
                                    <h6 class="ml-4" > Horarios de atención al cliente</h6>
                                    <time-schedule @setTimeSchedule="timeSchedule = $event" />
                            </template>


                            <h6 class="ml-4 my-5"> Zona a cubir  (Es la zona donde operara el {{returnType()}})</h6>
                                <v-row class="d-flex justify-start flex-row" >
                                    <v-col  cols="12" xl="4" lg="4" md="6" sm="6" xs="4"  >
                                        <select-auto-complete-search-id 
                                        :searchID="id_province"
                                        title="Ingrese Localidad" 
                                        :url="save.zone.url_locate"
                                        @exportVal="getZoneByPostalCode($event)"
                                        :outlined="save.point.select.outlined"
                                        :classCustom="save.point.select.class"
                                        :dense="save.point.select.dense"
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
                               
                                :disabled="validateFormComplete()"
                                @click="_saveData()"
                                >
                                Siguiente
                                </v-btn>
                            </v-row>
                    </template>
                    <v-btn color="error" @click="forcedExit" >
                         Salir 
                        <v-icon right>
                            mdi-exit-to-app
                        </v-icon> 
                    </v-btn>
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
        },
        dialogSmallScreen: {
            type: Object
        },
        continueSave: {
            type: Object
        },
    },
    data() {
        return {
            id_country: '',
            id_province: '',
            id_locate: '',
            home_address: '',
            lat: '',
            lng: '',
            srcMap: '',
            chosenPostalCodes: [],
            infoUser: [],
            errorGeocoding: '',
            resultGeocoding: '',
            timeSchedule: '',
            saveLoading: false,
            error: {
                display: false,
                text: ''
            },
            saveSuccess: false,
            saveFlag: false,
            savedData: [],
            clean: false,
        }
    },
    methods: {
        returnType() {
            if (this.save.type === 'correo') {
                return "Correo";
            }
            if (this.save.type === 'terminal') {
                return "Terminal";
            }
        },

        getZoneByPostalCode(locate) {
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

            if (this.id_country === '' || this.id_province === '' || this.id_locate === '' || this.home_address === '' || this.lat === '' || this.lng === '' || this.chosenPostalCodes.length === 0 || this.timeSchedule === '' || this.timeSchedule.length < 26) {
                return true
            } else {
                return false
            }

        },
        reverseGeocodingManualToMap() {
            this.srcMap = 'https://www.google.com/maps/embed/v1/place?key=AIzaSyDasdhwGs_A9SbZUezcx9VhSSGkxl46bko&q=' + this.lat + ',' + this.lng;
        },
        async _saveData() {
            this.saveLoading = true
            const url = this.save.url.save
            await axios.get(url, {
                    params: {
                        id_country: this.id_country,
                        id_province: this.id_province,
                        id_locate: this.id_locate,
                        postal_code: this.chosenPostalCodes,
                        id_user: this.save.type,
                        home_address: this.home_address,
                        timeSchedule: this.timeSchedule,
                        lat: this.lat,
                        lng: this.lng,
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

                    this.saveLoading = false
                    this.error.text = ''
                    this.error.display = false
                    const snack = { display: true, timeout: 2000, text: 'Creado exitosamente', color: 'success' }
                    this.$emit("setSnack", snack)
                    this.setResponseWhenFinally(res)
                    this.$emit("setContinue", true)

                })
                .catch(err => {
                    this.saveLoading = false
                    console.log(err)
                })
        },
        setResponseWhenFinally(res) {
            res.data.forEach((val) => {
                this.savedData.push(val)
            })
            this.$emit('setPaginateDisplay', false)
            this.$emit('response', this.savedData)
            this.$emit('showTable', true)
        },
        finish() {
            if (this.clean) {

                setTimeout(() => {
                    this.saveSuccess = true
                    this.saveLoading = false
                    this.id_country = ''
                    this.id_province = ''
                    this.id_locate = ''
                    this.save.zone.postal_codes = []
                    this.chosenPostalCodes = []
                    this.infoUser = []
                    this.home_address = ''
                    this.lat = ''
                    this.lng = ''
                    this.srcMap = ''
                    this.error.display = false
                    this.error.text = ''
                    this.$emit("setPaginateDisplay", false)
                }, 300);
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

        forcedExit() {
            this.clean = true
            this.$emit("setDialogDisplay", false)
        },
        $show() {
            //accedo a el desde la raiz
            // mientras no se haya guardado nada, permanece en falso, para mostrar lo que se esta haciendo
            this.saveSuccess = false
            this.clean = false
        },
        $_continue(flag) {
            this.$emit("setDialogDisplay", flag)
            this.$emit("setContinue", false)
            if (!flag) {
                this.$nextTick(() => {
                    this.clean = true
                    this.finish()
                })
            }
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