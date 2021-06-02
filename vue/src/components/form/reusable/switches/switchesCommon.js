Vue.component('switches-common', {
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
            <v-row class=" d-flex justify-center flex-row align-content-center align-items-center px-3" >
                    <v-col cols="4" lg="2" xs="2"   v-for="option in options" :key="option"    
                    >
                        <v-switch
                        class="mx-2"
                        v-model="optionsIn"
                        :label="option"
                        color="primary"
                        :value="option"
                        hide-details
                        ></v-switch>
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
                this.optionsIn = this.options
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