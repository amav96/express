

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
                     Restablecer contraseña
                 </span>
             </div>
             
            <form id="form-restablecer" method="POST" >
             <div class="mini-box">
                 <div class="iconlabel">
                     <i class="fas fa-key"> </i>
                     <label for="">Nueva contraseña</label>

                 </div>
                 <input style="background-color:#D6EAF8 ;border:0;" type="password" id="form-pass-one" name="form-pass-one" class="input"  placeholder="Ingrese contraseña nueva" required>
             </div>

             <div class="mini-box">
                 <div class="iconlabel">
                     <i class="fas fa-key"> </i>
                     <label for="">Ingrese nuevamente la contraseña</label>

                 </div>
                 <span style="color:red;" id="txtError"></span>
                 <input  style="background-color:#D6EAF8 ;border:0;" type="password" id="form-pass-two" name="form-pass-two" class="input" placeholder="Ingrese contraseña nuevamente"  required>
                 <input   id="i" name="i" type="hidden" value="<?=$_GET["i"]?>">
                 <input   id="p" name="p" type="hidden" value="<?=$_GET["p"]?>">
                 <input   id="mh" name="mh" type="hidden" value="<?=$_GET["mh"]?>">
              
             </div>
            <div id="cargarLoaderInsertarContrasena" style="display:flex;justify-content:center;margin:auto;" >
                
            </div>
            
                 <button type="submit" class="loguear" id="restablecer">Guardar</button>
                 
             </div>
             </form>
         </div>
     </div>
 </div>


 <script src="<?=base_url?>assets/login/loginUs.js?v=05042021"></script>


 <?php require_once 'views/layout/footer.php'; ?>

