Vue.component('delete-coverage', {
    template: //html 
        `
        <div >
            <v-container>
        
                <template class="ma-4" >
                    <v-row class=" d-flex justify-start flex-column ma-1" >

                                <v-col  cols="12" xl="12" lg="12" md="12" sm="12" xs="12"  >
                                <template>
                                    <v-alert
                                    class="py-5"
                                    border="right"
                                    colored-border
                                    type="info"
                                    elevation="2"
                                    icon="mdi-store"
                                    >
                                    <v-row class="mx-1 d-flex justify-between ">
                                        <template  v-if="response.data.name_assigned !== '' && response.data.name_assigned !== null" >
                                            <v-col cols="12" lg="6" class="pa-1 " >
                                            <strong>Nombre :</strong> {{response.data.name_assigned}} {{response.data.name_alternative}}
                                            </v-col>
                                        </template>
                                       
                                        <v-col cols="12" lg="6" class="pa-1 ">
                                            <strong>Pais :</strong> {{response.data.name_country}}
                                        </v-col>
                                        <v-col cols="12" lg="6" class="pa-1 ">
                                            <strong>Provincia :</strong> {{response.data.province}}
                                        </v-col>
                                        <v-col cols="12" lg="6" class="pa-1 ">
                                            <strong>Localidad :</strong> {{response.data.locate}}
                                        </v-col>

                                        <template  v-if="response.data.home_address !== '' && response.data.home_address !== null" >
                                            <v-col cols="12" lg="6" class="pa-1 ">
                                                <strong>Dirección :</strong> {{response.data.home_address}}
                                            </v-col>
                                        </template>
                                        <v-col cols="12" lg="6" class="pa-1 ">
                                            <strong>Tipo :</strong> {{response.data.type}}
                                        </v-col>
                                        <v-col cols="12" lg="6" class="pa-1 ">
                                            <strong>CP :</strong> {{response.data.postal_code}}
                                        </v-col>

                                    </v-row>
                                    </v-alert>
                                </template>  
                            </v-col> 

                            <h5 class="mx-4 my-2">Motivo</h5>
                            <v-col  cols="12" xl="6" lg="6" md="6" sm="12" xs="12"  >
                                <select-auto-complete-simple-id 
                                :title="deleteCoverage.select.title" 
                                :url="deleteCoverage.select.url"
                                @exportVal="setData($event)"
                                :outlined="deleteCoverage.select.outlined"
                                :classCustom="deleteCoverage.select.class"
                                :dense="deleteCoverage.select.dense"
                                
                                    />
                            </v-col>
                            
                        <v-col  cols="12" xl="6" lg="6" md="6" sm="12" xs="12"  >
                            <v-btn
                            color="error"
                            :disabled="validateDelete"
                            @click="_delete()"
                            class="mb-2"
                            width="150"
                            >
                            <template v-if="loading">
                                <v-progress-circular
                                indeterminate
                                color="primary"
                            ></v-progress-circular>
                            </template>
                            <template v-else>
                                     Eliminar
                                <v-icon right>
                                    mdi-trash-can-outline
                                </v-icon>
                            </template>
                           
                            </v-btn>
                        </v-col>
                    </v-row>
                </template>
            </v-container>
        </div>
    `,
    props: ['dialogMediaScreen', 'admin', 'response'],
    data() {
        return {
            deleteCoverage: {
                select: {
                    display: true,
                    title: 'Seleccione motivo',
                    url: API_BASE_CONTROLLER + 'coberturaController.php?cobertura=getMotivesDown',
                    outlined: false,
                    class: '',
                    dense: true
                }

            },
            motive: '',
            loading: false

        }
    },
    methods: {
        setData(data) {
            this.motive = data.id
        },
        async _delete() {
            this.loading = true
            const dataRequest = {
                id: this.response.data.id,
                admin: this.admin,
                motive: this.motive,
                created_at: this.getDateTime()
            }
            const url = this.response.url.delete
            await axios.get(url, { params: { dataRequest } })
                .then(res => {
                    this.loading = false
                    if (res.data.error) {
                        const snack = { display: true, timeout: 2000, text: 'Algo salio mal', color: 'error' }
                        this.$emit("setSnack", snack)
                        return
                    }
                    this.$success();
                })
                .catch(err => {
                    console.log(err)
                })
        },
        $success() {
            const snack = { display: true, timeout: 2000, text: 'Eliminado correctamente', color: 'success' }
            this.$emit("setSnack", snack)
            const set = {
                id: this.response.data.id,
                action: 'delete'
            }

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
    },
    computed: {
        validateDelete() {
            if (this.motive === '' || this.admin === '' || this.response.data.id === '' || this.loading) {
                return true
            } else {
                return false
            }

        }
    },


})