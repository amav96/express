Vue.component('save-collector', {
    template: //html 
        `
            <div>
                <v-container>
                    <h6 class="ml-4 my-5"> Recolector </h6>
                    <v-row class="d-flex justify-start flex-row" >
                        <v-col  cols="12" xl="4" lg="4" md="6" sm="6" xs="4"  >
                            <select-auto-complete-simple-id 
                            @exportVal="setUser($event)"
                            :title="save.collector.title_field" 
                            :url="save.collector.url_users" />
                        </v-col>
                    </v-row>
                    
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
                            @exportVal="getZoneByPostalCode($event)"
                            />
                        </v-col>
                    
                    </v-row>
                
                        <template v-if="save.zone.postal_codes.length > 0" >
                            <h6 class="ml-4 my-5" > Seleccione codigos postales</h6>
                                <template v-if="save.action === 'create'">
                                    <switches-common
                                    :options="save.zone.postal_codes"
                                    @setOptions="chosenPostalCodes = $event"
                                    />
                                </template>
                                <template v-if="save.action === 'update'">
                                    <switches-common
                                    :options="save.zone.postal_codes"
                                    @setOptions="chosenPostalCodes = $event"
                                    />
                                </template>
                                
                                
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
        dialogMediaScreen: {
            type: Object
        }

    },
    data() {
        return {
            id_country_by_select: '',
            id_country: '',
            id_province_by_select: '',
            id_province: '',
            id_locate: '',
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
            this.id_country = country.id
            this.id_country_by_select = country.id
        },
        setSelectProvince(province) {
            this.id_province = province.id
            this.id_province_by_select = province.id

        },
        getZoneByPostalCode(locate) {
            this.save.action === 'create' ? this.chooseZipCode(locate) : this.chooseZipCodeByUpdate(locate)
        },
        chooseZipCode(locate) {

            this.id_locate = locate.id
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
        chooseZipCodeByUpdate(locate) {
            console.log(locate)
        },
        validateFormComplete() {

            if (this.id_user === '' || this.chosenPostalCodes.length === 0) {
                return true
            } else {
                return false
            }

        },
        async saveData() {

            const url = this.save.url.save
            await axios.get(url, {
                    params: {
                        id_country: this.id_country,
                        id_province: this.id_province,
                        id_locate: this.id_locate,
                        postal_code: this.chosenPostalCodes,
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
                        textSnack: 'Recolector creado exitosamente'
                    }
                    this.$emit("setDialogDisplay", false)

                    this.$emit('setPaginateDisplay', false)
                    this.$emit('response', res.data)
                    this.$emit('showTable', true)
                        // setting flag filtering
                    this.$emit('filtering', false)
                    this.$emit("setSnack", snack)
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
        cleanDialog() {
            if (this.save.action === 'create') {
                this.save.zone.postal_codes = []
            }
        }
    },
    destroyed() {
        this.cleanDialog()
    },

})