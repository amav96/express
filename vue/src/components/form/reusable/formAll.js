Vue.component('form-all', {
    template: /*html*/ ` 
         
    `,
    props: ['resources', 'pagination'],
    methods: {
        async getData() {
            try {
                this.$resetPagination()
                this.$emit('loadingTable', true)
                const dataRequest = {
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
                        this.resources.subheader ?
                            this.showStatus(this.base_url_header) :
                            this.$emit('setDisplayHeaders', false);

                        //FILTER
                        if (this.resources.filter) {

                            this.$emit('setFilter', true)
                            this.$emit('setShowFilter', true)
                            this.$emit('setUrlFilter', this.resources.url.getDataFilter)
                            const parameters = {
                                fromRow: this.pagination.fromRow,
                                limit: this.pagination.limit
                            }
                            this.$emit('setParametersToFilter', parameters)
                        }
                        //EXPORT 
                        this.resources.export ?
                            this.$emit('setDisplayExportExcel', this.resources.export) :
                            false;

                        this.$emit('response', res.data)
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
    },
    created() {
        this.getData()
    },


})