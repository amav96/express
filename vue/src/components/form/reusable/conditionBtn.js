Vue.component('condition-btn', {
    template: //html 
        `<div :class="resources.condition.class">
            <v-btn class="my-1" @click="handlersCondition(property,true)" :color="condition ? resources.condition.color1 : 'blue-grey lighten-4'" :disabled="disabledByLoading">
            {{resources.condition.text1}}
            </v-btn>
            <v-btn class="my-1" @click="handlersCondition(property,false)" :color="!condition &&  condition !== undefined? resources.condition.color2 : 'blue-grey lighten-4'"  :disabled="disabledByLoading">
            {{resources.condition.text2}}
            </v-btn>
            <template  v-if="condition !== undefined ">
                <v-btn fab x-small color="error" :disabled="disabledByLoading" class="my-1" @click="handlersCondition(property,undefined)" >
                        <v-icon >
                            mdi-filter-remove
                        </v-icon>
                </v-btn>
            </template>
            
        </div>
    `,
    props: ['resources', 'property', 'disabledByLoading'],
    computed: {
        loading() {
            if (this.resources.loadingPaginate.display) {
                return true;
            } else { return false }
        },
    },
    data() {
        return {
            condition: undefined,
            name: undefined,
            parametersDynamic: [],
        }
    },
    methods: {
        handlersCondition(name, val) {

            this.name = name
            this.condition = val
            this.$nextTick(() => {
                this.applyCondition();
            })
        },
        applyCondition() {
            this.setLoader(true);
            const url = this.resources.urlTryPagination
            let parametersDynamicToPaginate = this.resources.parametersDynamicToPaginate
            if (parametersDynamicToPaginate.hasOwnProperty('fromRow')) {
                parametersDynamicToPaginate.fromRow = 0
            }
            var name = this.name
            let condition = {
                [name]: this.condition
            }
            let newParameters = {...parametersDynamicToPaginate, ...condition }
            if (this.condition === undefined || this.name === undefined) {
                delete newParameters[name];
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