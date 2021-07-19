<script>

   

    const test = [
        {codigo:'1'},
        {codigo:'2'},
        {codigo:'3'},
        {codigo:'3'},
        {codigo:'4'},
    ]
    var prueba = []

function testt(data){
    data.forEach((val) =>{
        if(data.find(element => element.codigo === element.codigo)){
        prueba.push(val)
    }

    })
    
    
    

}

testt(test)
console.log(prueba)
</script>