Vue.component('condition', {
    template: //html 
        `<div :class="resources.condition.class">
            <v-btn @click="handlersCondition(true)" :color="condition ? resources.condition.color1 : 'blue-grey lighten-4'" :disabled="loading">
            {{resources.condition.text1}}
            </v-btn>
            <v-btn @click="handlersCondition(false)" :color="!condition &&  condition !== undefined? resources.condition.color2 : 'blue-grey lighten-4'"  :disabled="loading">
            {{resources.condition.text2}}
            </v-btn>
            <template v-if="condition != undefined">
                <v-chip @click="handlersCondition(undefined)" color="warning" :disabled="loading">
                    Limpiar filtro
                    <v-icon>
                    mdi-filter-remove
                    </v-icon>
                </v-chip>
            </template>
            
        </div>
    `,
    props: ['resources'],
    computed: {
        loading() {
            if (this.resources.loadingPaginate.display) {
                return true;
            } else { return false }
        }
    },
    data() {
        return {
            condition: undefined,
            parametersDynamic: [],
            activatedFromOutside: false
        }
    },
    methods: {
        handlersCondition(val) {
            this.condition = val
            this.applyCondition();
        },
        applyCondition() {
            this.setLoader(true);
            const url = this.resources.urlTryPagination
            let parametersDynamicToPaginate = this.resources.parametersDynamicToPaginate
            if (parametersDynamicToPaginate.hasOwnProperty('fromRow')) {
                parametersDynamicToPaginate.fromRow = 0
            }
            let condition = { condition: this.condition }
            let newParameters = {...parametersDynamicToPaginate, ...condition }
            if (this.condition === undefined) {
                delete newParameters.condition;
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
            if (this.resources.parametersDynamicToPaginate.hasOwnProperty('condition') || this.resources.parametersDynamicToPaginate.condition === undefined) {
                this.$delete(this.resources.parametersDynamicToPaginate, 'condition')
                this.condition = undefined
            }
        }
    },
    destroyed() {
        this.reset()
    },

})