<div id="editProductModal" class="modal fade editProductModal">
	<div class="modal-dialog">
		<div class="modal-content">
			<form name="edit_product" id="edit_product">
				<div class="modal-header">
					<h4 class="modal-title">Equipos disponibles</h4>
					<input type="hidden" id="idd" name="idd">
				</div>
				<div class="modal-body">

				    <div class="form-group" id="cont-estado-en-base">
							<label><strong>Seleccione el tipo de gestión</strong></label>
							<select class="form-control" name="estado-rec-en-base" id="estado-rec-en-base" required>
							<option value="0">Seleccionar</option>
								<option value="RECUPERADO">RECUPERADO</option>
								<option value="RECHAZADA">RECHAZADA</option>
								<option value="EN-USO">EN USO</option>
								<option value="NO-TUVO-EQUIPO">NO TUVO EQUIPO</option>
								<option value="NO-EXISTE-NUMERO">NO EXISTE NUMERO</option>
								<option value="NO-RESPONDE">NO RESPONDE</option>
								<option value="TIEMPO-ESPERA">TIEMPO LIMITE ESPERA</option>
								<option value="SE-MUDO">SE MUDO</option>
								<option value="YA-RETIRADO">YA RETIRADO</option>
								<option value="ZONA-PELIGROSA">ZONA PELIGROSA</option>
								<option value="N/TEL-EQUIVOCADO">TEL EQUIVOCADO</option>
								<option value="NO-COINCIDE-SERIE">NO COINCIDE SERIE</option>
								<option value="DESCONOCIDO-TIT">DESCONOCIDO TIT</option>
								<option value="DESHABITADO">DESHABITADO</option>
								<option value="EXTRAVIADO">EXTRAVIADA</option>
								<option value="FALLECIO">FALLECIO</option>
								<option value="FALTAN-DATOS">FALTAN DATOS</option>
								<option value="RECONECTADO">RECONECTADO</option>
								<option value="ROBADO">ROBADO</option>
								<option value="ENTREGO-EN-SUCURSAL">ENTREGO EN SUCURSAL</option>
							</select>
						</div>

					<div class="componentes" id="componentes">
						<h5>¿Que accesorios tiene?</h5>
						<!-- cable hdmi / cable telefonico -->
						<div class="form-group" id="cont-accesorio-uno">
							<div class="check-estilo ">
								<div class="form-group">
									<label id="txtComponenteUno"><strong>Cable HDMI</strong></label>
									<div class="control radio">
										<input type="radio" class="control-input" name="accesorio-uno" id="si-entrega-accesorio-uno" value="si entrego">Si

										<input type="radio" class="control-input" name="accesorio-uno"
										id="no-entrega-accesorio-uno" value="no entrego">No
									</div>
								</div>

								<!--   cable AV / sim card -->
								<div class="form-group" id="cont-accesorio-dos">
									<label id="txtComponenteDos"><strong>Cable AV</strong></label>
									<div class="control radio">
										<input type="radio" id="si-entrega-accesorio-dos" class="control-input" name="accesorio-dos" value="si entrego">Si

										<input type="radio" id="no-entrega-accesorio-dos" class="control-input" name="accesorio-dos" value="no entrego">No
									</div>

								</div>

								<!-- cable FUENTE-->

								<div class="form-group" id="cont-accesorio-tres">
									<label id="txtComponenteTres"><strong>Fuente</strong></label>
									<div class="control radio">
										<input type="radio" class="control-input" name="accesorio-tres" id="si-entrega-accesorio-tres" value="si entrego">Si

										<input type="radio" class="control-input" name="accesorio-tres" id="no-entrega-accesorio-tres" value="no entrego">No
									</div>
								</div>

								<!-- CONTROL / base  -->


								<div class="form-group" id="cont-accesorio-cuatro">
									<label id="txtComponenteCuatro"><strong>Control</strong></label>
									<div class="control radio">
										<input type="radio" class="control-input" name="accesorio-cuatro" id="si-entrega-accesorio-cuatro" value="si entrego">Si

										<input type="radio" class="control-input" name="accesorio-cuatro" id="no-entrega-accesorio-cuatro" value="no entrego">No
									</div>
								</div>
							</div>
						</div>
					</div>
					<br>



					<div class="inputEnBase" id="inputEnBase">


						<div class="form-group" id="cont-accesorios-otros">
							<label><strong>Otros accesorios - <span style="color:#0093f5;" >Opcional - No obligatorio</span> </strong></label>

							<input style="background-color:#D6EAF8 ;border:0;" type="text" class="form-control" name="input-otrosaccesorios-en-base" id="input-otrosaccesorios-en-base" placeholder="Si tienes algun comentario, agregalo. 'No obligatorio' ">

						</div>

						<!-- MOTIVO DE RETIRO-->

						<div class="form-group" id="cont-motivo">
							<label><strong>Motivo de Retiro</strong></label>
							<select class="form-control" name="motivo-retiro-en-base" id="motivo-retiro-en-base">
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


						<div class="form-group" id="cont-terminal">

							<div class="contenedor-box-cosas">

								<div class="mini-box-cosas">
									<label><strong>Terminal</strong> </label>
								</div>

								<div class="mini-box-cosas">
									<span class="eleccion-terminal">
										No visible / No enciende
										<input class="control-input" id="noVisibleTerminal" type="checkbox">
									</span>
								</div>



							</div>

							<input style="background-color:#D6EAF8 ;border:0;" type="text" name="input-terminal-en-base" id="input-terminal-en-base" class="form-control" placeholder="Terminal" required readonly>
						</div>



						<div class="form-group" id="cont-serie-en-base">
							<label ><strong id="labelSerie">Serie / Verificar</strong></label>

							<input style="background-color:#D6EAF8 ;border:0;" type="text" name="input-serie-en-base" id="input-serie-en-base" class="form-control" placeholder="Ingresar nro">

						</div>

						<!-- opcion de chip -->
						<div class="form-group" id="cont-opcion-coincide-chip">
							<label id="label-coincide-chip">
								<strong>¿Coincide el Nro de Sim Card?</strong></label>
							<div class="chipopciones" id="chipopciones">
								<div class="opcionchip" id="nro_chip_si">si</div>
								<div class="opcionchip" id="nro_chip_no">no</div>
							</div>
						</div>
						<div id="cableRed"></div>
						<div class="form-group" id="cont-simCardEnBase">
							<label><strong id="labelSimcard">Sim Card</strong></label>
							
							<input style="background-color:#D6EAF8 ;border:0;" type="text" name="input-chip-base" id="input-chip-base" class="form-control" placeholder="Seleccione - NO - e ingrese Nro" readonly>
						</div>

						<!-- chip alternativo -->
						<div class="form-group" id="cont-chip-alt">
							<label>
								<strong>Ingrese nuevo Nro. Sim Card </strong>
							</label>
							<input style="background-color:#D6EAF8 ;border:0;" type="text" name="input-chip-alt" id="input-chip-alt" class="form-control" placeholder="Verifique e ingrese nuevo Nro. de chip">

						</div>

						<!-- serie base  -->
						<div class="form-group" id="cont-base-serie">
							<label><strong>Base Nro. Serie</strong></label>
							<input style="background-color:#D6EAF8 ;border:0;" type="text" name="input-base-serie" id="input-base-serie" class="form-control" placeholder="Ingrese la serie de la base">
						</div>
						<!-- id que toma para editar el equipo-->
						<div class="form-group" id="guia-id-local">
							<label for="">id local</label>
							<input type="hidden" name="id_cli" id="id_cli">
						</div>
						<!-- id orden INT -->
						<div class="form-group" id="guia-nro-orden">
							<label><strong>Nro Orden</strong></label>
							<input style="background-color:#D6EAF8 ;border:0;" type="hidden" id="edit_id_orden" name="edit_id_orden" class="form-control" readonly required>
						</div>

						<!-- id orden hash -->
						<div class="form-group" id="guia-nro-orden-pass">

							<input style="background-color:#D6EAF8 ;border:0;" type="hidden" id="edit_id_orden_pass" name="edit_id_orden_pass" class="form-control" required>
						</div>

						<!-- DATOS QUE USO Y ESCONDO -->

						<!-- user recolector -->
						<div class="form-group" id="guia-identificacion">

							<label for="">identificacion</label>
							<input type="hidden" id="edit_identificacion" name="edit_identificacion">
						</div>


						<!-- nombre cliente -->
						<div class="form-group" id="guia-nombre">
							<label for="">nombre cliente</label>
							<input type="hidden" id="nombre_cliente" name="nombre_cliente">
						</div>

						<div class="form-group" id="guia-recolector">
							<!-- user recolector -->
							<label for="">id recolector</label>
							<input type="hidden" id="recolector" name="recolector">


						</div>
					</div>


					<div class="modal-footer">

						<input type="button" id="salirModal" class="btn btn-danger" data-dismiss="modal" value="Salir">

						<input type="submit" class="btn bg-indigo text-white" id="confirmar" data-dismiss="modal" name="confirmar" value="Procesar equipo">


					</div>

				</div>
			</form>
		</div>
	</div>
</div>