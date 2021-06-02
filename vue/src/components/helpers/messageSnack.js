Vue.component('message-snack', {
    template: //html 
        `
        <div>
            <div class="text-center" >
            <v-snackbar
                v-model="snackbar.snack"
                color="success"
                :timeout="snackbar.timeout"
                
                width="100%"
                >
                   {{snackbar.textSnack}}
                <template v-slot:action="{ attrs }">
                    <v-icon  right>
                        mdi-check-circle-outline
                    </v-icon>
                </template>
            </v-snackbar>
            </div>
            
        </div>
        
    `,
    props: ['snackbar'],
    data() {
        return {

        }
    },
    methods: {

    }
})