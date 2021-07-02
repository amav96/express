<?php require_once 'views/modal/equipos/firmar.php'; 

 require_once 'views/modal/equipos/caja_equipos.php'; 

 require_once 'views/modal/equipos/autorizar.php'; 

 require_once 'views/modal/equipos/en_base.php'; 

 require_once 'views/modal/equipos/remito_recuperados.php'; 

 require_once 'views/modal/equipos/modelos_permitidos.php';

 require_once 'views/modal/equipos/nuevos_clientes.php'; 

 require_once 'views/modal/equipos/equipos_consignacion.php';

 require_once 'views/modal/guia/instructivo.php';?>


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

  <script src="<?=base_url?>assets/equipos/data.js?v=040720212"></script>
  <script src="<?=base_url?>assets/equipos/data-autorizar.js?v=040720212"></script> 
  <script src="<?=base_url?>assets/equipos/procesar.js?v=040720212"></script>
  <script src="<?=base_url?>assets/equipos/procesar-autorizar.js?v=040720212"></script>
  <script src="<?=base_url?>assets/equipos/firmas.js?v=040720212"></script> 

<!-- vue -->
  <!-- <script src="<?=base_url?>vue/src/view/AvisoVisita.js"></script>  -->

      

    <!--componentes-->
        <!-- visita en domicilio -->
  <script src="<?=base_url?>vue/src/components/visita/BtnModalVisita.js?v=040720212"></script>
  <script src="<?=base_url?>vue/src/components/visita/modalVisita.js?v=040720212"></script> 
  <script src="<?=base_url?>vue/src/components/visita/DatosContacto.js?v=040720212"></script>
  
        <!-- gestion de avisos -->
  <script src="<?=base_url?>vue/src/components/gestionVisita/inputBuscar.js?v=040720212"></script>
  <script src="<?=base_url?>vue/src/components/gestionVisita/tiposAvisos.js?v=040720212"></script>

  <!-- guia instructiva -->
  <script src="<?=base_url?>vue/src/components/guia/botonGuia.js?v=040720212"></script>
  <script src="<?=base_url?>vue/src/components/guia/modalGuia.js?v=040720212"></script>

    <!--componentes-->
      <!-- errores -->
      <script src="<?=base_url?>vue/src/components/helpers/errorAlert.js?v=040720212"></script>


  <!----vuex------>
  <script src="<?=base_url?>vue/src/store/index.js?v=040720212"></script>
  <script src="<?=base_url?>vue/src/modules/M_visita.js?v=040720212"></script>
  <!----vuex------>

  <!-- view -->
  <script src="<?=base_url?>vue/src/view/avisoVisita.js?v=040720212"></script>

  <!-- ----------------------- -->
  
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>


</body>

</html>