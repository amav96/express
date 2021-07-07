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
                    <v-btn color="success" @click="$manualAssigned" :disabled="id_user === ''">
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
    data() {
        return {
            id_user: ''
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
        }
    },
    destroyed() {
        this.$emit("setUser", '')
    },
})