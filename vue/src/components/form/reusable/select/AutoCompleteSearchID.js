// this autocomplete return value id
Vue.component('select-auto-complete-search-id',{
    template : //html 
        `
        <div>
            <v-autocomplete
            v-model="select"
            ref="autocomplete"
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
            hide-no-data
            hide-details
            return-object
            > 
        </v-autocomplete>
        </div>
        `,
        props:{
          url : {
              type : String
          },
          title : {
              type: String
          },
          searchID : {
              type : String
          }
      },
        data () {
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
            search (val) {
              val && val !== this.select && this.querySelections(val)
            },
            select (val) {
              val && this.returnData(val)
            },
            searchID (NewVal,oldVal) {
                if(oldVal !== '' && NewVal !== oldVal){
                    this.clearCachedItems();
                }
                this.id_search = NewVal
                this.getDataByID()
              },
          },
          methods: {
            getDataByID(){

              const url = this.url
              axios.get(url,{
                  params : {
                      id : this.id_search
                  }
              })
                .then(res => {
                    if(res.data.error){
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
            clearCachedItems() {
                this.$refs.autocomplete.cachedItems = [];
            },
            querySelections (val) {
              this.loading = true
              // Simulated ajax query
    
              setTimeout(() => {
                const arr = JSON.parse(JSON.stringify(this.data))
                this.items = arr.filter(item => item.slug.toLowerCase().indexOf(val.toLowerCase()) !== -1);
                this.loading = false
              }, 500)
            },
            returnData(val){
                this.$emit("exportVal",val)
            }
          },
          
    })