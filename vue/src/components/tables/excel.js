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
            </v-btn>
        </v-container>
    </div>
    `,
    props: ['base_url_export', 'dynamicDataToSearch', 'columnExport'],
    data() {
        return {

        }
    },
    methods: {
        exportExcel() {
            const dataRequest = this.dynamicDataToSearch
            const url = this.base_url_export
            axios.get(url, {
                params: {
                    dataRequest
                }
            })
            .then(res => {
                console.log(res)
            })
            .catch(err => {
                console.log(err)
            })


        }

    },
})