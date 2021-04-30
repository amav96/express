Vue.component('error-alert',{
    template: /*html*/
    `
       <div class="d-flex justify-content-center">
          <div class="error" :class="error.alert">
             {{error.message}}
          </div>
       </div>
    `
    ,
    data() {
        return {
            
        }
    },
    computed:{
        ...Vuex.mapState('visita',['error'])
    }
})