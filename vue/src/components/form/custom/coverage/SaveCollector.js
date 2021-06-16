Vue.component('save-collector', {
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

                        <template v-if="!saveSuccess">
                            <h6 class="ml-4 my-5"> Recolector </h6>
                            <v-row class="d-flex justify-start flex-row" >
                                <v-col  cols="12" xl="4" lg="4" md="6" sm="6" xs="4"  >
                                    <select-auto-complete-simple-id 
                                    @exportVal="setUser($event)"
                                    :title="save.collector.title_field" 
                                    :url="save.collector.url_users" 
                                    :outlined="save.collector.select.outlined"
                                    :classCustom="save.collector.select.class"
                                    :dense="save.collector.select.dense"
                                    />
                                </v-col>
                            </v-row>
                            
                            <h6 class="ml-4 my-5"> Zona a cubir  (Es la zona donde operara el {{returnType()}})</h6>
                            <v-row class="d-flex justify-start flex-row" >
                                <v-col  cols="12" xl="4" lg="4" md="6" sm="6" xs="4"  >
                                    <select-auto-complete-simple-id 
                                    title="Ingrese País" 
                                    :url="save.zone.url_country"
                                    @exportVal="setSelectCountry($event)"
                                    :outlined="save.collector.select.outlined"
                                    :classCustom="save.collector.select.class"
                                    :dense="save.collector.select.dense"
                                        />
                                </v-col>
                                <v-col  cols="12" xl="4" lg="4" md="6" sm="6" xs="4"  >
                                    <select-auto-complete-search-id 
                                    :searchID="id_country_by_select"
                                    title="Ingrese Provincia" 
                                    :url="save.zone.url_province"
                                    @exportVal="setSelectProvince($event)"
                                    :outlined="save.collector.select.outlined"
                                    :classCustom="save.collector.select.class"
                                    :dense="save.collector.select.dense"
                                
                                    />
                                </v-col>

                                    <v-col  cols="12" xl="4" lg="4" md="6" sm="6" xs="4"  >
                                        <select-auto-complete-search-id 
                                        :searchID="id_province_by_select"
                                        title="Ingrese Localidad" 
                                        :url="save.zone.url_locate"
                                        @exportVal="getZoneByPostalCode($event)"
                                        :outlined="save.collector.select.outlined"
                                        :classCustom="save.collector.select.class"
                                        :dense="save.collector.select.dense"
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
                            </template>
                        </template>
                        <v-btn color="error" @click="forcedExit" >
                         Salir 
                         <v-icon right>
                         mdi-exit-to-app
                         </v-icon> 
                        </v-btn>
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
            id_country_by_select: '',
            id_country: '',
            id_province_by_select: '',
            id_province: '',
            id_locate: '',
            id_user: '',
            chosenPostalCodes: [],
            infoUser: [],
            saveLoading: false,
            error: {
                display: false,
                text: ''
            },
            cp_start: '',
            cp_end: '',
            saveSuccess: false,
            saveFlag: false,
            savedData: [],
            clean: false,

        }
    },
    methods: {
        returnType() {
            if (this.save.type === 'recolector') {
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
            this.save.action === 'create' ? this.id_province_by_select = province.id : true

        },
        getZoneByPostalCode(locate) {
            this.slug_locate = locate.slug
            this.chooseZipCode(locate)
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
        validateFormComplete() {

            if (this.id_user === '' || this.chosenPostalCodes.length === 0) {
                return true
            } else {
                return false
            }

        },
        validateButtonSearchCPbyRange() {
            if (this.cp_start === '' || this.cp_start.length < 4 || this.cp_end === '' || this.cp_end.length < 4 || this.id_country === '' || this.id_province === '') {
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
                        id_user: this.id_user,
                        type: this.save.type,
                        admin: this.admin,
                        created_at: this.getDateTime()
                    }
                })
                .then(res => {

                    if (res.data[0].error === "exist") {
                        this.exist(res)
                        this.saveLoading = false
                        return
                    }

                    if (res.data.error) {
                        alertNegative("Mensaje CODIGO 45");
                        this.saveLoading = false
                        return
                    }

                    this.saveLoading = false
                    this.error.text = ''
                    this.error.display = false
                    const snack = { display: true, timeout: 2000, text: 'Recolector creado exitosamente', color: 'success' }
                    this.$emit("setSnack", snack)
                    this.setResponseWhenFinally(res)
                    this.$emit("setContinue", true)

                })
                .catch(err => {
                    this.saveLoading = false
                    console.log(err)
                })
        },
        setResponseWhenFinally(res) {
            res.data.forEach((val) => {
                this.savedData.push(val)
            })
            this.$emit('setPaginateDisplay', false)
            this.$emit('response', this.savedData)
            this.$emit('showTable', true)
        },
        finish() {
            if (this.clean) {
                setTimeout(() => {
                    this.saveSuccess = true
                    this.id_country_by_select = ''
                    this.id_country = ''
                    this.id_province_by_select = ''
                    this.id_province = ''
                    this.id_locate = ''
                    this.id_user = ''
                    this.save.zone.postal_codes = []
                    this.chosenPostalCodes = []
                    this.infoUser = []
                    this.error.display = false
                    this.error.text = ''
                    this.$emit("setPaginateDisplay", false)
                }, 300);
            }

        },
        forcedExit() {
            this.clean = true
            this.$emit("setDialogDisplay", false)
        },
        $show() {
            //accedo a el desde la raiz
            // mientras no se haya guardado nada, permanece en falso, para mostrar lo que se esta haciendo
            this.saveSuccess = false
            this.clean = false
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
        cleanDialog() {
            if (this.save.action === 'create') {
                this.save.zone.postal_codes = []
            }
        },
        $_continue(flag) {
            this.$emit("setDialogDisplay", flag)
            this.$emit("setContinue", false)
            if (!flag) {
                this.$nextTick(() => {
                    this.clean = true
                    this.finish()
                })
            }
        },

    },
    destroyed() {
        this.cleanDialog()
    },
    watch: {
        dialogFullScreen: {
            handler() {
                this.$nextTick(() => {
                    this.finish()
                })
            },
            deep: true
        }
    },



})