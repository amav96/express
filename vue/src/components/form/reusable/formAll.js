Vue.component('form-all', {
    template: /*html*/ ` 
         
    `,
    props: ['resources', 'pagination'],
    methods: {
        async _getData() {
            try {
                if (this.resources.pagination) { this.$resetPagination() }
                this.$emit('loadingTable', true)
                const dataRequest = {
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
                            this.$showStatus(this.resources.subheader.url) :
                            this.$emit('setDisplayHeaders', false);

                        //FILTER
                        this.resources.filter.display ? this.$filter() : this.$emit('setShowFilter', false);

                        //EXPORT 
                        this.resources.export.display ? this.$exportExcel() : this.$emit('setExportDisplay', false);
                        this.$emit('response', res.data.data)
                        this.$emit('showTable', true)
                        this.$nextTick(() => {
                            this.$emit('loadingTable', false)
                        })


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
        error(error) {
            if (this.resources.pagination) {
                this.$emit("showPagination", false)
            }

            this.$emit('setErrorGlobal', error)
            this.$emit('loadingTable', false)
            this.$emit('showTable', false)
            this.$emit('response', [])
            this.$emit('setShowFilter', false)
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
                fromRow: this.pagination.fromRow,
                limit: this.pagination.limit
            }

            this.$emit('setParametersDynamicToPagination', parametersDynamicToPagination)
        },
        $filter() {

            this.$emit('setShowFilter', true)
            this.$emit('setUrlFilter', this.resources.filter.url)
            let parameters = {
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
        $exportExcel() {
            this.$emit('setExportDisplay', true)
            let parameters = {}
            this.$emit('setParametersToExport', parameters)
            this.$emit('setUrlExport', this.resources.export.url)
        }
    },
    created() {
        this._getData()
    },


})