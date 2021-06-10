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

                    <h6 class="ml-4 my-5"> Dirección de {{returnType()}} a geocodificar</h6>
                    <geocoding-simple
                    @setErrorGeocoding="errorGeocoding = $event"
                    @setResultGeocoding="resultGeocoding = $event"
                    @setCountryID="id_country = $event"
                    @setProvinceID="id_province = $event"
                    @setLocateID="id_locate = $event"
                    :outlined="save.point.select.outlined"
                    :classCustom="save.point.select.class"
                    :dense="save.point.select.dense"
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
                            class="info--text mx-2"
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
                            class="info--text mx-2"
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
                            <v-col  cols="12" xl="8" lg="8" >
                                <iframe
                                width="100%"
                                height="450"
                                style="border:0"
                                loading="lazy"
                                allowfullscreen
                                :src="srcImgMap()">
                                </iframe>
                            </v-col>
                        </v-row>
                    </template>
                    
                        <h6 class="ml-4 my-5">  Ingrese rango de codigo postal <span class="font-weight-light" >(Esto buscará los codigos postales asignados en el rango y podras seleccionar)</span> </h6>
                        <v-row class="d-flex justify-start flex-row" >
                            <v-col  cols="12" xl="4" lg="4" md="6" sm="6" xs="4"  >
                                <v-text-field
                                label="Desde"
                                v-model="cp_start"
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
                                v-model="cp_end"
                                type="number"
                                class="mx-4"
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
                            block
                            :disabled="validateFormComplete()"
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
            srcMap: '',
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
            saveFlag: false,
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
                        id_user: this.id_user,
                        country: this.id_country,
                        province: this.id_province,
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
        srcImgMap() {
            return this.srcMap
        },
        reverseGeocodingManualToMap() {
            this.srcMap = 'https://www.google.com/maps/embed/v1/place?key=AIzaSyDasdhwGs_A9SbZUezcx9VhSSGkxl46bko&q=' + this.lat + ',' + this.lng;
        },
        validateFormComplete() {

            if (this.id_user === '' || this.selectZone.length === 0) {
                return true
            } else {
                return false
            }

        },
        validateButtonSearchCPbyRange() {
            if (this.cp_start === '' || this.cp_start.length < 4 || this.cp_end === '' || this.cp_end.length < 4 || this.id_country === '' || this.id_province === '' || this.id_user === '') {
                return true
            } else {
                return false
            }

        },
        activateSearchEngine() {
            if (this.cp_start !== '' && this.cp_end !== '' && this.id_country !== '' && this.id_province !== '') {
                this._getAllPointInZone();
            } else {
                if (this.selectZone.length > 0) {
                    this.selectZone = []
                }
            }
        },
        async _updateData() {
            this.saveLoading = true
            const url = this.save.url.update
            const dataRequest = {
                lat: this.lat,
                lng: this.lng,
                home_address: this.home_address,
                value: this.selectZone,
                id_user: this.save.type,
                type: this.save.type,
                admin: this.admin,
                created_at: this.getDateTime()
            }
            await axios.get(url, {
                    params: {
                        dataRequest
                    }
                })
                .then(res => {
                    if (res.data.error) {
                        alertNegative("Mensaje CODIGO 15");
                        this.saveLoading = false
                        return
                    }

                    this.$emit("setDialogDisplay", false)
                    this.$nextTick(() => {
                        this.setResponseWhenFinally(res)
                        this.saveFlag = true
                    })

                })
                .catch(err => {
                    this.saveLoading = false
                    console.log(err)
                })
        },
        setResponseWhenFinally(res) {
            this.$emit('setPaginateDisplay', false)
            this.$emit('response', res.data.data)
            this.$emit('showTable', true)
        },
        finish() {
            if (this.saveFlag) {
                setTimeout(() => {
                    this.saveSuccess = true
                    this.saveLoading = false
                    this.id_country = ''
                    this.id_province = ''
                    this.lat = ''
                    this.lng = ''
                    this.home_address = ''
                    this.srcMap = ''
                    this.cp_start = ''
                    this.cp_end = ''
                    this.zone = []
                    this.id_locate = ''
                    this.selectZone = []
                    this.error.display = false
                    this.error.text = ''

                    this.$nextTick(() => {
                        this.saveSuccess = false
                            // setting flag filtering
                        this.$emit('filtering', false)
                        const snack = { display: true, timeout: 2000, text: 'Actualizado exitosamente', color: 'success' }
                        this.$emit("setSnack", snack)
                        this.saveFlag = false

                    })
                }, 700);

            }
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

    watch: {
        resultGeocoding(val) {
            this.home_address = val.formatted_addess
            this.lat = val.lat
            this.lng = val.lng

            this.srcMap = 'https://www.google.com/maps/embed/v1/place?key=AIzaSyDasdhwGs_A9SbZUezcx9VhSSGkxl46bko&q=' + this.lat + ',' + this.lng;
            // this.srcMap = 'https://maps.googleapis.com/maps/api/staticmap?key=AIzaSyDasdhwGs_A9SbZUezcx9VhSSGkxl46bko&center=' + this.lat + ',' + this.lng + '&zoom=16&size=360x230&maptype=roadmap&markers=color:red%7C' + this.lat + ',' + this.lng;

        },
        dialogFullScreen: {
            handler() {
                this.$nextTick(() => {
                    this.finish()
                })
            },
            deep: true
        },
        id_user(newVal, oldVal) {
            if (newVal !== oldVal) {
                this.activateSearchEngine();
            }
        }
    },



    // agregar dos input para colocar el rango de codigo postal, buscar y mostrar


})