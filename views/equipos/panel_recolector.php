<?php require_once 'views/layout/headerRecolector.php'; ?>
<body>

  <div class="loader">

  </div>
  <div class="container ">

  <div class="d-flex justify-content-center">
    <button class=" c-Button botonAnimation-guia" data-toggle="modal" data-target="#exampleModal">Guia instructiva</button>
  </div>

  <div class="d-flex justify-content-start">
   <div class="mt-1 d-flex justify-content-center align-content-center align-items-center align-self-center" id="gestion-nueva"></div>
  </div>


        <div class="row">
          <div class="col-sm-4 textcenter caja-titulo bg-indigo">

            <div class="box-reco-info ">
              <h6 id="title" class="text-center" >Recolector/a :
                <?php
                if (isset($_SESSION["username"])) {
                  echo $_SESSION["username"]->name;
                }
                ?>
              </h6>
            </div>
            <div class="box-reco-info">
              <span style="font-size:16px;" id="clienteActual"></span>
            </div>
            <div class="box-reco-info">
              <span style="font-size:16px;" id="cantRemit"></span>
            </div>

          
          </div>
        </div>
     
  </div>
  <!-- Boton iniciar  -->

 

  <div class="botonera">
    <div class="sub-botonera">

    
        <div id="iniciar" name="iniciar">
            <div  class="d-flex justify-content-center flex-column align-content-center align-items-center caja-box-circle" >
                          <div class=" circle-icon-medium btn">
                              <img class="img-aviso-medium" src="<?= base_url ?>/estilos/imagenes/front/poder.png" >
                          </div>

                          <div class="py-2 text-medium text-center">
                            <strong>Iniciar transacción</strong>
                          </div>
            </div>
          </div>
        

        <!-- BUSCAR -->
          <form id="form-buscar" class="mb-2">
          <div id="cajaBuscador" class="caja-buscador">
            <input type="text" class="c-Button-input shadowCustom form-control-lg p-3 text-center" placeholder="Complete cliente" id="q">

            <button class="c-Button-search bg-indigo text-white" type="submit" id="clickBuscar">
              <i style="font-size:18px;" class="fas fa-search"></i>
            </button>

          </div>
          </form>


          <!-- -----------------------VUE------------------>

          
        <div id="app">
          
          <btn-modal-visita  ></btn-modal-visita>
        <!-- <button-modal/> -->
        </div>

     
      <!-- MODAL REMITO ELECTRONICO -->

          <div id="abrir-caja-equipos">
            <div  class="d-flex justify-content-center flex-column align-content-center align-items-center caja-box-circle" >
                          <div class=" circle-icon-medium btn">
                              <img class="img-aviso-medium" src="<?= base_url ?>/estilos/imagenes/front/tick.png" >
                          </div>

                          <div class="py-2 text-medium text-center">
                            <strong id="text-caja-confirmar"> Confirmar transacción</strong>
                          </div>
            </div>
          </div>
      <!-- -----------------------VUE-------------->
        <div id="btnAutorizar">
          <div  class=" d-flex justify-content-center flex-column align-content-center align-items-center caja-box-circle" >
                        <div class=" circle-icon-medium btn">
                            <img class="img-aviso-medium" src="<?= base_url ?>/estilos/imagenes/front/add.png" >
                        </div>

                        <div class="py-2 text-medium text-center">
                          <strong> Equipos Autorizar</strong>
                        </div>
            </div>
        </div>

        <div name="finalizar"  id="finalizar">
          <div class="d-flex justify-content-center flex-column align-content-center align-items-center caja-box-circle" >
                      <div class=" circle-icon-medium btn">
                          <img class="img-aviso-medium" src="<?= base_url ?>/estilos/imagenes/front/close.png" >
                      </div>

                      <div class="py-2 text-medium text-center">
                        <strong id="finalizar-text" > Salir de transacción</strong>
                      </div>
          </div>
        </div>

    </div>
  </div>

  <div class="car" id="caja-box">
  </div>


  <div class="contspinner" id="contspinner">
    <div class="subspinner" id="subspinner">
      <div class="spinner-border " role="status">
        <span class="sr-only">Loading...</span>
      </div>
    </div>
  </div>


  <!-- seleccione equipos -->
  <div  class="d-flex justify-content-center my-3 ">
     <span id="textTable" class="color-indigo" style="font-size:21px;font-weight:700;"> </span>
  </div>



  <div class="table-responsive" id="table">
    <table class="table table-striped table-hover" id="cuerpo">

    </table>

  </div>

 

  <div class='clearfix'></div>

  <script>

  
  </script>
 
  
 
 <?php require_once 'views/layout/footerRecolector.php'; ?>

 
