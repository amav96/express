Vue.component('datos-contacto',{

    template: //html 
    `
    <div class="d-flex justify-content-center flex-column">

        <div  
        class="d-flex justify-content-start  flex-column"
        v-if="arrayNumeros.length > 0"
        >

            <v-card class="my-3 d-flex justify-content-center">
                <span class="color-indigo p-2 r-rounded-bg" > <strong><h5>Seleccione número</h5></strong> </span>
            </v-card>

            <div class="d-flex justify-content-center  flex-wrap">
             
                <button class="btn bg-green-vintage-chillon text-white btn-sm m-2 contactoSelection"
                v-for="numero in arrayNumeros" :key="numero"
                @click="setNotice(numero,'telefono')"
                :disabled="bloquear"
                >
                <i class="fab fa-whatsapp"></i>
                {{numero}} 
                </button>
                

            </div>

        </div>

        <div 
        class="d-flex justify-content-start flex-column"
        v-if="arrayEmail.length > 0"   
        >

        <v-card class="my-3 d-flex justify-content-center">
                 <span class="color-indigo p-2 r-rounded-bg " ><strong><h5>Seleccione correo</h5></strong></span>
            </v-card>

            <div class="d-flex justify-content-center  flex-wrap">
        
                <button 
                class="btn bg-red-vintage text-white btn-sm m-2 contactoSelection"
                v-for="(email,key) in arrayEmail" :key="email"
                @click="setNotice(email,'email')"
                :disabled="bloquearEmail"
                >
                <i class="far fa-envelope"></i>
                    <span class="mx-2" > {{email}} </span>
                <span 
                v-if="observarEmailEnviados"
                class="enviado"
                 >
                    <i class="fas fa-check" >  </i>  
                        
                </span>
                <span 
                class="spinner-custom spinner-border" 
                role="status"
                v-if="loadingSendNotice" 
                >
                </span>
                </button>
            </div>  
        </div>

         <transition name="fade">
            <error-alert v-if="error.tipo !== null"></error-alert>
        </transition>
        
    </div>
    `,
    data(){
        return{
            momentoAvisoEnviado: '',
            location: [],
            metodo:'',
        }
    },
    methods:{
        ...Vuex.mapActions('visita',['createdNotice']),
        ...Vuex.mapMutations('visita',['setLoadingSendNotice']),
       async setNotice(contacto,tipo){
         this.setLoadingSendNotice(true)
            const dataNotice = {
                contacto,
                tipo
            }
      await this.createdNotice(dataNotice)
        }
    },
    computed : {
        ...Vuex.mapState('visita',['arrayNumeros','arrayEmail','dataContacto','tipoDeAviso','loadingSendNotice','error','emailEnviado']),
         bloquear(){
            return this.loadingSendNotice ? true : false;
         },
         bloquearEmail(){
            const emailEnviado = localStorage.getItem('env')
            var result = false
            if(this.loadingSendNotice){
                result = true
            }else{
                result = false
            }

            if(emailEnviado !== null){
                result = true
            }
            
            return result;
         },
         observarEmailEnviados(){
             var result = false;
             const emailEnviadoLS = localStorage.getItem('env')
             if(this.emailEnviado){
                result = true
             }
             if(emailEnviadoLS !== null){
                result = true
             }else{
                result = false
             }
             return result
         }
         
    },
   
})