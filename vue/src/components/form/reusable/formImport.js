Vue.component('form-import', {
    template: //html 
        `<div  class="gallery-file mt-6">
            <input type="file" @change="uploadFile" ref="file" style="display: none" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel">
            <template >
            <v-row >
                <v-col @click="$refs.file.click()" class="container-select" cols="12" xl="12" lg="12" sm="12" >
                    <div class="select-file">
                        <div>
                            <v-icon>
                            mdi-file-excel-outline
                            </v-icon>
                        </div>
                        <div>
                            Leer Archivo
                        </div>
                    </div>
                </v-col>
            </v-row>
               
            </template>
        </div>
    `,
    props: ['import'],
    data() {
        return {

        }
    },
    methods: {
        uploadFile: function(event) {
            const getfile = event.target.files[0]
            if (getfile.type !== 'application/vnd.ms-excel' && getfile.type !== 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet') { alertNegative("Archivo no aceptado"); return }
            const url = this.import.upload.url
            var file = new FormData();
            file.append('file', getfile)
            axios.post(url, file, {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                })
                .then(res => {
                    console.log(res)
                })
                .catch(err => {
                    console.log(err)
                })
        }

    }
})