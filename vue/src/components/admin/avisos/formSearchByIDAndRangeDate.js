Vue.component('form-search-by-id-and-range-date',{
    template : /*html*/ 
    `      
        <div>
            <form 
            @submit.prevent="searchIDAndRangeDate"
            id="sendFormIDRangeDate"
            class="d-flex justify-center flex-row align-center  flex-wrap ">
                <div class=" mx-1 ">
                    <v-select
                    :items="dataSelect"
                    :item-text="showDataSelect"
                    item-value="id"
                    label="Recolector"
                    v-model="idselect"
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
                    form="sendFormIDRangeDate"
                    :disabled="validateForm"
                    >
                    <v-icon>mdi-magnify</v-icon>
                    </v-btn>
                </div>

            </form>
        </div>
       
    `,
    props:['base_url_data_select','base_url_searchByIdAndRangeDate','titleFormByIdAndRangeDate','showDataSelect','dataSelect'],
    data() {
        return {
           dateStart: '',
           dateEnd: '',
           idselect:'',
           items: []
        }
    },
    methods: {
        ...Vuex.mapActions('admin-avisos',['getDataDB']),
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
        async searchIDAndRangeDate(){

            try {
                this.$emit('childrenTable',true)
                this.$emit('childrenLoadingData',true)

               await axios.get(this.base_url_searchByIdAndRangeDate,{
                    params:{
                        id : this.idselect,
                        dateStart : this.dateStart,
                        dateEnd : this.dateEnd
                    }
                })
                .then(res => {
                    if(!res.data[0].result){
                        const error = {
                            type: 'no-exist',
                            text: 'No hay datos para mostrar',
                            time: 4000
                        }
    
                        this.$emit('childrenError',error)
        
                         this.$emit('childrenLoadingData',false)
                         this.$emit('childrenTable',false)
                         this.$emit('dataChildsearchByIDAndRangeDate', [])
                        return
                    }
                    this.$emit('dataChildsearchByIDAndRangeDate',res.data)
                    this.$emit('childrenLoadingData',false)
                   
                    
                })
                .catch(err => {

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