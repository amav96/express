Vue.component('VueExcelXlsx',{
    template : /* html*/
    `
    <button @click="exportExcel">
        <slot></slot>
    </button>
    `,
    props: {
        columnExport: {
            type: Array,
            default: []
        },
        data: {
            type: Array,
            default: []
        },
        filename: {
            type: String,
            default: 'excel'
        },
        sheetname: {
            type: String,
            default: 'SheetName'
        }
    },

    methods: {
        exportExcel() {
           
            let createXLSLFormatObj = [];
            let newXlsHeader = [];
            let vm = this;
           
            if (vm.columnExport.length === 0){
                console.log("Add columns!");
                return;
            }
            if (vm.data.length === 0){
                console.log("Add data!");
                return;
            }

            // JQUERY
            //  $.each(vm.columns, function(index, value) {
            //     //  newXlsHeader.push(value.label);
            //  });

            // $.each(vm.data, function(index, value) {

            //     let innerRowData = [];
            //     $.each(vm.columns, function(index, val) {
            //         if (val.dataFormat && typeof val.dataFormat === 'function') {
            //             innerRowData.push(val.dataFormat(value[val.field]));
            //         }else {
            //             innerRowData.push(value[val.field]);
            //         }
            //     });
            //     createXLSLFormatObj.push(innerRowData);
            
               
            // });
             vm.columnExport.forEach((value) =>{
                 newXlsHeader.push(value.label)
             })
             
            createXLSLFormatObj.push(newXlsHeader);
           
            

             vm.data.forEach((value) => {
               
                  let innerRowData = [];

                  vm.columnExport.forEach((val)=>{
                          
                    if (val.dataFormat && typeof val.dataFormat === 'function') {
                        innerRowData.push(val.dataFormat(value[val.field]));
                    }else {
                        innerRowData.push(value[val.field]);
                    }
            
                  })     
                //   console.log(innerRowData)     
                  createXLSLFormatObj.push(innerRowData);
             })

             
            //  console.log(createXLSLFormatObj)
            // return
            
            // para excel nuevos
            // let filename = vm.filename + ".xlsx";
            // para excel viejos 
            let filename = vm.filename + ".xls";
            let ws_name = vm.sheetname;

            let wb = XLSX.utils.book_new(),
                ws = XLSX.utils.aoa_to_sheet(createXLSLFormatObj);

                
            XLSX.utils.book_append_sheet(wb, ws, ws_name);

            XLSX.writeFile(wb, filename);
            console.log(wb)
                return

            
        }
    }

})
