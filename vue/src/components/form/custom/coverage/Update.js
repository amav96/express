Vue.component('update-coverage', {
    template: //html 
        `
        <div >
            <v-container>
        
                <template class="ma-4" >
                    <v-row class=" d-flex justify-start flex-column ma-1" >
                            <v-col  cols="12" xl="12" lg="12" md="12" sm="12" xs="12"  >
                                    <v-row class="mx-1 d-flex justify-between ">
                                    sdfsd
                                    </v-row>
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