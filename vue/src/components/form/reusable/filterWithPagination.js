Vue.component('filter-with-pagination', {
    template: //html 
        `
        <div>
            <v-container>
            <v-form @submit.prevent="tryFilter" id="form-search">
                <v-row>
                    <v-col cols="12"md="4">
                        <v-text-field
                        v-model.trim="data"
                        label="Buscar"
                        :disabled="checkbox"
                        >
                        </v-text-field>
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
    props: ['filter', 'exportExcel', 'pagination', 'dataResponseDB', 'parametersDynamicToPaginate', 'urlTryPagination', 'select', 'condition'],
    computed: {
        checkbox() {
            if (this.select && this.select.selected.length > 0) {
                return true
            } else {
                return false
            }
        }
    },
    data() {
        return {
            data: '',
            oldData: '',
            objectFilter: [],
            oldParametersToCall: [],
            oldDataResponseDB: [],
            oldUrl: [],
            oldUrlExport: [],
            oldPagination: [],
            alert_flag: false,
            loaderFilter: false,
            activate: false,
            awaitingSearch: false,
            cache: true,
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
            if (this.data !== '') {
                this.loaderFilter = true
                const parameters = JSON.parse(JSON.stringify(this.parametersDynamicToPaginate))
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

                        this.$emit('setFlagFiltering', false)
                        const newDataResponse = res.data.data
                        this.$emit('setAfterDataResponse', newDataResponse)
                            //PAGINATION
                        if (this.filter.pagination) {
                            this.$pagination(res)
                        }
                        if (this.filter.export.display) {
                            this.$exportExcel()
                        }
                        this.$nextTick(() => {
                            setTimeout(() => {
                                this.loaderFilter = false
                            }, 700);

                        })

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
        cleanFilter() {
            this.data = ''
        },
        $pagination(res) {

            // settings values for pagination after to fetch count
            const totalCountResponse = parseInt(res.data.count)
            const totalPage = Math.ceil(totalCountResponse / this.pagination.rowForPage)
            const pagination = {
                display: true,
                totalPage,
                rowForPage: this.pagination.rowForPage,
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
        $restorePagination() {
            const pagination = {
                display: true,
                fromRow: 0,
                limit: this.pagination.limit,
                pageCurrent: 1,
                rowForPage: this.pagination.rowForPage,
                totalCountResponse: this.oldPagination.totalCountResponse,
                totalPage: this.oldPagination.totalPage,
            }
            this.$emit('restoreOldPagination', pagination)
            this.$emit('restoreUrlPagination', this.oldUrl)
        },
        $exportExcel() {

            this.oldUrlExport = this.exportExcel.url
            this.$emit("setUrlExportByFilter", this.filter.export.url)
            const filter = this.data
            const newParametersDynamic = {...this.parametersDynamicToPaginate, filter }
            this.$emit("setParametersToExportExcel", newParametersDynamic)
        },
        $oldExportExcel() {
            this.$emit("setOldUrlExport", this.oldUrlExport)
            this.$emit("setParametersToExportExcel", this.oldParametersToCall)
        },
        $cache() {
            this.oldPagination = this.pagination
            this.oldDataResponseDB = this.dataResponseDB
            this.oldUrl = this.urlTryPagination
            this.oldParametersToCall = this.parametersDynamicToPaginate
        }
    },
    watch: {
        data(value) {
            if (value === '') {
                if (Object.keys(this.oldDataResponseDB).length > 0) {
                    this.$restorePagination();
                    this.$emit('restoreOldDataResponse', this.oldDataResponseDB)
                    if (this.filter.export.display) {
                        this.$oldExportExcel()
                    }
                    if (this.condition && this.condition.display) {
                        this.$emit("cleanCondition")
                    }
                    // this.$emit('setFlagFiltering', true)
                }
            } else {

                if (!this.awaitingSearch) {
                    setTimeout(() => {
                        this.tryFilter();
                        this.awaitingSearch = false;
                    }, 1000); // 1 sec delay
                }
                this.awaitingSearch = true;
            }
        },
    },
    destroyed() {
        this.resetFilter()
    },
    created() {
        this.$cache()
    },




})