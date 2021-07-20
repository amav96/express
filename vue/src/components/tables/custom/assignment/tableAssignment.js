Vue.component('table-assignment', {
    template: //html 
        `
    <div>
    <v-container>
        <template v-if="manualAssignment.display && select.selected.length > 0">
            <d-small-screen
             :dialogSmallScreen="manualAssignment"
            >
                <v-container>
                  <manual-assignment
                  :manualAssignment="manualAssignment"
                  :disabledByLoading="disabledByLoading"
                  :select="select"
                  @setUser="id_user = $event"
                  @setDateRange="dateRange = $event"
                  @manualAssigned="_manualAssigned($event)"
                  />
                </v-container>
            </d-small-screen>
        </template>

        <v-row class="d-flex justify-start flex-row flex-wrap my-1">
                <template v-if="!disabledAutomaticBtn">
                        <div class="mx-2 my-1">
                            <v-btn :disabled="select.selected.length<1 || disabledByLoading || disabledAutomaticBtn" color="info" @click="_automaticAssigned">
                                Asignar seleccionados automáticamente
                            </v-btn>
                        </div>
                </template>
                
                <div class="mx-2 my-1">
                    <v-btn :disabled="select.selected.length<1 || disabledByLoading" @click="manualAssignment.display = true" color="warning">
                        Asignar manualmente
                    </v-btn>
                </div>
                <div class="mx-2 my-1">
                    <v-btn :disabled="select.selected.length<1 || disabledByLoading" color="error" @click=_removeAssigned>
                        Quitar asignado
                    </v-btn>
                </div>
                
                <div class="mx-2 my-1">
                    <v-btn :disabled="disabledByLoading" @click="reloadUpdate()" color="info">
                     Actualizar
                     <v-icon right>
                     mdi-reload
                     </v-icon>
                    </v-btn>
                </div>
                <template v-if="select.selected.length>0">
                    <div class="mx-2 my-1">
                        <v-chip >
                        Seleccionados {{select.selected.length}}
                        </v-chip>
                    </div>
                </template>
                
        </v-row>
        <template v-if="resources.sectionCurrent === 'user' || resources.table.auxDataResponseDB.length>0">
            <div v-for="(item,i) in resources.table.auxDataResponseDB" :key="i">
                <template v-if="item.estado && item.cantidadEstado" >
                    <v-row class="d-flex justify-center flex-row">
                        <v-chip class="ma-1" >
                            {{item.estado }}  {{item.cantidadEstado}} 
                        </v-chip>
                    </v-row>
                </template>  
            </div>
        </template>
        
     

    </v-container>
        <v-simple-table class="mt-2" >
            <thead>
                <tr  class="bg-blue-custom">
                    <th v-for="column in columns"  class="text-left text-white">
                        <template v-if="column.icon && showSellectAll(resources.table.dataResponseDB)" >
                            <v-btn fab color="white" x-small  @click="handle_function_call(column.method)">
                                <v-icon>
                                    <template v-if="select.selected &&  select.selected.length < 1">
                                        {{column.icon}}
                                    </template>
                                    <template v-else>
                                        {{column.alt_icon}}
                                    </template>
                                </v-icon>
                            </v-btn>
                        </template>
                        <template v-else>
                            {{column.text}}
                        </template>
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="row in resources.table.dataResponseDB">
                    <td>
                        <template v-if="row.id_usuario_asignado && row.id_usuario_asignado !== '' && row.id_usuario_asignado !== null">
                            <input type="checkbox" ref="check" v-model="select.selected" :value="returnValueSelected(row.id,row.belongs.id_user)" :disabled="!row.belongs" >
                        </template>
                        <template v-else>
                            <input type="checkbox" ref="check" v-model="select.selected" :value="returnValueSelectedEmpty(row.id,row.belongs.id_user)" :disabled="!row.belongs" >
                        </template>
                    </td>
                    <td><strong>{{row.codigo_postal}}</strong></td>
                    <td>{{row.localidad}}</td>
                    <td>{{row.provincia}}</td>
                    <td>{{row.direccion}}</td>
                    <td>{{row.identificacion}}</td>
                    <td>{{row.serie}}</td>
                    
                    <template v-if="row.belongs" >
                        <td>
                            <v-chip color="success">
                            {{row.belongs.name}} - {{row.belongs.id_user}}
                            </v-chip>
                        </td>
                    </template>
                    <template v-else>
                        <td>   
                            <v-chip color="error">
                                Falta asignar CP
                            </v-chip>
                        </td>
                    </template>
                        <template v-if="row.id_usuario_asignado && row.id_usuario_asignado !== '' && row.id_usuario_asignado !== null">
                           <td>
                            <v-chip color="blue darken-1" class="text-white">
                                {{row.name_assigned }} {{row.name_alternative}} - {{row.id_usuario_asignado}}
                            </v-chip>
                           </td>
                        </template>
                        <template v-else>
                           <td>
                           <v-chip color="error" class="text-white">
                             No
                           </v-chip>
                          </td>
                        </template>
                        <td>{{row.cartera}}</td>
                        <td>{{row.estado}}</td>
                    <td>{{row.nombre_cliente}}</td>
                    <td>{{row.empresa}}</td>
                </tr>
            </tbody>
        </v-simple-table>
    </div>
    `,
    props: ['resources', 'columns', 'data', 'manualAssignment', 'disabledByLoading'],
    mixins: [tableAssignment],

})