Vue.component('d-full-screen', {
    template: //html 
        `
        <div id="app">
            <template id="inspire">
                <v-row justify="center">
                <v-dialog
                    v-model="dialogFullScreen.display"
                    fullscreen
                    hide-overlay
                    transition="dialog-left-transition"
                >
                    <v-card>
                        <v-toolbar
                            dark
                            color="primary"
                        >
                            <v-btn
                            icon
                            dark
                            @click="dialogFullScreen.display = false"
                            >
                            <v-icon>mdi-arrow-left</v-icon>
                            </v-btn>
                            <v-toolbar-title>titulo statico</v-toolbar-title>
                               
                            <v-spacer></v-spacer>
                            <v-toolbar-items>
                            <v-btn
                                dark
                                text
                            >
                                Save
                            </v-btn>
                            </v-toolbar-items>
                        </v-toolbar>
                        <template>
                            <slot></slot>
                        </template>
                    </v-card>
                </v-dialog>
                </v-row>
            </template>
        </div>
        `,
    props: {
        dialogFullScreen: {
            type: Object
        }
    },
    data() {
        return {}
    },
    methods: {


    }
})