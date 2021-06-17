Vue.component("table-history-coverage", {
    template: /*html*/ `
          <div>
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
                                <template v-if="row.motive !== '' && row.motive !== null ">
                                    <td>
                                    {{row.motive}}
                                    </td>
                                </template>
                                <template v-else>
                                    <td>
                                        <strong> REEMPLAZADO </strong>
                                    </td>
                                </template>

                                <template v-if="status(row) !== '' && status(row) !== undefined">
                                    <td>
                                        <v-chip color="error">
                                        {{status(row)}}
                                        </v-chip>
                                    </td>
                                </template>
                                <template v-else>
                                    <td>         
                                    </td>
                                </template>
                              </tr>
                          </tbody>
                          </template>
                      </v-simple-table>
              </template>
          </div>
      `,
    props: ["table", "columns", "admin", "country_admin", "pagination"],
    data() {
        return {
            colorChip: '',

        }

    },
    methods: {
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
        status(data) {
            if (data.status_process === 'down' || data.status_process === 'sign_contract' || data.status_process === 'signed_contract' || data.status_process === 'registered') {
                return 'Inactivo'
            }
        }
    },





});