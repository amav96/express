<?php require_once 'views/layout/headerAdmin.php'; ?>

    <div id="admin-notices" >
            
    </div>
<!-- VUE -->

<!-- component  avisos -->
  

<script src="<?=base_url?>vue/src/components/helpers/errorGlobal.js?v=11062021"></script>
<script src="<?=base_url?>vue/src/components/helpers/loaderDialog.js?v=11062021"></script>
<script src="<?=base_url?>vue/src/components/helpers/loaderLine.js?v=11062021"></script>


<!-- dialog component -->

<script src="<?=base_url?>vue/src/components/dialog/detailNotice.js?v=11062021"></script>

<!-- table component -->
<script src="<?=base_url?>vue/src/components/tables/pagination.js?v=11062021"></script>
<script src="<?=base_url?>vue/src/components/tables/excel.js?v=11062021"></script>
<script src="<?=base_url?>vue/src/components/tables/tableAvisos.js?v=11062021"></script>


<!-- form component -->
<script  src="<?=base_url?>vue/src/components/form/reusable/formSearchByWordAndDate.js?v=11062021"></script>
<script src="<?=base_url?>vue/src/components/form/reusable/formSearchDate.js?v=11062021"></script>
<script src="<?=base_url?>vue/src/components/form/reusable/formSearchWord.js?v=11062021"></script>
<script src="<?=base_url?>vue/src/components/form/reusable/filterWithPagination.js?v=11062021"></script>
<script src="<?=base_url?>vue/src/components/form/reusable/select/AutoCompleteSimpleID.js?v=11062021"></script>


<!-- pagination component -->
<script  src="<?=base_url?>vue/src/components/tables/pagination.js?v=11062021"></script>

<!-- helpers component -->
<script  src="<?=base_url?>vue/src/components/helpers/messageAlert.js?v=11062021"></script>
<script  src="<?=base_url?>vue/src/components/helpers/messageSnack.js?v=11062021"></script>

<!-- Store -->
<script src="<?=base_url?>vue/src/store/index.js?v=11062021"></script>
<script src="<?=base_url?>vue/src/modules/M_adminAvisos.js?v=11062021"></script>
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
                      :resources="searchByWord"
                      :pagination="pagination"
                      @showPagination="pagination.display = $event"
                      @resetPagination="pagination = $event"
                      @loadingTable="table.loading = $event"
                      @totalCountResponse = "pagination.totalCountResponse = $event"
                      @TotalPage = "pagination.totalPage = $event"
                      @setParametersDynamicToPagination ="parametersDynamicToPaginate = $event"
                      @response="table.dataResponseDB = $event"
                      @showTable="table.display = $event"
                      @setErrorGlobal="error = $event"
                      @setExportDisplay="exportExcel.display = $event"
                      @setParametersToExport="exportExcel.parameters = $event"
                      @setUrlExport="exportExcel.url = $event"
                      @setParametersToFilter="filter.parameters = $event"
                      @setShowFilter="filter.display = $event"
                      @setUrlFilter="filter.url = $event"
                      @filtering="filter.filtering = $event"
                      @urlTryPagination="urlTryPagination = $event"
                      @setSubHeadersDataResponseDB="subheaders.dataResponseDB = $event"
                      @setSubHeadersLoader="subheaders.loader = $event" 
                      @setDisplayHeaders="subheaders.active = $event"
                      />
                    </v-col>
                </template>

                <template v-if="formRangeDate">
                  <v-col class="d-flex justify-center m-2" cols="12" lg="12"  >
                    <form-search-date
                      :resources="searchByRangeDate"
                      :pagination="pagination"
                      @showPagination="pagination.display = $event"
                      @resetPagination="pagination = $event"
                      @loadingTable="table.loading = $event"
                      @totalCountResponse = "pagination.totalCountResponse = $event"
                      @TotalPage = "pagination.totalPage = $event"
                      @setParametersDynamicToPagination ="parametersDynamicToPaginate = $event"
                      @response="table.dataResponseDB = $event"
                      @showTable="table.display = $event"
                      @setErrorGlobal="error = $event"
                      @setExportDisplay="exportExcel.display = $event"
                      @setExportByFilterDisplay="filter.export.display = $event"
                      @setParametersToExport="exportExcel.parameters = $event"
                      @setUrlExport="exportExcel.url = $event"
                      @setUrlFilterExportExcel="filter.export.url = $event"
                      @setParametersToFilter="filter.parameters = $event"
                      @setShowFilter="filter.display = $event"
                      @setUrlFilter="filter.url = $event"
                      @filtering="filter.filtering = $event"
                      @urlTryPagination="urlTryPagination = $event"
                      @setSubHeadersDataResponseDB="subheaders.dataResponseDB = $event"
                      @setSubHeadersLoader="subheaders.loader = $event"   
                      @setDisplayHeaders="subheaders.active = $event"
                    />
                    </v-col>
                </template>

                
                <template v-if="formWordAndRangeDate">
                  <v-col class=" d-flex justify-center m-2" cols="12" lg="12" >
                      <form-search-by-word-and-range-date
                      :resources="searchByWordAndRangeDate"
                      :pagination="pagination"
                      @showPagination="pagination.display = $event"
                      @resetPagination="pagination = $event"
                      @loadingTable="table.loading = $event"
                      @totalCountResponse = "pagination.totalCountResponse = $event"
                      @TotalPage = "pagination.totalPage = $event"
                      @setParametersDynamicToPagination ="parametersDynamicToPaginate = $event"
                      @response="table.dataResponseDB = $event"
                      @showTable="table.display = $event"
                      @setErrorGlobal="error = $event"
                      @setExportDisplay="exportExcel.display = $event"
                      @setExportByFilterDisplay="filter.export.display = $event"
                      @setParametersToExport="exportExcel.parameters = $event"
                      @setUrlExport="exportExcel.url = $event"
                      @setUrlFilterExportExcel="filter.export.url = $event"
                      @setParametersToFilter="filter.parameters = $event"
                      @setShowFilter="filter.display = $event"
                      @setUrlFilter="filter.url = $event"
                      @filtering="filter.filtering = $event"
                      @urlTryPagination="urlTryPagination = $event"
                      @setSubHeadersDataResponseDB="subheaders.dataResponseDB = $event"
                      @setSubHeadersLoader="subheaders.loader = $event"   
                      @setDisplayHeaders="subheaders.active = $event"
                      />
                      </v-col>
                </template>  
              </div> 

              <template v-if="table.loading" >
                 <loader-line />
                </template>
            
                <template v-if="subheaders.loader" >
                 <loader-line />
                </template>

                <template v-if="showTable() && subheaders.active ">
                    <sub-headers
                    @setDisplayHeaders="subheaders.active = $event"
                    :subheaders="subheaders"
                    />
                </template>

                <template v-if="showTable() && filter.display">
                    <filter-with-pagination
                    :pagination = "pagination"
                    :filter="filter"
                    :dataResponseDB="table.dataResponseDB" 
                    :parametersDynamicToPaginate="parametersDynamicToPaginate"
                    :urlTryPagination="urlTryPagination"
                    @setFlagFiltering ="filter.filtering = $event"
                    @setAfterDataResponse="table.dataResponseDB = $event"
                    @setPagination="pagination = $event"
                    @urlTryPagination="urlTryPagination = $event"
                    @setParametersDynamicToPagination="parametersDynamicToPaginate = $event" 
                    @setParametersToExportExcel="exportExcel.parameters = $event"
                    @restoreUrlPagination="urlTryPagination = $event"
                    @restoreOldPagination="pagination = $event"
                    @restoreOldParametersToCall="parametersDynamicToPaginate = $event"
                    @restoreOldDataResponse="table.dataResponseDB = $event"
                    @restoreBeforeDataResponse="table.dataResponseDB = $event"
                    @setUrlExportByFilter="exportExcel.url = $event"
                    />
                </template>

                <template v-if="showTable() && exportExcel.display">
                  <div>
                    <v-row class="justify-center align-items-center align-content-center">
                      <excel-export
                      :exportExcel="exportExcel"
                      />
                    </v-row>
                  </div>
                </template>

                <template>
                    <v-btn
                      v-if="showTable()"
                      >
                      Total Registros <strong> &nbsp; {{pagination.totalCountResponse}}</strong>
                    </v-btn>
                </template>
        
                <template v-if="showTable()">
                    <table-avisos
                      :admin="admin"
                      :columns="columns"
                      :loadingTable="loadingTable"
                      :table="table"
                      :url_actions="url_actions"
                      :pagination="pagination"
                      @setSnackbar="snackbar = $event"
                     
                    />
                </template>

                <template v-if="loaderLine" >
                  <loader-line />
                </template>

                <template v-if="showTable()">
                    <pagination-custom 
                    :pagination="pagination"
                    :urlTryPagination="urlTryPagination"
                    :loaderLine="loaderLine"
                    @setPageCurrent= "pagination.pageCurrent = $event"
                    @setFromRow="pagination.fromRow = $event"
                    @updateDataResponseDB="table.dataResponseDB = $event"
                    @showLoaderLine="loaderLine =  $event"
                    :parametersDynamicToPaginate="parametersDynamicToPaginate"
                    @updateDynamicParametersToCall="parametersDynamicToPaginate = $event"
                    @restauratePagination="pagination = $event"
                    />
                </template>

                <template>
                    <message-snack
                    :snackbar="snackbar"
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
                    display : false,
                    url: {
                      getData : API_BASE_CONTROLLER + 'noticeController.php?notice=getNoticeByWord',
                    },
                    subheader: {
                      display : false,
                      url :''
                    },
                    filter : {
                      display: false,
                      url : ''
                    },
                    export : {
                      display : false,
                      url: API_BASE_CONTROLLER + 'noticeController.php?notice=exportNotice',
                      url_filter: '',
                    },
                    select : {
                      display: false,
                      url : '',
                      title: '',
                      class: '',
                      outlined: false,
                      dense: false
                    },
                    pagination:true,
              },
              searchByRangeDate : {
                    display : false,
                    url: {
                      getData : API_BASE_CONTROLLER + 'noticeController.php?notice=getNoticeRangeDate',
                    },
                    subheader: {
                      display : false,
                      url :''
                    },
                    filter : {
                      display: false,
                      url : ''
                    },
                    export : {
                      display : true,
                      url: API_BASE_CONTROLLER + 'noticeController.php?notice=exportNotice',
                      url_filter: '',
                    },
                    select : {
                      display: false,
                      url : '',
                      title: '',
                      class: '',
                      outlined: false,
                      dense: false
                    },
                    pagination:true,
              },
              searchByWordAndRangeDate: {
                    display : false,
                    url: {
                      getData : API_BASE_CONTROLLER + 'noticeController.php?notice=noticeRangeDateAndWord',
                    },
                    subheader: {
                      display : false,
                      url :''
                    },
                    filter : {
                      display: false,
                      url : ''
                    },
                    export : {
                      display : true,
                      url: API_BASE_CONTROLLER + 'noticeController.php?notice=exportNotice',
                      url_filter: '',
                    },
                    select : {
                      display: true,
                      url : API_BASE_CONTROLLER + 'noticeController.php?notice=getAllUserCollectorAndCommerce',
                      title: 'Usuario',
                      class: 'mx-4',
                      outlined: false,
                      dense: false
                    },
                    pagination:true,
              },
              url_actions : {
                showInvoice : API_BASE_URL + 'equipo/remito',
                status : '',
                delete_excel : API_BASE_URL + 'helpers/delete.php?delete=deleteExcelFile',
                download_excel : API_BASE_EXCEL,
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
                  display: false,
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
              table : {
                    display : false,
                    loading: false,
                    dataResponseDB: []
                },
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
              snackbar:{
                display:false,
                text:'',
                timeout:-1,
                color:''
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

              if(this.table.display){
                this.table.display= false
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
        
              if(this.table.display){
                this.table.display= false
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
           

            if(this.table.display){
              this.table.display= false
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
            
          },
          showTable(){
            if(this.table.display && this.pagination.totalCountResponse>0){
              return true
            }else {
              return false
            }
          }
        },
        created(){
          this.$_getAdmin()
        }
       
    })
</script>
