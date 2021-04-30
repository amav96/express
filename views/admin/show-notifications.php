<?php require_once 'views/layout/headerAdmin.php'; ?>



<?php $noti = $notificacion->fetch_object(); ?>

<div class="container">


<div class="container-datos-solicitante" id="container-datos-solicitante">


    <div class="box-solicitante" id="box-solicitante">
        <?php  if(isset($_SESSION["Img"])){
            if($_SESSION["Img"] === 'success'){ ?>
            <div style="margin:auto;" class="alert alert-success text-center">
                    <h5 class="text-center" style="color:green;"> Imagen monotributo actualizada con exito!</h5>
                    </div>
         <?php   }else if($_SESSION["Img"] ==='errorFormato'){ ?>
<div style="margin:auto;" class="alert alert-danger text-center">
            <h5 style="color:red;"> Asegurate que la foto sea formato PNG. JPG O JPEG</h5>
            </div>
      <?php    } else if($_SESSION["Img"] ==='errorUpdate'){ ?>
<div style="margin:auto;" class="alert alert-danger text-center">
        <h5 style="color:red;"> No fue posible la actualización de la imagen</h5>
        </div>
     <?php  }else if($_SESSION["Img"] ==='noExiste'){ ?>
<div style="margin:auto;" class="alert alert-danger text-center">
        <h5 style="margin:auto;" style="color:red;"> La imagen no fue insertada correctamente</h5>
        </div>
    <?php }
        } ?>
    <h4>Nombre del solicitante: <?=$noti->name?></h4>

    <div class="mini-box">
    <div class="dato-titulo">
        Documento Frontal
    </div>
    <div class="dato-contenido">
        <a href="<?=base_url?>resources/imgRegister/<?=$noti->img_document_front?>" data-fancybox="gallery" >
            <img class="imagen-panel" src="<?=base_url?>resources/imgRegister/<?=$noti->img_document_front?>">
        </a>
    </div>
</div>
<div class="mini-box">
    <div class="dato-titulo">
        Documento Dorso
    </div>
    <div class="dato-contenido">
    <a href="<?=base_url?>resources/imgRegister/<?=$noti->img_document_post?>" data-fancybox="gallery" >
            <img class="imagen-panel" src="<?=base_url?>resources/imgRegister/<?=$noti->img_document_post?>">
        </a>
    </div>
</div>
<div class="mini-box">
    <div class="dato-titulo">
        CUIL / RUT
    </div>
    <div class="dato-contenido">
    <a href="<?=base_url?>resources/imgRegister/<?=$noti->img_cuil_rut?>" data-fancybox="gallery" >
            <img class="imagen-panel" src="<?=base_url?>resources/imgRegister/<?=$noti->img_cuil_rut?>">
        </a>
    </div>
</div>

<div class="mini-box">
    <div class="dato-titulo">
        Comprobante de domicilio
    </div>
    <div class="dato-contenido">
    <a href="<?=base_url?>resources/imgRegister/<?=$noti->img_home?>" data-fancybox="gallery" >
            <img class="imagen-panel" src="<?=base_url?>resources/imgRegister/<?=$noti->img_home?>">
        </a>
    </div>
</div>

<?php if( $noti->role === 'comercio'){ ?>

        <div class="mini-box">
    <div class="dato-titulo">
        Comercio
    </div>
    <div class="dato-contenido">
    <a href="<?=base_url?>resources/imgRegister/<?=$noti->img_commerce?>" data-fancybox="gallery" >
            <img class="imagen-panel" src="<?=base_url?>resources/imgRegister/<?=$noti->img_commerce?>">
        </a>
    </div>
</div>
    <?php  } ?>


<?php if( $noti->img_monotribute != null || $noti->img_monotribute != "" ){?>

    <div class="mini-box">
    <div class="dato-titulo">
        Comprobante de monotributo / mides
    </div>
    <div class="dato-contenido">
    <a href="<?=base_url?>resources/imgRegister/<?=$noti->img_monotribute?>" data-fancybox="gallery" >
            <img class="imagen-panel" src="<?=base_url?>resources/imgRegister/<?=$noti->img_monotribute?>">
        </a>
    </div>
</div> 

<form action="<?=base_url?>usuario/completeThePhotoRequirements" enctype="multipart/form-data" method="POST">
    <div class="mini-box">
    <div class="dato-titulo">
        Actualizar imagen monotributo / mides
    </div>
    <div class="dato-contenido">
    <input class="form-control" name="fotoMonotribute" type="file" required >
    <input type="hidden" name="id_user" value="<?=$noti->id ?>">
    <input type="hidden" name="status_notifications" value="<?=$noti->status_notifications?>">
    <input type="hidden" name="id_number" value="<?=$noti->id_number?>">
  
    <input style="margin:0.3rem auto; " type="submit" class="btn btn-info" value="subir foto">
    </div>
    
</div> 
</form>


<?php } else{ ?>
    
    <form action="<?=base_url?>usuario/completeThePhotoRequirements" enctype="multipart/form-data" method="POST">
    <div class="mini-box">
    <div class="dato-titulo">
        Actualizar imagen monotributo / mides
    </div>
    <div class="dato-contenido">
    <input class="form-control" name="fotoMonotribute" type="file" required >
    <input type="hidden" name="id_user" value="<?=$noti->id ?>">
    <input type="hidden" name="status_notifications" value="<?=$noti->status_notifications?>">
    <input type="hidden" name="id_number" value="<?=$noti->id_number?>">
  
    <input style="margin:0.3rem auto; " type="submit" class="btn btn-info" value="subir foto">
    </div>
    
</div> 
</form>

    <?php }?> 




<div class="mini-box">
    <div class="dato-titulo">
        Documento
    </div>
    <div class="dato-contenido">
    <?=$noti->id_number?>
    </div>
</div>

<?php if($noti->cuit !='' || $noti->cuit != null){?>

<div class="mini-box">
<div class="dato-titulo">
    CUIT / RUT
</div>
<div class="dato-contenido">
<?=$noti->cuit?>
</div>
</div>


<?php } ?> 




<div class="mini-box">
    <div class="dato-titulo">
        Tel Movil
    </div>
    <div class="dato-contenido">

        <a href="https:api.whatsapp.com/send?phone=<?=$noti->phone_number?>&text=Hola%20<?=$noti->name?>%20,%20hemos%20recibido%20tu%20solicitud%20para%20formar%20parte%20de%20*Express.*" target="_blank"><?=$noti->phone_number?></a>
    </div>
</div>
<div class="mini-box">
    <div class="dato-titulo">
        Correo
    </div>
    <div class="dato-contenido">
    <?=$noti->email?>
    </div>
</div>
<div class="mini-box">
    <div class="dato-titulo">
        Pais / Provincia
    </div>
    <div class="dato-contenido">
    <?=$noti->country?>
    </div>
</div>
<div class="mini-box">
    <div class="dato-titulo">
        Localidad
    </div>
    <div class="dato-contenido">
    <?=$noti->location?>
    </div>
</div>
<div class="mini-box">
    <div class="dato-titulo">
        Domicilio
    </div>
    <div class="dato-contenido">
    <?=$noti->home_address?>
    </div>
</div>
<div class="mini-box">
    <div class="dato-titulo">
        Codigo Postal
    </div>
    <div class="dato-contenido">
    <?=$noti->postal_code?>
    </div>
</div>

<div class="mini-box">
    <div class="dato-titulo">
        Tipo
    </div>
    <div class="dato-contenido">
    <?=$noti->role?>
    </div>
</div>

<div class="mini-box">
    <div class="dato-titulo">
        Como nos conocio?
    </div>
    <div class="dato-contenido">
    <?=$noti->knowledge_path?>
    </div>
</div>

<?php if($noti->cbu !='' || $noti->cbu != null){?>

<div class="mini-box">
<div class="dato-titulo">
    Cuenta CBU
</div>
<div class="dato-contenido">
<?=$noti->cbu?>
</div>
</div>


<?php } ?> 


<?php if($noti->bank !='' || $noti->bank != null){?>

<div class="mini-box">
<div class="dato-titulo">
    Banco
</div>
<div class="dato-contenido">
<?=$noti->bank?>
</div>
</div>

<?php } ?> 



<div class="mini-box">


<a class="btn btn-success" href="<?=base_url?>usuario/managentUs?id_us=<?=$noti->id_number?>">
Gestionar
</a>

</div>

    </div>
</div>

</div>
<?php Utils::deleteSession('Img'); ?>

<?php require_once 'views/layout/footerAdmin.php'; ?>