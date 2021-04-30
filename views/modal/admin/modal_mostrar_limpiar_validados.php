<!-- Modal -->
<div class="modal fade" id="abrirModalMostrarFinal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Limpieza final</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

    <form  method="POST" enctype="multipart/form-data" action="<?=base_url?>control/adm/C_normalizacion.php?action=mostrarTablaFinal" >
   
    <div class="form-group">
    <label for="">Fecha ingresado</label>
      <input type="date" class="form-control" name="fechaBuscarTablaFinal" id="fechaBuscarTablaFinal" required>
    </div>
   

    <div class="form-group">
    <label for="">Empresa</label>
      <select type="text" class="form-control" name="empresaBuscarFinal" id="empresaBuscarFinal" required> </select>
    </div>

    <div class="form-group">
    <label for="">Cartera</label>
      <input type="text" class="form-control" name="carteraBuscarFinal" id="carteraBuscarFinal" required>
    </div>

    <div class="form-group">
    <label for="">Accion a realizar</label>
    <select type="text" class="form-control" name="accionARealizar" id="accionARealizar" required> 
   <option value="final">Telefonos finales</option>
   <option value="evaluar">Telefonos a evaluar </option>
   <option value="invalidos">Invalidos </option>

    </select>
    </div>
    

    <div class="form-group">
    <button type="submit" name="botonBuscarFinal" class="btn btn-primary">Buscar</button>
    </div>

      </form>
   

      </div>
      <div class="modal-footer">
          
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        
        
      </div>
    </div>
  </div>
</div>