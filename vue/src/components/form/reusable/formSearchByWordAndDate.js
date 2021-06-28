Vue.component('form-search-by-word-and-range-date', {
    template: /*html*/ `      
        <div>
            <v-card>
                <form 
                @submit.prevent="_getData"
                id="sendFormWordAndRange"
                class="d-flex justify-center flex-row align-center  flex-wrap ">
                    <v-container fluid>
                        <v-row align="center"  class="d-flex justify-center" >
                            <v-col class="d-flex justify-center" cols="12"  lg="4" md ="4" >
                                <select-auto-complete-simple-id
                                :classCustom="resources.select.class"
                                :outlined="resources.select.outlined"
                                :dense="resources.select.dense"
                                @exportVal="$_setSelect($event)"
                                :title="resources.select.title" 
                                :url="resources.select.url"
                                />
                            </v-col>

                            <v-col class="d-flex justify-center" cols="12"  lg="3" md ="4">
                                <v-text-field
                                label="Desde"
                                hide-details="auto"
                                type="date"
                                v-model="dateStart"
                                >
                                </v-text-field >
                            </v-col>

                            <v-col class="d-flex justify-center" cols="12"  lg="3" md ="4">
                                <v-text-field
                                label="Hasta"
                                hide-details="auto"
                                type="date"
                                v-model="dateEnd"
                                >
                                </v-text-field >
                            </v-col>

                            <v-col class="d-flex justify-center" cols="12"  lg="2" md ="2">
                                <v-btn
                                color="primary"
                                fab
                                small
                                primary
                                class="sacarOutline"
                                type="submit"
                                form="sendFormWordAndRange"
                                :disabled="validateForm"
                                >
                                <v-icon>mdi-magnify</v-icon>
                                </v-btn>
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
            dateStart: '',
            dateEnd: '',
            word: '',
            items: []
        }
    },
    methods: {

        async _getData() {
            try {
                this.resources.pagination ? this.$resetPagination() : false;
                this.$emit('loadingTable', true)
                const dataRequest = {
                    dateStart: this.dateStart,
                    dateEnd: this.dateEnd,
                    word: this.word,
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
                const error = { type: 'no-exist', text: err, time: 4000 }
                this.error(error);
                return;
            }
        },
        async showStatus(base_url) {
            this.$emit('setSubHeadersLoader', true)
            await axios.get(base_url, {
                    params: {
                        dateStart: this.dateStart,
                        dateEnd: this.dateEnd,
                        word: this.word,
                    }
                })
                .then(res => {
                    this.$emit('setSubHeadersLoader', false)
                    if (res.data.error) {
                        this.$emit('setDisplayHeaders', false)
                        return
                    }
                    this.$emit('setSubHeadersDataResponseDB', res.data)
                    this.$emit('setDisplayHeaders', true)

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
            this.$emit('setErrorGlobal', error)
            this.$emit('loadingTable', false)
            this.$emit('showTable', false)
            this.$emit('response', [])
            this.emit('setShowFilter', false)
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
                word: this.word,
                fromRow: this.pagination.fromRow,
                limit: this.pagination.limit
            }
            this.$emit('setParametersDynamicToPagination', parametersDynamicToPagination)
        },
        $filter() {

            this.$emit('setShowFilter', true)
            this.$emit('setUrlFilter', this.resources.filter.url)
            let parameters = {
                dateStart: this.dateStart,
                dateEnd: this.dateEnd,
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
                dateStart: this.dateStart,
                dateEnd: this.dateEnd,
                word: this.word
            }
            this.$emit('setParametersToExport', parameters)
            this.$emit('setUrlExport', this.resources.export.url)
        }

    },
    computed: {
        validateForm() {
            let dateStart = this.dateStart
            let dateEnd = this.dateEnd
            let id = this.id

            if (dateStart === '' || dateEnd === '' || id === '') {
                return true
            } else {
                return false
            }
        }
    },


})