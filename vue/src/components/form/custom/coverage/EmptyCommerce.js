Vue.component('empty-commerce', {
    template: //html 
        `<div>

              
                
                <h6 class="ml-4 my-3 d-flex justify-start align-items-center">Nuevo Comercio 
                    <v-icon class="mx-1">mdi-store</v-icon>
                </h6>

                <v-col  cols="12" xl="12" lg="12" md="12" sm="12" xs="12"  >
                    <v-row  class=" d-flex flex-row">
                        <v-col cols="12" xl="4" lg="4" sm="4" xs="4">
                            <select-auto-complete-simple-id 
                            @exportVal="setUser($event)"
                            :title="resource.commerce.select.title" 
                            :url="resource.commerce.select.url"
                            :outlined="resource.commerce.select.outlined"
                            :classCustom="resource.commerce.select.class"
                            :dense="resource.commerce.select.dense"
                            ref="resetUser"
                        />
                        </v-col>
                        <v-col cols="12" xl="6" lg="6" sm="6" xs="6">
                            <template class="mx-auto" v-if="infoUser.length !== 0">
                            <alert-info-user
                            :info="infoUser"
                            />         
                            </template>  
                        </v-col>
                    </v-row>
                </v-col>
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
                <v-col  cols="12" xl="12" lg="12" md="12" sm="12" xs="12"  >
                    <geocoding-simple
                    @setErrorGeocoding="errorGeocoding = $event"
                    @setResultGeocoding="geocoding.result = $event"
                    @setCountryID="id_country = $event"
                    @setProvinceID="id_province = $event"
                    @setLocateID="id_locate = $event"
                    @setHomeAddress="home_address = $event"
                    @setLat="lat = $event"
                    @setLng="lng = $event"
                    :outlined=true
                    :classCustom="geocoding.select.class"
                    :dense="true"
                    :save="geocoding"
                    ref="refGecoded"
                   
                    />
                </v-col>

                <template v-if="error.display" >
                    <v-col  cols="12" xl="12" lg="12" md="12" sm="12" xs="12"  >    
                            <v-alert
                            class="mx-2 my-5" 
                            color="error"
                            dark
                            type="error"
                            elevation="2"
                            >
                            {{error.text}}
                            </v-alert>
                    </v-col>
                </template>

                <v-col  cols="12" xl="4" lg="4" md="6" sm="6" xs="4"  >
                    <v-btn
                    color="success"
                    :disabled="validateFormComplete"
                    @click="_save()"
                    width="180"
                    >
                    <template v-if="saveLoading">
                        <v-progress-circular
                        indeterminate
                        color="white"
                    ></v-progress-circular>
                    </template>
                    <template v-else>
                        Guardar cambios
                    </template>
                
                    </v-btn>
                </v-col>
            </v-row>
        </div>
    `,
    props: ['resource', 'admin'],
    data() {
        return {
            infoUser: [],
            id_user: '',
            id_country: '',
            id_province: '',
            id_locate: '',
            lat: '',
            lng: '',
            home_address: '',
            saveLoading: false,
            error: {
                display: false,
                text: ''
            },
            errorGeocoding: '',
            geocoding: {
                zone: {
                    url_country: API_BASE_CONTROLLER + 'coberturaController.php?cobertura=getCountry',
                    url_province: API_BASE_CONTROLLER + 'coberturaController.php?cobertura=getProvinceById',
                    url_locate: API_BASE_CONTROLLER + 'coberturaController.php?cobertura=getLocateById',
                    url_postalCode: API_BASE_CONTROLLER + 'coberturaController.php?cobertura=getPostalCodeByLocateAndProvinceAndCountry',
                    url_AllPointInZone: API_BASE_CONTROLLER + 'coberturaController.php?cobertura=getAllPointInZone',
                },
                geocoding: {
                    url: API_BASE_CONTROLLER + 'geocodingController.php?geocoding=geocoding'
                },
                select: {
                    class: 'mx-0'
                },
                result: []

            },
        }
    },
    methods: {
        setUser(user) {
            this.reset()
            this.$nextTick(() => {
                this.infoUser = user
                this.id_user = user.id
                this.hasAlreadyBeenGeocoded()
            })
        },
        _save() {
            const url = this.resource.url.save
            axios.get(url, {
                    params: {
                        id_user: this.id_user,
                        id_country: this.resource.data.id_country,
                        id_province: this.resource.data.id_province,
                        id_locate: this.resource.data.id_locate,
                        postal_code: this.resource.data.postal_code,
                        home_address: this.home_address,
                        lat: this.lat,
                        lng: this.lng,
                        admin: this.admin,
                        type: this.resource.type,
                        created_at: this.getDateTime()
                    }
                })
                .then(res => {

                    if (res.data.error && res.data.error === "exist") {
                        this.exist(res)
                        return
                    }
                    if (res.data.error) {
                        alertNegative("Mensaje CODIGO 45");
                        this.saveLoading = false
                        return
                    }
                    this.$success(res);


                })
                .catch(err => {
                    console.log(err)
                })

        },
        hasAlreadyBeenGeocoded() {
            const url = this.resource.commerce.url.hasAlreadyBeenGeocoded
            axios.get(url, { params: { id_user: this.id_user } })
                .then(res => {
                    if (res.data.success) { this.$_dataAlreadyGeocoded(res.data) } else { this.$refs.refGecoded.reset() }
                })
                .catch(err => { console.log(err) })
        },
        $_dataAlreadyGeocoded(geocoded) {
            this.$refs.refGecoded.setGeocoded(geocoded)
        },
        $success(res) {
            const snack = { display: true, timeout: 2000, text: 'Comercio creado exitosamente', color: 'success' }
            this.$emit("setSnack", snack)

            res.data.data.forEach((val) => {
                this.$emit("setSavedData", val)
            })
            this.$emit('setFront', 'save')
            this.$emit("setDialog", false)
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
        reset() {
            this.id_country = ''
            this.id_province = ''
            this.id_locate = ''
            this.$refs.refGecoded.reset()
        },
        exist(res) {
            var text = res.data.name_user + ' ya tiene asignado el codigo '
            text = text + ' ' + res.data.postal_code

            this.error.display = true
            this.error.text = text
        },

    },
    computed: {
        validateFormComplete() {
            if (
                this.id_user === '' ||
                this.lat === '' ||
                this.lng === '' ||
                this.home_address === ''
            ) { return true } else { return false }
        }
    },

})