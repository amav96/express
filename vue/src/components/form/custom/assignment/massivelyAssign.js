Vue.component('massively-assign', {
    template: //html 
        `
        <div >
            <template>
                <d-small-screen v-if="askForUpdate.display" :dialogSmallScreen="askForUpdate">
                    <v-card-title >
                        <v-row class="d-flex justify-center flex-row my-0 py-0" >
                            <v-col cols="12" xl="2" lg="2" sm="2" xs="2" >
                                <v-btn @click="askForUpdate.display = false" class="my-0" color="error" fab x-small>
                                    <v-icon>mdi-close</v-icon>
                                </v-btn>
                            </v-col>
                            <v-col cols="12" xl="10" lg="10" sm="10" xs="10" >
                                <span class="text-sm-body-1 mt-0">
                                    En el rango de <strong>{{resources.parametersDynamicToPaginate.start}} </strong> hasta el <strong>{{resources.parametersDynamicToPaginate.end}} </strong> hay <strong>
                                    {{askForUpdate.countTotal}}</strong> registros de los cuales <strong>{{askForUpdate.countAssigned}}</strong> estan asignados. ¿Deseas aplicar esta asignación a todos los registros?
                                </span>
                            </v-col>  
                        </v-row>
                    </v-card-title>
                    <v-card-actions>
                        <v-btn @click="_toAssign(false)" color="success" :disabled="loading">
                         Si
                        </v-btn>
                        <v-btn @click="_toAssign(true)" color="error" :disabled="loading">
                         Solo no asignados
                        </v-btn>
                    </v-card-actions>
                    <template v-if="loading">
                        <v-card-text class="d-flex justify-center">
                            <v-progress-circular
                            indeterminate
                            size="35"
                            color="info"
                            class="my-1"
                            ></v-progress-circular>
                        </v-card-text>
                    </template>
                </d-small-screen>
            </template>

            <template v-if="snackbarInfo.display" >
                <v-snackbar
                    v-model="snackbarInfo.display" :timeout="snackbarInfo.timeout" multi-line
                    top right color="error"
                >
                <span class="text-white" >{{snackbarInfo.text}}</span>
                    <template v-slot:action="{ attrs }">
                        <v-btn color="white" text v-bind="attrs" @click="recordsWithoutCollector.display = true">
                            Ver
                        </v-btn>
                        <v-btn color="white" text v-bind="attrs" @click="snackbarInfo.display = false"  >
                            Cerrar
                        </v-btn>
                    </template>
                </v-snackbar>
            </template>

            <template v-if="recordsWithoutCollector.display">
                <d-media-screen :dialogMediaScreen="recordsWithoutCollector">
                    <v-row class="d-flex flex-row justify-start mx-0" >
                        <v-col cols="12" xl="2" lg="2" md="2" sm="2" xs="2">
                            <v-tooltip bottom>
                                <template v-slot:activator="{ on, attrs }">
                                    <div v-bind="attrs" v-on="on" class="my-2">
                                        <a style="text-decoration:none;color:black;" @click="openAssignamentByZone()" >
                                            <div class="item">
                                                <i  class="fas fa-globe-americas"></i>
                                            </div>
                                        </a>
                                    </div> 
                                </template>
                                <span>Asignación de zona</span>
                            </v-tooltip>

                        </v-col>
                        <v-col cols="12" xl="2" lg="2" md="2" sm="2" xs="2">
                            <VueExcelXlsx 
                            :columnExport="recordsWithoutCollector.columns"  
                            :data="recordsWithoutCollector.data"
                            filename="Clientes sin recolectores en zona"
                            >
                                <v-btn
                                color="success"
                                fab
                                x-small
                                class="my-3 mx-2"
                                >
                                    <v-icon>
                                        mdi-file-excel-outline
                                    </v-icon>
                                </v-btn>
                            </VueExcelXlsx>
                        </v-col>
                    </v-row>
                    <template v-if="recordsWithoutCollector.dataGroup.length > 0">
                        <div class="mx-2 my-2">
                            <v-chip @click="recordsWithoutCollector.search = item" class="mx-1 my-1" v-for="(item,index) in recordsWithoutCollector.dataGroup" :key="index" >
                            {{item}}
                            </v-chip>
                        </div>
                    </template>
                    <div>
                        <v-card class="mx-auto">
                            <v-card-title>
                                <v-text-field
                                v-model="recordsWithoutCollector.search"
                                append-icon="mdi-magnify"
                                label="Buscar"
                                single-line
                                hide-details
                                ></v-text-field>
                            </v-card-title>
                            <v-data-table
                                :headers="recordsWithoutCollector.columns"
                                :items="recordsWithoutCollector.data"
                                :search="recordsWithoutCollector.search"
                            ></v-data-table>
                        </v-card>
                    </div> 
                </d-media-screen>
            </template>
            
            <v-row class="d-flex justify-start flex-column my-0" >
                <div>
                    <v-btn color="warning" @click="_askForUpdate()">
                    Asignar masivamente
                        <v-icon light>
                        mdi-flash
                        </v-icon>
                    </v-btn>
                </div>
                <div class="my-2 mx-2" >
                    Desde
                    <v-chip color="success">
                        {{resources.parametersDynamicToPaginate.start}}
                    </v-chip>
                    Hasta
                    <v-chip color="success">
                    {{resources.parametersDynamicToPaginate.end}}
                    </v-chip>
                </div>
                <template v-if="loading && !askForUpdate.display">
                    <div class="my-2 mx-auto" >
                        <v-progress-circular
                        indeterminate
                        size="35"
                        color="info"
                        class="my-1"
                        ></v-progress-circular>
                    </div>
                </template>
            </v-row>
        </div>
        `,
    props: ['resources', 'automaticallyAssign'],
    data() {
        return {
            askForUpdate: {
                display: false,
                countAssigned: 0,
                countTotal: 0,

            },
            loading: false,
            snackbarInfo: {
                display: false,
                text: '',
                timeout: -1
            },
            recordsWithoutCollector: {
                display: false,
                data: [],
                title: 'Clientes sin recolector en zona',
                columns: [
                    { text: 'Codigo postal', value: 'codigo_postal', field: 'codigo_postal', label: 'Codigo postal' },
                    { text: 'Localidad', value: 'localidad', field: 'localidad', label: 'Localidad', },
                    { text: 'Provincia', value: 'provincia', field: 'provincia', label: 'Provincia', },
                    { text: 'Direccion', value: 'direccion', field: 'direccion', label: 'Direccion', },
                    { text: 'Identificacion', value: 'identificacion', field: 'identificacion', label: 'Identificacion', },
                    { text: 'Serie', value: 'serie', field: 'serie', label: 'Serie', },
                    { text: 'Cartera', value: 'cartera', field: 'cartera', label: 'Cartera', },
                    { text: 'Nombre C.', value: 'nombre_cliente', field: 'nombre_cliente', label: 'Nombre C' },
                    { text: 'Empresa', value: 'empresa', field: 'empresa', label: 'Empresa', label: 'Empresa' },
                ],
                search: '',
                dataGroup: []
            }
        }
    },
    methods: {
        async _askForUpdate() {

            this.loading = true
            const url = this.automaticallyAssign.url.getData
            const dataRequest = {
                purse: this.resources.parametersDynamicToPaginate.word,
                start: this.resources.parametersDynamicToPaginate.start,
                end: this.resources.parametersDynamicToPaginate.end,
            }
            await axios.get(url, { params: { dataRequest } })
                .then(res => {
                    this.loading = false
                    if (res.data.success) {
                        this.askForUpdate.display = true;
                        this.askForUpdate.countAssigned = res.data.countAssigned
                        this.askForUpdate.countTotal = res.data.countTotal
                        return;
                    }
                    this._toAssign(false);
                })
                .catch(err => {
                    this.loading = false
                    console.log(err)
                })
        },
        async _toAssign(condition) {

            this.loading = true
            const url = this.automaticallyAssign.url.save
            const dataRequest = {
                purse: this.resources.parametersDynamicToPaginate.word,
                start: this.resources.parametersDynamicToPaginate.start,
                end: this.resources.parametersDynamicToPaginate.end,
                admin: document.getElementById("id_user_default").value
            }
            if (condition) { dataRequest['condition'] = true }
            await axios.get(url, { params: { dataRequest } })
                .then(res => {

                    this.loading = false
                    this.askForUpdate.display = false
                    if (res.data.error && res.data.error === "not_data_avaible") {
                        this.$message('No hay registros disponibles para asignar', 'error', 10000);
                        return
                    }
                    if (res.data.error && res.data.error === "records_without_collector") {
                        this.$message('Los registros a actualizar no tienen recolectores asignados en su codigo postal', 'error', 10000);
                        const grouped = this.groupBy(res.data.empty, data => data.codigo_postal);
                        const postal_codes = []
                        grouped.forEach((val) => {
                            postal_codes.push(val[0].codigo_postal)
                        })
                        if (postal_codes && postal_codes.length > 0) {
                            this.recordsWithoutCollector.dataGroup = postal_codes
                        }
                        this.recordsWithoutCollector.data = res.data.empty
                        this.snackbarInfo.display = true
                        this.snackbarInfo.text = res.data.empty.length + ' Registros sin recolectores asignados en zona '
                        return
                    }
                    if (res.data.error && res.data.error === "failed_update") {
                        this.$message('La actualizacion no se realizo correctamente', 'error', 10000);
                        return
                    }

                    if (res.data.success) {
                        this.$message(res.data.countSuccess + ' Registros asignados correctamente', 'success', 10000);
                        this.$emit("realoadPaginate")

                        if (res.data.empty && res.data.empty.length > 0) {

                            const grouped = this.groupBy(res.data.empty, data => data.codigo_postal);
                            const postal_codes = []
                            grouped.forEach((val) => {
                                postal_codes.push(val[0].codigo_postal)
                            })
                            if (postal_codes && postal_codes.length > 0) {
                                this.recordsWithoutCollector.dataGroup = postal_codes
                            }

                            this.recordsWithoutCollector.data = res.data.empty
                            this.snackbarInfo.display = true
                            this.snackbarInfo.text = 'Quedaron ' + res.data.empty.length + ' registros sin asignar porque no tienen recolector asignado en zona';
                        }

                    }

                })
                .catch(err => {
                    this.loading = false
                    this.askForUpdate.display = false
                    console.log(err)
                })
        },
        $message(msg, color, time) {
            const snack = { display: true, timeout: time, text: msg, color: color }
            this.$emit("setSnack", snack)
        },
        openAssignamentByZone() {
            var url = API_BASE_URL + 'cobertura/admin'
            window.open(url, '_blank');
        },
        groupBy(list, keyGetter) {
            const map = new Map();
            list.forEach((item) => {
                const key = keyGetter(item);
                const collection = map.get(key);
                if (!collection) {
                    map.set(key, [item]);
                } else {
                    collection.push(item);
                }
            });
            return map;
        },
        group(list, key) {
            const arr = []
            list.forEach((item) => {
                arr.push(item.key)
                if (item.key) {

                }
            })

        }
    }
})