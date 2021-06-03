Vue.component('form-all', {
    template: /*html*/ `      
    `,
    props: ['showAll', 'pagination'],
    data() {
        return {

        }
    },
    methods: {
        async countAllCoverage() {
            try {
                this.$emit('loadingTable', true)
                await axios.get(this.showAll.base_url_count)
                    .then(res => {

                        if (res.data.error) {
                            const error = { type: 'no-exist', text: 'No hay datos para mostrar', time: 4000 }
                            this.error(error);
                            return;
                        }
                        this.resetPagination()
                            // settings values for pagination after to fetch count
                        const totalCountResponse = parseInt(res.data.count)
                        const totalPage = Math.ceil(totalCountResponse / this.pagination.rowForPage)
                        this.$emit('TotalPage', totalPage)
                        this.$emit('totalCountResponse', totalCountResponse)

                        this.getAllCoverage(this.showAll.base_url_data)
                            .then(() => {
                                // show status if is true
                                if (this.showAll.subheader) {
                                    this.showStatus(this.base_url_header)
                                } else {
                                    this.$emit('setDisplayHeaders', false)
                                }
                                // if filter is true, activate
                                if (this.showAll.filteringSearchWord) {
                                    this.$emit('setShowFilter', true)
                                    this.$emit('setUrlSearchController', this.base_url_to_count_search_word_controller)
                                    this.$emit('setUrlGetDataSearchController', this.base_url_to_get_search_word_controller)
                                    const search = {
                                        dateStart: this.dateStart,
                                        dateEnd: this.dateEnd,
                                        word: this.word,
                                    }
                                    this.$emit('setDataDynamicToFilter', search)
                                }
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
        async getAllCoverage(url) {

            const dataRequest = {
                fromRow: this.pagination.fromRow,
                limit: this.pagination.limit
            }
            await axios.get(url, {
                    params: {
                        dataRequest
                    }
                })
                .then(res => {

                    if (res.data.error) {
                        const error = { type: 'no-exist', text: 'No hay datos para mostrar', time: 4000 }
                        this.error(error);
                        return;
                    }

                    // setting dinamic data search for pagination
                    const dynamicDataToSearch = {
                        fromRow: this.pagination.fromRow,
                        limit: this.pagination.limit
                    }

                    this.$emit('dynamicDataToSearch', dynamicDataToSearch)

                    this.$emit('response', res.data)
                    this.$emit('showTable', true)
                    this.$emit('setPaginateDisplay', true)
                    this.$emit('loadingTable', false)

                    if (this.showAll.export) {
                        this.$emit('setDisplayExportExcel', this.showAll.export)
                    } else {
                        this.$emit('setDisplayExportExcel', this.showAll.export)
                    }

                    //  settings url to fetch from pagination
                    this.$emit('urlTryPagination', url)

                    // setting flag filtering
                    this.$emit('filtering', true)

                })
                .catch(err => {
                    console.log(err)
                    const error = { type: 'no-exist', text: err, time: 4000 }
                    this.error(error);
                    return;
                })
        },
        error(error) {
            this.$emit('setErrorGlobal', error)
            this.$emit('loadingTable', false)
            this.$emit('showTable', false)
            this.$emit('response', [])
            this.$emit('setShowFilter', false)
            return
        },
        resetPagination() {
            const pagination = {
                display: true,
                totalPage: 0,
                rowForPage: 10,
                pageCurrent: 1,
                totalCountResponse: 0,
                fromRow: 0,
                limit: 10
            }
            this.$emit("resetPagination", pagination)
        }
    },
    created() {
        this.countAllCoverage()

    },


})