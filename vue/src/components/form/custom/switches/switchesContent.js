Vue.component('switches-content', {
    template: //html 
        `<div>
    
        <v-row class=" d-flex justify-center flex-row align-content-center align-items-center px-3">
            <v-btn
            class="mx-2"
            fab
            small
            color="primary"
            @click="selectAll"
            >
                <v-icon v-if="!all">
                    mdi-vector-selection
                </v-icon>
                <v-icon v-else>
                    mdi-selection-off
                </v-icon>
            </v-btn>
    
        </v-row>  
                <v-row class="ml-1 d-flex justify-center flex-row" >
                    <v-col cols="12" lg="3" sm="6" xs="12"  v-for="(item,key) in options" :key="key" >
                        <v-card v-if="!item.repeat" >
                            <v-card-title class="text-sm-body-2 py-1" >
                                <strong>CP : </strong> &nbsp;{{item.postal_code}}
                            </v-card-title>
                            <v-card-title class="text-sm-body-2 py-1">
                                {{item.locate}}
                            </v-card-title>
                            <v-card-title class="text-sm-body-2 py-1">
                                <strong> Nombre: </strong> &nbsp; {{item.name}}
                            </v-card-title>
                            <v-card-title class="text-sm-body-2 py-1">
                                <strong> Tipo: </strong> &nbsp; {{type(item.type)}}
                            </v-card-title>
                            <div class="blue-grey lighten-5" >
                                <v-switch
                                class="ml-1"
                                v-model="optionsIn"
                                color="primary"
                                :value="item.id"
                                hide-details
                                ></v-switch>
                            </div>
                        </v-card>
                        <v-card v-else  >
                            <v-card-title class="text-sm-body-2 py-1 " >
                                <strong>CP : </strong> &nbsp;{{item.postal_code}}
                            </v-card-title>
                            <v-card-title class="text-sm-body-2 py-1 ">
                                {{item.locate}}
                            </v-card-title>
                            <v-card-title class="text-sm-body-2 py-1 ">
                                <strong> Nombre: </strong> &nbsp; {{item.name}}
                            </v-card-title>
                            <v-card-title class="text-sm-body-2 py-1 ">
                                <strong> Tipo: </strong> &nbsp; {{type(item.type)}}
                            </v-card-title>
                            <v-alert 
                            class="mt-2"
                            border="right"
                            colored-border
                            type="info"
                            elevation="4"
                            >
                                Si desea reemplazar este CP haga <strong> clic </strong>
                                <v-btn 
                                @click="deleteOne(item.id)"
                                color="info"
                                fab
                                small
                                >
                                    <v-icon >
                                    mdi-arrow-up-bold-circle
                                    </v-icon>
                                </v-btn>
                            </v-alert>
                           
                        </v-card>

                       
                    </v-col>
                </v-row>
                
         </div>
        `,
    props: {
        options: {
            type: Array
        },
    },
    data() {
        return {
            optionsIn: [],
            all: false
        }
    },
    methods: {
        clearOptions() {
            this.optionsIn = []
        },
        selectAll() {
            if (!this.all) {

                this.options.forEach((val) => {
                    this.optionsIn.push(val.id)
                })
                this.all = true
            } else {
                this.optionsIn = []
                this.all = false
            }
        },
        type(type) {
            if (type === 'collector') {
                return 'Recolector'
            }
            if (type === 'commerce') {
                return 'Comercio'
            }
            if (type === 'mail') {
                return 'Correo'
            }
            if (type === 'station') {
                return 'Terminal'
            }
        },
        deleteOne(id) {
            this.$emit("selectZoneCache", this.optionsIn)
            this.$emit('deleteOne', id)
        },
        setCache(cache) {
            this.optionsIn = cache
        }
    },
    watch: {
        optionsIn(val) {

            this.$emit('setOptions', val);
        },
        options(val) {
            this.clearOptions()
        }
    }
})