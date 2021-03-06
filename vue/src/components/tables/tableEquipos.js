Vue.component("table-equipos", {
    template: /*html*/ `
        <div>

            <template>
                    <dialog-equipos-update
                    :dialogUpdate="dialogUpdate"
                    :editedItem="editedItem"
                    :title="title"
                    @openDialog="dialogUpdate = $event"
                    @updateRow="updateRow"
                    :status="status" 
                    :accesorios="accesorios"
                    :message="message"
                    :alert_flag="alert_flag"
                    @message="message = $event"
                    @alert_flag="alert_flag = $event"
                    @setDisabled="updateProperty.disabled = $event"
                    :updateProperty="updateProperty"
                    />
            </template>
            
            <template>
                <dialog-equipos-delete
                :dialogDelete="dialogDelete"
                :title="title"
                @openDialog="dialogDelete = $event"
                @deleteRow="deleteRow"
                :deleteProperty="deleteProperty"
                />
            </template>

            <template>
                <dialog-send-invoice
                    @openDialog="sendInvoice.dialog = $event"
                    :sendInvoice="sendInvoice"
                    :admin = "admin"
                    :url_actions="url_actions"
                />
            </template>

            <template>
                <dialog-detail-notice
                    :detailNotice="detailNotice"
                    @openDialog="detailNotice.dialog = $event"
                    :admin="admin"
                />
            </template>

                <template v-if="t === 'gestion'">

                    <v-simple-table>
                        <template v-slot:default>
                            <thead>
                                <tr  class="bg-blue-custom">
                                    <th v-for="column in columns" class="text-left text-white">
                                    {{column.text}}
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr 
                                v-for="row in table.dataResponseDB"
                                >
                                    <td>
                                        <span v-if="row.contacto === '' || row.contacto === null" >
                                        </span>
                                        <v-btn v-else 
                                        color="indigo"
                                        small @click="openDialogDetailNotice(true,row)"
                                        >
                                            <v-icon color="white" left>
                                            mdi-email-open-outline
                                            </v-icon>
                                            <span class="text-white" >detalle </span>
                                            
                                        </v-btn>
                                    
                                    </td>

                                    <td style="color:#0093f5;" ><strong> {{row.identificacion}} </strong></td>
                                    <td><strong>{{row.estado}}</strong></td>
                                    <td><strong>{{row.created_at}}</strong></td>
                                    <td>{{row.empresa}}</td>
                                    <td>{{row.terminal}}</td>
                                    <td>{{row.serie}}</td>

                                    <td>
                                    {{row.name}} - {{row.recolector}}
                                    </td>
                                    <td>{{row.serie_base}}</td>
                                    <td>{{row.tarjeta}}</td>
                                    <td>{{row.chip_alternativo}}</td>
                                    <td>{{row.accesorio_uno}}</td>
                                    <td>{{row.accesorio_dos}}</td>
                                    <td>{{row.accesorio_tres}}</td>
                                    <td>{{row.accesorio_cuatro}}</td>
                                    <td>{{row.motivo}}</td>
                                    <td>{{row.nombre_cliente}}</td>
                                    <td>{{row.direccion}}</td>
                                    <td>{{row.provincia}}</td>
                                    <td>{{row.localidad}}</td>
                                    <td>{{row.codigo_postal}}</td>
                                    <td >
                                    {{row.remito}}
                                    </td>
                                    <td>
                                        <v-btn 
                                        v-if="row.estado === 'RECUPERADO' || row.estado === 'AUTORIZAR'"
                                        color="blue-grey"
                                        class="white--text"
                                        @click="urlRemito(row.remito)"
                                        >
                                        Ver remito
                                        </v-btn>
                                        <span
                                        v-else
                                        >
                                        
                                        </span>
                                    </td>  
                                    
                                    <td>
                                        <v-btn  
                                        v-if="row.estado === 'RECUPERADO' || row.estado === 'AUTORIZAR'"
                                        color="warning" 
                                        @click="openDialogSendInvoice(true,row)"
                                        > 
                                            <v-icon left>
                                            mdi-email-plus
                                            </v-icon>
                                            Enviar Remito
                                        </v-btn>
                                        <span
                                        v-else
                                        >
                                        
                                        </span>
                                    </td>

                                    <td>
                                        <v-btn 
                                        v-if="row.estado !== '' && row.estado !== null"
                                        color="error" small @click="openDialogDelete(true,row)" class="ma-1" >
                                            <v-icon left>
                                                    mdi-trash-can-outline
                                            </v-icon>
                                            Eliminar 
                                        </v-btn>
                                        <v-btn
                                        v-if="row.estado !== '' && row.estado !== null"
                                        color="success" small @click="openDialogEdit(true,row)" class="ma-1" >
                                            <v-icon left>
                                                        mdi-pencil
                                            </v-icon>
                                            Editar 
                                        </v-btn>
                                    </td> 
                                </tr>
                            </tbody>
                        </template> 
                    </v-simple-table>
                </template>

                <template v-if="t === 'equipos'">

                    <v-simple-table>
                        <template v-slot:default>
                            <thead>
                                <tr  class="bg-blue-custom">
                                    <th v-for="column in columnsAlternative" class="text-left text-white">
                                    {{column.text}}
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="row in table.dataResponseDB">
                                    <td style="color:#0093f5;" ><strong> {{row.identificacion}} </strong></td>
                                    <td><strong>{{row.estado}}</strong></td>
                                    <td>{{row.empresa}}</td>
                                    <td>{{row.terminal}}</td>
                                    <td>{{row.serie}}</td>
                                    <td>{{row.emailcliente}}</td>
                                    <td>{{row.serie_base}}</td>
                                    <td>{{row.tarjeta}}</td>
                                    <td>{{row.nombre_cliente}}</td>
                                    <td>{{row.direccion}}</td>
                                    <td>{{row.provincia}}</td>
                                    <td>{{row.localidad}}</td>
                                    <td>{{row.codigo_postal}}</td>
                                </tr>
                            </tbody>
                        </template>
                    </v-simple-table>
                </template>
        </div>
    `,
    props: [
        "dataResponseDB",
        "columns",
        "columnsAlternative",
        "url_actions",
        "pagination",
        "admin",
        "country_admin",
        'table',
        't'
    ],
    data() {
        return {
            search: "",
            page: 1,
            editedItem: [],
            dialogUpdate: false,
            dialogDelete: false,
            accesorios: ["si entrego", "no entrego"],
            status: [],
            message: "",
            alert_flag: false,
            title: "",
            snackbar: {
                snack: false,
                textSnack: "",
                timeout: 2000,
            },
            sendInvoice: {
                dialog: false,
                title: "",
                data: [],
                characteristic: [{ number: "+54" }, { number: "+598" }],
            },
            detailNotice: {
                dialog: false,
                data: []
            },
            updateProperty: {
                disabled: false
            },
            deleteProperty: {
                disabled: false
            },

        };
    },
    methods: {
        filterOnlyCapsText(value, search, item) {
            return (
                value != null &&
                search != null &&
                typeof value === "string" &&
                value.toString().toLocaleUpperCase().indexOf(search) !== -1
            );
        },
        showDialog(item) {
            this.$emit("childrenDialog", true);

            this.$emit("childrenBodyDialogTemplate", item);
        },
        closedDialogOutSide() {
            // This closes the dialog when clicking outside of its container.
            this.$emit("childrenDialog", false);
        },
        urlRemito(remito) {
            window.open(
                this.url_actions.showInvoice + "&cd=" + remito + "&tp=rmkcmmownloqwld",
                "_blank"
            );
        },
        openDialogEdit(bool, data) {
            this.editedItem = data;

            this.dialogUpdate = bool;
            this.title = "Editar equipos gestionados";
            if (this.status.length === 0) {
                const url = this.url_actions.status;
                axios
                    .get(url)
                    .then((res) => {
                        if (res.data.error) {
                            alertNegative("Mensaje CODIGO 53");
                            return;
                        }
                        this.status = res.data;
                    })
                    .catch((err) => {
                        console.log(err);
                    });
            }
        },
        openDialogDelete(bool, data) {
            this.editedItem = data;
            this.dialogDelete = bool;
            this.title = "¿Estas seguro/a?";
        },
        openDialogSendInvoice(bool, data) {
            this.sendInvoice.data = data;
            this.sendInvoice.dialog = bool;
            this.sendInvoice.title = "Enviar remito";
        },
        openDialogDetailNotice(bool, data) {
            this.detailNotice.dialog = bool;
            this.detailNotice.data = data;
        },
        updateRow() {
            var hoy = new Date();
            var getMinutos = hoy.getMinutes();
            var getSegundos = hoy.getSeconds();
            var getHora = hoy.getHours();

            if (getMinutos < 10) {
                getMinutos = "0" + hoy.getMinutes();
            }
            if (getSegundos < 10) {
                getSegundos = "0" + hoy.getSeconds();
            }
            if (getHora < 10) {
                getHora = "0" + hoy.getHours();
            }

            var created_at =
                hoy.getFullYear() +
                "-" +
                ("0" + (hoy.getMonth() + 1)).slice(-2) +
                "-" +
                ("0" + hoy.getDate()).slice(-2) +
                " " +
                getHora +
                ":" +
                getMinutos +
                ":" +
                getSegundos;

            const dataRequest = {
                id_equipo: this.editedItem.id_equipo,
                id: this.editedItem.id_gestion,
                estado: this.editedItem.estado,
                serie: this.editedItem.serie,
                terminal: this.editedItem.terminal,
                accesorio_uno: this.editedItem.accesorio_uno,
                accesorio_dos: this.editedItem.accesorio_dos,
                accesorio_tres: this.editedItem.accesorio_tres,
                accesorio_cuatro: this.editedItem.accesorio_cuatro,
                created_at,
                id_user_update: this.admin,
            };
            const url = this.url_actions.update_management

            axios
                .get(url, {
                    params: {
                        dataRequest,
                    },
                })
                .then((res) => {
                    if (res.data.error) {
                        this.updateProperty.disabled = false
                        const snackbar = { display: true, text: 'Algo salio mal 107', timeout: 3500, color: 'error' }
                        this.$emit("setSnackbar", snackbar)
                        this.dialogUpdate = false;
                        return;
                    }

                    const snackbar = { display: true, text: 'Actualizado correctamente', timeout: 3500, color: 'success' }
                    this.$emit("setSnackbar", snackbar)
                    this.updateProperty.disabled = false
                    this.dialogUpdate = false;
                })
                .catch((err) => {
                    this.updateProperty.disabled = false
                    console.log(err);
                });
        },
        deleteRow() {
            this.deleteProperty.disabled = true
            const id_gestion = this.editedItem.id_gestion;
            const id_equipo = this.editedItem.id_equipo;


            var hoy = new Date();
            var getMinutos = hoy.getMinutes();
            var getSegundos = hoy.getSeconds();
            var getHora = hoy.getHours();

            if (getMinutos < 10) {
                getMinutos = "0" + hoy.getMinutes();
            }
            if (getSegundos < 10) {
                getSegundos = "0" + hoy.getSeconds();
            }
            if (getHora < 10) {
                getHora = "0" + hoy.getHours();
            }

            var created_at =
                hoy.getFullYear() +
                "-" +
                ("0" + (hoy.getMonth() + 1)).slice(-2) +
                "-" +
                ("0" + hoy.getDate()).slice(-2) +
                " " +
                getHora +
                ":" +
                getMinutos +
                ":" +
                getSegundos;

            const url = this.url_actions.delete_management;
            const dataRequest = {
                id_gestion,
                id_equipo,
                created_at,
                id_user_update: this.admin,
            };
            axios
                .get(url, {
                    params: {
                        dataRequest,
                    },
                })
                .then((res) => {
                    if (res.data.error) {
                        const snackbar = { display: true, text: 'Algo salió mal 101', timeout: 3500, color: 'error' }
                        this.$emit("setSnackbar", snackbar)
                        this.deleteProperty.disabled = false
                        return;
                    }
                    const snackbar = { display: true, text: 'Eliminado correctamente', timeout: 3500, color: 'success' }
                    this.$emit("setSnackbar", snackbar)

                    const data = this.table.dataResponseDB;
                    const totalCountCurrent = this.pagination.totalCountResponse - 1
                    this.$emit("subtractTotalCount", totalCountCurrent)
                    const found = data.filter((data) => data.id_gestion !== id_gestion);
                    this.$emit("updateDelete", found);
                    this.dialogDelete = false;
                    this.deleteProperty.disabled = false
                })
                .catch((err) => {
                    console.log(err);
                });
        },

    },
    computed: {
        headers() {
            return this.columns;
        },

    },

});