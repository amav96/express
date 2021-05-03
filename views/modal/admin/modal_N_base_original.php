<!-- Modal -->
<div class="modal fade" id="importarBaseOriginal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Importar Base original</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
    
          <!-- <?php // if(!isset($_SESSION["flag"]) || $_SESSION["flag"] === 'no-aprobado'){?> -->

            <!-- <form method="POST" enctype="multipart/form-data" action="<?= base_url ?>normalizacion/verificarBaseOriginal">
            
            <div class="form-group">
              <input type="file" class="form-control-file" name="dataImportarBO" id="dataImportarBO" required>
            </div>
            <div class="form-group">
              <label for="">Fecha ingresado</label>
              <input type="date" class="form-control" name="fechaImportadoBO" id="fechaImportadoBO" required>
            </div>
            <div class="form-group">
              <label for="">Administrador</label>
              <input type="text" class="form-control" value="<?= $_SESSION["username"]->name; ?>" name="operadorBO" id="operadorBO" required readonly>
            </div> -->

            

          
            <!-- <?php // } if(isset($_SESSION["flag"]) && $_SESSION["flag"] === 'aprobado'){?>  -->

              <form method="POST" enctype="multipart/form-data" action="<?= base_url ?>normalizacion/importarBaseOriginal">
          
              <div class="form-group">
              <input type="file" class="form-control-file" name="dataImportarBO" id="dataImportarBO" required>
            </div>

            <?php

            date_default_timezone_set('America/Argentina/Buenos_Aires');
            $date= date('Y-m-d') ;
            ?>
            <div class="form-group">
              <label for="">Fecha ingresado </label>
              <input type="text" class="form-control" value="<?= $date?>" name="fechaImportadoBO" id="fechaImportadoBO" required readonly>
            </div>
            <div class="form-group">
              <label for="">Administrador </label>
              <input type="text" class="form-control" value="<?= $_SESSION["username"]->name; ?>" name="operadorBO" id="operadorBO" required readonly>
            </div>
            <div class="form-group">
              <label for="">Clave </label>
              <input type="password" class="form-control"  id="clave" autocomplete="on" >
            </div>


              <!-- <?php //}   ?>   -->
            
           <div class="text-center" id="ContloaderImportarBase">
             
           </div>
    

      </div>
      <div class="modal-footer">

        <button type="submit" id="botonImportarBO" name="botonImportarBO" class="btn btn-primary">Importar</button>

        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        </form>

      </div>
    </div>
  </div>
</div>