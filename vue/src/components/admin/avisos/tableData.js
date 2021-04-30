Vue.component('table-data', {
    template: /*html*/ 
    `
          
           <div>
           <vue-excel-xlsx
            :data="dataResponseDB"
            :columnExport="columnExport"
            :filename="nameExport"
            :sheetname="'sheetname'"
            class="success text-white btn-base"
            >
            Excel
                <v-icon
                small
                color="white"
                >
                mdi-file-excel
                </v-icon>
            </vue-excel-xlsx>
            <v-card>
                <v-data-table
                    :sort-by.sync="sortBy"
                    :sort-desc.sync="sortDesc"
                    :headers="headers"
                    :items="dataResponseDB"
                    item-key="id"
                    class="elevation-1"
                    :search="search"
                    :custom-filter="filterOnlyCapsText"
                    :loading="loadingTable"
                    loading-text="Loading... Please wait"
                >

                <template v-slot:top>
                    <v-text-field
                    v-model="search"
                    label="SOLO MAYUSCULA"
                    class="mx-4"
                    ></v-text-field>
                 </template>
                <template v-slot:item.actions="{ item }">
                <v-chip 
                color="orange"
                @click="showDialog(item)" >
                    <v-icon
                    small
                    color="white"
                    class="justify-center"
                  
                    >
                    mdi-email-outline
                    </v-icon>
                </v-chip>
                </template>
                </v-data-table>
            </v-card>
            <dialog-custom 
            :dataResponseDB="dataResponseDB" 
            :titleDialog="titleDialog"
            :bodyDialog="bodyDialog" 
            :dialog="dialog"
            :templateDialog="templateDialog"
            :actionsDialog="actionsDialog"
            @childrenDialogClosed="closedDialogOutSide" 
            
             ></dialog-custom>
             </div>
          

    `,
    props:['dataResponseDB','columns','columnExport','nameExport','loadingTable','dialog','titleDialog','bodyDialog','templateDialog','actionsDialog','sortBy','sortDesc'],
    data() {
        return {
            search: '',
        }
    },
    methods: {
      
        filterOnlyCapsText (value, search, item) {
            return value != null &&
              search != null &&
              typeof value === 'string' &&
              value.toString().toLocaleUpperCase().indexOf(search) !== -1
          },
         showDialog(item){
            this.$emit('childrenDialog',true)
            
            this.$emit('childrenBodyDialogTemplate',item) 
         },
         closedDialogOutSide(){
            // This closes the dialog when clicking outside of its container.
            this.$emit('childrenDialog',false)
         },
        
    },
    computed: {
        headers () {
            return this.columns
          },
    },
    
})
