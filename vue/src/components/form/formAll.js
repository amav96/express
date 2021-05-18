Vue.component('form-all',{
    template : /*html*/ 
    `      
    `,
    props:['showAllCoverage','pagination'],
    data() {
       return {
           
       }
    },
    methods: {
       async countAllCoverage(){
            try {
                this.$emit('loadingTable',true)
                await axios.get(this.showAllCoverage.base_url_count)
                .then(res => {
                    if(res.data.error){
                        const error = {type: 'no-exist',text: 'No hay datos para mostrar',time: 4000}
                        this.error(error); return;
                    }
                    
                    // settings values for pagination after to fetch count
                    const totalCountResponse = parseInt(res.data.count)
                    const totalPage = Math.ceil(totalCountResponse / this.pagination.rowForPage)
                    this.$emit('TotalPage',totalPage)
                    this.$emit('totalCountResponse',totalCountResponse)
                    
                    this.getAllCoverage(this.showAllCoverage.base_url_data)
                        .then(()=>{
                             // show status if is true
                             if(this.showAllCoverage.subheader){
                                this.showStatus(this.base_url_header)
                            }else {
                                this.$emit('setDisplayHeaders', false)
                            }
                            // if filter is true, activate
                            if(this.showAllCoverage.filteringSearchWord){
                                this.$emit('setShowFilter',true)
                                this.$emit('setUrlSearchController',this.base_url_to_count_search_word_controller)
                                this.$emit('setUrlGetDataSearchController',this.base_url_to_get_search_word_controller)
                                const search = {
                                    dateStart : this.dateStart,
                                    dateEnd :  this.dateEnd,
                                    word : this.word,
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
       async getAllCoverage(url){

                  const dataRequest = {
                    fromRow : this.pagination.fromRow,
                    limit : this.pagination.limit
                }
                    await axios.get(url,{
                            params :{
                                dataRequest
                            }
                        })
                     .then(res =>{
                        
                         if(res.data.error){
                             const error = {type: 'no-exist',text: 'No hay datos para mostrar',time: 4000}
                             this.error(error); return;
                         }
    
                          // setting dinamic data search for pagination
                        const dynamicDataToSearch = {
                            fromRow : this.pagination.fromRow,
                            limit : this.pagination.limit
                        }
                       
                        this.$emit('dynamicDataToSearch',dynamicDataToSearch)
    
                         this.$emit('response',res.data)
                         this.$emit('showTable',true)
                         this.$emit('loadingTable',false)
    
                         if(this.showAllCoverage.export){
                            this.$emit('setDisplayExportExcel',this.showAllCoverage.export)
                        }else{
                            this.$emit('setDisplayExportExcel',this.showAllCoverage.export)
                        }
                       
                        //  settings url to fetch from pagination
                        this.$emit('urlTryPagination',url)
    
                        // setting flag filtering
                        this.$emit('filtering',true)
                        
                     })
                     .catch(err =>{
                         console.log(err)
                         const error = {type: 'no-exist',text: err,time: 4000}
                         this.error(error); return;
                     })
        },
    },
    created() {
        this.countAllCoverage()
    }
})