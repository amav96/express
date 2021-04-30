<?php require_once 'views/layout/headerLanding.php'; ?>
<link rel="stylesheet" href="<?=base_url?>estilos/personal/css/reclute/recursos_recolector.css">
   
<style>
    .stand-user{
        display: flex;
        justify-content: center;
        align-items: center;
        align-content: center;
        flex-direction: column;
        margin:6rem auto;
    }
</style>


   <div class="stand-user">
    <h4 class="text-center" > Bienvenid@! <?=$_SESSION["username"]->name?>  </h4>
    <h6 class="text-center" > Toda la comunicación y novedades sobre tu postulación la enviaremos a <?=$_SESSION["username"]->email?> </h6>
    <img  style="width:10rem; height:10rem;" src="<?=base_url?>estilos/imagenes/logo.png" alt="">
    </div>

<?php
Utils::deleteSession('username');
Utils::deleteSession('register');
?>
<script>

localStorage.removeItem('tipo');
localStorage.removeItem('form');

</script> 

<?php require_once 'views/layout/footerLanding.php'; ?>

    
    
