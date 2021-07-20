<script>

   

    const test = [
        {codigo:'1'},
        {codigo:'2'},
        {codigo:'3'},
        {codigo:'3'},
        {codigo:'4'},
        {codigo:'4'},
        {codigo:'4'},
        {codigo:'4'},
        {codigo:'4'},
        {codigo:'4'},
    ]


function groupBy(list, keyGetter) {
    const map = new Map();
    list.forEach((item) => {
         const key = keyGetter(item);
         const collection = map.get(key);
         if (!collection) {
             map.set(key, [item]);
         } else {
             collection.push(item);
         }
    });
    return map;
}

    
const grouped = groupBy(test, test => test.codigo);
var uniques = []
console.log(grouped)

grouped.forEach((val)=>{
    uniques.push(val[0].codigo)
   
})
console.log(uniques)


// console.log(grouped)

// console.log(test)


</script>