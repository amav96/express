Vue.component('save-commerce', {
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

                    
                    <h6 class=" my-3 d-flex justify-start align-items-center">Comercio
                     <v-icon class="mx-1">mdi-store</v-icon>
                    </h6>
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
                                        <alert-info-user
                                        :info="infoUser"
                                        />
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
                            <h6 class="my-3 mt-4 d-flex justify-start align-items-center">Dirección del  {{returnType()}} 
                                <v-icon class="mx-1">mdi-map-search-outline</v-icon>
                            </h6>
                            <geocoding-simple
                            @setErrorGeocoding="errorGeocoding = $event"
                            @setCountryID="id_country = $event"
                            @setProvinceID="id_province = $event"
                            @setLocateID="id_locate = $event"
                            @setHomeAddress="home_address = $event"
                            @setLat="lat = $event"
                            @setLng="lng = $event"
                            :save="save"
                            :outlined="save.commerce.select.outlined"
                            :classCustom="save.commerce.select.class"
                            :dense="save.commerce.select.dense"
                            ref="refGecoded"
                            />
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
                                    :outlined="save.commerce.select.outlined"
                                    :classCustom="save.commerce.select.class"
                                    :dense="save.commerce.select.dense"
                                    ref="refLocate"
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
            id_user: '',
            chosenPostalCodes: [],
            infoUser: [],
            errorGeocoding: '',
            saveLoading: false,
            error: {
                display: false,
                text: ''
            },
            saveFlag: false,
            savedData: []
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

            // cada vez que cambio el usuario reseteo estos parametros
            this.reset()
            this.$nextTick(() => {
                this.hasAlreadyBeenGeocoded()
            })

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

            if (this.id_country === '' || this.id_province === '' || this.id_locate === '' || this.home_address === '' || this.lat === '' || this.lng === '' || this.id_user === '' || this.chosenPostalCodes.length === 0) {
                return true
            } else {
                return false
            }

        },
        hasAlreadyBeenGeocoded() {
            const url = this.save.commerce.url.hasAlreadyBeenGeocoded
            axios.get(url, { params: { id_user: this.id_user } })
                .then(res => {
                    if (res.data.success) { this.$_dataAlreadyGeocoded(res.data) } else { this.$refs.refGecoded.reset() }
                })
                .catch(err => { console.log(err) })
        },
        $_dataAlreadyGeocoded(geocoded) {
            this.$refs.refGecoded.setGeocoded(geocoded)

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
        $success(res) {
            this.error.text = ''
            this.error.display = false
            res.data.forEach((val) => {
                this.savedData.push(val)
            })
            this.$emit('setTypeTable', 'showAllCoverage')
            const snack = { display: true, timeout: 2000, text: 'Creado correctamente', color: 'success' }
            this.$emit("setSnack", snack)


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
        $_continue(flag) {
            this.$emit("setDialogDisplay", flag)
            this.$emit("setContinue", false)
            this.$emit('response', this.savedData)
        },
        cleanPostalCodes() {
            if (this.save.action === 'create') {
                this.save.zone.postal_codes = []
            }
        },
        reset() {
            this.id_country = ''
            this.id_province = ''
            this.id_locate = ''
            this.chosenPostalCodes = []
            this.save.zone.postal_codes = []
            this.$refs.refLocate.reset()
            this.$refs.refGecoded.reset()
        }
    },
    destroyed() {
        this.cleanPostalCodes()
    },


})