<!-- Modal -->
<div class="modal fade" id="abrirImportarOrdenador" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Importar Para Ordenar</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <form method="POST" enctype="multipart/form-data" action="../../control/adm/C_normalizacion.php">
          <div class="form-group">
            <input type="file" class="form-control-file" name="dataImportarOrdenar" id="dataImportarOrdenar">
          </div>

          <div class="form-group">
        <label for="">Fecha ingresado</label>
          <input type="date" class="form-control" name="fechaImportadoOrdenar" id="fechaImportadoOrdenar" required>
        </div>
        <div class="form-group">
        <label for="">Administrador</label>
          <input type="text" class="form-control" value="<?php echo $_SESSION["tipo"]["nombre"]; ?>" name="operadorOrdenar" id="operadorOrdenar" required readonly>
        </div>

        <div class="form-group">
        <label for="">Empresa</label>
          <select class="form-control" name="empresaOrdenar" id="empresaOrdenar" required> </select>
        </div>

        <div class="form-group">
        <label for="">Cartera</label>
          <input type="text" class="form-control" name="carteraOrdenar" id="carteraOrdenar" required>
        </div>


      </div>
      <div class="modal-footer">

        <button type="submit" name="botonImportar_Ordenar" class="btn btn-primary">Importar</button>
        </form>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>


      </div>
    </div>
  </div>
</div>