<?php require_once 'views/layout/headerRecolector.php'; ?>

<script src="<?= base_url ?>estilos/personal/js/jquery.min.js"></script>
<script src="<?= base_url ?>estilos/personal/js/bootstrap.min.js"></script>

<link rel="stylesheet" href="<?= base_url ?>estilos/personal/fontawesome/css/all.css">

<link rel="stylesheet" href="<?= base_url ?>estilos/personal/css/bootstrap/bootstrap.min.css">
<link rel="stylesheet" href="<?= base_url ?>estilos/personal/css/panel_recolector/credencial.css">


<div class="container">



    <div class="soli-credencial">

        <input value="<?= $_SESSION["username"]->id ?> " class="form-group" id="usuario-credencial" type="hidden">
        <br>
        <button style="font-size:16px;" id="getcre" class="btn btn-info">Obtener credencial</button>

    </div>

    <div class="credencial-contenedor">
    </div>

    <div class="credencial-contenedor-post">
    </div>
    </div>
    
   

<?php require_once 'views/layout/footerRecolector.php'; ?>