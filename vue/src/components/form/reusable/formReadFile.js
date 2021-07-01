Vue.component('form-read-file', {
    template: //html 
        `<div  class="gallery-file mt-6">
            <input type="file" @click="resetEvent" @change="uploadFile" ref="file" style="display: none" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel">
      
            <template v-if="tooltip.display">
                <v-tooltip bottom>
                    <template v-slot:activator="{ on, attrs }">
                        <v-btn
                        color="primary"
                        fab
                        x-small
                        v-bind="attrs"
                        v-on="on"
                        >
                        <v-icon>
                            mdi-alert-circle-outline
                        </v-icon>
                        </v-btn>
                    </template>
                <span>{{tooltip.text}}</span>
                </v-tooltip>
            </template>
            <v-row class="d-flex justify-center flex-column my-2">
                <v-col @click="$refs.file.click()" class="container-select" cols="12" xl="12" lg="12" sm="12" >
                    <div class="select-file">
                        <template v-if="!uploadLoading">
                                <div>
                                    <v-icon>
                                    mdi-file-excel-outline
                                    </v-icon>
                                </div>
                                <div>
                                    Leer Archivo
                                </div>
                        </template>
                        <template v-else>
                        <div class="d-flex justify-center aling-content-center align-items-center flex-column">
                            <div>
                                <v-progress-circular
                                class="my-3"
                                indeterminate
                                color="info"
                                ></v-progress-circular>
                            </div>
                        </div>
                           
                        </template>
                    </div>
                </v-col>
                <template v-if="download">
                    <v-col class="d-flex justify-center"  cols="12" xl="12" lg="12" sm="12" >
                        <v-btn 
                        class="mx-auto"
                        color="error"
                        @click="showFile()"
                        :disabled="loadingDownload"
                        >
                        <template v-if="loadingDownload">
                            <div>
                                <v-progress-circular
                                class="my-3"
                                indeterminate
                                color="info"
                                ></v-progress-circular>
                            </div>
                        </template>
                        <template v-else>
                            Descargar 
                        </template>
                        </v-btn>
                    </v-col>
                </template>
                
            </v-row>
            
        </div>
    `,
    props: ['importData', 'tooltip'],
    data() {
        return {
            uploadLoading: false,
            path: '',
            fileName: '',
            download: false,
            loadingDownload: false
        }
    },
    methods: {
        uploadFile: function(event) {
            this.$emit("setResponseImport", [])
            if (event.target.files[0] !== undefined && event.target.files[0] !== '') {
                this.resetDownload()
                this.cleanError();

                this.uploadLoading = true
                const getfile = event.target.files[0]
                if (getfile.type !== 'application/vnd.ms-excel' && getfile.type !== 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet') { alertNegative("Archivo no aceptado"); return }
                const url = this.importData.upload.url
                var file = new FormData();
                file.append('file', getfile)
                axios.post(url, file, {
                        headers: {
                            'Content-Type': 'multipart/form-data'
                        }
                    })
                    .then(res => {
                        this.uploadLoading = false
                        if (res.data.error) {
                            this.setError(res)
                            return
                        }
                        this.path = this.importData.downloadFile.url + res.data.path
                        this.fileName = res.data.fileName
                        this.download = true
                        this.$emit("setResponseImport", res.data)
                    })
                    .catch(err => {
                        console.log(err)
                    })
            }

        },
        showFile() {
            // window.open(this.path)
            this.loadingDownload = true
            axios({
                url: this.path,
                method: 'GET',
                responseType: 'blob',
            }).then((response) => {
                this.loadingDownload = false
                var fileURL = window.URL.createObjectURL(new Blob([response.data]));
                var fileLink = document.createElement('a');

                fileLink.href = fileURL;
                fileLink.setAttribute('download', this.fileName + '.pdf');
                document.body.appendChild(fileLink);

                fileLink.click();

                setTimeout(() => {
                    const url = this.importData.delete.url
                    axios.get(url, { params: { path: this.path } })
                        .then(res => {
                            if (res.data.error) { alertNegative("Mensaje CODIGO 53"); }
                            this.resetDownload()
                        })
                        .catch(err => { console.log(err) })
                }, 5000);

            });
        },
        resetDownload() {
            this.path = ''
            this.fileName = ''
            this.download = false

        },
        setError(res) {

            if (res.data.error) {
                const error = {
                    display: true,
                    text: res.data.error
                }
                this.$emit("setError", error)
            } else {
                const error = {
                    display: false,
                    text: ''
                }
                this.$emit("setError", error)
            }

        },
        cleanError() {
            const error = {
                display: false,
                text: ''
            }
            this.$emit("setError", error)
        },
        resetEvent() {
            this.$refs.file.value = ''
        }

    }
})