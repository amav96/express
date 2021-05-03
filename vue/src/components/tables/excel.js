Vue.component('excel-export',{
template : //html 
    `<div>
        <v-container>
            <v-btn
            class="text-white my-2"
            color="success"
            @click="exportExcel"
            >
            excel
            </v-btn>
        </v-container>
    </div>
    `,
    props:['dataResponseDB','columnExport'],
data (){
return {
        
}
},
methods : {
    exportExcel(){
        console.log(this.dataResponseDB)
        console.log(this.columnExport)
    }
        
}
})