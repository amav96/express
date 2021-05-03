<!-- Modal -->
<div class="modal fade" id="caja-de-equipos" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Confirmación de equipos</h5>
                
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="text-center" id="cantRemitCaja">
                </div>
                <div class="caja" id="caja">

                </div>
                <div  style="display:flex;justify-content:center;align-content:center;margin:auto;" id="laoderenbase">
					</div>
            </div>
            <div class="modal-footer d-flex justify-content-center">
            
            <div class=" d-flex justify-content-center  align-content-center align-items-center align-self-center flex-wrap">

                <button type="button" id="siguienteNormal" style="width:21rem;"  class="btn btn-success text-white ">Confirmar 
                 <i class="fas fa-check-circle"></i>
                </button>
                <button type="button" id="abrirfirmar" style="width:21rem;"  class=" btn btn-success text-white"  data-toggle="modal">
                    Confirmar 
                    <i class="fas fa-check-circle"></i>
                </button>
            </div>

            <button type="button" id="mantenerEnvioDeRemito"  class="btn btn-primary">Enviar Remito
            <i class="far fa-file-alt"></i>
            </button>

                <button type="button" id="vaciarCaja" data-dismiss="modal" class="btn btn-danger">Vaciar

                <i class="far fa-trash-alt"></i>
                </button>

                <button type="button" id="seguirRecuperando" class="btn bg-indigo-static text-white" data-dismiss="modal">Seguir recuperando
                    <i class="fas fa-sign-out-alt"></i>
                </button>


               

                <!-- MODAL FIRMAR -->

            </div>
        </div>
    </div>
</div>


