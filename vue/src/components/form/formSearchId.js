Vue.component('form-search-id',{

    template : /*html*/ 
    `   
    
       <div class="altura" >
            <form 
            @submit.prevent="searchID" 
            id="sendFormID" 
            class=" d-flex justify-center flex-row align-center  flex-wrap">
                <div class="mx-1 field-medium">
                    <v-text-field
                    label="Complete identificación"
                    hide-details="auto"
                    v-model.trim="id"
                    >
                    </v-text-field >
                </div>
                <div class="mx-1 my-1" >
                    <v-btn
                    color="primary"
                    fab
                    small
                    primary
                    type="submit"
                    form="sendFormID"
                    class=" sacarOutline"
                    :disabled="validateForm"
                    >
                        <v-icon>mdi-magnify</v-icon>
                    </v-btn>
                </div>
            </form>
        
       </div>
    
    `,
    props:['titleFormId','base_url_searchId'],
    data() {
        return {
           id:'',
        }
    },
    methods:{
      async searchID(){

        try {

            this.$emit('childrenTable',true)
            this.$emit('childrenLoadingData',true)

            await axios.get(this.base_url_searchId,{
                params: {
                 id:this.id
                }
            })
            .then(res =>{
             if(!res.data[0].result){
                 const error = {
                        type: 'no-exist',
                        text: 'No hay datos para mostrar',
                        time: 4000
                 }

                 this.$emit('childrenError',error)
                 this.$emit('childrenLoadingData',false)
                 this.$emit('childrenTable',false)
                 this.$emit('dataChildsearchId', [])
                 return
             }
                 this.$emit('dataChildsearchId', res.data)
                 this.$emit('childrenLoadingData',false)
            })
            .catch(err => {
                 const error = {
                        type: 'no-exist',
                        text: err,
                        time: 4000
                 }
                 
                 this.$emit('childrenError',error)
                 this.$emit('childrenTable',false)
                 this.$emit('childrenLoadingData',false)
            })
            
        } catch (err) {
            const error = {
                type: 'no-exist',
                text: err,
                time: 4000
            }
         
            this.$emit('childrenError',error)
            this.$emit('childrenTable',false)
            this.$emit('childrenLoadingData',false)
        }
            
        }
    },
    computed: {

       
        validateForm(){
            var validateID = this.id
            if(validateID === ''){
                return true
            }else{
                return false
            }
        }
    }
        
   

})
