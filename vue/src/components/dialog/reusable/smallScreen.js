Vue.component('d-small-screen', {
    template: //html 
        `
        <v-dialog
        v-model="dialogSmallScreen.display"
        max-width="320"
        hide-overlay
        persistent
        
        >
            <v-card>
               <template>
               <slot></slot>
               </template>
            </v-card>
        </v-dialog>
        `,
    props: ['dialogSmallScreen'],
    data() {
        return {

        }
    },
    methods: {}
})