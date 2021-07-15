// this autocomplete return value id
Vue.component('select-auto-complete-static', {
    template: //html 
        `
    <div>
        <template v-if="load && load.length>0">
            <v-autocomplete
            v-model.trim="select"
            :loading="loading"
            :items="data"
            item-text="slug"
            item-value="id"
            :search-input.sync.trim="search"
            cache-items
            :class="classCustom"
            :outlined="outlined"
            :dense="dense"
            :label="title"
            flat
            ref="autocomplete"
            hide-no-data
            hide-details
            return-object
            > 
            </v-autocomplete>
        </template>
        
    </div>
    `,

    props: ['title', 'outlined', 'classCustom', 'dense', 'load'],
    data() {
        return {
            loading: false,
            items: [],
            search: null,
            select: null,
            data: [],
        }
    },
    watch: {
        search(val) {
            val && val !== this.select && this.querySelections(val)
        },
        select(val) {
            val && this.returnData(val)
        },
    },
    methods: {
        loadData() {
            this.data = []

            this.$nextTick(() => {
                this.data = this.load
            })
        },
        querySelections(val) {
            this.loading = true
                // Simulated ajax query

            setTimeout(() => {
                const arr = JSON.parse(JSON.stringify(this.data))
                this.items = arr.filter(item => item.slug.toLowerCase().indexOf(val.toLowerCase()) !== -1);
                this.loading = false
            }, 500)
        },
        clearCachedItems() {
            this.$refs.autocomplete.cachedItems = [];
        },
        returnData(val) {
            this.$emit("exportVal", val)
        },
        reset() {
            this.search = null
            this.select = null
        },

    },
    created() {
        this.loadData()
    },
    watch: {
        load(val) {
            this.clearCachedItems()
            this.loadData()
        }
    }

})