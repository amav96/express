<div class="modal fade" id="modalEditTransito" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Editar equipo en transito</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="component" id="component">

               
                </div>
                
                 <input type="hidden" value="<?=$_SESSION["username"]->id?>"  id="id_user_update"> 
                <div class="form-group">
                    <button id="editar-equipo" class="btn btn-success"  type="button">
                        Editar
                        <i class="fas fa-check"></i>
                    </button>
                </div>

            </div>

            <div class="text-center" id="loadereditar">

            </div>


            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" class="close" data-dismiss="modal" aria-label="Close" >Cerrar</button>
                
            </div>
        </div>
    </div>
</div>