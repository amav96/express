Vue.component('dialog-send-invoice',{
template : //html 
    `
       
            <div>
                <v-dialog
                v-model="sendInvoice.dialog"
                persistent
                max-width="500px"
                
                >
                    <v-card>
                    <v-card-title class="headline" >
                        <h4>{{sendInvoice.title}}</h4>
                    </v-card-title>

                    <v-card-text>
                        <v-container fluid >
                            <v-row align="center"  class="d-flex justify-center" >
                                    <v-col
                                    class="d-flex justify-center"
                                    cols="12"
                                    sm="6"
                                    >
                                        <v-select
                                        persistent
                                        :items="sendInvoice.characteristic"
                                        v-model="characteristic"
                                        item-text="number"
                                        label="País"
                                        ></v-select>
                                    </v-col>

                                    <v-col
                                    class="d-flex"
                                    cols="12"
                                    sm="6"
                                    >
                                        <v-text-field
                                        v-model="phone"
                                        :rules="rulesPhone"
                                        label="WhatsApp"
                                        ></v-text-field>
                                    </v-col>

                                    <v-col
                                    cols="12"
                                    md="12"
                                    >
                                        <v-btn
                                        color="success"
                                        :disabled="characteristic === '' || phone === '' || !validWhatsApp"
                                        block>
                                            Enviar Whatsapp
                                            <v-icon right>
                                                mdi-whatsapp
                                            </v-icon>
                                        </v-btn>
                                    </v-col>
                            </v-row>
                                <v-row align="center">
                                   
                                        <v-col
                                        class="d-flex"
                                        cols="12"
                                        sm="6"
                                        >
                                            <v-text-field
                                            v-model="email"
                                            label="Email"
                                            ></v-text-field>
                                        </v-col>

                                        <v-col
                                        class="d-flex"
                                        cols="12"
                                        md="12"
                                        >
                                            <v-btn
                                            color="error"
                                            block>
                                            Enviar Email
                                                <v-icon right>
                                                        mdi-gmail
                                                </v-icon>
                                            </v-btn>
                                        </v-col>
                            </v-row>
                        </v-container>
                    </v-card-text>

                    <v-card-actions>
                        <v-spacer></v-spacer>
                        <v-btn
                        color="error"
                        @click="closeDialog"
                        >
                        Salir
                        </v-btn>
                    </v-card-actions>
                    </v-card>
            </v-dialog>
           
        </div>
    `,
props:['sendInvoice','admin','country_admin'],
data (){
return {
    characteristic : '',
    phone : '',
    email : '',
    validWhatsApp: false,
    validEmail: false,
        
}
},
methods : {

    closeDialog(){
        this.$emit('openDialog', false)
    },
        
},
computed : {
    rulesPhone(){
        let lengthUruguay = 8
        let lengthArgentina = 10
        let pais = this.characteristic
        
        if(pais === '+54'){
            if(this.phone.length !== lengthArgentina){
                this.validWhatsApp = false
                return ['Ej. 11 3138 4598']
            }else {
                this.validWhatsApp = true
            }
        }
        if(pais === '+598'){
            if(this.phone.length !== lengthUruguay){
                this.validWhatsApp = false
                return ['Ej. 97 924 409']
            }else {
                this.validWhatsApp = true
            }
        }
        // return message
    },
    rulesEmail(){
        const validateEmail = (/^[_a-z0-9]+(\.[_a-z0-9]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,15})/i).test(this.email)
        console.log(validateEmail)
    }
}
})