<?php require_once 'views/layout/headerReclute.php'; ?>

<style>

    .stand-user{
        display: flex;
        justify-content: center;
        align-items: center;
        align-content: center;
        flex-direction: column;
        margin:6rem auto ;
    }
</style>




<div class="stand-user">
    <h4 class="text-center" > ¡Bienvenido! <?=$_SESSION["username"]->name?>  </h4>
    <h5 class="text-center" > Tu solicitud esta en proceso de revisión <div class="spinner-border text-primary" role="status"></div></h5>
    <h6 class="text-center" > Pronto te estaremos dando de alta <?=$_SESSION["username"]->email?> </h6>
    <img  style="width:10rem; height:10rem;" src="<?=base_url?>estilos/imagenes/logo.png" alt="">
    </div>

    <script>
setTimeout(function(){ 
            location.href = base_url+'usuario/logOut';
          }, 4000);
    </script>


<?php require_once 'views/layout/footerReclute.php'; ?>