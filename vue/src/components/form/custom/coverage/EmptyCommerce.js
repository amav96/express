Vue.component('empty-commerce', {
    template: //html 
        `<div>
            </v-row>
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
                    :outlined=true
                    :classCustom="geocoding.select.class"
                    :dense="true"
                    :save="geocoding"
                    ref="refGecoded"
                   
                    />
                </v-col>

                <v-row class="d-flex justify-between flex-row mx-0" >
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
                        class=""
                        fab
                        small
                        color="primary"
                        :disabled="lng === '' || lat === '' || id_country === '' || id_province == '' || id_locate === ''"
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

                <template v-if="error.display" >
                    <v-alert
                    class="mx-auto my-5" 
                    color="error"
                    dark
                    type="error"
                    elevation="2"
                    >
                    {{error.text}}
                    </v-alert>
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
            timeSchedule: '',
            lat: '',
            lng: '',
            home_address: '',
            saveLoading: false,
            error: {
                display: false,
                text: ''
            },
            errorGeocoding: '',
            saveFlag: false,
            restaurate: {
                cache: false,
                id_user: '',
                name_assigned: ''
            },
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
            srcMap: ''
        }
    },
    methods: {
        setUser(user) {
            this.infoUser = user
            this.id_user = user.id
            this.hasAlreadyBeenGeocoded()
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
        map(val) {
            this.home_address = val.result.formatted_addess
            this.lat = val.result.lat
            this.lng = val.result.lng
            this.srcMap = 'https://www.google.com/maps/embed/v1/place?key=AIzaSyDasdhwGs_A9SbZUezcx9VhSSGkxl46bko&q=' + this.lat + ',' + this.lng;

        },
        srcImgMap() {
            return this.srcMap
        },
        reverseGeocodingManualToMap() {
            this.srcMap = 'https://www.google.com/maps/embed/v1/place?key=AIzaSyDasdhwGs_A9SbZUezcx9VhSSGkxl46bko&q=' + this.lat + ',' + this.lng;
        },
        hasAlreadyBeenGeocoded() {
            const url = this.resource.url.hasAlreadyBeenGeocoded
            axios.get(url, { params: { id_user: this.id_user } })
                .then(res => {
                    if (res.data.success) {
                        this.$_dataAlreadyGeocoded(res.data)
                    } else {
                        this.$refs.refGecoded.reset()
                        this.lat = '';
                        this.lng = '';
                        this.srcMap = '';
                    }
                })
                .catch(err => {
                    console.log(err)
                })
        },
        $_dataAlreadyGeocoded(geocoded) {
            console.log(geocoded)
            this.$refs.refGecoded.setGeocoded(geocoded)
        },
        $success(res) {
            this.saveLoading = false
            this.error.text = ''
            this.error.display = false
            const snack = { display: true, timeout: 2000, text: 'Recolector creado exitosamente', color: 'success' }
            this.$emit("setSnack", snack)
            this.setResponseWhenFinally(res.data)
            this.$refs.resetUser.reset()
            setTimeout(() => {
                this.$emit("resetType", '')
            }, 350);

        },
        setResponseWhenFinally(res) {

            res.data.forEach((val) => {
                this.$emit("setSavedData", val)
            })

            this.$emit("setDialog", false)
            this.$emit('setFront', 'save')
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
    watch: {
        geocoding: {
            handler(val) {
                this.map(val)
            },
            deep: true
        }
    }
})