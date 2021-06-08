Vue.component('form-search-date', {

    template: /*html*/ `      
            <div>
                <v-card>
                    <v-form
                    @submit.prevent="_getData" 
                    id="sendFormRangeDate" 
                    class="d-flex justify-center flex-row align-center  flex-wrap ">
                        <v-container fluid>
                            <v-row align="center"  class="d-flex justify-center" >
                                <v-col class="d-flex justify-center" cols="12" sm="5">
                                    <v-text-field
                                    label="Desde"
                                    hide-details="auto"
                                    type="date"
                                    v-model="dateStart"
                                    >
                                    </v-text-field >
                                </v-col>

                                <v-col class="d-flex justify-center" cols="12" sm="5">
                                    <v-text-field
                                    label="Hasta"
                                    hide-details="auto"
                                    type="date"
                                    v-model="dateEnd"
                                    >
                                    </v-text-field >
                                </v-col>

                                <v-col class="d-flex justify-center" cols="12" sm="2">
                                    <v-btn
                                    color="primary"
                                    fab
                                    small
                                    primary
                                    class="sacarOutline"
                                    type="submit"
                                    form="sendFormRangeDate"
                                    :disabled="validateForm"
                                    >
                                    <v-icon>mdi-magnify</v-icon>
                                    </v-btn>
                                </v-col>
                            
                            </v-row>
                        </v-container>
                    </v-form>

                </v-card>
            </div>
    `,
    props: ['resources', 'pagination'],
    data() {
        return {
            dateStart: '',
            dateEnd: '',
        }
    },
    methods: {
        async _getData() {
            try {
                if (this.resources.pagination) { this.$resetPagination() }
                this.$emit('loadingTable', true)
                const dataRequest = {
                    dateStart: this.dateStart,
                    dateEnd: this.dateEnd,
                    fromRow: this.pagination.fromRow,
                    limit: this.pagination.limit
                }
                const url = this.resources.url.getData
                await axios.get(url, { params: { dataRequest } })
                    .then(res => {
                        if (res.data.error) {
                            const error = { type: 'no-exist', text: 'No hay datos para mostrar', time: 4000 }
                            this.error(error);
                            return;
                        }
                        //PAGINATION
                        this.resources.pagination ? this.$pagination(res) : false;
                        //SUBHEADER
                        this.resources.subheader.display ?
                            this.showStatus(this.resources.subheader.url) :
                            this.$emit('setDisplayHeaders', false);

                        //FILTER
                        if (this.resources.filter) {

                            this.$emit('setFilter', true)
                            this.$emit('setShowFilter', true)
                            this.$emit('setUrlFilter', this.resources.url.getDataFilter)
                            let parameters = {
                                dateStart: this.dateStart,
                                dateEnd: this.dateEnd,
                                fromRow: this.pagination.fromRow,
                                limit: this.pagination.limit
                            }
                            this.$emit('setParametersToFilter', parameters)
                        }
                        //EXPORT 
                        if (this.resources.export.display) {
                            this.$exportExcel()
                        }

                        this.$emit('response', res.data.data)
                        this.$emit('showTable', true)
                        this.$emit('loadingTable', false)

                    })


                .catch(err => {
                    console.log(err);
                })

            } catch (err) {
                const error = { type: 'no-exist', text: err, time: 4000 }
                this.error(error);
                return;
            }
        },
        async showStatus(url) {
            this.$emit('setSubHeadersLoader', true)
            await axios.get(url, {
                    params: {
                        dateStart: this.dateStart,
                        dateEnd: this.dateEnd,
                    }
                })
                .then(res => {

                    this.$emit('setSubHeadersLoader', false)
                    if (res.data.error) {
                        this.$emit("setDisplayHeaders", false)
                        return
                    }
                    this.emit('setSubHeadersDataResponseDB', [])
                    this.emit('setSubHeadersDataResponseDB', res.data)
                        .then(() => {
                            this.$emit('setDisplayHeaders', true)
                        })
                })
                .catch(err => {
                    console.log(err)
                })
        },
        emit(eventName, value) {
            // This method should be used when it is very important and time consuming to update reactive data.
            return new Promise((resolve, reject) => {
                this.$emit(eventName, value)
                this.$nextTick(resolve)
            })
        },
        error(error) {
            this.emit('setShowFilter', false)
            this.$emit('setErrorGlobal', error)
            this.$emit('loadingTable', false)
            this.$emit('showTable', false)
            this.$emit('response', [])
            return
        },
        $resetPagination() {
            const pagination = {
                display: true,
                totalPage: 1,
                rowForPage: 10,
                pageCurrent: 1,
                totalCountResponse: 0,
                fromRow: 0,
                limit: 10
            }
            this.$emit("resetPagination", pagination)
        },
        $pagination(res) {
            // settings values for pagination after to fetch count
            const totalCountResponse = parseInt(res.data.count)
            const totalPage = Math.ceil(totalCountResponse / this.pagination.rowForPage)
            this.$emit('totalCountResponse', totalCountResponse)
            this.$emit('TotalPage', totalPage)
            this.$emit('urlTryPagination', this.resources.url.getData)

            // seteo los parametros de la paginacion 
            const parametersDynamicToPagination = {
                dateStart: this.dateStart,
                dateEnd: this.dateEnd,
                fromRow: this.pagination.fromRow,
                limit: this.pagination.limit
            }

            this.$emit('setParametersDynamicToPagination', parametersDynamicToPagination)
        },
        $exportExcel() {
            this.$emit('setExportDisplay', true)
            let parameters = {
                dateStart: this.dateStart,
                dateEnd: this.dateEnd,
            }
            this.$emit('setParametersToExport', parameters)
            this.$emit('setUrlExport', this.resources.export.url)
        }

    },
    computed: {
        validateForm() {
            let dateStart = this.dateStart
            let dateEnd = this.dateEnd

            if (dateStart === '' || dateEnd === '') {
                return true
            } else {
                return false
            }
        }
    },


})