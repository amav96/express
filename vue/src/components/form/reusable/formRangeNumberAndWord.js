Vue.component('form-number-and-word',{
    template : /*html*/ 
    `      
        <div>
            <v-card>
                <form 
                id="sendFormRangeNumberAndWord"
                class="d-flex justify-center flex-row align-center  flex-wrap ">
                    <v-container fluid>
                        <v-row align="center"  class="d-flex justify-center" >
                            <v-col class="d-flex justify-center" cols="12"  lg="4" md ="4" >
                            <v-text-field
                                label="Desde"
                                hide-details="auto"
                                type="text"
                                >
                            </v-text-field >
                            </v-col>

                            <v-col class="d-flex justify-center" cols="12"  lg="3" md ="4">
                                <v-text-field
                                label="Desde"
                                hide-details="auto"
                                type="text"
                            
                                >
                                </v-text-field >
                            </v-col>

                            <v-col class="d-flex justify-center" cols="12"  lg="3" md ="4">
                                <v-select
                                style="height:50px;"
                                ></v-select>
                            </v-col>

                            <v-col class="d-flex justify-center" cols="12"  lg="2" md ="2">
                                <v-btn
                                color="primary"
                                fab
                                small
                                primary
                                class="sacarOutline"
                                type="submit"
                                form="sendFormRangeNumberAndWord"
                                >
                                <v-icon>mdi-magnify</v-icon>
                                </v-btn>
                            </v-col>
                        </v-row>
                    </v-container>
                </form>
            </v-card>
        </div>
       
    `,
    props:[],
    data() {
        return {
           dateStart: '',
           dateEnd: '',
           word:'',
           items: []
        }
    },
    methods: {
    }

})