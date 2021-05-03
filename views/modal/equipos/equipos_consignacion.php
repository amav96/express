<!-- Modal -->
<div class="modal fade" id="clienteConsignacion" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Cliente a consignación</h5>
               
            </div>
            <div class="modal-body">
            <form action="#" id="formClientesConsignacion">
                    <div class="form-group">
                        <label for="">Nombre</label>
                        <input class="form-control" name="nombreConsignacion" id="nombreConsignacion">
                    </div>
                    <div class="form-group">
                        <label for="">Apellido</label>
                        <input class="form-control" name="apellidoConsignacion" id="apellidoConsignacion">
                    </div>
                    <div class="form-group">
                        <label for="">Documento</label>
                        <select class="form-control" name="tipoDocConsignacion" id="tipoDocConsignacion">
                            <option value="dni">CUIT/RUT</option>
                            <option value="cedula">DNI</option>
                            <option value="libreta">Libreta</option>
                            <option value="pasaporte">Pasaporte</option>
                        </select>
                        <input class="form-control" name="documentoConsignacion" id="documentoConsignacion">
                    </div>
                    <div class="form-group">
                        <label for="">Dirección</label>
                        <input class="form-control" name="direccionConsignacion" id="direccionConsignacion">
                    </div>
                    <div class="form-group">
                        <label for="">Provincia</label>
                        <input class="form-control" name="provinciaConsignacion" id="provinciaConsignacion">
                    </div>
                    <div class="form-group">
                        <label for="">Localidad</label>
                        <input class="form-control" name="localidadConsignacion" id="localidadConsignacion">
                    </div>
                    <div class="form-group">
                        <label for="">Codigo Postal</label>
                        <input class="form-control" name="codigoPostalConsignacion" id="codigoPostalConsignacion">
                    </div>
                    <div class="form-group">
                        <label for="">Telefono</label>
                        <input class="form-control" name="telefonoConsignacion" id="telefonoConsignacion" placeholder="Importancia nivel = ALTO">
                    </div>
                    <div class="form-group">
                        <label for="">Email</label>
                        <input class="form-control" type="email" name="emailConsignacion" id="emailConsignacion">
                    </div>
                    <div class="form-group">
                        <label for="">Empresa</label>
                        <input class="form-control" name="empresaConsignacion" id="empresaConsignacion">
                    </div>
                    <div class="form-group">
                        <label for="">Terminal</label>
                        <input class="form-control" name="terminalConsignacion" id="terminalConsignacion">
                    </div>
                    <div class="form-group">
                        <label for="">Serie</label>
                        <input class="form-control" name="serieConsignacion" id="serieConsignacion">
                    </div>
                    <div class="form-group">
                        <label for="">Modelo</label>
                        <input class="form-control" name="modeloConsignacion" id="modeloConsignacion">

                    </div>
                    <div class="form-group">
                        <label for="">Motivo</label>
                        <select class="form-control" name="motivoConsignacion" id="motivoConsignacion">
                            <option value="quiere-entregar">Quiere entregar </option>
                            <option value=">quiere-dar-de-baja-el-servicio">Quiere dar de baja el servicio </option>
                            <option value="ya-no-los-usa-mas">Ya no los usa mas </option>
                            <option value="no-sabe-donde-entregarlo">No sabe donde entregarlo </option>
                            <option value="otros">Otros </option>
                        </select>
                    </div>
                    <input type="hidden" class="form-control" id="idReceptor">
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-danger" id="enviarRemitoConsignacion">Enviar Comprobante</button>
                <button type="button" class="btn btn-secondary" id="salirAConsignacion">Cerrar</button>
                <button type="submit" id="enviarAConsignacion" class="btn btn-primary">Guardar</button>
             
            </div>
            </form>
           
        </div>
    </div>
</div>