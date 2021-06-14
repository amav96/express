Vue.component('update-onlyOne-point', {
    template: //html 
        `
        <div>
            <v-container>   
                
                        <h6 class="ml-4 my-5"> Point </h6>
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

    },
    data() {
        return {
            id_country_by_select: '',
            id_country: '',
            id_province_by_select: '',
            id_province: '',
            id_locate: '',
            id_user: '',
            infoUser: [],
            saveLoading: false,
            zone: [],
            selectZone: [],
            error: {
                display: false,
                text: ''
            },

            saveSuccess: false,
            saveFlag: false,
        }
    },
    methods: {
        returnType() {
            if (this.save.type === 'recolector') {
                return "Recolector";
            }

        },
        setUser(user) {
            this.resetToChangeUser()
            this.$nextTick(() => {
                this.infoUser = user
                this.id_user = user.id
            })


        },
        setSelectCountry(country) {
            this.id_country = country.id
            this.id_country_by_select = country.id
        },
        setSelectProvince(province) {
            this.id_province = province.id
            this.save.action === 'create' ? this.id_province_by_select = province.id : true

        },

        validateFormComplete() {

            if (this.id_user === '' || this.selectZone.length === 0) {
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
                    this.id_country_by_select = ''
                    this.id_country = ''
                    this.id_province_by_select = ''
                    this.id_province = ''
                    this.cp_start = ''
                    this.cp_end = ''
                    this.zone = []
                    this.id_locate = ''
                    this.id_user = ''
                    this.selectZone = []
                    this.infoUser = []
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
        resetToChangeUser() {
            this.id_country = ''
            this.id_province = ''
            this.id_locate = ''

        }
    },





    // agregar dos input para colocar el rango de codigo postal, buscar y mostrar


})