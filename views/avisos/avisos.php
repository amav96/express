
<?php require_once 'views/layout/headerRecolector.php'; ?>



<div id="gestion-avisos" class="container  d-flex justify-content-center align-self-center  flex-column ">

<div id="guia" class="d-flex justify-content-center mb-5">
    <div>
        <boton-guia></boton-guia>
    </div>
       
</div>
     
    <div class="row justify-content-center">
        <div class="col-8 bg-indigo-static r-rounded-bg shadowCustom text-white py-2 px-4 text-center d-flex flex-column justify-content-center align-content-center align-items-center">
            <span class="mb-1 text-medium"> <strong>Gestiónar asignado</strong> </span>
            <img class=" img-gestion-visita" src="<?=base_url?>estilos/imagenes/front/edc.png" alt="">
        </div>
    </div> 
       
     <input-buscar></input-buscar>
     <tipo-avisos ></tipo-avisos>
</div>


<?php require_once 'views/layout/footerRecolector.php'; ?>