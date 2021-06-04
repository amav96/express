Vue.component('form-number-and-word', {
    template: /*html*/ `      
        <div>
            <v-card>
                <form 
                id="sendFormRangeNumberAndWord"
                @submit.prevent="_countData"
                class="d-flex justify-center flex-row align-center  flex-wrap ">
                    <v-container fluid>
                        <v-row align="center"  class="d-flex justify-center" >
                            <v-col class="d-flex justify-center" cols="12"  lg="4" md ="4" >
                                <v-text-field
                                    v-model="numberStart"
                                    label="Desde"
                                    hide-details="auto"
                                    type="text"
                                    outlined
                                    dense
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
                                outlined
                                dense
                                flat
                                >
                                </v-text-field >
                            </v-col>

                            <v-col class="d-flex justify-center" cols="12"  lg="3" md ="4">
                                <select-auto-complete-simple-id
                                @exportVal="setData($event)"
                                :title="formRangeNumberAndWord.select.title" 
                                :url="formRangeNumberAndWord.select.url"
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
    props: ['formRangeNumberAndWord', 'pagination'],
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
        async _countData() {
            const url = this.formRangeNumberAndWord.base_url_count
            const dataRequest = {
                    numberStart: this.numberStart,
                    numberEnd: this.numberEnd,
                    word: this.word
                }
                //COUNT NO NECESITA PAGINACION!!
            await axios.get(url, {
                    params: { dataRequest }
                })
                .then(res => {
                    if (res.data.error) {
                        const error = { type: 'no-exist', text: 'No hay datos para mostrar', time: 4000 }
                        this.error(error);
                        return;
                    }
                    //PAGINATION
                    this.formRangeNumberAndWord.pagination ? this.$pagination(res) : false;
                    //SUBHEADER
                    this.formRangeNumberAndWord.subheader ?
                        this.showStatus(this.base_url_header) :
                        this.$emit('setDisplayHeaders', false);
                    //FILTER
                    if (this.formRangeNumberAndWord.filteringSearchWord) {
                        this.$emit('setShowFilter', true)
                        this.$emit('setUrlSearchController', this.formRangeNumberAndWord.filter_count)
                        this.$emit('setUrlGetDataSearchController', this.formRangeNumberAndWord.filter_get)
                        const parameters = {
                            numberStart: this.numberStart,
                            numberEnd: this.numberEnd,
                            word: this.word
                        }
                        this.$emit('setParametersToFilter', parameters)
                    }
                    //EXPORT 
                    this.formRangeNumberAndWord.export ?
                        this.$emit('setDisplayExportExcel', this.formRangeNumberAndWord.export) :
                        false;

                    this.getAll();
                })
                .catch(err => {
                    console.log(err)
                })

        },
        async getAll() {
            const dataRequest = {
                numberStart: this.numberStart,
                numberEnd: this.numberEnd,
                word: this.word,
                fromRow: this.pagination.fromRow,
                limit: this.pagination.limit
            }
            const url = this.formRangeNumberAndWord.base_url_data
            await axios.get(url, { params: { dataRequest } })
                .then(res => {
                    if (res.data.error) {
                        const error = { type: 'no-exist', text: 'No hay datos para mostrar', time: 4000 }
                        this.error(error);
                        return;
                    }

                    this.$emit('response', res.data)
                    this.$emit('showTable', true)

                    this.$emit('loadingTable', false)


                    //PAGINATION
                    this.formRangeNumberAndWord.pagination ? this.$emit('urlTryPagination', url) : false;
                    //FILTER 
                    this.formRangeNumberAndWord.filteringSearchWord ? this.$emit('filtering', true) : false;

                })
                .catch(err => {
                    console.log(err)
                    const error = { type: 'no-exist', text: err, time: 4000 }
                    this.error(error);
                    return;
                })
        },
        $pagination(res) {
            // settings values for pagination after to fetch count
            const totalCountResponse = parseInt(res.data.count)
            const totalPage = Math.ceil(totalCountResponse / this.pagination.rowForPage)
            this.$emit('TotalPage', totalPage)
            this.$emit('totalCountResponse', totalCountResponse)
            this.$emit('showPagination', true)

            // seteo los parametros de la paginacion 
            const parametersToPagination = {
                numberStart: this.numberStart,
                numberEnd: this.numberEnd,
                word: this.word,
                fromRow: this.pagination.fromRow,
                limit: this.pagination.limit
            }

            this.$emit('setParametersToPagination', parametersToPagination)

        },
        error(error) {
            this.$emit('setErrorGlobal', error)
            this.$emit('loadingTable', false)
            this.$emit('showTable', false)
            this.$emit('response', [])
            this.$emit('setShowFilter', false)
            return
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