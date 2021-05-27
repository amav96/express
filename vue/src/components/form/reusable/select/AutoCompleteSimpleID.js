// this autocomplete return value id
Vue.component('select-auto-complete-simple-id', {
    template: //html 
        `
    <div>
        <v-autocomplete
        v-model="select"
        :loading="loading"
        :items="items"
        item-text="slug"
        item-value="id"
        :search-input.sync="search"
        cache-items
        class="mx-4"
        outlined
        dense
        :label="title"
        flat
        ref="autocomplete"
        hide-no-data
        hide-details
        return-object
        > 
    </v-autocomplete>
    </div>
    `,
    props: {
        url: {
            type: String
        },
        title: {
            type: String
        }
    },
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
        getData() {
            const url = this.url
            axios.get(url)
                .then(res => {
                    if (res.data.error) {
                        alertNegative("No hay datos disponibless");
                        return
                    }
                    const data = res.data
                    this.items = data
                    this.data = data
                })
                .catch(err => {
                    console.log(err)
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
        }
    },
    created() {
        this.getData()
    }
})