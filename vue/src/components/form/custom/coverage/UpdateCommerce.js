Vue.component('update-commerce', {
    template: //html 
        `
    <div>
        <v-container>   
                <template v-if="!saveSuccess">
                <h6 class=" my-3 d-flex justify-start align-items-center">Comercio
                <v-icon class="mx-1">mdi-store</v-icon>
                </h6>
                    <v-row class="d-flex justify-start flex-row" >
                        <v-col  cols="12" xl="4" lg="4" md="6" sm="6" xs="4"  >
                            <select-auto-complete-simple-id 
                            @exportVal="setUser($event)"
                            :title="save.commerce.title_field" 
                            :url="save.commerce.url_users" 
                            :outlined="save.commerce.select.outlined"
                            :classCustom="save.commerce.select.class"
                            :dense="save.commerce.select.dense"
                            
                            />
                        </v-col>
                        <template v-if="infoUser.length !== 0">
                            <v-col  cols="12" xl="8" lg="8" md="6" sm="6" xs="8"  >
                                <alert-info-user
                                :info="infoUser"
                                />         
                            </v-col>
                        </template>
                    </v-row>
                    
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
                        Dirección del comercio 
                        <v-icon class="mx-1">mdi-store</v-icon>
                    </h6>
                    <geocoding-simple
                    @setErrorGeocoding="errorGeocoding = $event"
                    @setResultGeocoding="resultGeocoding = $event"
                    @setCountryID="id_country = $event"
                    @setProvinceID="id_province = $event"
                    @setLocateID="id_locate = $event"
                    @setHomeAddress="home_address = $event"
                    :outlined="save.commerce.select.outlined"
                    :classCustom="save.commerce.select.class"
                    :dense="save.commerce.select.dense"
                    :save="save"
                    ref="refGecoded"
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
                            class="info--text "
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
                            class="info--text "
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
                        <v-col class="pa-0" cols="12" xl="6" lg="6" >
                                <iframe
                                width="100%"
                                height="450"
                                style="border:0"
                                loading="lazy"
                                allowfullscreen
                                
                                :src="srcImgMap()">
                                </iframe>
                        </v-col>
                    </template>
                    
                        <h6 class="my-3 d-flex justify-start align-items-center"> Ingrese rango de codigo postal &nbsp;  <span class="font-weight-light" > (Esto buscará los codigos postales asignados en el rango y podras seleccionar)</span>
                        <v-icon class="mx-1">mdi-counter</v-icon>
                         </h6>
                        <v-row class="d-flex justify-start flex-row" >
                            <v-col  cols="12" xl="4" lg="4" md="6" sm="6" xs="4"  >
                                <v-text-field
                                label="Desde"
                                v-model="cp_start"
                                type="number"
                                class=""
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
                                class=""
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
            srcMap: '',
            id_user: '',
            infoUser: [],
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
            if (this.save.type === 'comercio') {
                return "Comercio";
            }

        },
        setUser(user) {
            this.$nextTick(() => {
                this.infoUser = user
                this.id_user = user.id
                this.hasAlreadyBeenGeocoded()
            })

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
        hasAlreadyBeenGeocoded() {
            const url = this.save.commerce.url.hasAlreadyBeenGeocoded
            axios.get(url, { params: { id_user: this.id_user } })
                .then(res => {
                    if (res.data.success) {
                        this.$_dataAlreadyGeocoded(res.data)
                        this.selectZone = []
                        this.zone = []
                        this.$refs.refGecoded.resetProvinceAndLocate()
                    } else {
                        this.$refs.refGecoded.reset()
                        this.lat = '';
                        this.lng = '';
                        this.id_country = ''
                        this.id_province = ''
                        this.id_locate = ''
                        this.home_address = ''
                        this.srcMap = ''
                        this.selectZone = []
                        this.zone = []
                    }
                })
                .catch(err => {
                    console.log(err)
                })
        },
        $_dataAlreadyGeocoded(geocoded) {
            this.$refs.refGecoded.setGeocoded(geocoded)
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
                id_user: this.id_user,
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
                    console.log(err)
                })
        },
        $success(res) {
            const snack = { display: true, timeout: 2000, text: 'Actualizado correctamente', color: 'success' }
            this.$emit("setSnack", snack)
            this.$emit('response', res.data.data)
            this.$emit('showTable', true)
            this.$emit('setPaginateDisplay', false)
            this.$emit('setDialogDisplay', false)
            this.$emit('setExportDisplay', false)
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

    watch: {
        resultGeocoding(val) {
            this.home_address = val.result.formatted_addess
            this.lat = val.lat
            this.lng = val.lng

            this.srcMap = 'https://www.google.com/maps/embed/v1/place?key=AIzaSyDasdhwGs_A9SbZUezcx9VhSSGkxl46bko&q=' + this.lat + ',' + this.lng;
            // this.srcMap = 'https://maps.googleapis.com/maps/api/staticmap?key=AIzaSyDasdhwGs_A9SbZUezcx9VhSSGkxl46bko&center=' + this.lat + ',' + this.lng + '&zoom=16&size=360x230&maptype=roadmap&markers=color:red%7C' + this.lat + ',' + this.lng;

        },

    },
    computed: {
        validateFormComplete() {

            if (this.id_user === '' || this.selectZone.length === 0 || this.home_address === '' || this.home_address === undefined || this.lat === '' || this.lng === '') {
                return true
            } else {
                return false
            }

        },
    }



    // agregar dos input para colocar el rango de codigo postal, buscar y mostrar


})