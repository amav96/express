Vue.component('table-assignment', {
    template: //html 
        `
    <div>
    <v-container>
       <template v-if="select.selected.length>0">

        <v-row class="d-flex justify-start flex-row flex-wrap my-2">
                <div class="ma-2">
                    <v-btn color="info" @click="automaticallyAssign()">
                        Asignar automáticamente
                    </v-btn>
                </div>
                
                <div class="ma-2">
                    <v-btn color="warning">
                    Asignar manualmente
                    </v-btn>
                </div>
                
                <div class="ma-2">
                    <v-chip >
                    Seleccionados {{select.selected.length}}
                    </v-chip>
                </div>
            </v-row>

       </template>
            
            
        
    </v-container>
         

        <v-simple-table class="mt-6" >
            <thead>
                <tr  class="bg-blue-custom">
                    <th v-for="column in columns"  class="text-left text-white">
                        <template v-if="column.icon && showSellectAll(resources.table.dataResponseDB)" >
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
                    <template v-if="row.belongs">
                        <v-checkbox
                        v-model="select.selected"
                        :value="returnValueSelected(row.id,row.belongs.id_user)"
                        ></v-checkbox>
                    </template>
                    
                    </td>
                    <td><strong>{{row.codigo_postal}}</strong></td>
                    <td>{{row.localidad}}</td>
                    <td>{{row.provincia}}</td>
                    <td>{{row.pais}}</td>
                    <td>{{row.direccion}}</td>
                    <td>{{row.identificacion}}</td>
                    
                    <template v-if="row.belongs" >
                        <td>
                            <v-chip color="success">
                            {{row.belongs.name}} - {{row.belongs.id_user}}
                            </v-chip>
                        </td>
                    </template>
                    <template v-else>
                        <td>   
                            <v-chip color="error">
                                Falta asignar CP
                            </v-chip>
                        </td>
                    </template>
                   
                    

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
                    <td>{{row.cartera}}</td>
                    
                </tr>
            </tbody>
        </v-simple-table>
    </div>
    `,
    props: ['resources', 'columns', 'data'],
    computed: {

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
        showSellectAll(data) {
            var assignable = []
            data.forEach((val) => { if (val.belongs) assignable.push(val) })
            if (assignable.length > 0) { return true } else { return false }
        },
        returnValueSelected(id, belongs) {
            const value = {
                id,
                id_user: belongs
            }
            return value
        },
        automaticallyAssign() {
            const url = this.resources.url_actions.automaticallyAssign
            const dataRequest = {
                value: this.select.selected,
                created_at: this.getDateTime(),
                admin: this.resources.admin
            }
            axios.get(url, { params: { dataRequest } })
                .then(res => {
                    console.log(res)
                })
                .catch(err => {
                    console.log(err)
                })
        },
        getDateTime() {
            var today = new Date();
            var getMin = today.getMinutes();
            var getSeconds = today.getSeconds()
            var getHours = today.getHours()

            if (getMin < 10) { getMin = '0' + today.getMinutes() }
            if (getSeconds < 10) { getSeconds = '0' + today.getSeconds() }
            if (getHours < 10) { getHours = '0' + today.getHours() }

            var created_at = today.getFullYear() + '-' + ("0" + (today.getMonth() + 1)).slice(-2) + '-' +
                ("0" + today.getDate()).slice(-2) + ' ' + getHours + ':' + getMin + ':' + getSeconds;

            return created_at
        },


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