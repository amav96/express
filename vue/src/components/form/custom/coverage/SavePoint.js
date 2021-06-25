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

                    
                    <h6 class=" my-3 d-flex justify-start align-items-center">Dirección del  {{returnType()}} 
                        <v-icon class="mx-1">mdi-map-search-outline</v-icon>
                    </h6>
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
                                @setHomeAddress="home_address = $event"
                                @setLat="lat = $event"
                                @setLng="lng = $event"
                                :outlined="save.point.select.outlined"
                                :classCustom="save.point.select.class"
                                :dense="save.point.select.dense"
                                :save="save"
                                />
                            </template>
                            
                            <template >
                                    <h6 class="ml-4 my-3 d-flex justify-start align-items-center">Horarios de atención al cliente
                                     <v-icon class="mx-1">mdi-calendar-clock</v-icon>
                                    </h6>
                                    <time-schedule
                                    @setTimeSchedule="timeSchedule = $event"
                                    :outlined="save.point.select.outlined"
                                    :classCustom="save.point.select.class"
                                    :dense="save.point.select.dense"
                                     />
                            </template>


                                <h6 class=" my-3 d-flex justify-start align-items-center">Zona a cubir  (Es la zona donde operara el {{returnType()}} )
                                    <v-icon class="mx-1">mdi-map-marker-radius-outline</v-icon>
                                </h6>
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
            savedData: [],
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
                        id_locate: locate.id
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
        validateFormComplete() {

            if (this.id_country === '' || this.id_province === '' || this.id_locate === '' || this.home_address === '' || this.lat === '' || this.lng === '' || this.chosenPostalCodes.length === 0 || this.timeSchedule === '' || this.timeSchedule.length < 26) {
                return true
            } else {
                return false
            }

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
                    this.saveLoading = false
                    if (res.data[0].error === "exist") {
                        this.exist(res)
                        return
                    }

                    if (res.data.error) {
                        alertNegative("Mensaje CODIGO 45");
                        return
                    }


                    this.$success(res)
                    this.$emit("setContinue", true)

                })
                .catch(err => {
                    this.saveLoading = false
                    console.log(err)
                })
        },
        exist(res) {

            var text = 'Este ' + this.returnType() + ' ya tiene asignado el codigo '
            res.data.forEach((val) => {
                text = text + ' ' + val.postal_code
            })

            this.error.display = true
            this.error.text = text
        },
        $success(res) {
            this.error.text = ''
            this.error.display = false
            res.data.forEach((val) => {
                this.savedData.push(val)
            })
            this.$emit('response', this.savedData)

            const snack = { display: true, timeout: 2000, text: 'Actualizado correctamente', color: 'success' }
            this.$emit('setPaginateDisplay', false)
            this.$emit('setExportDisplay', false)
            this.$emit("setSnack", snack)
            this.$emit('showTable', true)

        },
        $_continue(flag) {
            this.$emit("setDialogDisplay", flag)
            this.$emit("setContinue", false)
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

})