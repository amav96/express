<!-- Modal -->
<div class="modal fade" id="abrirImportarLimpiarValidados" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Importar Validados</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <form method="POST" enctype="multipart/form-data" action="../../control/adm/C_normalizacion.php">
          <div class="form-group">
            <input type="file" class="form-control-file" name="dataImportarLimpiarValidados" id="dataImportarLimpiarValidados">
          </div>

      </div>
      <div class="modal-footer">

        <button type="submit" name="botonImportar_LimpiarValidados" class="btn btn-primary">Importar</button>
        </form>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>


      </div>
    </div>
  </div>
</div>