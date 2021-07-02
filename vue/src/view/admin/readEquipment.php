<?php require_once 'views/layout/headerAdmin.php'; ?>

    <div id="admin-rendicion" >
            
    </div>
<!-- VUE -->
<!-- helpers -->
<script src="<?=base_url?>vue/src/components/helpers/VueExcelXlsx.js"></script>
  
<script src="<?=base_url?>vue/src/components/helpers/errorGlobal.js"></script>

<script src="<?=base_url?>vue/src/components/tables/custom/surrender/tableNotFound.js"></script>

<!-- form component -->

<script src="<?=base_url?>vue/src/components/form/reusable/formReadFile.js"></script>

<script src="<?=base_url?>vue/src/store/index.js?v=01072021"></script>

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
               
                <template v-if="showReadEquipment">
                        <form-read-file
                        :importData="readEquipment.import"
                        :tooltip="readEquipment.tooltip"
                        @setResponseImport="readEquipment.import.table.dataResponse = $event"
                        @setError = "error = $event"
                        />
                        <template v-if="showRowNotFound">
                          <table-not-found :readData="readEquipment" />
                        </template>
                </template>

                <template v-if="error.display">
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
                readEquipment:{
                    display : true,
                    import: {
                        upload: {
                            url : API_BASE_CONTROLLER + 'rendicionController.php?rendicion=readExcel'
                        },
                        downloadFile:{
                          url: API_BASE_PDF
                        },
                        responseImport:[],
                        table:{
                          search:'',
                          columns: [
                            {text: 'Terminal',value: 'terminal', label:'terminal',field:'terminal'},
                            { text: 'Serie', value: 'serie', label:'serie',field:'serie' },
                            { text: 'Identificacion', value: 'identificacion',label:'identificacion',field:'identificacion' },
                          ],
                          dataResponse: []
                        },
                        delete:{
                          url:API_BASE_URL + 'helpers/delete.php?delete=deletePDF',
                        }

                    },
                    tooltip: {
                      display: true,
                      text: 'El archivo debe ser Excel y no mayor a 150 registros',
                    }
                },
                error:{
                  display: false,
                  text: '',
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
                      { title: 'Leer equipos', icon: 'mdi-monitor-cellphone-star', methods: '$_readEquipment' , active : true, color :"bg-blue-custom" },
                    
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
                this.readEquipment.display = true
            }
         
        },
        computed : {
          showReadEquipment(){
            if(this.readEquipment.display){
              return true
            }else{
              return false
            }
          },
          showRowNotFound(){
            if(this.readEquipment.import.table.dataResponse.fail && this.readEquipment.import.table.dataResponse.fail.length > 0){
              return true
            }else{
              return false
            }
          }
        },
    })
</script>
<style>
  
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
        flex-direction: column;
        align-content: center;
        align-items: center;
    }   
   

</style>
