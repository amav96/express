

   <?php require_once 'views/layout/header.php'; ?>


<link rel="stylesheet" href="<?= base_url ?>estilos/personal/css/login/recursos_login.css">

 <div class="container-artisan">
     <form action="" id="form-login">
     <div class="container-form">

         <div class="box-form">
             <div class="form-imagen">
                 <img src="<?=base_url?>estilos/imagenes/logo/logo.png" alt="">
             </div>
             <div class="form-titulo">
                 <span class="titulo-form">
                     Ingrese a Express
                 </span>

                 
             </div>
             <div class="mini-box">
                 <div class="iconlabel">
                     <i class="fas fa-user"> </i>
                     <label for="">Usuario / Email</label>

                 </div>
                 <input style="background-color:#D6EAF8 ;border:0;" type="text" id="username" name="username" class="input" placeholder="Ingrese usuario">
             </div>

             <div class="mini-box">
                 <div class="iconlabel">
                     <i class="fas fa-key"> </i> 
                     <label for="">Clave</label>

                 </div>
                 <input style="background-color:#D6EAF8 ;border:0;" type="password" id="password" name="password" class="input" placeholder="Ingrese contraseña">
             </div>
               <p class="error" id="error">Usuario o Clave invalida!</p>
             <div class="mini-box"> 
                  
                  
                 <button  type="submit" class="loguear" id="loguear"><span class="spinner-border hiddenLoader loaderBtn" role="status"></span><span class="txtLogin">Ingresar</span></button>
                 <a href="<?=base_url?>usuario/restore">Olvide mi contraseña!</a> 
                 <a class="mb-1"  href="<?=base_url?>express/trabajar">Registrarme</a>
             </div>
     
         </div>
     </div>
     </form>
 </div>

 <script src="<?=base_url?>assets/login/loginUs.js?v=05072021"></script>


 <?php require_once 'views/layout/footer.php'; ?>

