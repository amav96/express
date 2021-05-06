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
                                    <v-col class="d-flex justify-center" cols="12" sm="6">
                                        <v-select
                                        persistent
                                        :items="sendInvoice.characteristic"
                                        v-model="characteristic"
                                        item-text="number"
                                        label="País"
                                        ></v-select>
                                    </v-col>

                                    <v-col class="d-flex" cols="12" sm="6">
                                        <v-text-field
                                        v-model="phone"
                                        :rules="rulesPhone"
                                        label="WhatsApp"
                                        ></v-text-field>
                                    </v-col>

                                    <v-col cols="12" md="12">
                                        <v-btn
                                        color="success"
                                        :disabled="!validWhatsApp"
                                        @click="sendWhatsapp"
                                        block>
                                            Enviar Whatsapp
                                            <v-icon right>
                                                mdi-whatsapp
                                            </v-icon>
                                        </v-btn>
                                    </v-col>
                            </v-row>
                                <v-row align="center">
                                   
                                        <v-col class="d-flex" cols="12" sm="6">
                                            <v-text-field
                                            v-model="email"
                                            label="Email"
                                            :rules="rulesEmail"
                                            ></v-text-field>
                                        </v-col>

                                        <v-col class="d-flex" cols="12" md="12">
                                            <v-btn
                                            color="error"
                                            block
                                            :disabled="!validEmail"
                                            @click="sendEmail"
                                            >
                                                <span v-if="!sendingEmail" >Enviar Email</span>
                                                <v-progress-circular
                                                v-else
                                                indeterminate
                                                color="white"
                                                ></v-progress-circular>

                                                <v-icon right>
                                                        mdi-gmail
                                                </v-icon>
                                            </v-btn>
                                        </v-col>
                            </v-row>
                        </v-container>
                    </v-card-text>

                    <v-card-actions>
                        <message-alert
                        :message="messageSent"
                        :alert_flag="alert_flag"
                        />
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
props:['sendInvoice','admin','country_admin','base_url_send_invoice','base_url_save_data_costumer'],
data (){
return {
    characteristic : '',
    phone : '',
    email : '',
    validWhatsApp: false,
    validEmail: false,
    sendingEmail : false,
    messageSent : '',
    alert_flag : false    
}
},
methods : {

    closeDialog(){
        this.$emit('openDialog', false)
        this.phone = ''
        this.email = ''
        this.alert_flag = false
        this.messageSent = ''
    },
    sendWhatsapp(){
    
    var urlencodedtext = '*Hola!*%20Para%20descargar%20el%20comprobante:%0a*1)*%20En%20el%20chat%20hac%C3%A9%20click%20en%20*%22a%C3%B1adir%20a%20contactos%22*,%20si%20no%20lo%20visualizas%20podes%20encontrarlo%20en%20*-%3E%20Opciones%20-%3E%20A%C3%B1adir%20a%20contactos.*%20%0a*2)*%20Hace%20click%20en%20el%20siguiente%20link.%0a'+API_BASE_URL+'equipo/remito%26cd='+ this.sendInvoice.data.remito +'%26tp=rmkcmmownloqwld';

    window.open('https://api.whatsapp.com/send?phone='+ this.characteristic + this.phone +'&text=' + urlencodedtext, '_blank');
    this.saveDataCustomer(this.sendInvoice.data,'clickWhatsApp')

    },
    sendEmail(){
        this.sendingEmail = true
        const url = this.base_url_send_invoice
        const email = this.email
        const remito = this.sendInvoice.data.remito
        var form = new FormData();
        form.append('emailDestino',email)
        form.append('codCapture',remito)
        form.append('modo', 'remitoRecupero')

        axios.post(url,form)
            .then(res => {
                if(res.data.result !== 1){
                    alertNegative("Mensaje CODIGO 50");
                    return
                }
                this.sendingEmail = false
                this.alert_flag = true
                this.messageSent = 'Enviado correctamente!'
                this.saveDataCustomer(this.sendInvoice.data,'clickEmail')
            })
            .catch(err => {
                console.log(err)
            })
        
    },
    saveDataCustomer(data,tipo){
        const url = this.base_url_save_data_costumer
        let id_user = this.admin
        let id_orden = data.remito
        let identificacion = data.identificacion
        let telefono = this.phone
        let mail = this.email
        var hoy = new Date();
            var getMinutos = hoy.getMinutes();
            var getSegundos = hoy.getSeconds();
            var getHora = hoy.getHours();
            if (getMinutos < 10) {getMinutos = "0" + hoy.getMinutes();}
            if (getSegundos < 10) {getSegundos = "0" + hoy.getSeconds();}
            if (getHora < 10) {getHora = "0" + hoy.getHours();}

            let fecha =
                hoy.getFullYear() +"-" +("0" + (hoy.getMonth() + 1)).slice(-2) +"-" +("0" + hoy.getDate()).slice(-2) +
                " " +getHora +":" +getMinutos +":" +getSegundos;
        let elemento = tipo
        var formData = new FormData;
        formData.append('id_user',id_user)
        formData.append('id_orden',id_orden)
        formData.append('identificacion',identificacion)
        formData.append('telefono',telefono)
        formData.append('mail',mail)
        formData.append('fecha',fecha)
        formData.append('elemento',elemento)
        axios.post(url,formData)
            
    }
        
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
        
        this.validEmail = false
        if(this.email !== ''){
        const validateEmail = (/^[_a-z0-9]+(\.[_a-z0-9]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,15})/i).test(this.email)
        if(validateEmail){
            this.validEmail = true
        }else {
            this.validEmail = false
            return ['Ej. rodrigo@gmail.com']
            
        }
    }
    }
}
})