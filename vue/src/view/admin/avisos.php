<?php require_once 'views/layout/headerAdmin.php'; ?>

    <div id="admin-notices" >
            
    </div>
<!-- VUE -->

<!-- component  avisos -->
  

<script src="<?=base_url?>vue/src/components/helpers/errorGlobal.js?v=12052021"></script>
<script src="<?=base_url?>vue/src/components/helpers/loaderDialog.js?v=12052021"></script>
<script src="<?=base_url?>vue/src/components/helpers/loaderLine.js?v=12052021"></script>


<!-- dialog component -->

<script src="<?=base_url?>vue/src/components/dialog/detailNotice.js?v=12052021"></script>

<!-- table component -->
<script src="<?=base_url?>vue/src/components/tables/pagination.js?v=12052021"></script>
<script src="<?=base_url?>vue/src/components/tables/excel.js?v=12052021"></script>
<script src="<?=base_url?>vue/src/components/tables/tableAvisos.js?v=12052021"></script>


<!-- form component -->
<script  src="<?=base_url?>vue/src/components/form/reusable/formSearchByWordAndDate.js?v=12052021"></script>
<script src="<?=base_url?>vue/src/components/form/reusable/formSearchDate.js?v=12052021"></script>
<script src="<?=base_url?>vue/src/components/form/reusable/formSearchWord.js?v=12052021"></script>
<script src="<?=base_url?>vue/src/components/form/reusable/filterWithPagination.js?v=12052021"></script>


<!-- pagination component -->
<script  src="<?=base_url?>vue/src/components/tables/pagination.js?v=12052021"></script>

<!-- helpers component -->
<script  src="<?=base_url?>vue/src/components/helpers/messageAlert.js?v=12052021"></script>
<script  src="<?=base_url?>vue/src/components/helpers/messageSnack.js?v=12052021"></script>

<!-- Store -->
<script src="<?=base_url?>vue/src/store/index.js?v=12052021"></script>
<script src="<?=base_url?>vue/src/modules/M_adminAvisos.js?v=12052021"></script>
<!-- views -->

<?php require_once 'views/layout/footerAdmin.php'; ?>

<script>

    Vue.config.devtools = true;
    Vue.config.debug = true;
    
  new Vue({

        el: '#admin-notices',
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
                      <h5 class=" color-white-custom text-center" >Gestión de avisos</h5>
                      <v-toolbar 
                        elevation="0"
                        color="transparent"
                        class="d-flex justify-center flew-row "
                        height="auto"
                        wrap
                        > 
                        <div class="d-flex justify-center flex-row flex-wrap" >
                          <div  
                            v-for="item in itemsButtons"
                            :key="item.title"
                            link
                            >
                            <v-btn
                              @click="handle_function_call(item.methods)"
                              class="bg-blue-custom mx-3 my-1 noUpperCase"
                              color="transparent"
                              :class="[item.active? 'secondary' :  '']"
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
                  v-if="error.type !== null" 
                  :error="error"
                  @clearingError="error = $event"
                  />
                </transition>
                <template v-if="formId">
                    <v-col  class="d-flex justify-center m-2"  cols="12" lg="12"  >
                      <form-search-word
                      :searchByWord="searchByWord"
                      @totalCountResponse = "pagination.totalCountResponse = $event"
                      @TotalPage = "pagination.totalPage = $event"
                      @dynamicDataToSearch ="dynamicDataToSearch = $event"
                      @response="dataResponseDB = $event"
                      @loadingTable="loadingTable = $event"
                      @showTable="table = $event"
                      @urlTryPagination="urlTryPagination = $event"
                      @setErrorGlobal="error = $event"
                      @setSubHeadersDataResponseDB="subheaders.dataResponseDB = $event"
                      @setSubHeadersLoader="subheaders.loader = $event"
                      :pagination="pagination"
                      :subheaders="subheaders"
                      :base_url_header="base_url_header"
                      :filter="filter"
                      :base_url_to_count_search_word_controller="base_url_to_count_search_word_controller"
                      :base_url_to_get_search_word_controller="base_url_to_get_search_word_controller"
                      @setShowFilter="filter.display = $event"
                      @setUrlSearchController="filter.url_searchCountController = $event"
                      @setUrlGetDataSearchController="filter.url_searchGetDataController = $event"
                      @setDataDynamicToFilter="filter.dynamicDataToFilter = $event"
                      @filtering="filter.filtering = $event"
                      @setDisplayExportExcel="displayExportFromComponentAccesores = $event"
                      @setDisplayHeaders="subheaders.active = $event"
                      @setPaginateDisplay="pagination.display = $event"
                      />
                    </v-col>
                </template>

                <template v-if="formRangeDate">
                  <v-col class="d-flex justify-center m-2" cols="12" lg="12"  >
                    <form-search-date
                    :searchByRangeDate="searchByRangeDate"
                    @totalCountResponse = "pagination.totalCountResponse = $event"
                    @TotalPage = "pagination.totalPage = $event"
                    @dynamicDataToSearch ="dynamicDataToSearch = $event"
                    @response="dataResponseDB = $event"
                    @loadingTable="loadingTable = $event"
                    @showTable="table = $event"
                    @urlTryPagination="urlTryPagination = $event"
                    @setErrorGlobal="error = $event"
                    @setSubHeadersDataResponseDB="subheaders.dataResponseDB = $event"
                    @setSubHeadersLoader="subheaders.loader = $event"
                    :pagination="pagination"
                    :subheaders="subheaders"
                    :base_url_header="base_url_header"
                    :filter="filter"
                    :base_url_to_count_search_word_controller="base_url_to_count_search_word_controller"
                    :base_url_to_get_search_word_controller="base_url_to_get_search_word_controller"
                    @setShowFilter="filter.display = $event"
                    @setUrlSearchController="filter.url_searchCountController = $event"
                    @setUrlGetDataSearchController="filter.url_searchGetDataController = $event"
                    @setDataDynamicToFilter="filter.dynamicDataToFilter = $event"
                    @filtering="filter.filtering = $event"
                    @setDisplayExportExcel="displayExportFromComponentAccesores = $event"
                    @setDisplayHeaders="subheaders.active = $event"
                    @setPaginateDisplay="pagination.display = $event"
                    />
                    </v-col>
                </template>
  
                <template v-if="formWordAndRangeDate">
                  <v-col class=" d-flex justify-center m-2" cols="12" lg="12" >
                    <form-search-by-word-and-range-date 
                    :searchByWordAndRangeDate="searchByWordAndRangeDate"
                    :base_url_data_select="base_url_data_select" 
                    @childrenProcessDataSelect="processDataSelect($event)"
                    :dataSelect="dataSelect"
                    :showDataSelect="showDataSelect"
                    @totalCountResponse = "pagination.totalCountResponse = $event"
                    @TotalPage = "pagination.totalPage = $event"
                    @dynamicDataToSearch ="dynamicDataToSearch = $event"
                    @response="dataResponseDB = $event"
                    @loadingTable="loadingTable = $event"
                    @showTable="table = $event"
                    @urlTryPagination="urlTryPagination = $event"
                    @setErrorGlobal="error = $event"
                    @setSubHeadersDataResponseDB="subheaders.dataResponseDB = $event"
                    @setSubHeadersLoader="subheaders.loader = $event"
                    :pagination="pagination"
                    :subheaders="subheaders"
                    :base_url_header="base_url_header"
                    :filter="filter"
                    :base_url_to_count_search_word_controller="base_url_to_count_search_word_controller"
                    :base_url_to_get_search_word_controller="base_url_to_get_search_word_controller"
                    @setShowFilter="filter.display = $event"
                    @setUrlSearchController="filter.url_searchCountController = $event"
                    @setUrlGetDataSearchController="filter.url_searchGetDataController = $event"
                    @setDataDynamicToFilter="filter.dynamicDataToFilter = $event"
                    @filtering="filter.filtering = $event"
                    @setDisplayExportExcel=" displayExportFromComponentAccesores = $event"
                    @setDisplayHeaders="subheaders.active = $event"
                    @setPaginateDisplay="pagination.display = $event"

                      />
                      </v-col>
                </template>  

              </div> 

                <template v-if="loadingTable" >
                 <loader-line />
                </template>
                
                <template v-if="filter.display">
                    <filter-with-pagination
                    :pagination = "pagination"
                    :filter="filter"
                    @setCountPagination="pagination = $event"
                    @dynamicDataToSearch="dynamicDataToSearch = $event"
                    @urlTryPagination="urlTryPagination = $event"
                    :urlTryPagination="urlTryPagination"
                    :dataResponseDB="dataResponseDB" 
                    @setAfterDataResponse="dataResponseDB = $event"
                    @restoreBeforeDataResponse="dataResponseDB = $event"
                    :dynamicDataToSearch="dynamicDataToSearch"
                    @restoreDynamicDataToSearch="dynamicDataToSearch = $event"
                    @setFlagFiltering ="filter.filtering = $event"
                    @restoreOldDataResponse="dataResponseDB = $event"
                    @restoreOldPagination="pagination = $event"
                    @restoreOldParametersToCall="dynamicDataToSearch = $event"
                    @restoreUrlPagination="urlTryPagination = $event"
                    />
                </template>

                <template v-if="table && displayExportFromComponentAccesores">
                  <div>
                    <v-row class="justify-center align-items-center align-content-center">
                      <excel-export
                      :url_actions="url_actions"
                      :dynamicDataToSearch="dynamicDataToSearch"
                      />
                    </v-row>
                  </div>
                 
                </template>

                <template>
                    <v-btn
                      v-if="table"
                      >
                      Total Registros <strong> &nbsp; {{pagination.totalCountResponse}}</strong>
                    </v-btn>
                </template>
        
                <template v-if="table">
                    <table-avisos
                      :admin="admin"
                      :dataResponseDB="dataResponseDB" 
                      :columns="columns"
                      :loadingTable="loadingTable"
                      :table="table"
                      :url_actions="url_actions"
                      @updateDelete="dataResponseDB = $event"
                    />
                </template>

                <template v-if="loaderLine" >
                  <loader-line />
                </template>

                <template v-if="pagination.totalPage !== null && pagination.totalPage >0 && table && pagination.display">
                    <pagination-custom 
                    :pagination="pagination"
                    :urlTryPagination="urlTryPagination"
                    :loaderLine="loaderLine"
                    @setPageCurrent= "pagination.pageCurrent = $event"
                    @setFromRow="pagination.fromRow = $event"
                    @updateDataResponseDB="dataResponseDB = $event"
                    @showLoaderLine="loaderLine =  $event"
                    :dynamicDataToSearch="dynamicDataToSearch"
                    @updateDynamicParametersToCall="dynamicDataToSearch = $event"
                    @restauratePagination="pagination = $event"
                    />
                </template>
          </v-app>
        `,
        data(){
            return {
              admin : 0,
              formEquipos : false,
              formId :true,
              formRangeDate:false,
              formWordAndRangeDate:false,
              dataSelect:[],
              searchByWord : {
                filteringSearchWord : false, 
                base_url_count : API_BASE_CONTROLLER + 'noticeController.php?notice=countNoticeByWord',
                base_url_data : API_BASE_CONTROLLER + 'noticeController.php?notice=noticeByWord',
                export : true,
                subheader : false
              },
              searchByRangeDate : {
                filteringSearchWord : true, 
                base_url_count : API_BASE_CONTROLLER + 'noticeController.php?notice=countNoticeRangeDate',
                base_url_data : API_BASE_CONTROLLER + 'noticeController.php?notice=noticeRangeDate',
                export : true,
                subheader : false
               
              },
              searchByWordAndRangeDate: {
                filteringSearchWord : true, 
                base_url_count : API_BASE_CONTROLLER + 'noticeController.php?notice=countNoticeRangeDateAndWord',
                base_url_data : API_BASE_CONTROLLER + 'noticeController.php?notice=noticeRangeDateAndWord',
                export : true,
                subheader : false 
              },
              base_url_data_select:  API_BASE_CONTROLLER + 'usuarioController.php?usuario=dataUsers',
              base_url_header: API_BASE_CONTROLLER + 'equipoController.php?equipo=countStatusGestion',
              base_url_to_count_search_word_controller: API_BASE_CONTROLLER + 'noticeController.php?notice=countFilterSearchController',
              base_url_to_get_search_word_controller: API_BASE_CONTROLLER + 'noticeController.php?notice=getDataSearchWordNoticeController',
              url_actions : {
                export : API_BASE_CONTROLLER + 'noticeController.php?notice=exportNotice',
                download_excel : API_BASE_EXCEL,
                delete_excel : API_BASE_URL + 'helpers/delete.php?delete=deleteExcelFile',
                showInvoice : API_BASE_URL + 'equipo/remito',
                status : API_BASE_CONTROLLER + 'equipoController.php?equipo=estados',
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
              dynamicDataToSearch : [],
              loaderLine: false,
              dataResponseDB: [],
              columns: [
                { text: 'Detalle'},
                { text: 'Aviso'},
                { text: 'Contacto'},
                { text: 'Pais'},
                { text: 'Recolector'},
                { text: 'Identificacion',},
                { text: 'Lat'},
                { text: 'Lng'},
                { text: 'Fecha'},
              ],
              loadingTable : false,
              table: false,
              displayExportFromComponentAccesores :false,
              bodyDialog: [],
              titleDialog: 'Detalle del aviso',
              templateDialog: [
              ],
              itemsButtons: [
                  
                  { title: 'Identificacion', icon: 'mdi-truck-delivery-outline', methods: '$_formId', active : true },
                  { title: 'Rango fecha', icon: 'mdi-calendar-range', methods : '$_formRangeDate', active : false },
                  { title: 'Recolector y Rango fecha', icon: 'mdi-account-clock-outline' ,methods: '$_formWordAndRangeDate', active : false },
                ],
              error: {
                type: null,
                text: null,
                time: null
              },
              subheaders : {
                active : false,
                dataResponseDB : [],
                loader : false
              },
              filter : {
                display: false,
                dynamicDataToFilter : [],
                url_searchCountController: '',
                url_searchGetDataController: '',
                filtering: false
              },
            }
        },
        methods:{
          processDataSelect(items){
            // el Items lo traigo con un $emit desde el hijo. 
            var dataProcess = items
            const returnUser = dataProcess.filter(user => user.estado === 'active')
            const finallyUser = returnUser.filter(user => user.tipoUsuario === 'recolector' || user.tipoUsuario === 'comercio' || user.tipoUsuario === 'admin')
            // filtro la data que se esta mostrando en el select
            this.dataSelect = finallyUser
          
          },
          showDataSelect(items){
            // en cada iteracion del select, se activa este metodo el cual filtra lo que quiero mostrar
            let showText = items
            return `${showText.nombre} - ${showText.localidad} - ${showText.id}`

          },
          templateDialogDetail(items){

            let name = items.name
            let aviso = items.aviso
            if(aviso === 'tomorrow'){
              aviso = 'Mañana'
            }
            if(aviso === 'route'){
              aviso = 'En ruta'
            }
            let contacto = items.contacto
            let identificacion = items.identificacion
            let created_at = items.created_at
            let lat = items.lat
            let lng = items.lng
            let direccion = items.direccion
            let localidad = items.localidad
            let provincia = items.provincia

            // Dialog template
            this.templateDialog = [ 
              {text : 'Nombre',value: name,  button:'' },
              {text : 'Aviso',value: aviso, button:'' },
              {text : 'Contacto',value: contacto, button:'' },
              {text : 'Identificación',value: identificacion, button:'' },
              {text : 'Fecha',value: created_at, button: ''},
              {text : 'Direccion del cliente',value: direccion, button: ''},
              {text : 'Localidad del cliente ',value: localidad, button: ''},
              {text : 'Provincia del cliente',value: provincia, button: ''},
              {text : 'Enviado desde', value: {
                                  lat: lat,
                                  lng: lng,
                                }
                                , button: 'Mapa'},
            ]
          },
          handle_function_call(function_name) {
            this[function_name]()
          },
         
          $_formId(){

              this.formId = true
              this.formRangeDate = false
              this.formWordAndRangeDate = false
            
              this.itemsButtons[0].active = true
              this.itemsButtons[1].active = false
              this.itemsButtons[2].active = false

              if(this.table){
                this.table= false
                this.filter.display= false
              }
          },
          $_formRangeDate(){
              
              this.formId = false
              this.formRangeDate = true
              this.formWordAndRangeDate = false

              this.itemsButtons[0].active = false
              this.itemsButtons[1].active = true
              this.itemsButtons[2].active = false
        
              if(this.table){
                this.table= false
                this.filter.display= false
              } 
          },
          $_formWordAndRangeDate(){
              
            this.formId = false
            this.formRangeDate = false
            this.formWordAndRangeDate = true

            this.itemsButtons[0].active = false
            this.itemsButtons[1].active = false
            this.itemsButtons[2].active = true
           

            if(this.table){
              this.table= false
              this.filter.display= false
            }
          },
          $_getAdmin(){

            if(document.getElementById("id_user_default") === null){
              alertNegative("Mensage Codigo 52")
              return
            }else {
              let admin =  document.getElementById("id_user_default").value
              let country = document.getElementById("id_admin").value
              this.admin = admin
              this.country_admin = country
            }
            
          }
        },
        created(){
          this.$_getAdmin()
        }
       
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

</style>
