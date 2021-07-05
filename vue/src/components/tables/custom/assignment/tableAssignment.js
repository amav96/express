Vue.component('table-assignment', {
    template: //html 
        `
    <div>
          
        <v-simple-table class="mt-6" >
            <thead>
                <tr  class="bg-blue-custom">
                    <th v-for="column in columns"  class="text-left text-white">
                        <template v-if="column.icon" >
                            <v-btn fab color="white" x-small  @click="handle_function_call(column.method)">
                                <v-icon>
                                    <template v-if="select.selected &&  select.selected.length < 1">
                                        {{column.icon}}
                                    </template>
                                    <template v-else>
                                        {{column.alt_icon}}
                                    </template>
                                </v-icon>
                            </v-btn>
                        </template>
                        <template v-else>
                            {{column.text}}
                        </template>
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="row in resources.table.dataResponseDB">
                    <td>
                        <v-checkbox
                        v-model="select.selected"
                        :value="row.id"
                        ></v-checkbox>
                    </td>
                    <td><strong>{{row.codigo_postal}}</strong></td>
                    <td>{{row.localidad}}</td>
                    <td>{{row.provincia}}</td>
                    <td>{{row.direccion}}</td>
                    <td>{{row.identificacion}}</td>
                 
                    <td> {{getuserbyzone}} </td>
                        <template v-if="row.id_user_assigned && row.id_user_assigned !== '' && row.id_user_assigned !== null">
                           <td>
                            <v-chip color="success" class="white-text">
                                {{row.name_assigned }} {{row.name_alternative}} - {{row.id_user_assigned}}
                            </v-chip>
                           </td>
                        </template>
                        <template v-else>
                           <td>
                           <v-chip color="error" class="white-text">
                             No
                           </v-chip>
                          </td>
                        </template>
                    <td>{{row.nombre_cliente}}</td>
                    <td>{{row.empresa}}</td>
                    
                </tr>
            </tbody>
        </v-simple-table>
    </div>
    `,
    props: ['resources', 'columns'],
    computed: {
        getuserbyzone() {

            setTimeout(() => {
                return 'esta'
            }, 2000);

        }
    },
    data() {
        return {
            select: {
                selected: [],

            }
        }
    },
    methods: {
        handle_function_call(function_name) {
            this[function_name]()
        },
        $_selectAll() {
            if (this.select.selected && this.select.selected.length < 1) {
                this.resources.table.dataResponseDB.forEach((val) => {
                    this.select.selected.push(val.id)
                })
            } else {
                this.select.selected = []
            }

        },
        cleanSelected() {
            this.select.selected = []
        },
        getUserByZone() {

        }


    },
    watch: {
        select: {
            handler(val) {
                this.$emit("setSelected", val.selected)
            },
            deep: true
        }
    },

})