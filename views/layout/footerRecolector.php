<?php require_once 'views/modal/equipos/firmar.php'; 

 require_once 'views/modal/equipos/caja_equipos.php'; 

 require_once 'views/modal/equipos/autorizar.php'; 

 require_once 'views/modal/equipos/en_base.php'; 

 require_once 'views/modal/equipos/remito_recuperados.php'; 

 require_once 'views/modal/equipos/modelos_permitidos.php';

 require_once 'views/modal/equipos/nuevos_clientes.php'; 

 require_once 'views/modal/equipos/equipos_consignacion.php';

 require_once 'views/modal/guia/instructivo.php';?>

  <script src="<?=base_url?>assets/equipos/data.js?v=12052021"></script>
  <script src="<?=base_url?>assets/equipos/data-autorizar.js?v=12052021"></script> 
  <script src="<?=base_url?>assets/equipos/procesar.js?v=12052021"></script>
  <script src="<?=base_url?>assets/equipos/procesar-autorizar.js?v=12052021"></script>
  <script src="<?=base_url?>assets/equipos/firmas.js?v=12052021"></script> 

<!-- vue -->
  <!-- <script src="<?=base_url?>vue/src/view/AvisoVisita.js"></script>  -->

      

    <!--componentes-->
        <!-- visita en domicilio -->
  <script src="<?=base_url?>vue/src/components/visita/BtnModalVisita.js?v=12052021"></script>
  <script src="<?=base_url?>vue/src/components/visita/modalVisita.js?v=12052021"></script> 
  <script src="<?=base_url?>vue/src/components/visita/DatosContacto.js?v=12052021"></script>
  
        <!-- gestion de avisos -->
  <script src="<?=base_url?>vue/src/components/gestionVisita/inputBuscar.js?v=12052021"></script>
  <script src="<?=base_url?>vue/src/components/gestionVisita/tiposAvisos.js?v=12052021"></script>

  <!-- guia instructiva -->
  <script src="<?=base_url?>vue/src/components/guia/botonGuia.js?v=12052021"></script>
  <script src="<?=base_url?>vue/src/components/guia/modalGuia.js?v=12052021"></script>

    <!--componentes-->
      <!-- errores -->
      <script src="<?=base_url?>vue/src/components/helpers/errorAlert.js?v=12052021"></script>


  <!----vuex------>
  <script src="<?=base_url?>vue/src/store/index.js?v=12052021"></script>
  <script src="<?=base_url?>vue/src/modules/M_visita.js?v=12052021"></script>
  <!----vuex------>

  <!-- view -->
  <script src="<?=base_url?>vue/src/view/avisoVisita.js?v=12052021"></script>

  <!-- ----------------------- -->
  
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>


</body>

</html>