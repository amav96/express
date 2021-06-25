Vue.component('update-point', {
    template: //html 
        `
    <div>
        <v-container>   
                <template v-if="!saveSuccess">
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
                    <h6 class="my-3 d-flex justify-start align-items-center">
                        Dirección del {{returnType()}}
                        <v-icon class="mx-1">mdi-store</v-icon>
                    </h6>
                    <geocoding-simple
                    @setErrorGeocoding="errorGeocoding = $event"
                    @setResultGeocoding="resultGeocoding = $event"
                    @setCountryID="id_country = $event"
                    @setProvinceID="id_province = $event"
                    @setLocateID="id_locate = $event"
                    @setHomeAddress="home_address = $event"
                    @setLat="lat = $event"
                    @setLng="lng = $event"
                    :outlined="save.point.select.outlined"
                    :classCustom="save.point.select.class"
                    :dense="save.point.select.dense"
                    :save="save"
                    />
            
                    <template >
                            <h6 class="ml-4 my-3 d-flex justify-start align-items-center">Horarios de atención al cliente
                            <v-icon class="mx-1">mdi-calendar-clock</v-icon>
                            </h6>
                            <time-schedule
                            :outlined=true
                            classCustom=""
                            :dense="true"
                            @setTimeSchedule="timeSchedule = $event" />
                    </template>
                    
                        <h6 class="ml-2 my-3 d-flex justify-start align-items-center"> Ingrese rango de codigo postal &nbsp;  <span class="font-weight-light" > (Esto buscará los codigos postales asignados en el rango y podras seleccionar)</span>
                            <v-icon class="mx-1">mdi-counter</v-icon>
                         </h6>
                        <v-row class="d-flex justify-start flex-row" >
                            <v-col  cols="12" xl="4" lg="4" md="6" sm="6" xs="4"  >
                                <v-text-field
                                label="Desde"
                                v-model="cp_start"
                                type="number"
                                outlined
                                dense
                                flat
                                />
                            </v-col>
                            
                            <v-col  cols="12" xl="4" lg="4" md="6" sm="6" xs="4"  >
                                <v-text-field
                                label="Hasta"
                                v-model="cp_end"
                                type="number"
                                outlined
                                dense
                                flat
                                />
                            </v-col>
                            
                            <v-col  cols="12" xl="4" lg="4" md="6" sm="6" xs="4"  >
                            <v-btn
                            :disabled="validateButtonSearchCPbyRange()"
                            class="mx-2 white--text"
                            color="primary"
                            @click="_getAllPointInZone()"
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

                    <template v-if="error.display" >
                        <v-alert
                        class="ml-4 my-5" 
                        dense
                        outlined
                        type="error"
                        >
                        {{error.text}}
                        </v-alert>
                    </template>

                    <template v-if="zone && zone.length > 0 ">
                    <h6 class="ml-4 my-5" > Seleccione codigos postales</h6>
                        <switches-content 
                        :options="zone" 
                        @setOptions="selectZone = $event"
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
                            :disabled="validateFormComplete"
                            @click="_updateData()"
                            >
                            Siguiente
                            </v-btn>
                        </v-row>

                    </template>
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
        },
        dialogSmallScreen: {
            type: Object
        }
    },
    data() {
        return {
            id_country: '',
            id_province: '',
            id_locate: '',
            home_address: '',
            lat: '',
            lng: '',
            timeSchedule: '',
            saveLoading: false,
            zone: [],
            selectZone: [],
            errorGeocoding: '',
            resultGeocoding: '',
            error: {
                display: false,
                text: ''
            },
            cp_start: '',
            cp_end: '',
            saveSuccess: false,
        }
    },
    methods: {
        returnType() {
            if (this.save.type === 'correo') {
                return "Correo";
            }
            if (this.save.type === 'terminal') {
                return "Terminal";
            }

        },
        async _getAllPointInZone() {
            const url = this.save.zone.url_AllPointInZone
            await axios.get(url, {
                    params: {
                        type: this.save.type,
                        id_user: this.save.type,
                        country: this.id_country,
                        province: this.id_province,
                        home_address: this.home_address,
                        cp_start: this.cp_start,
                        cp_end: this.cp_end
                    }
                })
                .then(res => {
                    if (res.data.error) {
                        const error = { display: true, text: 'No hay resultados' }
                        this.error = error
                        this.zone = []
                        return
                    }
                    this.zone = res.data

                    this.error.display = false
                })
                .catch(err => {
                    console.log(err)
                })
        },
        validateButtonSearchCPbyRange() {
            if (this.cp_start === '' || this.cp_start.length < 4 || this.cp_end === '' || this.cp_end.length < 4 || this.id_country === '' || this.id_province === '' || this.id_user === '' || this.lat === '' || this.lng === '' || this.home_address === '') {
                return true
            } else {
                return false
            }

        },
        async _updateData() {
            this.saveLoading = true
            const url = this.save.url.update
            const dataRequest = {

                value: this.selectZone,
                id_user: this.save.type,
                timeSchedule: this.timeSchedule,
                type: this.save.type,
                admin: this.admin,
                lat: this.lat,
                lng: this.lng,
                home_address: this.home_address,
                created_at: this.getDateTime()
            }
            await axios.get(url, {
                    params: {
                        dataRequest
                    }
                })
                .then(res => {
                    this.saveLoading = false
                    if (res.data.error) {
                        alertNegative("Mensaje CODIGO 15");
                        return
                    }

                    if (res.data.data) this.$success(res)
                    if (res.data.success === 'only_one_and_same') this.$successEmptyResponse();
                })
                .catch(err => {
                    this.saveLoading = false
                    const snack = { display: true, timeout: 5000, text: err, color: 'error' }
                    this.$emit("setSnack", snack)
                })
        },
        $success(res) {
            const snack = { display: true, timeout: 2000, text: 'Actualizado correctamente', color: 'success' }
            this.$emit("setSnack", snack)
            this.$emit('response', res.data.data)
            this.$emit('showTable', true)
            this.$emit('setExportDisplay', false)
            this.$emit('setPaginateDisplay', false)
            this.$emit('setDialogDisplay', false)
        },
        $successEmptyResponse() {
            const snack = { display: true, timeout: 2000, text: 'Actualizado correctamente', color: 'success' }
            this.$emit("setSnack", snack)
            this.$emit('response', [])
            this.$emit('showTable', false)
            this.$emit('setPaginateDisplay', false)
            this.$emit('setDialogDisplay', false)
            this.$emit('setExportDisplay', false)
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
                this.lat === '' ||
                this.lng === '' ||
                this.home_address === '' ||
                this.home_address === undefined ||
                this.timeSchedule === '' ||
                this.timeSchedule.length < 26 ||
                this.selectZone.length === 0
            ) { return true } else { return false }
        }
    },



    // agregar dos input para colocar el rango de codigo postal, buscar y mostrar


})