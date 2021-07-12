Vue.component('form-id', {
    template: /*html*/ `      
        <div>
            <v-card class="mb-5">
                <form 
                id="sendFormID"
                @submit.prevent="_getData"
                class="d-flex justify-center flex-row align-center">
                    <v-container fluid>
                        <v-row align="center"  class="d-flex justify-center" >
                            <v-col class="d-flex justify-center" cols="12" xl="12"  lg="12" md ="12">
                                <select-auto-complete-simple-id
                                @exportVal="setData($event)"
                                :title="resources.select.title" 
                                :url="resources.select.url"  
                                :outlined="resources.select.outlined"
                                :classCustom="resources.select.class"
                                :dense="resources.select.dense"
                                />
                            </v-col>
                        </v-row>
                    </v-container>
                </form>
            </v-card>
        </div>
       
    `,
    props: ['resources', 'pagination'],
    data() {
        return {
            word: [],
            items: []
        }
    },
    methods: {
        setData(data) {
            if (this.resources.filter.display) {
                this.$emit("cleanFilter")
            }
            this.word = data.id
            this._getData()
        },
        async _getData() {
            try {
                this.resources.pagination ? this.$resetPagination() : false;
                this.$emit('loadingTable', true)
                const dataRequest = {
                    word: this.word,
                    fromRow: this.pagination.fromRow,
                    limit: this.pagination.limit
                }
                const url = this.resources.url.getData

                await axios.get(url, { params: { dataRequest } })
                    .then(res => {
                        if (res.data.error) {
                            const error = { display: true, type: 'no-exist', text: 'No hay datos para mostrar', time: 4000 }
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
                        this.resources.filter.display ? this.$filter() : this.$emit('setShowFilter', false);
                        //EXPORT 
                        this.resources.export.display ? this.$exportExcel() : this.$emit('setExportDisplay', false);


                        this.$emit('response', res.data.data)
                        this.$emit('showTable', true)
                        this.$emit('loadingTable', false)
                    })
                    .catch(err => {
                        console.log(err);
                    })

            } catch (err) {
                const error = { display: true, type: 'no-exist', text: err, time: 4000 }
                this.error(error);
                return;
            }
        },
        error(error) {
            this.$emit('setErrorGlobal', error)
            this.$emit('loadingTable', false)
            this.$emit('showTable', false)
            this.$emit('response', [])
            this.$emit('setShowFilter', false)
            return
        },
        $resetPagination() {
            const pagination = {
                display: false,
                totalPage: 1,
                rowForPage: this.pagination.rowForPage,
                pageCurrent: 1,
                totalCountResponse: 0,
                fromRow: 0,
                limit: this.pagination.limit
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
                word: this.word,
                fromRow: this.pagination.fromRow,
                limit: this.pagination.limit
            }
            this.$emit('setParametersDynamicToPagination', parametersDynamicToPagination)
            this.$emit('showPagination', true);

        },
        $filter() {

            this.$emit('setShowFilter', true)
            this.$emit('setUrlFilter', this.resources.filter.url)
            let parameters = {
                word: this.word,
                fromRow: this.pagination.fromRow,
                limit: this.pagination.limit
            }
            this.$emit('setParametersToFilter', parameters)

            // set filter by export 
            if (this.resources.export.display) {
                this.$emit('setUrlFilterExportExcel', this.resources.export.url_filter)
                this.$emit('setExportByFilterDisplay', true)
            } else {
                this.$emit('setExportByFilterDisplay', true)
            }

        },
        $_setSelect(data) {
            this.word = data.id
        },
        $exportExcel() {
            this.$emit('setExportDisplay', true)
            let parameters = {
                word: this.word,
            }
            this.$emit('setParametersToExport', parameters)
            this.$emit('setUrlExport', this.resources.export.url)
        },
    },
    computed: {
        validateForm() {
            if (this.word.length === 0) {
                return true
            } else {
                return false
            }
        }
    }


})