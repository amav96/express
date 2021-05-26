Vue.component('form-search-by-word-and-range-date', {
    template: /*html*/ `      
        <div>
            <v-card>
                <form 
                @submit.prevent="countSearchByWordAndRangeDate"
                id="sendFormWordAndRange"
                class="d-flex justify-center flex-row align-center  flex-wrap ">
                    <v-container fluid>
                        <v-row align="center"  class="d-flex justify-center" >
                            <v-col class="d-flex justify-center" cols="12"  lg="4" md ="4" >
                                <v-select
                                style="height:50px;"
                                :items="dataSelect"
                                :item-text="showDataSelect"
                                item-value="id"
                                label="Recolector"
                                v-model="word"
                                ></v-select>
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
    props: ['base_url_data_select', 'showDataSelect', 'dataSelect', 'searchByWordAndRangeDate', 'pagination', 'subheaders', 'base_url_header', 'base_url_to_count_search_word_controller', 'base_url_to_get_search_word_controller', 'filter', ],
    data() {
        return {
            dateStart: '',
            dateEnd: '',
            word: '',
            items: []
        }
    },
    methods: {
        async countSearchByWordAndRangeDate() {
            try {
                this.$emit('loadingTable', true)
                await axios.get(this.searchByWordAndRangeDate.base_url_count, {
                        params: {
                            dateStart: this.dateStart,
                            dateEnd: this.dateEnd,
                            word: this.word,
                        }
                    })
                    .then(res => {
                        if (res.data.error) {
                            const error = { type: 'no-exist', text: 'No hay datos para mostrar', time: 4000 }
                            this.error(error);
                            return;
                        }
                        // settings values for pagination after to fetch count
                        const totalCountResponse = parseInt(res.data.count)
                        const totalPage = Math.ceil(totalCountResponse / this.pagination.rowForPage)
                        this.$emit('TotalPage', totalPage)
                        this.$emit('totalCountResponse', totalCountResponse)
                        this.searchWordAndRangeDate(this.searchByWordAndRangeDate.base_url_data)
                            .then(() => {
                                // show status if is true
                                if (this.searchByWordAndRangeDate.subheader) {
                                    this.showStatus(this.base_url_header)
                                } else {
                                    this.$emit('setDisplayHeaders', false)
                                }
                                // if filter is true, activate
                                if (this.searchByWordAndRangeDate.filteringSearchWord) {
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
        async searchWordAndRangeDate(base_url) {
            const dataRequest = {
                dateStart: this.dateStart,
                dateEnd: this.dateEnd,
                word: this.word,
                fromRow: this.pagination.fromRow,
                limit: this.pagination.limit
            }
            await axios.get(base_url, {
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
                        dateStart: this.dateStart,
                        dateEnd: this.dateEnd,
                        word: this.word,
                        fromRow: this.pagination.fromRow,
                        limit: this.pagination.limit
                    }

                    this.$emit('dynamicDataToSearch', dynamicDataToSearch)

                    this.$emit('response', res.data)
                    this.$emit('showTable', true)
                    this.$emit('loadingTable', false)

                    if (this.searchByWordAndRangeDate.export) {
                        this.$emit('setDisplayExportExcel', this.searchByWordAndRangeDate.export)
                    } else {
                        this.$emit('setDisplayExportExcel', this.searchByWordAndRangeDate.export)
                    }

                    //  settings url to fetch from pagination
                    this.$emit('urlTryPagination', base_url)

                    // setting flag filtering
                    this.$emit('filtering', true)

                })
                .catch(err => {
                    const error = { type: 'no-exist', text: err, time: 4000 }
                    this.error(error);
                    return;
                })
        },
        async getDataSelect() {
            let dataPost = new FormData()
            dataPost.append('key', 'all')
                // this should change yes or yes

            try {

                await axios.post(this.base_url_data_select, dataPost)
                    .then(res => {

                        if (res.data.count <= '0') {
                            const error = { type: 'no-exist', text: 'No se pudieron cargar los usuarios', time: 4000 }
                            this.error(error);
                            return;
                        }
                        const ordenadosAlfabeticamente = res.data.sort(function(prev, next) {
                            if (prev.nombre > next.nombre) {
                                return 1
                            }
                            if (prev.nombre < next.nombre) {
                                return -1
                            }
                            return 0
                        })

                        this.items = ordenadosAlfabeticamente
                        this.$emit('childrenProcessDataSelect', this.items);
                        this.$emit('childrenDataSelect', this.items);
                    })
                    .catch(err => {
                        const error = { type: 'no-exist', text: err, time: 4000 }
                        this.error(error);
                        return;
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
    created() {
        this.getDataSelect()

    }

})