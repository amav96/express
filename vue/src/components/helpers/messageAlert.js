Vue.component('message-alert',{
template : //html 
    `   
        <div>
            <v-row align="center"  class="d-flex justify-center" >
                <v-col class="d-flex justify-center align-content-center align-items-center" cols="12" sm="7">
                    <v-alert  type="success" v-if="alert_flag" class="pa-3">
                    {{message}}
                    </v-alert>
                </v-col>
            </v-row>
            
        </div>
       
    `,
props:["message",'alert_flag'],
data (){
    return {

    }
},
methods : {
        
},

})