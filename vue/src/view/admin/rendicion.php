<?php require_once 'views/layout/headerAdmin.php'; ?>

    <div id="admin-rendicion" >
            
    </div>
<!-- VUE -->

<!-- component  avisos -->
  
<script src="<?=base_url?>vue/src/components/helpers/errorGlobal.js"></script>
<script src="<?=base_url?>vue/src/components/helpers/loaderDialog.js"></script>
<script src="<?=base_url?>vue/src/components/helpers/loaderLine.js"></script>

<!-- dialog component -->
<script src="<?=base_url?>vue/src/components/dialog/reusable/fullScreen.js"></script>
<script src="<?=base_url?>vue/src/components/dialog/reusable/smallScreen.js"></script>
<script src="<?=base_url?>vue/src/components/dialog/reusable/mediaScreen.js"></script>
<script src="<?=base_url?>vue/src/components/dialog/reusable/chooseNext.js"></script>
<script src="<?=base_url?>vue/src/components/dialog/reusable/continue.js"></script>

<!-- alert -->
<script src="<?=base_url?>vue/src/components/alert/custom/AlertInfoUser.js"></script>

<!-- table component -->
<script src="<?=base_url?>vue/src/components/tables/pagination.js"></script>
<script src="<?=base_url?>vue/src/components/tables/excel.js"></script>

<!-- form component -->

<script src="<?=base_url?>vue/src/components/form/reusable/filterWithPagination.js"></script>
<script src="<?=base_url?>vue/src/components/form/reusable/select/AutoCompleteSimpleID.js"></script>
<script src="<?=base_url?>vue/src/components/form/reusable/select/AutoCompleteSearchID.js"></script>
<script src="<?=base_url?>vue/src/components/form/reusable/formImport.js"></script>


<!-- pagination component -->
<script  src="<?=base_url?>vue/src/components/tables/pagination.js"></script>

<script src="<?=base_url?>vue/src/store/index.js"></script>
<script src="<?=base_url?>vue/src/modules/M_adminAvisos.js"></script>


<!-- views -->

<?php require_once 'views/layout/footerAdmin.php'; ?>

<script>
    Vue.config.devtools = true;
    Vue.config.debug = true;
  new Vue({
        el: '#admin-rendicion',
        vuetify: new Vuetify(),
        store,
        template : //html 
        `
        <v-app class="empujarParaArriba elevation" >
            <div>
            <v-row  
                class="bg-blue-custom justify-center align-items-center  flex-column m-0 py-2"
                wrap
              > 
                <v-container  class=" d-flex justify-center flex-column">
                      <h5 class=" color-white-custom text-center" >Rendicion</h5>
                      <v-toolbar 
                        elevation="0"
                        color="transparent"
                        class="d-flex justify-center flew-row "
                        height="auto"
                        wrap
                        > 
                        <div class="d-flex justify-center flex-row flex-wrap" >
                          <div  
                            v-for="item in MAINRESOURCES.itemsButtons"
                            :key="item.title"
                            link
                            >
                            <v-btn
                              @click="handle_function_call(item.methods)"
                              class="bg-blue-custom mx-3 my-1 noUpperCase"
                              color="transparent"
                              :class="[item.active? 'secondary' :  item.color]"
                              >
                              <span class="color-white-custom" >{{ item.title }}</span>
                            <v-icon class="mx-1" color="white" >{{ item.icon }}</v-icon>
                            </v-btn>
                            <v-spacer></v-spacer>
                          </div>
                        </div>
                      </v-toolbar>
                </v-container>     
            </v-row>
            </div>

            <div class="d-flex justify-center align-center align-self-center flex-column" >
                <transition name="slide-fade">
                  <error-global 
                  v-if="MAINRESOURCES.error.type !== null" 
                  :error="MAINRESOURCES.error"
                  @clearingError="MAINRESOURCES.error = $event"
                  />
                </transition>
                <template>
                        <form-import
                        :import="readEquipment.import"
                        />
                </template>
            </div>
        </v-app>
        `,
        data(){
            return {
                readEquipment:{
                    import: {
                        upload: {
                            url : API_BASE_CONTROLLER + 'rendicionController.php?rendicion=readExcel'
                        }
                    }
                },
                MAINRESOURCES : {
                    url_actions : {
                      download_excel : API_BASE_EXCEL,
                      delete_excel : API_BASE_URL + 'helpers/delete.php?delete=deleteExcelFile',
                  },
                  urlTryPagination:'',
                  pagination : {
                      display: false,
                      totalPage : 0, 
                      rowForPage:10,
                      pageCurrent: 1,
                      totalCountResponse:0,
                      fromRow:0,
                      limit:10
                  },
                  parametersDynamicToPaginate : [],
                  subheaders : {
                    active : false,
                    dataResponseDB : [],
                    loader : false
                  },
                  filter : {
                    display: false,
                    parameters : [],
                    url:'',
                    export:{
                      display: true,
                      url: ''
                    },
                    reset: false,
                    pagination : true
                  },
                  exportExcel : {
                    display : false,
                    parameters:[],
                    url : '',
                    download_excel : API_BASE_EXCEL,
                    delete_excel : API_BASE_URL + 'helpers/delete.php?delete=deleteExcelFile',
                  },
                  loaderLine: false,
                  loadingTable : false,
                  columns: [
                      
                      { text: 'Codigo Postal'},
                      { text: 'Localidad'},
                      { text: 'Provincia Int'},
                      { text: 'Provincia'},
                      { text: 'Direccion'},
                      { text: 'Horarios'},
                      { text: 'HorariosB'},
                      { text: 'Pais'},
                      { text: 'Tipo'},
                      { text: 'Nombre Asignado'},
                      { text: 'fecha'},
                      { text: 'Acciones'},
                      { text: 'Ubicacion'},

                  ],
                  table : {
                        display : false,
                        loading: false,
                        dataResponseDB: []
                    },
                  itemsButtons:[
                      { title: 'Leer series', icon: 'mdi-map-marker-multiple-outline', methods: '$_readEquipment' , active : true, color :"bg-blue-custom" },
                    
                      
                  ],
                  error: {
                    type: null,
                    text: null,
                    time: null
                  },
                  snackbar:{
                    display:false,
                    text:'',
                    timeout:-1,
                    color:''
                  },

                },
            }
        },
        methods:{
            handle_function_call(function_name) {
                this[function_name]()
            },
            $_readEquipment(){
                alert("leyendo")
            }
         
        },
    })
</script>
<style>
    .empujarParaArriba{
      margin-top: -20px;
    }
   
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

    .field-medium{
      width: 11rem;
    }

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

    /* dialog */

    .v-dialog__content{
      z-index: 600 !important;
    }

    /* inputs */

    /* v-tolbar */

    .fixed-bar {
    position: sticky;
    position: -webkit-sticky; /* for Safari */
    top: 0.1px;
    z-index: 2;
  }  



  /* forimport */


  .container-select{
        border: 2px solid rgb(126, 181, 253);
        border-radius: 6px;
        cursor: pointer;
        width: 20rem;
    }
    .select-file{
        height:5rem;
        display: flex;
        justify-content: center;
        flex-direction:column;
        align-items: center;
        
        
    }
    .gallery-file{
        display:flex;
        justify-content:flex-start;
        flex-direction: row;
        align-content: center;
        align-items: center;
    }   
   

</style>
