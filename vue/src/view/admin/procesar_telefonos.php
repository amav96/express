<?php require_once 'views/layout/headerAdmin.php'; ?>

    <div id="admin-procesar-telefonos" >
    </div>

<!-- VUE -->

<!-- component -->

<script src="<?=base_url?>vue/src/components/admin/normalizar/formImport.js"></script>
<script src="<?=base_url?>vue/src/components/helpers/errorGlobal.js"></script>

<!-- Store -->
<script src="<?=base_url?>vue/src/store/index.js?v=05042021"></script>
<!-- views -->

<!-- component  avisos -->
    
<?php require_once 'views/layout/footerAdmin.php'; ?>

<script>

    Vue.config.devtools = true;
    Vue.config.debug = true;
    
  new Vue({

        el: '#admin-procesar-telefonos',
        vuetify: new Vuetify(),
        store,
        template : //html 
        `
            <v-app class="empujarParaArriba elevation" >
            <div >
              <v-row  
                class=" bg-blue-custom justify-center align-items-center  flex-column m-0 py-2"
                wrap
              > 
                <v-container  class=" d-flex justify-center flex-column">
                      <h5 class=" color-white-custom text-center" >Procesar telefonos</h5>
                      <v-toolbar 
                        elevation="0"
                        color="transparent"
                        class="d-flex justify-center flew-row "
                        height="auto"
                        wrap
                        > 
                      </v-toolbar>
                </v-container>     
              </v-row>
          </div>
          <div class="d-flex justify-center align-center align-self-center flex-column" >
            <transition name="slide-fade">
                <template v-if="error.type !== null" >
                    <error-global 
                    :error="error" 
                    @clearingError="error = $event"  
                    />
                </template>
            </transition>
           <template>
            <form-import
            :base_url_sendFile="base_url_sendFile"
            @childrenSetError="error = $event"
            />
           </template>
          </div>
            
            </v-app>
        `,
        data(){
            return {
                base_url_sendFile: API_BASE_CONTROLLER + 'normalizacionController.php?normalizacion=validateFile',
                error: {
                    type: null,
                    text: null,
                    time: null
              }
            }
        },
        methods:{
          
        
        },
      
    
    })

</script>


<style>

    .sacarOutline{
        outline: none !important;
        border: none !important;
    }
    .centrado-total-column{
        display: flex;
        justify-content: center;
        flex-wrap: wrap;
        flex-direction: column;
        margin: 0 1rem;
    }
    .centrado-total-row{
        display: flex;
        justify-content: center;
        flex-wrap: wrap;
        flex-direction: row;
        margin: 0 1rem;
    }

    .empujarParaArriba{
      transform: translateY(-22px);
    }
    /* botones */
    .btn-base{
      display:flex;
      justify-content: center;
      align-items: center ; 
      padding:5px 10px;
      border-radius:15px;
      transition: 0.5s;
      outline: none !important;
      border: none !important;
    }
    .btn-base:hover{
      transform: scale(1.05);
      outline:none !important ;
      border: none !important;
    }

    /* letra */

    .noUpperCase {
      text-transform: none !important;
    }

    /* color */
    .color-blue-custom {
      color:#0093f5 !important ;
    }



    .color-white-custom {
      color: white !important ;
    }
    /* background */
    .bg-blue-custom {
      background:#0093f5;
    }

    .bg-black-custom {
      background: black;
    }

    .active-link{
      background:red;
    }

    /* tamaños input */



    /* contenedores */

    .altura {
      height:5rem !important;
    }

   
    /* animaciones */

    .slide-fade-enter-active {
  transition: all .3s ease;
    }
    .slide-fade-leave-active {
      transition: all .8s cubic-bezier(1.0, 0.5, 0.8, 1.0);
    }
    .slide-fade-enter, .slide-fade-leave-to
    /* .slide-fade-leave-active below version 2.1.8 */ {
      transform: translateX(10px);
      opacity: 0;
    }


</style>