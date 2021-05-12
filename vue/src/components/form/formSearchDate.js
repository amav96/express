Vue.component('form-search-date',{

    template : /*html*/ 
    `      
            <div>
                <v-form
                 @submit.prevent="countSearchInRangeDate" 
                 id="sendFormRangeDate" 
                 class="d-flex justify-center flex-row align-center  flex-wrap ">
                    <v-container fluid>
                        <v-row align="center"  class="d-flex justify-center" >
                            <v-col class="d-flex justify-center" cols="12" sm="5">
                                <v-text-field
                                label="Desde"
                                hide-details="auto"
                                type="date"
                                v-model="dateStart"
                                >
                                </v-text-field >
                            </v-col>

                            <v-col class="d-flex justify-center" cols="12" sm="5">
                                <v-text-field
                                label="Hasta"
                                hide-details="auto"
                                type="date"
                                v-model="dateEnd"
                                >
                                </v-text-field >
                            </v-col>

                            <v-col class="d-flex justify-center" cols="12" sm="2">
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
                            </v-col>
                           
                        </v-row>
                    </v-container>
                </v-form>
                
            </div>
    `,
    props:['titleFormRangeDate','pagination','subheaders','base_url_header','base_url_to_count_search_word_controller','base_url_to_get_search_word_controller','filter','searchByRangeDate'],
    data() {
        return {
           dateStart: '',
           dateEnd: '',
        }
    },
    methods: {
        async countSearchInRangeDate(){
            try {
                this.$emit('loadingTable',true)

                await axios.get(this.searchByRangeDate.base_url_count,{
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
                    this.searchInRangeDate(this.searchByRangeDate.base_url_data)
                        .then(()=>{
                             // show status if is true
                             if(this.searchByRangeDate.subheader){
                                this.showStatus(this.base_url_header)
                            }else {
                                this.$emit('setDisplayHeaders', false)
                            }

                            // if filter is true, activate
                            if(this.searchByRangeDate.filteringSearchWord){
                                this.$emit('setShowFilter',true)
                                this.$emit('setUrlSearchController',this.base_url_to_count_search_word_controller)
                                this.$emit('setUrlGetDataSearchController',this.base_url_to_get_search_word_controller)
                                const search = {
                                    dateStart : this.dateStart,
                                    dateEnd :  this.dateEnd
                                }
                                this.$emit('setDataDynamicToFilter',search) 
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

                    
                     this.$emit('response',res.data)
                     this.$emit('showTable',true)
                     this.$emit('loadingTable',false)

                     if(this.searchByRangeDate.export){
                        this.$emit('setDisplayExportExcel',this.searchByRangeDate.export)
                    }else{
                        this.$emit('setDisplayExportExcel',this.searchByRangeDate.export)
                    }
                     
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
        async showStatus(base_url){
          
            this.$emit('setSubHeadersLoader',true)
            await axios.get(base_url,{
                params : {
                    dateStart : this.dateStart,
                    dateEnd : this.dateEnd
                }
            })
            .then(res => {
               
                this.$emit('setSubHeadersLoader',false)
                if(!res.data[0].result){
                    this.$emit('setDisplayHeaders', false)
                    return
                }
                this.$emit('setSubHeadersDataResponseDB', res.data)
                this.$emit('setDisplayHeaders', true)
                   
            })
            .catch(err => {
                console.log(err)
            })
        },
        emit (eventName, value) {
            // This method should be used when it is very important and time consuming to update reactive data.
               return new Promise((resolve, reject) => {
                 this.$emit(eventName, value)
                 this.$nextTick(resolve)
               })
        },
        error(error){
            this.emit('setShowFilter',false)
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
           
            if(dateStart === '' || dateEnd === ''){
                return true
            }else{
                return false
            }
        }
    },
   

})

