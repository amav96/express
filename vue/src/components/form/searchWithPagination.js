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
                        <v-col cols="12"md="4">
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
                </v-row>
            </v-form>
            </v-container>

        </div>
    `,
    props:['searchWord','pagination'],
data (){
return {
    data : ''
}
},
methods : {
    tryCountSearch(){
        const urlCount = this.searchWord.url_searchCountController
        const urlGetData = this.searchWord.url_searchGetDataController
        const dynamicData = JSON.parse(JSON.stringify(this.searchWord.dynamicDataToSearchWordAll)) 
        const word = {
            search : this.data
        }
        const search = {...dynamicData,...word}
        
        axios.get(this.searchWord.url_searchCountController,{
            params : {
                search
            }
        })
        .then(res => {
           if(res.data.result){
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
        
               this.$emit('setCountPagination',pagination)

               this.searchWord();
           }else {
               alertNegative("no hay resultado asi que no se hace nada");
           }
        })
        .catch(err => {
            console.log(err)
        })
    },
    searchWord(){
        // tengo que pedir datos al controlador de datos. Cuando devuelva datos tengo que setear la dynamicDataToSearch del componente pagination
    }
        
},
watch : {
    search(value) {
        if(value === ''){
            console.log("esta vacio")
        }
    }
}
})