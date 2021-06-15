Vue.component('time-schedule', {
    template: //html 
        `
        <div>
            <h6 class="ml-4 my-3 "> Dias Hábiles</h6>
            <v-row class="d-flex flex-row justify-start " >
                <v-col   cols="12" xl="4" lg="4" md="6" sm="6" xs="4"  >
                    <v-select 
                    v-model="dayOpen"
                    label="Dia Abre"
                    :items="businessDays"
                    item-text="day"
                    item-value="value"
                    outlined
                    dense
                    required
                    type="time"
                    color="black"
                    class="info--text mx-4 "
                    >
                    </v-select>
                </v-col>
                <v-col  cols="12" xl="4" lg="4" md="6" sm="6" xs="4"  >
                    <v-select
                    v-model="dayClose" 
                    label="Dia Cierra"
                    :items="businessDays"
                    item-text="day"
                    item-value="value"
                    outlined
                    dense
                    required
                    type="time"
                    color="black"
                    class="info--text mx-4"
                    >
                    </v-select>
                </v-col>
            </v-row>
            <v-row class="d-flex flex-row justify-start  " >
                <v-col  cols="12" xl="4" lg="4" md="6" sm="6" xs="4"  >
                    <v-text-field
                    v-model="hoursOpen"  
                    label="Hora Abre"
                    outlined
                    dense
                    required
                    type="time"
                    color="black"
                    class="info--text mx-4"
                    >
                    </v-text-field>
                </v-col>
                <v-col  cols="12" xl="4" lg="4" md="6" sm="6" xs="4"  >
                    <v-text-field 
                    v-model="hoursClose"  
                    label="Hora Cierra"
                    outlined
                    dense
                    required
                    type="time"
                    color="black"
                    class="info--text mx-4"
                    >
                    </v-text-field>
                </v-col>
            </v-row>
            
            <h6 class="ml-4 my-3 "> Sabado (Opcional)</h6>
            <v-row class="d-flex flex-row justify-start  " >
                <v-col  cols="12" xl="4" lg="4" md="6" sm="6" xs="4"  >
                    <v-text-field 
                    v-model="saturdayHoursOpen"  
                    label="Hora Abre"
                    outlined
                    dense
                    required
                    type="time"
                    color="black"
                    class="info--text mx-4"
                    >
                    </v-text-field>
                </v-col>
                <v-col  cols="12" xl="4" lg="4" md="6" sm="6" xs="4"  >
                    <v-text-field 
                    v-model="saturdayHoursClose"  
                    label="Hora Cierra"
                    outlined
                    dense
                    required
                    type="time"
                    color="black"
                    class="info--text mx-4"
                    >
                    </v-text-field>
                </v-col>
            </v-row>
            <h6 class="ml-4 my-3 "> Domingo (Opcional)</h6>
            <v-row class="d-flex flex-row justify-start  " >
                <v-col  cols="12" xl="4" lg="4" md="6" sm="6" xs="4"  >
                    <v-text-field 
                    v-model="sundayHoursOpen"  
                    label="Hora Abre"
                    outlined
                    dense
                    required
                    type="time"
                    color="black"
                    class="info--text mx-4"
                    >
                    </v-text-field>
                </v-col>
                <v-col  cols="12" xl="4" lg="4" md="6" sm="6" xs="4"  >
                    <v-text-field 
                    v-model="sundayHoursClose"  
                    label="Hora Cierra"
                    outlined
                    dense
                    required
                    type="time"
                    color="black"
                    class="info--text mx-4"
                    >
                    </v-text-field>
                </v-col>
            </v-row>
        </div>
    `,
    data() {
        return {
            dayOpen: '',
            dayClose: '',
            hoursOpen: '',
            hoursClose: '',
            saturdayHoursOpen: '',
            saturdayHoursClose: '',
            sundayHoursOpen: '',
            sundayHoursClose: '',
            timeSchedule: '',
            businessDays: [
                { day: 'Lunes', value: 'LUNES' },
                { day: 'Martes', value: 'MARTES' },
                { day: 'Miercoles', value: 'MIERCOLES' },
                { day: 'Jueves', value: 'JUEVES' },
                { day: 'Viernes', value: 'VIERNES' },
            ],
            Weekend: [
                { day: 'Sabado', value: 'SABADO' },
                { day: 'Domingo', value: 'DOMINGO' },
            ]
        }
    },
    methods: {
        setTimeSchedule() {
            this.timeSchedule = this.dayOpen + ' ' + '-' + ' ' + this.dayClose + ' ' + this.hoursOpen + ' ' + '-' + ' ' + this.hoursClose;

            if (this.saturdayHoursOpen !== '' && this.saturdayHoursClose !== '') {
                this.timeSchedule = this.dayOpen + ' ' + '-' + ' ' + this.dayClose + ' ' + this.hoursOpen + ' ' + '-' + ' ' + this.hoursClose + ' ' + 'SABADO' + ' ' + this.saturdayHoursOpen + ' ' + '-' + ' ' + this.saturdayHoursClose;
            }

            if (this.sundayHoursOpen !== '' && this.sundayHoursClose !== '') {
                if (this.saturdayHoursOpen !== '' && this.saturdayHoursClose !== '') {
                    this.timeSchedule = this.dayOpen + ' ' + '-' + ' ' + this.dayClose + ' ' + this.hoursOpen + ' ' + '-' + ' ' + this.hoursClose + ' ' + 'SABADO' + ' ' + this.saturdayHoursOpen + ' ' + '-' + ' ' + this.saturdayHoursClose + ' ' + 'DOMINGO' + ' ' + this.sundayHoursOpen + ' ' + '-' + ' ' + this.sundayHoursClose;
                } else {
                    this.timeSchedule = this.dayOpen + ' ' + '-' + ' ' + this.dayClose + ' ' + this.hoursOpen + ' ' + '-' + ' ' + this.hoursClose + ' ' + 'DOMINGO' + ' ' + this.sundayHoursOpen + ' ' + '-' + ' ' + this.sundayHoursClose;
                }

            }

            this.$emit("setTimeSchedule", this.timeSchedule)
        },
        $reset() {
            this.dayOpen = ''
            this.dayClose = ''
            this.hoursOpen = ''
            this.hoursClose = ''
            this.saturdayHoursOpen = ''
            this.saturdayHoursClose = ''
            this.sundayHoursOpen = ''
            this.sundayHoursClose = ''
            this.timeSchedule = ''
        }
    },
    watch: {
        dayOpen() {
            this.setTimeSchedule()
        },
        dayClose() {
            this.setTimeSchedule()
        },
        hoursOpen() {
            this.setTimeSchedule()
        },
        hoursClose() {
            this.setTimeSchedule()
        },
        saturdayHoursOpen() {
            this.setTimeSchedule()
        },
        saturdayHoursClose() {
            this.setTimeSchedule()
        },
        sundayHoursOpen() {
            this.setTimeSchedule()
        },
        sundayHoursClose() {
            this.setTimeSchedule()
        }

    }
})