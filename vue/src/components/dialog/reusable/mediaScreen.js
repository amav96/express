Vue.component('d-media-screen',{
    template : //html 
        `
        <div id="app">
            <template id="inspire">
                <v-row justify="center">
                <v-dialog
                    v-model="dialogMediaScreen.display"
                    persistent
                    max-width="700px"
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
                            @click="dialogMediaScreen.display = false"
                            >
                            <v-icon>mdi-close</v-icon>
                            </v-btn>
                            <v-toolbar-title>{{dialogMediaScreen.title}}</v-toolbar-title>
                               
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
    props:{
        dialogMediaScreen : {
            type : Object
        }
    },
    data (){
        return {
        }
    },
    methods : {
      
            
    }
    })
    