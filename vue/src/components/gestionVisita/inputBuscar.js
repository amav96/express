Vue.component('input-buscar',{
    template : /*html*/ 
    `
    <div class="my-4 d-flex justify-content-center flex-column">

         <div class="d-flex justify-content-center align-items-center  flex-column" >
            <input type="text" class="in-buscar-modern" placeholder="Complete cliente" @input="setearIdentificacion(input)" @keyup="setearIdentificacion(input)" v-model="input" />

            <transition name="fade">
                <error-alert v-if="error.tipo !== null"></error-alert>
            </transition>
        </div>
    </div>
  
    `,
    data () {
        return{
            input:''
        }
    },
    computed:{
        ...Vuex.mapState('visita',['error','dataContacto'])
    },

    methods:{
        ...Vuex.mapMutations('visita',['setIdentificacion']),
        setearIdentificacion(input){
            this.setIdentificacion(input)
        }

    }

})

