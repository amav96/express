Vue.component('message-alert',{
template : //html 
    `
        <v-alert type="success" v-if="alert_flag">
            {{message}}
        </v-alert>
    `,
props:["message",'alert_flag'],
data (){
    return {

    }
},
methods : {
        
},

})