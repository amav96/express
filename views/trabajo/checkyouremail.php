<?php
if(!isset($_SESSION["username"])){
    header("Location:".base_url);
}else if (isset($_SESSION["username"])){
  if($_SESSION["username"]->status_process==='registered'){
    header("Location:".base_url);
  }else if($_SESSION["username"]->status_process==='first'){
          require_once 'views/layout/header.php'; ?>

<link rel="stylesheet" href="<?=base_url?>estilos/personal/css/reclute/recursos_recolector.css">
 

<div class="container">

<div class="d-flex  justify-content-center mt-5 checarmail ">
    
    <div class="box-register d-flex  justify-content-center flex-column">

    <h4>Bienvenido <?=$_SESSION["username"]->name?> </h4>
    <h5>Debes revisar tu casilla de email <?=$_SESSION["username"]->email?> para continuar con el proceso de postulación.</h5>

    </div>

</div>
</div>

<script>
 
setTimeout(function(){ 
            location.href = base_url+'usuario/active';
          }, 20000);

</script>

   
      <script src="<?=base_url?>assets/trabajo/form.js?v=05042021"></script>
      <script src="<?=base_url?>assets/trabajo/reclute.js?v=05042021"></script>
      <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>



      
<?php require_once 'views/layout/footer.php'; ?>


      <?php }
   } ?>




    
    
