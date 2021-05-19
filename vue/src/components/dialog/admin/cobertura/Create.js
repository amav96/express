Vue.component('dialog-cobertura-create',{
template : //html 
    `
    <div id="app">
        <v-app id="inspire">
            <v-row justify="center">
            <v-dialog
                v-model="dialogParams.display"
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
                    @click="closeDialog"
                    >
                    <v-icon>mdi-close</v-icon>
                    </v-btn>
                    <v-toolbar-title>Crear Cobertura</v-toolbar-title>
                        <api-geocoding/>
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
                  
                 <v-text-field v-model="test">

                 </v-text-field>

                </v-card>
            </v-dialog>
            </v-row>
        </v-app>
    </div>
    `,
props:['dialogParams'],
data (){
return {
    test: ''
}
},
methods : {
    closeDialog(){
        this.dialogParams.display = !this.dialogParams.display 
    }
        
}
})
