Vue.component('update-onlyOne-point', {
    template: //html 
        `
        <div>
                <v-row class=" d-flex justify-start flex-column ma-1 my-0 flex-wrap" >
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
                    
                    <h6 class="ml-4 my-3 d-flex justify-start align-items-center">Dirección del {{updateOnly.type}} a geocodificar
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
                        ref="resetGeocoding"
                        />
                    </v-col>
                    <template >
                    <v-row class="mx-0" >
                        <v-col  cols="12" xl="10" lg="10" md="10" sm="10" xs="10"  >
                            <h6 class="ml-4 my-3 d-flex justify-start align-items-center">Horarios de atención al cliente
                                <v-icon class="mx-1">mdi-calendar-clock</v-icon>
                            </h6>
                            <time-schedule
                            :outlined=true
                            classCustom=""
                            :dense="true"
                            @setTimeSchedule="timeSchedule = $event" />
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
        },
        updateOnly: {
            type: Object
        }


    },
    data() {
        return {
            infoUser: [],
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
            update: {
                point: {
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
                    class: 'mx-0'
                },
                result: []

            },

        }
    },
    methods: {

        async _updateOnlyOne() {
            this.saveLoading = true
            const url = this.update.point.url.update
            const dataRequest = {
                id: this.response.data.id,
                lat: this.lat,
                lng: this.lng,
                home_address: this.home_address,
                postal_code: this.response.data.postal_code,
                id_user: this.updateOnly.type,
                timeSchedule: this.timeSchedule,
                type: this.updateOnly.type,
                admin: this.admin,
                created_at: this.getDateTime()
            }


            await axios.get(url, { params: { dataRequest } })
                .then(res => {
                    if (res.data.error === 'exist') {

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
            console.log(data)
                // esto modifica la tabla en vivo luego de actualizar los datos en el back end
            this.response.data.id_user = this.id_user
            this.response.data.name_assigned = this.name_user
            this.response.data.home_address = data[0].home_address
            this.response.data.created_at = data[0].created_at
            this.response.data.timeScheduleA = ''
            this.response.data.timeScheduleB = data[0].timeScheduleB
            this.response.data.type = data[0].type
            this.response.data.lat = data[0].lat
            this.response.data.lng = data[0].lng

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
        exist() {
            var text = 'Este ' + this.updateOnly.type + ' ya esta asignado al codigo postal'
            text = text + ' ' + this.response.data.postal_code
            this.error.display = true
            this.error.text = text
        },
    },
    computed: {
        validateUpdate() {
            if (
                this.id_country === '' ||
                this.id_province === '' ||
                this.id_locate === '' ||
                this.lat === '' ||
                this.lng === '' ||
                this.home_address === '' ||
                this.timeSchedule === '' ||
                this.timeSchedule.length < 26
            ) { return true } else { return false }
        }
    },




})