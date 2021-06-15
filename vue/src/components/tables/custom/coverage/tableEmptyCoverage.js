Vue.component("table-empty-coverage", {
    template: /*html*/ `
          <div>

                <template  >
                    <d-full-screen :dialogFullScreen="dialogFullScreen">
                    jejejejeje
                    </d-full-screen>
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
                            <tr v-for="row in table.dataResponseDB">
                                <td>{{row.postal_code}}</td>
                                <td>{{row.locate}}</td>
                                <td>{{row.provinceInt}}</td>
                                <td>{{row.province}}</td>
                                <td>{{row.name_country}}</td>
                                <td>
                                    <div  class="my-1 d-flex flex-row">
                                        <v-tooltip top>
                                            <template v-slot:activator="{ on, attrs }">
                                                <v-btn class="mx-1" @click="toRegister(row)"  fab  x-small v-bind="attrs" v-on="on" color="success">
                                                    <v-icon color="white">
                                                        mdi-shield-check
                                                    </v-icon>
                                                </v-btn>
                                            </template>
                                            <span>Alta</span>
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
            dialogFullScreen: {
                display: false,
                title: ''
            },
        }

    },
    methods: {

        toRegister(data) {
            this.dialogFullScreen.display = true
        }
    },




});