Vue.component('modal-visita', {
    template:  /*html*/ 
    `   
<div>
     <div class="modal-mask" >
         <div class="modal-wrapper">
             <div class="modal-dialog modal-dialog-scrollable">
                 <div class="modal-content ">
                     <div class="modal-header bg-indigo-static text-white">
                        <h4 class="modal-title" >{{ textModal }} <i class="fas fa-hand-point-down mx-2"></i></h4>
                            <button @click="mostrarflagAux(false)" type="button" class="close text-white">
                                <span aria-hidden="true">&times;</span>
                            </button>
                     </div>
                     <div class="modal-body" >
                            <datos-contacto/>
                     </div>
                 </div>
             </div>
         </div>
     </div>
 </div>
    
    `,

    data () {
        return {
            
        }
        
    },
    props:['textModal'],
    computed : {
     ...Vuex.mapState('visita',['arrayNumeros','arrayEmail']),
    
    },
    methods:{
   ...Vuex.mapMutations('visita',['mostrarflagAux'])
    },
    

  })