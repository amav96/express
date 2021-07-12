Vue.component('table-assignment', {
    template: //html 
        `
    <div>
    <v-container>
        <template v-if="manualAssignment.display && select.selected.length > 0">
            <d-small-screen
             :dialogSmallScreen="manualAssignment"
            >
                <v-container>
                  <manual-assignment
                  :manualAssignment="manualAssignment"
                  :select="select"
                  @setUser="id_user = $event"
                  @manualAssigned="_manualAssigned($event)"
                  />
                </v-container>
            </d-small-screen>
        </template>

       
        <v-row class="d-flex justify-start flex-row flex-wrap my-2">
                <div class="ma-2">
                    <v-btn :disabled="select.selected.length<1 || btnDisabled" color="info" @click="_automaticAssigned">
                        Asignar automáticamente
                    </v-btn>
                </div>
                <div class="ma-2">
                    <v-btn :disabled="select.selected.length<1 || btnDisabled" @click="manualAssignment.display = true" color="warning">
                        Asignar manualmente
                    </v-btn>
                </div>
                <div class="ma-2">
                    <v-btn :disabled="select.selected.length<1 || btnDisabled" color="error" @click=_removeAssigned>
                        Quitar asignado
                    </v-btn>
                </div>
                <template v-if="select.selected.length>0 || btnDisabled">
                    <div class="ma-2">
                        <v-chip >
                        Seleccionados {{select.selected.length}}
                        </v-chip>
                    </div>
                </template>
            </v-row>
      

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
                   
                    <template v-if="row.id_user_assigned && row.id_user_assigned !== '' && row.id_user_assigned !== null">
                        <input type="checkbox" ref="check" v-model="select.selected" :value="returnValueSelected(row.id,row.belongs.id_user)" :disabled="!row.belongs" >
                    </template>
                    <template v-else>
                        <input type="checkbox" ref="check" v-model="select.selected" :value="returnValueSelectedEmpty(row.id,row.belongs.id_user)" :disabled="!row.belongs" >
                    </template>
                    </td>
                    <td><strong>{{row.codigo_postal}}</strong></td>
                    <td>{{row.localidad}}</td>
                    <td>{{row.provincia}}</td>
                    <td>{{row.direccion}}</td>
                    <td>{{row.identificacion}}</td>
                    <td>{{row.serie}}</td>
                    
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
                        <td>{{row.cartera}}</td>
                        <td>{{row.estado}}</td>
                    <td>{{row.nombre_cliente}}</td>
                    <td>{{row.empresa}}</td>
                </tr>
            </tbody>
        </v-simple-table>
    </div>
    `,
    props: ['resources', 'columns', 'data', 'manualAssignment'],

    data() {
        return {
            select: {
                selected: [],
            },
            id_user: '',
            btnDisabled: false
        }
    },
    methods: {
        handle_function_call(function_name) {
            this[function_name]()
        },
        $_selectAll() {
            if (this.select.selected && this.select.selected.length < 1) {
                this.resources.table.dataResponseDB.forEach((val, index) => {
                    if (val.belongs) {
                        this.$refs.check[index].checked = true
                        const value = { id: val.id, id_user: val.belongs.id_user }
                        this.select.selected.push(value)
                    }


                })
            } else {
                this.select.selected = []
                this.$refs.check.forEach((val) => {
                    if (val.checked) val.checked = false
                })
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
                id_user: belongs,
                empty: false
            }
            return value
        },
        returnValueSelectedEmpty(id, belongs) {
            const value = {
                id,
                id_user: belongs,
                empty: true
            }
            return value
        },
        _automaticAssigned() {
            this.btnDisabled = true
            const url = this.resources.url_actions.toAssign
            const dataRequest = {
                value: this.select.selected,
                created_at: this.getDateTime(),
                admin: this.resources.admin
            }
            axios.get(url, { params: { dataRequest } })
                .then(res => {
                    this.btnDisabled = false
                    if (res.data.error) {
                        this.$message('Se ha producido una excepción', 'error');
                        return
                    }
                    this.$emit("realoadCurrentPage")

                    this.$nextTick(() => {
                        this.$message('Realizado correctamente', 'success');
                        this.resetCheckbox()

                    })

                })
                .catch(err => {
                    console.log(err)
                })
        },
        _manualAssigned() {
            this.btnDisabled = true
            const url = this.resources.url_actions.toAssign
            var value = []
            this.select.selected.forEach((val) => {
                value.push({ id: val.id, id_user: this.id_user })
            })
            const dataRequest = {
                value: value,
                created_at: this.getDateTime(),
                admin: this.resources.admin
            }
            axios.get(url, { params: { dataRequest } })
                .then(res => {
                    this.btnDisabled = false
                    if (res.data.error) {
                        this.$message('Se ha producido una excepción', 'error');
                        return
                    }
                    this.$emit("realoadCurrentPage")
                    this.manualAssignment.display = false
                    this.$nextTick(() => {
                        this.$message('Realizado correctamente', 'success');
                        this.resetCheckbox()
                    })

                })
                .catch(err => {
                    console.log(err)
                })
        },
        _removeAssigned() {
            this.btnDisabled = true
            const value = this.select.selected.filter(item => !item.empty)

            if (value.length < 1) {
                this.$message('Los registros seleccionados no estan asignados', 'error');
                this.btnDisabled = false
                return
            }

            const url = this.resources.url_actions.removeAssign
            const dataRequest = {
                value: value,
                created_at: this.getDateTime(),
                admin: this.resources.admin
            }
            axios.get(url, { params: { dataRequest } })
                .then(res => {
                    this.btnDisabled = false
                    if (res.data.error) {
                        this.$message('Se ha producido una excepción', 'error');
                        return
                    }
                    this.$emit("realoadCurrentPage")
                    this.manualAssignment.display = false
                    this.$nextTick(() => {
                        this.$message('Realizado correctamente', 'success');
                        this.resetCheckbox()
                    })

                })
                .catch(err => {
                    console.log(err)
                })


        },
        $message(msg, color) {
            const snack = { display: true, timeout: 2500, text: msg, color: color }
            this.$emit("setSnack", snack)
        },
        resetCheckbox() {
            this.select.selected = []
            this.$refs.check.forEach((val) => {
                if (val.checked) { val.checked = false }
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
        updatePagination() {
            if (this.select.selected.length < 1 && !this.resources.loadingPaginate.display) {
                this.$emit("reaload", true)
                this.$nextTick(() => {
                    this.$emit("realoadCurrentPage")
                })

            }
        },
        isSelected() {
            setInterval(() => {
                this.updatePagination()
            }, 30000)
        },

    },
    created() {
        // this.isSelected();
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