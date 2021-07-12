Vue.component('condition', {
    template: //html 
        `<div :class="resources.condition.class">
            <v-btn @click="condition = true" :color="resources.condition.color1">
            {{resources.condition.text1}}
            </v-btn>
            <v-btn @click="condition = false" :color="resources.condition.color2">
            {{resources.condition.text2}}
            </v-btn>
            <template v-if="condition != undefined">
                <v-chip @click="condition = undefined" color="warning">
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

    },
    data() {
        return {
            condition: undefined,
            parametersDynamic: [],
        }
    },
    methods: {
        handlersCondition(val) {
            this.applyCondition();
        },
        applyCondition() {
            const url = this.resources.urlTryPagination
            let parametersDynamicToPaginate = this.resources.parametersDynamicToPaginate
            let condition = { condition: this.condition }
            let newParameters = {...parametersDynamicToPaginate, ...condition }
            const dataRequest = newParameters
            this.parametersDynamic = dataRequest
            axios.get(url, { params: { dataRequest } })
                .then(res => {
                    if (res.data.error) {
                        const error = { display: true, type: 'no-exist', text: 'No hay datos para mostrar', time: 4000 }
                        this.error(error);
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
        }
    },
    watch: {
        condition(val) {
            this.handlersCondition(val)
        }
    }
})