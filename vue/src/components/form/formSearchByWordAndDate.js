Vue.component('form-search-by-word-and-range-date',{
    template : /*html*/ 
    `      
        <div>
            <form 
            @submit.prevent="countSearchByWordAndRangeDate"
            id="sendFormWordAndRange"
            class="d-flex justify-center flex-row align-center  flex-wrap ">
                <div class=" mx-1 ">
                    <v-select
                    :items="dataSelect"
                    :item-text="showDataSelect"
                    item-value="id"
                    label="Recolector"
                    v-model="word"
                    attach
                    ></v-select>
                </div>

                <div class="mx-1 ">
                    <v-text-field
                    label="Desde"
                    hide-details="auto"
                    type="date"
                    v-model="dateStart"
                    >
                    </v-text-field >
                </div>

                <div class="mx-1 ">
                    <v-text-field
                    label="Hasta"
                    hide-details="auto"
                    type="date"
                    v-model="dateEnd"
                    >
                    </v-text-field >
                </div>

                <div class="mx-1 ">
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
                </div>

            </form>
        </div>
       
    `,
    props:['base_url_data_select','showDataSelect','dataSelect','searchByWordAndRangeDate','pagination','subheaders','base_url_header','base_url_to_count_search_word_controller','base_url_to_get_search_word_controller','searchWord',],
    data() {
        return {
           dateStart: '',
           dateEnd: '',
           word:'',
           items: []
        }
    },
    methods: {
        async countSearchByWordAndRangeDate(){
            try {
                this.$emit('loadingTable',true)

                await axios.get(this.searchByWordAndRangeDate.base_url_count,{
                      params :{
                        dateStart : this.dateStart,
                        dateEnd : this.dateEnd,
                        word : this.word,
                    }
                })
                .then(res => {
                    if(!res.data.result){
                      
                        const error = {type: 'no-exist',text: 'No hay datos para mostrar',time: 4000}
                        this.error(error); return;
                    }
                    // settings values for pagination after to fetch count
                    const totalCountResponse = parseInt(res.data.count)
                    const totalPage = Math.ceil(totalCountResponse / this.pagination.rowForPage)
                    this.$emit('TotalPage',totalPage)
                    this.$emit('totalCountResponse',totalCountResponse)
                    this.searchWordAndRangeDate(this.searchByWordAndRangeDate.base_url_data)
                        .then(()=>{
                            // show status if is true
                            this.subheaders.active ? this.showStatus(this.base_url_header) :  true;

                            // if searchALL is true, activate
                            if(this.searchByWordAndRangeDate.filteringSearchWord){
                                this.$emit('setShowSearchWord',true)
                                this.$emit('setUrlSearchController',this.base_url_to_count_search_word_controller)
                                this.$emit('setUrlGetDataSearchController',this.base_url_to_get_search_word_controller)
                                const search = {
                                    dateStart : this.dateStart,
                                    dateEnd :  this.dateEnd,
                                    word : this.word,
                                }
                                this.$emit('setDataDynamicToSearchWord',search) 
                            }
                        })
                })
                .catch(err => {
                    console.log(err);
                })

            } catch (err) {
               
                const error = {type: 'no-exist',text: err,time: 4000}
                this.error(error); return;
            }
            
        },
        async searchWordAndRangeDate(base_url){
          
            const dataRequest = {
                dateStart : this.dateStart,
                dateEnd : this.dateEnd,
                word : this.word,
                fromRow : this.pagination.fromRow,
                limit : this.pagination.limit
            }
                await axios.get(base_url,{
                        params :{
                            dataRequest
                        }
                    })
                 .then(res =>{
                   
                     if(!res.data[0].result){
                         const error = {type: 'no-exist',text: 'No hay datos para mostrar',time: 4000}
                         this.error(error); return;
                     }

                      // setting dinamic data search for pagination
                    const dynamicDataToSearch = {
                        dateStart : this.dateStart,
                        dateEnd : this.dateEnd,
                        word : this.word,
                        fromRow : this.pagination.fromRow,
                        limit : this.pagination.limit
                    }
                   
                    this.$emit('dynamicDataToSearch',dynamicDataToSearch)

                     this.$emit('response',res.data)
                     this.$emit('showTable',true)
                     this.$emit('loadingTable',false)
                     
                    //  settings url to fetch from pagination
                    this.$emit('urlTryPagination',base_url)

                    // setting flag filtering
                    this.$emit('filtering',true)
                    
                 })
                 .catch(err =>{
                     const error = {type: 'no-exist',text: err,time: 4000}
                     this.error(error); return;
                 })
        },
        async  getDataSelect(){
            let dataPost = new FormData()
            dataPost.append('key','all')
            // this should change yes or yes

        try {
            
             await axios.post(this.base_url_data_select,dataPost)
                .then(res => {
                    
                    if(res.data[0].result !== '1'){
                        const error = {
                            type: 'no-exist',
                            text: 'No se pudieron cargar los usuarios',
                            time: 4000
                        }
    
                        this.$emit('childrenError',error)
                        return false
                    }
                    const ordenadosAlfabeticamente = res.data.sort(function(prev, next){

                        if(prev.nombre > next.nombre){
                            return 1
                        }
                        if(prev.nombre < next.nombre){
                          return -1
                        }
                        return 0
                      })

                      this.items = ordenadosAlfabeticamente
                      
                      this.$emit('childrenProcessDataSelect',this.items);
                      this.$emit('childrenDataSelect',this.items);
                      
                      
                })
                .catch(err => {

                    const error = {
                        type: 'no-exist',
                        text: err,
                        time: 4000
                    }

                    this.$emit('childrenError',error)
                   
                })
            
        } catch (err) {
            const error = {
                        type: 'no-exist',
                        text: err,
                        time: 4000
                    }

            this.$emit('childrenError',error)
        }
             
        },
        async showStatus(base_url){
            this.$emit('setSubHeadersLoader',true)
            await axios.get(base_url,{
                params : {
                    dateStart : this.dateStart,
                    dateEnd : this.dateEnd,
                    word : this.word,
                }
            })
            .then(res => {
                if(!res.data[0].result){
                    console.log('errorsito')
                }

                 this.$emit('setSubHeadersDataResponseDB', res.data)
                 this.$emit('setSubHeadersLoader',false)
            })
            .catch(err => {
                console.log(err)
            })
        },
        error(error){
            this.$emit('setErrorGlobal',error)
            this.$emit('loadingTable',false)
            this.$emit('showTable',false)
            this.$emit('response', [])
            return
        },
        
    },
    computed: {
        validateForm(){
            let dateStart = this.dateStart
            let dateEnd = this.dateEnd
            let id = this.id

            if(dateStart=== '' || dateEnd === '' || id === ''){
                return true
            }else{
                return false
            }
        }
    },
    created(){
       this.getDataSelect()
        
    }

})