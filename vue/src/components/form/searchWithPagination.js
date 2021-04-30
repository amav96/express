Vue.component('search-withPagination',{
template : //html 
    `
        <div>
            <v-container>
             <v-row>
                <v-col cols="12"md="4">
                    <v-text-field
                    v-model="search"
                    label="Buscar"
                    >
                    </v-text-field>
                </v-col>
            </v-row>
            </v-container>

        </div>
    `,
data (){
return {
    search : ''
}
},
methods : {
        
},
watch : {
    search(value) {
        if(value === ''){
            console.log("esta vacio")
        }
    }
}
})