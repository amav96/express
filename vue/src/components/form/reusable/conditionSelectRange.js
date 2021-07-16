Vue.component('condition-select-range', {
    template: //html 
        `
        <div class="d-flex flex-column">
            <div class="d-flex flex-row">
                <select-auto-complete-static 
                :load="load"
                title="Desde"
                :outlined="section.condition.outlined"
                :classCustom="section.condition.class"
                :dense="section.condition.dense"
                @exportVal="start = $event.id"
                ref="setSelectRange1"
                />
                <select-auto-complete-static 
                :load="load"
                title="Hasta"
                :outlined="section.condition.outlined"
                :classCustom="section.condition.class"
                :dense="section.condition.dense"
                @exportVal="end = $event.id"
                ref="setSelectRange2"
                
                />
                <v-btn fab x-small color="info" class="mx-2" :disabled="disabledBtn" @click="handlersCondition(property)">
                    <v-icon >
                        mdi-magnify
                    </v-icon>
                </v-btn>
                <template v-if="!disabledBtn && condition !== undefined" >
                    <v-btn fab x-small color="error" @click="handlersCondition(undefined)" class="mx-2" >
                        <v-icon >
                            mdi-filter-remove
                        </v-icon>
                    </v-btn>
                </template>
            </div>
            <template v-if="IsMinor">
                <v-alert type="error" outlined dense>
                    <strong>Desde</strong> debe ser menor que <strong>Hasta</strong>
                </v-alert>
            </template>
            
        </div>
    `,
    props: ['section', 'load', 'resources', 'disabledByLoading', 'property'],
    computed: {
        disabledBtn() {
            if (this.disabledByLoading || this.start === '' || this.end === '' || this.IsMinor) {
                return true;
            } else { return false }
        },
        appliedCondition() {
            if (this.resources.parametersDynamicToPaginate.hasOwnProperty('start') || this.resources.parametersDynamicToPaginate.hasOwnProperty('end')) {
                return true
            } else { return false }
        },
        IsMinor() {
            if (this.start !== '' && this.end !== '' && this.start > this.end) { return true; } else { return false }
        }
    },
    data() {
        return {
            condition: undefined,
            parametersDynamic: [],
            start: '',
            end: ''
        }
    },
    methods: {
        handlersCondition(flag) {
            console.log(flag)

            if (flag) this.condition = this.property
            if (flag === undefined) this.condition = flag

            this.$nextTick(() => {
                this.applyCondition()
            })

        },
        applyCondition() {
            this.setLoader(true);
            const url = this.section.url.getData

            let parametersDynamicToPaginate = this.resources.parametersDynamicToPaginate
            if (parametersDynamicToPaginate.hasOwnProperty('fromRow')) {
                parametersDynamicToPaginate.fromRow = 0
            }
            let condition = {
                start: this.start,
                end: this.end
            }

            let newParameters = {...parametersDynamicToPaginate, ...condition }
            if (this.condition === undefined) {
                delete newParameters.start;
                delete newParameters.end;
                this.start = ''
                this.end = ''
                this.$refs.setSelectRange1.reset()
                this.$refs.setSelectRange2.reset()
            }

            const dataRequest = newParameters
            this.parametersDynamic = dataRequest
            axios.get(url, { params: { dataRequest } })
                .then(res => {
                    this.setLoader(false);

                    if (res.data.error) {
                        const error = { display: true, color: 'error', text: 'No se encontraron datos para el filtro', time: 4000 }
                        this.error(error);
                        this.condition = undefined
                        return
                    }

                    this.$emit("setDataResponse", res.data.data)
                    if (this.resources.pagination) {
                        this.$pagination(res);
                    }

                })
                .catch(res => {
                    console.log(res)
                })

        },
        $pagination(res) {

            // settings values for pagination after to fetch count
            const totalCountResponse = parseInt(res.data.count)
            const totalPage = Math.ceil(totalCountResponse / this.resources.pagination.rowForPage)
            const pagination = {
                display: this.resources.pagination.display,
                totalPage: totalPage,
                rowForPage: this.resources.pagination.rowForPage,
                pageCurrent: 1,
                totalCountResponse: totalCountResponse,
                fromRow: 0,
                limit: this.resources.pagination.limit
            }

            this.$emit("setPagination", pagination)
                // seteo los parametros de la paginacion 
            this.$emit('setParametersDynamicToPagination', this.parametersDynamic)
            this.$emit('showPagination', true);
        },
        error(error) {
            this.$emit("setErrorCondition", error)
        },
        setLoader(flag) {
            this.$emit('showLoading', flag)
        },
        reset() {
            if (this.resources.parametersDynamicToPaginate.hasOwnProperty('start') || this.resources.parametersDynamicToPaginate.hasOwnProperty('end')) {
                this.$delete(this.resources.parametersDynamicToPaginate, 'start')
                this.$delete(this.resources.parametersDynamicToPaginate, 'end')
                this.condition = undefined
                this.start = ''
                this.end = ''
                this.$refs.setSelectRange1.reset()
                this.$refs.setSelectRange2.reset()
            }
        },
        resetLocalParameterDynamic() {
            this.start = ''
            this.end = ''
            if (this.parametersDynamic.hasOwnProperty('start') || this.parametersDynamic.hasOwnProperty('end')) {
                this.$delete(this.parametersDynamic, 'start')
                this.$delete(this.parametersDynamic, 'end')
            }

        }
    },
    destroyed() {
        this.reset()
    },
    watch: {
        load(val) {
            this.resetLocalParameterDynamic()
        }
    }



})