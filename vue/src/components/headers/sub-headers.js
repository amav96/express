Vue.component('sub-headers',{
template : //html 
    `
    <div>
        <template>
            <div class="text-center">
                <v-chip
                
                v-for="(item,i) in subheaders.dataResponseDB"
                :key="i"
                class="ma-2"
               
                >
                {{item.estado}} {{item.cantidadEstado}}
                </v-chip>
            </div>
        </template>
       
    </div>
   
    `,
props:['subheaders'],
destroyed (){
    this.$emit('setDisplayHeaders',false);
}
})