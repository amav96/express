<?php require_once 'views/modal/admin/modal_enviar_remito.php';  ?>
<?php require_once 'views/modal/admin/editar_transito.php';  ?>
<?php require_once 'views/modal/admin/baja_usuario.php';  ?>
<?php require_once 'views/modal/admin/agregar_cliente.php';  ?>
<?php require_once 'views/modal/admin/asignacion.php'; ?>
<?php require_once 'views/modal/admin/detalleAviso.php'; ?>

  

<script type="text/javascript" src="<?=base_url?>estilos/personal/datatables/JSZip-2.5.0/jszip.min.js"></script>
<script type="text/javascript" src="<?=base_url?>estilos/personal/datatables/pdfmake-0.1.36/pdfmake.min.js"></script>
<script type="text/javascript" src="<?=base_url?>estilos/personal/datatables/pdfmake-0.1.36/vfs_fonts.js"></script>
<script type="text/javascript" src="<?=base_url?>estilos/personal/datatables/DataTables-1.10.22/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?=base_url?>estilos/personal/datatables/AutoFill-2.3.5/js/dataTables.autoFill.min.js"></script>
<script type="text/javascript" src="<?=base_url?>estilos/personal/datatables/Buttons-1.6.5/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="<?=base_url?>estilos/personal/datatables/Buttons-1.6.5/js/buttons.html5.min.js"></script>
<script type="text/javascript" src="<?=base_url?>estilos/personal/datatables/Buttons-1.6.5/js/buttons.print.min.js"></script>
<script type="text/javascript" src="<?=base_url?>estilos/personal/moments/moment.js"></script>
<script type="text/javascript" src="<?=base_url?>estilos/personal/moments/data-time-moments.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" > </script> 
<script src="https://cdn.datatables.net/fixedheader/3.1.6/js/dataTables.fixedHeader.min.js"></script>

<script>

$(function () {
  $('[data-toggle="tooltip"]').tooltip()
})

</script>
      
<!-- código JS propìo-->    
<script src="<?=base_url?>assets/admin/panel.js?v=21042021"></script>
<script src="<?=base_url?>estilos/personal/js/logo.js"> </script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
</body>

</html>