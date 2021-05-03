$(document).ready(function () {
  

  function getParameterByName(name) {
    name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
    var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
      results = regex.exec(location.search);
    return results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
  }

  getParameterByName(name);


  var pro = getParameterByName('pro');

  if (pro) {
    $(document).ready(function () {

     
      $.ajax(

        {
          url: "../../model/deliver/Mdeliver-items.php",
          type: "GET",
          data: { pro },
          success: function (response) {
            var ReciboDatos = JSON.parse(response)


            if (ReciboDatos.fail == false) {
              console.log("la consulta es incorrecta")
            }
            if (ReciboDatos.fail === undefined) {
              $("#buscaCliente").hide();


              var identificacionBusco = ReciboDatos[0].identificacion
              var codigoPostalBusco = ReciboDatos[0].codigo_postal
              var nombreCliente = ReciboDatos[0].nombre_cliente
              var provinciaCliente = ReciboDatos[0].provincia
              var direccionCliente = ReciboDatos[0].direccion
              var localidadCliente = ReciboDatos[0].localidad
              var emailCliente = ReciboDatos[0].emailcliente



              console.log("hola" + emailCliente)

              $.ajax({
                url: "../../model/deliver/Mdeliver-items.php",
                type: "POST",
                data: { codigoPostalBusco },
                success: function (response) {
                  ReciboOpcionesJson = JSON.parse(response)

                  if (ReciboOpcionesJson.fail === false) {
                    return console.log("no existe nada definitavamente")
                  }

                  if (ReciboOpcionesJson.fail !== false) {

                    $('html, body').animate({
                      scrollTop: $('#comienzo').offset().top
                    }, 500);

                    if (ReciboOpcionesJson[0].result === 1) {


                      templateOpciones = `
                   <div class="sub-box-opciones" id="recolector">
                    <div class="box-opciones">
                     <span>Recolector a domicilio</span>
                     <img src="../../estilos/imagenes/front/car2.png" alt="">
                    </div>
                   </div>
                 <div class="sub-box-opciones" id="correo">
                  <div class="box-opciones">
                    <span>Gratis</span>
                     <span>Correo argentino</span>
                      <img src="../../estilos/imagenes/front/car2.png" alt="">
                  </div>
                 </div>`;
                      $("#container-opciones").html(templateOpciones);
                      MuestroTablaConDatos(ReciboDatos)
                      IrHastaDevolverCorreoPorArgentino()
                      IrHastaFormPactarCita(emailCliente, identificacionBusco)
                     

                      EnviarInfoAutoGestionRecolector(identificacionBusco, codigoPostalBusco, nombreCliente, provinciaCliente, direccionCliente, localidadCliente, emailCliente)

                    
                      console.log("hay recolector")
                    }
                    if (ReciboOpcionesJson[0].result === 2) {
                      return console.log("hay comercio")
                    }
                    if (ReciboOpcionesJson[0].result === 3) {
                      return console.log("hay PM")
                    }
                    if (ReciboOpcionesJson[0].result === 4) {
                      return console.log("no hay recolector, comercio, ni pm")
                    }


                  }


                }
              })
            }
          }
        }


      )

      MotrarInputDomicilio()
      

     

    })
  }
  if (!pro) {
    console.log(":(")
    $("#buscaCliente").show();

  }

})

function MuestroTablaConDatos(ReciboDatos) {

  templatetabla = "";
  templatetitulotabla = `
               <h4> Hola ${ReciboDatos[0].nombre_cliente} </h4>
               <div class="equipos-pendientes">

                               `;
  $("#box-titulo").html(templatetitulotabla);
  ReciboDatos.forEach((recorroDatos) => {

    templatetabla += `
               <tr>
                    <td>${recorroDatos.serie}</td>
                    <td>${recorroDatos.equipo}</td>
                    <td>${recorroDatos.direccion}</td>
                    <td>${recorroDatos.tarjeta}</td>
                    <td>${recorroDatos.localidad}</td>
                    <td>${recorroDatos.provincia}</td>
                    <td>${recorroDatos.codigo_postal}</td>
               <tr>
                            `;

    $("#tbody").html(templatetabla);
    $("#tabladatos").show();


  })
}

function IrHastaFormPactarCita(emailCliente, identificacionBusco) {
  $("#recolector").click(function () {
    $("#container-box-recolector").show()
    $('html, body').animate({
      scrollTop: $('#container-box-recolector').offset().top
    }, 500);

    $("#emailalternativo").val(emailCliente)

    var hoy = new Date();
    var fecha = hoy.getFullYear()+ '-' + (hoy.getMonth() + 1)+ '-' + hoy.getDate();
    var hora = hoy.getHours() + ':' + hoy.getMinutes() + ':' + hoy.getSeconds();

    
    var fechaYHora = fecha + ' ' + hora;


    var identificacionFormReco = identificacionBusco;
    $.ajax({
      url: "../../model/deliver/click.php",
      type: "POST",
      data: { identificacionFormReco, fechaYHora },
      success: function (response) {
        console.log(response)
      }
    })
  })
}

function IrHastaDevolverCorreoPorArgentino() {

  $("#correo").click(function () {
    $("#container-box-recolector").hide()
    $("#container-correo-argentino").show();
    $('html, body').animate({
      scrollTop: $('#container-correo-argentino').offset().top
    }, 500);
  })

}




function EnviarInfoAutoGestionRecolector(identificacionBusco, codigoPostalBusco, nombreCliente, provinciaCliente, direccionCliente, localidadCliente, emailCliente) {

  $("#enviarinfo").click(function () {


    var hoyE = new Date();
    var fechaE = hoyE.getFullYear()+ '-' + (hoyE.getMonth() + 1)+ '-' + hoyE.getDate();
    
    
    var horaE = hoyE.getHours() + ':' + hoyE.getMinutes() + ':' + hoyE.getSeconds();


    var fechaYHoraE = fechaE + ' ' + horaE;


    var horaRecogida = $("#horario_rec").val()
    var diaRecogida = $("#dia_rec").val()
    var cantidadRecogida = $("#cantidadEquipos").val()
    var caracteristicaRecogida = $("#caracteristicaContacto").val()
    var numeroRecogida = $("#numeroContacto").val()



    var domicilioAltRecogida = $("#domiContacto").val()
    var emailAltRecogida = $("#emailalternativo").val()

    if ((!cantidadRecogida == "")) {

      if (!(/^[A-Za-z0-9]+$/).test(cantidadRecogida)) {
        return console.log("cantidadRecogida invalido")
      }
    }
    if ((!numeroRecogida == "")) {

      if (!(/^[0-9]+$/).test(numeroRecogida)) {
        return console.log("numeroRecogida invalido")
      }
    }
    if ((!domicilioAltRecogida == "")) {

      if (!(/^[A-Za-z0-9\s/\/-]+$/).test(domicilioAltRecogida)) {
        return console.log("domicilioAltRecogida invalido")
      }
    }
    if ((!emailAltRecogida == "")) {

      if (!(/^[_a-z0-9]+(\.[_a-z0-9]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,15})/i).test(emailAltRecogida)) {
        return console.log("emailAltRecogida invalido")
      }
    }
    //  console.log(horaRecogida+diaRecogida+cantidadRecogida+caracteristicaRecogida+numeroRecogida+domicilioAltRecogida+emailAltRecogida+identificacionBusco)

    $.ajax({
      url: "../../model/deliver/Mdeliver-items.php",
      type: "POST",
      data: { horaRecogida, diaRecogida, cantidadRecogida, caracteristicaRecogida, numeroRecogida, domicilioAltRecogida, emailAltRecogida, identificacionBusco, fechaYHoraE },
      success: function (response) {

        ClickEnDescargarComprobanteDeAutogestion(identificacionBusco, codigoPostalBusco, nombreCliente, provinciaCliente, direccionCliente, localidadCliente, emailCliente, horaRecogida, diaRecogida, cantidadRecogida, caracteristicaRecogida, numeroRecogida, domicilioAltRecogida, emailAltRecogida, identificacionBusco, fechaYHoraE )

        var ReciboAutoGestionAprobada = JSON.parse(response)
      
        if (ReciboAutoGestionAprobada.result === 2) {
          console.log("algo fallo")
        }
        if (ReciboAutoGestionAprobada.result === 1) {

          $.ajax({
            url: "../../resources/correo/aviso_autogestion.php",
            type: "POST",
            data: { identificacionBusco, codigoPostalBusco, nombreCliente, provinciaCliente, direccionCliente, localidadCliente, emailCliente, horaRecogida, diaRecogida, cantidadRecogida, caracteristicaRecogida, numeroRecogida, domicilioAltRecogida, emailAltRecogida, identificacionBusco, fechaYHoraE },
            beforeSend: function (objeto) {
              $("#procesando").show();
            },
            success: function (response) {
              var EnviodeCorreo = JSON.parse(response)
              console.log(EnviodeCorreo)
              if (EnviodeCorreo.result === 1) {
                $("#procesando").hide(); $(" #enviarinfo").hide();

                console.log("Le hemos enviado el comprobante de la cita a su correo electronico, si no le llego el correo, puede descargarlo dandole click")

                $("#DescargarAviso").show();


              }
              if ((EnviodeCorreo.result === 2) || (EnviodeCorreo.result === 4) || (EnviodeCorreo.result === 3)) {

                $("#procesando").hide(); $(" #enviarinfo").hide();
                console.log("el envio no se realizo. puede descargar el comprobante electronico de su cita coordinada haciendo click en descargar")
               
                $("#DescargarAviso").show();

              }
             
            }
          })

        
          // $("#main-director").hide();
          //  $("#mensaje-exito-pactado").show();

          //  $('html, body').animate({
          //   scrollTop: $('#mensaje-exito-pactado').offset().top
          // }, 500);



        }
      }
    })

    

  })

 
}

function ClickEnDescargarComprobanteDeAutogestion(identificacionBusco, codigoPostalBusco, nombreCliente, provinciaCliente, direccionCliente, localidadCliente, emailCliente, horaRecogida, diaRecogida, cantidadRecogida, caracteristicaRecogida, numeroRecogida, domicilioAltRecogida, emailAltRecogida, identificacionBusco, fechaYHoraE ){

  $("#DescargarAviso").click(function(){
    

$.ajax({
     type:"POST",
     url:'../../resources/pdfU/autogestion-deliver/descargar-aviso-cita.php',
     data: {identificacionBusco, codigoPostalBusco, nombreCliente, provinciaCliente, direccionCliente, localidadCliente, emailCliente, horaRecogida, diaRecogida, cantidadRecogida, caracteristicaRecogida, numeroRecogida, domicilioAltRecogida, emailAltRecogida, identificacionBusco, fechaYHoraE},
     success: function (response){
       


      
      // window.open('../../'+identificacionBusco+'.pdf','Download')


var link = document.createElement('a');
link.href = '../../'+identificacionBusco+'.pdf';
link.download = identificacionBusco+'.pdf';
link.dispatchEvent(new MouseEvent('click'));
     }
})
   
  })

}
function MotrarInputDomicilio() {
  $("#abrirdomicilio").click(function () {
    $("#domiContacto").show()
  })
}





