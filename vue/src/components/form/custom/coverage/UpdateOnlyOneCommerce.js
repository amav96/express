Vue.component('update-onlyOne-commerce', {
    template: //html 
        `
        <div>
                <v-row class=" d-flex justify-start flex-column ma-1 my-0 flex-wrap" >
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


                <h6 class="ml-4 my-3">Nuevo Comercio </h6>
                    <v-col  cols="12" xl="4" lg="4" md="6" sm="6" xs="4"  >
                        <select-auto-complete-simple-id 
                        @exportVal="setUser($event)"
                        :title="update.commerce.select.title" 
                        :url="update.commerce.select.url"
                        :outlined="update.commerce.select.outlined"
                        :classCustom="update.commerce.select.class"
                        :dense="update.commerce.select.dense"
                        />
                    </v-col>

                    
                    <h6 class="ml-4 my-5"> Dirección del comercio a geocodificar</h6>
                    <geocoding-simple
                    @setErrorGeocoding="errorGeocoding = $event"
                    @setResultGeocoding="resultGeocoding = $event"
                    @setCountryID="id_country = $event"
                    @setProvinceID="id_province = $event"
                    @setLocateID="id_locate = $event"
                    :outlined=true
                    :classCustom="geocoding.select.class"
                    :dense="true"
                    :save="geocoding"
                    ref="resetGeocoding"
                    />

                    <v-col  cols="12" xl="4" lg="4" md="6" sm="6" xs="4"  >
                        <v-btn
                        color="success"
                        :disabled="validateUpdate"
                        @click="_updateOnlyOne()"
                        width="150"
                        >
                        <template v-if="saveLoading">
                            <v-progress-circular
                            indeterminate
                            color="primary"
                        ></v-progress-circular>
                        </template>
                        <template v-else>
                                Actualizar
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
            infoUser: '',
            id_user: '',
            id_country: '',
            id_province: '',
            id_locate: '',
            saveLoading: false,
            error: {
                display: false,
                text: ''
            },
            saveSuccess: false,
            saveFlag: false,
            update: {
                commerce: {
                    select: {
                        title: 'Ingrese Comercio',
                        url: API_BASE_CONTROLLER + 'coberturaController.php?cobertura=getUsersCommerce',
                        outlined: true,
                        class: '',
                        dense: true
                    },
                    url: {
                        update: API_BASE_CONTROLLER + 'coberturaController.php?cobertura=updateOnlyOne'
                    }
                }
            },
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
                    class: 'mx-2'
                }

            },

        }
    },
    methods: {
        setUser(user) {

            if (!this.restaurate.cache) {
                this.restaurate.cache = true
                this.restaurate.id_user = this.response.data.id_user
                this.restaurate.name_assigned = this.response.data.name_assigned
            }

            this.id_user = user.id
            this.response.data.id_user = this.id_user
            this.response.data.name_assigned = user.name_user
        },
        async _updateOnlyOne() {
            this.saveLoading = true
            const url = this.update.collector.url.update
            const dataRequest = {
                id: this.response.data.id,
                postal_code: this.response.data.postal_code,
                id_user: this.id_user,
                type: 'recolector',
                admin: this.admin,
                created_at: this.getDateTime()
            }
            await axios.get(url, {
                    params: {
                        dataRequest
                    }
                })
                .then(res => {

                    if (res.data.error === 'exist') {
                        this.exist()
                        this.saveLoading = false
                        return
                    }
                    this.saveSuccess = true
                    this.error.display = false
                    this.error.text = ''


                    this.response.indexUpdate = this.response.data.id
                    this.$emit("setDialog", false)
                    const snack = { display: true, timeout: 2000, text: 'Actualizado exitosamente', color: 'success' }
                    this.$emit("setSnack", snack)
                    const set = {
                        id: this.response.data.id,
                        action: 'update'
                    }
                    this.$emit("setResponse", set)


                })
                .catch(err => {
                    this.saveLoading = false
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
        exist() {
            var text = 'Este recolector ya esta asignado a'
            text = text + ' ' + this.response.data.postal_code

            this.error.display = true
            this.error.text = text
        },
        restaurateChanges() {
            console.log("execute")
            if (!this.saveSuccess) {
                if (this.restaurate.id_user !== '' && this.restaurate.name_assigned !== '') {
                    console.log("not success")
                    this.response.data.id_user = this.restaurate.id_user
                    this.response.data.name_assigned = this.restaurate.name_assigned
                }
            } else {
                console.log("success")
            }
        }
    },
    computed: {
        validateUpdate() {
            if (this.id_user = '') {
                return true
            } else {
                return false
            }
        }
    },

    destroyed() {
        this.restaurateChanges()
    }


    // agregar dos input para colocar el rango de codigo postal, buscar y mostrar


})