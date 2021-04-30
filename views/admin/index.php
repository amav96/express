<?php require_once 'views/layout/headerAdmin.php'; ?>
<style>
    .btn-gestion {
        margin: 0.5rem auto;
    }
</style>

<main class="panel" id="panel">
    <div class="container-selecciona-busqueda">
        <div class="box-consulta" id="BuscadorGeneral">
            <span>Clientes</span>
        </div>
        <div class="box-consulta" id="BuscadorTransito">
            <span>Gestión</span>
        </div>
        <div class="box-consulta" id="BuscadorRecoFecha">
            <span>Recolector por Fecha</span>
        </div>
        <div class="box-consulta" id="BuscadorRangoFecha">
            <span>Reporte por Fecha</span>
        </div>
        <div class="box-consulta" id="BuscadorRangoRecolectores">
            <span>Recolector gestión</span>
        </div>
        <!-- <div class="box-consulta" id="BuscadorRecuperados">
            <span>Recuperados</span>
        </div> -->
    </div>
    <div class="container-busqueda-general" id="container-busqueda-general">
        <div class="box-busquedageneral">
            <div class="mini-box">
                <form id="form-iden">
                    <div class="form-input">
                        <div style="margin:0 2rem;" class="linea-buscadora">
                            <input type="text" class="input-general" id="datoBuscar" placeholder="Buscar en base" required>
                            <button type="submit"><i class="busca fas fa-search"></i></button>
                        </div>

                    </div>
                </form>

            </div>
            <div style="margin:0 4rem;" class="mini-box">
                <button id="agregarCliente"><i class="busca fas fa-user-plus"></i></button>
            </div>
        </div>
    </div>

    <div class="container-busqueda-transito" id="container-busqueda-transito">
        <div class="box-busquedageneral">
            <div class="mini-box">
                <form id="form-transito">
                    <div class="form-input">
                        <div class="linea-buscadora">
                            <input type="text" class="input-general" id="datoBuscarTransito" placeholder="Buscar en gestión" required>
                            <button type="submit"><i class="busca fas fa-search"></i></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <div class="container-busqueda-reco-fecha" id="container-busqueda-reco-fecha">
        <div class="box-busquedageneral">
            <div class="mini-box">
                <form id="form-reco-fecha">
                    <div class="form-input">
                        <label for="">Recolector</label>
                        <select class="input-general" id="recolector" placeholder="Recolector" required>
                        </select>
                    </div>
                    <div class="form-input">
                        <label for="">Desde</label>
                        <input type="date" class="input-general" id="recoFechaUno" placeholder="Buscar" required>
                    </div>
                    <div class="form-input">
                        <label for="">Hasta</label>

                        <input type="date" class="input-general" id="recoFechaDos" placeholder="Buscar" required>

                        <button type="submit"><i class="busca fas fa-search"></i></button>

                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="container-negativos" id="container-negativos">
        <div class="box-busquedageneral">
            <div class="mini-box">
                <form id="form-negativos">

                    <div class="form-input">
                        <label for="">Desde</label>
                        <input type="date" class="input-general" id="FechaUno-reporte" placeholder="Buscar" required>
                    </div>
                    <div class="form-input">
                        <label for="">Hasta</label>
                        <input type="date" class="input-general" id="FechaDos-reporte" placeholder="Buscar" required>

                        <button type="submit"><i class="busca fas fa-search"></i></button>

                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="container-detalle-recolector" id="container-detalle-recolector">
        <div class="box-busquedageneral">
            <div class="mini-box">
                <form id="form-detalle-recolectores">

                    <div class="form-input">
                        <label for="">Desde</label>
                        <input type="date" class="input-general" id="fechaUno-reco" placeholder="Buscar" required>
                    </div>
                    <div class="form-input">
                        <label for="">Hasta</label>
                        <input type="date" class="input-general" id="fechaDos-reco" placeholder="Buscar" required>

                        <button type="submit"><i class="busca fas fa-truck"></i></button>

                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="spinner-border" role="status" id="procesando">
        <span class="sr-only">Loading...</span>
    </div>
    <div class="container-mensaje-error" id="container-mensaje-error">
        <div class="box-mensaje-error">
            <p class="texto-mensaje">No existen registros con estos datos</p>
        </div>
    </div>

    <br>
    <div style="display:flex;justify-content:center;" id="cargando">

    </div>

    <div id="detalle" class="detalle">
    </div>
    <div class="cont-informe" id="cont-informe">
        <div id="btn-informe">

        </div>
        <div id="more">

        </div>
    </div>

    <div id="data">

    </div>

    <!-- html +='<div class="table-responsive">'; -->


</main>



<?php require_once 'views/layout/footerAdmin.php'; ?>