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
                    class="info py-5 mx-3" 
                    :disabled="validateFieldsEmpty()" 
                    @click="geocoding()"
                     >
                        Geocodificar
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
                        class="py-5 mx-3" 
                        indeterminate
                        color="primary"
                        />
                    </v-col>
                </template>
            </v-row>
        </div>
        `,
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
        error: {
            type: Object
        }
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
            id_user: '',
            loading: false,
            reassignData: {
                id_country: '',
                home_address: '',
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
                    this.$emit("setResultGeocoding", res.data)
                })
                .catch(err => {
                    this.loading = false
                    console.log(err)
                })

        },
        reset() {

            this.id_country = ''
            this.text_country = ''
            this.id_province = ''
            this.text_province = ''
            this.id_locate = ''
            this.text_locate = ''
            this.home_address = ''
            this.id_user = ''
            this.$refs.refCountry.reset()
            this.$refs.refProvince.reset()
            this.$refs.refLocate.reset()


        },
        setGeocoded(geocoded) {
            this.reassignData.id_country = geocoded.id_country
                // no puedo usar estos porque son los id y locate de la zona como tal
                // no de la geolocalizacion
                // this.reassignData.id_province = geocoded.id_province
                // this.reassignData.id_locate = geocoded.id_locate
            this.home_address = geocoded.home_address
            this.$nextTick(() => {
                this.$refs.refCountry.$reassingData();
            })
            const coordenates = {
                lat: geocoded.lat,
                lng: geocoded.lng,
                result: {
                    formatted_addess: geocoded.home_address
                }
            }
            this.$emit("setResultGeocoding", coordenates)
        }
    },
    watch: {
        home_address(val) {
            this.$emit("setHomeAddress", val)
        }
    }


})