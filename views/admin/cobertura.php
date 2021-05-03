<?php require_once 'views/layout/headerAdmin.php'; ?>
<link rel="stylesheet" href="<?= base_url ?>estilos/personal/css/admin/asignado.css">


<div class="container d-flex justify-content-center flex-column ">


    <div class="d-flex justify-content-center shadow borderRadius
padding6 flex-column">
        <h6 class="text-center">Buscar por rango de codigos postales</h6>

        <form id="form_search_range">
            <div class="row d-flex justify-content-center flex-row">
                <div class="m-2">
                    <div class="input-group-prepend">
                        <div class="input-group-text"><i class="far fa-compass"></i></div>
                        <input type="number" id="code_start" class="form-control" placeholder="Desde Codigo Postal" required>
                    </div>

                </div>
                <div class="m-2">
                    <div class="input-group-prepend">
                        <div class="input-group-text"><i class="far fa-compass"></i></div>
                        <input type="number" id="code_finish" class="form-control" placeholder="Desde Codigo Postal" required>
                    </div>
                </div>

                <div class="m-2">
                    <div class="input-group-prepend">
                        <div class="input-group-text"> <i class="far fa-flag"></i></div>
                        <select id="country" class="form-control">
                            <option value="0">Seleccione País</option>
                            <option value="1">Argentina</option>
                            <option value="2">Uruguay</option>
                        </select>
                    </div>
                </div>
                <div class="m-2">
                    <button type="submit" id="searchRangeCode" class="btn btn-info">
                        <span class="spinner-border hiddenLoader loaderBtn" role="status"></span><span class="txtRangeCode">Buscar</span> <i class="fas fa-search"></i></button>
                </div>
            </div>
        </form>
    </div>


    <div class="d-flex justify-content-center content-botton">

        <div class="row m-2 d-flex justify-content-center">
            <button id="AllAssigned" class="btn btn-primary m-2 "> <span class="spinner-border hiddenLoader loaderBtn" role="status"></span> <span class="txtAllAssigned"> Mostrar área de cobertura</span> <i class="fas fa-globe"></i></button>
            <button id="updateRange" class="btn btn-warning m-2"> Actualizar por Rango <i class="fas fa-edit"></i></button>
            <button id="create" class="btn  btn-success m-2"> Crear nuevo <i class="fas fa-plus"></i></button>
            <button id="history" class="btn  btn-danger m-2"><span class="spinner-border hiddenLoader loaderBtn" role="status"></span> <span class="txtHistory"> Histórico Inactivo</span>   <i class="far fa-trash-alt"></i></button>
            <!-- <button id="createRange" class="btn btn-success m-2"> Crear nuevo por Rango <i class="fas fa-plus"></i></button> -->
        </div>

    </div>

    
        <div  id="title-table" >
        
        </div>
    

    
    <div class="d-flex justify-content-center">
        <div class="table-responsive">
            <div id="contentTable">
            </div>
        </div>
    </div>

</div>

<?php require_once 'views/layout/footerAdmin.php'; ?>
<script src="<?= base_url ?>assets/admin/asignacion/main.js?v=16032021"></script>
<script src="<?= base_url ?>assets/admin/asignacion/updatedRange.js?v=16032021"></script>
<script src="<?= base_url ?>assets/admin/asignacion/update.js?v=16032021"></script>
<script src="<?= base_url ?>assets/admin/asignacion/create.js?v=16032021"></script>
<script src="<?= base_url ?>assets/admin/asignacion/delete.js?v=16032021"></script>
<script src="<?= base_url ?>assets/admin/asignacion/geocoding.js?v=16032021"></script>


