<script>

const codigo_postal_2001 = [
    {id:'7'},
    {id:'10'},
    {id:'1000'},
]


var cantidad = codigo_postal_2001.length

var totalZona = 99
var zonaDividida = Math.ceil(totalZona/cantidad)
var recolectores_disponibles = []
var construir;
var zonaActual;
var zonaInicio;
var ini = 0;
var iniSiguiente;
var finSiguiente;
var fin;
var count = 1
var countAux = 0
const generarRecolectores = codigo_postal_2001.map((val,index)=> {
  
    zonaActual = (zonaDividida *count)
    iniSiguiente = (zonaDividida *countAux)
    
    if(index<1){
    ini
    fin = zonaDividida
    iniSiguiente = zonaDividida * count 
    construir = {id: val.id,ini,fin}
    recolectores_disponibles.push(construir)

    }else{
    ini =  iniSiguiente + 1
        if(zonaActual >= 100){
            fin = zonaActual - 1
        }else {
            fin = zonaActual
        }

        construir = {id: val.id,ini,fin}
        recolectores_disponibles.push(construir)
    }

    count ++
    countAux ++ 
})
console.log(recolectores_disponibles)
// console.log(Math.ceil(totalZona/cantidad))





</script>