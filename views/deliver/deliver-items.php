<?php include("../includes/gestion/cabecera.php"); ?>
<link rel="stylesheet" href="../../estilos/personal/css/deliver/recursos_deliver.css">

<style>
    #buscaCliente {
        display: none;
    }
</style>


<div class="container-artisan">
    <div class="main-director" id="main-director">
        <div class="container-buscador-cliente" id="buscaCliente">
            <div class="box-buscador-cliente">
                <input type="text" id="identificacionIngresada" placeholder="Ingrese identificacion">
                <button id="buscarCliente" class="buscarCliente">Empezar</button>
            </div>
        </div>


        <div class="container-titulo" id="container-titulo">
            <div class="box-titulo" id="box-titulo">

            </div>
        </div>

        <div class="container-opciones" id="container-opciones">
        </div>
        <div class="table-responsive" id="tabladatos">
            <div class="container-titulo-tabla">
                <span>Equipos a devolver</span>
            </div>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Serie</th>
                        <th scope="col">Equipo</th>
                        <th scope="col">Dirección</th>
                        <th scope="col">Tarjeta</th>
                        <th scope="col">Localidad</th>
                        <th scope="col">Provincia</th>
                        <th scope="col">Codigo postal</th>


                    </tr>
                </thead>
                <tbody id="tbody">
                    <!-- <tr>
                <th scope="row">1</th>
                <td>Mark</td>
                
              </tr> -->

                </tbody>
            </table>
        </div>

        <div class="container-boton-entregar">
            <div class="box-boton-entregar">
                <button class="boton-entregar" id="boton-entregar">Entregar</button>
            </div>
        </div>

        <div class="container-artisan">




            <div class="container-box-recolector" id="container-box-recolector">

                <div class="sub-box-auto">
                    <div class="box-auto">
                        <div class="box-info">


                            <span>Un Recolecotor pasara por tu domicilio</span>

                        </div>
                        <div class="box-info">


                            <span>Que hora prefieres?</span>
                            <select name="horario_rec" id="horario_rec">
                                <option value="8:00 am - 10:00 am">8:00 am - 10:00 am</option>
                                <option value="10:00 am - 12:00 am">10:00 am - 12:00 am</option>
                                <option value="12:00 am - 14:00 am">12:00 am - 14:00 am</option>
                                <option value="14:00 am - 16:00 am">14:00 am - 16:00 am</option>
                                <option value="16:00 am - 18:00 am">16:00 am - 18:00 am</option>
                                <option value="9:00 am - 11:00 am">9:00 am - 11:00 am</option>
                                <option value="11:00 am - 13:00 am">11:00 am - 13:00 am</option>
                                <option value="13:00 am - 15:00 am">13:00 am - 15:00 am</option>
                                <option value="15:00 am - 17:00 am">15:00 am - 17:00 am</option>
                                <option value="17:00 am - 18:00 am">17:00 am - 18:00 am</option>
                            </select>
                        </div>
                        <div class="box-info">
                            <span>Que dia prefieres?</span>
                            <select name="dia_rec" id="dia_rec">
                                <option value="Lunes">Lunes</option>
                                <option value="Martes">Martes</option>
                                <option value="Miercoles">Miercoles</option>
                                <option value="Jueves">Jueves</option>
                                <option value="Viernes">Viernes</option>
                                <option value="Sabado">Sabado</option>
                                <option value="Domingo">Domingo</option>
                            </select>

                        </div>
                        <div class="box-info">
                            <span>¿Cuantos equipos entregaras?</span>
                            <input type="text" id="cantidadEquipos" placeholder="Ingrese cantidad de equipos">
                        </div>
                        <div class="box-info">
                            <div class="optimizo">
                                <span>Un numero de contacto </span>
                                <select name="caracteristicaContacto" id="caracteristicaContacto">
                                    <option value="+54">+54</option>
                                    <option value="+598">+598</option>
                                </select>
                                <input id="numeroContacto" type="text" placeholder="ingrese numero">

                            </div>
                        </div>
                        <div class="box-info">
                            <div class="optimizo">
                                <style>
                                    #domiContacto {
                                        display: none;
                                    }
                                </style>
                                <span>Si tienes otro domicilio.</span>
                                <span id="abrirdomicilio">Indicanos!</span>

                                <input type="text" id="domiContacto" placeholder="Domicilio alternativo">
                            </div>
                        </div>
                        <div class="box-info">
                            <div class="optimizo">
                                <span>Confirmanos tu email.</span>
                            </div>
                            <input type="text" id="emailalternativo" placeholder="Email para contactarte">
                        </div>
                        <div class="box-info">
                            <button id="enviarinfo">Enviar </button>
                        </div>
                        <div class="spinner-border" role="status" id="procesando">
                            <span class="sr-only">Loading...</span>
                        </div>
                        <div class="box-info">
                            <div class="boton-descargar" id="boton-descargar">
                                <div id="DescargarAviso"> Descargar </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <style>
                #procesando {
                    display: none;
                }

                #DescargarAviso {
                    display: none;
                }
            </style>

            <div class="container-correo-argentino" id="container-correo-argentino">
                <div class="sub-box-correo">
                    <div class="box-correo">
                        <div class="item-correo">
                            <span>Gratuitamente con este cupón podes devolver el quipo</span>
                            <div id="descargar"> Descargar cupón</div>
                        </div>
                        <div class="item-correo">
                            <a href="https://www.correoargentino.com.ar/formularios/sucursales" target="_blank">Buscar
                                sucursal cercana a mi domicilio</a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<style>
    #mensaje-exito-pactado {
        display: none;
    }
</style>
<div class="container-artisan">
    <div class="mensaje-exito-pactado" id="mensaje-exito-pactado">
        <div class="sub-exito">
            <div class="box-exito">
                <span>Ha sido un exito! bla bla </span>
            </div>
        </div>
    </div>
</div>
<div class="" id="modalRel">
</div>
<div class="" id="body-rel">
</div>
<?php include("../includes/gestion/pie.php"); ?>

<script src="../../estilos/personal/js/jquery.js"></script>
<script src="../../assets/deliver/deliver-item.js"></script>



</body>

</html>