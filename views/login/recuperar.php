

   <?php require_once 'views/layout/header.php'; ?>

  

<link rel="stylesheet" href="<?= base_url ?>estilos/personal/css/login/recursos_login.css">

 <div class="container-artisan">
     <div class="container-form">

         <div class="box-form">
             <div class="form-imagen">
                 <img src="<?=base_url?>estilos/imagenes/logo/logo.png" alt="">
             </div>
             <div class="form-titulo">
                 <span class="titulo-form">
                     Olvide mi contraseña
                 </span>
             </div>
             
            <form id="form-recuperar" method="POST" >
             <div class="mini-box">
                 <div class="iconlabel">
                     <i class="fas fa-key"> </i>
                     <label for="">Ingrese Email</label>

                 </div>
                 <input style="background-color:#D6EAF8 ;border:0;" type="email" id="email" name="email" class="input" required placeholder="Ingrese su email">
             </div>
              <div id="cargarContrasena" style="display:flex;justify-content:center;margin:auto;">
                  
              </div>
            
                 <button type="submit" class="loguear" id="recuperar">Recuperar</button>
                 
             </div>
             </form>
         </div>
     </div>
 </div>


 <script src="<?=base_url?>assets/login/loginUs.js?v=05042021"></script>


 <?php require_once 'views/layout/footer.php'; ?>

