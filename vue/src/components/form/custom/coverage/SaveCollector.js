Vue.component('save-collector', {
    template: //html 
        `
            <div>
                <v-container>
                    <template v-if="saveLoading">
                        <div class="text-center d-flex justify-center align-items-center" style="height:500px" >
                            <div>
                                <v-progress-circular
                                :size="50"
                                color="primary"
                                indeterminate
                                ></v-progress-circular>
                            </div>
                           
                        </div>
                    </template>
                    <template v-if="!saveLoading" >
                        <h6 class="ml-4 my-5"> Recolector </h6>
                        <v-row class="d-flex justify-start flex-row" >
                            <v-col  cols="12" xl="4" lg="4" md="6" sm="6" xs="4"  >
                                <select-auto-complete-simple-id 
                                @exportVal="setUser($event)"
                                ref="p_completeSimple"
                                :title="save.collector.title_field" 
                                :url="save.collector.url_users" />
                            </v-col>
                        </v-row>
                        
                        <h6 class="ml-4 my-5"> Zona a cubir  (Es la zona donde operara el {{returnType()}})</h6>
                        <v-row class="d-flex justify-start flex-row" >
                            <v-col  cols="12" xl="4" lg="4" md="6" sm="6" xs="4"  >
                                <select-auto-complete-simple-id 
                                title="Ingrese País" 
                                :url="save.zone.url_country"
                                @exportVal="setSelectCountry($event)"
                                ref="p_completeSearchCountry"
                                    />
                            </v-col>
                            <v-col  cols="12" xl="4" lg="4" md="6" sm="6" xs="4"  >
                                <select-auto-complete-search-id 
                                :searchID="id_country_by_select"
                                title="Ingrese Provincia" 
                                :url="save.zone.url_province"
                                @exportVal="setSelectProvince($event)"
                                ref="p_completeSearchProvince"
                                />
                            </v-col>

                            <template v-if="save.action === 'create'" >
                                <v-col  cols="12" xl="4" lg="4" md="6" sm="6" xs="4"  >
                                    <select-auto-complete-search-id 
                                    :searchID="id_province_by_select"
                                    title="Ingrese Localidad" 
                                    :url="save.zone.url_locate"
                                    @exportVal="getZoneByPostalCode($event)"
                                    ref="p_completeSearchLocate"
                                    />
                                </v-col>
                            </template>
                        </v-row>

                        <template v-if="save.action == 'update'" >
                            <h6 class="ml-4 my-5">  Ingrese rango de codigo postal </h6>
                            <v-row class="d-flex justify-start flex-row" >
                                <v-col  cols="12" xl="4" lg="4" md="6" sm="6" xs="4"  >
                                    <v-text-field
                                    label="Desde"
                                    type="number"
                                    class="mx-4"
                                    outlined
                                    dense
                                    flat
                                    />
                                </v-col>
                                <v-col  cols="12" xl="4" lg="4" md="6" sm="6" xs="4"  >
                                    <v-text-field
                                    label="Hasta"
                                    type="number"
                                    class="mx-4"
                                    outlined
                                    dense
                                    flat
                                    />
                                </v-col>
                                <v-col  cols="12" xl="4" lg="4" md="6" sm="6" xs="4"  >
                                   <v-btn
                                   class="mx-2 white--text"
                                   >
                                    Buscar
                                    <v-icon
                                    right
                                    >
                                    mdi-magnify
                                    </v-icon>
                                   </v-btn>
                                </v-col>
                            </v-row>
                        </template>

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
                       
                        <template v-if="save.action === 'update'" >
                            <h6 class="ml-4 my-5" > Seleccione codigos postales</h6>
                            <switches-content :options="zone" @setOptions="selectZone = $event" />
                        </template>

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

                    </template>

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
            saveLoading: false,
            zone: [
                { value: '1', postal_code: '1001', locate: 'CIUDAD AUTONOMA DE BUENOS AIRES', name: 'Matias Pilon', type: 'collector', },
                { value: '2', postal_code: '1002', locate: 'CIUDAD AUTONOMA DE BUENOS AIRES', name: 'Matias Pilon', type: 'collector' },
                { value: '3', postal_code: '1003', locate: 'CIUDAD AUTONOMA DE BUENOS AIRES', name: 'Matias Pilon', type: 'collector' },
                { value: '4', postal_code: '1004', locate: 'CIUDAD AUTONOMA DE BUENOS AIRES', name: 'Lo de Luci', type: 'commerce' },
                { value: '5', postal_code: '1005', locate: 'CIUDAD AUTONOMA DE BUENOS AIRES', name: 'Lo de Luci', type: 'commerce' },
                { value: '6', postal_code: '1006', locate: 'CIUDAD AUTONOMA DE BUENOS AIRES', name: 'Lo de Luci', type: 'commerce' },
                { value: '7', postal_code: '1007', locate: 'CIUDAD AUTONOMA DE BUENOS AIRES', name: 'Terminal', type: 'station' },
                { value: '8', postal_code: '1008', locate: 'CIUDAD AUTONOMA DE BUENOS AIRES', name: 'Terminal', type: 'station' },
                { value: '9', postal_code: '1009', locate: 'CIUDAD AUTONOMA DE BUENOS AIRES', name: 'Correo', type: 'mail' },
            ],
            selectZone: [],
            error: {
                display: false,
                text: ''
            }

        }
    },
    methods: {
        returnType() {
            if (this.save.type === 'collector') {
                return "Recolector";
            }

        },
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

            this.save.action === 'create' ? this.id_province_by_select = province.id : this.chooseZipCodeByZone()

        },
        getZoneByPostalCode(locate) {
            this.save.action === 'create' ? this.chooseZipCode(locate) : ''
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
        chooseZipCodeByZone() {
            console.log("diferente")
        },
        validateFormComplete() {

            if (this.id_user === '' || this.chosenPostalCodes.length === 0) {
                return true
            } else {
                return false
            }

        },
        async saveData() {
            this.saveLoading = true
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
                    if (res.data[0].error === "exist") {
                        this.saveLoading = false
                        this.exist(res)
                        return
                    }

                    if (res.data.error) {
                        alertNegative("Mensaje CODIGO 45");
                        this.saveLoading = false
                        return
                    }

                    this.$emit("setDialogDisplay", false)
                    setTimeout(() => {
                        this.saveLoading = false
                        this.finish(res)
                    }, 600);

                })
                .catch(err => {
                    this.saveLoading = false
                    console.log(err)
                })
        },
        finish(res) {
            this.id_country_by_select = ''
            this.id_province_by_select = ''
            this.id_locate = ''
            this.id_user = ''
            this.save.zone.postal_codes = []
            this.chosenPostalCodes = []
            this.infoUser = []
            this.error.display = false
            this.error.text = ''
            this.$emit('setPaginateDisplay', false)
            this.$emit('response', res.data)
            this.$emit('showTable', true)
                // setting flag filtering
            this.$emit('filtering', false)
            const snack = { snack: true, timeout: 2000, textSnack: 'Recolector creado exitosamente' }
            this.$emit("setSnack", snack)

        },
        exist(res) {

            var text = res.data[0].name_user + ' ya tiene asignado el codigo '
            res.data.forEach((val) => {
                text = text + ' ' + val.postal_code
            })

            this.error.display = true
            this.error.text = text
            this.id_country_by_select = ''
            this.id_province_by_select = ''
            this.id_locate = ''
            this.id_user = ''
            this.save.zone.postal_codes = []
            this.chosenPostalCodes = []
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

    // agregar dos input para colocar el rango de codigo postal, buscar y mostrar


})