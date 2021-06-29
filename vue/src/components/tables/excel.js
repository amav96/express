Vue.component('excel-export', {
    template: //html 
        `<div>
        <v-container>
            <v-btn
            class="text-white my-2"
            color="success"
            @click="exportDocument"
            :disabled="flagLoader"
            >
            <span v-if="!flagLoader" >excel</span>
            <v-icon v-if="!flagLoader" right >mdi-file-excel</v-icon>

            <v-progress-circular
            v-if="flagLoader"
            indeterminate
            color="white"
            ></v-progress-circular>

            </v-btn>
            <span v-if="flagLoader">
                <strong>Esto puedo demorar...</strong>
            </span>
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
    props: ['exportExcel'],
    data() {
        return {
            download: false,
            path: '',
            flagLoader: false,
            clickDownload: true
        }
    },
    methods: {
        async exportDocument() {
            this.flagLoader = true
            this.download = false
            const dataRequest = this.exportExcel.parameters

            const url = this.exportExcel.url
            await axios.get(url, {
                    params: {
                        dataRequest
                    }
                })
                .then(res => {
                    if (res.data.error) {
                        alertNegative("Mensaje CODIGO 54")
                        return
                    }
                    this.flagLoader = false
                    this.path = this.exportExcel.download_excel + res.data.path
                    this.download = true
                })
                .catch(err => {
                    console.log(err)
                })
        },
        donwloadFile() {
            if (this.clickDownload) {
                this.clickDownload = false;
                window.open(this.path)

                setTimeout(() => {
                    const url = this.exportExcel.delete_excel
                    axios.get(url, {
                            params: {
                                path: this.path
                            }
                        })
                        .then(res => {
                            if (res.data.error) {
                                alertNegative("Mensaje CODIGO 53");
                            }
                            this.clickDownload = true;
                            this.download = false;
                        })
                        .catch(err => {
                            console.log(err)
                        })

                }, 7000);
            }

        }
    },


})