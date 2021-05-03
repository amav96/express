<?php require_once 'views/layout/headerAdmin.php'; ?>

    <div id="admin-avisos" >
            
    </div>

<!-- VUE -->

<!-- component  avisos -->
    
<script src="<?=base_url?>vue/src/components/helpers/VueExcelXlsx.js"></script>
<script  src="<?=base_url?>vue/src/components/admin/avisos/formSearchByIDAndRangeDate.js"></script>
<script src="<?=base_url?>vue/src/components/admin/avisos/formSearchDate.js"></script>
<script src="<?=base_url?>vue/src/components/admin/avisos/formSearchId.js"></script>

<script src="<?=base_url?>vue/src/components/admin/avisos/tableData.js?v=14042021"></script>
<script src="<?=base_url?>vue/src/components/admin/avisos/dialogCustom.js"></script>
<script src="<?=base_url?>vue/src/components/helpers/errorGlobal.js"></script>

<!-- Store -->
<script src="<?=base_url?>vue/src/store/index.js?v=05042021"></script>
<script src="<?=base_url?>vue/src/modules/M_adminAvisos.js"></script>
<!-- views -->

<!-- <v-btn @click="$_formId" >Identificacion</v-btn>
                   <v-btn @click="$_formRangeDate" >Fecha</v-btn>
                   <v-btn @click="$_formIdAndRangeDate" >Recolector y Fecha</v-btn> -->
       
<?php require_once 'views/layout/footerAdmin.php'; ?>

<script>

    Vue.config.devtools = true;
    Vue.config.debug = true;
    
  new Vue({

      el: '#admin-avisos',
      vuetify: new Vuetify(),
      store,
      template : //html 
      `
      <v-app class=" empujarParaArriba elevation" >
        <div >
            <v-row  
              class=" bg-blue-custom justify-center align-items-center  flex-column m-0 py-2"
              wrap
            > 
              <v-container  class=" d-flex justify-center flex-column">
                    <h5 class=" color-white-custom text-center" >Gestión de Avisos</h5>
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
                    <v-col  class=" altura d-flex justify-center my-0"  cols="12" lg="6"  >
                      <form-search-id
                      :base_url_searchId="base_url_searchId" 
                      @dataChildsearchId="dataResponseDB = $event"
                      @childrenLoadingData="loadingTable = $event"
                      @childrenTable="table = $event"
                      @childrenError="error = $event"
                      :error="error"/>
                      </v-col>
                  </template>
                    
                  <template v-if="formRangeDate">
                    <v-col class="d-flex justify-center m-2" cols="12" lg="12"  >
                      <form-search-date
                      :base_url_searchDateRange="base_url_searchDateRange"
                      @dataChildsearchInRangeDate="dataResponseDB = $event"
                      @childrenLoadingData="loadingTable = $event"
                      @childrenTable="table = $event"
                      @childrenError="error = $event"
                      />
                      </v-col>
                  </template>

                  <template v-if="formIdAndRangeDate">
                    <v-col class=" d-flex justify-center m-2" cols="12" lg="12" >
                      <form-search-by-id-and-range-date 
                      :base_url_data_select="base_url_data_select" 
                      :base_url_searchByIdAndRangeDate="base_url_searchByIdAndRangeDate"
                      @dataChildsearchByIDAndRangeDate="dataResponseDB = $event"
                      @childrenTable="table = $event"
                      @childrenLoadingData="loadingTable = $event"
                      @childrenProcessDataSelect="processDataSelect($event)"
                      :dataSelect="dataSelect"
                      :showDataSelect="showDataSelect"
                      @childrenError="error = $event"
                        />
                        </v-col>
                  </template>   
                  
              </div> 

            <template v-if="table">
             <table-data    
                
                :dataResponseDB="dataResponseDB" 
                :columns="columns"
                :columnExport="columnExport"
                :nameExport="nameExport"
                :loadingTable="loadingTable"
                :table="table"
                @childrenDialog="dialog = $event"
                :dialog="dialog"
                :bodyDialog="bodyDialog"
                :titleDialog="titleDialog"
                :actionsDialog="actionsDialog"
                @childrenBodyDialogTemplate="templateDialogDetail($event)"
                :templateDialog="templateDialog"
                :sortBy="sortBy"
                :sortDesc="sortDesc"
              />
              </template>

          
        </v-app>
      `,
      data(){
          return {
            formId :true,
            formRangeDate:false,
            formIdAndRangeDate:false,
            dataSelect:[],
            base_url_searchId: API_BASE_URL + 'controllers/noticeController.php?notice=getNoticesById',
            base_url_searchDateRange:  API_BASE_URL + 'controllers/noticeController.php?notice=getNoticesByDateRange',
            base_url_data_select:  API_BASE_URL + 'controllers/usuarioController.php?usuario=dataUsers',
            base_url_searchByIdAndRangeDate:  API_BASE_URL + 'controllers/noticeController.php?notice=getNoticesByIdAndDate',
            dataResponseDB: [],
            sortBy: 'created_at',
            sortDesc: true,
            columns: [
              { text: 'Detalle', label: 'Aviso', value: 'actions', field: 'actions' },
              { text: 'Nombre', label: 'Nombre', value:'name',  field:'name', width: 100,},
              { text: 'Aviso', label: 'Aviso', value:'aviso', field:'aviso'},
              { text: 'Contacto', label: 'Contacto', value:'contacto', field:'contacto'},
              { text: 'Pais', label: 'Pais', value:'country', field:'country'},
              { text: 'Recolector', label: 'Recolector', value:'id_user', field:'id_user', width: 120},
              { text: 'Identificacion', label: 'Identificacion', value:'identificacion', field:'identificacion', width: 130},
              { text: 'Lat', label: 'Lat', value:'lat', field:'lat' , align: ' d-none'},
              { text: 'Lng', label: 'Lng', value:'lng', field:'lng', align: ' d-none'},
              { text: 'Medio', label: 'Medio', value:'means',  field:'means', width: 100},
              { text: 'Fecha', label: 'Fecha', value:'created_at', field:'created_at'}
            ],
            columnExport : [
              { label: 'Nombre',  field:'name'},
              { label: 'Aviso', field:'aviso'},
              { label: 'Contacto', field:'contacto'},
              { label: 'Pais', field:'country'},
              { label: 'Recolector', field:'id_user'},
              { label: 'Identificacion', field:'identificacion'},
              { label: 'Medio',  field:'means'},
              { label: 'Fecha', field:'created_at'}
              ],
            nameExport: 'Gestion de avisos',
            loadingTable : false,
            table: false,
            dialog: false,
            bodyDialog: [],
            titleDialog: 'Detalle del aviso',
            templateDialog: [],
            actionsDialog : {
              close : {
                flag:true,
                text:'Cerrar'
                } , 
              save : {
                flag:false,
                text:'Guardar'
              }},
            itemsButtons: [
                { title: 'Identificación', icon: 'mdi-view-dashboard', methods: '$_formId', active : true },
                { title: 'Rango fecha', icon: 'mdi-forum', methods : '$_formRangeDate', active : false },
                { title: 'Recolector y Rango fecha', icon: 'mdi-forum' ,methods: '$_formIdAndRangeDate', active : false },
              ],
            error: {
              type: null,
              text: null,
              time: null
            }
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
            this.formIdAndRangeDate = false
            this.itemsButtons[0].active = true
            this.itemsButtons[1].active = false
            this.itemsButtons[2].active = false
            
          
        },
        $_formRangeDate(){
            this.formId = false
            this.formRangeDate = true
            this.formIdAndRangeDate = false

            this.itemsButtons[0].active = false
            this.itemsButtons[2].active = false
            this.itemsButtons[1].active = true
           
        },
        $_formIdAndRangeDate(){
            this.formId = false
            this.formRangeDate = false
            this.formIdAndRangeDate = true

            this.itemsButtons[0].active = false
            this.itemsButtons[1].active = false
            this.itemsButtons[2].active = true
           
           
        }
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
