
<div class="modal fade" id="ModalAddCustomers" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Agregar Cliente</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <div class="form-group">
                    <label for="">Empresa</label> <span id="cargarEmpresa"></span>
                    <select type="text" id="empresa_add" class="form-control" > 
                    </select>
                </div>

                <div class="form-group">
                    <label for="">Cartera</label>
                    <input type="text" id="cartera_add" value="cupon" class="form-control" readonly> 
                </div>
                
                <div class="form-group">
                    <label for="">Identificacion</label>

                    <input type="text" id="identificacion_add" class="form-control" placeholder="Ingrese identificacion">
                </div>


                <div class="form-group"> 
                    <label for="">ID LOCAL</label> <span class="loadervalidate" id="loaderidlocal"></span>

                    <input type="text" id="id_local_add" class="form-control" placeholder="Ingrese id local de base original">
                </div>

                <div class="form-group">
                    <label for="">Pais</label> <span id="loaderPais" ></span>
                    <select type="text" id="pais_add" class="form-control">
                        
                    </select>
                </div>
                <div class="form-group">
                    <label for="">Provincia</label> <span id="loaderProvinciaAgregar" ></span>
                    <select type="text" id="provincia_add" name="provincia_add" class="form-control" >
                    </select>
                </div>
                <div class="form-group">
                    <label for="">Localidad</label> <span id="loaderLocalidadAgregar" ></span> 
                    <select type="text" id="localidad_add" name="localidad_add" class="form-control" >
                    </select>
                </div>
                <div class="form-group">
                    <label for="">Domicilio</label>
                    <input type="text" id="domicilio_add" class="form-control" placeholder="Ingrese Domicilio">
                </div>
                <div class="form-group">
                    <label for="">Codigo Postal</label>
                    <input type="text" id="codigo_postal_add" class="form-control" placeholder="Ingrese Codigo Postal">
                </div>
                <div class="form-group">
                    <label for="">Serie</label> <span id="loaderserie"></span>
                    <input type="text" id="serie_add" class="form-control" placeholder="Ingrese Serie">
                </div>
                <div class="form-group">
                    <label for="">Terminal</label><span id="loaderterminal"></span>
                    <input type="text" id="terminal_add" class="form-control" placeholder="Ingrese Terminal">
                </div>
                <div class="form-group">
                    <label for="">SIM</label>
                    <input type="text" id="sim_add" class="form-control" placeholder="Ingrese SIM">
                </div>

                <div class="form-group">
                    <label>Nombre y Apellido </label>
                    <input  type="text" id="nombre_add" class="form-control" placeholder="Ingrese Nombre y Apellido ">
                </div>
                
                
                <div class="form-group">
                    <label for="">Email</label>

                    <input type="email" id="email_add" class="form-control" placeholder="Ingrese Email">
                </div>
                <div class="form-group">
                    <label for="">Telefono</label>

                    <input type="text" id="telefono_add" class="form-control" placeholder="Ingrese teléfono">
                </div>
                <div class="form-group">
                    <label id="ope" for="">Operador/a</label>
                    <input type="text" id="id_user_add" value="<?=$_SESSION["username"]->id?>" class="form-control" placeholder="id de operador" readonly>
                </div>
                
                <div class="form-group" id="ButtonNext">

                </div>
                
            </div>

         
            <div class="modal-footer" >
              <span id="loaderadd" ></span>
                <button type="button" class="btn btn-danger" id="registerCustomer">Agregar</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal" aria-label="Close" >Cerrar</button>
                
            </div>
        </div>
    </div>
</div>