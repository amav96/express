Vue.component('form-search-date',{

    template : /*html*/ 
    `      
            <div>
            
                <v-form
                 @submit.prevent="countSearchInRangeDate" 
                 id="sendFormRangeDate" 
                 class="d-flex justify-center flex-row align-center  flex-wrap ">
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
                        form="sendFormRangeDate"
                        :disabled="validateForm"
                        >
                        <v-icon>mdi-magnify</v-icon>
                        </v-btn>
                    </div>
                </v-form>
                
            </div>
    `,
    props:['base_url_searchDateRange','titleFormRangeDate','base_url_count_base_url_searchDateRange','dataResponseDB','pagination','subheaders','base_url_header','base_url_to_count_search_word_controller','base_url_to_get_search_word_controller','searchWord'],
    data() {
        return {
           dateStart: '',
           dateEnd: '',
        }
    },
    methods: {
        ...Vuex.mapActions('admin-avisos',['getDataDB']),
        async countSearchInRangeDate(){
            try {
                this.$emit('loadingTable',true)

                await axios.get(this.base_url_count_base_url_searchDateRange,{
                      params :{
                        dateStart : this.dateStart,
                        dateEnd : this.dateEnd
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
                    this.searchInRangeDate(this.base_url_searchDateRange)
                        .then(()=>{
                            // show status if is true
                            this.subheaders.active ? this.showStatus(this.base_url_header) :  true;

                            // if searchALL is true, activate
                            if(this.searchWord.searchAll){
                                this.$emit('setUrlSearchController',this.base_url_to_count_search_word_controller)
                                this.$emit('setUrlGetDataSearchController',this.base_url_to_get_search_word_controller)
                                const search = {
                                    dateStart : this.dateStart,
                                    dateEnd :  this.dateEnd
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
        async searchInRangeDate(base_url){

            const dataRequest = {
                dateStart : this.dateStart,
                dateEnd : this.dateEnd,
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
                        fromRow : this.pagination.fromRow,
                        limit : this.pagination.limit
                    }
                   
                    this.$emit('dynamicDataToSearch',dynamicDataToSearch)

                    
                     this.$emit('responseRangeDate',res.data)
                     this.$emit('showTable',true)
                     this.$emit('loadingTable',false)
                     
                    //  settings url to fetch from pagination
                    this.$emit('urlTryPagination',this.base_url_searchDateRange)

                    // setting flag filtering
                    this.$emit('filtering',true)
                    
                 })
                 .catch(err =>{
                     const error = {type: 'no-exist',text: err,time: 4000}
                     this.error(error); return;
                 })
        },
        async showStatus(base_url){
            this.$emit('setSubHeadersLoader',true)
            await axios.get(base_url,{
                params : {
                    dateStart : this.dateStart,
                    dateEnd : this.dateEnd
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
            this.$emit('responseRangeDate', [])
            return
        },
        setLoader(flag){
            this.$emit('showLoaderLine', flag)
        }
    },
    computed: {
        ...Vuex.mapState('admin-avisos',['data']),
        validateForm(){
            let dateStart = this.dateStart
            let dateEnd = this.dateEnd
           
            if(dateStart === '' || dateEnd === ''){
                return true
            }else{
                return false
            }
        }
    },
   

})

