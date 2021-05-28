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
                    <v-col cols="12" lg="3" sm="3" v-for="(item,key) in options" :key="key" >
                        <v-card >
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
                                <strong> Tipo: </strong> &nbsp; {{item.type}}
                            </v-card-title>
                            <div class="blue-grey lighten-5" >
                                <v-switch
                                class="ml-1"
                                v-model="optionsIn"
                                color="primary"
                                :value="item.value"
                                hide-details
                                ></v-switch>
                            </div>
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
                    this.optionsIn.push(val.value)
                })
                this.all = true
            } else {
                this.optionsIn = []
                this.all = false
            }
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