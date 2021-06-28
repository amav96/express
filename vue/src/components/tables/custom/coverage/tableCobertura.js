Vue.component("table-cobertura", {
    template: /*html*/ `
          <div>
                <template v-if="dialogFullScreen.display" >
                    <d-full-screen :dialogFullScreen="dialogFullScreen">
                        <template v-if="dataDelete.display">
                            <delete-coverage 
                            :dialogFullScreen="dialogFullScreen"
                            :admin="admin"
                            :response="dataDelete"
                            @setSnack="$_setMessage($event)"
                            @setDialog="dialogFullScreen.display = $event"
                            @setRowAltered="$_setRowAltered($event)"
                            />
                        </template>
                        <template v-if="dataUpdate.display">
                            
                            <v-row class="d-flex mx-1 mt-2" >
                                    <v-col  cols="12" xl="10" lg="10" md="10" sm="10" xs="10"  >
                                        <h6 class="mb-3 mt-1">Zona actual cubierta por </h6>
                                        <alert-info-user
                                        :info="dataUpdate.data"
                                        />
                                    </v-col>
                                    <v-col class="my-1" cols="12" xl="4" lg="4" md="6" sm="6" xs="4"  >
                                    <h6 class="mb-6">Nuevo tipo de asignado</h6>    
                                        <v-select
                                        v-model="updateOnly.type"
                                        :items="selectType"
                                        item-text="text"
                                        item-value="value"
                                        outlined
                                        class="mb-1"
                                        dense
                                        label="Seleccione"
                                        hide-no-data
                                        hide-details
                                        >
                                        </v-select>
                                    </v-col>
                            </v-row>

                                <template v-if="updateOnly.type === 'recolector'">
                                    <update-onlyOne-collector
                                    :dialogFullScreen="dialogFullScreen"
                                    :admin="admin"
                                    :response="dataUpdate"
                                    :pagination="pagination"
                                    @setSnack="$_setMessage($event)"
                                    @setDialog="dialogFullScreen.display = $event"
                                    @setRowAltered="$_setRowAltered($event)"
                                    
                                    />
                                </template>
                                <template v-if="updateOnly.type === 'comercio'">
                                    <update-onlyOne-commerce
                                    :dialogFullScreen="dialogFullScreen"
                                    :admin="admin"
                                    :response="dataUpdate"
                                    @setSnack="$_setMessage($event)"
                                    @setDialog="dialogFullScreen.display = $event"
                                    @setRowAltered="$_setRowAltered($event)"
                                    />
                                </template>
                                <template v-if="updateOnly.type === 'correo' || updateOnly.type === 'terminal'">
                                    <update-onlyOne-point
                                    :dialogFullScreen="dialogFullScreen"
                                    :admin="admin"
                                    :response="dataUpdate"
                                    :updateOnly="updateOnly"
                                    @setSnack="$_setMessage($event)"
                                    @setDialog="dialogFullScreen.display = $event"
                                    @setRowAltered="$_setRowAltered($event)"
                                    />
                                </template>
                        </template>
                    </d-full-screen>
                </template>

                <template v-if="showPositionInMap.display">
                    <d-media-screen :dialogMediaScreen="showPositionInMap">

                    <template v-if="showPositionInMap.loading">     
                        <v-overlay :absolute="showPositionInMap.absolute" 
                            opacity="2" color="white" >
                            <v-progress-circular
                                indeterminate
                                size="64"
                                color="info"
                            ></v-progress-circular>
                        </v-overlay>
                    </template>
                            <iframe
                            width="100%"
                            height="450"
                            style="border:0"
                            loading="lazy"
                            allowfullscreen
                            class="mx-auto"
                            :src="srcMap">
                            </iframe>
                    </d-media-screen>
                </template>
            
              <template>
                      <v-simple-table class="mt-6" >
                          <template v-slot:default>
                          <thead>
                              <tr  class="bg-blue-custom">
                                <th v-for="column in columns" class="text-left text-white">
                                {{column.text}}
                                </th>
                              </tr>
                          </thead>
                          <tbody>
                              <tr :class="isSameID(row.id)" v-for="row in table.dataResponseDB">
                                <td>{{row.postal_code}}</td>
                                <td>{{row.locate}}</td>
                                <td>{{row.provinceInt}}</td>
                                <td>{{row.province}}</td>
                                <td>{{row.home_address}}</td>
                                <td>{{row.timeScheduleA}}</td>
                                <td>{{row.timeScheduleB}}</td>
                                <td>{{row.name_country}}</td>
                                <td >
                                        <v-chip 
                                        class="ma-2"
                                        :color="colorByType(row.type)"
                                        >
                                        {{row.type}}
                                        </v-chip>
                                    </td>
                                <td 
                                v-if="row.name_assigned && row.name_assigned !== ''  && row.name_assigned !== null && row.name_assigned !== ' ' && row.name_assigned.length"
                                >
                                    {{row.name_assigned}} - {{ row.id_user}}
                                </td>
                                <td 
                                v-else 
                                >
                                </td>

                                <td>{{row.created_at}}</td>

                                <td>
                                    <div  class="my-1 d-flex flex-row">
                                        <v-tooltip top>
                                            <template v-slot:activator="{ on, attrs }">
                                                <v-btn class="mx-1" @click="deleted(row)"  fab x-small v-bind="attrs" v-on="on" :hover="false" color="red">
                                                    <v-icon color="white">
                                                        mdi-trash-can-outline
                                                    </v-icon>
                                                </v-btn>
                                            </template>
                                            <span>Eliminar</span>
                                        </v-tooltip>
                                        <v-tooltip top>
                                            <template v-slot:activator="{ on, attrs }">
                                                <v-btn class="mx-1" @click="edit(row)"  fab  x-small v-bind="attrs" v-on="on" color="warning">
                                                    <v-icon color="white">
                                                        mdi-pencil
                                                    </v-icon>
                                                </v-btn>
                                            </template>
                                            <span>Actualizar</span>
                                        </v-tooltip>
                                    </div>
                                </td>
                                <template v-if="isItLocatable(row)">
                                    <td>
                                        <template v-if="IsItGeolocated(row)">
                                            <v-btn @click="goGoogleMaps(row)" class="mx-1" color="primary" fab x-small  >
                                                <v-icon>
                                                mdi-map-marker-multiple
                                                </v-icon>
                                            </v-btn>
                                        </template>
                                        <template v-else>
                                           <strong>Falta Geocodificar</strong>
                                        </template>
                                    </td>
                                </template>
                                <template v-else >
                                    <td>
                                    </td>
                                </template>
                              </tr>
                          </tbody>
                          </template>
                      </v-simple-table>
              </template>
          </div>
      `,
    props: ["table", "columns", "url_actions", "admin", "country_admin", "pagination"],
    data() {
        return {
            dialogFullScreen: {
                display: false,
                title: ''

            },
            updateOnly: {
                type: '',
            },
            dataDelete: {
                display: false,
                data: [],
                url: {
                    delete: API_BASE_CONTROLLER + 'coberturaController.php?cobertura=removeAndDelete'
                },

            },
            dataUpdate: {
                display: false,
                data: [],
                url: {
                    delete: API_BASE_CONTROLLER + 'coberturaController.php?cobertura=removeAndDelete',
                    hasAlreadyBeenGeocoded: API_BASE_CONTROLLER + 'coberturaController.php?cobertura=hasAlreadyCommerceBeenGeocoded'
                },
            },
            rowAltered: {
                id: '',
                action: ''
            },
            selectType: [
                { text: 'Recolector', value: 'recolector' },
                { text: 'Comercio', value: 'comercio' },
                { text: 'Correo', value: 'correo' },
                { text: 'terminal', value: 'terminal' },
            ],
            showPositionInMap: {
                display: false,
                title: '',
                src: '',
                loading: false,
                absolute: true
            },
        }
    },
    methods: {
        showDialog(item) {
            this.$emit("childrenDialog", true);

            this.$emit("childrenBodyDialogTemplate", item);
        },
        closedDialogOutSide() {
            // This closes the dialog when clicking outside of its container.
            this.$emit("childrenDialog", false);
        },
        colorByType(type) {

            if (type === 'recolector') {
                return 'success'
            }
            if (type === 'comercio') {
                return 'amber accent-3'
            }
            if (type === 'correo') {
                return 'primary'
            }
            if (type === 'terminal') {
                return 'red lighten-1'
            }
        },
        deleted(data) {
            this.dialogFullScreen.title = 'Eliminar asignado'
            this.dialogFullScreen.display = true
            this.dataDelete.data = data

            //display
            this.dataUpdate.display = false
            this.dataDelete.display = true
        },
        edit(data) {

            this.updateOnly.type = data.type

            this.dialogFullScreen.title = 'Actualizar asignado'
            this.dialogFullScreen.display = true
            this.dataUpdate.data = data

            //display
            this.dataDelete.display = false
            this.dataUpdate.display = true



        },
        $_setMessage(message) {
            this.$emit("setSnack", message)
        },
        $_setRowAltered(id) {

            this.rowAltered.id = id.id
            this.rowAltered.action = id.action
        },
        isSameID(id) {
            var style = ''
            if (this.rowAltered.action === 'update' && id === this.rowAltered.id) {
                style = 'success text-white '
                setTimeout(() => {
                    this.rowAltered.id = ''
                    this.rowAltered.action = ''
                    style = ''
                }, 2000);
                return style
            }
            if (this.rowAltered.action === 'delete' && id === this.rowAltered.id) {
                style = 'error text-white'
                setTimeout(() => {
                    const reduce = this.table.dataResponseDB.filter(item => item.id !== this.rowAltered.id)
                    this.$emit("setResponse", reduce)
                    this.$emit("subtract", -1)
                    this.rowAltered.id = ''
                    this.rowAltered.action = ''
                    style = ''
                }, 2000);
                return style
            }

        },
        returnUpperCaseFirstLetter(cadena) {
            const primerCaracter = cadena.charAt(0).toUpperCase();
            const restoDeLaCadena = cadena.substring(1, cadena.length);
            return primerCaracter.concat(restoDeLaCadena);
        },
        isItLocatable(data) {
            if (data.type === 'comercio' || data.type === 'correo' || data.type === 'terminal') {
                return true
            } else {
                return false
            }
        },
        IsItGeolocated(data) {
            if (data.lat !== '' && data.lat !== undefined && data.lng !== '' && data.lng !== undefined) {
                return true
            } else {
                return false
            }
        },
        goGoogleMaps(data) {
            this.showPositionInMap.loading = true
            this.showPositionInMap.src = 'https://www.google.com/maps/embed/v1/place?key=AIzaSyDasdhwGs_A9SbZUezcx9VhSSGkxl46bko&q=' + data.lat + ',' + data.lng;

            this.$nextTick(() => {
                this.showPositionInMap.display = true
                setTimeout(() => {
                    this.showPositionInMap.loading = false
                }, 1100);
            })

        },

    },
    computed: {
        headers() {
            return this.columns;
        },
        srcMap() {
            return this.showPositionInMap.src
        }



    },




});