var notificacionDisplayed = false;
var panelGeneralDisplayed = true;

const urlid = {
idnumber : getParameterByName("id_us")
}


$(document).ready(function () {
  Redireccion();
  coutNotificacions($("#id_admin").val());
  // mostrar usuarios

  if (urlid.idnumber !== '' && urlid.idnumber !== null) {

    getDataUser(urlid);
  }
});

$(document).on("click", "#buscar-solicitudes", function () {
  const objectBuscar = {
    idnumber: $("#documento").val()
  } 
  getDataUser(objectBuscar);
});

$(document).on("click", "#mostrar-todos", function () {
  showAll();
});

// gestionar usuarios
// accion usuario
// enviar contrato

$(document).on("click", "#enviarContrato", function () {
  var tdEnviarContrato = this.parentElement;
  var idmail = $(tdEnviarContrato).attr("idmail");
  var idnumber = $(tdEnviarContrato).attr("id_number");
  var mail = $(tdEnviarContrato).attr("mail");
  var id_user = $(tdEnviarContrato).attr("id_user");
  var name = $(tdEnviarContrato).attr("nombre");
  var id_managent = $("#id_user_default").val()
 
  const objectContrato = {
    idnumber,idmail,mail,id_user,name,id_managent,
    method : 'userRegistrationProcess',
    action: 'enviarcontrato',
    motivo:'Contrato Express',
    tittle:'¿Estas seguro de enviar el contrato?',
    text: 'Le llegara el contrato por correo eléctronico y entrara en estado "Esperando firmar contrato"',
    icon:'info',
    confirmButton:'Si, enviar!',
    stat:'sign_contract',
    textResponse:'enviado'
  }

  confirm(objectContrato);
});


// aviso contrato enviado

$(document).on('click','#contratoEnviado',function(){

  var tdContratoEnviado = this.parentElement;
  var idmail = $(tdContratoEnviado).attr("idmail");
  var idnumber = $(tdContratoEnviado).attr("id_number");
  var mail = $(tdContratoEnviado).attr("mail");
  var id_managent = $("#id_user_default").val()
  
  const objectContractSent = {
    idnumber,idmail,mail,id_managent,
    method : 'userRegistrationProcess',
    action: 'contratoEnviado',
    motivo:'Aviso de contrato',
    tittle:'¿Quieres enviarle un segundo aviso al postulante?',
    text: 'Al enviarle el contrato ya se le envio un aviso por correo, si deseas enviarle otro aviso puedes hacerlo."',
    icon:'info',
    confirmButton:'Si, enviar!',
    stat:'avisoEnviado',
    textResponse:'enviado'
  }

  confirm(objectContractSent);
});

//aviso pronto activo

$(document).on('click','#prontoActivo',function(){

  var tdProntoActivo = this.parentElement;
  var idnumber = $(tdProntoActivo).attr("id_number");
  var mail = $(tdProntoActivo).attr("mail");
  var action = "mensajeProntoActivo";
  var motivo = "Express";
  var id_managent = $("#id_user_default").val()

  const SoonYouWillBeActive = {

    idnumber,mail,id_managent,
    method : 'userRegistrationProcess',
    action: 'mensajeProntoActivo',
    motivo:'Falta poco! Express',
    tittle:'Estas por enviar un aviso!',
    text: 'Pronto estaras activo para gestionar! Gracias!"',
    icon:'info',
    confirmButton:'Si, enviar!',
    stat:'aviso',
    textResponse:'enviado'

  }

  confirm(SoonYouWillBeActive);

})

// aviso activo

$(document).on('click','#avisoActivo',function(){

  var tdAvisoActivo = this.parentElement;
  var idnumber = $(tdAvisoActivo).attr("id_number");
  var idmail = $(tdAvisoActivo).attr("idmail");
  var mail = $(tdAvisoActivo).attr("mail");
  var id_user = $(tdAvisoActivo).attr("id_user");
  var nombre = $(tdAvisoActivo).attr("name");
  var id_managent = $("#id_user_default").val()

  const objectNotifyActive = {
    idnumber,mail,idmail,id_user,name,id_managent,
    method : 'userRegistrationProcess',
    action: 'otroAvisoActivo',
    motivo:'Ya estas activo!',
    tittle:'¿Queres enviarle un segundo aviso indicandole que esta activo ?',
    text: 'Al darle de alta se le envió un aviso por correo, si deseas enviarle otro aviso puedes hacerlo."',
    icon:'info',
    confirmButton:'Si, enviar!',
    stat:'otroAvisoActivo',
    textResponse:'enviado'
  }

  confirm(objectNotifyActive);

});

// cancelar contrato

$(document).on('click','#cancelarContrato',function(){

  var tdCancelarContrato = this.parentElement;
  var idnumber = $(tdCancelarContrato).attr("id_number");
  var id_managent = $("#id_user_default").val()
  const objectCancelContract = {
    idnumber,id_managent,
    stat: 'cancel',
    textResponse: 'cancelado'
  }

  setSatusUser(objectCancelContract)

})
  
// alta usuario

$(document).on('click','#alta',function(){

  var tdAlta = this.parentElement;
  var idnumber = $(tdAlta).attr("id_number");
  var mail = $(tdAlta).attr("mail");
  var id_user = $(tdAlta).attr("id_user");
  var name = $(tdAlta).attr("nombre");
  var id_managent = $("#id_user_default").val()

  const objectAlta = {
    idnumber,mail,id_user,name,id_managent,
    method : 'userRegistrationProcess',
    action: 'mensajeActivo',
    tittle:'¿Estas seguro/a?',
    text: 'Le daras de alta a este usuario',
    icon:'info',
    confirmButton:'Si, dar de alta!!',
    stat:'active',
  }

  confirm(objectAlta);


})

// baja usuario

$(document).on('click','#baja',function(){

    var tdAlta = this.parentElement;
    var idnumber = $(tdAlta).attr("id_number");
    var mail = $(tdAlta).attr("mail");
    var id_managent = $("#id_user_default").val()
    
    
    $("#id_usuario_baja").val(idnumber);
    $("#id_usuario_managent_baja").val(id_managent);
    $("#mail_usuario_baja").val(mail);
    
    $("#modalBaja").modal("show")


})


$(document).on('click','#down_user',function(){

  var id_usuario_baja = $("#id_usuario_baja").val();
  var id_managent_baja =  $("#id_usuario_managent_baja").val();
  var motivo_baja =  $("#motivo_baja_usuario").val();
  var descripcion = $("#descripcion_baja").val();
  var mail = $("#mail_usuario_baja").val();
  

    const  objectBaja = {
       idnumber:id_usuario_baja,
       id_managent:id_managent_baja,
       motivo: motivo_baja,
       mail,
       descripcion,
       tittle:'¿Estas seguro/a?',
       text: 'Le daras de baja a este usuario',
       icon:'info',
       confirmButton:'Si, dar de baja!',
       stat:'down',
       action:'down',
       method:'userRegistrationProcess'
     }

   

  if(id_usuario_baja === ''){
    alertNegative("No hay usuario seleccionado para dar de baja");
    return false;
  }else if(id_managent_baja === ''){
    alertNegative("No hay operador/a registrado para realizar esta accion");
    return false;
  }else if(motivo_baja === '0'){
    alertNegative("Debes escoger un motivo por el cual se genera la baja de este usuario");
    return false;
  }else{
     confirm(objectBaja);
  }

})
//volver a dar de alta

$(document).on('click','#volverAlta',function(){


    var tdAlta = this.parentElement;
    var idnumber = $(tdAlta).attr("id_number");
    var mail = $(tdAlta).attr("mail");
    var id_managent = $("#id_user_default").val()

    const  objectAltaAgain = {
      idnumber,mail,id_managent,
      method : 'userRegistrationProcess',
      action: 'mensajeActivo',
      tittle:'¿Estas seguro/a?',
      text: 'Le daras de alta nuevamente a este usuario',
      icon:'info',
      confirmButton:'Si, dar de alta!',
      stat:'active',
    }

    confirm(objectAltaAgain);

})

// notificaciones

$(document).on("click", "#solicitudes", function () {
  if ($("#despliegue-notificacion").is(":visible")) {
    $("#despliegue-notificacion").fadeOut();
  } else {
    $("#despliegue-notificacion").fadeIn();
    $("#despliegue-notificacion").html('<div class="header-despliegue" id="header-despliegue">Notificaciones<div class="body-despliegue"><div class="spinner-border" role="status"><span class="sr-only">Loading...</span></div>');

  
    getNotifications($("#id_admin").val());
  }
});

$(document).on("click", function (e) {
  var container = $("#container-notification");

  if (!container.is(e.target) && container.has(e.target).length === 0) {
    if ($("#despliegue-notificacion").is(":visible")) {
      $("#despliegue-notificacion").fadeOut();
    }
  }
});


// TRANSITO

// buscar clientes base general-----------------

$("#form-iden").submit(function (e) {
  e.preventDefault();
  $("#tableTransito").hide();

  let getDato = $("#datoBuscar").val().replace(/ /g, "");
  let BuscarDato = getDato;

  searchDataInBase(BuscarDato);
});

// buscador equipos en TRANSITO

$("#form-transito").submit(function (e) {

  $("#tableTransito").hide();
  e.preventDefault();
  let getDato = $("#datoBuscarTransito").val().replace(/ /g, "");
  let reciboDatoIngresadoTransito = getDato;
  searchDataInTransit(reciboDatoIngresadoTransito);

});

//agregar cliente en base
$(document).on("click", "#agregarCliente", function () {
  $("#ModalAddCustomers").modal("show");
  $("#registerCustomer").hide();
  
  $("#ButtonNext").html('<button type="button" class="btn btn-primary" id="siguientePaso">Siguiente</button>');

  getPais("#pais_add");
  getEmpresas("#empresa_add");

});

$(document).on("change", "#pais_add", function () {
  var idPais = $("#pais_add").val();
  getProvincia("#provincia_add", idPais);
});

$(document).on("change", "#provincia_add", function () {
  var idProvincia = $("#provincia_add").val();
  getLocalidad("#localidad_add", idProvincia);
});

$(document).on("change", "#localidad_add", function () {
  var cpLocalidad = $("#localidad_add").val();

 $("#codigo_postal_add").val(cpLocalidad)
 
});



var delay = (function () {
  var timer = 0;
  return function (callback, ms) {
    clearTimeout(timer);
    timer = setTimeout(callback, ms);
  };
})();

// validar id local
$("#id_local_add").keyup(function () {
  delay(function () {
    if($("#id_local_add").val() !== ''){
    validateExistID($("#id_local_add").val());
    }
  }, 800);
});
//validar serie_add

$("#serie_add").keyup(function () {
  delay(function () {
    if($("#serie_add").val() !== ''){
      validateExistSerie($("#serie_add").val());
    }else{
      localStorage.setItem("se", "s");
     }
   
  }, 800);
});
// validar terminal

$("#terminal_add").keyup(function () {
  delay(function () {
  if($("#terminal_add").val() !== ''){
    validateExistTerminal($("#terminal_add").val());
     }else{
      localStorage.setItem("te", "s");
     }
  }, 800);
});

$(document).on("click", "#siguientePaso", function () {

  var empresa_add = $("#empresa_add").val();
  var cartera_add = $('#cartera_add').val()
  var identificacion_add = $("#identificacion_add").val();
  var id_local_add = $("#id_local_add").val();
  var pais_add = $("#pais_add").val();
  var provincia_add = $("#provincia_add").val();
  var localidad_add = $("#localidad_add").val();
  var domicilio_add = $("#domicilio_add").val();
  var codigo_postal_add = $("#codigo_postal_add").val();
  var serie_add = $("#serie_add").val();
  var terminal_add = $("#terminal_add").val();
  var sim_add = $("#sim_add").val();
  var nombre_add = $("#nombre_add").val();
  var email_add = $("#email_add").val();
  var telefono_add = $("#telefono_add").val();
  var id_user_add = $("#id_user_add").val();
 

  if (empresa_add === "0") {
    alertNegative("Debes seleccionar la empresa");
    return false;
  } else if (identificacion_add === "") {
    alertNegative("Debes ingresar la identificacion");
    return false;
  } else {
    true;
  }

  if (identificacion_add !== "") {
    var clearIdentificacion = identificacion_add.substr(0, 3);
    var clearCartera = cartera_add.substr(0,1)

    if (empresa_add === "ANTINA") {
      if (clearIdentificacion !== "AN.") {
        alertNegative("La identificacion debe empezar con 'AN.' MAYUSCULA");
        return false;
      }
    }
    if (empresa_add === "INTV") {
      var clearCartera = cartera_add.substr(0,2)
      if (clearIdentificacion !== "IN.") {
        alertNegative("La identificacion debe empezar con 'IN' MAYUSCULA");
        return false;
      }
    }
    if (empresa_add === "IPLAN") {
      var clearCartera = cartera_add.substr(0,2)
      if (clearIdentificacion !== "IP.") {
        alertNegative("La identificacion debe empezar con 'IP.' MAYUSCULA");
        return false;
      }
      
    }
    if (empresa_add === "CABLEVISION") {
      if (clearIdentificacion !== "CV.") {
        alertNegative("La identificacion debe empezar con 'CV.' MAYUSCULA");
        return false;
      }
    }
    if (empresa_add === "POSNET") {
      if (clearIdentificacion !== "PS.") {
        alertNegative("La identificacion debe empezar con 'PS.' MAYUSCULA");
        return false;
      }
    }
    if (empresa_add === "LAPOS") {
      if (clearIdentificacion !== "LA.") {
        alertNegative("La identificacion debe empezar con 'LA.'MAYUSCULA");
        return false;
      }
    }
    if (empresa_add === "METROTEL") {
      if (clearIdentificacion !== "MT.") {
        alertNegative("La identificacion debe empezar con 'MT.' MAYUSCULA");
        return false;
      }
    }
    if (empresa_add === "GEOCOM") {
      if (clearIdentificacion !== "GC.") {
        alertNegative("La identificacion debe empezar con 'GC.' MAYUSCULA");
        return false;
      }
    }
  }
  
  if ( empresa_add === "LAPOS" || empresa_add === "POSNET" || 
    empresa_add === "GEOCOM") {
    if (terminal_add === "") {
      alertNegative("Debes ingresar el numero de terminal");
      return false;
    }
  }else{

    if (serie_add === "") {
      alertNegative("Debes ingresar el numero de serie");
      return false;
    }

  }

  if (id_local_add === "") {
    alertNegative("Debes ingresar el id_local");
    return false;
  }

  if (pais_add === "0" || pais_add === "") {
    alertNegative("Debes seleccionar un pais");
    return false;
  } else if (provincia_add === "0" || provincia_add === "") {
    alertNegative("Debes seleccionar una provincia");
    return false;
  } else if (localidad_add === "0" || localidad_add === "") {
    alertNegative("Debes seleccionar una localidad");
    return false;
  } else if (domicilio_add === "") {
    alertNegative("Debes ingresar un domicilio");
    return false;
  } else if (codigo_postal_add === "") {
    alertNegative("Debes ingresar codigo postal");
    return false;
  } else {
    true;
  }

  if (nombre_add === "") {
    alertNegative("Debes ingresar el nombre del cliente");
    return false;
  } else if (email_add === "") {
    alertNegative("Debes ingresar el email del cliente");
    return false;
  } else if (
    !/^[_a-z0-9]+(\.[_a-z0-9]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,15})/i.test(
      email_add
    )
  ) {
    alertNegative("El email ingresado es invalido");
    return false;
  } else if (telefono_add === "") {
    alertNegative("Debes ingresar nro de telefono");
    return false;
  } else if ($("#telefono_add").val().length < 8) {
    alertNegative("El numero de telefono debe tener un minimo largo de 8 digitos");
    return false;
  } else if (id_user_add === "") {
    alertNegative(
      "Actualmente no puede agregar un cliente, cierre sesion y vuelva a ingresar"
    );
    return false;
  } else {

    var obteneridLS = localStorage.getItem("id");
    var obtenerserieLS = localStorage.getItem("se");
    var obtenerterminalLS = localStorage.getItem("te");

    if (obteneridLS === "n") {
      alertNegative(
        "El id local ingresado ya existe en la base de datos, debes ingresar otro id"
      );
      return false;
    } else if (obtenerserieLS === "n") {
      alertNegative(
        "La serie ingresada ya existe en la base de datos, debes ingresar otra serie"
      );
      return false;
    } else if (obtenerterminalLS === "n") {
      alertNegative(
        "La terminal ingresada ya existe en al base de datos, debes ingresar otra terminal"
      );
      return false;
    } else {
      $("#siguientePaso").hide();
      $("#registerCustomer").show();
    }
  }
});

$(document).on("click", "#registerCustomer", function () {

  var empresa_add = $("#empresa_add").val();
  var cartera_add = $("#cartera_add").val();
  var identificacion_add = $("#identificacion_add").val();
  var id_local_add = $("#id_local_add").val();
  var pais_add = $("#pais_add").val();
  var localidad_add = $('select[name="localidad_add"] option:selected').text()
  var domicilio_add = $("#domicilio_add").val();
  var codigo_postal_add = $("#codigo_postal_add").val();
  var serie_add = $("#serie_add").val();
  var terminal_add = $("#terminal_add").val();
  var sim_add = $("#sim_add").val();
  var nombre_add = $("#nombre_add").val();
  var email_add = $("#email_add").val();
  var telefono_add = $("#telefono_add").val();
  var id_user_add = $("#id_user_add").val();
  var provincia_add = $('select[name="provincia_add"] option:selected').text();

  var hoy = new Date();
        var getMinutos = hoy.getMinutes();
        var getSegundos = hoy.getSeconds()
        var getHora = hoy.getHours()

        if(getMinutos<10){
            getMinutos = '0' + hoy.getMinutes()
        }
        if(getSegundos<10){
            getSegundos = '0' + hoy.getSeconds()
        }
        if(getHora<10){
          getHora = '0' + hoy.getHours()
      }

        var fecha = hoy.getFullYear() + '-' + ("0" +(hoy.getMonth() + 1)).slice(-2) + '-' +
        ("0" + hoy.getDate()).slice(-2)+ ' ' + getHora + ':' + getMinutos + ':' + getSegundos;



    $("#registerCustomer").hide()

  $.ajax({
    url: "../controllers/equipoController.php?equipo=addNewCustomers",
    type: "POST",
    data: {
      empresa_add,
      cartera_add,
      identificacion_add,
      id_local_add,
      provincia_add,
      localidad_add,
      domicilio_add,
      codigo_postal_add,
      serie_add,
      terminal_add,
      sim_add,
      nombre_add,
      email_add,
      telefono_add,
      id_user_add,
      fecha,
    },
    befored: function () {
    
      $("#loaderadd").append(
        '<div id="loaderEnviar"  class="spinner-border" role="status"><span class="sr-only">Loading...</span></div>'
      )
    },
  }).done(function (response) {
    $("#loaderEnviar").remove()
    if (response === "1") {
      alertPositive("Agregado con exito!");
      setFormAddNewCustomers();
      $("#ModalAddCustomers").modal("hide");
      searchDataInBase(identificacion_add);

      localStorage.removeItem("id");
      localStorage.removeItem("se");
      localStorage.removeItem("te");
    }
    if (response === "2") {
      alertNegative("No fue posible agregar el nuevo cliente!");
      return false;
    }
    if (response === "3") {
      alertNegative(
        "No se se agrego el nuevo cliente porque no se recibieron todos los datos necesarios"
      );
      return false;
    }
  });
});



// eliminar equipos en transito

$(document).on("click", "#delete-equipment", function () {
  var idMap = this.parentElement;
  var id_guia_equipo = $(idMap).attr("id_transito");
  var id_equipo = $(idMap).attr("id_equipo");
  var id_user_update = $("#id_user_default").val();

  var hoy = new Date();
  var getMinutos = hoy.getMinutes();
  var getSegundos = hoy.getSeconds()
  var getHora = hoy.getHours()

  if(getMinutos<10){
          getMinutos = '0' + hoy.getMinutes()
}
  if(getSegundos<10){
      getSegundos = '0' + hoy.getSeconds()
  }
  if(getHora<10){
    getHora = '0' + hoy.getHours()
}

  var fecha_update = hoy.getFullYear() + '-' + ("0" +(hoy.getMonth() + 1)).slice(-2) + '-' +
  ("0" + hoy.getDate()).slice(-2)+ ' ' + getHora + ':' + getMinutos + ':' + getSegundos;

  // areYouSureDeleteEquipment('¿Estas seguro/a de sacar este equipo de transito?','¿Revisaste cuidadosamente los datos?','info','Si, estoy seguro/a',id_guia_equipo,id_user_update,fecha_update)

  Swal.fire({
    title: 'Estas seguro de eliminar este equipo?',
    text: 'Es una acción importante',
    icon: 'info',
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: 'Si,eliminar',
  }).then((result) => {   
    if (result.isConfirmed) { 
      $.ajax({
        url: "../controllers/equipoController.php?equipo=modifyTransito",
        type: "POST",
        data: { id_guia_equipo, id_user_update, fecha_update,id_equipo },
        beforeSend: function () {},
      }).done(function (response) {
        var object = JSON.parse(response);
    
        if (object[0].result === "1") {
          searchDataInTransit($("#datoBuscarTransito").val());
    
          alertPositive("Se ha eliminado con exito!")
          
        }
      });
     
  }
})

 
});

// abrir editar equipo en transito

$(document).on("click", "#edit-equipment", function () {
  var idMap = this.parentElement;
  var id_guia_equipo = $(idMap).attr("id_transito");
  var id_equipo = $(idMap).attr("id_equipo");
  var getTerminal = $(idMap).attr("terminal");
  var getSerie = $(idMap).attr("serie");
  var getAccesorio_uno = $(idMap).attr("accesorio_uno");
  var getAccesorio_dos = $(idMap).attr("accesorio_dos");
  var getAccesorio_tres = $(idMap).attr("accesorio_tres");
  var getAccesorio_cuatro = $(idMap).attr("accesorio_cuatro");
  var getEstado = $(idMap).attr("estado");

  var template = "";
  template = componenTModify(
    getAccesorio_uno,
    getAccesorio_dos,
    getAccesorio_tres,
    getAccesorio_cuatro,
    getEstado,
    id_guia_equipo,
    id_equipo
  );
  $("#component").html(template);
  $("#modalEditTransito").modal("show");
  $("#terminal-edit").val(getTerminal);
  $("#serie-edit").val(getSerie);
});

// enviar info editar equipo

$("#editar-equipo").click(function () {
  var hoy = new Date();
  var getMinutos = hoy.getMinutes();
  var getSegundos = hoy.getSeconds()
  var getHora = hoy.getHours()

  if(getMinutos<10){
          getMinutos = '0' + hoy.getMinutes()
}
  if(getSegundos<10){
      getSegundos = '0' + hoy.getSeconds()
  }
  if(getHora<10){
    getHora = '0' + hoy.getHours()
}

  var fecha_update = hoy.getFullYear() + '-' + ("0" +(hoy.getMonth() + 1)).slice(-2) + '-' +
  ("0" + hoy.getDate()).slice(-2)+ ' ' + getHora + ':' + getMinutos + ':' + getSegundos;

  var terminal = $("#terminal-edit").val();
  var serie = $("#serie-edit").val();
  var accesorioUno = $("#accesorio-uno-edit").val();
  var accesorioDos = $("#accesorio-dos-edit").val();
  var accesorioTres = $("#accesorio-tres-edit").val();
  var accesorioCuatro = $("#accesorio-cuatro-edit").val();
  var estado = $("#estado-edit").val();
  var id_user_update = $("#id_user_update").val();
  var id_guia_equipo = $("#id_guia_equipo").val();
  var id_equipo = $("#id_equipo").val();

  $.ajax({
    url: "../controllers/equipoController.php?equipo=modifyTransito",
    type: "POST",
    data: {
      id_guia_equipo,
      id_equipo,
      terminal,
      serie,
      accesorioUno,
      accesorioDos,
      accesorioTres,
      accesorioCuatro,
      estado,
      fecha_update,
      id_user_update,
    },
    beforeSend: function () {
      $("#loadereditar").show();
      $("#loadereditar").html('<div class="spinner-border" role="status"><span class="sr-only">Loading...</span></div>');
    },
  }).done(function (response) {
    $("#loadereditar").hide();
    var object = JSON.parse(response);

    if (object[0].result === "1") {
      searchDataInTransit($("#datoBuscarTransito").val());
      alertPositive("Modificado con exito!");
      $("#modalEditTransito").modal("hide");
    }
  });
});

// mostrar transito por recolector y por fecha

$("#form-reco-fecha").submit(function (e) {
  let getDato = $("#recolector").val().replace(/ /g, "");
  var ReciboReco = getDato;
  var ReciboFechaUno = $("#recoFechaUno").val();
  var ReciboFechaDos = $("#recoFechaDos").val();

  if (ReciboReco === "") {
    alertNegative("Debes ingresar recolector");
    return false;
  }
  if (ReciboFechaUno === "") {
    alertNegative("Debes ingresar Fecha de inicio");
    return false;
  }
  if (ReciboFechaUno === "") {
    alertNegative("Debes ingresar Fecha final");
    return false;
  }

  e.preventDefault();

  $.ajax({
    url:
      "../controllers/equipoController.php?equipo=transitoRecolectoresYFecha",
    type: "POST",
    data: { ReciboReco, ReciboFechaUno, ReciboFechaDos },
    beforeSend: function () {
      $("#procesando").show();
    },
  }).done(function (response) {
    $("#procesando").hide();
    let object = JSON.parse(response);
    var template = "";

    if (object[0].result === "1") {
      countEstadosTransito(ReciboReco, ReciboFechaUno, ReciboFechaDos);

      template = showTransitByCollectorAndDate(object);
      $("#data").html(template);
      table();
      $("#btn-informe").html(
        '<button class="btn btn-danger" id="informeRecoFecha">Informe</button>'
      );
      MostrarTablaOcultarErrorTransito();
    }
    if (object[0].result === "2") {
      MostrarErrorOcultarTablaTransito();
    }
  });
});

// informe por recolector y fecha

$(document).on("click", "#informeRecoFecha", function () {
      var recolector = $("#recolector").val();
      var fechaStart = $("#recoFechaUno").val();
      var fechaEnd = $("#recoFechaDos").val();

      if (recolector === "") {
        alertNegative("Debes ingresar recolector");
        return false;
      }
      if (fechaStart === "") {
        alertNegative("Debes ingresar Fecha de inicio");
        return false;
      }
      if (fechaEnd === "") {
        alertNegative("Debes ingresar Fecha final");
        return false;
      }

      $.ajax({
        url: "../controllers/equipoController.php?equipo=informeRecolectoresYFecha",
        type: "POST",
        data: { recolector, fechaStart, fechaEnd },
        beforeSend: function () {
          $("#procesando").show();
        },
      }).done(function (response) {
        $("#procesando").hide();
        var object = JSON.parse(response);
        var templateReport = "";
        if (object[0].result === "1") {
          templateReport = showReportTransit(object);
          $("#data").html(templateReport);
          table();
          $("#more").html("<h4>Recolector " + " " + recolector + " </h4>");
          MostrarTablaOcultarErrorTransito();
        } else {
          alertNegative("No hay datos disponibles para el informe");
          return false;
        }
      })
});

// mostrar transito por fecha
$("#form-negativos").submit(function (e) {
  e.preventDefault();
  let ReciboFechaUno = $("#FechaUno-reporte").val();
  let ReciboFechaDos = $("#FechaDos-reporte").val();

  $.ajax({
    url:
      "../controllers/equipoController.php?equipo=transitoRecolectoresYFecha",
    type: "POST",
    data: { ReciboFechaUno, ReciboFechaDos },
    beforeSend: function () {
      $("#procesando").show();
    },
  }).done(function (response) {

    $("#procesando").hide();
    let object = JSON.parse(response);
    
    let template = "";

    if (object[0].result === "1") {
      countEstadosTransito("", ReciboFechaUno, ReciboFechaDos);

      template = showTransitByCollectorAndDate(object);
      $("#data").html(template);
      table();
      $("#btn-informe").html(
        '<button class="btn btn-danger" id="informeFecha">Informe</button>'
      );
      MostrarTablaOcultarErrorTransito();
    }
    if (object[0].result === "2") {
      MostrarErrorOcultarTablaTransito();
    }
  });
});

// informe por  fecha

$(document).on("click", "#informeFecha", function () {
  var fechaStart = $("#FechaUno-reporte").val();
  var fechaEnd = $("#FechaDos-reporte").val();

  if (fechaStart === "") {
    alertNegative("Debes ingresar Fecha de inicio");
    return false;
  }
  if (fechaEnd === "") {
    alertNegative("Debes ingresar Fecha final");
    return false;
  }

  $.ajax({
    url: "../controllers/equipoController.php?equipo=informeRecolectoresYFecha",
    type: "POST",
    data: { fechaStart, fechaEnd },
    beforeSend: function () {
      $("#procesando").show();
    },
  }).done(function (response) {
    $("#procesando").hide();
    var object = JSON.parse(response);
    var templateReport = "";
    if (object[0].result === "1") {
      templateReport = showReportTransit(object);
      $("#data").html(templateReport);
      table();
      $("#more").html(
        "<h4>Informe " +
          " " +
          fechaStart +
          " " +
          " al " +
          " " +
          fechaEnd +
          " </h4>"
      );
      MostrarTablaOcultarErrorTransito();
    } else {
      alertNegative("No hay datos disponibles para el informe");
      return false;
    }
  });
});

// mostrar gestion de recolectores por fecha

$("#form-detalle-recolectores").submit(function (e) {
  e.preventDefault();
  var fechaStart = $("#fechaUno-reco").val();
  var fechaEnd = $("#fechaDos-reco").val();

  $.ajax({
    url: "../controllers/equipoController.php?equipo=gestionRecolectores",
    type: "POST",
    data: { fechaStart, fechaEnd },
    beforeSend: function () {
      $("#procesando").show();
    },
  }).done(function (response) {
    $("#procesando").hide();
    var object = JSON.parse(response);
    var template = "";
    if ((object[0].result = "1")) {
      template = showReportCollectorManagement(object);
      $("#data").html(template);
      table();
    } else {
      alertNegative("No hay datos disponibles para el informe");
      return false;
    }
  });
});

//mostrar formularios

$("#BuscadorTransito").click(function () {
  seekerTransit();
});

$("#BuscadorRecoFecha").click(function () {
  seekerTransitCollectorAndDate();
});

$("#BuscadorRangoFecha").click(function () {
  seekerRangeDate();
});

$("#BuscadorGeneral").click(function () {
  seekerGeneralBase();
});

$("#BuscadorRangoRecolectores").click(function () {
  seekerGestionCollector();
});


//  enviar remito digital email -----------------

$(document).on('click','#abrirRemitoAdm',function(){

  var getData = this.parentElement;
  var cod = $(getData).attr('cod');
  var telefono = $(getData).attr('telefono')
 
  if(telefono !== null && telefono !== 'null'){
    $('#numeroWats').val(telefono)
  }

  $('#codEmail').val(cod)


   $('#enviarRemito').modal("show")
   veryCountry()

})

$(document).on("click","#btnEnviarRemito",function(){

  var emailDestino = $("#email-remito").val()
  var codCapture = $("#codEmail").val()
  
  if (emailDestino === '') {
    alertNegative('Debes ingresar el email'); return false;
     }

  else if (!(/^[_a-z0-9]+(\.[_a-z0-9]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,15})/i).test(emailDestino)) {

    alertNegative('El email ingresado es invalido'); return false;
  }
  else if (codCapture === '') {

    youMustManageATeam(); return false
  }
  else if($("#modoEmail").val() !== 'remitoRecupero'){

    alertNegative('Actualmente no se puede enviar este remito. Comunique este error a sistemas'); return false;
  }
  else {
    var modo = $("#modoEmail").val()
    $.ajax({
      url: "../helpers/email.php?email=remito",
      type: "POST",
      data: { emailDestino, codCapture, modo },
      beforeSend: function (objeto) {
        $("#subspinner-remito").show()
      },
      success: function (response) {
      
        if (response) {
          var respuestaEmail = JSON.parse(response)
          if (respuestaEmail.result === 1) {
            $("#subspinner-remito").hide()
            $("#closeEnvioRemito").show();
            alertPositive('Email Enviado con exito!');
          }
          if (respuestaEmail.result === 2) {
            $("#subspinner-remito").hide()
            alertNegative('Envio de email rechazado, revise cuidadosamente el email ingresado'); return false
          }
        }
      }
    })
  }
})


// enviar remito por whatsapp

$("#sendWhats").click(function(){
  var numeroWhatsapp = $("#numeroWats").val()
  var numW = numeroWhatsapp.replace(/ /g, "");

  var exNumWAr = numW.substr(0,2)
  var exNumWUr = numW.substr(0,3)
   
  if (numW === '') {
    alertNegative('Debes ingresar el Nro de WhatsApp'); return false
  }else if (!(/^[0-9+]+$/).test(numW)){
  
    alertNegative('Solo se aceptan numeros y el signo +'); return false
  }
  else if (numW.length>14){
    alertNegative('El numero puede tener hasta un máximo de 14 digitos '); return false
  }
  else if($("#id_admin").val()==='Argentina'){
    if (exNumWAr !== '54'){
      alertNegative('Debes incluir el codigo Pais (54) seguido del Número. Ejemplo : 54 5555-7777 '); return false
    } else if (numW.length <10){
      alertNegative('El numero debe tener un minimo de 10 digitos'); return false
    }
    
  }else if ($("#id_admin").val()==='Uruguay'){

    if (exNumWUr !== '598'){
      alertNegative('Debes incluir el codigo Pais (598) seguido del Número. Ejemplo : 598 5555-7777 '); return false
    }
    else if (numW.length <9){
      alertNegative('El numero debe tener un minimo de 9 digitos'); return false
    }

  }
        
        // enviar modo de email por whatsapp
  if($("#modoEmail").val()==='remitoRecupero'){
  
    var urlencodedtext = '*Hola!*%20Para%20descargar%20el%20comprobante:%0a*1)*%20En%20el%20chat%20hac%C3%A9%20click%20en%20*%22a%C3%B1adir%20a%20contactos%22*,%20si%20no%20lo%20visualizas%20podes%20encontrarlo%20en%20*-%3E%20Opciones%20-%3E%20A%C3%B1adir%20a%20contactos.*%20%0a*2)*%20Hace%20click%20en%20el%20siguiente%20link.%0a'+base_url+'equipo/remito%26cd='+ $("#codEmail").val() +'%26tp=rmkcmmownloqwld';
  
    window.open('https://api.whatsapp.com/send?phone='+ numW +'&text=' + urlencodedtext, '_blank');
  }else {
  
    var urlencodedtext = 'Para%20Descargar%20el%20remito%20haga%20*click*%20en%20el%20siguiente%20*enlace*%20'+base_url+'equipo/remito%26cd='+ $("#codEmail").val() +'%26tp=okghvmnatrqzopo'
  
    window.open('https://api.whatsapp.com/send?phone='+ numW +'&text=' + urlencodedtext, '_blank');
  }
  
    
  })

// salir del remito 

$(document).on('click','#equisSalirEnvioRemito,#closeEnvioRemito',function(){

 $('#email-remito').val('')
 $("#enviarRemito").modal('hide')
})

// aviso de visita  y detalles de aviso

$(document).on('click','#detalle-aviso',function(){

  $("#modal_aviso").modal("show")

  var esto = this
  var lat =  $(esto).attr("lat")
  var lng =  $(esto).attr("lng")
  var contacto =  $(esto).attr("contacto")
  var medio =  $(esto).attr("medio")
  var fecha_de_aviso_visita =  $(esto).attr("fecha_de_aviso_visita")
  var name =  $(esto).attr("name")
  var direccion=  $(esto).attr("direccion")
  var provincia=  $(esto).attr("provincia")
  var localidad=  $(esto).attr("localidad")
  var codigo_postal=  $(esto).attr("codigo_postal")

  const datosAviso = {
    lat,
    lng,
    contacto,
    medio,
    fecha_de_aviso_visita,
    name,
    direccion,
    provincia,
    localidad,
    codigo_postal,
  }

  var template = ''
  template = bodyDetalleAviso(datosAviso)
  $("#modal-content-aviso").html(template)

})

// detalle del negativo
$(document).on('click','#detalle-negativo',function(){

  $("#modal_aviso").modal("show")

  var esto = this
  var latGestion =  $(esto).attr("latGestion")
  var lngGestion =  $(esto).attr("lngGestion")
  var name =  $(esto).attr("name")
  var direccion=  $(esto).attr("direccion")
  var provincia=  $(esto).attr("provincia")
  var localidad=  $(esto).attr("localidad")
  var codigo_postal=  $(esto).attr("codigo_postal")

  const datosNegativo = {
    latGestion,
    lngGestion,
    name,
    direccion,
    provincia,
    localidad,
    codigo_postal,
  }

 
  var template = ''
  template = bodyDetalleNegativo(datosNegativo)
  $("#modal-content-aviso").html(template)

})


function bodyDetalleAviso(datosAviso){
 
  var provincia = datosAviso.provincia === '' || datosAviso.provincia === null  || datosAviso.provincia === 'null'? 's/n' : datosAviso.provincia
  var localidad = datosAviso.localidad === '' || datosAviso.localidad === null  || datosAviso.localidad === 'null'? 's/n' : datosAviso.localidad
  var direccion = (datosAviso.direccion === '' || datosAviso.direccion === null || datosAviso.direccion === 'null') ? 's/n' : datosAviso.direccion
  var codigo_postal = datosAviso.codigo_postal === '' || datosAviso.codigo_postal === null || datosAviso.codigo_postal === 'null' ?  's/n' : datosAviso.codigo_postal

  var coordinates = datosAviso.lat+','+datosAviso.lng;

  var html = ''
            html +='<h5>Recolector</h5>';
            html +='<p>'+datosAviso.name+'</p>';
            html +='<h5>Contacto</h5>';
            html +='<p>'+datosAviso.contacto+'</p>';
            html +='<h5>Fecha envio</h5>';
            html +='<p>'+datosAviso.fecha_de_aviso_visita+'</p>';
            html +='<h5>Ubicacion del cliente</h5>';
            html +='<p>'+provincia +' - '+localidad +' - '+direccion+ ' - '+codigo_postal+'</p>';
            html +='<h5>¿Donde fue enviado el aviso?</h5>';
            html += '<div class="d-flex justify-content-center" >';
            html +=' <a class="anclaBtnDetalle my-3 btn btn-danger" href="https://google.com.sa/maps/search/'+coordinates+'" target="_blank" > Mapa  </a> ';
            html += '</div>'

  return html
}

function bodyDetalleNegativo(datosNegativo){
 
  var provincia = datosNegativo.provincia === '' || datosNegativo.provincia === null  || datosNegativo.provincia === 'null'? 's/n' : datosNegativo.provincia
  var localidad = datosNegativo.localidad === '' || datosNegativo.localidad === null  || datosNegativo.localidad === 'null'? 's/n' : datosNegativo.localidad
  var direccion = (datosNegativo.direccion === '' || datosNegativo.direccion === null || datosNegativo.direccion === 'null') ? 's/n' : datosNegativo.direccion
  var codigo_postal = datosNegativo.codigo_postal === '' || datosNegativo.codigo_postal === null || datosNegativo.codigo_postal === 'null' ?  's/n' : datosNegativo.codigo_postal

  var coordinates = datosNegativo.latGestion+','+datosNegativo.lngGestion;

            var html = ''
            html +='<h5>Recolector</h5>';
            html +='<p>'+datosNegativo.name+'</p>';
            html +='<h5>Ubicacion del cliente</h5>';
            html +='<p>'+provincia +' - '+localidad +' - '+direccion+ ' - '+codigo_postal+'</p>';
            html +='<h5>Ubicación al momento de cargar el equipo</h5>';
            html += '<div class="d-flex justify-content-center" >';
            html +='<a class="anclaBtnDetalle my-3 btn btn-danger" href="https://google.com.sa/maps/search/'+coordinates+'" target="_blank" > Mapa  </a>';
            html += '</div>'

  return html


}

function veryCountry(){

  if($("#id_admin").val() === 'Argentina'){
    document.getElementById('numeroWats').placeholder='Obligatorio anteponer el 54 antes del número';
  }else if($("#id_admin").val() === 'Uruguay'){
    document.getElementById('numeroWats').placeholder='Obligatorio anteponer el 598 antes del número';
  }
 

}

function MostrarPanelSeteo() {
  document
    .getElementById("#MostrarPanel")
    .addEventListener("click", function (event) {
      e.preventDefault();
      SeteaPanelGeneral();
    });
}

var panelGeneralDisplay = $("#panel");
function MostrarOcultarPanelGeneral() {
  panelGeneralDisplay.hide();
  panelGeneralDisplayed = false;
}

function SeteaPanelGeneral() {
  panelGeneralDisplay.show();
  panelGeneralDisplayed = true;
}

function Redireccion() {
  $("#mostrarpanel").click(function () {
    location.href = base_url+'usuario/admin';
  });

  $("#inicio").click(function () {
    location.href = base_url;
  });
  $("#cerrar").click(function () {
    location.href = base_url+'config/destroy.php';
  });

  $("#agregarUsuario").click(function () {
    location.href = base_url+'views/admin/?admin=users';
  });
}

// usuarios y postulaciones

function getParameterByName(name) {
  name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
  var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
    results = regex.exec(location.search);
  return results === null
    ? ""
    : decodeURIComponent(results[1].replace(/\+/g, " "));
}

function getNotifications(object) {
  $.ajax({
    url: "../controllers/usuarioController.php?usuario=notificaciones",
    type: "POST",
    data: { object },
    beforeSend: function () {},
  }).done(function (response) { 
    
    var object = JSON.parse(response);


    var template = "";
    template = showNotifications(object);
    
    $("#despliegue-notificacion").html(template);

  });
}

function showNotifications(object) {
  var html = "";

  if(object[0].result !== '2'){

  html += '<div class="header-despliegue" id="header-despliegue">';
  html += "Notificaciones";
  html += "</div> ";

  object.forEach((val) => {

   

    
      html +=
      '<a id="noti" href="'+base_url+'usuario/post&notif_id=' +
      val.id +
      '&sta='+val.status_notifications+'"> ';
    html += '<div class="body-despliegue" tomoDato="' + val.id + '" >';

    if(val.status_process === 'registered'){

    html +="<div class='box-notificacion-user'>";
    html +="<img class='img-user' src='"+base_url+"resources/imgRegister/"+val.imgPerson+"'>";
    html+="</div>";
    
    html +="<div class='box-notificacion-user'>";
     html +="<div class='box-content-data'>";
      html+="<span>"+val.name + " ha enviado una solicitud para<br> <span class='class-rol'>" + val.role + " en "+val.location+' CP: '+val.postal_code+" </span><br><span class='class-date'>"+val.date.substr(0,10)+"</span></span>";
    
  }else if(val.status_process === 'sign_contract'){

    html +="<div class='box-notificacion-user'>";
      html +="<img class='img-user' src='"+base_url+"resources/imgRegister/"+val.imgPerson+"'>";
    html +="</div>";
    html +="<div class='box-notificacion-user'>";
     html +="<div class='box-content-data'>";
       html +="<span>"+ val.name + " tiene contrato pendiente para firmar de <br><span class='class-rol'>" + val.role + "</span><br><span class='class-date'>"+val.date.substr(0,10)+"</span></span>";
     
   
  }else if(val.status_process === 'signed_contract'){

    html +="<div class='box-notificacion-user'>";
      html +="<img class='img-user' src='"+base_url+"resources/imgRegister/"+val.imgPerson+"'>";
    html +="</div>";
    html +="<div class='box-notificacion-user'>";
     html +="<div class='box-content-data'>";
      html +="<span>"+val.name + " ha firmado contrato tipo<br> <span class='class-rol'>" + val.role + " en "+val.location+' CP: '+val.postal_code+"</span><br><span class='class-date'>"+val.date.substr(0,10)+"</span></span>";
     
    
    
  }else if(val.status_process === 'active'){

    html +="<div class='box-notificacion-user'>";
      html +="<img class='img-user' src='"+base_url+"resources/imgRegister/"+val.imgPerson+"'>";
    html +="</div>";
    html +="<div class='box-notificacion-user'>";
     html +="<div class='box-content-data'>";
    html +="<span>"+val.name + " esta activo para trabajar como <br><span class='class-rol'>" + val.role + " en "+val.location+' CP: '+val.postal_code+"</span><br><span class='class-date'>"+val.date.substr(0,10)+"</span></span>";
     
    
  
  }else if(val.status_process === 'down'){
    html +="<div class='box-notificacion-user'>";
    html +="<img class='img-user' src='"+base_url+"resources/imgRegister/"+val.imgPerson+"'>";
    html +="</div>";
    html +="<div class='box-notificacion-user'>";
      html +="<div class='box-content-data'>";
    html +="<span>"+val.name + " ha sido dado de baja como <br><span class='class-rol'>" + val.role + " en "+val.location+' CP: '+val.postal_code+"</span><br><span class='class-date'>"+val.date.substr(0,10)+"</span></span>";
    
      
  }
  if(val.status_notifications === 'nueva'){
    html +='<div class="status-noti"></div>';
  }else if(val.status_notifications === 'leida'){
    html +='<div class=""></div>';
  }
  html +="</div>";
    
    html +="</div>";
    html +='</div>';
    html += "</a>";
    html += "<hr>";
   
    
  });
}else{

  html += '<div class="header-despliegue" id="header-despliegue">';
  html += "Notificaciones";
  html += "<div class='body-despliegue'>";
  html +='Por los momentos no tienes notificaciones en tu zona';
  html += "</div";
  html += "</div";
  html += "</div> ";

}

  return html;
}
function coutNotificacions(object) {
  $.ajax({
    url: "../controllers/usuarioController.php?usuario=cantidadNotificaciones",
    type: "POST",
    data: { object },
    beforeSend: function () {},
  }).done(function (response) {
    var object = JSON.parse(response);
    var template = "";
    if (object[0].result === "1") {
      template = showCountNotifications(object);
      $("#caja-notificacion").html(template);
    } else {
      true;
    }
  });
}

function showCountNotifications(object) {
  var html = "";
  html += '<div class="cajita-notificacion"  >';
  html += '<div  tomoDato="' + object[0].cantidadNotificacion + '"> ';
  html +=
    '<span class="info-bd"> <span class="info-titulo"></span> ' +
    object[0].cantidadNotificacion +
    "<span>";
  html += "</div>";
  html += "</div> ";

  return html;
}

// mostrar usuarios tabla

function getDataUser(object) {
  
  $.ajax({
    url: "../controllers/usuarioController.php?usuario=dataUsers",
    type: "POST",
    data: { object },
    beforeSend: function () {
      $("#loaderUsuarios").show()
      $("#loaderUsuarios").html('<div class="spinner-border text-primary" role="status"><span class="sr-only">Loading...</span></div>')
    },
  }).done(function (response) {
    $("#loaderUsuarios").hide()
    var objectResponse = JSON.parse(response);
    
    var template = "";

    template = showUsers(objectResponse);
    $("#data").html(template);
    tableUser();
  });
}

function setSatusUser(object) {
 
  $.ajax({
    url: "../controllers/usuarioController.php?usuario=statusUser",
    type: "POST",
    data: { object },
    beforeSend: function () {},
  }).done(function (response) {   
    var template = "";
    
    if (response === "1") { 
        if(object.textResponse === 'enviado'){
          sendEmail(object)
        }else if(object.textResponse === 'cancelado'){
          $("#loaderUsuarios").hide()
          alertPositive("Cancelado exitosamente");
          getDataUser(object)
          coutNotificacions($("#id_user_default").val());
        }
        else if(object.stat === 'active'){
          sendEmail(object)
        }else if(object.stat === 'down'){
          sendEmail(object);
          $("#loaderUsuarios").hide();
          $("#modalBaja").modal("hide");
          alertPositive(
            "Usuario dado de baja exitosamente!"
          );
          getDataUser(object);
          coutNotificacions($("#id_user_default").val());
        }
        else{
          $("#loaderUsuarios").hide()
          alertPositive(
            "Ha sido enviado con exito"
          );
        }
    
    } else if (response === "2") { 
      $("#loaderUsuarios").hide()
      alertNegative("No fue posible el envio del contrato'");
    } else {
      $("#loaderUsuarios").hide()
      alertNegative("Error interno en BD'");
    }
  });
}

// ver contrato

function showUsers(object) {
 
  var html = "";
  html += '<div class="table-responsive" id="informe">';
  html +=
    '<table class="table table-striped table-bordered" cellspacing="0" width="100%" id="example">';
  html += " <thead>";
  html += "<tr>";
  html += "<th>Estado</th>";
  html += "<th>Accion</th>";

  html += "<th class='alert alert-primary'>Tipo </th>";
  html += "<th class='alert alert-danger' >Cp </th>";
  html += "<th class='alert alert-warning' >Localidad </th>";
  html += "<th>Prov </th>";

  html += "<th>Domicilio </th>";
  html += "<th>Pais </th>";
  html += "<th>id </th>";
  html += "<th>Nombre </th>";
  html += "<th>Correo </th>";
  html +='<th>Ver mas</th>';
  // html += "<th class='alert alert-danger'>Monotributo </th>";
  html += "<th>Contrato</th>";
  html +="<th>Movilidad / Herramienta </th>";
  html += "<th>fecha gestión </th>";
  html += "<th>Nro Documento </th>";
  
  
  html +='<th>Coordinador/a Gestión</th>';

  html += "<th>Tel Movil </th>";
 
  html += "<th>Cbu </th>";
  html += "<th>Cuit </th>";
  html += "<th>Banco </th>";
  html += "<th>fecha firma </th>";
  html += "<th>Como Conocio </th>";
  html += "<th>Marca vehiculo </th>";
  html += "<th>Modelo vehiculo </th>";
  html += "<th>Patente </th>";
  html += "<th>Motivo gestion</th>";
  html += "<th>Detalle</th>";
 

  html += " </tr>";
  html += "</thead>";
  html += "<tbody>";

  object.forEach((val) => {
    html += "<tr>";

    // estado

    if (val.estado === "first") {
      html += "<td><strong>Falta confirmar email</strong></td>";
    } else if (val.estado === "registered") {
      html += "<td><strong>Esperando recibir contrato</strong></td>";
    } else if (val.estado === "sign_contract") {
      html += "<td><strong>En espera que firme contrato</strong></td>";
    } else if (val.estado === "signed_contract") {
      html += "<td><strong>En espera de alta</strong></td>";
    } else if (val.estado === "active") {
      html += "<td><strong>Activo</strong></td>";
    } else if (val.estado === "cancel") {
      html += "<td><strong>Cancelado</strong></td>";
    } else if (val.estado === "down") {
      html += "<td><strong>Dado de baja</strong></td>";
    }

    // Accion usuario

    

    if (val.estado === "first") {
      html += "<td><strong>Falta confirmar email</strong></td>";
    } else if (val.estado === "registered") {
      html +=
        '<td idmail="' +
        val.mailh +'" id_number="' +val.nroDoc +'" mail="' +val.correo +
        '" id_user="'+val.id+'" nombre="'+val.nombre+'" ><button id="enviarContrato" class="btn btn-danger" >Enviar Contrato</button></td>';
    } else if (val.estado === "sign_contract") {
      html +=
        '<td idmail="' +
        val.mailh +
        '" id_number="' +
        val.nroDoc +
        '" mail="' +
        val.correo +
        '"><button class="btn btn-danger" id="cancelarContrato" >Cancelar envio de contrato</button></td>';
    } else if (val.estado === "signed_contract") {
      html += '<td idmail="' +
      val.mailh +'" id_number="' +val.nroDoc +'" mail="' +val.correo +
      '" id_user="'+val.id+'" nombre="'+val.nombre+'"  "><button class="btn btn-success" id="alta" >Dar Alta</button></td>';
    } else if (val.estado === "active") {
      
      html += '<td idmail="' +
      val.mailh +
      '" id_number="' +
      val.nroDoc +
      '" mail="' +
      val.correo +
      '"><button class="btn btn-danger" id="baja">Dar Baja</button></td>';

    } else if (val.estado === "cancel") {
      html +=
        '<td idmail="' +
        val.mailh +'" id_number="' +val.nroDoc +'" mail="' +val.correo +
        '" id_user="'+val.id+'" nombre="'+val.nombre+'" ><button id="enviarContrato" class="btn btn-danger" >Enviar Contrato</button></td>';
    } else if (val.estado === "down") {
      html +=
        '<td idmail="' +
        val.mailh +
        '" id_number="' +
        val.nroDoc +
        '" mail="' +
        val.correo +
        '"><button class="btn btn-warning" id="volverAlta" >Volver a dar Alta</button></td>';
    }

    // Accion admin
    

    // html+='<td>'+val.estado+ '</td>';

    //tipo de usuario

    val.tipoUsuario !== null
    ?html += "<td class='alert alert-primary'><strong>" + val.tipoUsuario  + "</strong></td>"
    :html += "<td class='alert alert-primary'></td>";

    //cp

    val.cp !== null
    ?html += "<td class='alert alert-danger'><strong>" + val.cp  + "</strong></td>"
    :html += "<td class='alert alert-danger'></td>";

    //localidad

    val.localidad !== null
    ?html += "<td class='alert alert-warning'><strong>" + val.localidad  + "</strong></td>"
    :html += "<td class='alert alert-warning'></td>";


    //provincia

    val.provincia !== null
    ?html += "<td ><strong>" + val.provincia  + "</strong></td>"
    :html += "<td ></td>";

     //domicilio

     val.domicilio !== null
     ?html += "<td ><strong>" + val.domicilio  + "</strong></td>"
     :html += "<td ></td>";

    //pais

    val.pais !== null
    ?html += "<td ><strong>" + val.pais  + "</strong></td>"
    :html += "<td ></td>";
    

    html += "<td class='alert alert-info'><strong>" + val.id + "</strong></td>";
    
    html += "<td>" + val.nombre + "</td>";
    
    //correo 
    html += "<td class='alert alert-light'><strong>" + val.correo + "</strong></td>";

    //ver datos

    html += "<td class='alert alert-dark' ><a class='btn btn-dark' id='noti' href='"+base_url+'usuario/post&notif_id=' +
    val.id +
    '&sta='+val.status_notifications+"'>Fotos / Info</a></td>";

    //monotributo

    // if(val.monotributo === 'si' ){
    //   html += "<td class='alert alert-danger'><strong>" + val.monotributo + "</strong></td>";
    // }else if(val.monotributo === 'no' &&  val.estado !== 'first'){
    //   html += '<td class="alert alert-danger"> <a href="'+base_url+'/usuario/post&notif_id='+val.id+
    //   '&sta='+val.status_notifications+'"><button class="btn btn-danger" > No tiene - (Actualizar foto Monotributo</button></a></td>';
    // }else{
    //   html += "<td class='alert alert-danger'><strong>En proceso </strong></td>";
    // }
    
    //contrato

    if (val.estado === "first") {
      html += "<td>Validando email</td>";
    } else if (val.estado === "registered") {
      html +=
        '<td>En proceso</td>';
    } else if (val.estado === "sign_contract") {
      html +=
        '<td> <a href="'+base_url+'/usuario/showContract&mh='+val.mailh+'&idc='+val.nroDoc+'" target="_blank"><button id="verContrato" class="btn btn-success" >Ver Contrato</button></a></td>';
    } else if (val.estado === "signed_contract") {
      html +=
        '<td> <a href="'+base_url+'/usuario/showContract&mh='+val.mailh+'&idc='+val.nroDoc+'" target="_blank"><button id="verContrato" class="btn btn-success" >Ver Contrato</button></a></td>';
    } else if (val.estado === "active") {
      html +=
        '<td> <a href="'+base_url+'/usuario/showContract&mh='+val.mailh+'&idc='+val.nroDoc+'" target="_blank"><button id="verContrato" class="btn btn-success" >Ver Contrato</button></a></td>';
    } else if (val.estado === "cancel") {
      html +=
        '<td>Contrato cancelado</td>';
    } else if (val.estado === "down") {
      html +=
        '<td> <a href="'+base_url+'/usuario/showContract&mh='+val.mailh+'&idc='+val.nroDoc+'" target="_blank"><button id="verContrato" class="btn btn-success" >Ver Contrato</button></a></td>';
    }
    html+="<td>"+val.tipoDeSolicitud+"</td>";
    html += "<td>" + val.momento+ "</td>";
    html += "<td>" + val.nroDoc + "</td>";

    html += "<td>" + val.id_managent + "</td>";
    
    html += "<td>" + val.telMovil + "</td>";
    
    html += "<td>" + val.cbu + "</td>";
    html += "<td>" + val.cuit + "</td>";
    html += "<td>" + val.banco + "</td>";
    html += "<td>" + val.signed_date + "</td>";
   
    html += "<td>" + val.comoConocio + "</td>";
    html += "<td>" + val.vehicle_brand + "</td>";
    html += "<td>" + val.vehicle_model + "</td>";
    html += "<td>" + val.patent + "</td>";
    if(val.motivo !== null){
      html += "<td>" + val.motivo + "</td>";
      html += "<td>" + val.descripcion + "</td>";
    }else{
      html += "<td></td>";
      html += "<td></td>";
    }
    
    html += "</tr>";
  });

  html += "</tbody>";
  html += "</table>";
  html += "</div>";

  return html;
}

function showAll() {
  var key = "all";

  $.ajax({
    url: "../controllers/usuarioController.php?usuario=dataUsers",
    type: "POST",
    data: { key },
    beforeSend: function () {
      $("#loaderUsuarios").show()
      $("#loaderUsuarios").html('<div class="spinner-border text-primary" role="status"><span class="sr-only">Loading...</span></div>')
    },
  }).done(function (response) {
    $("#loaderUsuarios").hide()
    var object = JSON.parse(response);
    var template = "";
    if (object[0].result === "1") {
      template = showUsers(object);
      $("#data").html(template);
      tableUser();
    } else if (object[0].result === "2") {
      alertNegative("no existe");
    }
  });
}

// enviar correo

function confirm(object) {
  

      Swal.fire({
        title: object.tittle,
        text: object.text,
        icon: object.icon,
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: object.confirmButton,
      }).then((result) => {   
        if (result.isConfirmed) { 
          $("#loaderUsuarios").show()
          $("#loaderUsuarios").html('<div class="spinner-border text-danger" role="status"><span class="sr-only">Loading...</span></div>')
    
          if(object.stat === 'sign_contract'){
            setSatusUser(object)
          }else if(object.action === 'mensajeProntoActivo'){
            sendEmail(object);
          }else if(object.action === 'contratoEnviado'){
            sendEmail(object);
          }
            else if(object.stat === 'active'){
              setSatusUser(object)
            }else if (object.stat=== 'otroAvisoActivo'){
              sendEmail(object);
            }else if(object.stat=== 'down'){
              setSatusUser(object)
            }
      }
    })
}


function sendEmail(object)
 {

  $.ajax({ 
    url: "../helpers/email.php?email=" + object.method + "",
    type: "POST",
    data: {object},
    beforeSend: function () {},
  }).done(function (response) {   
    $("#loaderUsuarios").hide()
    var objectResponse = JSON.parse(response);
    if (objectResponse.result === "1") { 

      if(object.stat === 'sign_contract'){
          getDataUser(object)
          alertPositive("Contrato enviado exitosamente");
          coutNotificacions($("#id_user_default").val());
      }else if(object.stat === 'aviso'){
        alertPositive("Enviado con exito");
      }else if(object.stat === 'active'){
        alertPositive("Dado de alta exitosamente. El postulante recibio alerta por correo eléctronico");
        getDataUser(object)
        coutNotificacions($("#id_user_default").val());
      }else if (object.stat=== 'otroAvisoActivo'){
        alertPositive("Enviado exitosamente!");
      }else if(object.stat=== 'avisoEnviado'){
        alertPositive("Enviado exitosamente!");

      }else if(object.stat=== 'down'){
        alertPositive("Enviado correctamente!");

      }
    } else if (objectResponse.result === "2") { 
      alertPositive("error al enviar mail");
    } else {
      alertPositive("Super error");
    }
  });
}

// MOSTRAR TODA LA INFO

function searchDataInBase(BuscarDato) {
  $.ajax({
    url: "../controllers/equipoController.php?equipo=clienteEnBase",
    type: "POST",
    data: { BuscarDato },
    beforeSend: function () {
      $("#procesando").show();
    },
  }).done(function (response) {
    $("#procesando").hide();
    let object = JSON.parse(response);
    let template = "";

    if (object[0].result === "1") {
      MostrarTablaOcultarErrorEnBase();

      var valorIngresado = object[0].identificacion;
      var conviertoenMayus = valorIngresado.toUpperCase();
      var sacoIniciales = conviertoenMayus.substr(0, 2);

      if (sacoIniciales === "PS") {
        template = showClientDifferent(object);

        $("#data").html(template);
        table();
      }

      if (sacoIniciales !== "PS") {
        template = showClientNormal(object);

        $("#data").html(template);
        table();
      }
    }
    if (object[0].result !== "1") {
      MostrarErrorOcultarTablaEnBase();
    }
  });
}

function showClientDifferent(object) {
  var html = "";
  html += '<div class="table-responsive" id="informe">';
  html +=
    '<table class="table table-striped table-bordered" cellspacing="0" width="100%" id="example">';

  html += "<thead>";
  html += "<tr>";
  html += '<th scope="col"> Identificacion </th>';
  html += '<th scope="col"> Estado </th>';
  html += '<th scope="col"> Empresa </th>';
  html += '<th scope="col"> Terminal </th>';
  html += '<th scope="col"> Serie </th>';
  html += '<th scope="col"> Serie Base </th>';
  html += '<th scope="col"> Tarjeta </th>';
  html += '<th scope="col"> C.Telefonico </th>';
  html += '<th scope="col"> Cargador </th>';
  html += '<th scope="col"> Fuente </th>';
  html += '<th scope="col"> Base </th>';
  html += '<th scope="col"> Nombre </th>';
  html += '<th scope="col"> Direccion </th>';
  html += '<th scope="col"> Provincia </th>';
  html += '<th scope="col"> Localidad </th>';
  html += '<th scope="col"> CP </th>';
  html += "</tr>";
  html += "</thead>";
  html += "<tbody>";

  object.forEach((val) => {
    html += "<tr>";
    html += "<td>" + val.identificacion + "</td>";
    val.estadoRec === null
      ? (html += "<td></td>")
      : (html += "<td>" + val.estadoRec + "</td>");
    html += "<td>" + val.empresa + "</td>";
    html += "<td>" + val.terminal + "</td>";
    html += "<td>" + val.serie + "</td>";
    html += "<td>" + val.serie_base + "</td>";
    html += "<td>" + val.tarjeta + "</td>";
    html += "<td>" + val.cableHdmi + "</td>";
    html += "<td>" + val.cableAv + "</td>";
    html += "<td>" + val.fuente + "</td>";
    html += "<td>" + val.control + "</td>";
    html += "<td>" + val.nombreCliente + "</td>";
    html += "<td>" + val.direccion + "</td>";
    html += "<td>" + val.provincia + "</td>";
    html += "<td>" + val.localidad + "</td>";
    html += "<td>" + val.codigoPostal + "</td>";
    html += "</tr>";
  });
  html += "</tbody>";
  html += "</table>";
  html += "</div>";
  return html;
}

function showClientNormal(object) {
  var html = "";
  html += '<div class="table-responsive" id="informe">';
  html +=
    '<table class="table table-striped table-bordered" cellspacing="0" width="100%" id="example">';
  html += "<thead>";
  html += "<tr>";
  html += '<th scope="col"> Identificacion </th>';
  html += '<th scope="col"> Estado </th>';
  html += '<th scope="col"> Empresa </th>';
  html += '<th scope="col"> Terminal </th>';
  html += '<th scope="col"> Serie </th>';
  html += '<th scope="col"> Tarjeta </th>';
  html += '<th scope="col"> HDMI</th>';
  html += '<th scope="col"> AV </th>';
  html += '<th scope="col"> Fuente</th>';
  html += '<th scope="col"> Control </th>';
  html += '<th scope="col"> Nombre </th>';
  html += '<th scope="col"> Direccion </th>';
  html += '<th scope="col"> Provincia </th>';
  html += '<th scope="col"> Localidad </th>';
  html += '<th scope="col"> CP </th>';
  html += "</tr>";
  html += "</thead>";
  html += "<tbody>";
  object.forEach((val) => {
    html += "<tr>";
    html += "<td>" + val.identificacion + "</td>";
    val.estadoRec === null
      ? (html += "<td></td>")
      : (html += "<td>" + val.estadoRec + "</td>");
    html += "<td>" + val.empresa + "</td>";
    html += "<td>" + val.terminal + "</td>";
    html += "<td>" + val.serie + "</td>";

    html += "<td>" + val.tarjeta + "</td>";
    html += "<td>" + val.cableHdmi + "</td>";
    html += "<td>" + val.cableAv + "</td>";
    html += "<td>" + val.fuente + "</td>";
    html += "<td>" + val.control + "</td>";
    html += "<td>" + val.nombreCliente + "</td>";
    html += "<td>" + val.direccion + "</td>";
    html += "<td>" + val.provincia + "</td>";
    html += "<td>" + val.localidad + "</td>";
    html += "<td>" + val.codigoPostal + "</td>";
    html += "</tr>";
  });
  html += "</tbody>";
  html += "</table>";
  html += "</div>";
  return html;
}

function searchDataInTransit(object) {
  $.ajax({
    url: "../controllers/equipoController.php?equipo=transito",
    type: "POST",
    data: { object },
    beforeSend: function () {
      $("#procesando").show();
    },
  }).done(function (response) {
    $("#procesando").hide();

    var object = JSON.parse(response);

    var template = "";

    if (object[0].result === "1") {
      countEstadosCustomer(object[0].identificacion);

      MostrarTablaOcultarErrorTransitoPorCliente();

      var valorIngresado = object[0].identificacion;
      var conviertoenMayus = valorIngresado.toUpperCase();
      var sacoIniciales = conviertoenMayus.substr(0, 2);

      if (sacoIniciales === "PS") {
        template = showDifferentTransito(object);
        $("#data").html(template);
        table();
      }
      if (sacoIniciales !== "PS") {
        template = showNormalTransito(object);
        $("#data").html(template);
        table();
      }
    }
    if (object[0].result === "2") {
      MostrarErrorOcultarTablaTransito();
    }
  });
}

function countEstadosCustomer(object) {
  $.ajax({
    url: "../controllers/equipoController.php?equipo=countStatusCustomer",
    type: "POST",
    data: { object },
    beforeSend: function () {
      $("#procesando").show();
    },
  }).done(function (response) {
    $("#procesando").hide();
    var objectCount = JSON.parse(response);
    var templateCount = "";
    if (objectCount[0].result === "count") {
      templateCount = showEstados(objectCount);
      $("#detalle").html(templateCount);
    } else if (objectCount[0].result === "2") {
      true;
    }
  });
}

function countEstadosTransito(object, ReciboFechaUno, ReciboFechaDos) {
  $.ajax({
    url: "../controllers/equipoController.php?equipo=countStatusTransit",
    type: "POST",
    data: { object, ReciboFechaUno, ReciboFechaDos },
    beforeSend: function () {
      $("#procesando").show();
    },
  }).done(function (response) {
    $("#procesando").hide();
    var objectCount = JSON.parse(response);
    var templateCount = "";

    if (objectCount[0].result === "count") {
      templateCount = showEstados(objectCount);
      $("#detalle").html(templateCount);
    } else {
      true;
    }
  });
}

function showEstados(objectCount) {

  
  var html = "";

  objectCount.forEach((val) => {
    html += '<div class="contenedor-count">';
    html +=
      '<span class="count" style="font-weight:bold;" estado="'+val.estado+'">' +
      " " +
      val.cantidadEstado +
      " " +
      val.estado +
      " " +
      "</span> ";
    html += "</div>";
  });
  return html;
}

function showDifferentTransito(object) {
  var html = "";
  html += '<div class="table-responsive" id="informe">';
  html +=
    '<table class="table table-striped table-bordered" cellspacing="0" width="100%" id="example">';
  html += "<thead>";
  html += "<tr>";

  html += '<th scope="col"> Aviso </th>';
  html += '<th scope="col">Detalle</th>';
  html += '<th scope="col"> Identificacion </th>';
  html += '<th scope="col"> Estado </th>';
  html += '<th scope="col"> Empresa </th>';
  html += '<th scope="col"> Terminal </th>';
  html += '<th scope="col"> Serie </th>';
  html += '<th scope="col"> Orden </th>';
  html += '<th scope="col"> ID Recolector </th>';
  html += '<th scope="col"> Recolector </th>';
  html += '<th scope="col"> Serie Base</th>';
  html += '<th scope="col"> Tarjeta </th>';
  html += '<th scope="col"> Sim alt </th>';
  html += '<th scope="col"> C.Telefonico </th>';
  html += '<th scope="col"> Sim card </th>';
  html += '<th scope="col"> Cargador </th>';
  html += '<th scope="col"> Base </th>';
  html += '<th scope="col"> Motivo </th>';
  html += '<th scope="col"> Fecha </th>';
  html += '<th scope="col"> Nombre </th>';
  html += '<th scope="col"> Direccion </th>';
  html += '<th scope="col"> Provincia </th>';
  html += '<th scope="col"> Localidad </th>';
  html += '<th scope="col"> Codigo Postal</th>';
  html += '<th scope="col"> Remito </th>';
  html += '<th scope="col"> Ver </th>';
  html += '<th scope="col"> Accion</th>';
  
  html += "</tr>";
  html += "</thead>";
  html += "<tbody>";

  object.forEach((val) => {
    html += "<tr>";

   
    if(val.means !== '' && val.means !== null){
      html += "<td>Si</td>";
    }else{
      html += "<td>No</td>";
    }

    if(val.means !== '' && val.means !== null){
        if(val.lat !== '' && val.lat !== null && val.lng !== '' && val.lng !== null){
          html += "<td><button class='btn btn-danger' id='detalle-aviso' lat='"+val.lat+"' lng='"+val.lng+"' contacto='"+val.contacto+"' medio='"+val.means+"' fecha_de_aviso_visita='"+val.fecha_aviso_visita+"' name='"+val.name+"' direccion='"+val.direccion+"' provincia='"+val.provincia+"' localidad='"+val.localidad+"' codigo_postal='"+val.codigo_postal+"' > Detalle </button></td>";
        }else{
          html += "<td>Sin Detalle </td>";
        }
    }else{
      if(val.latGestion == '' && val.lngGestion === ''){
        html += "<td>Sin detalle</td>"
      }else{
        if(val.lat !== '' && val.lat !== null && val.lng !== '' && val.lng !== null){

        html += "<td><button  latGestion='"+val.latGestion+"' lngGestion='"+val.lngGestion+"' direccion='"+val.direccion+"' provincia='"+val.provincia+"' localidad='"+val.localidad+"' codigo_postal='"+val.codigo_postal+"' name='"+val.name+"'  id='detalle-negativo' class='btn btn-danger'>Detalle de gestion</button></td>"
        }else{
          html += "<td>Sin detalle</td>"
        }
      }
     
     
    }
    
    html += "<td>" + val.identificacion + "</td>";

    val.estado === null
      ? (html += "<td></td>")
      : (html += "<td><strong>" + val.estado + "</strong></td>");
    html += "<td>" + val.empresa + "</td>";
    html += "<td>" + val.terminal + "</td>";
    html += "<td>" + val.serie + "</td>";
    html += "<td><strong>" + val.orden + "</strong></td>";
    html += "<td>" + val.recolector + "</td>";
    html += "<td>" + val.name + "</td>";
    html += "<td>" + val.serie_base + "</td>";
    html += "<td>" + val.tarjeta + "</td>";
    html += "<td>" + val.chip_alternativo + "</td>";
    html += "<td>" + val.accesorio_uno + "</td>";
    html += "<td>" + val.accesorio_dos + "</td>";
    html += "<td>" + val.accesorio_tres + "</td>";
    html += "<td>" + val.accesorio_cuatro + "</td>";
    html += "<td>" + val.motivo + "</td>";
    html += "<td>" + val.created_at + "</td>";
    html += "<td>" + val.nombre_cliente + "</td>";
    html += "<td>" + val.direccion + "</td>";
    html += "<td>" + val.provincia + "</td>";
    html += "<td>" + val.localidad + "</td>";
    html += "<td>" + val.codigo_postal + "</td>";
    if(val.estado ==='RECUPERADO' || val.estado ==='AUTORIZAR' ){

      html += "<td cod='"+val.remito+"' telefono='"+val.telefono+"' ><button id='abrirRemitoAdm'  class='btn btn-primary'> Enviar remito</button></td>";
      html += "<td><a href='"+base_url+"equipo/remito&cd="+val.remito+"&tp=rmkcmmownloqwld' target='_blank' ><button  class='btn btn-warning'> Ver remito</button></a> </td>";
    }else{
      html += "<td>" + val.remito + "</td>";
      html += "<td></td>";
    }

    if(val.estado !== 'AUTORIZAR'){
      html +=
      "<td id_transito='" +
      val.id +
      "' id_equipo='" +
      val.id_equipo +
      "' identificacion='" +
      val.identificacion +
      "' serie='" +
      val.serie +
      "' terminal='" +
      val.terminal +
      "'  accesorio_uno='" +
      val.accesorio_uno +
      "' accesorio_dos='" +
      val.accesorio_dos +
      "' accesorio_tres='" +
      val.accesorio_tres +
      "' accesorio_cuatro='" +
      val.accesorio_cuatro +
      "' estado='" +
      val.estado +
      "'><button id='delete-equipment'  class='btn btn-danger btn-gestion' >Eliminar</button><button id='edit-equipment' id_transito='" +
      val.id +
      "' id_equipo='" +
      val.id_equipo +
      "' class='btn btn-success' >Editar</button></td>";
    }else{
      html += "<td></td>";

    }
    
  });
  html += "</tbody>";
  html += "</table>";
  return html;
}

function showNormalTransito(object) {
  var html = "";
  html += '<div class="table-responsive" id="informe">';
  html +=
    '<table class="table table-striped table-bordered" cellspacing="0" width="100%" id="example">';
  html += "<thead>";
  html += "<tr>";

  html += '<th scope="col"> Aviso </th>';
  html += '<th scope="col">Detalle</th>';
  html += '<th scope="col"> Identificacion </th>';
  html += '<th scope="col"> Estado </th>';
  html += '<th scope="col"> Empresa </th>';
  html += '<th scope="col"> Terminal </th>';
  html += '<th scope="col"> Serie </th>';
  html += '<th scope="col"> Orden </th>';
  
  html += '<th scope="col"> ID Recolector </th>';
  html += '<th scope="col"> Recolector </th>';

  html += '<th scope="col"> Tarjeta </th>';

  html += '<th scope="col"> HDMI </th>';
  html += '<th scope="col"> AV </th>';
  html += '<th scope="col"> Fuente </th>';
  html += '<th scope="col"> Control </th>';

  html += '<th scope="col"> Fecha </th>';
  html += '<th scope="col"> Nombre </th>';
  html += '<th scope="col"> Direccion </th>';
  html += '<th scope="col"> Provincia </th>';
  html += '<th scope="col"> Localidad </th>';
  html += '<th scope="col"> Codigo Postal</th>';
  html += '<th scope="col"> Remito </th>';
  html += '<th scope="col"> Ver </th>';
  html += '<th scope="col"> Accion </th>';
  
  html += "</tr>";
  html += "</thead>";
  html += "<tbody>";

  object.forEach((val) => {
    html += "<tr>";

    if(val.means !== '' && val.means !== null){
      html += "<td>Si</td>";
    }else{
      html += "<td>No</td>";
    }

    if(val.means !== '' && val.means !== null){
        if(val.lat !== '' && val.lat !== null && val.lng !== '' && val.lng !== null){
          html += "<td><button class='btn btn-danger' id='detalle-aviso' lat='"+val.lat+"' lng='"+val.lng+"' contacto='"+val.contacto+"' medio='"+val.means+"' fecha_de_aviso_visita='"+val.fecha_aviso_visita+"' name='"+val.name+"' direccion='"+val.direccion+"' provincia='"+val.provincia+"' localidad='"+val.localidad+"' codigo_postal='"+val.codigo_postal+"' > Detalle </button></td>";
        }else{
          html += "<td>Sin Detalle </td>";
        }
    }else{
      if(val.latGestion == '' && val.lngGestion === ''){
        html += "<td>Sin detalle</td>"
      }else{
        if(val.lat !== '' && val.lat !== null && val.lng !== '' && val.lng !== null){

        html += "<td><button  latGestion='"+val.latGestion+"' lngGestion='"+val.lngGestion+"' direccion='"+val.direccion+"' provincia='"+val.provincia+"' localidad='"+val.localidad+"' codigo_postal='"+val.codigo_postal+"' name='"+val.name+"'  id='detalle-negativo' class='btn btn-danger'>Detalle de gestion</button></td>"
        }else{
          html += "<td>Sin detalle</td>"
        }
      }
     
     
    }

    html += "<td>" + val.identificacion + "</td>";
    
    val.estado === null
      ? (html += "<td></td>")
      : (html += "<td><strong>" + val.estado + "</strong></td>");
    html += "<td>" + val.empresa + "</td>";
    html += "<td>" + val.terminal + "</td>";
    html += "<td>" + val.serie + "</td>";
    html += "<td><strong>" + val.orden + "</strong></td>";
    html += "<td>" + val.recolector + "</td>";
    html += "<td>" + val.name + "</td>";
    html += "<td>" + val.tarjeta + "</td>";
    html += "<td>" + val.accesorio_uno + "</td>";
    html += "<td>" + val.accesorio_dos + "</td>";
    html += "<td>" + val.accesorio_tres + "</td>";
    html += "<td>" + val.accesorio_cuatro + "</td>";
    html += "<td>" + val.created_at + "</td>";
    html += "<td>" + val.nombre_cliente + "</td>";
    html += "<td>" + val.direccion + "</td>";
    html += "<td>" + val.provincia + "</td>";
    html += "<td>" + val.localidad + "</td>";
    html += "<td>" + val.codigo_postal + "</td>";
    if(val.estado ==='RECUPERADO' || val.estado ==='AUTORIZAR' ){

      html += "<td cod='"+val.remito+"' telefono='"+val.telefono+"' ><button id='abrirRemitoAdm'  class='btn btn-primary'> Enviar remito</button></td>";
      html += "<td><a href='"+base_url+"equipo/remito&cd="+val.remito+"&tp=rmkcmmownloqwld' target='_blank' ><button  class='btn btn-warning'> Ver remito</button></a> </td>";
    }else{
      html += "<td>" + val.remito + "</td>";
      html += "<td></td>";
    }

    if(val.estado !== 'AUTORIZAR'){
      html +=
      "<td id_transito='" +
      val.id +
      "' id_equipo='" +
      val.id_equipo +
      "' identificacion='" +
      val.identificacion +
      "' serie='" +
      val.serie +
      "' terminal='" +
      val.terminal +
      "'  accesorio_uno='" +
      val.accesorio_uno +
      "' accesorio_dos='" +
      val.accesorio_dos +
      "' accesorio_tres='" +
      val.accesorio_tres +
      "' accesorio_cuatro='" +
      val.accesorio_cuatro +
      "' estado='" +
      val.estado +
      "'><button id='delete-equipment'  class='btn btn-danger btn-gestion' >Eliminar</button><button id='edit-equipment' id_transito='" +
      val.id +
      "' id_equipo='" +
      val.id_equipo +
      "' class='btn btn-success' >Editar</button></td>";
    }else{
      html += "<td></td>";

    }
    
    html += "</tr>";
  });

  html += "</tbody>";
  html += "</table>";
  html += "</div>";

  return html;
}

function showTransitByCollectorAndDate(object) {
  var html = "";

  html += '<div class="table-responsive" id="informe">';
  html +=
    '<table class="table table-striped table-bordered" cellspacing="0" width="100%" id="example">';
  html += "<thead>";
  html += "<tr>";
  html += '<th scope="col"> Aviso </th>';
  html += '<th scope="col"> Detalle</th>';
  html += '<th scope="col"> Identificacion </th>';
  html += '<th scope="col"> Estado </th>';
  html += '<th scope="col"> Empresa </th>';
  html += '<th scope="col"> Terminal </th>';
  html += '<th scope="col"> Serie </th>';
  html += '<th scope="col"> Orden </th>';
  html += '<th scope="col"> ID Recolector </th>';
  html += '<th scope="col"> Recolector </th>';
  html += '<th scope="col"> Serie Base</th>';
  html += '<th scope="col"> Tarjeta </th>';
  html += '<th scope="col"> Sim alt </th>';
  html += '<th scope="col"> C.Telefonico / Hdmi </th>';
  html += '<th scope="col"> Sim card / Av </th>';
  html += '<th scope="col"> Cargador / Fuente </th>';
  html += '<th scope="col"> Base / Control </th>';
  html += '<th scope="col"> Motivo </th>';
  html += '<th scope="col"> Fecha </th>';
  html += '<th scope="col"> Nombre </th>';
  html += '<th scope="col"> Direccion </th>';
  html += '<th scope="col"> Provincia </th>';
  html += '<th scope="col"> Localidad </th>';
  html += '<th scope="col"> Codigo Postal</th>';
  html += '<th scope="col"> Remito </th>';
  html += "</tr>";
  html += "</thead>";
  html += "<tbody>";

  object.forEach((val) => {
    if (val.result !== "count") {
      html += "<tr>";

      if(val.means !== '' && val.means !== null){
        html += "<td>Si</td>";
      }else{
        html += "<td>No</td>";
      }
  
      if(val.means !== '' && val.means !== null){
          if(val.lat !== '' && val.lat !== null && val.lng !== '' && val.lng !== null){
            html += "<td><button class='btn btn-danger' id='detalle-aviso' lat='"+val.lat+"' lng='"+val.lng+"' contacto='"+val.contacto+"' medio='"+val.means+"' fecha_de_aviso_visita='"+val.fecha_aviso_visita+"' name='"+val.name+"' direccion='"+val.direccion+"' provincia='"+val.provincia+"' localidad='"+val.localidad+"' codigo_postal='"+val.codigo_postal+"' > Detalle </button></td>";
          }else{
            html += "<td>Sin Detalle </td>";
          }
      }else{
        if(val.latGestion == '' && val.lngGestion === ''){
          html += "<td>Sin detalle</td>"
        }else{
          if(val.lat !== '' && val.lat !== null && val.lng !== '' && val.lng !== null){
  
          html += "<td><button  latGestion='"+val.latGestion+"' lngGestion='"+val.lngGestion+"' direccion='"+val.direccion+"' provincia='"+val.provincia+"' localidad='"+val.localidad+"' codigo_postal='"+val.codigo_postal+"' name='"+val.name+"'  id='detalle-negativo' class='btn btn-danger'>Detalle de gestion</button></td>"
          }else{
            html += "<td>Sin detalle</td>"
          }
        }
       
       
      }

      html += "<td>" + val.identificacion + "</td>";
      val.estado === null
        ? (html += "<td></td>")
        : (html += "<td><strong>" + val.estado + "</strong></td>");
      html += "<td>" + val.empresa + "</td>";
      html += "<td>" + val.terminal + "</td>";
      html += "<td>" + val.serie + "</td>";
      html += "<td>" + val.orden + "</td>";
      html += "<td>" + val.recolector + "</td>";
      html += "<td>" + val.name + "</td>";
      val.serie_base === null
        ? (html += "<td></td>")
        : (html += "<td>" + val.serie_base + "</td>");
      html += "<td>" + val.tarjeta + "</td>";
      val.chip_alternativo === null
        ? (html += "<td></td>")
        : (html += "<td>" + val.chip_alternativo + "</td>");
      html += "<td>" + val.accesorio_uno + "</td>";
      html += "<td>" + val.accesorio_dos + "</td>";
      html += "<td>" + val.accesorio_tres + "</td>";
      html += "<td>" + val.accesorio_cuatro + "</td>";
      val.motivo === null
        ? (html += "<td></td>")
        : (html += "<td>" + val.motivo + "</td>");
      html += "<td>" + val.created_at + "</td>";
      html += "<td>" + val.nombre_cliente + "</td>";
      html += "<td>" + val.direccion + "</td>";
      html += "<td>" + val.provincia + "</td>";
      html += "<td>" + val.localidad + "</td>";
      html += "<td>" + val.codigo_postal + "</td>";
      html += "<td>" + val.remito + "</td>";
      html += "</tr>";
    }
  });

  html += "</tbody>";
  html += "</table>";
  html += "</div>";

  return html;
}

function showReportTransit(object) {
  var html = "";

  html += '<div class="table-responsive" id="informe">';
  html +=
    '<table class="table table-striped table-bordered" cellspacing="0" width="100%" id="example">';
  html += "<thead>";
  html += "<tr>";
  html += '<th scope="col"> Codigo Postal </th>';
  html += '<th scope="col"> Localidad </th>';
  html += '<th scope="col"> Provincia </th>';
  html += '<th scope="col"> RECUPERADO </th>';
  html += '<th scope="col"> A CONFIRMAR </th>';
  html += '<th scope="col"> NO TUVO EQUIPO </th>';
  html += '<th scope="col"> NO COINCIDE SERIE </th>';
  html += '<th scope="col"> RECHAZADA </th>';
  html += '<th scope="col"> EN USO </th>';
  html += '<th scope="col"> N/ TEL EQUIVOCADO</th>';
  html += '<th scope="col"> NO EXISTE NUMERO </th>';
  html += '<th scope="col"> NO RESPONDE </th>';
  html += '<th scope="col"> TIEMPO ESPERA </th>';
  html += '<th scope="col"> SE MUDO / Av </th>';
  html += '<th scope="col"> YA RETIRADO </th>';
  html += '<th scope="col"> ZONA PELIGROSA </th>';
  html += '<th scope="col"> DESHABITADO </th>';
  html += '<th scope="col"> EXTRAVIADO </th>';
  html += '<th scope="col"> FALLECIO </th>';
  html += '<th scope="col"> FALTAN DATOS </th>';
  html += '<th scope="col"> RECONECTADO </th>';
  html += '<th scope="col"> ROBADO </th>';
  html += '<th scope="col"> ENTREGO EN SUCURSAR</th>';
  html += '<th scope="col"> POSNET </th>';
  html += '<th scope="col"> ANTINA </th>';
  html += '<th scope="col"> INTV </th>';
  html += '<th scope="col"> IPLAN </th>';
  html += '<th scope="col"> METROTEL </th>';
  html += '<th scope="col"> LAPOS </th>';
  html += '<th scope="col"> CABLEVISIÓN </th>';
  html += '<th scope="col"> CABLEVISIÓN URUGUAY </th>';
  html += '<th scope="col"> Total por Provincias </th>';
  html += "</tr>";
  html += "</thead>";
  html += "<tbody>";

  object.forEach((val) => {
    html += "<tr>";
    html += "<td>" + val.codigo_postal + "</td>";
    html += "<td>" + val.localidad + "</td>";
    html += "<td>" + val.provincia + "</td>";
    html += "<td>" + val.recuperado + "</td>";
    html += "<td>" + val.a_confirmar + "</td>";
    html += "<td>" + val.no_tuvo_equipo + "</td>";
    html += "<td>" + val.no_coincide_serie + "</td>";
    html += "<td>" + val.rechazada + "</td>";
    html += "<td>" + val.en_uso + "</td>";
    html += "<td>" + val.n_tel_equivocado + "</td>";
    html += "<td>" + val.no_existe_numero + "</td>";
    html += "<td>" + val.no_responde + "</td>";
    html += "<td>" + val.tiempo_espera + "</td>";
    html += "<td>" + val.se_mudo + "</td>";
    html += "<td>" + val.ya_retirado + "</td>";
    html += "<td>" + val.zona_peligrosa + "</td>";
    html += "<td>" + val.deshabitado + "</td>";
    html += "<td>" + val.extraviado + "</td>";
    html += "<td>" + val.fallecio + "</td>";
    html += "<td>" + val.faltan_datos + "</td>";
    html += "<td>" + val.reconectado + "</td>";
    html += "<td>" + val.robado + "</td>";
    html += "<td>" + val.entrego_en_sucursal + "</td>";
    html += "<td>" + val.posnet + "</td>";
    html += "<td>" + val.antina + "</td>";
    html += "<td>" + val.intv + "</td>";
    html += "<td>" + val.iplan + "</td>";
    html += "<td>" + val.metrotel + "</td>";
    html += "<td>" + val.lapos + "</td>";
    html += "<td>" + val.cablevision + "</td>";
    html += "<td>" + val.cablevision_uruguay + "</td>";
    html += "<td>" + val.total + "</td>";

    // html += "</tr>";
  });

  html += "</tbody>";
  html += "</table>";
  html += "</div>";

  return html;
}

function showReportCollectorManagement(object) {
  var html = "";

  html += '<div class="table-responsive" id="informe">';
  html +=
    '<table class="table table-striped table-bordered" cellspacing="0" width="100%" id="example">';
  html += "<thead>";
  html += "<tr>";
  html += '<th scope="col"> Recolector </th>';
  html += '<th scope="col"> Nombre </th>';
  html += '<th scope="col"> RECUPERADO </th>';
  html += '<th scope="col"> A CONFIRMAR </th>';
  html += '<th scope="col"> NO TUVO EQUIPO </th>';
  html += '<th scope="col"> NO COINCIDE SERIE </th>';
  html += '<th scope="col"> RECHAZADA </th>';
  html += '<th scope="col"> EN USO </th>';
  html += '<th scope="col"> N/ TEL EQUIVOCADO</th>';
  html += '<th scope="col"> NO EXISTE NUMERO </th>';
  html += '<th scope="col"> NO RESPONDE </th>';
  html += '<th scope="col"> TIEMPO ESPERA </th>';
  html += '<th scope="col"> SE MUDO / Av </th>';
  html += '<th scope="col"> YA RETIRADO </th>';
  html += '<th scope="col"> ZONA PELIGROSA </th>';
  html += '<th scope="col"> DESHABITADO </th>';
  html += '<th scope="col"> EXTRAVIADO </th>';
  html += '<th scope="col"> FALLECIO </th>';
  html += '<th scope="col"> FALTAN DATOS </th>';
  html += '<th scope="col"> RECONECTADO </th>';
  html += '<th scope="col"> ROBADO </th>';
  html += '<th scope="col"> ENTREGO EN SUCURSAR</th>';
  html += '<th scope="col"> POSNET </th>';
  html += '<th scope="col"> ANTINA </th>';
  html += '<th scope="col"> INTV </th>';
  html += '<th scope="col"> IPLAN </th>';
  html += '<th scope="col"> METROTEL </th>';
  html += '<th scope="col"> LAPOS </th>';
  html += '<th scope="col"> CABLEVISIÓN </th>';
  html += '<th scope="col"> CABLEVISIÓN URUGUAY </th>';
  html += '<th scope="col"> Total recuperados </th>';
  html += '<th scope="col"> Total gestionados </th>';
  html += "</tr>";
  html += "</thead>";
  html += "<tbody>";

  object.forEach((val) => {
    html += "<tr>";
    html += "<td>" + val.recolector + "</td>";
    html += "<td>" + val.name + "</td>";
    html += "<td>" + val.recuperado + "</td>";
    html += "<td>" + val.a_confirmar + "</td>";
    html += "<td>" + val.no_tuvo_equipo + "</td>";
    html += "<td>" + val.no_coincide_serie + "</td>";
    html += "<td>" + val.rechazada + "</td>";
    html += "<td>" + val.en_uso + "</td>";
    html += "<td>" + val.n_tel_equivocado + "</td>";
    html += "<td>" + val.no_existe_numero + "</td>";
    html += "<td>" + val.no_responde + "</td>";
    html += "<td>" + val.tiempo_espera + "</td>";
    html += "<td>" + val.se_mudo + "</td>";
    html += "<td>" + val.ya_retirado + "</td>";
    html += "<td>" + val.zona_peligrosa + "</td>";
    html += "<td>" + val.deshabitado + "</td>";
    html += "<td>" + val.extraviado + "</td>";
    html += "<td>" + val.fallecio + "</td>";
    html += "<td>" + val.faltan_datos + "</td>";
    html += "<td>" + val.reconectado + "</td>";
    html += "<td>" + val.robado + "</td>";
    html += "<td>" + val.entrego_en_sucursal + "</td>";
    html += "<td>" + val.posnet + "</td>";
    html += "<td>" + val.antina + "</td>";
    html += "<td>" + val.intv + "</td>";
    html += "<td>" + val.iplan + "</td>";
    html += "<td>" + val.metrotel + "</td>";
    html += "<td>" + val.lapos + "</td>";
    html += "<td>" + val.cablevision + "</td>";
    html += "<td>" + val.cablevision_uruguay + "</td>";
    html += "<td>" + val.total_recuperados + "</td>";
    html += "<td>" + val.total_gestionados + "</td>";
   
    // html += "</tr>";
  });

  html += "</tbody>";
  html += "</table>";
  html += "</div>";

  return html;
}

//  GESTIONAR EQUIPOS

function componenTModify(getAccesorio_uno,getAccesorio_dos,getAccesorio_tres,getAccesorio_cuatro,getEstado,id_guia_equipo,id_equipo
) {
  var html = "";

  html += '<div class="form-group">';
  html += "<label><strong>Terminal </strong></label>";
  html +=
    '<input style="background-color:#D6EAF8 ;border:0;" id="terminal-edit" type="text" class="form-control" >';
  html += "</div>";
  html += '<div class="form-group">';
  html += "<label><strong>Serie </strong></label>";
  html +=
    '<input style="background-color:#D6EAF8 ;border:0;" id="serie-edit"  type="text" class="form-control" >';
  html += "</div>";

  html += '<div class="form-group">';
  html += "<label><strong>Cable telefonico / HDMI </strong></label>";
  html +=
    '<select style="background-color:#D6EAF8 ;border:0;" id="accesorio-uno-edit"  class="form-control" >';
    
  html += componentOption(getAccesorio_uno);
  html += "</select>";
  html += "</div>";

  html += '<div class="form-group">';
  html += "<label><strong>Cable AV / SIM CARD </strong></label>";
  html +=
    '<select style="background-color:#D6EAF8 ;border:0;" id="accesorio-dos-edit"  class="form-control" >';
  html += componentOption(getAccesorio_dos);
  html += "</select>";
  html += "</div>";

  html += '<div class="form-group">';
  html += "<label><strong> Base / Fuente </strong></label>";
  html +=
    '<select style="background-color:#D6EAF8 ;border:0;" id="accesorio-tres-edit"  class="form-control" >';
  html += componentOption(getAccesorio_tres);
  html += "</select>";
  html += "</div>";

  html += '<div class="form-group">';
  html += "<label><strong> Cargador / Control </strong></label>";
  html +=
    '<select style="background-color:#D6EAF8 ;border:0;" id="accesorio-cuatro-edit"  class="form-control" >';
  html += componentOption(getAccesorio_cuatro);
  html += "</select>";
  html += "</div>";

  html += '<div class="form-group">';
  html += "<label><strong> Estado</strong></label>";
  html +=
    '<select style="background-color:#D6EAF8 ;border:0;" id="estado-edit"  class="form-control" >';
  html += componentOptionStatus(getEstado);
  html += "</select>";
  html += "</div>";
  html +=
    '<input id="id_guia_equipo" type="hidden" value="' + id_guia_equipo + '">';
    html +='<input id="id_equipo" type="hidden" value="' + id_equipo + '">';

  return html;
}

function componentOption(objeto) {
  
  var html = "";
  if (objeto === "no entrego") {
    html += '<option  value="' + objeto + '" >' + objeto + "</option>";
    html += '<option  value="si entrego" >si entrego</option>';
  } else if (objeto === "si entrego") {
    html += '<option  value="' + objeto + '" >' + objeto + "</option>";
    html += '<option  value="no entrego" >no entrego</option>';
  }

  return html;
}

function componentOptionStatus(objeto) {
 
  var html = "";

  html += '<option value="' + objeto + '" >' + objeto + "</option>";
  html += '<option value="RECUPERADO">RECUPERADO</option>';
  html += '<option value="AUTORIZAR">A CONFIRMAR</option>';
  html += '<option value="NO-TUVO-EQUIPO">NO TUVO EQUIPO</option>';
  html += '<option value="NO-COINCIDE-SERIE">NO COINCIDE SERIE</option>';
  html += '<option value="RECHAZADA">RECHAZADA</option>';
  html += '<option value="EN-USO">EN USO</option>';
  html += '<option value="N/TEL-EQUIVOCADO">TEL EQUIVOCADO</option>';
  html += '<option value="NO-EXISTE-NUMERO">NO EXISTE NUMERO</option>';
  html += '<option value="NO-RESPONDE">NO RESPONDE</option>';
  html += '<option value="TIEMPO-ESPERA">TIEMPO LIMITE ESPERA</option>';
  html += '<option value="SE-MUDO">SE MUDO</option>';
  html += '<option value="YA-RETIRADO">YA RETIRADO</option>';
  html += '<option value="ZONA-PELIGROSA">ZONA PELIGROSA</option>';
  html += '<option value="DESHABITADO">DESHABITADO</option>';
  html += '<option value="EXTRAVIADO">EXTRAVIADA</option>';
  html += '<option value="FALLECIO">FALLECIO</option>';
  html += '<option value="FALTAN-DATOS">FALTAN DATOS</option>';
  html += '<option value="RECONECTADO">RECONECTADO</option>';
  html += '<option value="ROBADO">ROBADO</option>';
  html += '<option value="ENTREGO-EN-SUCURSAL">ENTREGO EN SUCURSAL</option>';

  return html;
}

function areYouSureDeleteEquipment(
  ask,
  text,
  icon,
  confirm,
  id_guia_equipo,
  id_user_update,
  fecha_update
) {
  Swal.fire({
    title: ask,
    text: text,
    icon: icon,
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: confirm,
  }).then((result) => {
    if (result.isConfirmed) {
      $.ajax({
        url: "../controllers/equipoController.php?equipo=modifyTransito",
        type: "POST",
        data: { id_guia_equipo, id_user_update, fecha_update },
        beforeSend: function () {},
      }).done(function (response) {
        var object = JSON.parse(response);

        if (object[0].result === "1") {
          alertPositive("Se ha eliminado con exito!");
          searchDataInTransit($("#datoBuscarTransito").val());
        }
      });
    }
  });
}

// MOSTRAR FORMULARIOS

function seekerTransit() {
  $("#datoBuscarTransito").val("");
  $("#container-busqueda-general").hide();
  $("#container-negativos").hide();
  $("#container-busqueda-reco-fecha").hide();
  $("#container-mensaje-error").hide();
  $("#container-detalle-recolector").hide();
  $("#container-busqueda-transito").show();
  $("#informe").hide();
  $("#detalle").hide();
  $("#cont-informe").hide();
  $("#more").text("");
}

function seekerTransitCollectorAndDate() {


  $("#container-busqueda-transito").hide();
  $("#container-busqueda-general").hide();
  $("#container-negativos").hide();
  $("#container-mensaje-error").hide();
  $("#container-detalle-recolector").hide();
  $("#container-busqueda-reco-fecha").show();
  $("#informe").hide();
  $("#detalle").hide();
  $("#cont-informe").hide();
  $("#more").text("");

  var key = 'all';
  getUserForSelect(key)
}
// obtener usuarios para select
function getUserForSelect(key) {
  
  $.ajax({
    url: "../controllers/usuarioController.php?usuario=dataUsers",
    type: "POST",
    data: { key },
    beforeSend: function () {
      // $("#loaderUsuarios").show()
      // $("#loaderUsuarios").html('<div class="spinner-border text-primary" role="status"><span class="sr-only">Loading...</span></div>')
    },
  }).done(function (response) {
    var objectResponse = JSON.parse(response)

    let recolectores= []

    recolectores = objectResponse.filter(item => item.estado === 'active' && item.tipoUsuario !== 'call')
    var template =""
    template =  showRecolectores(recolectores)
    $("#recolector").html(template)
  
  });
}

function showRecolectores(recolectores){
var html =""

    const ordenadosAlfabeticamente = recolectores.sort(function(prev, next){

      if(prev.nombre > next.nombre){
          return 1
      }
      if(prev.nombre < next.nombre){
        return -1
      }
      return 0
    })

    ordenadosAlfabeticamente.forEach((val) => {
     
       html += '<option value="'+val.id+'" > '+val.nombre+' - '+val.localidad+' - ID: '+val.id+'</option>'
   })

 return html;
}


function seekerRangeDate() {
  $("#datoBuscar").val("");
  $("#container-negativos").show();
  $("#container-busqueda-transito").hide();
  $("#container-busqueda-reco-fecha").hide();
  $("#container-busqueda-general").hide();
  $("#container-detalle-recolector").hide();
  $("#container-mensaje-error").hide();
  $("#informe").hide();
  $("#detalle").hide();
  $("#cont-informe").hide();
  $("#more").text("");
}

function seekerGeneralBase() {
  $("#datoBuscar").val("");
  $("#container-busqueda-transito").hide();
  $("#container-busqueda-reco-fecha").hide();
  $("#container-negativos").hide();
  $("#container-detalle-recolector").hide();
  $("#container-busqueda-general").show();
  $("#container-mensaje-error").hide();
  $("#detalle").hide();
  $("#cont-informe").hide();
  $("#more").hide();
  $("#more").text("");
}

function seekerGestionCollector() {
  $("#datoBuscar").val("");
  $("#container-busqueda-transito").hide();
  $("#container-busqueda-reco-fecha").hide();
  $("#container-negativos").hide();
  $("#container-busqueda-general").hide();
  $("#container-detalle-recolector").show();
  $("#container-mensaje-error").hide();
  $("#detalle").hide();
  $("#cont-informe").hide();
  $("#more").hide();
}

function MostrarErrorOcultarTablaEnBase() {
  $("#container-mensaje-error").show();
  $("#data").hide();
}

function MostrarErrorOcultarTablaTransito() {
  $("#container-mensaje-error").show();
  $("#informe").hide();
  $("#detalle").hide();
  $("#cont-informe").hide();
}

function MostrarTablaOcultarErrorEnBase() {
  $("#container-mensaje-error").hide();
  $("#data").show();
}

function MostrarTablaOcultarErrorTransito() {
  $("#container-mensaje-error").hide();
  $("#detalle").show();
  $("#cont-informe").show();
  $("#data").show();
  $("#more").show();
}
 
function MostrarTablaOcultarErrorTransitoPorCliente() {
  $("#container-mensaje-error").hide();
  $("#detalle").show();
  $("#data").show();
}

function tableUser(){

  var table = $("#example").DataTable({
    columnDefs: [ { type: 'date', 'targets': [14] } ],
    order: [[ 14, 'desc' ]],
    //esto lo orden perfectamente por fecha 
  //    "columns": [
  //      null,
  //      { "orderDataType": "dom-text-numeric" },
  //      { "orderDataType": "dom-text", type: 'string' },
  //      { "orderDataType": "dom-select" }
  //  ],
 

    language: {
      lengthMenu: "Mostrar _MENU_ registros",
      zeroRecords: "No se encontraron resultados",
      info:
        "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
      infoEmpty: "Mostrando registros del 0 al 0 de un total de 0 registros",
      infoFiltered: "(filtrado de un total de _MAX_ registros)",
      sSearch: "Buscar:",
      oPaginate: {
        sFirst: "Primero",
        sLast: "Último",
        sNext: "Siguiente",
        sPrevious: "Anterior",
      },
      sProcessing: "Procesando...",
    },
    //para usar los botones
    // responsive: "true",
    dom: "Bfrtilp",
    buttons: [
      {
        extend: "excelHtml5",
        text: '<i class="fas fa-file-excel"></i> ',
        titleAttr: "Exportar a Excel",
        className: "btn btn-success",
      },
      {
        extend: "pdfHtml5",
        text: '<i class="fas fa-file-pdf"></i> ',
        titleAttr: "Exportar a PDF",
        className: "btn btn-danger",
      },
      {
        extend: "print",
        text: '<i class="fa fa-print"></i> ',
        titleAttr: "Imprimir",
        className: "btn btn-info",
      },
    ],
  });

  //Creamos una fila en el head de la tabla y lo clonamos para cada columna
  // $('#example thead tr').clone(true).appendTo( '#example thead' );
     
  // $('#example thead tr:eq(1) th').each( function (i) {
  //     var title = $(this).text(); //es el nombre de la columna+
  //    title !== '' ? $(this).html( '<input type="text" class="input-dinamic" placeholder="Buscar '+title+'" />' ) : true;
      

  //     $( 'input', this ).on( 'keyup change', function () {
  //         if ( table.column(i).search() !== this.value ) {
  //             table
  //                 .column(i)
  //                 .search( this.value )
  //                 .draw();
  //         }
  //     } );
  // } );

}
// $(document).on('click','.count',function(){

// var esto = this
// var estado = $(esto).attr("estado")
// $("#example_filter label input").val(estado)

// })

// $(document).on('click','#example_filter label input',function(){
//   console.log("hola");
// })

function table() {
 
  var table = $("#example").DataTable({
      
    language: {
      lengthMenu: "Mostrar _MENU_ registros",
      zeroRecords: "No se encontraron resultados",
      info:
        "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
      infoEmpty: "Mostrando registros del 0 al 0 de un total de 0 registros",
      infoFiltered: "(filtrado de un total de _MAX_ registros)",
      sSearch: "Buscar:",
      oPaginate: {
        sFirst: "Primero",
        sLast: "Último",
        sNext: "Siguiente",
        sPrevious: "Anterior",
      },
      sProcessing: "Procesando...",
    },
    //para usar los botones
    // responsive: "true",
    dom: "Bfrtilp",
    buttons: [
      {
        extend: "excelHtml5",
        text: '<i class="fas fa-file-excel"></i> ',
        titleAttr: "Exportar a Excel",
        className: "btn btn-success",
      },
      // {
      //   extend: "pdfHtml5",
      //   text: '<i class="fas fa-file-pdf"></i> ',
      //   titleAttr: "Exportar a PDF",
      //   className: "btn btn-danger",
      // },
      {
        extend: "print",
        text: '<i class="fa fa-print"></i> ',
        titleAttr: "Imprimir",
        className: "btn btn-info",
      },
    ],
    orderCellsTop: true,
    fixedHeader: false,
  });

}

// traer pais

function getPais(atributo) {
  
  $.ajax({
    url: "../controllers/equipoController.php?equipo=pais",
    beforeSend: function () {
      $("#loaderPais").append('<div id="loaderCargarPais" class="spinner-border" role="status"><span class="sr-only">Loading...</span></div>')

    },
  }).done(function (response) {
    $("#loaderCargarPais").remove()
    var objectPais = JSON.parse(response);
    var templatePais = "";
    templatePais += `<option value="0" >Seleccione Pais</option>`;
    if (objectPais[0].result === "1") {
      objectPais.forEach((val) => {
        templatePais += `
          <option value='${val.id}' >${val.country}</option>
          `;
      });
      $(atributo).html(templatePais);
    }
  });
}
//  traer provincias
function getProvincia(atributo, object) {
  var idPais = object;

  $.ajax({
    url: "../controllers/equipoController.php?equipo=provincias",
    type: "POST",
    data: { idPais },
    beforeSend: function () {
      $("#loaderProvinciaAgregar").append('<div id="loaderCargarProvincia" class="spinner-border" role="status"><span class="sr-only">Loading...</span></div>')
      
    },
  }).done(function (response) {
    $("#loaderCargarProvincia").remove()
    var objectProvincia = JSON.parse(response);
    var templateProvincia = "";
    templateProvincia += `<option value="0" >Seleccione Provincia</option>`;
    if (objectProvincia[0].result === "1") {
      objectProvincia.forEach((val) => {
        templateProvincia += `
              <option value='${val.id}' >${val.province}</option>
              `;
      });

      $(atributo).html(templateProvincia);
    }
  });
}

//  traer localidades

function getLocalidad(atributo, object) {
  var idProvincia = object;

  $.ajax({
    url: "../controllers/equipoController.php?equipo=localidades",
    type: "POST",
    data: { idProvincia },
    beforeSend: function () {
 $("#loaderLocalidadAgregar").append('<div id="loaderCargarLocalidad" class="spinner-border" role="status"><span class="sr-only">Loading...</span></div>')
    },
  }).done(function (response) {
    $("#loaderCargarLocalidad").remove()
    var objectLocalidad = JSON.parse(response);
    var templateLocalidad = "";
    templateLocalidad += `<option value="0" >Seleccione Localidad</option>`;
    if (objectLocalidad[0].result === "1") {
      objectLocalidad.forEach((val) => {
        templateLocalidad += `
             <option value='${val.codigo_postal}' >${val.locate}</option>
             `;
      });

      $(atributo).html(templateLocalidad);
    }
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

//  validar datos nuevo cliente

function validateExistID(objeto) {
  $.ajax({
    url: "../controllers/equipoController.php?equipo=validateExistID",
    type: "POST",
    data: { objeto },
    beforeSend: function () {
      $("#loaderidlocal").show()
    $("#loaderidlocal").html('<div class="spinner-border" role="status"><span class="sr-only">Loading...</span></div>')
    },
  }).done(function (response) {
    $("#loaderidlocal").hide()
    if (response === "1") {
      
      localStorage.setItem("id", "s");
    } else {
      $("#registerCustomer").hide();
      localStorage.setItem("id", "n");
      alertNegative("El id local ingresado ya existe, debes ingresar uno nuevo");
      return false;
    }
  });
}

function validateExistSerie(objeto) {
  $.ajax({
    url: "../controllers/equipoController.php?equipo=validateExistSerie",
    type: "POST",
    data: { objeto },
    beforeSend: function () {

      $("#loaderserie").show()
      $("#loaderserie").html('<div class="spinner-border" role="status"><span class="sr-only">Loading...</span></div>')
    },
  }).done(function (response) {
    $("#loaderserie").hide()
    if (response === "1") {
      localStorage.setItem("se", "s");
    } else {
      $("#registerCustomer").hide();
      localStorage.setItem("se", "n");
      alertNegative("La serie ingresada ya existe, debes ingresar uno nuevo");
      return false;
    }
  });
}

function validateExistTerminal(objeto) {
  $.ajax({
    url: "../controllers/equipoController.php?equipo=validateExisTerminal",
    type: "POST",
    data: { objeto },
    beforeSend: function () {
      $("#loaderterminal").show()
      $("#loaderterminal").html('<div class="spinner-border" role="status"><span class="sr-only">Loading...</span></div>')
    },
  }).done(function (response) {
    $("#loaderterminal").hide()
    if (response === "1") {
      localStorage.setItem("te", "s");
    } else {
      $("#registerCustomer").hide();
      localStorage.setItem("te", "n");
      alertNegative("La terminal ingresada ya existe, debes ingresar uno nuevo");
      return false;
    }
  });
}
function setFormAddNewCustomers() {
  $("#empresa_add").prop("selectedIndex", 0);
  $("#identificacion_add").val("");
  $("#id_local_add").val("");
  $("#pais_add").prop("selectedIndex", 0);
  $("#provincia_add").prop("selectedIndex", 0);
  $("#localidad_add").prop("selectedIndex", 0);
  $("#domicilio_add").val("");
  $("#codigo_postal_add").val("");
  $("#serie_add").val("");
  $("#terminal_add").val("");
  $("#sim_add").val("");
  $("#nombre_add").val("");
  $("#email_add").val("");
  $("#telefono_add").val("");
}

// MENSAJES

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
