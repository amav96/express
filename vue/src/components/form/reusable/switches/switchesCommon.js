Vue.component('switches-common',{
template : //html 
    `<div>
        <v-row class=" d-flex justify-start flex-row px-3" >
            <v-col cols="12" sm="2" md="2" v-for="option in options" :key="option"    
            >
                <v-switch
                v-model="optionsIn"
                :label="option"
                color="primary"
                :value="option"
                hide-details
                ></v-switch>
            </v-col>
        </v-row>  
     </div>
    `,
    props:{
        options :{
            type : Array
        },
    },
    data (){
    return {
         optionsIn:[]
    }
    },
    methods:{
        clearOptions(){
            this.optionsIn = []
        }
    },
    watch : {
         optionsIn(val){
             this.$emit('setOptions',val);
         },
         options(val){
             this.clearOptions() 
         }
     }
})