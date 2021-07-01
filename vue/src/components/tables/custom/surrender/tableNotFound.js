Vue.component('table-not-found', {
    template: //html 
        `
    <div>
        <v-alert
        class="ma-4 d-flex justify-center"
        dense
        outlined
        color="error"
        >
            <h5>No encontrados</h5>
            <template>
                <VueExcelXlsx 
                :columnExport="readData.import.table.columns"  
                :data="readData.import.table.dataResponse.fail"
                filename="No encontrados"
                 >
                    <v-btn
                    color="success"
                    fab
                    x-small
                    class="my-2"
                    >
                        <v-icon>
                            mdi-file-excel-outline
                        </v-icon>
                    </v-btn>
                </VueExcelXlsx>
                <v-card class="mx-auto">
                    <v-card-title>
                        <v-text-field
                        v-model="readData.import.table.search"
                        append-icon="mdi-magnify"
                        label="Buscar"
                        single-line
                        hide-details
                        ></v-text-field>
                    </v-card-title>
                    <v-data-table
                        :headers="readData.import.table.columns"
                        :items="readData.import.table.dataResponse.fail"
                        :search="readData.import.table.search"
                    ></v-data-table>
                </v-card>
            </template>
        </v-alert>
    
    </div>
    `,
    props: ['readData'],
    data() {
        return {

        }
    },
    methods: {

    }
})