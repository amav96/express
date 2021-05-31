Vue.component('update-commerce', {
    template: //html 
        `
            <div>
                <v-container>
                    <h2>Actualizar commerce</h2>
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
            },
            cp_start: '',
            cp_end: '',
            overlay: {
                absolute: true,
                opacity: 2,
                overlay: true,
            },
            saveSuccess: false,
            saveFlag: false

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
        getZoneByPostalCode(locate) {
            this.slug_locate = locate.slug
            this.save.action === 'create' ? this.chooseZipCode(locate) : ''
        },
        getAllPointInZone() {
            const url = this.save.zone.url_AllPointInZone
            axios.get(url, {
                    params: {
                        country: this.id_country,
                        province: this.id_province,
                        cp_start: this.cp_start,
                        cp_end: this.cp_end
                    }
                })
                .then(res => {
                    console.log(res)
                })
                .catch(err => {
                    console.log(err)
                })
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
        validateButtonSearchCPbyRange() {
            if (this.cp_start === '' || this.cp_start.length < 4 || this.cp_end === '' || this.cp_end.length < 4 || this.id_country === '' || this.id_province === '') {
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