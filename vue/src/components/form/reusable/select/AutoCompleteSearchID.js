// this autocomplete return value id
Vue.component('select-auto-complete-search-id', {
    template: //html 
        `
        <div >
            <v-autocomplete
            v-model.trim="select"
            ref="autocomplete"
            :loading="loading"
            :items="items"
            item-text="slug"
            item-value="id"
            :search-input.sync.trim="search"
            cache-items
            :class="classCustom"
            :outlined="outlined"
            :error="error"
            dense
            :label="title"
            flat
            return-object
            :disabled="searchID === ''"
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
        },
        searchID: {
            type: String
        },
        outlined: {
            type: Boolean
        },
        classCustom: {
            type: String
        },
        reassign: {
            type: String
        },
        error: {
            type: Boolean
        }

    },
    data() {
        return {
            loading: false,
            items: [],
            search: null,
            select: null,
            data: [],
            id_search: {},
        }
    },
    watch: {
        search(val) {
            val && val !== this.select && this.querySelections(val)
        },
        select(val) {

            val && this.returnData(val)
        },
        searchID(NewVal, oldVal) {

            if (oldVal !== '' && NewVal !== oldVal) {
                this.clearCachedItems();
            }
            if (NewVal !== '') {
                this.id_search = NewVal
                this.getDataByID()
            }

        },
    },
    methods: {
        getDataByID() {
            const url = this.url
            console.log(url)
            axios.get(url, {
                    params: {
                        id: this.id_search
                    }
                })
                .then(res => {
                    if (res.data.error) {
                        return
                    }
                    const data = res.data
                    this.items = data
                    this.data = data

                    this.reassign !== '' && this.reassign !== undefined && this.reassign > 0 ?
                        this.$reassingData() :
                        false;
                })
                .catch(err => {
                    console.log(err)
                })
        },
        clearCachedItems() {
            this.$refs.autocomplete.cachedItems = [];
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
        returnData(val) {
            this.$emit("exportVal", val)
        },
        reset() {
            this.search = null
            this.select = null
        },
        $reassingData() {
            if (this.reassign !== '' && this.reassign !== undefined) {

                const arr = JSON.parse(JSON.stringify(this.data))
                const data = arr.filter(item => item.id === this.reassign)
                this.select = data[0]


            }
        }

    },
    created() {
        if (this.searchID !== '' && this.searchID !== undefined) {
            this.id_search = this.searchID
            this.getDataByID();
        }

    }

})