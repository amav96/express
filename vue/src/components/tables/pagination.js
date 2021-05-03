Vue.component('pagination-custom',{
template : //html 
    `
      <div>
        <v-container class="max-width">
            <v-pagination
                v-model="page"
                class="my-4"
                :length="pagination.totalPage"
                @input="paginate"
            ></v-pagination>
        </v-container>
      </div>
    `,
    props:['pagination','urlTryPagination','loaderLine','dynamicDataToSearch'],
data (){
return {
    page : 1,
    pageCurrentLocal: '',
    rowForPage: '',
    fromRow: '',
    limit: '',
}
},
methods : {
        paginate(){
            this.setLoader(true)
            this.$emit('setPageCurrent',this.page)
            this.pageCurrentLocal = this.pageCurrentLocal
            this.rowForPage = this.pagination.rowForPage
            this.fromRow = (this.pagination.pageCurrent - 1) * this.rowForPage
            this.$emit('setFromRow',this.fromRow)
            this.limit = this.pagination.rowForPage

            const paginationCurrent = {
                fromRow : this.pagination.fromRow,
                limit : this.limit
            }

            const pagination = {...this.dynamicDataToSearch,...paginationCurrent}

            this.tryFetch(pagination)
              
        },
        tryFetch(dataRequest){
            const url = this.urlTryPagination
            axios.get(url,{
                params : {
                    dataRequest
                }
            })
            .then(res => {
                if(!res.data[0].result){
                    alertNegative("Ocurrio un error al paginar");
                    return
                }
                this.$emit('updateDataResponseDB',res.data)
                this.setLoader(false)
            })
            .catch(err =>{
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
        setLoader(flag){
            this.$emit('showLoaderLine', flag)
        },

}
})