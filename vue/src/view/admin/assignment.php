<?php require_once 'views/layout/headerAdmin.php'; ?>

    <div id="admin-assignment" >
            
    </div>
<!-- VUE -->
<!-- helpers -->
<script src="<?=base_url?>vue/src/components/helpers/errorGlobal.js"></script>
<script src="<?=base_url?>vue/src/components/helpers/loaderLine.js"></script>
<script  src="<?=base_url?>vue/src/components/helpers/messageSnack.js"></script>

<!-- mixin -->
<script  src="<?=base_url?>vue/src/mixins/custom/assignment/MtableAssignment.js"></script>

<!-- dialog -->
<script  src="<?=base_url?>vue/src/components/dialog/reusable/smallScreen.js"></script>
<!-- table -->
<script  src="<?=base_url?>vue/src/components/tables/custom/assignment/tableAssignment"></script>
<script src="<?=base_url?>vue/src/components/tables/pagination.js"></script>

<!-- form component -->
<script  src="<?=base_url?>vue/src/components/form/reusable/conditionBtn.js"></script>
<script  src="<?=base_url?>vue/src/components/form/reusable/conditionSelectRange.js"></script>
<script  src="<?=base_url?>vue/src/components/form/reusable/formId.js"></script>
<script  src="<?=base_url?>vue/src/components/form/reusable/formAll.js"></script>
<script  src="<?=base_url?>vue/src/components/form/reusable/formRangeNumberAndWord.js"></script>
<script  src="<?=base_url?>vue/src/components/form/reusable/select/AutoCompleteSimpleID.js"></script>
<script  src="<?=base_url?>vue/src/components/form/reusable/select/AutoCompleteStatic.js"></script>
<script  src="<?=base_url?>vue/src/components/form/custom/assignment/manualAssignment.js"></script>
<script src="<?=base_url?>vue/src/components/form/reusable/filterWithPagination.js"></script>
<script src="<?=base_url?>vue/src/store/index.js?"></script>


    <!-- headers component -->
<script  src="<?=base_url?>vue/src/components/headers/reusable/headerAdmin.js"></script>
<!-- views -->

<?php require_once 'views/layout/footerAdmin.php'; ?>

<script>
    Vue.config.devtools = true;
    Vue.config.debug = true;
  new Vue({
        el: '#admin-assignment',
        vuetify: new Vuetify(),
        store,
        template : //html 
        `
        <v-app class="empujarParaArriba elevation" >

          <v-btn
            v-scroll="onScroll"
            v-show="fab"
            fab
            dark
            fixed
            bottom
            right
            color="info"
            @click="toTop"
          >
            <v-icon>mdi-chevron-up</v-icon>
          </v-btn>

           <header-admin 
           title="Asignación de bases"
           :loading="MAINRESOURCES.table.loading || MAINRESOURCES.loadingPaginate.display"
           :MAINRESOURCES="MAINRESOURCES"
           @handle_function_call="handle_function_call($event)"
            />
           
            <div class="d-flex justify-center align-center align-self-center flex-row my-2" >
              <template v-if="allDataBase.display">
                      <form-all
                        :resources="allDataBase"
                        :pagination="MAINRESOURCES.pagination"
                        @showPagination="MAINRESOURCES.pagination.display = $event"
                        @resetPagination="MAINRESOURCES.pagination = $event"
                        @loadingTable="MAINRESOURCES.table.loading = $event"
                        @showLoaderLine="MAINRESOURCES.loadingPaginate.display =  $event"
                        @totalCountResponse = "MAINRESOURCES.pagination.totalCountResponse = $event"
                        @TotalPage = "MAINRESOURCES.pagination.totalPage = $event"
                        @setParametersDynamicToPagination ="MAINRESOURCES.parametersDynamicToPaginate = $event"
                        @response="MAINRESOURCES.table.dataResponseDB = $event"
                        @showTable="MAINRESOURCES.table.display = $event"
                        @setErrorGlobal="MAINRESOURCES.error = $event"
                        @setExportDisplay="MAINRESOURCES.exportExcel.display = $event"
                        @setExportByFilterDisplay="MAINRESOURCES.filter.export.display = $event"
                        @setParametersToExport="MAINRESOURCES.exportExcel.parameters = $event"
                        @setUrlExport="MAINRESOURCES.exportExcel.url = $event"
                        @setUrlFilterExportExcel="MAINRESOURCES.filter.export.url = $event"
                        @setParametersToFilter="MAINRESOURCES.filter.parameters = $event"
                        @setShowFilter="MAINRESOURCES.filter.display = $event"
                        @setUrlFilter="MAINRESOURCES.filter.url = $event"
                        @filtering="MAINRESOURCES.filter.filtering = $event"
                        @urlTryPagination="MAINRESOURCES.urlTryPagination = $event"
                        @setSubHeadersDataResponseDB="MAINRESOURCES.subheaders.dataResponseDB = $event"
                        @setSubHeadersLoader="MAINRESOURCES.subheaders.loader = $event"   
                        @setDisplayHeaders="MAINRESOURCES.subheaders.active = $event"
                        @cleanCondition="$_cleanCondition($event)"
                        @showCondition="MAINRESOURCES.condition.display = $event"
                      />
              </template>

              <template v-if="dataBaseByPostalCode.display">
                  <form-number-and-word
                    :resources="dataBaseByPostalCode"
                    :pagination="MAINRESOURCES.pagination"
                    @showPagination="MAINRESOURCES.pagination.display = $event"
                    @resetPagination="MAINRESOURCES.pagination = $event"
                    @loadingTable="MAINRESOURCES.table.loading = $event"
                    @totalCountResponse = "MAINRESOURCES.pagination.totalCountResponse = $event"
                    @TotalPage = "MAINRESOURCES.pagination.totalPage = $event"
                    @setParametersDynamicToPagination ="MAINRESOURCES.parametersDynamicToPaginate = $event"
                    @response="MAINRESOURCES.table.dataResponseDB = $event"
                    @showTable="MAINRESOURCES.table.display = $event"
                    @setErrorGlobal="MAINRESOURCES.error = $event"
                    @setExportDisplay="MAINRESOURCES.exportExcel.display = $event"
                    @setExportByFilterDisplay="MAINRESOURCES.filter.export.display = $event"
                    @setParametersToExport="MAINRESOURCES.exportExcel.parameters = $event"
                    @setUrlExport="MAINRESOURCES.exportExcel.url = $event"
                    @setUrlFilterExportExcel="MAINRESOURCES.filter.export.url = $event"
                    @setParametersToFilter="MAINRESOURCES.filter.parameters = $event"
                    @setShowFilter="MAINRESOURCES.filter.display = $event"
                    @setUrlFilter="MAINRESOURCES.filter.url = $event"
                    @filtering="MAINRESOURCES.filter.filtering = $event"
                    @urlTryPagination="MAINRESOURCES.urlTryPagination = $event"
                    @setSubHeadersDataResponseDB="MAINRESOURCES.subheaders.dataResponseDB = $event"
                    @setSubHeadersLoader="MAINRESOURCES.subheaders.loader = $event"   
                    @setDisplayHeaders="MAINRESOURCES.subheaders.active = $event" 
                    @cleanFilter="$_cleanFilter($event)"  
                    @cleanCondition="$_cleanCondition($event)"   
                    @handlerCondition="handlerCondition($event)"   
                  />
              </template>

              <template v-if="dataBaseByPurse.display" >
                  <form-id
                      :resources="dataBaseByPurse"
                      :pagination="MAINRESOURCES.pagination"
                      @showPagination="MAINRESOURCES.pagination.display = $event"
                      @resetPagination="MAINRESOURCES.pagination = $event"
                      @loadingTable="MAINRESOURCES.table.loading = $event"
                      @totalCountResponse = "MAINRESOURCES.pagination.totalCountResponse = $event"
                      @TotalPage = "MAINRESOURCES.pagination.totalPage = $event"
                      @setParametersDynamicToPagination ="MAINRESOURCES.parametersDynamicToPaginate = $event"
                      @response="MAINRESOURCES.table.dataResponseDB = $event"
                      @setAuxResponse="MAINRESOURCES.table.auxDataResponseDB = $event"
                      @showTable="MAINRESOURCES.table.display = $event"
                      @setErrorGlobal="MAINRESOURCES.error = $event"
                      @setExportDisplay="MAINRESOURCES.exportExcel.display = $event"
                      @setExportByFilterDisplay="MAINRESOURCES.filter.export.display = $event"
                      @setParametersToExport="MAINRESOURCES.exportExcel.parameters = $event"
                      @setUrlExport="MAINRESOURCES.exportExcel.url = $event"
                      @setUrlFilterExportExcel="MAINRESOURCES.filter.export.url = $event"
                      @setParametersToFilter="MAINRESOURCES.filter.parameters = $event"
                      @setShowFilter="MAINRESOURCES.filter.display = $event"
                      @setUrlFilter="MAINRESOURCES.filter.url = $event"
                      @filtering="MAINRESOURCES.filter.filtering = $event"
                      @urlTryPagination="MAINRESOURCES.urlTryPagination = $event"
                      @setSubHeadersDataResponseDB="MAINRESOURCES.subheaders.dataResponseDB = $event"
                      @setSubHeadersLoader="MAINRESOURCES.subheaders.loader = $event"   
                      @setDisplayHeaders="MAINRESOURCES.subheaders.active = $event"
                      @cleanFilter="$_cleanFilter($event)"
                      @cleanCondition="$_cleanCondition($event)"
                      @handlerCondition="handlerCondition($event)"

                  />
              </template>

              <template v-if="dataBaseByUserAssigned.display" >
                  <form-id
                      :resources="dataBaseByUserAssigned"
                      :pagination="MAINRESOURCES.pagination"
                      @showPagination="MAINRESOURCES.pagination.display = $event"
                      @resetPagination="MAINRESOURCES.pagination = $event"
                      @loadingTable="MAINRESOURCES.table.loading = $event"
                      @totalCountResponse = "MAINRESOURCES.pagination.totalCountResponse = $event"
                      @TotalPage = "MAINRESOURCES.pagination.totalPage = $event"
                      @setParametersDynamicToPagination ="MAINRESOURCES.parametersDynamicToPaginate = $event"
                      @response="MAINRESOURCES.table.dataResponseDB = $event"
                      @showTable="MAINRESOURCES.table.display = $event"
                      @setErrorGlobal="MAINRESOURCES.error = $event"
                      @setExportDisplay="MAINRESOURCES.exportExcel.display = $event"
                      @setExportByFilterDisplay="MAINRESOURCES.filter.export.display = $event"
                      @setParametersToExport="MAINRESOURCES.exportExcel.parameters = $event"
                      @setUrlExport="MAINRESOURCES.exportExcel.url = $event"
                      @setUrlFilterExportExcel="MAINRESOURCES.filter.export.url = $event"
                      @setParametersToFilter="MAINRESOURCES.filter.parameters = $event"
                      @setShowFilter="MAINRESOURCES.filter.display = $event"
                      @setUrlFilter="MAINRESOURCES.filter.url = $event"
                      @filtering="MAINRESOURCES.filter.filtering = $event"
                      @urlTryPagination="MAINRESOURCES.urlTryPagination = $event"
                      @setSubHeadersDataResponseDB="MAINRESOURCES.subheaders.dataResponseDB = $event"
                      @setSubHeadersLoader="MAINRESOURCES.subheaders.loader = $event"   
                      @setDisplayHeaders="MAINRESOURCES.subheaders.active = $event"
                      @cleanFilter="$_cleanFilter($event)"
                      @cleanCondition="$_cleanCondition($event)"
                      @handlerCondition="handlerCondition($event)"
                  />
              </template>

            </div>

              <template v-if="MAINRESOURCES.error.display && !MAINRESOURCES.table.display">
                <v-alert class="ma-4 my-6" dense outlined type="error">
                    {{MAINRESOURCES.error.text}}
                </v-alert>
              </template>

              <template v-if="MAINRESOURCES.table.loading && allDataBase.display" >
                  <v-skeleton-loader
                    type="date-picker"
                  ></v-skeleton-loader>
                </template>
                <template v-if="MAINRESOURCES.table.loading && !allDataBase.display">
                  <loader-line />
                </template>
              
              <template v-if="showTableAssignment && MAINRESOURCES.condition.display">
                <v-container >
                  <v-row class="d-flex justify-start flex-row">
                    <v-col  cols="12" xl="6" lg="6" class="py-0">
                      <condition-btn
                      property='assigned'
                      :resources="MAINRESOURCES"
                      :disabledByLoading="disabledByLoading"
                      @setErrorCondition="MAINRESOURCES.snackbar = $event"
                      @setDataResponse="MAINRESOURCES.table.dataResponseDB = $event"
                      @setPagination="MAINRESOURCES.pagination = $event"
                      @setParametersDynamicToPagination="MAINRESOURCES.parametersDynamicToPaginate = $event" 
                      @showPagination="MAINRESOURCES.pagination.display = $event"
                      @showLoading="MAINRESOURCES.loadingPaginate.display = $event"
                      ref="setCondition"
                      />
                    </v-col>
                    <template v-if="showTableAssignment && MAINRESOURCES.sectionCurrent === 'purse'">
                   
                      <v-col cols="12" xl="5" lg="5"  class="py-0">
                        <v-card>
                          <v-card-title>
                            Filtrar por rango codigo postal
                            <v-icon right>
                            mdi-filter
                            </v-icon>
                          </v-card-title>
                        <v-card-text>
                          <condition-select-range
                          :section="dataBaseByPurse" 
                          :load="MAINRESOURCES.table.auxDataResponseDB" 
                          :resources="MAINRESOURCES" />
                        </v-card-text>
                          
                        </v-card>
                      </v-col>
                    
                     
                    </template>
                  </v-row>
                </v-container>
              </template>

                <template v-if="showTableAssignment && MAINRESOURCES.pagination.totalCountResponse>0" >
                  <div class="my-2 mt-4 d-flex justify-center" >
                          Cerca de <strong> &nbsp;{{new Intl.NumberFormat("de-ES").format(MAINRESOURCES.pagination.totalCountResponse)}} </strong>&nbsp; resultados 
                  </div>
                </template>

                <template v-if="showTableAssignment && MAINRESOURCES.pagination.display">
                  <pagination-custom 
                    :reload="MAINRESOURCES.reload"
                    :pagination="MAINRESOURCES.pagination"
                    :select ="MAINRESOURCES.select"
                    @cleanSelected="$_cleanSelected($event)"
                    :urlTryPagination="MAINRESOURCES.urlTryPagination"
                    @setPageCurrent= "MAINRESOURCES.pagination.pageCurrent = $event"
                    @setFromRow="MAINRESOURCES.pagination.fromRow = $event"
                    @updateDataResponseDB="MAINRESOURCES.table.dataResponseDB = $event"
                    @updateTotalCount="MAINRESOURCES.pagination.totalCountResponse = $event"
                    @showLoaderLine="MAINRESOURCES.loadingPaginate.display =  $event"
                    :parametersDynamicToPaginate="MAINRESOURCES.parametersDynamicToPaginate"
                    @updateDynamicParametersToCall="MAINRESOURCES.parametersDynamicToPaginate = $event"
                    @restauratePagination="MAINRESOURCES.pagination = $event"
                    ref="pagination"
                  />
                </template>

                <template v-if="MAINRESOURCES.loadingPaginate.display" >
                 <loader-line />
                </template>

                <template v-if="showTableAssignment && MAINRESOURCES.filter.display">
                    <filter-with-pagination
                    :condition="MAINRESOURCES.condition"
                    :pagination = "MAINRESOURCES.pagination"
                    :exportExcel ="MAINRESOURCES.exportExcel"
                    :filter="MAINRESOURCES.filter"
                    :select ="MAINRESOURCES.select"
                    :dataResponseDB="MAINRESOURCES.table.dataResponseDB" 
                    :parametersDynamicToPaginate="MAINRESOURCES.parametersDynamicToPaginate"
                    :urlTryPagination="MAINRESOURCES.urlTryPagination"
                    @setFlagFiltering ="MAINRESOURCES.filter.filtering = $event"
                    @setAfterDataResponse="MAINRESOURCES.table.dataResponseDB = $event"
                    @setPagination="MAINRESOURCES.pagination = $event"
                    @urlTryPagination="MAINRESOURCES.urlTryPagination = $event"
                    @setParametersDynamicToPagination="MAINRESOURCES.parametersDynamicToPaginate = $event" 
                    @setParametersToExportExcel="MAINRESOURCES.exportExcel.parameters = $event"
                    @restoreUrlPagination="MAINRESOURCES.urlTryPagination = $event"
                    @restoreOldPagination="MAINRESOURCES.pagination = $event"
                    @restoreOldParametersToCall="MAINRESOURCES.parametersDynamicToPaginate = $event"
                    @restoreOldDataResponse="MAINRESOURCES.table.dataResponseDB = $event"
                    @restoreBeforeDataResponse="MAINRESOURCES.table.dataResponseDB = $event"
                    @setUrlExportByFilter="MAINRESOURCES.exportExcel.url = $event"
                    @setOldUrlExport="MAINRESOURCES.exportExcel.url = $event"
                    @cleanCondition="$_cleanCondition($event)"
                    ref="setFilter"
                    />
                </template>
            
                <template v-if="showTableAssignment">
                  <template>
                    <table-assignment 
                    :resources="MAINRESOURCES" 
                    :columns="allDataBase.table.columns"
                    :manualAssignment="manualAssignment"
                    :disabledByLoading="disabledByLoading"
                    @setLoader="MAINRESOURCES.loadingPaginate.display"
                    @setSelected="MAINRESOURCES.select.selected = $event"
                    @realoadCurrentPage="$_realoadCurrentPage($event)"
                    @reaload="MAINRESOURCES.reload = $event"
                    @setSnack="MAINRESOURCES.snackbar = $event"
                    @cleanSectionCurrent="MAINRESOURCES.sectionCurrent = $event"
                    ref="assignment"
                    />
                  </template>
                </template>

                <template>
                      <message-snack
                      :snackbar="MAINRESOURCES.snackbar"
                      />
                </template>
         
        </v-app>
        `,
        computed:{
          showTableAssignment(){
            if(this.MAINRESOURCES.table.display){
              return true
            }else {return false}
          },
          disabledByLoading(){
            if(this.MAINRESOURCES.loadingPaginate.display || this.MAINRESOURCES.table.loading){
              return true
            }else {return false}
          }
    
        },
        data(){
            return {
                allDataBase:{
                    display : true,
                    url: {
                      getData : API_BASE_CONTROLLER + 'asignacionController.php?asignacion=getAllEquipos',
                     
                    },
                    subheader: {
                      display : false,
                      url :''
                    },
                    filter : {
                      display: true,
                      url : API_BASE_CONTROLLER + 'asignacionController.php?asignacion=getFilterEquipos'
                    },
                    export : {
                      display : true,
                      url: API_BASE_CONTROLLER + 'coberturaController.php?cobertura=exportAllCoverage',
                      url_filter: API_BASE_CONTROLLER + 'coberturaController.php?cobertura=exportFilterCoverage',
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
                    table: {
                      columns: [
                        { text: '',icon : 'mdi-select-multiple',alt_icon:'mdi-selection-off' , method: '$_selectAll'},
                        { text: 'Codigo postsal'},
                        { text: 'Localidad'},
                        { text: 'Provincia'},
                        { text: 'Direccion'},
                        { text: 'Identificacion'},
                        { text: 'Serie'},
                        { text: 'Pertenece a'},
                        { text: 'Asignado'},
                        { text: 'Cartera'},
                        { text: 'Estado'},
                        { text: 'Nombre C.'},
                        { text: 'Empresa'},   
                      ],
                   
                    }, 
                    condition: {
                      display : true
                    }
                   
                },
                dataBaseByPostalCode : {
                    display : false,
                    url: {
                      getData : API_BASE_CONTROLLER + 'asignacionController.php?asignacion=getEquiposByPostalCodeRangeAndCountry',
                    },
                    subheader: {
                      display : false,
                      url :''
                    },
                    filter : {
                      display: true,
                      url : API_BASE_CONTROLLER + 'asignacionController.php?asignacion=getFilterEquiposByPostalCodeRangeAndCountry'
                    },
                    export : {
                      display : false,
                      url: API_BASE_CONTROLLER + 'coberturaController.php?cobertura=exportCoveragePostalCodeRangeAndCountry',
                      url_filter: API_BASE_CONTROLLER + 'coberturaController.php?cobertura=exportFilterCoveragePostalCodeRangeAndCountry',
                    },
                    select : {
                      display: false,
                      url : API_BASE_CONTROLLER + 'coberturaController.php?cobertura=getCountry',
                      title: 'Pais',
                      class: '',
                      outlined: false,
                      dense: false
                    },
                    pagination:true, 
                    condition: {
                      display : true
                    }
                },
                dataBaseByPurse : {
                    display : false,
                    url: {
                      getData : API_BASE_CONTROLLER + 'asignacionController.php?asignacion=getEquiposByPurse',
                    },
                    subheader: {
                      display : false,
                      url :''
                    },
                    filter : {
                      display: true,
                      url : API_BASE_CONTROLLER + 'asignacionController.php?asignacion=getFilterEquiposByPurse'
                    },
                    export : {
                      display : false,
                      url: API_BASE_CONTROLLER + 'coberturaController.php?cobertura=exportCoveragePostalCodeRangeAndCountry',
                      url_filter: API_BASE_CONTROLLER + 'coberturaController.php?cobertura=exportFilterCoveragePostalCodeRangeAndCountry',
                    },
                    select : {
                      display: false,
                      url : API_BASE_CONTROLLER + 'asignacionController.php?asignacion=getAllWallets',
                      title: 'Cartera',
                      class: '',
                      outlined: false,
                      dense: false
                    },
                    pagination:true, 
                    condition: {
                      class:"mx-2 my-2",
                      outlined:false,
                      dense: true,
                      label:'Codigo postales',
                      display: true
                    },
                    response:{
                      data:[],
                      auxData:[]
                    }
                },
                dataBaseByUserAssigned: {

                  display : false,
                    url: {
                      getData : API_BASE_CONTROLLER + 'asignacionController.php?asignacion=getEquiposByUserAssigned',
                    },
                    subheader: {
                      display : false,
                      url :''
                    },
                    filter : {
                      display: true,
                      url : API_BASE_CONTROLLER + 'asignacionController.php?asignacion=getFilterEquiposByUserAssigned'
                    },
                    export : {
                      display : false,
                      url: API_BASE_CONTROLLER + 'coberturaController.php?cobertura=exportCoveragePostalCodeRangeAndCountry',
                      url_filter: API_BASE_CONTROLLER + 'coberturaController.php?cobertura=exportFilterCoveragePostalCodeRangeAndCountry',
                    },
                    select : {
                      display: false,
                      url : API_BASE_CONTROLLER + 'usuarioController.php?usuario=getUsersCollector',
                      title: 'Recolectores',
                      class: '',
                      outlined: false,
                      dense: false
                    },
                    pagination:true, 
                    condition: {
                      display : false
                    }

                },
                manualAssignment:{
                  display: false,
                  title:'Asignar manualmente',
                    url: {
                      getData : API_BASE_CONTROLLER + 'asignacionController.php?asignacion=getAllEquipos',
                     
                    },
                    subheader: {
                      display : false,
                      url :''
                    },
                    filter : {
                      display: true,
                      url : API_BASE_CONTROLLER + 'coberturaController.php?cobertura=getFilterCoverage'
                    },
                    export : {
                      display : true,
                      url: API_BASE_CONTROLLER + 'coberturaController.php?cobertura=exportAllCoverage',
                      url_filter: API_BASE_CONTROLLER + 'coberturaController.php?cobertura=exportFilterCoverage',
                    },
                    select : {
                      display: true,
                      url : API_BASE_CONTROLLER + 'usuarioController.php?usuario=getUsersCollector',
                      title: 'Recolector',
                      class: '',
                      outlined: false,
                      dense: true
                    },
                    pagination:true,
                    table: {
                      columns: [
                        { text: '',icon : 'mdi-select-multiple',alt_icon:'mdi-selection-off' , method: '$_selectAll'},
                        { text: 'Codigo postsal'},
                        { text: 'Localidad'},
                        { text: 'Provincia'},
                        { text: 'Direccion'},
                        { text: 'Identificacion'},
                        { text: 'Pertenece a'},
                        { text: 'Asignado'},
                        { text: 'Cartera'},
                        { text: 'Estado'},
                        { text: 'Nombre C.'},
                        { text: 'Empresa'},
                       
                        
                      ],
                   
                    }, 
                    condition: {
                      display : true
                    }
                   
                },
                MAINRESOURCES : {
                  sectionCurrent:'',
                  url_actions : {
                      download_excel : API_BASE_EXCEL,
                      delete_excel : API_BASE_URL + 'helpers/delete.php?delete=deleteExcelFile',
                      toAssign:API_BASE_CONTROLLER + 'asignacionController.php?asignacion=toAssign',
                      removeAssign: API_BASE_CONTROLLER + 'asignacionController.php?asignacion=removeAssign',
                     
                  },
                  urlTryPagination:'',
                  pagination : {
                      display: true,
                      totalPage : 0, 
                      rowForPage:20,
                      pageCurrent: 1,
                      totalCountResponse:0,
                      fromRow:0,
                      limit:20
                  },
                  loadingPaginate:{
                    display: false,
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
                        dataResponseDB: [],
                        auxDataResponseDB:[]
                    },
                  itemsButtons:[
                      { title: 'Base completa', icon: 'mdi-database-edit', methods: '$_allDataBase' , active : true, color :"bg-blue-custom" },
                      { title: 'Codigo Postal', icon: 'mdi-flag-triangle', methods: '$_dataBaseByPostalCode' , active : false, color :"bg-blue-custom" },
                      { title: 'Carteras', icon: 'mdi-purse-outline', methods: '$_dataBaseByPurse' , active : false, color :"bg-blue-custom" },
                      { title: 'Asignado Recolectores', icon: 'mdi-truck-fast-outline', methods: '$_dataBaseByUserAssigned' , active : false, color :"bg-blue-custom" },
                  ],
                  error: {
                    display:null,
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
                  select:{
                    selected :[],
                    display: true
                  },
                  condition:{
                    display: true,
                    parameters:[],
                    url: '',
                    color1:'success',
                    color2:'error',
                    text1:'Ver asignados',
                    text2:'No asignados',
                    class:'mx-2 my-2'
                  },
                  admin:'',
                  reload: false

                },
                fab: false            
            }
        },
        methods:{
            handle_function_call(function_name) {
                this[function_name]()
            },
            $_allDataBase(){
              this.$_cleanError()
              this.MAINRESOURCES.table.display = false
              this.dataBaseByPostalCode.display = false
              this.allDataBase.display = false
              this.dataBaseByPurse.display = false
              this.dataBaseByUserAssigned.display = false
              this.$nextTick(() => {
                this.allDataBase.display = true
                this.MAINRESOURCES.itemsButtons[0].active = true //todo
                this.MAINRESOURCES.itemsButtons[1].active = false //postalcode
                this.MAINRESOURCES.itemsButtons[2].active = false //purse
                this.MAINRESOURCES.itemsButtons[3].active = false //user assigned
              })  
            },
            $_dataBaseByPostalCode(){
              this.$_cleanError()
              this.allDataBase.display = false
              this.dataBaseByPurse.display = false
              this.dataBaseByUserAssigned.display = false
              this.MAINRESOURCES.table.display = false
              
              this.$nextTick(() => {
                this.dataBaseByPostalCode.display = true
                this.MAINRESOURCES.itemsButtons[0].active = false //todo
                this.MAINRESOURCES.itemsButtons[1].active = true //postalcode
                this.MAINRESOURCES.itemsButtons[2].active = false //purse
                this.MAINRESOURCES.itemsButtons[3].active = false //user assigned
              })
              
            },
            $_dataBaseByPurse(){
              this.$_cleanError()
              this.dataBaseByUserAssigned.display = false
              this.allDataBase.display = false
              this.dataBaseByPostalCode.display = false
              this.MAINRESOURCES.table.display = false
              this.$nextTick(() => {
                this.MAINRESOURCES.sectionCurrent = 'purse'
                this.dataBaseByPurse.display = true
                this.MAINRESOURCES.itemsButtons[0].active = false //todo
                this.MAINRESOURCES.itemsButtons[1].active = false //postalcode
                this.MAINRESOURCES.itemsButtons[2].active = true //purse
                this.MAINRESOURCES.itemsButtons[3].active = false //user assigned
              })
            },
            $_dataBaseByUserAssigned(){
              this.$_cleanError()
              this.dataBaseByPurse.display = false
              this.dataBaseByUserAssigned.display = false
              this.allDataBase.display = false
              this.dataBaseByPostalCode.display = false
              this.MAINRESOURCES.table.display = false
              this.$nextTick(() => {
                this.dataBaseByUserAssigned.display = true
                this.MAINRESOURCES.sectionCurrent = 'user'
                this.MAINRESOURCES.itemsButtons[0].active = false //todo
                this.MAINRESOURCES.itemsButtons[1].active = false //postalcode
                this.MAINRESOURCES.itemsButtons[2].active = false //purse
                this.MAINRESOURCES.itemsButtons[3].active = true //user assigned
              })
            },
            $_cleanSelected(){
             
                 this.MAINRESOURCES.select.selected = []
                this.$nextTick(() => {
                  this.$refs.assignment.cleanSelected()
                })
                
            },
            $_cleanFilter(){
              if(this.$refs.setFilter && this.$refs.setFilter !== undefined){
                this.$refs.setFilter.cleanFilter();
              }
            },
            $_cleanCondition(){
              if(this.MAINRESOURCES.condition.display){
                  this.$refs.setCondition.reset()
              }
              
            },
            $_cleanError(){
              if(this.MAINRESOURCES.error && this.MAINRESOURCES.error.display){
                this.MAINRESOURCES.error.type = null
                this.MAINRESOURCES.error.text = null
                this.MAINRESOURCES.error.time = null
                this.MAINRESOURCES.error.display = false
              }
              
            },
            handlerCondition(flag){
              this.MAINRESOURCES.condition.display = flag
              
              this.$nextTick(() => {
                if(this.showTableAssignment && this.MAINRESOURCES.condition.display){
                  this.$refs.setCondition.reset();
                }
              })
              
              
              
            },
            getAdmin(){
              if(document.getElementById("id_user_default") === null){
                alertNegative("Mensage Codigo 52")
                return
              }else {
                let admin =  document.getElementById("id_user_default").value
                let country = document.getElementById("id_admin").value
                this.MAINRESOURCES.admin = admin
              }
            },
            $_realoadCurrentPage(){
              this.$refs.pagination.paginate()
            },
            onScroll (e) {
              if (typeof window === 'undefined') return
              const top = window.pageYOffset ||   e.target.scrollTop || 0
              this.fab = top > 20
             
            },
            toTop () {
              this.$vuetify.goTo(0)
            }
        },
        created(){
          this.getAdmin();
        },
        
        

    })
</script>
