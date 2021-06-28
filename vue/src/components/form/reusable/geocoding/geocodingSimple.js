Vue.component('geocoding-simple', {
    template: //html 
        `
        <div>
            <v-row class=" d-flex justify-between flex-row flex-wrap" >
                <v-col  cols="12" xl="4" lg="4" md="4" sm="4" xs="4"  >
                    <select-auto-complete-simple-id 
                    title="Ingrese País" 
                    :url="save.zone.url_country"
                    @exportVal="setCountry($event)"
                    :outlined="outlined"
                    :classCustom="classCustom"
                    :dense="dense"
                    :reassign="reassignData.id_country"
                    ref="refCountry"
                    />
                </v-col>
                <v-col  cols="12" xl="4" lg="4" md="4" sm="4" xs="4"  >
                    <select-auto-complete-search-id 
                    :searchID="id_country"
                    title="Ingrese Provincia" 
                    :url="save.zone.url_province"
                    @exportVal="setProvince($event)" 
                    :outlined="outlined"
                    :classCustom="classCustom"
                    :dense="dense"
                    :error="id_province === ''"
                    :reassign="reassignData.id_province"
                    ref="refProvince"
                    />
                </v-col>
                <v-col  cols="12" xl="4" lg="4" md="4" sm="" xs="4"  >
                    <select-auto-complete-search-id 
                    :searchID="id_province"
                    title="Ingrese Localidad" 
                    :url="save.zone.url_locate"
                    @exportVal="setLocate($event)"
                    :outlined="outlined"
                    :classCustom="classCustom"
                    :dense="dense"
                    :error="id_locate === ''"
                    :reassign="reassignData.id_locate"
                    ref="refLocate"
                    />
                </v-col>
            </v-row>
            <v-row class="d-flex justify-between flex-row " >
                <v-col cols="12" xl="6" lg="6" md="6" sm="6" xs="4"  >
                    <v-text-field 
                    label="Dirección"
                    v-model="home_address" 
                    outlined
                    dense
                    required
                    type="text"
                    color="black"
                    :classCustom="classCustom"
                    
                    >
                    </v-text-field>
                </v-col>
                <v-col   cols="12" xl="4" lg="4" md="6" sm="6" xs="4"  >
                    <v-btn 
                    class="info py-5" 
                    :disabled="validateFieldsEmpty()" 
                    @click="geocoding()"
                     >
                        Geocodificar dirección
                        <v-icon
                        right
                        dark
                        >
                            mdi-map-marker-multiple
                        </v-icon>
                    </v-btn>
                </v-col>
                <template v-if="loading" >
                    <v-col  cols="12" xl="2" lg="2" md="2" sm="2" xs="2"  >
                        <v-progress-circular
                        class="py-5" 
                        indeterminate
                        color="primary"
                        />
                    </v-col>
                </template>
            </v-row>
            <v-row class="d-flex justify-between flex-row" >
                <v-col  cols="12" xl="4" lg="4" md="6" sm="6" xs="4"  >
                    <v-text-field 
                    label="latitud"
                    v-model.trim="lat"
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
                    v-model.trim="lng"
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
                    class="info py-5" 
                    color="primary"
                    :disabled="lng === '' || lat === ''"
                    @click="geocodingByCoordinates()"
                    >
                    Geocodificar coordenadas (Opcional)
                    <v-icon
                    right
                    dark
                    >
                        mdi-map-marker-distance
                    </v-icon>
                    </v-btn>
                </v-col>
               
            </v-row>

            <template v-if="srcMap !== ''" >
                <v-col class="pa-0 my-4" cols="12" xl="6" lg="6" >

                    <template v-if="frame.loading">     
                        <v-overlay :absolute="frame.absolute" 
                            opacity="2" color="white" >
                            <v-progress-circular
                                indeterminate
                                size="64"
                                color="info"
                            ></v-progress-circular>
                        </v-overlay>
                    </template>

                            <iframe
                            width="100%"
                            height="450"
                            style="border:0"
                            loading="lazy"
                            allowfullscreen
                            class="mx-auto"
                            :src="srcMap">
                            </iframe>
                </v-col>
            </template>
        </div>
        `,
    computed: {
        handleMap() {
            if (this.lat !== '' && this.lng !== '') {
                this.srcMap = 'https://www.google.com/maps/embed/v1/place?key=AIzaSyDasdhwGs_A9SbZUezcx9VhSSGkxl46bko&q=' + this.lat + ',' + this.lng;
                return
            }
        }
    },
    props: {
        save: {
            type: Object
        },
        outlined: {
            type: Boolean
        },
        classCustom: {
            type: String
        },
        dense: {
            type: Boolean
        },
    },
    data() {
        return {
            id_country: '',
            text_country: '',
            id_province: '',
            text_province: '',
            id_locate: '',
            text_locate: '',
            home_address: '',
            lat: '',
            lng: '',
            srcMap: '',
            loading: false,
            reassignData: {
                id_country: '',
                home_address: '',
            },
            frame: {
                loading: false,
                absolute: true
            }
        }
    },
    methods: {
        setCountry(country) {
            this.id_country = country.id
            this.text_country = country.slug
            this.$emit("setCountryID", this.id_country)
        },
        setProvince(province) {
            this.id_province = province.id
            this.text_province = province.slug
            this.$emit("setProvinceID", this.id_province)
        },
        setLocate(locate) {
            this.id_locate = locate.id
            this.text_locate = locate.slug
            this.$emit("setLocateID", this.id_locate)

        },
        validateFieldsEmpty() {
            if (this.text_country === '' || this.text_province === '' || this.text_locate === '' || this.home_address === '' || this.loading) {
                return true
            } else {
                return false
            }
        },
        geocoding() {
            const url = this.save.geocoding.url
            this.loading = true
            axios.get(url, {
                    params: {
                        home_address: this.home_address,
                        locate: this.text_locate,
                        province: this.text_province,
                        country: this.text_country
                    }
                })
                .then(res => {
                    this.loading = false
                    if (res.data.error === 'has_not_provided') {
                        this.$emit("setErrorGeocoding", 'Google Maps Geocoding no tiene datos disponible para esta zona')
                        return
                    }
                    if (res.data.error === 'not_precise') {
                        this.$emit("setErrorGeocoding", 'El resultado no es preciso. Asegurate que la direccion solo contenga Domicilio al hacer clic en GEOCODIFICAR')
                        return
                    }
                    if (res.data.error === 'not_result') {
                        this.$emit("setErrorGeocoding", 'No se ha encontrado la ubicación')
                        return
                    }
                    this.$emit("setErrorGeocoding", '')
                    this.home_address = res.data.formatted_addess
                    this.lat = res.data.lat
                    this.lng = res.data.lng
                    this.showMap()
                    this.frame.loading = true
                    setTimeout(() => {
                        this.frame.loading = false
                    }, 1100);
                })
                .catch(err => {
                    this.loading = false
                    console.log(err)
                })
        },
        geocodingByCoordinates() {
            const url = this.save.geocoding.url_by_coordenates
            this.loading = true
            axios.get(url, {
                    params: {
                        lat: this.lat,
                        lng: this.lng,

                    }
                })
                .then(res => {
                    this.loading = false
                    if (res.data.error === 'has_not_provided') {
                        this.$emit("setErrorGeocoding", 'Google Maps Geocoding no tiene datos disponible para esta zona')
                        return
                    }
                    if (res.data.error === 'not_precise') {
                        this.$emit("setErrorGeocoding", 'El resultado no es preciso. Asegurate que la direccion solo contenga Domicilio al hacer clic en GEOCODIFICAR')
                        return
                    }
                    if (res.data.error === 'not_result') {
                        this.$emit("setErrorGeocoding", 'No se ha encontrado la ubicación')
                        return
                    }
                    this.$emit("setErrorGeocoding", '')
                    this.home_address = res.data.formatted_addess
                    this.lat = res.data.lat
                    this.lng = res.data.lng
                    this.showMap()
                    this.frame.loading = true
                    setTimeout(() => {
                        this.frame.loading = false
                    }, 1100);
                })
                .catch(err => {
                    this.loading = false
                    console.log(err)
                })
        },
        showMap() {
            this.srcMap = 'https://www.google.com/maps/embed/v1/place?key=AIzaSyDasdhwGs_A9SbZUezcx9VhSSGkxl46bko&q=' + this.lat + ',' + this.lng;
        },
        reset() {

            this.id_country = ''
            this.text_country = ''
            this.id_province = ''
            this.text_province = ''
            this.id_locate = ''
            this.text_locate = ''
            this.home_address = ''
            this.lat = ''
            this.lng = ''
            this.srcMap = ''
            this.$refs.refCountry.reset()
            this.$refs.refProvince.reset()
            this.$refs.refLocate.reset()
        },
        setGeocoded(geocoded) {
            this.reassignData.id_country = geocoded.id_country
            this.home_address = geocoded.home_address
            this.lat = geocoded.lat
            this.lng = geocoded.lng
            this.srcMap = 'https://www.google.com/maps/embed/v1/place?key=AIzaSyDasdhwGs_A9SbZUezcx9VhSSGkxl46bko&q=' + this.lat + ',' + this.lng;
            this.$nextTick(() => {
                this.$refs.refCountry.$reassingData();
            })

        },
        resetProvinceAndLocate() {
            this.$refs.refProvince.reset()
            this.$refs.refLocate.reset()
        }
    },
    watch: {
        home_address(val) {
            this.$emit("setHomeAddress", val)
        },
        lat(val) {
            this.$emit("setLat", val)
        },
        lng(val) {
            this.$emit("setLng", val)
        }
    }


})