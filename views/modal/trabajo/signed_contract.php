<div class="modal fade" id="firmarContrato" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Firma</h5>
        <button type="button" class="close" class="close" data-dismiss="modal" aria-label="Close">
          <span id="salirEquisFirmar" >&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <div id="contenedor">
          <div style="display:flex;justify-content:center;align-content:center;" class="col-md-12" id="cont-firma">
            <canvas  id="firma" width="290" height="310" style="border:1px solid black; margin:0.5rem auto">
            </canvas>
          </div>
          <div class="row">


            <div class="col-md-12  mb-5">

              <div class="form-group">
                <label class="text-left" for="">Documento</label>
                <input readonly style="background-color:#D6EAF8 ;border:0;" type="text" class="form-control" id="documentoFirmar" value="<?= $contrato->id_number ?>" placeholder="Documento">
                <label for="" id="errorDocumento"></label>
              </div>


            </div>


            <input style="display:none;" type="color" id="color">
            <input style="display:none;" type="range" id="puntero" min="1" default="1" max="5" width="10%">

          </div>
        </div>


      </div>


      <div class="modal-footer">
      <div style="display:flex;justify-content:center;align-content:center;margin:auto;" class="laoderfirma" id="laoderfirma">
      </div>

        <!-- FIRMA LISTA Y ENVIAR DATOS -->
        <button type="button" class="btn btn-primary" id="crear-imagen">Siguiente
          <i class="far fa-file-alt"></i>
        </button>

        <!-- BORRAR FIRMO  -->
        <button type="button" class="btn btn-info" id="borrar-imagen"> Borrar firma</button>

        


      </div>
    </div>
  </div>
</div>