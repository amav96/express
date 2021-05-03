Vue.component('search-withPagination',{
template : //html 
    `
        <div>
            <v-container>
            <v-form @submit.prevent="tryCountSearch" id="form-search">
                <v-row>
                    <v-col cols="12"md="4">
                        <v-text-field
                        v-model="data"
                        label="Buscar"
                        >
                        </v-text-field>
                    </v-col>
                    <v-col cols="12"md="3">
                        <v-btn
                        color="primary"
                        fab
                        small
                        primary
                        form="form-search"
                        type="submit"
                        >
                            <v-icon>mdi-magnify</v-icon>
                        </v-btn>
                    </v-col>
                    <transition name="slide-fade">
                        <v-col cols="12"md="4">
                        <v-alert 
                        v-if="alert_flag"
                        type="info"
                        >No se hay coincidencias para <strong>"{{data}}"</strong>
                        </v-alert>
                        </v-col>
                    </transition>
                </v-row>
            </v-form>
            </v-container>

        </div>
    `,
    props:['searchWord','pagination','dataResponseDB','dynamicDataToSearch'],
data (){
return {
    data : '',
    objectSearch: [],
    responseDataDbAfter: [],
    dataDynamicAfter: [],
    paginationBefore : [],
    alert_flag : false
    

}
},
methods : {
    emit (eventName, value) {
        // This method should be used when it is very important and time consuming to update reactive data.
           return new Promise((resolve, reject) => {
             this.$emit(eventName, value)
             this.$nextTick(resolve)
           })
    },
    tryCountSearch(){
        const dynamicData = JSON.parse(JSON.stringify(this.searchWord.dynamicDataToSearchWordAll)) 
        const word = {
            search : this.data
        }
        this.objectSearch = {...dynamicData,...word}
        const search = this.objectSearch
        
        axios.get(this.searchWord.url_searchCountController,{
            params : {
                search
            }
        })
        .then(res => {
           if(res.data.count > '0'){
            //    settins value before the update
              this.dataDynamicAfter = this.dynamicDataToSearch
              this.paginationBefore = this.pagination
               // settings values for pagination after to fetch count
               const totalCountResponse = parseInt(res.data.count)
               const totalPage = Math.ceil(totalCountResponse / this.pagination.rowForPage)
               const pagination = {
                totalPage,
                rowForPage:10,
                pageCurrent: 1,
                totalCountResponse,
                fromRow:0,
                limit:10
               }
        
               //  settings url to fetch from pagination
               this.$emit('urlTryPagination',this.searchWord.url_searchGetDataController)

               this.emit('setCountPagination',pagination)
                    .then(()=>{
                        this.getWord();
                    })

           }else {
            this.alert_flag = true
                setTimeout(() => {
                    this.alert_flag = false
                }, 3000);
                return
           }
        })
        .catch(err => {
            console.log(err)
        })
    },
    getWord(){
        // tengo que pedir datos al controlador de datos. Cuando devuelva datos tengo que setear la 
        // dynamicDataToSearch del componente pagination
        const url = this.searchWord.url_searchGetDataController
        const pagination = {
            fromRow : this.pagination.fromRow,
            limit : this.pagination.limit
        }
        const dynamicDataToSearch = this.objectSearch
        const dataRequest = {...pagination,...dynamicDataToSearch}
        this.$emit('dynamicDataToSearch',dataRequest)
        axios.get(url,{
            params : {
                dataRequest
            }
        })
        .then(res => {
            if(res.data[0].result){
                this.responseDataDbAfter = res.data 
                this.$emit('setAfterDataResponse', this.responseDataDbAfter)
            }

        })
        .catch(err => {
            console.log(err)
        })
    }
        
},
//  watch : {
//      data(value) {
//          if(value === ''){
//              if(this.responseDataDbAfter.length > 0){
                
//                  this.$emit('restorePagination', this.paginationBefore)
//                  this.$emit('restoreDynamicDataToSearch',this.dataDynamicAfter)
//                  this.$emit('restoreBeforeDataResponse', this.responseDataDbBefore)
//              }
           
//          }
//      }
//  }
})