Vue.component('boton-guia',{
template : //html 
    `
        <div>
            <button @click="instructivo" class="botonAnimation-guia c-Button " >Guia instructiva</button>
            <modal-guia :titleModal="titleModal" :bodyModal="bodyModal" ></modal-guia>
        </div>
   
    `,
data (){
return {
    textModal : 'Guia para recolectores',
    titleModal: '',
    bodyModal : []
}
},
methods : {
    ...Vuex.mapMutations('visita',['setModalGuia']),
    instructivo(){
       
        this.titleModal = 'Guía instructiva'
        this.setModalGuia(true)
    }
}
})