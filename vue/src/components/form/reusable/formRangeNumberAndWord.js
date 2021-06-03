Vue.component('form-number-and-word', {
    template: /*html*/ `      
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
                                    outlined
                                    dense
                                    flat
                                    >
                                </v-text-field >
                            </v-col>

                            <v-col class="d-flex justify-center" cols="12"  lg="3" md ="4">
                                <v-text-field
                                label="Desde"
                                hide-details="auto"
                                type="text"
                                outlined
                                dense
                                flat
                                >
                                </v-text-field >
                            </v-col>

                            <v-col class="d-flex justify-center" cols="12"  lg="3" md ="4">
                                <select-auto-complete-simple-id
                                @exportVal="setData($event)"
                                :title="search.title" 
                                :url="search.url"
                                />
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
    props: ['search'],
    data() {
        return {
            dateStart: '',
            dateEnd: '',
            word: '',
            items: []
        }
    },
    methods: {
        setData(data) {
            console.log(data)
        }
    }


})