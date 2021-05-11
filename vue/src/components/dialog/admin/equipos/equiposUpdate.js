Vue.component('dialog-equipos-update',{
template : //html 
    `
            <v-dialog
            v-model="dialogUpdate"
            max-width="500px"
            @click:outside="onClickOutside"
            >
            <v-card>
                <v-card-title>
                    <span class="headline">{{title}}</span>
                </v-card-title>

                    <v-card-text>
                        <v-container>
                        <v-row>
                            <v-col
                            cols="12"
                            sm="6"
                            md="4"
                            >
                            <v-select
                            v-model="editedItem.estado"
                            :items="status"
                            item-text="estado"
                            label="Estados"
                            ></v-select>
                            </v-col>
                            <v-col
                            cols="12"
                            sm="6"
                            md="4"
                            >
                            <v-text-field
                            v-model="editedItem.serie"
                            label="Serie"
                            ></v-text-field>
                            </v-col>
                            <v-col
                            cols="12"
                            sm="6"
                            md="4"
                            >
                            <v-text-field
                            v-model="editedItem.terminal"
                            label="Terminal"
                            ></v-text-field>
                            </v-col>
                            <v-col
                            cols="12"
                            sm="6"
                            md="4"
                            >
                            <v-text-field
                            v-model="editedItem.tarjeta"
                            label="Terminal"
                            ></v-text-field>
                            </v-col>
                            <v-col
                            cols="12"
                            sm="6"
                            md="4"
                            >
                            <v-select
                            v-model="editedItem.accesorio_uno"
                            :items="accesorios"
                            item-text="accesorios"
                            label="HDMI/C.Tlf"
                            ></v-select>
                            </v-col>

                            <v-col
                            cols="12"
                            sm="6"
                            md="4"
                            >
                            <v-select
                            v-model="editedItem.accesorio_dos"
                            :items="accesorios"
                            item-text="accesorios"
                            label="AV/SIM"
                            ></v-select>
                            </v-col>

                            <v-col
                            cols="12"
                            sm="6"
                            md="4"
                            >
                            <v-select
                            v-model="editedItem.accesorio_tres"
                            :items="accesorios"
                            item-text="accesorios"
                            label="Fuente/Cargador"
                            ></v-select>
                            </v-col>
                            <v-col
                            cols="12"
                            sm="6"
                            md="4"
                            >
                            <v-select
                            v-model="editedItem.accesorio_cuatro"
                            :items="accesorios"
                            item-text="accesorios"
                            label="Control/Base"
                            ></v-select>
                            </v-col>

                           
                        </v-row>
                        </v-container>
                        
                    </v-card-text>
            <v-card-actions>
                <message-alert
                :message="message"
                :alert_flag="alert_flag"
                />
                <v-spacer></v-spacer>
                <v-btn
                color="error"
                @click="closeDialog"
                >
                Salir
                </v-btn>
                <v-btn
                color="primary"
                @click="update"
                :disabled="updateProperty.disabled"
                >
                Guardar Cambios
                </v-btn>
            </v-card-actions>
            </v-card>
               
        </v-dialog>
    `,
    props:['dialogUpdate','title','editedItem','status','accesorios','message','alert_flag','updateProperty'],
data (){
return {
    downInner : false,
}
},
methods : {
    onClickOutside(){
         // I close the dialog by clicking outside of its container. In the current child component
         if (this.downInner === false) {
            this.$emit('openDialog', false)
            if(this.alert_flag){
                this.$emit('message', '')
                this.$emit('alert_flag', false)
            }
          }
          this.downInner = false;
    },
    closeDialog(){
        this.$emit('openDialog', false)
        if(this.alert_flag){
            this.$emit('message', '')
            this.$emit('alert_flag', false)
        }
    },
    update(){
        this.$emit("setDisabled",true)
        this.$emit('updateRow')
    },
   
    
},

})