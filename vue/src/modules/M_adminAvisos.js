store.registerModule('admin-avisos', {
    namespaced: true,
    state: {
      data: [],
      dialog : false,
      table: false,
      loadingTable: false,
      dataDialog:[]
    },
    mutations:{

      setDataDB(state,payload){
         state.data = payload
      },
      setDataDialog(state,payload){
        state.dataDialog = Object.assign({}, payload)
       
      },
      showLoading(state,payload){
        state.loadingTable = payload
      },
      showTable(state,payload){
        state.table = payload
       },
      showDialog(state,payload){
       state.dialog = payload
      }
      
    },
    actions:{

      getDataDB({dispatch},payload){

        if(payload.methods === 'getNoticesById'){
           dispatch('getNoticesById',payload)
        }
        if(payload.methods === 'getNoticesByIdAndDate'){
          dispatch('getNoticesByIdAndDate',payload)
       }
      },
      async getNoticesById({commit},payload){

      try {
        commit('showLoading',true)
        const form = {
          id : payload.identificacion
        }
        
        const dataDB = await axios.get(API_BASE_URL+'controllers/noticeController.php?notice='+payload.methods, {
          params : form
        })
        .then(res => {

           console.log(res)
          if(!res.data[0].result){
           alertNegative("no hay datos")
           commit('showLoading',false)
          return 
          }
          
          commit('setDataDB',res.data)
          commit('showLoading',false)
          commit('showTable',true)

        })
        .catch(error => {
          console.log(error)
        })
        
      } catch (error) {
          console.log(error)
      }
       
      
      }
       
    },
    
    
  })
