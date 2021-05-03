Vue.component('form-search-date',{

    template : /*html*/ 
    `      
            <div>
                <form 
                 @submit.prevent="searchInRangeDate" 
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
                </form>
            </div>
    `,
    props:['base_url_searchDateRange','titleFormRangeDate'],
    data() {
        return {
           dateStart: '',
           dateEnd: '',
        }
    },
    methods: {
        ...Vuex.mapActions('admin-avisos',['getDataDB']),
       async searchInRangeDate(){
            try {

                this.$emit('childrenTable',true)
                this.$emit('childrenLoadingData',true)

              await axios.get(this.base_url_searchDateRange,{
                    params :{
                        dateStart : this.dateStart,
                        dateEnd : this.dateEnd
                    }
                })
                .then(res =>{
                   
                    if(!res.data[0].result){
                        const error = {
                            type: 'no-exist',
                            text: 'No hay datos para mostrar',
                            time: 4000
                        }
                        this.$emit('childrenError',error)
                        this.$emit('childrenLoadingData',false)
                        this.$emit('childrenTable',false)
                        this.$emit('dataChildsearchInRangeDate', [])
                        return
                    }

                    this.$emit('dataChildsearchInRangeDate',res.data)
                    this.$emit('childrenLoadingData',false)
                })
                .catch(err =>{
                    const error = {
                        type: 'no-exist',
                        text: err,
                        time: 4000
                    }
                    this.$emit('childrenError',error)
                    this.$emit('childrenTable',false)
                    this.$emit('childrenLoadingData',false)
                })
                
            } catch (err) {
                const error = {
                    type: 'no-exist',
                    text: err,
                    time: 4000
                }
                this.$emit('childrenError',error)
                this.$emit('childrenTable',false)
                this.$emit('childrenLoadingData',false)
            }
            
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
    }

})

