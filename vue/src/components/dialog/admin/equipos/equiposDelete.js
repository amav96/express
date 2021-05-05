Vue.component('dialog-equipos-delete',{
template : //html 
    ` <v-dialog
      v-model="dialogDelete"
      persistent
      max-width="350"
    >
      <v-card>
        <v-card-title class="headline justify-center" >
          <h4>{{title}}</h4>
        </v-card-title>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn
            color="error"
            
            @click="closeDialog"
          >
           Salir
          </v-btn>
          <v-btn
            color="success"
            
            @click="deleteRow"
          >
            Si, estoy seguro/a
          </v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
    `,
props:['dialogDelete','title'],
data (){
return {
    dialogflag : true
}
},
methods : {
    closeDialog(){
        this.$emit('openDialog', false)
    },
    deleteRow(){
        this.$emit('deleteRow')
    },
        
}
})