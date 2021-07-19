Vue.component('simple-table', {
    template: //html 
        `<div>
            <v-container>
                <v-simple-table class="mt-2" >
                    <thead>
                        <tr  class="bg-blue-custom">
                            <th v-for="column in columns"  class="text-left text-white">
                                {{column.text}}
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="row in rows">
                            <td> {{row.value}} </td>
                        </tr>
                    </tbody>
                </v-simple-table>
            </v-container>
    </div>
    `,

})