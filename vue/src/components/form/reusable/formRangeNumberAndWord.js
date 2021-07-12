Vue.component('form-number-and-word', {
    template: /*html*/ `      
        <div>
            <v-card>
                <form 
                id="sendFormRangeNumberAndWord"
                @submit.prevent="_getData"
                class="d-flex justify-center flex-row align-center  flex-wrap ">
                    <v-container fluid>
                        <v-row align="center"  class="d-flex justify-center" >
                            <v-col class="d-flex justify-center" cols="12"  lg="4" md ="4" >
                                <v-text-field
                                    v-model="numberStart"
                                    label="Desde"
                                    hide-details="auto"
                                    type="text"
                                    flat
                                    >
                                </v-text-field >
                            </v-col>

                            <v-col class="d-flex justify-center" cols="12"  lg="3" md ="4">
                                <v-text-field
                                v-model="numberEnd"
                                label="Desde"
                                hide-details="auto"
                                type="text"
                                flat
                                >
                                </v-text-field >
                            </v-col>

                            <v-col class="d-flex justify-center" cols="12"  lg="3" md ="4">
                                <select-auto-complete-simple-id
                                @exportVal="setData($event)"
                                :title="resources.select.title" 
                                :url="resources.select.url"
                                />
                            </v-col>

                            <v-col class="d-flex justify-center" cols="12"  lg="2" md ="2">
                                <v-btn
                                color="primary"
                                fab
                                small
                                primary
                                class="sacarOutline"
                                type="submit"
                                form="sendFormRangeNumberAndWord"
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
            numberStart: '',
            numberEnd: '',
            word: [],
            items: []
        }
    },
    methods: {
        setData(data) {
            this.word = data
        },
        async _getData() {
            try {
                if (this.resources.pagination) { this.$resetPagination() }

                if (this.resources.filter.display) {
                    this.$emit("cleanFilter")
                }

                this.$emit('loadingTable', true)

                const dataRequest = {
                    numberStart: this.numberStart,
                    numberEnd: this.numberEnd,
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
                const error = { display: true, type: 'no-exist', text: err, time: 4000 }
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
                numberStart: this.numberStart,
                numberEnd: this.numberEnd,
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
                numberStart: this.numberStart,
                numberEnd: this.numberEnd,
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
                numberStart: this.numberStart,
                numberEnd: this.numberEnd,
                word: this.word,
            }
            this.$emit('setParametersToExport', parameters)
            this.$emit('setUrlExport', this.resources.export.url)
        },
    },
    computed: {
        validateForm() {
            if (this.numberStart === '' || this.numberEnd === '' || this.word.length === 0) {
                return true
            } else {
                return false
            }
        }
    }


})