Vue.component('modal-guia', {
    template: //html 
        `
<div v-if="modalGuia">
    <div class="modal-mask" >
        <div class="modal-wrapper">
            <div class="modal-dialog modal-dialog-scrollable">
                <div class="modal-content ">
                    <div class="modal-header bg-indigo-static text-white d-flex justify-content-center">
                       <h4 style="position:relative;left:20px;" class=" modal-title text-center" >{{titleModal}} <i class="fas fa-book mx-2"></i></h4>
                           <button @click="setModalGuia(false)" type="button" class="close text-white">
                               <span aria-hidden="true">&times;</span>
                           </button>
                    </div>
                    <div class="modal-body"  >

                        <p>En esta sección podras gestionar las bases asignadas</p>
                        <p>Te <strong> ahorrara tiempo y recursos</strong>, porque estaras en contacto con el cliente proximo a visitar, asegurando una visita <strong> eficaz.</strong></p>

                        <div class="my-4 card">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item"><h5>Aviso dia siguiente</h5> </li>
                            </ul>
                        </div>
                        
                       
                        <p> <i class="fas fa-calendar-day"></i> Podras notificarle de manera automática que lo vistaras el dia siguiente</p> 
                        
                        <div class="my-2 d-flex justify-content-start flex-row align-items-center align-self-center align-content-center">
                            <span>1) Completar cliente</span>
                            <input disabled type="text" class="ml-2 input-guia" placeholder="Complete cliente">
                        </div>

                        <div class="my-2 d-flex justify-content-start flex-row align-items-center align-self-center align-content-center">
                         <span>1) Clic en </span>
                            <div class="ml-2 d-flex justify-content-center flex-column align-content-center align-items-center caja-box-circle">
                                    <div class=" circle-icon-small btn">
                                        <img class="img-aviso-small" v-bind:src="base_url+'/estilos/imagenes/front/tomorrow.png'" >
                                    </div>
                                    <div class="text-small">
                                        <strong>Dia siguiente</strong>
                                    </div>
                            </div>                         
                        </div>

                     <p>3) Seleccionar opción por la cual se le enviara el aviso de visita <i style="color:#46d08f;" class=" fab fa-whatsapp"></i> <i style="color:#f74e4e;" class="far fa-envelope"></i> </p>

                        <div class="card my-4">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item"><h5>Aviso en ruta</h5> </li>
                            </ul>
                        </div>

                        <p><i class="fas fa-route"></i> Podras notificarle en el día, mientras estas en calle, que, proximamente estaras visitándolo</p>

                        <div class="my-2 d-flex justify-content-start flex-row align-items-center align-self-center align-content-center">
                            <span>1) Completar cliente</span>
                            <input disabled type="text" class="ml-2 input-guia" placeholder="Complete cliente">
                        </div>

                        <div class="my-2 d-flex justify-content-start flex-row align-items-center align-self-center     align-content-center">
                             <span>2) Clic en </span>
                            <div class="ml-2 d-flex justify-content-center flex-column align-content-center align-items-center caja-box-circle">
                                <div class=" circle-icon-small btn">
                                    <img class="img-aviso-small" v-bind:src="base_url+'/estilos/imagenes/front/road.png'" >
                                </div>
                                <div class="text-small">
                                    <strong>En ruta</strong>
                                </div>
                            </div> 
                            
                        </div>  

                        <p>3) Seleccionar opción por la cual se le enviara el aviso de visita <i style="color:#46d08f;" class=" fab fa-whatsapp"></i> <i style="color:#f74e4e;" class="far fa-envelope"></i> </p>

                        <p><strong>Para soporte</strong> Comunicarse a : <strong>sistemas@postalmarketing.com.ar </strong>Enviandonos tu Nro De Documento y especificando las dudas que tengas. Te responderemos a la brevedad <i class="far fa-thumbs-up"></i></p></p>
                    </div>
                    <div class="modal-footer">
                        
                        <button type="button" class="btn btn-danger" @click="setModalGuia(false)" >Salir</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

    `,
    props: ['titleModal', 'bodyModal'],
    data() {
        return {

        }
    }, computed: {
        ...Vuex.mapState('visita', ['modalGuia', 'base_url'])
    },
    methods: {
        ...Vuex.mapMutations('visita', ['setModalGuia'])
    }
})