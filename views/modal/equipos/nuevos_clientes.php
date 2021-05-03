<!-- Modal -->
<div class="modal fade" id="nuevosClientesModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Agregar nuevos clientes</h5>

            </div>
            <div class="modal-body">
                <form action="#" id="formNuevosClientes">
                    <div class="form-group">
                        <label for="">Nombre</label>
                        <input class="form-control" name="nombreNuevo" id="nombreNuevo">
                    </div>
                    <div class="form-group">
                        <label for="">Apellido</label>
                        <input class="form-control" name="apellidoNuevo" id="apellidoNuevo">
                    </div>
                    <div class="form-group">
                        <label for="">Documento</label>
                        <select class="form-control" name="tipoDocNuevo" id="tipoDocNuevo">
                            <option value="dni">CUIT/RUT</option>
                            <option value="cedula">DNI</option>
                            <option value="libreta">Libreta</option>
                            <option value="pasaporte">Pasaporte</option>
                        </select>
                        <input class="form-control" name="documentoNuevo" id="documentoNuevo">
                    </div>
                    <div class="form-group">
                        <label for="">Dirección</label>
                        <input class="form-control" name="direccionNuevo" id="direccionNuevo">
                    </div>
                    <div class="form-group">
                        <label for="">Provincia</label>
                        <input class="form-control" name="provinciaNuevo" id="provinciaNuevo">
                    </div>
                    <div class="form-group">
                        <label for="">Localidad</label>
                        <input class="form-control" name="localidadNuevo" id="localidadNuevo">
                    </div>
                    <div class="form-group">
                        <label for="">Codigo Postal</label>
                        <input class="form-control" name="codigoPostalNuevo" id="codigoPostalNuevo">
                    </div>
                    <div class="form-group">
                        <label for="">Telefono</label>
                        <input class="form-control" name="telefonoNuevo" id="telefonoNuevo" placeholder="Importancia nivel = ALTO">
                    </div>
                    <div class="form-group">
                        <label for="">Email</label>
                        <input class="form-control" type="email" name="emailNuevo" id="emailNuevo">
                    </div>
                    <div class="form-group">
                        <label for="">Empresa</label>
                        <input class="form-control" name="empresaNuevo" id="empresaNuevo">
                    </div>
                    <div class="form-group">
                        <label for="">Terminal</label>
                        <input class="form-control" name="terminalNuevo" id="terminalNuevo">
                    </div>
                    <div class="form-group">
                        <label for="">Serie</label>
                        <input class="form-control" name="serieNuevo" id="serieNuevo">
                    </div>
                    <div class="form-group">
                        <label for="">Modelo</label>
                        <input class="form-control" name="modeloNuevo" id="modeloNuevo">

                    </div>
                    <div class="form-group">
                        <label for="">Motivo</label>
                        <select class="form-control" name="motivoNuevo" id="motivoNuevo">
                            <option value="quiere-entregar">Quiere entregar </option>
                            <option value=">quiere-dar-de-baja-el-servicio">Quiere dar de baja el servicio </option>
                            <option value="ya-no-los-usa-mas">Ya no los usa mas </option>
                            <option value="no-sabe-donde-entregarlo">No sabe donde entregarlo </option>
                            <option value="otros">Otros </option>
                        </select>
                    </div>
                    <input type="hidden" class="form-control" id="idReceptorNuevosClientes">


            </div>
            <div class="modal-footer">

                <button type="button" class="btn btn-secondary" id="salirNuevoCliente">Cerrar</button>
                <button type="submit" id="enviarInfoNuevo" class="btn btn-primary">Guardar</button>
            </div>
            </form>
        </div>
    </div>
</div>