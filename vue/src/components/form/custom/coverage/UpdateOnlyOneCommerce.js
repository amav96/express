Vue.component('update-onlyOne-commerce', {
    template: //html 
        `
        <div>
        
                <v-row class=" d-flex justify-start flex-column ma-1 my-0 flex-wrap" >
                
                <h6 class="ml-4 my-3 d-flex justify-start align-items-center">Nuevo comercio
                        <v-icon class="mx-1">mdi-store-outline</v-icon>
                    </h6>
                    <v-col  cols="12" xl="12" lg="12" md="12" sm="12" xs="12"  >
                        <v-row  class=" d-flex flex-row">
                            <v-col cols="12" xl="4" lg="4" sm="4" xs="4">
                                <select-auto-complete-search-id 
                                :searchID="response.data.id_country"
                                :title="update.commerce.select.title" 
                                :url="update.commerce.select.url"
                                @exportVal="setUser($event)"
                                :outlined="update.commerce.select.outlined"
                                :classCustom="update.commerce.select.class"
                                :dense="update.commerce.select.dense"
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

                    <h6 class="ml-4 my-3 d-flex justify-start align-items-center">Dirección del comercio a geocodificar
                        <v-icon class="mx-1">mdi-store</v-icon>
                    </h6>
                    <v-col  cols="12" xl="12" lg="12" md="12" sm="12" xs="12"  >
                        <geocoding-simple
                        @setErrorGeocoding="errorGeocoding = $event"
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
                        :disabled="validateUpdate"
                        @click="_updateOnlyOne()"
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
    props: {
        admin: {
            type: String
        },
        response: {
            type: Object
        },
        pagination: {
            type: Object
        },
        dialogMediaScreen: {
            type: Object
        }
    },
    data() {
        return {
            infoUser: [],
            id_user: '',
            name_user: '',
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
            update: {
                commerce: {
                    select: {
                        title: 'Ingrese Comercio',
                        url: API_BASE_CONTROLLER + 'usuarioController.php?usuario=getUsersCommerceByCountry',
                        outlined: true,
                        class: '',
                        dense: true
                    },
                    url: {
                        update: API_BASE_CONTROLLER + 'coberturaController.php?cobertura=updateOnlyOne'
                    }
                }
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

        }
    },
    methods: {
        setUser(user) {
            this.reset()
            this.$nextTick(() => {
                this.infoUser = user
                this.id_user = user.id
                this.name_user = user.name_user
                this.hasAlreadyBeenGeocoded()
            })
        },
        async _updateOnlyOne() {
            this.saveLoading = true
            const url = this.update.commerce.url.update
            const dataRequest = {
                id: this.response.data.id,
                lat: this.lat,
                lng: this.lng,
                home_address: this.home_address,
                postal_code: this.response.data.postal_code,
                id_user: this.id_user,
                type: 'comercio',
                admin: this.admin,
                created_at: this.getDateTime()
            }

            await axios.get(url, { params: { dataRequest } })
                .then(res => {
                    if (res.data.error === 'exist') {
                        window.scrollTo(0, 0);
                        this.exist();
                        this.saveLoading = false;
                        return;
                    }
                    this.$updateAfterFront(res.data.data);
                    this.$success();
                })
                .catch(err => {
                    this.saveLoading = false
                    console.log(err)
                })
        },
        $updateAfterFront(data) {
            // esto modifica la tabla en vivo luego de actualizar los datos en el back end
            this.response.data.id_user = this.id_user
            this.response.data.name_assigned = this.name_user
            this.response.data.home_address = data[0].home_address
            this.response.data.created_at = data[0].created_at
            this.response.data.timeScheduleA = data[0].timeScheduleA
            this.response.data.type = data[0].type
        },
        $success() {
            const snack = { display: true, timeout: 2000, text: 'Actualizado correctamente', color: 'success' }
            this.$emit("setSnack", snack)
            const set = { id: this.response.data.id, action: 'update' }
            this.$emit("setRowAltered", set)
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
        reverseGeocodingManualToMap() {
            this.srcMap = 'https://www.google.com/maps/embed/v1/place?key=AIzaSyDasdhwGs_A9SbZUezcx9VhSSGkxl46bko&q=' + this.lat + ',' + this.lng;
        },
        hasAlreadyBeenGeocoded() {
            const url = this.response.url.hasAlreadyBeenGeocoded
            axios.get(url, { params: { id_user: this.id_user } })
                .then(res => {
                    if (res.data.success) { this.$_dataAlreadyGeocoded(res.data) } else { this.$refs.refGecoded.reset() }
                })
                .catch(err => { console.log(err) })
        },
        $_dataAlreadyGeocoded(geocoded) {
            this.$refs.refGecoded.setGeocoded(geocoded)
        },
        exist() {
            var text = 'Este comercio ya esta asignado al codigo postal '
            text = text + ' ' + this.response.data.postal_code

            this.error.display = true
            this.error.text = text
        },
        reset() {
            this.id_country = ''
            this.id_province = ''
            this.id_locate = ''
            this.$refs.refGecoded.reset()
        }

    },
    computed: {
        validateUpdate() {
            if (
                this.id_user === '' ||
                this.id_country === '' ||
                this.lat === '' ||
                this.lng === '' ||
                this.home_address === ''
            ) { return true } else { return false }
        }
    },


})