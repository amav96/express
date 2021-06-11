Vue.component("table-cobertura", {
    template: /*html*/ `
          <div>

                <template v-if="dialogMediaScreen.display" >
                    <d-media-screen :dialogMediaScreen="dialogMediaScreen">
                        <delete-coverage 
                        :dialogMediaScreen="dialogMediaScreen"
                        :admin="admin"
                        :response="dataDelete"
                        @setSnack="$_setMessage($event)"
                        @setDialog="dialogMediaScreen.display = $event"
                        @setResponse="$_setResponse($event)"
                        />
                    </d-media-screen>
                </template>
               
                <template v-if="pagination.display" >
                
                        <div class="my-1 d-flex justify-center" >
                            <v-btn
                                >
                                Total Registros <strong> &nbsp;{{pagination.totalCountResponse}} </strong>
                            </v-btn>
                        </div>
                    
                </template>
  
              <template>
                      <v-simple-table >
                          <template v-slot:default>
                          <thead>
                              <tr  class="bg-blue-custom">
                              <th v-for="column in columns" class="text-left text-white">
                              {{column.text}}
                              </th>
                              </tr>
                          </thead>
                          <tbody>
                              <tr  v-for="row in table.dataResponseDB">
                                <td>{{row.postal_code}}</td>
                                <td>{{row.locate}}</td>
                                <td>{{row.provinceInt}}</td>
                                <td>{{row.province}}</td>
                                <td>{{row.home_address}}</td>
                                <td>{{row.timeScheduleA}}</td>
                                <td>{{row.timeScheduleB}}</td>
                                <td>{{row.name_country}}</td>
                                <td >
                                        <v-chip 
                                        class="ma-2"
                                        :color="colorByType(row.type)"
                                        >
                                        {{row.type}}
                                        </v-chip>
                                    </td>
                                <td 
                                v-if="row.name_assigned !== ''  && row.name_assigned !== null && row.name_assigned !== ' '"
                                >
                                    {{row.name_assigned}} - {{ row.id_user}}
                                </td>
                                <td 
                                v-else 
                                >
                                </td>

                                <td>{{row.created_at}}</td>

                                <td>
                                    <div  class="my-1 d-flex flex-row">
                                        <v-tooltip top>
                                            <template v-slot:activator="{ on, attrs }">
                                                <v-btn class="mx-1" @click="deleted(row)" dark elevation="1" fab x-small v-bind="attrs" v-on="on" :hover="false" color="grey lighten-3">
                                                    <v-icon color="grey lighten-1">
                                                        mdi-trash-can-outline
                                                    </v-icon>
                                                </v-btn>
                                            </template>
                                            <span>Eliminar</span>
                                        </v-tooltip>
                                        <v-tooltip top>
                                            <template v-slot:activator="{ on, attrs }">
                                                <v-btn class="mx-1" @click="edit(row)" dark elevation="1" fab  x-small v-bind="attrs" v-on="on" color="grey lighten-3">
                                                    <v-icon color="grey lighten-1">
                                                        mdi-pencil
                                                    </v-icon>
                                                </v-btn>
                                            </template>
                                            <span>Editar</span>
                                        </v-tooltip>
                                    </div>
                                </td>
                                
                              </tr>
                          </tbody>
                          </template>
                      </v-simple-table>
              </template>
          </div>
      `,
    props: ["table", "columns", "url_actions", "admin", "country_admin", "pagination"],
    data() {
        return {
            dialogMediaScreen: {
                display: false,
                title: 'Eliminar asignado',

            },
            dataDelete: {
                data: [],
                url: {
                    delete: API_BASE_CONTROLLER + 'coberturaController.php?cobertura=removeAndDelete'
                },

            }
        }

    },
    methods: {
        showDialog(item) {
            this.$emit("childrenDialog", true);

            this.$emit("childrenBodyDialogTemplate", item);
        },
        closedDialogOutSide() {
            // This closes the dialog when clicking outside of its container.
            this.$emit("childrenDialog", false);
        },
        colorByType(type) {

            if (type === 'recolector') {
                return 'success'
            }
            if (type === 'comercio') {
                return 'amber accent-3'
            }
            if (type === 'correo') {
                return 'primary'
            }
            if (type === 'terminal') {
                return 'red lighten-1'
            }
        },
        deleted(data) {
            this.dialogMediaScreen.display = true
            this.dataDelete.data = data

        },
        edit(data) {
            console.log(data)
        },
        $_setMessage(message) {
            this.$emit("setSnack", message)
        },
        $_setResponse(data) {
            const reduce = this.table.dataResponseDB.filter(item => item.id !== data)
            this.$emit("setResponse", reduce)
            this.$emit("subtract", -1)
        }


    },
    computed: {
        headers() {
            return this.columns;
        },

    },

});