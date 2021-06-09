Vue.component('message-snack', {
    template: //html 
        `
        <div>
            <div class="text-center" >
            <v-snackbar
            v-model="snackbar.display"
            :timeout="snackbar.timeout"
            :color="snackbar.color"
            width="100%"
            >
            {{snackbar.text}}
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