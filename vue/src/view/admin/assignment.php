<?php require_once 'views/layout/headerAdmin.php'; ?>

    <div id="admin-assignment" >
            
    </div>
<!-- VUE -->
<!-- helpers -->
<script src="<?=base_url?>vue/src/components/helpers/VueExcelXlsx.js"></script>
  
<script src="<?=base_url?>vue/src/components/helpers/errorGlobal.js"></script>

<script src="<?=base_url?>vue/src/components/tables/custom/surrender/tableNotFound.js"></script>

<!-- form component -->

<script src="<?=base_url?>vue/src/components/form/reusable/formReadFile.js"></script>
<script  src="<?=base_url?>vue/src/components/form/reusable/formAll.js"></script>
<script src="<?=base_url?>vue/src/store/index.js?v=01072021"></script>

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
               
        
                <template v-if="MAINRESOURCES.error.display">
                  <v-alert
                  class="ma-4 my-6"
                  dense
                  outlined
                  type="error"
                  >
                      {{error.text}}
                  </v-alert>
                </template>
            </div>
        </v-app>
        `,
        data(){
            return {
                allDataBase:{
                    display : true,
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
                      { text: 'Codigo Postal'},
                      { text: 'Localidad'},
                      { text: 'Provincia Int'},
                      { text: 'Provincia'},
                      { text: 'Pais'},
                      { text: 'Acciones'},
                      ],
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
                      { title: 'Base original', icon: 'mdi-database-edit', methods: '$_allDataBase' , active : true, color :"bg-blue-custom" },
                  ],
                  error: {
                    display: false,
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
            $_allDataBase(){
                this.allDataBase.display = true
            }
         
        },
        
    })
</script>
