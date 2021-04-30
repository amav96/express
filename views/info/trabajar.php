

<?php require_once 'views/layout/header.php'; ?>

<style>
.box-items img {
    width: 70px;
    height: 50px;
}
.box-items h5 {
    padding: 0.5rem;
    background: #0093f5;
    color: white;
    border-radius: 15px;
}


</style>


    <div class="container">
      
                <h3 style="margin:5rem auto 1rem auto;"  class="text-center" >¡Escoge para empezar!</h3>

            <div class="d-flex justify-content-center">

                <div class="d-flex justify-content-center flex-column m-4">

                 <div class="box-items  d-flex bd-highlight m-2  flex-column align-items-center">
                     <a href="<?=base_url?>express/recolector">
                 <h5 class="text-center" >Recolector</h5>
                 </a>
                 <img   src="<?=base_url?>estilos/imagenes/front/postman.png" alt="">
                 </div>
                 <div class="box-items d-flex bd-highlight m-2 flex-column align-items-center">
                <a href="<?=base_url?>express/call">
                 <h5 class="text-center" >Call Center</h5>
                 </a>
                 <img  src="<?=base_url?>estilos/imagenes/front/calman.png" alt="">
                 </div>
                 <div class="box-items d-flex bd-highlight m-2 flex-column align-items-center">
                <a href="<?=base_url?>express/comercio">
                 <h5 class="text-center" >Adherir Comercio</h5>
                 </a>
                 <img  src="<?=base_url?>estilos/imagenes/front/shop.png" alt="">
                 </div>

               </div>
       
               </div>

    </div>

    


 <?php require_once 'views/layout/footer.php'; ?>
  

