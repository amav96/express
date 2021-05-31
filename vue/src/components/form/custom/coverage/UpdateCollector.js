Vue.component('update-collector', {
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
                
                <h6 class="ml-4 my-5"> Zona a cubir  (Es la zona donde operara el {{returnType()}})</h6>
                <v-row class="d-flex justify-start flex-row" >
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

                </v-row>

                    <h6 class="ml-4 my-5">  Ingrese rango de codigo postal </h6>
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
                    ref="cache"
                    @setOptions="selectZone = $event"
                    @selectZoneCache="selectZoneCache = $event"
                    @deleteOne="_deleteOne($event)" />
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
            zone: [],
            selectZone: [],
            selectZoneCache: [],
            error: {
                display: false,
                text: ''
            },
            cp_start: '1000',
            cp_end: '1007',
            overlay: {
                absolute: true,
                opacity: 2,
                overlay: true,
            },
            saveSuccess: false,
            saveFlag: false,
            id_replace: []
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
            this.save.action === 'create' ? this.id_province_by_select = province.id : true

        },
        async _getAllPointInZone() {
            const url = this.save.zone.url_AllPointInZone
            await axios.get(url, {
                    params: {
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

                    this.verifyRepeatCodes(res.data);
                    this.error.display = false
                })
                .catch(err => {
                    console.log(err)
                })
        },
        validateFormComplete() {

            if (this.id_user === '' || this.selectZone.length === 0) {
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
        async _updateData() {
            this.saveLoading = true
            const url = this.save.url.update
            await axios.get(url, {
                    params: {
                        id: this.selectZone,
                        id_user: this.id_user,
                        type: this.save.type,
                        admin: this.admin,
                        created_at: this.getDateTime()
                    }
                })
                .then(res => {
                    console.log(res);
                    return
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
            this.$emit('response', res.data)
            this.$emit('showTable', true)
        },
        finish() {
            if (this.saveFlag) {

                setTimeout(() => {
                    this.saveSuccess = true
                    this.saveLoading = false
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

                    this.$nextTick(() => {
                        this.saveSuccess = false
                            // setting flag filtering
                        this.$emit('filtering', false)

                        const snack = { snack: true, timeout: 2000, textSnack: 'Recolector creado exitosamente' }
                        this.$emit("setSnack", snack)
                        this.saveFlag = false

                    })
                }, 700);

            }
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
        verifyRepeatCodes(items) {
            var lastCode = ''
            var code = ''
            var repeat = []
            items.forEach((val) => {
                code = val.postal_code
                if (code === lastCode) {
                    repeat.push(val.postal_code)
                }
                lastCode = code
                    //or lastCode = val.postal_code
            })
            items.forEach((val) => {
                if (repeat.indexOf(val.postal_code) > -1) {
                    val.repeat = true
                }
            })
            this.zone = items
        },
        _deleteOne(id) {
            this.id_replace = id
            const url = this.save.url.delete
            axios.get(url, {
                    params: {
                        id: this.id_replace,
                        admin: this.admin,
                        created_at: this.getDateTime()
                    }
                })
                .then(res => {
                    if (res.data.error) {
                        alertNegative("Mensaje CODIGO 25")
                        return
                    }
                    this.cleanArrayByZone()
                })
                .catch(err => {
                    console.log(err)
                })
        },
        async cleanArrayByZone() {
            // this.zone = this.zone.filter(zone => {
            //     return zone.id.indexOf(id) === -1
            // })
            await this._getAllPointInZone();
            this.selectZone = this.selectZoneCache
            this.$refs.cache.setCache(this.selectZoneCache)

        }
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
    }


    // agregar dos input para colocar el rango de codigo postal, buscar y mostrar


})