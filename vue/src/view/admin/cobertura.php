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
<script src="<?=base_url?>vue/src/components/dialog/reusable/smallScreen.js"></script>
<script src="<?=base_url?>vue/src/components/dialog/reusable/mediaScreen.js"></script>
<script src="<?=base_url?>vue/src/components/dialog/reusable/chooseNext.js"></script>
<script src="<?=base_url?>vue/src/components/dialog/reusable/continue.js"></script>

<!-- alert -->
<script src="<?=base_url?>vue/src/components/alert/custom/AlertInfoUser.js"></script>


<!-- table component -->
<script src="<?=base_url?>vue/src/components/tables/pagination.js"></script>
<script src="<?=base_url?>vue/src/components/tables/excel.js"></script>
<script src="<?=base_url?>vue/src/components/tables/custom/coverage/tableCobertura.js"></script>
<script src="<?=base_url?>vue/src/components/tables/custom/coverage/tableEmptyCoverage.js"></script>
<script src="<?=base_url?>vue/src/components/tables/custom/coverage/tableHistoryCoverage.js"></script>


<!-- form component -->
<script  src="<?=base_url?>vue/src/components/form/reusable/formAll.js"></script>
<script  src="<?=base_url?>vue/src/components/form/reusable/formRangeNumberAndWord.js"></script>
<script  src="<?=base_url?>vue/src/components/form/reusable/formId.js"></script>
<script src="<?=base_url?>vue/src/components/form/reusable/filterWithPagination.js"></script>
<script src="<?=base_url?>vue/src/components/form/custom/coverage/SaveCollector.js"></script>
<script src="<?=base_url?>vue/src/components/form/custom/coverage/SaveCommerce.js"></script>
<script src="<?=base_url?>vue/src/components/form/custom/coverage/SavePoint.js"></script>
<script src="<?=base_url?>vue/src/components/form/custom/coverage/UpdateCollector.js"></script>
<script src="<?=base_url?>vue/src/components/form/custom/coverage/UpdateCommerce.js"></script>
<script src="<?=base_url?>vue/src/components/form/custom/coverage/UpdatePoint.js"></script>
<script src="<?=base_url?>vue/src/components/form/custom/coverage/Delete.js"></script>
<script src="<?=base_url?>vue/src/components/form/custom/coverage/UpdateOnlyOneCollector.js"></script>
<script src="<?=base_url?>vue/src/components/form/custom/coverage/UpdateOnlyOneCommerce.js"></script>
<script src="<?=base_url?>vue/src/components/form/custom/coverage/UpdateOnlyOnePoint.js"></script>
<script src="<?=base_url?>vue/src/components/form/custom/coverage/Confirm.js"></script>
<script src="<?=base_url?>vue/src/components/form/reusable/select/AutoCompleteSimpleID.js"></script>
<script src="<?=base_url?>vue/src/components/form/reusable/select/AutoCompleteSearchID.js"></script>
<script src="<?=base_url?>vue/src/components/form/reusable/switches/switchesCommon.js"></script>
<script src="<?=base_url?>vue/src/components/form/custom/switches/switchesContent.js"></script>
<script src="<?=base_url?>vue/src/components/form/reusable/geocoding/geocodingSimple.js"></script>
<script src="<?=base_url?>vue/src/components/form/reusable/timeSchedule.js"></script>

<!-- pagination component -->
<script  src="<?=base_url?>vue/src/components/tables/pagination.js"></script>

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
          <v-overlay v-if="!doom" opacity="2" color="white" >
            <v-progress-circular
              indeterminate
              size="64"
              color="info"
            ></v-progress-circular>
          </v-overlay>
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
              <div class=" d-flex justify-center align-center align-self-center flex-column" >
            
                <transition name="slide-fade">
                  <error-global 
                  v-if="MAINRESOURCES.error.type !== null" 
                  :error="MAINRESOURCES.error"
                  @clearingError="MAINRESOURCES.error = $event"
                  />
                </transition>

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
                <template v-if="showAllCoverage.display">
                    <form-all
                      :resources="showAllCoverage"
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
                    />
                </template>

                <template v-if="formRangeNumberAndWord.display">
                    <v-col  class="d-flex justify-center m-2"  cols="12" lg="12"  >
                      <form-number-and-word
                        :resources="formRangeNumberAndWord"
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
                      />
                    </v-col>
                </template>

                <template v-if="showAllEmptyCoverage.display">
                    <form-all
                      :resources="showAllEmptyCoverage"
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
                    />
                </template>

                <template v-if="showAllHistory.display">
                    <form-all
                      :resources="showAllHistory"
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
                    />
                </template>

                <template v-if="showZoneByUser.display" >
                  <form-id
                      :resources="showZoneByUser"
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
                  />
                </template>


                <template>
                      <message-snack
                      :snackbar="MAINRESOURCES.snackbar"
                      />
                </template>
  
                <template>
                  <dialog-choose-next
                  :dialogChoose="dialogChoose"
                  @next="nextChoose($event)"
                  @back="backChoose($event)"
                  />
                </template>
      
                <template>
                  <d-full-screen :dialogFullScreen="dialogFullScreen"  >
                    <template v-if="save.collector.display && save.action === 'create'">
                        <save-collector 
                        :pagination="MAINRESOURCES.pagination"  
                        :admin="admin" 
                        :save="save"
                        :dialogFullScreen="dialogFullScreen"
                        ref="rendered"
                        @response="MAINRESOURCES.table.dataResponseDB = $event"
                        @showTable="MAINRESOURCES.table.display = $event"
                        @filtering="MAINRESOURCES.filter.filtering = $event"
                        @setPaginateDisplay="MAINRESOURCES.pagination.display = $event"
                        @setDialogDisplay="dialogFullScreen.display = $event"
                        @setSnack="MAINRESOURCES.snackbar = $event"
                        @setContinue="dialogSmallScreen.display = $event"
                        :dialogSmallScreen="dialogSmallScreen"
                        :continueSave="continueAdd"
                     
                        />
                    </template>
                    <template v-if="save.commerce.display && save.action === 'create'" >
                      <save-commerce 
                        :pagination="MAINRESOURCES.pagination"  
                        :admin="admin" 
                        :save="save"
                        :dialogFullScreen="dialogFullScreen"
                        ref="rendered"
                        @response="MAINRESOURCES.table.dataResponseDB = $event"
                        @showTable="MAINRESOURCES.table.display = $event"
                        @filtering="MAINRESOURCES.filter.filtering = $event"
                        @setPaginateDisplay="MAINRESOURCES.pagination.display = $event"
                        @setDialogDisplay="dialogFullScreen.display = $event"
                        @setSnack="MAINRESOURCES.snackbar = $event"
                        @setContinue="dialogSmallScreen.display = $event"
                        :dialogSmallScreen="dialogSmallScreen"
                        :continueSave="continueAdd"
                      />
                    </template>
                    <template v-if="save.point.display && save.action === 'create'" >
                      <save-point 
                        :pagination="MAINRESOURCES.pagination"  
                        :admin="admin" 
                        :save="save"
                        :dialogFullScreen="dialogFullScreen"
                        ref="rendered"
                        @response="MAINRESOURCES.table.dataResponseDB = $event"
                        @showTable="MAINRESOURCES.table.display = $event"
                        @filtering="MAINRESOURCES.filter.filtering = $event"
                        @setPaginateDisplay="MAINRESOURCES.pagination.display = $event"
                        @setDialogDisplay="dialogFullScreen.display = $event"
                        @setSnack="MAINRESOURCES.snackbar = $event"
                        @setContinue="dialogSmallScreen.display = $event"
                        :dialogSmallScreen="dialogSmallScreen"
                        :continueSave="continueAdd"
                      />
                    </template>
                    <template v-if="save.collector.display && save.action === 'update'" >
                      <update-collector
                      :pagination="MAINRESOURCES.pagination"  
                      :admin="admin" 
                      :save="save"
                      :dialogFullScreen="dialogFullScreen"
                      @response="MAINRESOURCES.table.dataResponseDB = $event"
                      @showTable="MAINRESOURCES.table.display = $event"
                      @filtering="MAINRESOURCES.filter.filtering = $event"
                      @setPaginateDisplay="MAINRESOURCES.pagination.display = $event"
                      @setDialogDisplay="dialogFullScreen.display = $event"
                      @setSnack="MAINRESOURCES.snackbar = $event"
                      />
                      
                    </template>
                    <template v-if="save.commerce.display && save.action === 'update'" >
                      <update-commerce
                      :pagination="MAINRESOURCES.pagination"  
                      :admin="admin" 
                      :save="save"
                      :dialogFullScreen="dialogFullScreen"
                      @response="MAINRESOURCES.table.dataResponseDB = $event"
                      @showTable="MAINRESOURCES.table.display = $event"
                      @filtering="MAINRESOURCES.filter.filtering = $event"
                      @setPaginateDisplay="MAINRESOURCES.pagination.display = $event"
                      @setDialogDisplay="dialogFullScreen.display = $event"
                      @setSnack="MAINRESOURCES.snackbar = $event"
                      />
                    </template>
                    <template v-if="save.point.display && save.action === 'update'" >
                      <update-point
                      :pagination="MAINRESOURCES.pagination"  
                      :admin="admin" 
                      :save="save"
                      :dialogFullScreen="dialogFullScreen"
                      @response="MAINRESOURCES.table.dataResponseDB = $event"
                      @showTable="MAINRESOURCES.table.display = $event"
                      @filtering="MAINRESOURCES.filter.filtering = $event"
                      @setPaginateDisplay="MAINRESOURCES.pagination.display = $event"
                      @setDialogDisplay="dialogFullScreen.display = $event"
                      @setSnack="MAINRESOURCES.snackbar = $event"
                      />
                    </template>
                  </d-full-screen>
                </template>
          
               
              </div> 

                <template v-if="MAINRESOURCES.table.loading" >
                 <loader-line />
                </template>
              
                <template v-if="showTable() && MAINRESOURCES.filter.display">
                    <filter-with-pagination
                    :pagination = "MAINRESOURCES.pagination"
                    :filter="MAINRESOURCES.filter"
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
                    />
                </template>

                <template v-if="MAINRESOURCES.table.display && MAINRESOURCES.exportExcel.display">
                  <div>
                    <v-row class="justify-center align-items-center align-content-center">
                      <excel-export
                      :url_actions="url_actions"
                      :parametersDynamicToPaginate="parametersDynamicToPaginate"
                      />
                    </v-row>
                  </div>
                 
                </template>
              
                <template v-if="showTable()">
                  <template v-if="formRangeNumberAndWord.display || showAllCoverage.display || showZoneByUser.display">
                    <table-cobertura
                        :admin="admin"
                        :columns="MAINRESOURCES.columns"
                        :table="MAINRESOURCES.table"
                        :url_actions="MAINRESOURCES.url_actions"
                        :pagination="MAINRESOURCES.pagination"
                        @setSnack="MAINRESOURCES.snackbar = $event"
                        @setResponse="MAINRESOURCES.table.dataResponseDB = $event"
                        @subtract="subtractPagination($event)"
                      />
                  </template>
                  <template v-if="showAllEmptyCoverage.display">
                    <table-empty-coverage
                    :columns="showAllCoverage.table.columns"
                    :admin="admin"
                    :table="MAINRESOURCES.table"
                    :url_actions="MAINRESOURCES.url_actions"
                    :pagination="MAINRESOURCES.pagination"
                    @setSnack="MAINRESOURCES.snackbar = $event"
                    @setResponse="MAINRESOURCES.table.dataResponseDB = $event"
                    @subtract="subtractPagination($event)"
                    />
                  </template>

                  <template v-if="showAllHistory.display">
                    <table-history-coverage
                    :columns="showAllHistory.table.columns"
                    :admin="admin"
                    :table="MAINRESOURCES.table"
                    :pagination="MAINRESOURCES.pagination"
                    @setSnack="MAINRESOURCES.snackbar = $event"
                    @setResponse="MAINRESOURCES.table.dataResponseDB = $event"
                    @subtract="subtractPagination($event)"
                    />
                  </template>
                </template>

                <template v-if="MAINRESOURCES.loaderLine" >
                  <loader-line />
                </template>
  
                <template v-if="showTable() && MAINRESOURCES.pagination.totalCountResponse>0 && MAINRESOURCES.pagination.display">
                    <pagination-custom 
                    :pagination="MAINRESOURCES.pagination"
                    :urlTryPagination="MAINRESOURCES.urlTryPagination"
                    :loaderLine="MAINRESOURCES.loaderLine"
                    @setPageCurrent= "MAINRESOURCES.pagination.pageCurrent = $event"
                    @setFromRow="MAINRESOURCES.pagination.fromRow = $event"
                    @updateDataResponseDB="MAINRESOURCES.table.dataResponseDB = $event"
                    @showLoaderLine="MAINRESOURCES.loaderLine =  $event"
                    :parametersDynamicToPaginate="MAINRESOURCES.parametersDynamicToPaginate"
                    @updateDynamicParametersToCall="MAINRESOURCES.parametersDynamicToPaginate = $event"
                    @restauratePagination="MAINRESOURCES.pagination = $event"
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
                dialogSmallScreen : {
                  display : false,
                  title : 'aceptar',
                 
                },
                continueAdd:{
                  title: '¿Deseas asignar mas zonas?',
                  accept:{
                    title: 'Si',
                    option : false,
                    color:"success"
                  },
                  exit : {
                    title: 'No, salir',
                    option : false,
                    color:"error"
                  },
                  class:"d-flex justify-center flex-column"
                },
                save : {
                  action : '',
                  type:'',
                  collector :{
                    display : false,
                    url_users : API_BASE_CONTROLLER + 'coberturaController.php?cobertura=getUsersCollector',
                    title_field : 'Ingrese Recolector',
                    select : {
                      display: true,
                      url : '',
                      title: '',
                      class: 'mx-2',
                      outlined: true,
                      dense: true
                    },
                  },
                  commerce : {
                    display : false,
                    url_users : API_BASE_CONTROLLER + 'usuarioController.php?usuario=getUsersCommerce',
                    title_field : 'Ingrese comercio',
                    select : {
                      display: true,
                      url : '',
                      title: '',
                      class: '',
                      outlined: true,
                      dense: true
                    },
                  },
                  point : {
                    display : false,
                    select : {
                      display: true,
                      url : '',
                      title: '',
                      class: 'mx-2',
                      outlined: true,
                      dense: true
                    },
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
                    delete : API_BASE_CONTROLLER + 'coberturaController.php?cobertura=delete',
                    update : API_BASE_CONTROLLER + 'coberturaController.php?cobertura=update',
                    getRecentCodes : API_BASE_CONTROLLER + 'coberturaController.php?cobertura=getRecentCodes',

                  },
                  
                },
                dialogChoose : {
                  chooseNext: {
                    display: false,
                    title:'Seleccione tipo',
                    chosenOption:'',
                    options: [
                      {text:'Recolector',value:'recolector'},
                      {text:'Comercio', value: 'comercio'},
                      {text:'Correo', value:'correo'},
                      {text:'Terminal', value:'terminal'},
                    ],
                  }
                },
                formRangeNumberAndWord : {
                    display : true,
                    url: {
                      getData : API_BASE_CONTROLLER + 'coberturaController.php?cobertura=getPostalCodeRangeAndCountry',
                    },
                    subheader: {
                      display : false,
                      url :''
                    },
                    filter : {
                      display: true,
                      url : API_BASE_CONTROLLER + 'coberturaController.php?cobertura=getFilterByWordByPostalCodeRangeAndCountry'
                    },
                    export : {
                      display : false,
                      url: '',
                      url_filter: '',
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
                },
                showAllCoverage : {
                    display : false,
                    url: {
                      getData : API_BASE_CONTROLLER + 'coberturaController.php?cobertura=getAllCoverage',
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
                      display : false,
                      url: '',
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
                    table: {
                      columns: [
                      { text: 'Codigo Postal'},
                      { text: 'Localidad'},
                      { text: 'Provincia Int'},
                      { text: 'Provincia'},
                      { text: 'Pais'},
                      { text: 'Acciones'},
                      ],
                    }
                    
                },
                showAllEmptyCoverage : {
                    display : false,
                    url: {
                      getData : API_BASE_CONTROLLER + 'coberturaController.php?cobertura=getAllEmptyCoverage',
                    },
                    subheader: {
                      display : false,
                      url :''
                    },
                    filter : {
                      display: true,
                      url : API_BASE_CONTROLLER + 'coberturaController.php?cobertura=getFilterEmptyCoverage'
                    },
                    export : {
                      display : false,
                      url: '',
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
                showAllHistory : {
                    display : false,
                    url: {
                      getData : API_BASE_CONTROLLER + 'coberturaController.php?cobertura=getAllHistoryCoverage',
                    },
                    subheader: {
                      display : false,
                      url :''
                    },
                    filter : {
                      display: true,
                      url : API_BASE_CONTROLLER + 'coberturaController.php?cobertura=getFilterAllHistoryCoverage'
                    },
                    export : {
                      display : false,
                      url: '',
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
                    table: {
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
                      { text: 'Motivo'},
                      { text: 'Estado Usuario'},
                      ],
                    }
                },
                showZoneByUser : {
                    display : false,
                    url: {
                      getData : API_BASE_CONTROLLER + 'coberturaController.php?cobertura=getCoverageByUsers',
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
                      url: '',
                      url_filter: '',
                    },
                    select : {
                      display: false,
                      url : API_BASE_CONTROLLER + 'usuarioController.php?usuario=getAllUserCollectorAndCommerce',
                      title: 'Usuario',
                      class: 'mx-4',
                      outlined: false,
                      dense: false
                    },
                    pagination:true,
                },
                admin : '',  
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

                  ],
                  table : {
                        display : false,
                        loading: false,
                        dataResponseDB: []
                    },
                  itemsButtons:[
                      { title: 'Mostrar asignado', icon: 'mdi-map-search-outline', methods: '$_showAllCoverage' , active : false, color :"bg-blue-custom" },
                      { title: 'Codigo postal', icon: 'mdi-flag-triangle', methods: '$_formRangeNumberAndWord', active :  true, color :"bg-blue-custom"},
                      { title: 'Zonas vacias', icon: 'mdi-alert-circle-outline', methods: '$_showAllEmptyCoverage', active :  false, color :"bg-blue-custom"},
                      { title: 'Historial Inactivo', icon: 'mdi-history', methods: '$_showAllHistory', active :  false, color :"bg-blue-custom"},
                      { title: 'Usuarios asignados', icon: 'mdi-account', methods: '$_showZoneByUser', active :  false, color :"bg-blue-custom"},
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
                doom : false
                
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
            
          
            if(this.save.type === 'recolector'){
                this.save.action === 'create' ? this.dialogFullScreen.title = 'Crear zona para Recolector' : '';
                this.save.action === 'update' ? this.dialogFullScreen.title = 'Actualizar zona para Recolector' : '';
                //show or hide others form
                this.save.collector.display = true
                this.save.commerce.display = false
                this.save.point.display = false
              }
            if(this.save.type === 'comercio'){
              this.save.action === 'create' ? this.dialogFullScreen.title = 'Crear zona para Comercio' : '';
              this.save.action === 'update' ? this.dialogFullScreen.title = 'Actualizar zona para Comercio' : '';
                //show or hide others form
                this.save.commerce.display = true
                this.save.collector.display = false
                this.save.point.display = false
                
              }
            if(this.save.type === 'correo' || this.save.type === 'terminal'){
                if(this.save.type === 'mail'){
                this.save.action === 'create' ? this.dialogFullScreen.title = 'Crear zona para Correo' : '';
                this.save.action === 'update' ? this.dialogFullScreen.title = 'Actualizar zona para Correo' : '';
                }
                if(this.save.type === 'terminal'){
                this.save.action === 'create' ? this.dialogFullScreen.title = 'Crear zona para Terminal' : '';
                this.save.action === 'update' ? this.dialogFullScreen.title = 'Actualizar zona para Terminal' : '';
                }
                //show or hide others form
                this.save.point.display = true
                this.save.collector.display = false
                this.save.commerce.display = false
                
              }

              this.$nextTick(() => {
                  this.$refs.rendered.$show()
                })
              // this.dialogChoose.chooseNext.chosenOption = ''
          },
          backChoose(){
            this.dialogChoose.chooseNext.chosenOption = '';
          },
          handle_function_call(function_name) {
            this[function_name]()
          },
          $_showAllCoverage(){
            this.MAINRESOURCES.table.display = false
            this.formRangeNumberAndWord.display = false
            this.showAllEmptyCoverage.display = false
            this.showAllCoverage.display = false 
            this.showAllHistory.display = false
            this.showZoneByUser.display = false
            this.$nextTick(() => {
              this.showAllCoverage.display = true
              this.MAINRESOURCES.itemsButtons[0].active = true //todo
              this.MAINRESOURCES.itemsButtons[1].active = false //rangeNumber
              this.MAINRESOURCES.itemsButtons[2].active = false //empty
              this.MAINRESOURCES.itemsButtons[3].active = false //history
              this.MAINRESOURCES.itemsButtons[4].active = false //user by zone
            })  
          },
          $_showAllEmptyCoverage(){
            this.MAINRESOURCES.table.display = false
            this.formRangeNumberAndWord.display = false
            this.showAllCoverage.display = false  
            this.showAllEmptyCoverage.display = false
            this.showAllHistory.display = false
            this.showZoneByUser.display = false
           
              this.$nextTick(() => {
                this.showAllEmptyCoverage.display = true
                this.MAINRESOURCES.itemsButtons[0].active = false //todo
                this.MAINRESOURCES.itemsButtons[1].active = false //rangeNumber
                this.MAINRESOURCES.itemsButtons[2].active = true //empty
                this.MAINRESOURCES.itemsButtons[3].active = false //history
                this.MAINRESOURCES.itemsButtons[4].active = false //user by zone
              });
              
          },
          $_formRangeNumberAndWord(){
              this.MAINRESOURCES.table.display = false
              this.showAllCoverage.display = false
              this.showAllEmptyCoverage.display = false
              this.formRangeNumberAndWord.display = true
              this.showAllHistory.display = false
              this.showZoneByUser.display = false
              
            this.$nextTick(() => {
              this.MAINRESOURCES.itemsButtons[0].active = false //todo
              this.MAINRESOURCES.itemsButtons[1].active = true //rangeNumber
              this.MAINRESOURCES.itemsButtons[2].active = false //empty
              this.MAINRESOURCES.itemsButtons[3].active = false //history
              this.MAINRESOURCES.itemsButtons[4].active = false //user 
              // si no queres mostrar la tabla al llegar aca, solo escondela
            });
          },
          $_showAllHistory(){
              this.MAINRESOURCES.table.display = false
              this.formRangeNumberAndWord.display = false
              this.showAllCoverage.display = false  
              this.showAllEmptyCoverage.display = false
              this.showAllHistory.display = false
              this.showZoneByUser.display = false
           
              this.$nextTick(() => {
                this.showAllHistory.display = true
                this.MAINRESOURCES.itemsButtons[0].active = false //todo
                this.MAINRESOURCES.itemsButtons[1].active = false //rangeNumber
                this.MAINRESOURCES.itemsButtons[2].active = false //empty
                this.MAINRESOURCES.itemsButtons[3].active = true //history
                this.MAINRESOURCES.itemsButtons[4].active = false //user by zone
              });
              
          },
          $_showZoneByUser(){
              this.MAINRESOURCES.table.display = false
              this.formRangeNumberAndWord.display = false
              this.showAllCoverage.display = false  
              this.showAllEmptyCoverage.display = false
              this.showAllHistory.display = false
              this.showZoneByUser.display = false
           
              this.$nextTick(() => {
                this.showZoneByUser.display = true
                this.MAINRESOURCES.itemsButtons[0].active = false //todo
                this.MAINRESOURCES.itemsButtons[1].active = false //rangeNumber
                this.MAINRESOURCES.itemsButtons[2].active = false //empty
                this.MAINRESOURCES.itemsButtons[3].active = false //history
                this.MAINRESOURCES.itemsButtons[4].active = true ////user
              });
              
          },
          getAdmin(){

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
            this.MAINRESOURCES.table.display = false
            this.$nextTick(() => {
              this.MAINRESOURCES.table.display = true
            })
          },
          showTable(){
            if(this.MAINRESOURCES.table.display){
              return true
            }else {
              return false
            }
          },
          getDateTime() {
            var today = new Date();
            var getMin = today.getMinutes();
            var getSeconds = today.getSeconds()
            var getHours = today.getHours()

            if (getMin < 10) { getMin = '0' + today.getMinutes() }
            if (getSeconds < 10) { getSeconds = '0' + today.getSeconds() }
            if (getHours < 10) { getHours = '0' + today.getHours() }

            var created_at = today.getFullYear() + '-' + ("0" + (today.getMonth() + 1)).slice(-2) + '-' +
                ("0" + today.getDate()).slice(-2) + ' ' + getHours + ':' + getMin + ':' + getSeconds;

            return created_at
          },
          subtractPagination(){
           
            this.MAINRESOURCES.pagination.totalCountResponse = this.MAINRESOURCES.pagination.totalCountResponse - 1
            
            
          }
        },
        created(){
          this.getAdmin()
        }, 
        mounted() {
          this.doom = true
        },
        destroyed() {
          this.doom = false
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
