<?php require_once 'views/layout/headerAdmin.php'; ?>

    <div id="admin-cobertura" >
            
    </div>
<!-- VUE -->

<!-- component  avisos -->
  

<script src="<?=base_url?>vue/src/components/helpers/errorGlobal.js"></script>
<script src="<?=base_url?>vue/src/components/helpers/loaderDialog.js"></script>
<script src="<?=base_url?>vue/src/components/helpers/loaderLine.js"></script>


<!-- dialog component -->
<script src="<?=base_url?>vue/src/components/dialog/reusable/fullScreen.js"></script>
<script src="<?=base_url?>vue/src/components/dialog/reusable/mediaScreen.js"></script>
<script src="<?=base_url?>vue/src/components/dialog/reusable/chooseNext.js"></script>

<!-- table component -->
<script src="<?=base_url?>vue/src/components/tables/pagination.js"></script>
<script src="<?=base_url?>vue/src/components/tables/excel.js"></script>
<script src="<?=base_url?>vue/src/components/tables/tableCobertura.js"></script>


<!-- form component -->
<script  src="<?=base_url?>vue/src/components/form/reusable/formAll.js"></script>
<script  src="<?=base_url?>vue/src/components/form/reusable/formRangeNumberAndWord.js"></script>
<script src="<?=base_url?>vue/src/components/form/reusable/filterWithPagination.js"></script>
<script src="<?=base_url?>vue/src/components/form/custom/coverage/SaveCollector.js"></script>
<script src="<?=base_url?>vue/src/components/form/custom/coverage/SaveCommerce.js"></script>
<script src="<?=base_url?>vue/src/components/form/custom/coverage/SavePoint.js"></script>
<script src="<?=base_url?>vue/src/components/form/reusable/select/AutoCompleteSimpleID.js"></script>
<script src="<?=base_url?>vue/src/components/form/reusable/select/AutoCompleteSearchID.js"></script>
<script src="<?=base_url?>vue/src/components/form/reusable/switches/switchesCommon.js"></script>
<script src="<?=base_url?>vue/src/components/form/custom/switches/switchesContent.js"></script>
<script src="<?=base_url?>vue/src/components/form/reusable/geocoding/geocodingSimple.js"></script>
<script src="<?=base_url?>vue/src/components/form/reusable/timeSchedule.js"></script>

<!-- pagination component -->
<script  src="<?=base_url?>vue/src/components/tables/pagination.js"></script>

<!-- helpers component -->
<script  src="<?=base_url?>vue/src/components/services/geocoding.js"></script>

<!-- helpers component -->
<script  src="<?=base_url?>vue/src/components/helpers/messageAlert.js"></script>
<script  src="<?=base_url?>vue/src/components/helpers/messageSnack.js"></script>

<!-- Store -->
<script src="<?=base_url?>vue/src/store/index.js"></script>
<script src="<?=base_url?>vue/src/modules/M_adminAvisos.js"></script>
<!-- views -->

<?php require_once 'views/layout/footerAdmin.php'; ?>

<script>

    Vue.config.devtools = true;
    Vue.config.debug = true;
    
  new Vue({

        el: '#admin-cobertura',
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
                      <h5 class=" color-white-custom text-center" >Cobertura por Codigo postal</h5>
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
              <div class=" d-flex justify-center align-center align-self-center flex-column" >
            
                <transition name="slide-fade">
                  <error-global 
                  v-if="error.type !== null" 
                  :error="error"
                  @clearingError="error = $event"
                  />
                </transition>

                <template v-if="showAllCoverage.display">
                    <form-all
                    :showAll="showAllCoverage"
                    @totalCountResponse = "pagination.totalCountResponse = $event"
                    @TotalPage = "pagination.totalPage = $event"
                    @dynamicDataToSearch ="dynamicDataToSearch = $event"
                    @response="table.dataResponseDB = $event"
                    @loadingTable="table.loading = $event"
                    @showTable="table.display = $event"
                    @urlTryPagination="urlTryPagination = $event"
                    @setErrorGlobal="error = $event"
                    @setShowFilter="filter.display = $event"
                    @setUrlSearchController="filter.url_searchCountController = $event"
                    @setUrlGetDataSearchController="filter.url_searchGetDataController = $event"
                    @setDataDynamicToFilter="filter.dynamicDataToFilter = $event"
                    @filtering="filter.filtering = $event"
                    @setDisplayExportExcel="displayExportFromComponentAccesores = $event"
                    :pagination="pagination"
                    @setPaginateDisplay="pagination.display = $event"
                    />
                </template>

                <template v-if="showAllEmptyCoverage.display">
                    <form-all
                    :showAll="showAllEmptyCoverage"
                    @totalCountResponse = "pagination.totalCountResponse = $event"
                    @TotalPage = "pagination.totalPage = $event"
                    @dynamicDataToSearch ="dynamicDataToSearch = $event"
                    @response="table.dataResponseDB = $event"
                    @loadingTable="table.loading = $event"
                    @showTable="table.display = $event"
                    @urlTryPagination="urlTryPagination = $event"
                    @setErrorGlobal="error = $event"
                    @setShowFilter="filter.display = $event"
                    @setUrlSearchController="filter.url_searchCountController = $event"
                    @setUrlGetDataSearchController="filter.url_searchGetDataController = $event"
                    @setDataDynamicToFilter="filter.dynamicDataToFilter = $event"
                    @filtering="filter.filtering = $event"
                    @setDisplayExportExcel="displayExportFromComponentAccesores = $event"
                    :pagination="pagination"
                    @setPaginateDisplay="pagination.display = $event"
                    />
                </template>

                <div class="d-flex justify-center  flex-row my-2">
                  <div class="mx-1">
                      <v-btn 
                          color="primary" 
                          @click="openDialogChoose('create')"
                          >
                          Crear
                      </v-btn>
                  </div>
                  <div class="mx-1" >
                      <v-btn 
                          color="orange"
                          @click="openDialogChoose('update')" 
                          >
                          Actualizar
                      </v-btn>
                  </div>
                </div>
                <template>
                      <message-snack
                      :snackbar="snackbar"
                      />
                </template>

                <template>
                  <dialog-choose-next
                  :dialogChoose="dialogChoose"
                  @next="nextChoose($event)"
                  @back="backChoose($event)"
                  />
                </template>

                <template  >
                  <d-full-screen :dialogFullScreen="dialogFullScreen"  >
                    <template v-if="save.collector.display">
                        <save-collector 
                        :pagination="pagination"  
                        :admin="admin" 
                        :save="save"
                        :dialogFullScreen="dialogFullScreen"
                        @response="table.dataResponseDB = $event"
                        @showTable="table.display = $event"
                        @filtering="filter.filtering = $event"
                        @setPaginateDisplay="pagination.display = $event"
                        @setDialogDisplay="dialogFullScreen.display = $event"
                        @setSnack="snackbar = $event"
                        />
                    </template>
                    <template v-if="save.commerce.display" >
                      <save-commerce 
                      :pagination="pagination"  
                      :admin="admin" 
                      :save="save"
                      :dialogFullScreen="dialogFullScreen"
                      @response="table.dataResponseDB = $event"
                      @showTable="table.display = $event"
                      @filtering="filter.filtering = $event"
                      @setPaginateDisplay="pagination.display = $event"
                      @setDialogDisplay="dialogFullScreen.display = $event"
                      @setSnack="snackbar = $event"
                      />
                    </template>
                    <template v-if="save.point.display" >
                      <save-point 
                      :pagination="pagination"  
                      :admin="admin" 
                      :save="save"
                      :dialogFullScreen="dialogFullScreen"
                      @response="table.dataResponseDB = $event"
                      @showTable="table.display = $event"
                      @filtering="filter.filtering = $event"
                      @setPaginateDisplay="pagination.display = $event"
                      @setDialogDisplay="dialogFullScreen.display = $event"
                      @setSnack="snackbar = $event"
                      />
                    </template>
                  </d-full-screen>
                </template>

                <template v-if="formRangeNumberAndWord.display">
                    <v-col  class="d-flex justify-center m-2"  cols="12" lg="12"  >
                      <form-number-and-word
                      />
                    </v-col>
                </template>

              </div> 
                <template v-if="table.loading" >
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
              
                <template v-if="table.display">
                    <table-cobertura
                      :admin="admin"
                      :columns="columns"
                      :table="table"
                      :url_actions="url_actions"
                      @updateDelete="table.dataResponseDB = $event"
                      :pagination="pagination"
                    />
                </template>

                <template v-if="loaderLine" >
                  <loader-line />
                </template>

                <template v-if="pagination.totalPage !== null && pagination.totalPage >0 && table.display && pagination.display">
                    <pagination-custom 
                    :pagination="pagination"
                    :urlTryPagination="urlTryPagination"
                    :loaderLine="loaderLine"
                    @setPageCurrent= "pagination.pageCurrent = $event"
                    @setFromRow="pagination.fromRow = $event"
                    @updateDataResponseDB="table.dataResponseDB = $event"
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
                dialogFullScreen : {
                  display : false,
                  title : ''
                },
                save : {
                  action : '',
                  type:'',
                  collector :{
                    display : true,
                    url_users : API_BASE_CONTROLLER + 'coberturaController.php?cobertura=getUsersCollector',
                    title_field : 'Ingrese Recolector',
                  },
                  commerce : {
                    display : false,
                    url_users : API_BASE_CONTROLLER + 'coberturaController.php?cobertura=getUsersCommerce',
                    title_field : 'Ingrese comercio',
                  },
                  point : {
                    display : false
                  },
                  zone : {
                    postal_codes : [],
                    url_country : API_BASE_CONTROLLER + 'coberturaController.php?cobertura=getCountry',
                    url_province: API_BASE_CONTROLLER + 'coberturaController.php?cobertura=getProvinceById',
                    url_locate:API_BASE_CONTROLLER + 'coberturaController.php?cobertura=getLocateById',
                    url_postalCode:API_BASE_CONTROLLER + 'coberturaController.php?cobertura=getPostalCodeByLocateAndProvinceAndCountry',
                    url_AllPointInZone:API_BASE_CONTROLLER + 'coberturaController.php?cobertura=getAllPointInZone',
                  },
                  geocoding :{
                    url: API_BASE_CONTROLLER + 'geocodingController.php?geocoding=geocoding'
                  },
                  url : {
                    save : API_BASE_CONTROLLER + 'coberturaController.php?cobertura=save',
                    getRecentCodes : API_BASE_CONTROLLER + 'coberturaController.php?cobertura=getRecentCodes'
                  }
                },  
                dialogChoose : {
                  chooseNext: {
                    display: false,
                    title:'Seleccione tipo',
                    chosenOption:'',
                    options: [
                      {text:'Recolector',value:'collector'},
                      {text:'Comercio', value: 'commerce'},
                      {text:'Correo', value:'mail'},
                      {text:'Terminal', value:'station'},
                    ],
                  }
                },
                formRangeNumberAndWord : {
                    display : true
                },
                showAllCoverage : {
                    display : false,
                    base_url_count : API_BASE_CONTROLLER + 'coberturaController.php?cobertura=countAllCoverage',
                    base_url_data : API_BASE_CONTROLLER + 'coberturaController.php?cobertura=getAllCoverage',
                    subheader: false,
                    filteringSearchWord : false,
                    export : false
                },
                showAllEmptyCoverage : {
                    display : false,
                    base_url_count : API_BASE_CONTROLLER + 'coberturaController.php?cobertura=countAllEmptyCoverage',
                    base_url_data : API_BASE_CONTROLLER + 'coberturaController.php?cobertura=getAllEmptyCoverage',
                    subheader: false,
                    filteringSearchWord : false,
                    export : false
                },
                itemsButtons:[
                    { title: 'Mostrar asignado', icon: 'mdi-account', methods: '$_showAllCoverage' , active : false, color :"bg-blue-custom" },
                    { title: 'Codigo postal', icon: 'mdi-flag-triangle', methods: '$_formRangeNumberAndWord', active :  true, color :"bg-blue-custom"},
                    { title: 'Zonas vacias', icon: 'mdi-alert', methods: '$_showAllEmptyCoverage', active :  false, color :"bg-blue-custom<"},
                ],
                admin : '',
                url_actions : {
                  export : API_BASE_CONTROLLER + 'equipoController.php?equipo=exportEquipos',
                  download_excel : API_BASE_EXCEL,
                  delete_excel : API_BASE_URL + 'helpers/delete.php?delete=deleteExcelFile',
                  showInvoice : API_BASE_URL + 'equipo/remito',
                  status : API_BASE_CONTROLLER + 'equipoController.php?equipo=estados',
                  update_management : API_BASE_CONTROLLER + 'equipoController.php?equipo=updateGestion',
                  delete_management : API_BASE_CONTROLLER + 'equipoController.php?equipo=deleteGestion',
                  send_invoice : API_BASE_URL + 'helpers/email.php?email=remito',
                  save_data_customer : API_BASE_CONTROLLER + 'equipoController.php?equipo=saveDataCustomer',
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
                columns: [
                   
                    { text: 'Codigo Postal'},
                    { text: 'Localidad'},
                    { text: 'Provincia Int'},
                    { text: 'Provincia'},
                    { text: 'Direccion'},
                    { text: 'Horarios'},
                    { text: 'Pais'},
                    { text: 'Tipo'},
                    { text: 'Nombre Asignado'},
                    { text: 'ID_asignado'},
                    { text: 'fecha'},

                ],
                table : {
                    display : false,
                    loading: false,
                    dataResponseDB: []
                },
                displayExportFromComponentAccesores :false,     
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
                snackbar :{
                  snack : false,
                  timeout : -1,
                  textSnack : ''
                }
            }
        },
        methods:{
          openDialogChoose(action){
            this.save.action = action
            this.dialogChoose.chooseNext.display = !this.dialogChoose.chooseNext.display
          },
          nextChoose(){
            var choose = this.dialogChoose.chooseNext;
            var chosenOption = choose.chosenOption
            this.save.type = chosenOption
            // type to form

            this.dialogChoose.chooseNext.display = false
            this.dialogFullScreen.display = true

          
            if(this.save.type === 'collector'){
                this.save.action === 'create' ? this.dialogFullScreen.title = 'Crear zona para Recolector' : '';
                this.save.action === 'update' ? this.dialogFullScreen.title = 'Actualizar zona para Recolector' : '';
                //show or hide others form
                this.save.collector.display = true
                this.save.commerce.display = false
                this.save.point.display = false
              }
            if(this.save.type === 'commerce'){
              this.save.action === 'create' ? this.dialogFullScreen.title = 'Crear zona para Comercio' : '';
              this.save.action === 'update' ? this.dialogFullScreen.title = 'Actualizar zona para Comercio' : '';
                //show or hide others form
                this.save.commerce.display = true
                this.save.collector.display = false
                this.save.point.display = false
              }
            if(this.save.type === 'mail' || this.save.type === 'station'){
                if(this.save.type === 'mail'){
                this.save.action === 'create' ? this.dialogFullScreen.title = 'Crear zona para Correo' : '';
                this.save.action === 'update' ? this.dialogFullScreen.title = 'Actualizar zona para Correo' : '';
                }
                if(this.save.type === 'station'){
                this.save.action === 'create' ? this.dialogFullScreen.title = 'Crear zona para Terminal' : '';
                this.save.action === 'update' ? this.dialogFullScreen.title = 'Actualizar zona para Terminal' : '';
                }
                //show or hide others form
                this.save.point.display = true
                this.save.collector.display = false
                this.save.commerce.display = false
              }
              // this.dialogChoose.chooseNext.chosenOption = ''
          },
          backChoose(){
            this.dialogChoose.chooseNext.chosenOption = '';
          },
          handle_function_call(function_name) {
            this[function_name]()
          },
          $_showAllCoverage(){
             if(!this.showAllCoverage.display){
              this.showAllCoverage.display = true
              this.$nextTick(() => {
                this.formRangeNumberAndWord.display = false
                this.showAllEmptyCoverage.display = false
                
                this.itemsButtons[0].active = true //todo
                this.itemsButtons[1].active = false //rangeNumber
                this.itemsButtons[2].active = false //empty
                this.tableAndAccesorys()
              });
             }
          },
          $_showAllEmptyCoverage(){
              if(!this.showAllEmptyCoverage.display){
              this.showAllCoverage.display = false  
              this.$nextTick(() => {
                this.formRangeNumberAndWord.display = false,
                this.showAllEmptyCoverage.display = true
        
                this.itemsButtons[0].active = false //todo
                this.itemsButtons[1].active = false //rangeNumber
                this.itemsButtons[2].active = true //empty
                this.tableAndAccesorys()
              });
              }
          },
          $_formRangeNumberAndWord(){
            if(!this.formRangeNumberAndWord.display){
              this.showAllCoverage.display = false
              this.showAllEmptyCoverage.display = false
              this.formRangeNumberAndWord.display = true,

              this.itemsButtons[0].active = false //todo
              this.itemsButtons[1].active = true //rangeNumber
              this.itemsButtons[2].active = false //empty

              this.tableAndAccesorys()
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
            
          },
          tableAndAccesorys(){
            if(this.table.display){
              this.table.display = false
            }
          }
        },
        created(){
          this.$_getAdmin()
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
  

    
</style>
