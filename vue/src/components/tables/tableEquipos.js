Vue.component('table-equipos', {
    template: /*html*/ 
    `
           <div>
           <dialog-equipos> <dialog-equipos/>
           <template>
                <v-simple-table>
                    <template v-slot:default>
                    <thead>
                        <tr >
                        <th v-for="column in columns" class="text-left">
                            {{column.text}}
                        </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr 
                        v-for="row in dataResponseDB"
                        >
                        <td>{{row.identificacion}}</td>
                        <td><strong>{{row.estado}}</strong></td>
                        <td>{{row.empresa}}</td>
                        <td>{{row.terminal}}</td>
                        <td>{{row.serie}}</td>
                        <td>{{row.serie_base}}</td>
                        <td>{{row.tarjeta}}</td>
                        <td>{{row.chip_alternativo}}</td>
                        <td>{{row.accesorio_uno}}</td>
                        <td>{{row.accesorio_dos}}</td>
                        <td>{{row.accesorio_tres}}</td>
                        <td>{{row.accesorio_cuatro}}</td>
                        <td>{{row.motivo}}</td>
                        <td>{{row.created_at}}</td>
                        <td>{{row.recolector}}</td>
                        <td>{{row.name}}</td>
                        <td>{{row.nombre_cliente}}</td>
                        <td>{{row.direccion}}</td>
                        <td>{{row.provincia}}</td>
                        <td>{{row.localidad}}</td>
                        <td>{{row.codigo_postal}}</td>
                        
                        <td>
                            <v-btn 
                            v-if="row.estado === 'RECUPERADO' || row.estado === 'AUTORIZAR'"
                            color="blue-grey"
                            class="white--text"
                            @click="urlRemito(row.remito)"
                            >
                            Ver remito
                            </v-btn>
                            <span
                            v-else
                            >
                            Codigo de orden {{row.remito}}
                            </span>
                        </td>  
                        
                        <td>
                        <v-btn color="warning" >Enviar </v-btn>
                        </td>
                        <td>
                        <v-btn color="error" class="ma-1" >Eliminar </v-btn>
                        <v-btn color="success" class="ma-1" >Editar </v-btn>
                        </td>  
                        </tr>
                    </tbody>
                    </template>
                </v-simple-table>
            </template>
             </div>
    `,
    props:['dataResponseDB','columns','dialog','base_url_showRemito'],
    data() {
        return {
            search: '',
            page : 1
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
         urlRemito (remito){
            window.open(this.base_url_showRemito+'&cd='+remito+'&tp=rmkcmmownloqwld', '_blank');
        }
        
    },
    computed: {
        headers () {
            return this.columns
          },
       
    }
})