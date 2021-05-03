Vue.component('error-global',{
    template: /*html*/
    `
       <div class="text-center">
                <v-alert type="error">
                    {{error.text}}
                </v-alert>
       </div>
    `
    ,
    props:['error'],
    data() {
        return {
            
        }
    },
    created(){
        const clearError = {
            type: null,
            text: null,
            time: null
        }
        
        setTimeout(()=>{
            
             this.$emit('clearingError',clearError )
            
        },this.error.time)
    }
    
})