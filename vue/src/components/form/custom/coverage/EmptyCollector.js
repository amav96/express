Vue.component('empty-collector', {
    template: //html 
        `<div>
    
            <v-row class=" d-flex justify-start flex-column ma-1 my-0" >
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

                <h6 class="ml-4 my-3 d-flex justify-start align-items-center">Nuevo Recolector 
                    <v-icon class="mx-1">mdi-motorbike</v-icon>
                    <v-icon class="mx-1">mdi-car</v-icon>
                </h6>
                <v-col  cols="12" xl="4" lg="4" md="6" sm="6" xs="4"  >
                    <select-auto-complete-simple-id 
                    @exportVal="setUser($event)"
                    :title="resource.collector.select.title" 
                    :url="resource.collector.select.url"
                    :outlined="resource.collector.select.outlined"
                    :classCustom="resource.collector.select.class"
                    :dense="resource.collector.select.dense"
                    ref="resetUser"
                    />
                </v-col>
                <v-col  cols="12" xl="4" lg="4" md="6" sm="6" xs="4"  >
                    <v-btn
                    color="success"
                    width="180"
                    :disabled="validateFormComplete"
                    @click="_save()"
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
    props: ['dialogFullScreen', 'admin', 'resource'],
    data() {
        return {
            saveLoading: false,
            error: {
                display: false,
                text: ''
            },
            toRegister: {
                id_user: '',
            },
        }
    },
    methods: {
        setUser(data) {
            this.toRegister.id_user = data.id
        },
        _save() {
            const url = this.resource.url.save
            axios.get(url, {
                    params: {
                        id_user: this.toRegister.id_user,
                        id_country: this.resource.data.id_country,
                        id_province: this.resource.data.id_province,
                        id_locate: this.resource.data.id_locate,
                        postal_code: this.resource.data.postal_code,
                        admin: this.admin,
                        type: this.resource.type,
                        created_at: this.getDateTime()
                    }
                })
                .then(res => {
                    if (res.data.error) {
                        alertNegative("Mensaje CODIGO 45");
                        this.saveLoading = false
                        return
                    }

                    this.$success(res);
                })
                .catch(err => {
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
        $success(res) {
            const snack = { display: true, timeout: 2000, text: 'Recolector creado exitosamente', color: 'success' }
            this.$emit("setSnack", snack)
            res.data.data.forEach((val) => {
                this.$emit("setSavedData", val)
            })
            this.$emit('setFront', 'save')
            this.$emit("setDialog", false)
        },
    },
    computed: {
        validateFormComplete() {
            if (
                this.toRegister.id_user === '' ||
                this.resource.data.id_country === '' ||
                this.resource.data.id_province === '' ||
                this.resource.data.id_locate === '' ||
                this.resource.data.postal_code === ''
            ) {
                return true
            } else {
                return false
            }
        }
    },

})