 <!-- Modal -->
 <div class="modal fade " id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
     <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="exampleModalLabel">Guía instructiva</h5>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                 </button>
             </div>
             <div class="modal-body" id="modal-content-body">
                 <span class="badge badge-primary pointer-custom text-small-sm m-1" id="recuperar">Recuperar equipo</span>
                 <span class="badge badge-primary pointer-custom text-small-sm m-1" id="confirmar-transaccion">Confirmar transacción</span>
                 <span class="badge badge-primary pointer-custom text-small-sm m-1" id="enviar-remito">Enviar Remito</span>
                 <span class="badge badge-primary pointer-custom text-small-sm m-1" id="autorizar">Equipos para autorizar</span>
                 <span class="badge badge-primary pointer-custom text-small-sm m-1" id="negativo">Notificar negativo</span>

                 <span class="badge badge-danger pointer-custom text-small-sm m-1" id="salir">Salir de transacción</span>
                 <span class="badge badge-info pointer-custom text-small-sm m-1" id="aviso-de-visita">Aviso de visita en domicilio</span>
                 <span class="badge badge-info pointer-custom text-small-sm m-1" id="gestionar-avisos">Gestión de asignado con avisos </span>
                 <span class="badge badge-danger pointer-custom text-small-sm m-1" id="acceso">Ubicación denegada</span>
                 <span class="badge badge-danger pointer-custom text-small-sm m-1" id="importante">Importante</span>
                 <span class="badge badge-dark pointer-custom text-small-sm m-1" id="soporte">Soporte</span>
                 <div class="my-2 ">
                    
                     <div class="card"  id="recuperar-ancla">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item"><h5>Recuperar equipo</h5> </li>
                        </ul>
                    </div>

                    <p class="text-center"><button class="btn btn-danger my-3" > <a class="text-white"  href="https://www.youtube.com/watch?v=5HCpRC54po0" target="blank">Ver Video Recuperación de equipos con firma digital</a> </button></p>

                     <div class="my-2 d-flex justify-content-start flex-row align-items-center align-self-center align-content-center">
                         <span>1) Iniciar transacción</span>
                         <div class="ml-2 d-flex justify-content-center flex-column align-content-center align-items-center caja-box-circle-mini">
                             <div class=" circle-icon-small-mini btn">
                                 <img class="img-aviso-small-mini" src="<?= base_url ?>/estilos/imagenes/front/poder.png">
                             </div>
                         </div>
                     </div>

                     <div class="my-2 d-flex justify-content-start flex-row align-items-center align-self-center align-content-center">
                         <span>2) Completar cliente</span>
                         <input disabled type="text" class="ml-2 input-guia" placeholder="Complete cliente">
                         
                     </div>
                     <p><strong>Ingresar las dos iniciales</strong> de empresa + Numero de identificacion</p>
                         <p><strong>Ejemplo: </strong> ANTINA  ->  AN.234239592</p>
                         <p><strong>Tambien</strong> podes consultar por Nro. de Serie o Terminal <strong>Ejemplo: </strong> 548691518</p>

                     <span class="my-2">3) Clic en <i class="ml-2 buscador-guia fas fa-search"></i></span>

                     <p class="my-2">4) Seleccionar equipo <i class="seleccionar-guia far fa-hand-point-up"></i></p>
                     <p>5) Seleccionar tipo de gestión <strong>"RECUPERADO"</strong></p>
                     <p>6) Seleccionar accesorios que posee el equipo </p>
                     <p>7) Verificar Nro de serie y Terminal si requiere </p>
                     <p><strong>Nota: </strong>El equipo <strong>"RECUPERADO"</strong> debe coincidir el Nro de Serie o Terminal con los datos de nuestra Bases de datos</p>

                 <p>8) Clic en <button class="btn btn-sm bg-indigo-static text-white ">Procesar Equipo</button></p>
                 </div>

                 <div class="my-2 d-flex justify-content-start flex-row align-items-center align-self-center align-content-center">
                     <span>9) Clic en confirmar transacción </span>
                     <div class="ml-2 d-flex justify-content-center flex-column align-content-center align-items-center caja-box-circle-mini">
                             <div class=" circle-icon-small-mini btn">
                                 <img class="img-aviso-small-mini" src="<?= base_url ?>/estilos/imagenes/front/tick.png">
                             </div>
                      </div>

                 </div>


                 <div class="card my-3"  id="confirmar-ancla">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item"><h5>Confirmar Transacción</h5> </li>
                        </ul>
                </div>

                 <p>En esta sección veremos los equipos procesados, para ser confirmados, pudiendo eliminar <span style="color:blue;" class=" borrar-equipo fas fa-times-circle" ></span> equipos si hemos cometido un error, y volverlo a cargar en la transacción. </p>

                 
                 <div class="my-2 d-flex justify-content-start flex-row align-items-center align-self-center align-content-center">
                     <p>1) Clic en <button class="my-1 btn btn-sm btn-success text-white ">Confirmar<i class="far fa-check-circle"></i></button></p>
                     

                 </div>
                


                 <p><i class="fas fa-ellipsis-v"></i> Para determinadas empresas que <strong>SOLICITAN</strong>  firma digital <i class="far fa-edit"></i>, el cliente que nos entrega el equipo debera firmar de manera digital en el telefono del recolector cuando el sistema asi lo solicite.
                 <p class="ml-3"><strong>1) </strong> Clic en <button class="btn btn-sm bg-indigo-static text-white ">Procesar Firma <i class="far fa-file-alt"></i></button></p>
                 <p class="ml-3"> Hasta aqui el equipo ya ha <strong>sido cargado</strong> en el sistema de manera correcta. Procedemos a <strong> Enviar remito</strong> <i class="far fa-thumbs-up"></i></p>
                 </p>
                 <p><i class="fas fa-ellipsis-v"></i> En el caso de <strong>NO SOLICITAR </strong>firma digital <i class="far fa-edit"></i>
               
                 <p class="text-center"><button class="btn btn-danger my-3" > <a class="text-white" href="https://www.youtube.com/watch?v=xEY2Qre1jyk" target="blank">Ver Video Recuperación de equipos sin firma digital</a> </button></p>

                 <p class="ml-3"> Procedemos al Envio de Remito <i class="far fa-file-alt"></i></p>
                 </p>


                <div class="card my-3"  id="enviar-remito-ancla">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item"><h5>Enviar Remito</h5> </li>
                        </ul>
                </div>
                
                 <p>1) Ingresar cuidadosamente el Email  <i class="far fa-envelope"></i> o Nro de Whatsapp <i style="color:#46d08f;" class=" fab fa-whatsapp"></i></p>
                 <p>2) Clic en la opción elegida</p>
                 <p>4) Si se ha enviado con exito, podemos hacer Clic en <button style="background:#dc3545;" class="my-2 btn btn-sm text-white ">Finalizar transacción  <i class="fas fa-sign-out-alt"></i></button> y seguir gestionando mas equipos</p>
                 <p> Has finalizado una transacción correctamente <i class="far fa-thumbs-up"></i></p>

                <div class="card my-3"  id="autorizar-ancla">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item"><h5>Equipos para Autorizar</h5> </li>
                        </ul>
                </div>

                <p class="text-center"><button class="btn btn-danger my-3" > <a class="text-white" href="https://www.youtube.com/watch?v=d2BvkMNpVeg" target="blank">Ver Video Equipos para Autorizar</a> </button></p>

                 <p>¿Que es un equipo para <strong>AUTORIZAR</strong>?</p>
                 <p>Cuando estamos recuperando equipos, es posible que el cliente tenga para devolver mas equipos de los que hay en la base de datos (Su Nro. de Serie o Terminal no coinciden con la informacion de la base de datos). Estos equipos tenemos la posibilidad de recuperarlos cargandolos como equipos a Autorizar, es decir: Este equipo al recuperarlo se pagara <strong>UNICAMENTE</strong> en caso de que la empresa dueña de este, autorice el equipo.</p>

                 <div class="my-2 d-flex justify-content-start flex-row align-items-center align-self-center align-content-center">
                     <span>1) Clic en Equipos Autorizar </span>
                     <div class="ml-2 d-flex justify-content-center flex-column align-content-center align-items-center caja-box-circle-mini">
                             <div class=" circle-icon-small-mini btn">
                                 <img class="img-aviso-small-mini" src="<?= base_url ?>/estilos/imagenes/front/add.png">
                             </div>
                      </div>
                 </div>

                 <p>2) En caso de que se nos solicite la posible ubicación, seleccionamos la ubicación <button  class="my-2 btn btn-sm btn-warning">Escoger</button> </p>
                 <p>3) Seleccionamos los accesorios del equipo </p>
                 <p>4) Ingresamos el Nro. de Serie o Terminal (Como lo requiera la empresa)</p>


                 <p>5) Clic en Procesar Equipo <button class="btn btn-sm bg-indigo-static text-white ">Procesar Equipo</button></p>


                 <div class="my-2 d-flex justify-content-start flex-row align-items-center align-self-center align-content-center">
                     <span>6) El equipo sera agregado a la transacción, pudiendo quedar en la misma transacción que un equipo "RECUPERADO" que esté en nuestra base de datos. Y seguimos los pasos de la sección. <a class="pointer-custom" id="confirmar-up"> <strong >Confirmar Transacción</strong> </a> </span>
                     <div class="ml-2 d-flex justify-content-center flex-column align-content-center align-items-center caja-box-circle-mini">
                             <div class=" circle-icon-small-mini btn">
                                 <img class="img-aviso-small-mini" src="<?= base_url ?>/estilos/imagenes/front/tick.png">
                             </div>
                      </div>

                 </div>

                <div class="card my-3"  id="negativo-ancla">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item"><h5>Notificar negativos</h5> </li>
                        </ul>
                </div>

                <p class="text-center"><button class="btn btn-danger my-3" > <a class="text-white" href="https://www.youtube.com/watch?v=difTt2osoeY" target="blank">Ver Video Notificar negativos</a> </button></p>

                 <p>Al gestionar equipos puede suceder que no haya sido posible la recuperacion del mismo, por motivos varios:</p>
                 <p>Esto es <strong>MUY IMPORTANTE!</strong> ya que tomamos diferentes medidas para cada equipo no recuperado, para poder llegar al <strong>RECUPERO</strong></p>
                 <p>Estos motivos podremos seleccionarlos en <strong> Tipo de gestión :</strong></p>
                 <p><strong>RECHAZADA : </strong>El cliente no tiene la disposición de entregar el equipo </p>
                 <p><strong>EN USO : </strong>El cliente este haciendo uso del equipo </p>
                 <p><strong>NO TUVO EQUIPO : </strong>El cliente no posee el equipo al momento de la recuperación </p>
                 <p><strong>NO EXISTE NUMERO : </strong>No existe la numeración del domicilio </p>
                 <p><strong>NO RESPONDE : </strong>Al llegar al domicilio del cliente no logramos tener contacto con el</p>
                 <p><strong>TIEMPO LIMITE ESPERA : </strong>El recolector puede esperar maximo 5 - 10 minutos al cliente en domicilio</p>
                 <p><strong>SE MUDO : </strong>El cliente se mudo de su domicilio</p>
                 <p><strong>YA RETIRADO : </strong>El equipo ya fue retirado por otra empresa </p>
                 <p><strong>ZONA PELIGROSA : </strong>La zona de recuperacion es peligrosa </p>
                 <p><strong>TEL EQUIVOCADO: </strong>El Nro de Telefono pertenece a otra persona</p>
                 <p><strong>NO COINCIDE SERIE: </strong>El Nro de Serie no coincide</p>
                 <p>Cuando no coincida la serie tenemos dos opciones</p>

                 <div class="ml-2 my-2 d-flex justify-content-start flex-row align-items-center align-self-center align-content-center">
                     <p>1) Cuando no coincida la Serie o Terminal del equipo podemos cargarlo como equipo a Autorizar. <br><strong> Nota: </strong>Equipos de empresa Lapos solo se pueden retirar unicamente equipos de Tecnologia Activa. Para ver los modelos =>  Menú <i class="fas fa-bars"></i> <strong>Modelos</strong></p>
                     
                     <div class="ml-2 d-flex justify-content-center flex-column align-content-center align-items-center caja-box-circle-mini">
                             <div class=" circle-icon-small-mini btn">
                                 <img class="img-aviso-small-mini" src="<?= base_url ?>/estilos/imagenes/front/add.png">
                             </div>
                      </div>
                 </div>

                 <p class="text-center"><button class="btn btn-danger my-3" > <a class="text-white" href="https://www.youtube.com/watch?v=IRKrZ4uRR7A" target="blank">Ver Video Modelos vigentes</a> </button></p>

                 
                
                 <p class="ml-2">2) Notificar como negativo por que la empresa no admite equipos a <strong>AUTORIZAR</strong> o el equipo en su modelo es absoleto</p>
                 <p><strong>DESCONOCIDO TIT: </strong>No se conoce al titular</p>
                 <p><strong>DESHABITADO: </strong>El lugar esta deshabitado</p>
                 <p><strong>EXTRAVIADO: </strong>El equipo ha sido extraviado</p>
                 <p><strong>FALLECIO: </strong>El titular del equipo falleció</p>
                 <p><strong>FALTAN DATOS: </strong>Información escasa para la visita en domicilio</p>
                 <p><strong>RECONECTADO: </strong>El equipo ha sido reconectado</p>
                 <p><strong>ROBADO: </strong>El equipo ha sido robado</p>
                 <p><strong>ENTREGO EN SUCURSAL: </strong>El equipo ha sido entregado en sucursal</p>
                 <p><strong>Nota :</strong> En una transacción al cargar solo negativos, no sera necesario el envio de remito. La transacción finalizara automaticamente</p>

                
                <div class="card my-3"  id="salir-ancla">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item"><h5>Salir de transacción</h5> </li>
                        </ul>
                </div>

    
                 <div class="ml-2 my-2 d-flex justify-content-start flex-row align-items-center align-self-center align-content-center">
                     <span><strong>Caso 1) </strong> Al hacer clic en <strong>salir de transacción</strong>, forzaremos el cierre de la transacción actual, aún si esta no ha sido confirmada correctamente.</span>
                     <div class="ml-2 d-flex justify-content-center flex-column align-content-center align-items-center caja-box-circle-mini">
                             <div class=" circle-icon-small-mini btn">
                                 <img class="img-aviso-small-mini" src="<?= base_url ?>/estilos/imagenes/front/close.png">
                             </div>
                      </div>
                 </div>

                 <div class="ml-2 my-2 d-flex justify-content-start flex-row align-items-center align-self-center align-content-center">
                     <span><strong>Caso 2) </strong> Se ha concretado una transacción correctamente y necesitas : Gestionar mas equipos.
                     <br>Clic en <strong>Finalizar transacción</strong> </span>
                     <div class="ml-2 d-flex justify-content-center flex-column align-content-center align-items-center caja-box-circle-mini">
                             <div class=" circle-icon-small-mini btn">
                                 <img class="img-aviso-small-mini" src="<?= base_url ?>/estilos/imagenes/front/close.png">
                             </div>
                      </div>
                 </div>

                 
                <div class="card my-3"  id="aviso-de-visita-ancla">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item"><h5>Aviso de visita en domicilio</h5> </li>
                        </ul>
                </div>

                <p class="text-center"><button class="btn btn-danger my-3" > <a class="text-white" href="https://www.youtube.com/watch?v=difTt2osoeY" target="blank">Ver Video Aviso de visita</a> </button></p>

                 <p>El aviso de visita es <strong>obligatorio</strong> cuando : Al visitar el domicilio del cliente no hayamos tenido contacto con este</p>
                
                 <p class="text-white"> <strong> Gestión de asignado con avisos </strong></p>
                 <div class="my-2 d-flex justify-content-start flex-row align-items-center align-self-center align-content-center">
                         <span>1) Completar cliente</span>
                         <input disabled type="text" class="ml-2 input-guia" placeholder="Complete cliente">
                     </div>

                 <div class="my-2 d-flex justify-content-start flex-row align-items-center align-self-center align-content-center">
                     <span>2) Clic en Aviso de visita</span>
                     <div class="ml-2 d-flex justify-content-center flex-column align-content-center align-items-center caja-box-circle-mini">
                             <div class=" circle-icon-small-mini btn">
                                 <img class="img-aviso-small-mini" src="<?= base_url ?>/estilos/imagenes/front/visitante.png">
                             </div>
                      </div>
                 </div>
 
                 <p>3) Seleccionar opción por la cual se le enviara el aviso de visita <i style="color:#46d08f;" class=" fab fa-whatsapp"></i> <i style="color:#f74e4e;" class="far fa-envelope"></i> </p>

                 <p>Este aviso de visita es independiente y diferente a :</p>


                 <div class="card my-3"  id="gestionar-avisos-ancla">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item"><h5>Gestión de asignado con avisos </h5> </li>
                        </ul>
                </div>

                <p class="text-center"><button class="btn btn-danger my-3" > <a class="text-white" href="https://www.youtube.com/watch?v=tB4QElOob0k" target="blank">Ver Video Gestión de asignado con avisos</a> </button></p>

                <p>En esta sección podras gestionar las bases asignadas a cada recolector</p>
                <p>Te <strong> ahorrara tiempo y recursos</strong>, porque estaras en contacto con el cliente que estas por visitar, asegurando que tu visita sea <strong>segura y eficaz.</strong></p>
                <p> <i class="fas fa-calendar-day"></i> Podras notificarle de manera automática que lo vistaras el dia siguiente</p> 
                <p><i class="fas fa-route"></i> Podras notificarle en el día, mientras estas en calle que proximamente estaras visitándolo</p>
                <p>Para acceder a esta sección debes abrir el Menú </p>
                <p>Menú <i class="fas fa-bars"></i> Gestión de avisos</p>

                <div class="card my-3"  id="acceso-ancla">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item"><h5>Ubicación denegada</h5> </li>
                        </ul>
                </div>

                <p class="text-center"><button class="btn btn-danger my-3" > <a class="text-white" href="https://www.youtube.com/watch?v=voltMQV_qCY" target="blank">Ver Video Ubicación denegada (Solución)</a> </button></p>


                <p>Cuando aparezca este mensaje es porque debemos permitirle a la web visualizar la ubicación al momento de gestionar.</p>
                <p><strong> Solución : </strong></p>
                <p><strong>1)</strong> Ingresá en tu <strong>navegador Chrome/Firefox/Explorer :</strong></p>
                <p><strong>2)</strong> Ubicada en la parte superior derecha <i class="fas fa-ellipsis-v"></i>  Clic en Configuración</p>
                <p><strong>3)</strong> Configuración avazanda ó Configuración de sitios/web</p>
                <p><strong>4)</strong> Ubicación</p>
                <p><strong>5)</strong> Bloqueados ( Si devuelvoya.com esta en esta lista de bloqueados, clic en Permitir) y vuelve a cargar la web</p>
                

                 <div class="card my-3"  id="importante-ancla">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item"><h5>Importante</h5> </li>
                        </ul>
                </div>

            <p><strong>- No</strong> se debe gestionar a dos clientes en una misma transacción, deberan salir de la transacción e iniciar una nuevamente</p>
            <p>- Cuando no coincida el Nro. de Serie o Terminal el equipo debera cargarse como <strong>Autorizar</strong> si el modelo esta vigente para su recuperación</p>
            <p>- El aviso de visita solo se puede enviar a un cliente por transacción, deberan salir de la transacción e iniciar una nuevamente</p>
            <p>- Solo se permite un equipo con la misma serie o terminal por transaccion. Es decir, no se pueden recuperar dos equipos de igual serie o terminal en la misma transacción</p>
            <p>- Los pagos son quincenal <strong>(Sin excepcion)</strong>, se acreditara a la cuenta CBU del contrato firmado junto al previo envio de la factura por el total del importe </p>
            
            <div class="card my-3"  id="soporte-ancla">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item"><h5>Soporte</h5> </li>
                        </ul>
            </div>
            
            
            <p><strong>Para soporte</strong> Comunicarse a : <strong>sistemas@postalmarketing.com.ar </strong>Enviandonos tu Nro De Documento y especificando las dudas que tengas. Te responderemos a la brevedad <i class="far fa-thumbs-up"></i></p></p>



             </div>
            

             


             <div class="modal-footer">
                 <button type="button" class="btn btn-secondary" id="subir">Subir</button>
                 <button type="button" class="btn btn-primary" data-dismiss="modal">Ok</button>
             </div>
         </div>
     </div>
 </div>
 <script>
     document.getElementById('recuperar').addEventListener('click', function() {
         $('#modal-content-body').animate({
             scrollTop: $('#recuperar-ancla').offset().top - 80
         }, 500);
     })

     document.getElementById('confirmar-transaccion').addEventListener('click', function() {
         $('#modal-content-body').animate({
             scrollTop: $('#confirmar-ancla').offset().top - 80
         }, 500);
     })

     document.getElementById('enviar-remito').addEventListener('click', function() {
         $('#modal-content-body').animate({
             scrollTop: $('#enviar-remito-ancla').offset().top - 80
         }, 500);
     })

     document.getElementById('autorizar').addEventListener('click', function() {
         $('#modal-content-body').animate({
             scrollTop: $('#autorizar-ancla').offset().top - 80
         }, 500);
     })

     document.getElementById('negativo').addEventListener('click', function() {
         $('#modal-content-body').animate({
             scrollTop: $('#negativo-ancla').offset().top - 80
         }, 500);
     })

     document.getElementById('salir').addEventListener('click', function() {
         $('#modal-content-body').animate({
             scrollTop: $('#salir-ancla').offset().top - 80
         }, 500);
     })

     document.getElementById('aviso-de-visita').addEventListener('click', function() {
         $('#modal-content-body').animate({
             scrollTop: $('#aviso-de-visita-ancla').offset().top - 80
         }, 500);
     })

     document.getElementById('subir').addEventListener('click', function() {
         $('#modal-content-body').animate({
             scrollTop: $('#modal-content-body').offset().top - 80
         }, 500);
     })

     document.getElementById('confirmar-up').addEventListener('click', function() {
        var currScroll = $('#modal-content-body').scrollTop();
         $('#modal-content-body').animate({
             scrollTop: $('#confirmar-ancla').offset().top - 80 + currScroll
         }, 500);
    })

    document.getElementById('importante').addEventListener('click', function() {
    $('#modal-content-body').animate({
        scrollTop: $('#importante-ancla').offset().top - 80
    }, 500);
    })

    document.getElementById('gestionar-avisos').addEventListener('click', function() {
    $('#modal-content-body').animate({
        scrollTop: $('#gestionar-avisos-ancla').offset().top - 80
    }, 500);
    })

    document.getElementById('soporte').addEventListener('click', function() {
    $('#modal-content-body').animate({
        scrollTop: $('#soporte-ancla').offset().top - 80
    }, 500);
    })

    document.getElementById('acceso').addEventListener('click', function() {
    $('#modal-content-body').animate({
        scrollTop: $('#acceso-ancla').offset().top - 80
    }, 500);
    })

    


 </script>