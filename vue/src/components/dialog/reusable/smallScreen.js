Vue.component('d-small-screen', {
    template: //html 
        `
        <v-dialog
        v-model="dialogSmallScreen.display"
        max-width="290"
        hide-overlay
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