Vue.component('update-onlyOne-collector', {
    template: //html 
        `
        <div>
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


                <h6 class="ml-4 my-3">Nuevo Recolector </h6>
                    <v-col  cols="12" xl="4" lg="4" md="6" sm="6" xs="4"  >
                        <select-auto-complete-search-id 
                        :searchID="response.data.id_country"
                        :title="update.collector.select.title" 
                        :url="update.collector.select.url"
                        @exportVal="setUser($event)"
                        :outlined="update.collector.select.outlined"
                        :classCustom="update.collector.select.class"
                        :dense="update.collector.select.dense"
                        ref="resetUser"
                        />
                    </v-col>
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
        }


    },
    data() {
        return {
            infoUser: '',
            id_user: '',
            name_user: '',
            saveLoading: false,
            error: {
                display: false,
                text: ''
            },
            saveSuccess: false,
            saveFlag: false,
            update: {
                collector: {
                    select: {
                        title: 'Ingrese recolector',
                        url: API_BASE_CONTROLLER + 'usuarioController.php?usuario=getUsersCollectorByCountry',
                        outlined: true,
                        class: '',
                        dense: true
                    },
                    url: {
                        update: API_BASE_CONTROLLER + 'coberturaController.php?cobertura=updateOnlyOne'
                    }
                }
            },

        }
    },
    methods: {
        setUser(user) {
            this.id_user = user.id
            this.name_user = user.name_user
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

                    this.$updateAfterFront(res.data.data);
                    this.$success();
                })
                .catch(err => {
                    this.saveLoading = false
                    console.log(err)
                })
        },
        $updateAfterFront(data) {
            // esto modifica la tabla en vivo luego de actualizar los datos en el back end
            this.response.data.id_user = this.id_user
            this.response.data.name_assigned = this.name_user
            this.response.data.created_at = data[0].created_at
            this.response.data.type = data[0].type
            this.response.data.home_address = ''
            this.response.data.timeScheduleA = ''
            this.response.data.timeScheduleB = ''
            this.response.data.lat = ''
            this.response.data.lng = ''
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
            var text = 'Este recolector ya esta asignado al codigo postal '
            text = text + ' ' + this.response.data.postal_code

            this.error.display = true
            this.error.text = text
        },
        clearError() {
            this.error.display = false
            this.error.text = ''
        }

    },
    computed: {
        validateUpdate() {
            if (this.id_user === '' || this.name_user === '') {
                return true
            } else {
                return false
            }
        }
    },
    created() {
        console.log(this.response.data)
    }





    // agregar dos input para colocar el rango de codigo postal, buscar y mostrar


})