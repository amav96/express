<?php require_once 'views/layout/headerAdmin.php'; ?>

    <div id="admin-assignment" >
            
    </div>
<!-- VUE -->
<!-- helpers -->
<script src="<?=base_url?>vue/src/components/helpers/errorGlobal.js"></script>
<script src="<?=base_url?>vue/src/components/helpers/loaderLine.js"></script>
<script  src="<?=base_url?>vue/src/components/helpers/messageSnack.js"></script>

<!-- dialog -->
<script  src="<?=base_url?>vue/src/components/dialog/reusable/smallScreen.js"></script>
<!-- table -->
<script  src="<?=base_url?>vue/src/components/tables/custom/assignment/tableAssignment"></script>
<script src="<?=base_url?>vue/src/components/tables/pagination.js"></script>

<!-- form component -->
<script  src="<?=base_url?>vue/src/components/form/reusable/formAll.js"></script>
<script  src="<?=base_url?>vue/src/components/form/reusable/select/AutoCompleteSimpleID.js"></script>
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
           :MAINRESOURCES="MAINRESOURCES"
           @handle_function_call="handle_function_call($event)"
            />
           
            <div class="d-flex justify-center align-center align-self-center flex-column" >
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
                      />
              </template>
            </div>
              
              <template v-if="MAINRESOURCES.error.display">
                <v-alert class="ma-4 my-6" dense outlined type="error">
                    {{MAINRESOURCES.error.text}}
                </v-alert>
              </template>

                
                

                <template v-if="MAINRESOURCES.table.loading" >
                <v-skeleton-loader
                  type="date-picker"
                ></v-skeleton-loader>
                </template>

                <template v-if="showTableAssignment && MAINRESOURCES.pagination.totalCountResponse>0" >
                  <div class="my-1 mt-3 d-flex justify-center" >
                      
                          Cerca de <strong> &nbsp;{{new Intl.NumberFormat("de-ES").format(MAINRESOURCES.pagination.totalCountResponse)}} </strong>&nbsp; resultados 

                          
                         
                     
                  </div>
                </template>
                <template v-if="MAINRESOURCES.pagination.display">
                  <pagination-custom 
                    :reload="MAINRESOURCES.reload"
                    :pagination="MAINRESOURCES.pagination"
                    :select ="MAINRESOURCES.select"
                    @cleanSelected="$_cleanSelected($event)"
                    :urlTryPagination="MAINRESOURCES.urlTryPagination"
                    @setPageCurrent= "MAINRESOURCES.pagination.pageCurrent = $event"
                    @setFromRow="MAINRESOURCES.pagination.fromRow = $event"
                    @updateDataResponseDB="MAINRESOURCES.table.dataResponseDB = $event"
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
                    :pagination = "MAINRESOURCES.pagination"
                    :exportExcel ="MAINRESOURCES.exportExcel"
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
                    @setOldUrlExport="MAINRESOURCES.exportExcel.url = $event"
                    />
                </template>
            
                <template v-if="showTableAssignment">
                  <template v-if="MAINRESOURCES.table.type = 'allEquipments'">
                    <table-assignment 
                    :resources="MAINRESOURCES" 
                    :columns="allDataBase.table.columns"
                    :manualAssignment="manualAssignment"
                    @setLoader="MAINRESOURCES.loadingPaginate.display"
                    @setSelected="MAINRESOURCES.select.selected = $event"
                    @realoadCurrentPage="$_realoadCurrentPage($event)"
                    @reaload="MAINRESOURCES.reload = $event"
                    @setSnack="MAINRESOURCES.snackbar = $event"
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
                   
                },
                MAINRESOURCES : {
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
                        dataResponseDB: []
                    },
                  itemsButtons:[
                      { title: 'Base original', icon: 'mdi-database-edit', methods: '$_allDataBase' , active : true, color :"bg-blue-custom" },
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
                  select:{
                    selected :[],
                    display: true
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
                // this.MAINRESOURCES.table.type = 'allEquipments'
                this.allDataBase.display = true
            },
            readMethodCurrent(){
             if(this.allDataBase.display){
                this.MAINRESOURCES.table.type = 'allEquipments'
             }
            },
            $_cleanSelected(){
             
                 this.MAINRESOURCES.select.selected = []
                this.$nextTick(() => {
                  this.$refs.assignment.cleanSelected()
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
        }

    })
</script>
