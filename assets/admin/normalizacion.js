//importar base original 

$(document).on('click','#importarBO',function(){
    
  $("#importarBaseOriginal").modal("show");
  $("#botonImportarBO").hide();
})


$("#clave").keyup(function () {
  delay(function () {
  
    const objectKey = {
      key:$("#clave").val()
    }
    validateKey(objectKey);

  }, 800);
});

function validateKey(object){

  $.ajax({
  url:'../controllers/normalizacionController.php?normalizacion=validateKey',
  type:'POST',
  data:{object},
  beforeSend:function(){
    $("#ContloaderImportarBase").append('<div id="loaderImportarBase" class="spinner-border" role="status"><span class="sr-only">Loading...</span></div>');
  },
  }).done(function(response){
    $("#loaderImportarBase").remove();
    
     var key = JSON.parse(response)
     if(key.result === '1'){
      $("#botonImportarBO").show();
     }else{
      alertNegative('Clave incorrecta');
      $("#botonImportarBO").hide();
     }
    
  })
}

//PRIMER INGRESO LIMPIAR TELEFONOS 
  
    $("#importar").click(function(){
          $("#abrirParaImportar").modal("show")
          getEmpresas("#empresaLimpiar")
      
    })

    $("#mostrarDatosLimpiar").click(function(){
        $("#abrirModalMostrarDatosTablaLimpiar").modal("show")


        $.ajax({
          url:"../../control/admin/C_normalizacion.php?action=mostrarEmpresas",
          type:"GET",
          success: function(response){
            var reciboEmpresas = JSON.parse(response)
            var templateSelectEmpresa = "";
            reciboEmpresas.forEach((recorroEmpresas) =>{
              templateSelectEmpresa +=`
              <option value="${recorroEmpresas.empresa}"> ${recorroEmpresas.empresa}</option>
              `;
            })
            $("#empresaBuscarLimpiador").html(templateSelectEmpresa)
          }
        })

    })

    // fin panel limpiador----


    // panel ordenador
    $("#importarOrdenador").click(function(){
    
        $("#abrirImportarOrdenador").modal("show")

        $.ajax({
          url:"../../control/admin/C_normalizacion.php?action=mostrarEmpresas",
          type:"GET",
          success: function(response){
            var reciboEmpresas = JSON.parse(response)
            var templateSelectEmpresa = "";
            reciboEmpresas.forEach((recorroEmpresas) =>{
              templateSelectEmpresa +=`
              <option value="${recorroEmpresas.empresa}"> ${recorroEmpresas.empresa}</option>
              `;
            })
            $("#empresaOrdenar").html(templateSelectEmpresa)
          }
        })

    })


    $("#mostrarDatosOrdenador").click(function(){
        $("#abrirModalMostrarDatosTablaOrdenar").modal("show")

        $.ajax({
          url:"../../control/admin/C_normalizacion.php?action=mostrarEmpresas",
          type:"GET",
          success: function(response){
            var reciboEmpresas = JSON.parse(response)
            var templateSelectEmpresa = "";
            reciboEmpresas.forEach((recorroEmpresas) =>{
              templateSelectEmpresa +=`
              <option value="${recorroEmpresas.empresa}"> ${recorroEmpresas.empresa}</option>
              `;
            })
            $("#empresaBuscarOrdenador").html(templateSelectEmpresa)
          }
        })

    })


    
    // fin panel ordenador


//panel validador

$("#importarValidador").click(function(){

  $("#abrirParaImportarValidador").modal("show")

  $.ajax({
    url:"../../control/admin/C_normalizacion.php?action=mostrarEmpresas",
    type:"GET",
    success: function(response){
      var reciboEmpresas = JSON.parse(response)
      var templateSelectEmpresa = "";
      reciboEmpresas.forEach((recorroEmpresas) =>{
        templateSelectEmpresa +=`
        <option value="${recorroEmpresas.empresa}"> ${recorroEmpresas.empresa}</option>
        `;
      })
      $("#empresaValidar").html(templateSelectEmpresa)
    }
  })

})



$("#mostrarDatosValidador").click(function(){

$("#abrirModalMostrarDatosTablaValidar").modal("show")

$.ajax({
  url:"../../control/admin/C_normalizacion.php?action=mostrarEmpresas",
  type:"GET",
  success: function(response){
    var reciboEmpresas = JSON.parse(response)
    var templateSelectEmpresa = "";
    reciboEmpresas.forEach((recorroEmpresas) =>{
      templateSelectEmpresa +=`
      <option value="${recorroEmpresas.empresa}"> ${recorroEmpresas.empresa}</option>
      `;
    })
    $("#empresaBuscarValidar").html(templateSelectEmpresa)
  }
})

})
     

    //final panel validador







    // panel limpiar validados


$("#importarLimpiarValidados").click(function(){

  $("#abrirImportarLimpiarValidados").modal("show")

})


    

    $("#mostrarDatosValidadosFinal").click(function(){
     
        $("#abrirModalMostrarFinal").modal("show")

         $.ajax({
           url:"../../control/admin/C_normalizacion.php?action=mostrarEmpresas",
           type:"GET",
           success: function(response){
             var reciboEmpresas = JSON.parse(response)
             var templateSelectEmpresa = "";
             reciboEmpresas.forEach((recorroEmpresas) =>{
               templateSelectEmpresa +=`
               <option value="${recorroEmpresas.empresa}"> ${recorroEmpresas.empresa}</option>
               `;
             })
             $("#empresaBuscarFinal").html(templateSelectEmpresa)
           }
         })

    })




    // fin panel limpiar validados



  
     // panel Ingresar Base


     $("#importarBase").click(function(){
    
      $("#abrirImportarBase").modal("show")

  })


  $("#mostrarDatosBase").click(function(){
      $("#abrirModalMostrarDatosTablaBase").modal("show")

      $.ajax({
        url:"../../control/admin/C_normalizacion.php?action=mostrarEmpresas",
        type:"GET",
        success: function(response){
          var reciboEmpresas = JSON.parse(response)
          var templateSelectEmpresa = "";
          reciboEmpresas.forEach((recorroEmpresas) =>{
            templateSelectEmpresa +=`
            <option value="${recorroEmpresas.empresa}"> ${recorroEmpresas.empresa}</option>
            `;
          })
          $("#empresaBuscarBase").html(templateSelectEmpresa)
        }
      })

  })

  // fin panel Ingresar Base

  

Redireccion()

function Redireccion() {
    $("#mostrarpanel").click(function () {
      location.href = base_url+"usuario/admin";
    });
  
    $("#inicio").click(function () {
      location.href = base_url;
    });
    $("#cerrar").click(function () {
      location.href = base_url+"usuario/logOut";
    });
  }


  // traer empresas
function getEmpresas(atributo) {
  var pedirEmpresas = "pedirEmpresas";
  $.ajax({
    url: "../controllers/equipoController.php?equipo=empresa",
    type: "POST",
    data: { pedirEmpresas },
    beforeSend: function () {
      $("#cargarEmpresa").append('<div id="loaderEmpresa" class="spinner-border" role="status"><span class="sr-only">Loading...</span></div>')
    },
  }).done(function (response) {
    $("#loaderEmpresa").remove()
    var object = JSON.parse(response);
    var templateEmpresas = "";

    object.forEach((val) => {
      templateEmpresas += `
            <option value='${val.empresa}' >${val.empresa}</option>
            `;
    });

    $(atributo).html(templateEmpresas);
  });
}
  

var delay = (function () {
  var timer = 0;
  return function (callback, ms) {
    clearTimeout(timer);
    timer = setTimeout(callback, ms);
  };
})();

function alertPositive(str) {
  Swal.fire({
    icon: "success",
    title: str,
    showConfirmButton: false,
    timer: 3000,
  });
}

function alertNegative(str) {
  Swal.fire({
    icon: "error",
    title: "Info",
    text: str,
    timer: 3800,
    showConfirmButton: false,
  });
}

  