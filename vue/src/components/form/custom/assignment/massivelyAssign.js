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
                                    En los registros que deseas actualizar hay clientes asignados. ¿Deseas aplicar esta actualizacion en todos los registros?
                                </span>
                            </v-col>
                            
                        </v-row>
                    </v-card-title>
                    <v-card-actions>
                        <v-btn @click="_toAssign(false)" color="success">
                         Aplicar a todo
                        </v-btn>
                        <v-btn @click="_toAssign(true)" color="error">
                         No aplicar
                        </v-btn>
                    </v-card-actions>
                </d-small-screen>
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
            </v-row>
        </div>
        `,
    props: ['resources', 'automaticallyAssign'],
    data() {
        return {
            askForUpdate: {
                display: false,
            }
        }
    },
    methods: {
        async _askForUpdate() {
            const url = this.automaticallyAssign.url.getData
            const dataRequest = {
                purse: this.resources.parametersDynamicToPaginate.word,
                start: this.resources.parametersDynamicToPaginate.start,
                end: this.resources.parametersDynamicToPaginate.end,
            }
            await axios.get(url, { params: { dataRequest } })
                .then(res => {
                    if (res.data.success) { this.askForUpdate.display = true; return; }
                    this._toAssign(false);
                })
                .catch(err => {
                    console.log(err)
                })
        },
        async _toAssign(condition) {
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
                    console.log(res)
                })
                .catch(err => {
                    console.log(err)
                })
        }
    }
})