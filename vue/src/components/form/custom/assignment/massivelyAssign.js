Vue.component('massively-assign', {
    template: //html 
        `
        <div >
            <v-row class="d-flex justify-start flex-column my-0" >
                <div>
                    <v-btn color="warning">
                    Asignar masivamente
                        <v-icon light>
                        mdi-flash
                        </v-icon>
                    </v-btn>
                </div>
                <div class="my-2 mx-2" >
                Desde
                        <v-chip color="success">
                            {{resources.parametersDynamicToPaginate.start}}
                        </v-chip>
                Hasta
                        <v-chip color="success">
                        {{resources.parametersDynamicToPaginate.end}}
                        </v-chip>
                </div>
            </v-row>
        </div>
        `,
    props: ['resources'],
    data() {
        return {

        }
    },
    methods: {

    }
})