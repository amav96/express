
<div class="modal fade" id="modalBaja" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Baja usuario</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">


                <div class="form-group"> 
                    <label for="">Documento Usuario</label>

                    <input type="text" id="id_usuario_baja" class="form-control" readonly>
                   
                    <input type="hidden" id="id_usuario_managent_baja" class="form-control">
                </div>

                <div class="form-group">
                    <label for="">Motivo baja</label>
                    <select type="text" id="motivo_baja_usuario" class="form-control">
                    <option value="0">Seleccione opción</option>
                        <option value="conflicto">Conflicto</option>
                        <option value="baja-performance">Baja performance</option>
                        <option value="baja-voluntaria">Baja voluntaria</option>
                        <option value="consiguio-otro-trabajo">Consiguio otro trabajo</option>
                    </select>
                </div>

                <div class="form-group"> 
                    <label for="">Correo usuario</label>
                    <input type="text" id="mail_usuario_baja" class="form-control" readonly>
                </div>
              

                <div class="form-group">
                <label for="Descripcion">Descripcion</label>
                <textarea class="form-control" id="descripcion_baja" rows="3"></textarea>
                </div>
               
                
                <div class="form-group" id="footer">

                </div>
                
            </div>

         
            <div class="modal-footer" >
              <span id="loaderadd" ></span>
                <button type="button" class="btn btn-danger" id="down_user">Dar de baja</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal" aria-label="Close" >Cerrar</button>
                
            </div>
        </div>
    </div>
</div>