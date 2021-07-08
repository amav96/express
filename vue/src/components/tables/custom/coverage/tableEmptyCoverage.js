Vue.component("table-empty-coverage", {
    template: /*html*/ `
          <div>
                <template>
                    <v-snackbar
                        v-model="snackbarInfo.display"
                        :timeout="snackbarInfo.timeout"
                        multi-line
                        top
                        right
                    >
                    <span class="text-white" >Zonas agregadas recientemente</span>
                        <template v-slot:action="{ attrs }">
                            <v-btn
                                color="white"
                                text
                                v-bind="attrs"
                                @click="$_setResponse()"
                            >
                                Ver
                            </v-btn>
                            <v-btn
                                color="red"
                                text
                                v-bind="attrs"
                                @click="snackbarInfo.display = false"
                            >
                                Cerrar
                            </v-btn>
                        </template>
                    </v-snackbar>
                </template>

                <template v-if="dialogFullScreen.display" >
                    <d-full-screen :dialogFullScreen="dialogFullScreen">
                            <h6 class="ml-4 my-3 d-flex justify-start align-items-center">Zona a ocupar
                            <v-icon class="mx-1">mdi-map-search-outline</v-icon>
                            </h6>
                            <v-col cols="12" xl="6" lg="6" sm="6" xs="6">
                                <template class="mx-auto" v-if="emptyCoverage.data !== 0">
                                <alert-info-user
                                :info="emptyCoverage.data"
                                />         
                                </template>  
                            </v-col>

                            <v-row class="d-flex mx-0 mt-2" >
                                <v-col class="my-1" cols="12" xl="4" lg="4" md="6" sm="6" xs="4"  >
                                    <h6 class="mb-6 d-flex justify-start align-items-center">Tipo de asignado 
                                    <v-icon class="mx-1">mdi-map-marker-plus-outline</v-icon>
                                    </h6>    
                                    <v-select
                                    v-model="emptyCoverage.type"
                                    :items="selectType"
                                    item-text="text"
                                    item-value="value"
                                    outlined
                                    class="mb-1"
                                    dense
                                    label="Seleccione"
                                    hide-no-data
                                    hide-details
                                    >
                                    </v-select>
                                </v-col>
                            </v-row>
                            <template v-if="emptyCoverage.type === 'recolector'">
                                <empty-collector
                                :dialogFullScreen="dialogFullScreen"
                                :admin="admin"
                                :resource="emptyCoverage"
                                @setSnack="$_setMessage($event)"
                                @setDialog="dialogFullScreen.display = $event"
                                @setFront="emptyCoverage.rowAltered.action = $event"
                                @setSavedData="savedData($event)"
                                ref="clearErrorRecolector"
                                />
                            </template>
                            <template v-if="emptyCoverage.type === 'comercio'">
                                <empty-commerce
                                :dialogFullScreen="dialogFullScreen"
                                :admin="admin"
                                :resource="emptyCoverage"
                                @setSnack="$_setMessage($event)"
                                @setDialog="dialogFullScreen.display = $event"
                                @setFront="emptyCoverage.rowAltered.action = $event"
                                @setSavedData="savedData($event)"
                                ref="clearErrorComercio"
                                />
                            </template>
                            <template v-if="emptyCoverage.type === 'correo' || emptyCoverage.type === 'terminal'">
                                <empty-point
                                :dialogFullScreen="dialogFullScreen"
                                :admin="admin"
                                :resource="emptyCoverage"
                                @setSnack="$_setMessage($event)"
                                @setDialog="dialogFullScreen.display = $event"
                                @setFront="emptyCoverage.rowAltered.action = $event"
                                @setSavedData="savedData($event)"
                                ref="clearErrorPoint"
                                />
                            </template>
                    </d-full-screen>
                </template>
                
              <template >
                      <v-simple-table class="my-4" >
                          <template v-slot:default>
                          <thead>
                              <tr  class="bg-blue-custom">
                                <th v-for="column in columns" class="text-left text-white">
                                {{column.text}}
                                </th>
                              </tr>
                          </thead>
                          <tbody>
                            <tr   v-for="(row,index) in table.dataResponseDB" :key="index" :class="isSameID(index)" >
                                <template v-if="row.id_locate !== null && row.id_locate !== ''" >
                                    <td>{{row.postal_code}}</td>
                                    <td>{{row.locate}}</td>
                                    <td>{{row.provinceInt}}</td>
                                    <td>{{row.province}}</td>
                                    <td>{{row.name_country}}</td>
                                    <td>
                                        <div  class="my-1 d-flex flex-row">
                                            <v-tooltip top>
                                                <template v-slot:activator="{ on, attrs }">
                                                    <v-btn class="mx-1" @click="toRegister(row,index)"  fab  x-small v-bind="attrs" v-on="on" color="success">
                                                        <v-icon color="white">
                                                            mdi-arrow-up-circle
                                                        </v-icon>
                                                    </v-btn>
                                                </template>
                                                <span>Asignar zona</span>
                                            </v-tooltip>
                                        </div>
                                    </td>
                                </template>
                            </tr>
                          </tbody>
                          </template>
                      </v-simple-table>
              </template>
          </div>
      `,
    props: ["table", "columns", "admin", "pagination"],
    data() {
        return {
            dialogFullScreen: {
                display: false,
                title: 'Ocupar codigo postal vacio'
            },
            emptyCoverage: {
                type: '',
                data: [],
                savedData: [],
                rowAltered: {
                    id: '',
                    action: ''
                },
                url: {
                    save: API_BASE_CONTROLLER + 'coberturaController.php?cobertura=saveEmptyCoverage',
                },
                collector: {
                    select: {
                        title: 'Ingrese recolector',
                        url: API_BASE_CONTROLLER + 'usuarioController.php?usuario=getUsersCollector',
                        outlined: true,
                        class: '',
                        dense: true
                    },
                },
                commerce: {
                    select: {
                        title: 'Ingrese Comercio',
                        url: API_BASE_CONTROLLER + 'usuarioController.php?usuario=getUsersCommerce',
                        outlined: true,
                        class: '',
                        dense: true
                    },
                    url: {
                        hasAlreadyBeenGeocoded: API_BASE_CONTROLLER + 'coberturaController.php?cobertura=hasAlreadyCommerceBeenGeocoded'
                    }
                },
                point: {
                    url: {
                        hasAlreadyBeenGeocoded: ''
                    }
                }
            },
            selectType: [
                { text: 'Recolector', value: 'recolector' },
                { text: 'Comercio', value: 'comercio' },
                { text: 'Correo', value: 'correo' },
                { text: 'terminal', value: 'terminal' },
            ],
            snackbarInfo: {
                display: false,
                text: 'este es el snack',
                timeout: -1
            }
        }

    },
    methods: {
        toRegister(data, index) {
            this.snackbarInfo.display = false
            this.dialogFullScreen.display = true
            this.emptyCoverage.data = data
            this.emptyCoverage.rowAltered.id = index

        },
        $_setMessage(message) {
            this.$emit("setSnack", message)
        },
        isSameID(index) {
            var style = ''
            if (this.emptyCoverage.rowAltered.id === index && this.emptyCoverage.rowAltered.action === 'save') {
                style = 'success text-white '
                setTimeout(() => {
                    this.emptyCoverage.rowAltered.id = ''
                    this.emptyCoverage.rowAltered.action = ''
                    style = ''
                    this.setFront(index);
                    this.snackbarInfo.display = true
                }, 2500);
                return style
            }
        },
        $_setResponse() {
            this.$emit('setTypeTable', 'showAllCoverage')
            this.$emit("setResponse", this.emptyCoverage.savedData)
        },
        setFront(indexTable) {
            const dataCache = this.table.dataResponseDB
            this.table.dataResponseDB = []
            dataCache.forEach((val, index) => {
                if (index !== indexTable) {
                    this.table.dataResponseDB.push(val)
                }
            })
            this.$emit("subtract", -1)

        },
        savedData(data) {
            this.emptyCoverage.savedData.push(data)
        }
    },
});