Vue.component('filter-with-pagination', {
    template: //html 
        `
        <div>
            <v-container>
            <v-form @submit.prevent="tryFilter" id="form-search">
                <v-row>
                    <v-col cols="12"md="4">
                        <v-text-field
                        v-model="data"
                        label="Buscar"
                        >
                        </v-text-field>
                    </v-col>
                    <v-col cols="12"md="3">
                        <v-btn
                        color="primary"
                        fab
                        small
                        primary
                        form="form-search"
                        type="submit"
                        :disabled="data === ''"
                        >
                            <v-icon>mdi-magnify</v-icon>
                        </v-btn>
                    </v-col>
                    <transition name="slide-fade">
                        <v-col cols="12"md="4">
                        <v-alert 
                        v-if="alert_flag"
                        type="info"
                        >No hay coincidencias para <strong>"{{data}}"</strong>
                        </v-alert>
                        </v-col>
                    </transition>
                </v-row>
                <v-progress-linear
                v-if="loaderFilter"
                color="black"
                indeterminate
                rounded
                height="6"
              ></v-progress-linear>
            </v-form>
            </v-container>
        </div>
    `,
    props: ['filter', 'pagination', 'dataResponseDB', 'parametersDynamicToPaginate', 'urlTryPagination'],
    data() {
        return {
            data: '',
            oldData: '',
            objectFilter: [],
            oldParametersToCall: [],
            oldDataResponseDB: [],
            oldUrl: [],
            oldPagination: [],
            alert_flag: false,
            loaderFilter: false,
            activate: false
        }
    },
    methods: {
        emit(eventName, value) {
            // This method should be used when it is very important and time consuming to update reactive data.
            return new Promise((resolve, reject) => {
                this.$emit(eventName, value)
                this.$nextTick(resolve)
            })
        },
        async tryFilter() {
            if (this.oldData !== this.data) {
                // este activate es para detectar cuando realizar una busqueda realmente,
                // asi al momento de restaurar la data, no restaura a cada rato
                this.activate = true
                this.loaderFilter = true
                const parameters = JSON.parse(JSON.stringify(this.filter.parameters))
                const buildFilter = { filter: this.data }
                this.objectFilter = {...parameters, ...buildFilter }
                const dataRequest = this.objectFilter

                const url = this.filter.url
                await axios.get(url, { params: { dataRequest } })
                    .then(res => {
                        if (res.data.error) {
                            this.loaderFilter = false
                            this.alert_flag = true
                            setTimeout(() => {
                                this.alert_flag = false
                            }, 3000);
                            return
                        }

                        this.oldParametersToCall = this.parametersDynamicToPaginate
                        this.oldUrl = this.urlTryPagination
                            //setting values for pagination before to fetch new count 
                        this.oldPagination = this.pagination
                        this.oldDataResponseDB = this.dataResponseDB
                            // lo que acabo de buscar lo guardo en cache
                            // para no realizar la misma busqueda si es lo mismo
                        this.oldData = this.data
                        this.$emit('setFlagFiltering', false)
                        const newDataResponse = res.data.data
                        this.$emit('setAfterDataResponse', newDataResponse)
                        this.loaderFilter = false

                        //PAGINATION
                        if (this.filter.pagination) {
                            this.$pagination(res)
                        }
                        if (this.filter.export.display) {
                            this.$exportExcel()
                        }


                    })
                    .catch(err => {
                        this.loaderFilter = false
                        console.log(err)
                    })
            }
        },
        resetFilter() {

            this.oldDataResponseDB = []
        },
        $pagination(res) {
            // settings values for pagination after to fetch count
            const totalCountResponse = parseInt(res.data.count)
            const totalPage = Math.ceil(totalCountResponse / this.pagination.rowForPage)
            const pagination = {
                display: true,
                totalPage,
                rowForPage: 10,
                pageCurrent: 1,
                totalCountResponse,
                fromRow: this.pagination.fromRow,
                limit: this.pagination.limit
            }

            this.emit('setPagination', pagination)
            this.$emit('urlTryPagination', this.filter.url)
                //seteo los parametros de la paginacion
            const filter = { filter: this.data }
            const newParametersDynamic = {...this.parametersDynamicToPaginate, ...filter }

            this.$emit('setParametersDynamicToPagination', newParametersDynamic)
        },
        $exportExcel() {
            this.$emit("setUrlExportByFilter", this.filter.export.url)
            const filter = this.data
            const newParametersDynamic = {...this.parametersDynamicToPaginate, filter }
            this.$emit("setParametersToExportExcel", newParametersDynamic)
        },
        $oldExportExcel() {
            this.$emit("setParametersToExportExcel", this.oldParametersToCall)
        }
    },
    watch: {
        data(value) {
            if (value === '') {
                // si buscó realmente, guardamos  lo anterior en cache
                if (this.activate) {
                    if (Object.keys(this.oldDataResponseDB).length > 0) {
                        this.$emit('restoreUrlPagination', this.oldUrl)
                        this.$emit('restoreOldPagination', this.oldPagination)
                        this.$emit('restoreOldParametersToCall', this.oldParametersToCall)
                        this.oldData = ''
                        if (this.filter.export.display) {
                            this.$oldExportExcel()
                        }
                        this.$emit('restoreOldDataResponse', this.oldDataResponseDB)
                        this.$emit('setFlagFiltering', true)
                    }
                    this.activate = false
                }
            }

        },
    },

    destroyed() {
        this.resetFilter()
    }
})