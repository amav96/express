Vue.component('excel-export', {
    template: //html 
        `<div>
        <v-container>
            <v-btn
            class="text-white my-2"
            color="success"
            @click="exportExcel"
            >
            excel
            <v-icon right >mdi-file-excel</v-icon>
            </v-btn>
            <v-progress-circular
            v-if="flagLoader"
            indeterminate
            color="primary"
            ></v-progress-circular>
            <v-btn
            v-if="download"
            color="error"
            class="text-white my-2"
            @click="donwloadFile"
            >
           
            Descargar
            <v-icon right >mdi-download</v-icon>
            </v-btn>
        </v-container>
    </div>
    `,
    props: ['dynamicDataToSearch','url_actions'],
    data() {
        return {
            download : false,
            path : '',
            flagLoader : false,
            clickDownload : true
        }
    },
    methods: {
        exportExcel() {
            this.flagLoader = true
            const dataRequest = this.dynamicDataToSearch
            
            const url = this.url_actions.export
            axios.get(url, {
                params: {
                    dataRequest
                }
            })
            .then(res => {
                if(!res.data.result){
                    alertNegative("Mensaje CODIGO 54")
                    return
                }
                    this.flagLoader = false
                    this.path = this.url_actions.download_excel+res.data.path
                    this.download = true
            })
            .catch(err => {
                console.log(err)
            })
        },
        donwloadFile(){
            if(this.clickDownload){
               this.clickDownload = false;
               window.open(this.path)

            setTimeout(() => {
                const url = this.url_actions.delete_excel
                axios.get(url,{
                    params:{
                        path : this.path
                    }
                })
                .then(res => {
                    if(!res.data.result){
                        alertNegative("Mensaje CODIGO 53");
                    }
                    this.clickDownload = true;
                    this.download = false;
                })
                .catch(err => {
                    console.log(err)
                })
                
            }, 10000);
        }
            
        }
    },
    watch : {
        dynamicDataToSearch(){
            this.download = false
        }
    }
   
})