Vue.component("table-cobertura", {
    template: /*html*/ `
          <div>
               
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
                                <td>{{row.type}}</td>
                                <td 
                                v-if="row.name_assigned !== '' && row.name_assigned !== null && row.name_assigned !== '0' && row.name_assigned !== 0 && row.name_assigned"
                                >
                                    {{row.name_assigned}} - {{ row.id_user}}
                                </td>
                                <td 
                                v-else 
                                >
                                </td>
 

                                <td>{{row.created_at}}</td>
                                
                              </tr>
                          </tbody>
                          </template>
                      </v-simple-table>
              </template>
          </div>
      `,
    props: ["table", "columns", "url_actions", "admin", "country_admin", "pagination"],
    methods: {
        showDialog(item) {
            this.$emit("childrenDialog", true);

            this.$emit("childrenBodyDialogTemplate", item);
        },
        closedDialogOutSide() {
            // This closes the dialog when clicking outside of its container.
            this.$emit("childrenDialog", false);
        },

    },
    computed: {
        headers() {
            return this.columns;
        },

    },

});