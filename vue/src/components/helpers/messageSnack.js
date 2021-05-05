Vue.component('message-snack',{
template : //html 
    `
        <v-snackbar
        class="justify-center"
        v-model="snackbar.snack"
        :timeout="snackbar.timeout"
        centered
        >
        {{ snackbar.textSnack }}
        <v-icon right>
          mdi-check-circle-outline
        </v-icon>
        </v-snackbar>
    `,
props:['snackbar'],
data (){
    return {

    }
},
methods : {
        
}
})