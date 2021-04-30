Vue.component('btn-modal-visita', {
    template:  /*html*/ 
    `   
         <div id="btnAvisoVue" class=" box-visita">

            <transition name="fade"  >
                <error-alert v-if="error.tipo !== null"  ></error-alert>
            </transition>


            <div class="d-flex justify-content-center flex-column align-content-center align-items-center caja-box-circle"  
                @click="$_sendNotice({tipo:'domicilio',metodo:'setNotice'})">
                    <div class=" circle-icon-medium btn">
                        <img class="img-aviso-medium" v-bind:src="base_url+'/estilos/imagenes/front/visitante.png'" >
                        <span class="spinner-border" role="status"
                        v-if="loadingVisita.tipo === 'domicilio'">
                        
                        </span>
                     </div>

                     <div class="py-2 text-medium text-center">
                      <strong> {{ textButton }}</strong>
                     </div>
            </div>

            <transition name="fade">
            <modal-visita :textModal="textModal" :data="data" v-if="flagAux" />
            </transition>

            
         </div>
    `,

    data () {
        return {

            textButton: 'Aviso de Visita',
            textModal: 'Notificá al cliente tu visita',
            data : {
                id_user : '', 
                orden_id: ''
            }
        }
    },
    computed : {
       ...Vuex.mapState('visita',['error','loadingVisita','flagAux','base_url','dataContacto'])
    },
    methods:{

        ...Vuex.mapMutations('visita',['mostrarModalVisita','setIdentificacion','mostrarLoaderVisita','setError','setOrder','setTipoDeAviso','setLoadingVisita','setOrder']),
        ...Vuex.mapActions('visita',['getDataCustomer']),
      async  $_sendNotice(type){
        
            var identificacion = document.getElementById('q').value.toUpperCase()
        

            if(identificacion === ''){
                this.setError({tipo:'requerido',message:'Debes completar cliente',alert:'alert-danger',time: 3000})
                return 
            }

            const gestion = JSON.parse(localStorage.getItem('transito'))
        
            if(gestion !== null && gestion.length > 0 ){
      
                if(gestion[0].identificacion !== identificacion){
                   
                    this.setError({tipo:'requerido',message:'Solo se puede enviar avisos de visita al cliente de la transacción actual',alert:'alert-primary',time:5000})
                    return
            
                }
            }
            const order = JSON.parse(localStorage.getItem('odh'))
            if(!order || order === undefined || order === null || order.length === 0){
                this.setError({tipo:'sin orden',message:'Debes abrir una nueva transacción',alert:'alert-primary',time: 3000})
                    return
            }

            const avisoEnviado = JSON.parse(localStorage.getItem('aviso'))
            if(avisoEnviado !== null){
                if(avisoEnviado.identificacion !== identificacion){
                    
                    this.setError({tipo:'unico',message:'Solo se puede enviar avisos de visitas a un cliente por transacción. Inicie una nueva transacción',alert:'alert-primary',time: 3000})
                    return
                }
               
            }

            this.setIdentificacion(identificacion)
            this.setOrder(order)
            this.setLoadingVisita(type)
            this.setTipoDeAviso(type)
            this.getDataCustomer() 
            
            // this.getDataCustomer()            
        }
        
    },
    

  })