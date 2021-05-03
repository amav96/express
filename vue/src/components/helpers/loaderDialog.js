Vue.component('loader-dialog',{
    template : //html 
        `
        <div>
            <template>
            <v-dialog
            v-model="loaderDialog"
            hide-overlay
            persistent
            width="300"
        >
            <v-card
            color="primary"
            dark
            >
            <v-card-text>
                Crgando pagina...
                <v-progress-linear
                indeterminate
                color="white"
                class="mb-0"
                ></v-progress-linear>
            </v-card-text>
            </v-card>
        </v-dialog>
        </template>
        </div>
        `,
        props:['loaderDialog'],
        data (){
        return {
            
        }
        },
        methods : {
                
        }
    })