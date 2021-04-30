<!-- Modal -->
<div class="modal fade" id="firmar" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Firma, aclaración y documento</h5>
        <button type="button" class="close">
          <span id="salirEquisFirmar" aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!-- <div id="contenedor"> -->
          <div class="col-md-12" id="cont-firma">
            <canvas id="firma" width="290" height="310" style="border:1px solid black; margin:0.5rem auto">
            </canvas>
          </div>
          <div class="row">

            <div class="col-md-12  mb-5">
              <div class="form-group">
                <label class="text-left" for="">Aclaración</label>
                <input style="background-color:#D6EAF8 ;border:0;" type="text" class="form-control" id="nombreaclaracion" placeholder="Quien entrega el equipo">
                <label for="" id="errorAclaracion"></label>
              </div>
              <div class="form-group">
                <label class="text-left" for="">Documento</label>
                <input style="background-color:#D6EAF8 ;border:0;" type="text" class="form-control" id="documentoFirmar" placeholder="Documento">
                <label for="" id="errorDocumento"></label>
              </div>
              <input style="background-color:#D6EAF8 ;border:0;" type="hidden" class="form-control" id="idFirmar">

            </div>
            
            <input type="color" id="color">
            <input type="range" id="puntero" min="1" default="1" max="5" width="10%">

          </div>
        <!-- </div> -->
      </div>

      <div class="modal-footer">

      <span style="margin-right:3rem;" id="cont-loader-firmando"></span>

        <!-- FIRMA LISTA Y ENVIAR DATOS -->
        <button type="button" class="btn bg-indigo-static text-white" id="crear-imagen">Procesar firma
          <i class="far fa-file-alt"></i>
        </button>

        <!-- BORRAR FIRMO  -->
        <button type="button" class="btn btn-info" id="borrar-imagen"> Borrar firma</button>



      </div>
    </div>
  </div>
</div>