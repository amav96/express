Vue.component('tipo-avisos',{
    template : /*html*/ 
    `
   <div class="d-flex justify-content-center align-items-center flex-column">

       <div class="d-flex justify-content-center flex-column w-75 mb-4">
        <span class="text-center text-large grueso-medium"> Tipos de avisos </span>
         <span  class="text-center gray-easy text-medium"> Seleccione tipo </span>
         </div>

        <div class="d-flex justify-content-center flex-row flex-wrap p-1">

            <div class=" p-2 d-flex justify-content-center flex-column align-content-center align-items-center"
                 @click="sendNotice({tipo:'manana',metodo:'setNoticeManagement'})">
                 
                    <div class=" circle-icon btn">
                        <img class="img-aviso" v-bind:src="base_url+'/estilos/imagenes/front/tomorrow.png'" v-if="loadingVisita.tipo === null || dataContacto.tipoDeAviso === 'ruta'" >
                        <span class="spinner-border" role="status"
                        v-if="loadingVisita.tipo === 'manana'"
                        >
                        </span>
                     </div>

                     <div class="py-4 text-large">
                      <strong>Dia siguiente</strong>
                     </div>
                    
            </div>


                <div class="p-2 d-flex justify-content-center flex-column align-content-center align-items-center"
                     @click="sendNotice({tipo:'ruta',metodo:'setNoticeManagement'})">

                      <div class=" circle-icon btn">
                        <img class="img-aviso" v-bind:src="base_url+'/estilos/imagenes/front/road.png'" v-if="loadingVisita.tipo === null || dataContacto.tipoDeAviso === 'manana'" >
                        <span class="spinner-border" role="status"
                        v-if="loadingVisita.tipo === 'ruta'"
                        >
                        </span>
                      </div>
                      <div class="py-4 text-large">
                       <strong>En Ruta</strong>
                     </div>

                   
                </div>
                
        </div>

        <transition name="fade">
         <modal-visita :textModal="textModal"  v-if="flagAux" />
        </transition>
       
   </div>
    
    `,
    data () {
        return{
           hola : 'hola',
           textModal : 'Avisos de visita',
        }
    },computed : {
        ...Vuex.mapState('visita',['error','loadingVisita','flagAux','dataContacto','loadingVisita','base_url'])
     },
     methods:{
         ...Vuex.mapMutations('visita',['setIdentificacion','mostrarflagAux','setTipoDeAviso','setLoadingVisita','setError']),
         ...Vuex.mapActions('visita',['getDataCustomer']),
        async sendNotice(type){
            
            if(this.dataContacto.identificacion === ''){
  
                this.setError({tipo:'requerido',message:'Debes completar cliente',alert:'alert-danger',time:4000})
                return 
            }
        
            // mostrar loader de cada tipo de aviso
            this.setLoadingVisita(type)
            // --------------------------------------
            this.setTipoDeAviso(type)
            this.getDataCustomer()
          
         }
     }

})
