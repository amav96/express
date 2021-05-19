Vue.component('dialog-choose-next',{
template : //html 
    `
    <div>
        <template>
            <v-row justify="center">
                <v-dialog
                    v-model="dialogChoose.chooseNext.display"
                    persistent
                    max-width="290"
                >
                    <v-card>
                        <v-card-title class="headline">
                        {{dialogChoose.chooseNext.title}}
                        </v-card-title>
                            <v-card-text>
                                <v-radio-group
                                    v-model="dialogChoose.chooseNext.chosenOption"
                                    column
                                >
                                    <v-radio
                                    v-for="items in dialogChoose.chooseNext.options"
                                    :key="items.text"
                                    :label="items.text"
                                    :value="items.value"
                                    ></v-radio>

                                </v-radio-group>
                            </v-card-text>
                        <v-card-actions>
                            <v-spacer></v-spacer>
                            <v-btn
                            color="error"
                            @click="back()"
                            >
                            Salir
                            </v-btn>
                            <v-btn
                            color="primary"
                            :disabled="dialogChoose.chooseNext.chosenOption === ''"
                            @click="next()"
                            >
                            Continuar
                            </v-btn>
                        </v-card-actions>
                    </v-card>
                </v-dialog>
            </v-row>
        </template>
    </div>
    
    `,
props:['dialogChoose'],
data (){
return {

}
},
methods : {
        next(){
            this.$emit('next');
        },
        back(){
            this.dialogChoose.chooseNext.display = false
            this.$emit('back');
        }
}
})