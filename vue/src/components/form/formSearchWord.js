Vue.component('form-search-word',{

    template : /*html*/ 
    `   
    
       <div  >
            <form 
            @submit.prevent="countSearchByWord" 
            id="sendFormWord" 
            class="d-flex justify-center flex-row align-center  flex-wrap ">
                <div class="mx-1 ">
                    <v-text-field
                    label="Complete identificación"
                    hide-details="auto"
                    v-model.trim="word"
                    >
                    </v-text-field >
                </div>
                <div class="mx-1 ">
                    <v-btn
                    color="primary"
                    fab
                    small
                    primary
                    type="submit"
                    form="sendFormWord"
                    class=" sacarOutline"
                    :disabled="validateForm"
                    >
                        <v-icon>mdi-magnify</v-icon>
                    </v-btn>
                </div>
            </form>
       </div>
    
    `,
    props:['titleFormId','pagination','searchByWord','subheaders','base_url_header','filter','base_url_to_count_search_word_controller','base_url_to_get_search_word_controller'],
    data() {
        return {
           word:'',
        }
    },
    methods:{
        async  countSearchByWord(){
            try {
                // this.$emit('loadingTable',true)
                const url = this.searchByWord.base_url_count
                await axios.get(url,{
                      params :{
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
                    const urlData = this.searchByWord.base_url_data
                    this.searchSearchById(urlData)
                        .then(()=>{
                            // show status if is true
                             this.subheaders.active ? this.showStatus(this.base_url_header) :  true;

                             // if searchALL is true, activate
                              if(this.searchByWord.filteringSearchWord){
                                    this.$emit('setShowFilter',true)
                                    this.$emit('setUrlSearchController',this.base_url_to_count_search_word_controller)
                                    this.$emit('setUrlGetDataSearchController',this.base_url_to_get_search_word_controller)
                                    const search = {
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
        async searchSearchById(base_url){
            
            const dataRequest = {
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
        async showStatus(base_url){
            this.$emit('setSubHeadersLoader',true)
            await axios.get(base_url,{
                params : {
                    word : this.word
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
            var validateID = this.id
            if(validateID === ''){
                return true
            }else{
                return false
            }
        }
    }
        
   

})
