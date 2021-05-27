Vue.component('save-commerce', {
    template: //html 
        `
            <div>
                <v-container>
                    <h6 class="ml-4 my-5"> Comercio </h6>
                    <v-row class="d-flex justify-center flex-row" >
                        <v-col  cols="12" xl="4" lg="4" md="6" sm="6" xs="4"  >
                            <select-auto-complete-simple-id 
                            @exportVal="setUser($event)"
                            :title="save.commerce.title_field" 
                            :url="save.commerce.url_users" />
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
                    <h6 class="ml-4 my-5"> Dirección del comercio a geocodificar</h6>
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
                                class="info--text mx-4"
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
                                class="info--text mx-4"
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
                                <v-col  cols="12" xl="8" lg="8" class="text-center">
                                   <a @click="windowGoogleMap()" >Ver en Google Maps</a>
                                </v-col>
                                <v-col  cols="12" xl="8" lg="8" >

                                <iframe
                                width="450"
                                height="450"
                                style="border:0"
                                loading="lazy"
                                allowfullscreen
                                :src="srcImgMap()">
                                </iframe>
                                
                                </v-col>
                            </v-row>
                        </template>
                    </template>


                    <h6 class="ml-4 my-5"> Zona a cubir </h6>
                    <v-row class="d-flex justify-center flex-row" >
                        <v-col  cols="12" xl="4" lg="4" md="6" sm="6" xs="4"  >
                            <select-auto-complete-simple-id 
                            title="Ingrese País" 
                            :url="save.zone.url_country"
                            @exportVal="setSelectCountry($event)"
                                />
                        </v-col>
                        <v-col  cols="12" xl="4" lg="4" md="6" sm="6" xs="4"  >
                            <select-auto-complete-search-id 
                            :searchID="id_country_by_select"
                            title="Ingrese Provincia" 
                            :url="save.zone.url_province"
                            @exportVal="setSelectProvince($event)" 
                            />
                        </v-col>

                        <v-col  cols="12" xl="4" lg="4" md="6" sm="6" xs="4"  >
                            <select-auto-complete-search-id 
                            :searchID="id_province_by_select"
                            title="Ingrese Localidad" 
                            :url="save.zone.url_locate"
                            @exportVal="getPostalCodes($event)"
                            />
                        </v-col>
                    
                    </v-row>
                    
                        <template v-if="save.zone.postal_codes.length > 0" >
                            <h6 class="ml-4 my-5" > Seleccione codigos postales</h6>
                                <switches-common
                                :options="save.zone.postal_codes"
                                @setOptions="chosenPostalCodes = $event"
                                />
                                
                        </v-text-field>
                        </template>
                        <v-row class="d-flex justify-center my-4 mx-4" >
                            <v-btn 
                            class="success"
                            block
                            :disabled="validateFormComplete()"
                            @click="saveData()"
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

    },
    data() {
        return {
            id_country_by_select: '',
            id_country: '',
            text_country: '',
            id_province_by_select: '',
            id_province: '',
            text_province: '',
            text_locate: '',
            id_locate: '',
            home_address: '',
            lat: '',
            lng: '',
            srcMap: '',
            id_user: '',
            chosenPostalCodes: [],
            infoUser: [],
            errorGeocoding: '',
            resultGeocoding: ''
        }
    },
    methods: {
        setUser(user) {
            this.infoUser = user
            this.id_user = user.id
        },
        setSelectCountry(country) {
            this.id_country_by_select = country.id
        },
        setSelectProvince(province) {
            this.id_province_by_select = province.id

        },
        getPostalCodes(locate) {
            const url = this.save.zone.url_postalCode
            axios.get(url, {
                    params: {
                        id_country: this.id_country_by_select,
                        id_province: this.id_province_by_select,
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
        windowGoogleMap() {
            var coordinates = this.lat + ',' + this.lng;
            var url = "https://google.com.sa/maps/search/" + coordinates;
            window.open(url, '_blank');
        },
        validateFormComplete() {

            if (this.id_country === '' || this.id_province === '' || this.id_locate === '' || this.home_address === '' || this.lat === '' || this.lng === '' || this.id_user === '' || this.chosenPostalCodes.length === 0) {
                return true
            } else {
                return false
            }

        },
        reverseGeocodingManualToMap() {
            this.srcMap = 'https://www.google.com/maps/embed/v1/place?key=AIzaSyDasdhwGs_A9SbZUezcx9VhSSGkxl46bko&q=' + this.lat + ',' + this.lng;
        },
        async saveData() {
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
                    if (res.data.error) {
                        alertNegative("Mensaje CODIGO 45");
                        return
                    }
                    const snack = {
                        snack: true,
                        timeout: 4500,
                        textSnack: 'Comercio creado exitosamente'
                    }
                    this.$emit("setDialogDisplay", false)


                    this.$emit("setSnack", snack)
                    this.resetSection();


                    // close dialog
                    this.$emit('setPaginateDisplay', false)
                    this.$emit('response', res.data)
                    this.$emit('showTable', true)
                        // setting flag filtering
                    this.$emit('filtering', false)
                })
                .catch(err => {
                    console.log(err)
                })
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
        resetSection() {
            this.id_country_by_select = ''
            this.id_country = ''
            this.text_country = ''
            this.id_province_by_select = ''
            this.id_province = ''
            this.text_province = ''
            this.text_locate = ''
            this.id_locate = ''
            this.home_address = ''
            this.lat = ''
            this.lng = ''
            this.srcMap = ''
            this.id_user = ''
            this.chosenPostalCodes = []
            this.infoUser = []
            this.errorGeocoding = ''
            this.resultGeocoding = ''
            this.save.zone.postal_codes = []
        }

    },
    watch: {
        resultGeocoding(val) {
            this.home_address = val.formatted_addess
            this.lat = val.lat
            this.lng = val.lng

            this.srcMap = 'https://www.google.com/maps/embed/v1/place?key=AIzaSyDasdhwGs_A9SbZUezcx9VhSSGkxl46bko&q=' + this.lat + ',' + this.lng;
            // this.srcMap = 'https://maps.googleapis.com/maps/api/staticmap?key=AIzaSyDasdhwGs_A9SbZUezcx9VhSSGkxl46bko&center=' + this.lat + ',' + this.lng + '&zoom=16&size=360x230&maptype=roadmap&markers=color:red%7C' + this.lat + ',' + this.lng;

        },

    },





})