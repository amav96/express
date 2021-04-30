 store.registerModule('visita', {
    namespaced: true,
    state: {
        flagAux : false,
        dataContacto : {
            identificacion:'',
            tipoDeAviso:'',
            metodo:'',
            order:'',
            locate: '',
            nameCustomer : ''
        },
        error: {
            tipo : null,
            message: null,
            alert: null,
            time : null
        },
        arrayNumeros:[],
        arrayEmail:[],
        loadingVisita: {
          tipo : null
        },
        loadingSendNotice : false,
        base_url: API_BASE_URL,
        modalGuia : false,
        flagSendEmailLoop : false,
        emailEnviado: false,
    },
    mutations:{
        mostrarflagAux(state,payload){
           state.flagAux = payload
        },
        setIdentificacion (state,payload){
            state.dataContacto.identificacion =  payload
           
        }, 
        setTipoDeAviso(state, payload){
            state.dataContacto.tipoDeAviso =  payload.tipo
            state.dataContacto.metodo =  payload.metodo
        },
        setLoadingVisita(state, payload){
            state.loadingVisita.tipo = payload.tipo
        },
        setLoadingSendNotice(state,payload){
            state.loadingSendNotice = payload
        },
        setError(state,payload){
            state.error.tipo = payload.tipo
            state.error.message = payload.message
            state.error.alert = payload.alert
            state.error.time = payload.time 
             setTimeout(() =>{
                 state.error.tipo = null
                 state.error.message = null
                 state.error.alert = null
                 state.error.time = null
                 
             },payload.time)

        },
        setOrder(state,payload){
            state.dataContacto.order = payload
        },
        setNumeros(state, payload){
            state.arrayNumeros = payload
        },
        setEmails(state,payload){
            state.arrayEmail = payload
            // by send automatic
            localStorage.setItem('arrayEmail',payload);
        },
        setEmailEnviado(state,payload){
            state.emailEnviado = payload
        },
        setLocate(state,payload){
           state.dataContacto.locate = payload
        },
        setNameCustomer(state,payload){
            state.dataContacto.nameCustomer = payload
        },
        setModalGuia(state,payload){
            state.modalGuia = payload
        },
        setFlagSendEmailLoop(state,payload){
            state.flagSendEmailLoop = payload
        }
    },
    actions:{
        async getDataCustomer({commit,state,dispatch}){
            try {
               
                var form = new FormData();
                form.append('datoIngresadoABuscar',state.dataContacto.identificacion)
               
                const res = await axios.post(API_BASE_URL+'controllers/equipoController.php?equipo=ver',
                form )
                const dataDB = await res.data 
                if(!dataDB[0].result){
                   
                    commit('setLoadingVisita',{tipo:null})
                    commit('setError',{tipo:'cliente inexistente',message:'Cliente no encontrado',alert:'alert-danger',time : 3000})
                    return
                }else{
                    dispatch('processContact',dataDB)
                    // vemos donde estamos ubicados
                    // administracion de avisos. y cada vez que busque un cliente se debe limpiar los accesorios
                    const url = window.location.pathname
                    if(url.search('avisos') > -1){
                            commit('setEmailEnviado',false)
                            localStorage.removeItem('env')
                    }else{
                        const orderVerify = localStorage.getItem('odh')
                        const envioEmail = localStorage.getItem('env')
                        const state = localStorage.getItem('state')
                        if(envioEmail === 'ymanagemente'){
                            if(state === null){
                            // si es null es porque cerro no envio aviso de visita desde el dashboardrecolector o esta cerrado
                            // viene de la gestion de avisos
                            localStorage.removeItem('env')
                            }
                        }
                    }
                }
            
            } catch (error) {

                console.log(error)
                alertNegative(error)
               
            }

        },
        async processContact({commit,state,dispatch},dataDB){
            // por si acaso busca por serie, le asigno de igual manera la identificacion q devuelve
            commit('setIdentificacion',dataDB[0].identificacion)

            var telefonosAProcesar = []
            dataDB.forEach((val)=>{
                    
                if(val.telefono_cel4 !== '' && val.telefono_cel4 !== null)
                    telefonosAProcesar.push(val.telefono_cel4.trim())
                if(val.telefono_cel5 !== '' && val.telefono_cel5 !== null)
                    telefonosAProcesar.push(val.telefono_cel5.trim())    
                if(val.telefono_cel6 !== '' && val.telefono_cel6 !== null)
                    telefonosAProcesar.push(val.telefono_cel6.trim())     
            })

            await dispatch('limpiarNumeros',telefonosAProcesar)
               .then((telefonos) => {
                   commit('setNumeros',telefonos)
               })
               .catch((error => {
                   console.log(error)
               }))

             var emailAProcesar = []   
             dataDB.forEach((val) => {
                if(val.emailcliente !== '' && val.emailcliente !== null ){
                    emailAProcesar.push(val.emailcliente.replace(/ /g, ""))
                }
            })           

           await dispatch('limpiarEmail',emailAProcesar)
                .then((emails => {
                    commit('setEmails',emails)
                }))
                .catch((error => {
                    console.log(error)
                }))

            if(state.arrayNumeros.length === 0 && state.arrayEmail.length === 0){
               
                 commit('setLoadingVisita',{tipo:null})
                 commit('setError',{tipo:'sin datos',message:'Este cliente no posee datos disponibles para el envio de avisos, de igual manera tu intento de gestionar quedó registrado y nos servira para mejorar los datos. Gracias :) ',alert:'alert-primary',time: 8000})
                    const dataNoticeEmpty = {
                        contacto: 's/r',
                        tipo: 's/r'
                    }
                commit('setLocate', dataDB[0].localidad)
                commit('setNameCustomer', dataDB[0].nombreCli)
                await dispatch('createdNotice',dataNoticeEmpty)
                return
            }

            commit('setLocate', dataDB[0].localidad)
            commit('setNameCustomer', dataDB[0].nombreCli)

            commit('setLoadingVisita',{tipo:null})
            commit('mostrarflagAux',true)
        },
        async emptyContact({commit,state,dispatch},dataDB){

            const postal_code = dataDB[0].cp
            var form = new FormData;
            form.append('postal_code',postal_code)
           await axios.post(state.base_url+'controllers/noticeController.php?notice=emptyContact',form)
                .then(res => {
                    var numeroAEnviar= []
                    const respondeDataDB = res.data
                    if(respondeDataDB[0].result){
                        numeroAEnviar.push(respondeDataDB[0].telefono)
                    }else{
                        let numRocio = '1125760888'
                        console.log("else")
                        numeroAEnviar.push(numRocio)
                    }
                    commit('setNumeros',numeroAEnviar) 
                })
                .catch(error => {
                    console.log(error)
                })


        },
        async createdNotice({commit,state,dispatch},payload){

            var id_recolector = document.getElementById('id_recoleorden').value
            var country_recolector = document.getElementById('country_recolector').value
            var hoy = new Date();
            var getMinutos = hoy.getMinutes();
            var getSegundos = hoy.getSeconds()
            var getHora = hoy.getHours()
      
            if(getMinutos<10){
                    getMinutos = '0' + hoy.getMinutes()
            }
            if(getSegundos<10){
                getSegundos = '0' + hoy.getSeconds()
            }
            if(getHora<10){
            getHora = '0' + hoy.getHours()
            }
        
            var momentoAvisoEnviado = hoy.getFullYear() + '-' + ("0" +(hoy.getMonth() + 1)).slice(-2) + '-' +
            ("0" + hoy.getDate()).slice(-2)+ ' ' + getHora + ':' + getMinutos + ':' + getSegundos;

            // commit('setLoadingSendNotice',false)
            // this.showLoadingSendNotice(true)

                  try {
                    await dispatch('locateMe')
                    .then(()=>{
                        const dataNotice = {
                            contacto: payload.contacto,
                            medio: payload.tipo,
                            aviso:state.dataContacto.tipoDeAviso,
                            identificacion: state.dataContacto.identificacion,
                            id_user : id_recolector,
                            country : country_recolector,
                            created_at : momentoAvisoEnviado,
                            metodo : state.dataContacto.metodo,
                            lat : this.location.coords.latitude,
                            lng : this.location.coords.longitude,
                            order: state.dataContacto.order,
                            locate: state.dataContacto.locate,
                            nameCustomer: state.dataContacto.nameCustomer
                        }
                     dispatch('setNotice',dataNotice)

                    })
                    .catch((error)=>{
                        console.log(error)
                        alertNegative(error)
                        commit('setLoadingSendNotice',false)
                    })
                      
                  } catch (error) {
                    console.log(error)
                    alertNegative(error)
                    commit('setLoadingSendNotice',false)
                  }

         },
        async locateMe({commit,dispatch}) {
    
            try {

            this.location = await dispatch('getLocation')

            } catch(e) {

                console.log(e)
                alertNegative(e)
                commit('setLoadingSendNotice',false)
            }
            
        },
        getLocation({commit}) {
            
            return new Promise((resolve, reject) => {
    
             if(!("geolocation" in navigator)) {

                commit('setLoadingSendNotice',false)
                alertInfo('Ubicación denegada','Para poder enviar avisos debes permitir el acceso a tu ubicación temporalmente. Seguí estos pasos : Ingresa en tu navegador Chrome/Firefox : 1) Clic en Configuracion. 2) Configuracion avazanda / Configuracion de sitios. 3) Ubicación 4) Bloqueados ( Si devuelvoya.com esta en esta lista de bloqueados, clic en Permitir) y vuelve a cargar la web','info')
                return 
            }
    
            navigator.geolocation.getCurrentPosition(pos => {
                resolve(pos);
            }, err => {
 
                commit('setLoadingSendNotice',false)
                alertInfo('Ubicación denegada','Para poder enviar avisos debes permitir el acceso a tu ubicación temporalmente. Seguí estos pasos : Ingresa en tu navegador Chrome/Firefox : 1) Clic en Configuracion. 2) Configuracion avazanda / Configuracion de sitios. 3) Ubicación 4) Bloqueados ( Si devuelvoya.com esta en esta lista de bloqueados, clic en Permitir) y vuelve a cargar la web','info')
            });
    
            });
        }, 
        async setNotice({commit,dispatch,state},notice){  
            
            // // si tiene varios email 
             var setNotice = new FormData();
             setNotice.append('aviso',notice.aviso)
             setNotice.append('contacto',notice.contacto)
             setNotice.append('country',notice.country)
             setNotice.append('created_at',notice.created_at)
             setNotice.append('order',notice.order)
             setNotice.append('id_user',notice.id_user)
             setNotice.append('identificacion',notice.identificacion)
             setNotice.append('lat',notice.lat)
             setNotice.append('lng',notice.lng)
             setNotice.append('medio',notice.medio)
             setNotice.append('metodo',notice.metodo)
            
             axios.post(API_BASE_URL+'controllers/noticeController.php?notice='+notice.metodo,setNotice)
                .then(response =>{
                 if(!response.data[0].result){
                     alertNegative("Ocurrio un error al registrar aviso")
                     commit('setLoadingSendNotice',false)
                 }else{

                    const emailEnviados = localStorage.getItem('env')
                    
                     if(notice.medio === 'telefono'){
                          dispatch('sendWhatsapp',notice)
                          if(state.arrayEmail.length > 0 && emailEnviados === null){
                            dispatch('sendEmailLoop',notice)
                            }else{
                                commit('setLoadingSendNotice',false)
                            }
                     }else if(notice.medio === 'email'){
                        if(state.arrayEmail.length > 0 && emailEnviados === null){
                            dispatch('sendEmailLoop',notice)
                        }else{
                            commit('setLoadingSendNotice',false)
                        }
                     }
                     // si el aviso es desde el panel recolector / domicilio                    
                     if(notice.aviso === 'domicilio'){

                         if(JSON.parse(localStorage.getItem('aviso') === null)){
                             const aviso = {
                                 identificacion : notice.identificacion
                             }
                           localStorage.setItem('aviso',JSON.stringify(aviso))
                         }
                     }
                 }
                })
                .catch(error => {
                    commit('setLoadingSendNotice',false)
                    
                    alert(error)
                })

        },
        sendWhatsapp({commit,dispatch,state},notice){

            var caracteristicaPais= ''
            var contactoYHorarioExterno= ''
            if(notice.country === 'Argentina'){
                caracteristicaPais = '54'
                contactoYHorarioExterno = '0810-362-2830%20Lunes%20a%20Viernes%208%20-%2017%20hs'
             }else if(notice.country === 'Uruguay'){
                 caracteristicaPais = '598'
                 contactoYHorarioExterno = '598 97 438238%20Lunes%20a%20Viernes%208%20-%2017%20hs'
             }
    
            var getEmpresa = notice.identificacion.substr(0,2);
            var empresa = dispatch('searchCompany',getEmpresa)
                  .then(emp => {
                    var equipo = ''
               
                    switch(emp){
                        case 'LAPOS':
                           equipo = 'Terminal Pos'
                           break;
                        case 'POSNET':
                           equipo = 'Terminal Pos'
                           break;
                        case 'ANTINA':
                           equipo = 'Decodificador'
                           break;
                        case 'INTV':
                           equipo = 'Decodificador'
                           break;
                        case 'IPLAN':
                           equipo = 'Modem'
                           break;
                        case 'METROTEL':
                           equipo = 'Modem'
                           break;
                        case 'CABLEVISION':
                           equipo = 'Canalera'
                           break;
                        case 'SUPERCANAL':
                           equipo = 'Decodificador'
                           break;
                        case 'MOVISTAR':
                           equipo = 'Decodificador'
                           break;
                    }

            var message = ''
            if(notice.aviso === 'ruta'){
                message = '*'+emp+'-'+equipo+'-'+notice.nameCustomer+'*-Cliente :'+' '+notice.identificacion+'.%0aComo%20le%20anticipamos%20y%20por%20indicación%20de%20*'+emp+'*%20visitaremos%20en%20la%20fecha%20su%20domicilio%20para%20realizar%20el%20retiro%20de%20los%20*Equipos*.%0aPor%20tal%20solicitamos,%20disponer%20equipo%20en%20mano.%20O%20ante%20dudas%20responder%20a%20este%20número%20o%20consultar%20al%20'+contactoYHorarioExterno+''
                
            }
            if(notice.aviso === 'manana'){
                message = '*'+emp+'-'+equipo+'-'+notice.nameCustomer+'*-Cliente :'+' '+notice.identificacion+'.%0aPor%20indicación%20de%20*'+emp+'*%20en%20el%20día%20de%20mañana%20visitaremos%20su%20domicilio%20para%20realizar%20el%20retiro%20de%20los%20*Equipos*.%0aPor%20tal%20solicitamos,%20disponer%20equipo%20en%20mano.%20O%20ante%20dudas%20responder%20a%20este%20número%20o%20consultar%20al%20'+contactoYHorarioExterno+''
           
            }

            if(notice.aviso === 'domicilio'){
                message = '*'+emp+'-Aviso de visita-*-Cliente :'+' '+notice.identificacion+'.%0aEn%20el%20dia%20de%20la%20fecha%20hemos%20visitado%20su%20domicilio%20para%20realizar%20el%20retiro%20de%20los%20equipos.%20Por%20tal%20solicitamos,%20disponer%20*NUEVAMENTE*%20equipo%20a%20mano%20y%20responder%20a%20este%20número%20ó%20al%20'+contactoYHorarioExterno+''
            }

            // Si hay email el encargado del loader es el envio del emailLoop
            const arrayEmail = state.arrayEmail
            if(arrayEmail.length === 0){
             commit('setLoadingSendNotice',false)
            }
            

            var numero = caracteristicaPais+notice.contacto
            var url = 'https://api.whatsapp.com/send?phone='
            
            window.open(url + numero +'&text=' + message, '_blank');

                  })
                  .catch(error => {
                    console.log(error)
                    alertNegative(error)
                  })
        },
        sendEmail({commit,dispatch},notice){
                    // Esto no se esta utilizando
            let empresaIniciales = notice.identificacion.substr(0,2)
            dispatch('searchCompany',empresaIniciales)
                .then(res =>{
                   let empresa = res;
                   
                   var dataEmail = new FormData
                   dataEmail.append('contacto',notice.contacto)
                   dataEmail.append('identificacion',notice.identificacion)
                   dataEmail.append('fecha',notice.created_at)
                   dataEmail.append('pais',notice.country)
                   dataEmail.append('empresa',empresa)
                   dataEmail.append('aviso',notice.aviso)
                   dataEmail.append('locate',notice.locate)
                   dataEmail.append('nameCustomer',notice.nameCustomer)
                   var result = ''
                   axios.post(API_BASE_URL+'helpers/email.php?email=mailNotice',dataEmail)
                       .then(response =>{
                           if(response.data.result === '1'){
                              // IMPORTANTE!! COLOCAR LOADER MIENTRAS ENVIA / 
                              //evaluar si hayq ue desactivar el boton de cada vez q se envia
                            //   commit('setLoadingSendNotice',false)
                              
                            //   commit('setError',{tipo:'success',message:'Aviso enviado correctamente',alert:'alert-success',time : 3000})
                            //   return
                            
                            return result = 'evnaido'
                              
                           }else{

                            return result = 'no enviado'

                            commit('setError',{tipo:'error',message:'Ocurrio algun error en el envio de aviso',alert:'alert-warning',time : 3000})
                            commit('setLoadingSendNotice',false)
                           }
                       })
                       .catch(error => {
                           console.log(error)
                           alertNegative(error)
                       })

                })
                .catch(error => {
                    console.log(error)
                    alertNegative(error)
                })

           
    
        },
        async searchCompany({commit},getEmpresa){

                var empresa = "";
    
                switch(getEmpresa.toUpperCase()){
                    case 'LA' || 'LA2' || 'LA3' || 'LA4' || 'LAM':
                       empresa = 'LAPOS'
                    break
                    case 'PS' || 'PS2':
                       empresa = 'POSNET'
                    break
                    case 'AN' || 'AN2':
                       empresa = 'ANTINA'
                    break
                    case 'IN' || 'IN2':
                       empresa = 'INTV'
                    break
                    case 'SC' || 'SC2':
                       empresa = 'SUPERCANAL'
                    break
                    case 'CV':
                       empresa = 'CABLEVISIÓN'
                    break
                    case 'MT':
                       empresa = 'METROTEL'
                    break
                    case 'IP':
                        empresa = 'IPLAN'
                     break
                     case 'MV':
                        empresa = 'MOVISTAR'
                     break
                }
    
                return empresa;
        
        },
        limpiarEmail({commit},email){

            return new Promise((resolve, reject) => {
                    var emailLimpiosTemporal = []
                    var emailFinal = []
                
                    email.forEach((email => {
                    if(email.indexOf(";") === -1){
                        emailLimpiosTemporal.push(email)
                    }else{
                        let puntoYComa = ";"
                        email.split(puntoYComa).forEach((emailPuntoYComa) => {
                            if(emailPuntoYComa.indexOf("/") === -1){
                                emailLimpiosTemporal.push(emailPuntoYComa)
                            }else{
                            let barra = "/"
                            emailPuntoYComa.split(barra).forEach((eBarra) => {
                                emailLimpiosTemporal.push(eBarra)
                            })
                            }
                        })
                    }
                }))

                emailFinal = emailLimpiosTemporal.filter((email,index) => {
                    return emailLimpiosTemporal.indexOf(email) === index 
                })
                const reg = /@/g;
                const emailClean = emailFinal.filter(email => {
                    return email.search(reg) > -1
                })
                resolve(emailClean)
                reject('Error email')
            })
        
        },
        limpiarNumeros({commit},telefonos){
           var telefonosLimpios = []
            return new Promise((resolve,reject) => {
                telefonosLimpios = telefonos.filter((telefono,index) => {
                    return telefonos.indexOf(telefono) === index
                })
               resolve(telefonosLimpios)
               reject('Error telefono')
            })
        },
        async sendEmailLoop({commit,dispatch,state},notice){
            commit('setLoadingSendNotice',true)
            const identificacion = notice.identificacion.substr(0,2).toUpperCase()
          
             await dispatch('searchCompany',identificacion)
             .then(res => {
                 const empresa = res
               
                     var metodo;
                     let notice_send = new FormData();
                     notice_send.append('aviso',notice.aviso)
                     notice_send.append('country',notice.country)
                     notice_send.append('created_at',notice.created_at)
                     notice_send.append('order',notice.order)
                     notice_send.append('id_user',notice.id_user)
                     notice_send.append('identificacion',notice.identificacion)
                     notice_send.append('lat',notice.lat)
                     notice_send.append('lng',notice.lng)
                     notice_send.append('medio','email')
                     notice_send.append('contacto',state.arrayEmail)
                     notice_send.append('nameCustomer',state.dataContacto.nameCustomer)
                     notice_send.append('locate',state.dataContacto.locate)
                     notice_send.append('empresa',empresa)
                     if(notice.metodo === 'setNotice'){
                        metodo='setNoticeLoop'
                     }
                     if(notice.metodo === 'setNoticeManagement'){
                        metodo='setNoticeManagementLoop'
                     }
                    axios.post(API_BASE_URL+'controllers/noticeController.php?notice='+metodo,notice_send)
                     .then(res => {
                         if(res.data.result){
                            const url = window.location.pathname
                            if(url.search('avisos') > -1){
                                localStorage.setItem('env','ymanagemente');
                            }else {
                                localStorage.setItem('env','ydashboard');
                                localStorage.setItem('state','dashboard');
                            }
                            
                             commit('setEmailEnviado',true)
                             commit('setLoadingSendNotice',false)
                         }
                        
                     })
                     .catch(err => {
                        console.log(err)
                     })
                    
                  
             })
             .catch(err => {
                 console.log(err)
             })
         

        }
       
    },
    
    
  })