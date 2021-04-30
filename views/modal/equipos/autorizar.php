<div id="agregarTeams" class="modal fade" tabindex="-1" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<form name="add_product" id="add_product">
				<div class="modal-header">
					<h4 class="modal-title">Recuperación de equipos sujetos a autorización</h4>

				</div>
				<div class="modal-body">
					<div class="componentes-aut" id="componentes-aut">
						<div class="check-estilo">
							<div class="form-group" id="cont-accesorio-uno-aut">
								<label id="txtAccesorioUnoAut"><strong>Cable HDMI</strong></label>
								<div class="control radio">
									<input type="radio" class="control-input" name="accesorio-uno-aut" value="si entrego">Si
									<input type="radio" class="control-input" name="accesorio-uno-aut" value="no entrego">No
								</div>
							</div>
							<div class="form-group" id="cont-accesorio-dos-aut">
								<label id="txtAccesorioDosAut"><strong>Cable AV</strong></label>
								<div class="control radio ">
									<input type="radio" id="siEntregoAccesorioDosAut" class="control-input" name="accesorio-dos-aut" value="si entrego">Si
									<input type="radio" id="noEntregoAccesorioDosAut" class="control-input" name="accesorio-dos-aut" value="no entrego">No
								</div>
							</div>

							<div class="form-group" id="cont-accesorio-tres-aut">
								<label id="txtAccesorioTresAut"><strong>Fuente</strong></label>
								<div class="control radio">
									<input type="radio" class="control-input" name="accesorio-tres-aut" value="si entrego">Si
									<input type="radio" class="control-input" name="accesorio-tres-aut" value="no entrego">No
								</div>
							</div>
							<div class="form-group" id="cont-accesorio-cuatro-aut">
								<label id="txtAccesorioCuatroAut"><strong>Control</strong></label>
								<div class="control radio">
									<input type="radio" id="siEntregoAccesorioCuatroAut" class="control-input" name="accesorio-cuatro-aut" value="si entrego">Si
									<input type="radio" id="noEntregoAccesorioCuatroAut" class="control-input" name="accesorio-cuatro-aut" value="no entrego">No
								</div>
							</div>
						</div>
					</div>
					<div class="inputs-aut" id="inputs-aut">




						<div class="form-group" id="cont-otros-accesorio-aut">
						<label><strong>Otros Accesorios/Observaciones - <span style="color:#0093f5;" >Opcional</span> </strong></label>

							<input style="background-color:#D6EAF8 ;border:0;" type="text" class="form-control" name="input-otrosaccesorios-aut" id="input-otrosaccesorios-aut" placeholder="Si tienes algun comentario, agregalo. 'No obligatorio' ">

						</div>
						<div class="form-group" id="cont-motivoRetiro-aut">
							<label><strong>Motivo de Retiro</strong></label>
							<select class="form-control" name="motivo-retiro-select" id="motivo-retiro-select">
								<option value="55 terminales-sin-movimientos">Terminales sin movimientos</option>
								<option value="49 cierre-local">Por cierre de local</option>
								<option value="50 retiro-por-deuda">Retiro por deuda</option>
								<option value="48 disconformidad-servicio">Disconformidad con el Serv.</option>
								<option value="51 cambio-razon-social">Por CRS (Cbio. Razón Soc.)</option>
								<option value="52 omnis-temporarias">Omnis temporarias</option>
								<option value="53 reduccion-de-costos">Reducción de costos</option>
								<option value="54 dejo-de-operar-c/tarjetas">Dejó de operar c/Tarjetas</option>
								<option value="56 agronacion">Agronación</option>
								<option value="57 otros-emisores">Otros emisores</option>
								<option value="58 desvinc-mayoristas">Desvinc. de mayoristas</option>
								<option value="59 otros-motivos">Otros motivos</option>
								<option value="60 entrega-en-posnet">Entrega en Posnet</option>
								<option value="61 terminales-diferidas">Terminales diferidas</option>
								<option value="62 Sistemas-propios">Sistemas propios</option>
								<option value="63 cambio-de-servicio">Cambio de servicio</option>
								<option value="54 cambio-de-domicilio">Cambio de domicilio</option>
								<option value="65 baja-adm-perdida">Baja adm - A perdida</option>
								<option value="66 baja-adm-cobradas">Baja adm - Cobradas</option>
								<option value="67 baja-por-siniestro">Baja por siniestro</option>
								<option value="No Aplica">No Aplica</option>

							</select>
						</div>
						<div class="form-group" id="cont-estado-aut">
							<label><strong>Estado</strong></label>
							<select type="hidden" name="input-estado-aut" id="input-estado-aut" class="form-control" required>
								<option value="AUTORIZAR">A CONFIRMAR</option>
							</select>
						</div>

						<div class="form-group" id="cont-identificacion-aut">

							<input style="background-color:#D6EAF8 ;border:0;" type="hidden" name="input-identificacion-aut" id="input-identificacion-aut" class="form-control" placeholder="identificacion" readonly>
						</div>
						<div class="form-group" id="cont-terminal-aut">
							<label><strong>Terminal</strong>
							<span class="eleccion-terminal">
								   No visible / No enciende
								  <input class="control-input" id="noVisibleTerminalAut" type="checkbox" > 
								  </span>
						</label>
							<input style="background-color:#D6EAF8 ;border:0;" type="text" name="input-terminal-aut" id="input-terminal-aut" class="form-control" placeholder="Ingrese numero de terminal">

						</div>

						

						<div class="form-group" id="cont-serie-aut">

							<label><strong id="labelSerieAut">Serie S/N: </strong></label>
							<input style="background-color:#D6EAF8 ;border:0;" type="text" name="input-serie-aut" id="input-serie-aut" class="form-control" placeholder="Ingresar serie">
						</div>

						<div id="cableRedAut"></div>

						<div class="form-group" id="cont-serie-base-aut">

							<label><strong>Serie Base </strong></label>
							<input style="background-color:#D6EAF8 ;border:0;" type="text" name="serie-base-aut" id="serie-base-aut" class="form-control" placeholder="Ingrese serie de la base">
						</div>

						<div class="form-group" id="cont-chip-aut">
							<label>
								<strong>Ingrese Nro. de chip / Sim </strong>
							</label>
							<input style="background-color:#D6EAF8 ;border:0;" type="text" name="input-chip-aut" id="input-chip-aut" class="form-control" placeholder="Ingrese nro de Sim" required>
						</div>

						
					
						</div>
						
						<div class="d-flex justify-content-center" >

						
						<span class="d-flex justify-content-center" id="contLoaderAutorizar">

						</span>
						</div>
						
						
						<div class="modal-footer">
						<input type="hidden" id="idServ">

							<input type="button" class="btn btn-danger" id="salirAgregar" data-dismiss="modal" value="Salir">
							<input type="button" id="enviar" class="btn bg-indigo text-white enviar" value="Procesar equipo">

						</div>
					
				</div>
			</form>
		</div>
	</div>
</div>