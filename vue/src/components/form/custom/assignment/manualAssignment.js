Vue.component('manual-assignment', {
    template: //html 
        `<div>
            <v-row class="d-flex justify-start flex-column my-2">
                <div class="mx-4 my-2">
                    <h5>Asignar manualmente</h5>
                </div>
                
                <v-col  cols="12" xl="12" lg="12" sm="12" xs="12">
                    <select-auto-complete-simple-id 
                    @exportVal="setUser($event)"
                    :title="manualAssignment.select.title" 
                    :url="manualAssignment.select.url" 
                    :outlined="manualAssignment.select.outlined"
                    :classCustom="manualAssignment.select.class"
                    :dense="manualAssignment.select.dense"
                    />
                </v-col>
                <v-col  cols="12" xl="12" lg="12" sm="12" xs="12">
                    <v-text-field
                        v-model="dateRange"
                        type="date"
                        label="Asignado hasta"
                        :error="minorDate"
                        :rules="msgErrorDateRange"
                    >
                    </v-text-field>
                </v-col>
                
                <v-col  cols="12" xl="12" lg="12" sm="12" xs="12">
                    <v-btn color="success" @click="$manualAssigned" :disabled="btnDisabled">
                    Asignar
                    </v-btn>
                    <v-btn @click="manualAssignment.display = false" color="error">
                    Salir
                    </v-btn>
                </v-col>
            </v-row>
    </div>
    `,
    props: ['manualAssignment', 'select'],
    computed: {
        minorDate() {
            if (this.dateRange !== '') {
                var today = new Date();
                var date = today.getFullYear() + '-' + ("0" + (today.getMonth() + 1)).slice(-2) + '-' +
                    ("0" + today.getDate()).slice(-2);

                const date1 = new Date(this.dateRange);
                const date2 = new Date(date);
                const diffTime = Math.abs(date2 - date1);
                const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));

                if (this.dateRange === date || this.dateRange < date) {
                    this.msgErrorDateRange = ["Debe ingresar una fecha mayor"]
                    return true
                } else if (diffDays > 15) {
                    this.msgErrorDateRange = ["La fecha no debe superar 15 dias desde hoy"]
                    return true
                } else {
                    this.msgErrorDateRange = []
                    return false
                }

            }
        },
        btnDisabled() {
            if (this.id_user === '' || this.dateRange === '' || this.minorDate) {
                return true;
            } else { return false }

        }
    },
    data() {
        return {
            id_user: '',
            dateRange: '',
            msgErrorDateRange: [],
        }
    },
    methods: {
        setUser(user) {
            this.id_user = user.id
        },
        $manualAssigned() {
            this.$emit("manualAssigned")
        }
    },
    watch: {
        id_user(val) {
            this.$emit("setUser", val)
        },
        dateRange(val) {
            if (!this.minorDate) {
                this.$emit("setDateRange", val)
            }
        }
    },
    destroyed() {
        this.$emit("setUser", '')
        this.$emit("setDateRange", '')
    },
})