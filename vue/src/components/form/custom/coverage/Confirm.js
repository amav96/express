Vue.component('confirm', {
    template: //html 
        `
        <div>
            <v-card>
                <v-card-title class="text-h5">
                    ¿Estas seguro?
                </v-card-title>
                <v-card-actions>
                    <v-spacer></v-spacer>
                        <v-btn
                        color="green darken-1"
                        text
                        @click="dialogSmallScreen.display = false"
                        >
                        Cerrar
                        </v-btn>
        
                        <v-btn
                        color="green darken-1"
                        text
                        @click="$confirm()"
                        >
                        Aceptar
                        </v-btn>
                    </v-card-actions>
            </v-card>
        </div>
        `,
    props: {
        dialogSmallScreen: {
            type: Object
        }
    },
    methods: {
        $confirm() {
            this.$emit('setConfirm', true)
        }
    }
})