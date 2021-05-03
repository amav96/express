<?php require_once 'views/layout/header.php'; ?>

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



<?php

if(isset($_SESSION["user"]) && $_SESSION["user"]->type ='registered' || $_SESSION["user"]->type ='signed_contract' || $_SESSION["user"]->type ='sign_contract'){ ?>

<div class="stand-user">
    <h4 class="text-center" > ¡Hola! <?=$_SESSION["user"]->name.' '.$_SESSION["user"]->surname?>  </h4>
    <h5 class="text-center" > Tu solicitud esta en proceso de revisión  <div class="spinner-border text-primary" role="status">
 
</div></h5>
    <img  style="width:10rem; height:10rem;" src="<?=base_url?>estilos/imagenes/logo.png" alt="">
    </div>
<?php } ?>

<?php require_once 'views/layout/footer.php'; ?>