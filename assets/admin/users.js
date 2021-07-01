var notificacionDisplayed = false;
var panelGeneralDisplayed = true;

const urlid = {
    idnumber: getParameterByName("id_us")
}


$(document).ready(function() {
    Redireccion();
    coutNotificacions($("#id_admin").val());
    // mostrar usuarios

    if (urlid.idnumber !== '' && urlid.idnumber !== null) {

        getDataUser(urlid);
    }
});

$(document).on("click", "#buscar-solicitudes", function() {
    const objectBuscar = {
        idnumber: $("#documento").val()
    }
    getDataUser(objectBuscar);
});

$(document).on("click", "#mostrar-todos", function() {
    showAll();
});

// gestionar usuarios
// accion usuario
// enviar contrato

$(document).on("click", "#enviarContrato", function() {
    var tdEnviarContrato = this.parentElement;
    var idmail = $(tdEnviarContrato).attr("idmail");
    var idnumber = $(tdEnviarContrato).attr("id_number");
    var mail = $(tdEnviarContrato).attr("mail");
    var id_user = $(tdEnviarContrato).attr("id_user");
    var name = $(tdEnviarContrato).attr("nombre");
    var id_managent = $("#id_user_default").val()

    const objectContrato = {
        idnumber,
        idmail,
        mail,
        id_user,
        name,
        id_managent,
        method: 'userRegistrationProcess',
        action: 'enviarcontrato',
        motivo: 'Contrato Express',
        tittle: '¿Estas seguro de enviar el contrato?',
        text: 'Le llegara el contrato por correo eléctronico y entrara en estado "Esperando firmar contrato"',
        icon: 'info',
        confirmButton: 'Si, enviar!',
        stat: 'sign_contract',
        textResponse: 'enviado'
    }

    confirm(objectContrato);
});


// aviso contrato enviado

$(document).on('click', '#contratoEnviado', function() {

    var tdContratoEnviado = this.parentElement;
    var idmail = $(tdContratoEnviado).attr("idmail");
    var idnumber = $(tdContratoEnviado).attr("id_number");
    var mail = $(tdContratoEnviado).attr("mail");
    var id_managent = $("#id_user_default").val()

    const objectContractSent = {
        idnumber,
        idmail,
        mail,
        id_managent,
        method: 'userRegistrationProcess',
        action: 'contratoEnviado',
        motivo: 'Aviso de contrato',
        tittle: '¿Quieres enviarle un segundo aviso al postulante?',
        text: 'Al enviarle el contrato ya se le envio un aviso por correo, si deseas enviarle otro aviso puedes hacerlo."',
        icon: 'info',
        confirmButton: 'Si, enviar!',
        stat: 'avisoEnviado',
        textResponse: 'enviado'
    }

    confirm(objectContractSent);
});

//aviso pronto activo

$(document).on('click', '#prontoActivo', function() {

    var tdProntoActivo = this.parentElement;
    var idnumber = $(tdProntoActivo).attr("id_number");
    var mail = $(tdProntoActivo).attr("mail");
    var action = "mensajeProntoActivo";
    var motivo = "Express";
    var id_managent = $("#id_user_default").val()

    const SoonYouWillBeActive = {

        idnumber,
        mail,
        id_managent,
        method: 'userRegistrationProcess',
        action: 'mensajeProntoActivo',
        motivo: 'Falta poco! Express',
        tittle: 'Estas por enviar un aviso!',
        text: 'Pronto estaras activo para gestionar! Gracias!"',
        icon: 'info',
        confirmButton: 'Si, enviar!',
        stat: 'aviso',
        textResponse: 'enviado'

    }

    confirm(SoonYouWillBeActive);

})

// aviso activo

$(document).on('click', '#avisoActivo', function() {

    var tdAvisoActivo = this.parentElement;
    var idnumber = $(tdAvisoActivo).attr("id_number");
    var idmail = $(tdAvisoActivo).attr("idmail");
    var mail = $(tdAvisoActivo).attr("mail");
    var id_user = $(tdAvisoActivo).attr("id_user");
    var nombre = $(tdAvisoActivo).attr("name");
    var id_managent = $("#id_user_default").val()

    const objectNotifyActive = {
        idnumber,
        mail,
        idmail,
        id_user,
        name,
        id_managent,
        method: 'userRegistrationProcess',
        action: 'otroAvisoActivo',
        motivo: 'Ya estas activo!',
        tittle: '¿Queres enviarle un segundo aviso indicandole que esta activo ?',
        text: 'Al darle de alta se le envió un aviso por correo, si deseas enviarle otro aviso puedes hacerlo."',
        icon: 'info',
        confirmButton: 'Si, enviar!',
        stat: 'otroAvisoActivo',
        textResponse: 'enviado'
    }

    confirm(objectNotifyActive);

});

// cancelar contrato

$(document).on('click', '#cancelarContrato', function() {

    var tdCancelarContrato = this.parentElement;
    var idnumber = $(tdCancelarContrato).attr("id_number");
    var id_managent = $("#id_user_default").val()
    const objectCancelContract = {
        idnumber,
        id_managent,
        stat: 'cancel',
        textResponse: 'cancelado'
    }

    setSatusUser(objectCancelContract)

})

// alta usuario

$(document).on('click', '#alta', function() {

    var tdAlta = this.parentElement;
    var idnumber = $(tdAlta).attr("id_number");
    var mail = $(tdAlta).attr("mail");
    var id_user = $(tdAlta).attr("id_user");
    var name = $(tdAlta).attr("nombre");
    var id_managent = $("#id_user_default").val()

    const objectAlta = {
        idnumber,
        mail,
        id_user,
        name,
        id_managent,
        method: 'userRegistrationProcess',
        action: 'mensajeActivo',
        tittle: '¿Estas seguro/a?',
        text: 'Le daras de alta a este usuario',
        icon: 'info',
        confirmButton: 'Si, dar de alta!!',
        stat: 'active',
    }

    confirm(objectAlta);


})

// baja usuario

$(document).on('click', '#baja', function() {

    var tdAlta = this.parentElement;

    var idnumber = $(tdAlta).attr("id_number");
    var mail = $(tdAlta).attr("mail");
    var id = $(tdAlta).attr("id_user");
    var id_managent = $("#id_user_default").val()

    $("#id_usuario_baja").val(idnumber);
    $("#id_usuario_managent_baja").val(id_managent);
    $("#mail_usuario_baja").val(mail);
    $("#id_user").val(id)

    $("#modalBaja").modal("show")


})


$(document).on('click', '#down_user', function() {

        var id_usuario_baja = $("#id_usuario_baja").val();
        var id_managent_baja = $("#id_usuario_managent_baja").val();
        var motivo_baja = $("#motivo_baja_usuario").val();
        var descripcion = $("#descripcion_baja").val();
        var mail = $("#mail_usuario_baja").val();
        var id_user = $("#id_user").val();




        const objectBaja = {
            id_user,
            idnumber: id_usuario_baja,
            id_managent: id_managent_baja,
            motivo: motivo_baja,
            mail,
            descripcion,
            tittle: '¿Estas seguro/a?',
            text: 'Le daras de baja a este usuario',
            icon: 'info',
            confirmButton: 'Si, dar de baja!',
            stat: 'down',
            action: 'down',
            method: 'userRegistrationProcess'
        }



        if (id_usuario_baja === '') {
            alertNegative("No hay usuario seleccionado para dar de baja");
            return false;
        } else if (id_managent_baja === '') {
            alertNegative("No hay operador/a registrado para realizar esta accion");
            return false;
        } else if (motivo_baja === '0') {
            alertNegative("Debes escoger un motivo por el cual se genera la baja de este usuario");
            return false;
        } else {
            confirm(objectBaja);
        }

    })
    //volver a dar de alta

$(document).on('click', '#volverAlta', function() {


    var tdAlta = this.parentElement;
    var idnumber = $(tdAlta).attr("id_number");
    var mail = $(tdAlta).attr("mail");
    var id_managent = $("#id_user_default").val()

    const objectAltaAgain = {
        idnumber,
        mail,
        id_managent,
        method: 'userRegistrationProcess',
        action: 'mensajeActivo',
        tittle: '¿Estas seguro/a?',
        text: 'Le daras de alta nuevamente a este usuario',
        icon: 'info',
        confirmButton: 'Si, dar de alta!',
        stat: 'active',
    }

    confirm(objectAltaAgain);

})

// notificaciones

$(document).on("click", "#solicitudes", function() {
    if ($("#despliegue-notificacion").is(":visible")) {
        $("#despliegue-notificacion").fadeOut();
    } else {
        $("#despliegue-notificacion").fadeIn();
        $("#despliegue-notificacion").html('<div class="header-despliegue" id="header-despliegue">Notificaciones<div class="body-despliegue"><div class="spinner-border" role="status"><span class="sr-only">Loading...</span></div>');


        getNotifications($("#id_admin").val());
    }
});

$(document).on("click", function(e) {
    var container = $("#container-notification");

    if (!container.is(e.target) && container.has(e.target).length === 0) {
        if ($("#despliegue-notificacion").is(":visible")) {
            $("#despliegue-notificacion").fadeOut();
        }
    }
});



var delay = (function() {
    var timer = 0;
    return function(callback, ms) {
        clearTimeout(timer);
        timer = setTimeout(callback, ms);
    };
})();



function veryCountry() {

    if ($("#id_admin").val() === 'Argentina') {
        document.getElementById('numeroWats').placeholder = 'Obligatorio anteponer el 54 antes del número';
    } else if ($("#id_admin").val() === 'Uruguay') {
        document.getElementById('numeroWats').placeholder = 'Obligatorio anteponer el 598 antes del número';
    }


}

function MostrarPanelSeteo() {
    document
        .getElementById("#MostrarPanel")
        .addEventListener("click", function(event) {
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
    $("#mostrarpanel").click(function() {
        location.href = base_url + 'usuario/admin';
    });

    $("#inicio").click(function() {
        location.href = base_url;
    });
    $("#cerrar").click(function() {
        location.href = base_url + 'config/destroy.php';
    });

    $("#agregarUsuario").click(function() {
        location.href = base_url + 'views/admin/?admin=users';
    });
}

// usuarios y postulaciones

function getParameterByName(name) {
    name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
    var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
        results = regex.exec(location.search);
    return results === null ?
        "" :
        decodeURIComponent(results[1].replace(/\+/g, " "));
}

function getNotifications(object) {
    $.ajax({
        url: "../controllers/usuarioController.php?usuario=notificaciones",
        type: "POST",
        data: { object },
        beforeSend: function() {},
    }).done(function(response) {

        var object = JSON.parse(response);


        var template = "";
        template = showNotifications(object);

        $("#despliegue-notificacion").html(template);

    });
}

function showNotifications(object) {
    var html = "";

    if (object[0].result !== '2') {

        html += '<div class="header-despliegue" id="header-despliegue">';
        html += "Notificaciones";
        html += "</div> ";

        object.forEach((val) => {
            html +=
                '<a id="noti" href="' + base_url + 'usuario/post&notif_id=' +
                val.id +
                '&sta=' + val.status_notifications + '"> ';
            html += '<div class="body-despliegue" tomoDato="' + val.id + '" >';

            if (val.status_process === 'registered') {

                html += "<div class='box-notificacion-user'>";
                html += "<img class='img-user' src='" + base_url + "resources/imgRegister/" + val.imgPerson + "'>";
                html += "</div>";

                html += "<div class='box-notificacion-user'>";
                html += "<div class='box-content-data'>";
                html += "<span>" + val.name + " ha enviado una solicitud para<br> <span class='class-rol'>" + val.role + " en " + val.location + ' CP: ' + val.postal_code + " </span><br><span class='class-date'>" + val.date.substr(0, 10) + "</span></span>";

            } else if (val.status_process === 'sign_contract') {

                html += "<div class='box-notificacion-user'>";
                html += "<img class='img-user' src='" + base_url + "resources/imgRegister/" + val.imgPerson + "'>";
                html += "</div>";
                html += "<div class='box-notificacion-user'>";
                html += "<div class='box-content-data'>";
                html += "<span>" + val.name + " tiene contrato pendiente para firmar de <br><span class='class-rol'>" + val.role + "</span><br><span class='class-date'>" + val.date.substr(0, 10) + "</span></span>";


            } else if (val.status_process === 'signed_contract') {

                html += "<div class='box-notificacion-user'>";
                html += "<img class='img-user' src='" + base_url + "resources/imgRegister/" + val.imgPerson + "'>";
                html += "</div>";
                html += "<div class='box-notificacion-user'>";
                html += "<div class='box-content-data'>";
                html += "<span>" + val.name + " ha firmado contrato tipo<br> <span class='class-rol'>" + val.role + " en " + val.location + ' CP: ' + val.postal_code + "</span><br><span class='class-date'>" + val.date.substr(0, 10) + "</span></span>";



            } else if (val.status_process === 'active') {

                html += "<div class='box-notificacion-user'>";
                html += "<img class='img-user' src='" + base_url + "resources/imgRegister/" + val.imgPerson + "'>";
                html += "</div>";
                html += "<div class='box-notificacion-user'>";
                html += "<div class='box-content-data'>";
                html += "<span>" + val.name + " esta activo para trabajar como <br><span class='class-rol'>" + val.role + " en " + val.location + ' CP: ' + val.postal_code + "</span><br><span class='class-date'>" + val.date.substr(0, 10) + "</span></span>";



            } else if (val.status_process === 'down') {
                html += "<div class='box-notificacion-user'>";
                html += "<img class='img-user' src='" + base_url + "resources/imgRegister/" + val.imgPerson + "'>";
                html += "</div>";
                html += "<div class='box-notificacion-user'>";
                html += "<div class='box-content-data'>";
                html += "<span>" + val.name + " ha sido dado de baja como <br><span class='class-rol'>" + val.role + " en " + val.location + ' CP: ' + val.postal_code + "</span><br><span class='class-date'>" + val.date.substr(0, 10) + "</span></span>";


            }
            if (val.status_notifications === 'nueva') {
                html += '<div class="status-noti"></div>';
            } else if (val.status_notifications === 'leida') {
                html += '<div class=""></div>';
            }
            html += "</div>";

            html += "</div>";
            html += '</div>';
            html += "</a>";
            html += "<hr>";


        });
    } else {

        html += '<div class="header-despliegue" id="header-despliegue">';
        html += "Notificaciones";
        html += "<div class='body-despliegue'>";
        html += 'Por los momentos no tienes notificaciones en tu zona';
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
        beforeSend: function() {},
    }).done(function(response) {
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
        beforeSend: function() {
            $("#loaderUsuarios").show()
            $("#loaderUsuarios").html('<div class="spinner-border text-primary" role="status"><span class="sr-only">Loading...</span></div>')
        },
    }).done(function(response) {
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
        beforeSend: function() {},
    }).done(function(response) {
        var template = "";

        if (response === "1") {
            if (object.textResponse === 'enviado') {
                sendEmail(object)
            } else if (object.textResponse === 'cancelado') {
                $("#loaderUsuarios").hide()
                alertPositive("Cancelado exitosamente");
                getDataUser(object)
                coutNotificacions($("#id_user_default").val());
            } else if (object.stat === 'active') {
                sendEmail(object)
            } else if (object.stat === 'down') {
                sendEmail(object);
                $("#loaderUsuarios").hide();
                $("#modalBaja").modal("hide");
                alertPositive(
                    "Usuario dado de baja exitosamente!"
                );
                getDataUser(object);
                coutNotificacions($("#id_user_default").val());
            } else {
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

function getDateTime() {

    var today = new Date();
    var getMin = today.getMinutes();
    var getSeconds = today.getSeconds()
    var getHours = today.getHours()

    if (getMin < 10) { getMin = '0' + today.getMinutes() }
    if (getSeconds < 10) { getSeconds = '0' + today.getSeconds() }
    if (getHours < 10) { getHours = '0' + today.getHours() }

    var created_at = today.getFullYear() + '-' + ("0" + (today.getMonth() + 1)).slice(-2) + '-' +
        ("0" + today.getDate()).slice(-2) + ' ' + getHours + ':' + getMin + ':' + getSeconds;

    return created_at
}

function removeUserTheCoverage(id, admin) {

    var created_at = getDateTime()
    axios.get(base_url + '/controllers/coberturaController.php?cobertura=removeZoneByUser', {
            params: {
                id,
                admin,
                created_at
            }
        })
        .then(res => {
            if (res.data.error) {
                alertNegative(res.data.error)
            }
        })
        .catch(err => {
            console.log(err)
        })
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
    html += '<th>Ver mas</th>';
    // html += "<th class='alert alert-danger'>Monotributo </th>";
    html += "<th>Contrato</th>";
    html += "<th>Movilidad / Herramienta </th>";
    html += "<th>fecha gestión </th>";
    html += "<th>Nro Documento </th>";


    html += '<th>Coordinador/a Gestión</th>';

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
                val.mailh + '" id_number="' + val.nroDoc + '" mail="' + val.correo +
                '" id_user="' + val.id + '" nombre="' + val.nombre + '" ><button id="enviarContrato" class="btn btn-danger" >Enviar Contrato</button></td>';
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
                val.mailh + '" id_number="' + val.nroDoc + '" mail="' + val.correo +
                '" id_user="' + val.id + '" nombre="' + val.nombre + '"  "><button class="btn btn-success" id="alta" >Dar Alta</button></td>';
        } else if (val.estado === "active") {

            html += '<td id_user="' + val.id + '" idmail="' +
                val.mailh +
                '" id_number="' +
                val.nroDoc +
                '" mail="' +
                val.correo +
                '"><button class="btn btn-danger" id="baja">Dar Baja</button></td>';

        } else if (val.estado === "cancel") {
            html +=
                '<td idmail="' +
                val.mailh + '" id_number="' + val.nroDoc + '" mail="' + val.correo +
                '" id_user="' + val.id + '" nombre="' + val.nombre + '" ><button id="enviarContrato" class="btn btn-danger" >Enviar Contrato</button></td>';
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

        val.tipoUsuario !== null ?
            html += "<td class='alert alert-primary'><strong>" + val.tipoUsuario + "</strong></td>" :
            html += "<td class='alert alert-primary'></td>";

        //cp

        val.cp !== null ?
            html += "<td class='alert alert-danger'><strong>" + val.cp + "</strong></td>" :
            html += "<td class='alert alert-danger'></td>";

        //localidad

        val.localidad !== null ?
            html += "<td class='alert alert-warning'><strong>" + val.localidad + "</strong></td>" :
            html += "<td class='alert alert-warning'></td>";


        //provincia

        val.provincia !== null ?
            html += "<td ><strong>" + val.provincia + "</strong></td>" :
            html += "<td ></td>";

        //domicilio

        val.domicilio !== null ?
            html += "<td ><strong>" + val.domicilio + "</strong></td>" :
            html += "<td ></td>";

        //pais

        val.pais !== null ?
            html += "<td ><strong>" + val.pais + "</strong></td>" :
            html += "<td ></td>";


        html += "<td class='alert alert-info'><strong>" + val.id + "</strong></td>";

        html += "<td>" + val.nombre + "</td>";

        //correo 
        html += "<td class='alert alert-light'><strong>" + val.correo + "</strong></td>";

        //ver datos

        html += "<td class='alert alert-dark' ><a class='btn btn-dark' id='noti' href='" + base_url + 'usuario/post&notif_id=' +
            val.id +
            '&sta=' + val.status_notifications + "'>Fotos / Info</a></td>";

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
                '<td> <a href="' + base_url + '/usuario/showContract&mh=' + val.mailh + '&idc=' + val.nroDoc + '" target="_blank"><button id="verContrato" class="btn btn-success" >Ver Contrato</button></a></td>';
        } else if (val.estado === "signed_contract") {
            html +=
                '<td> <a href="' + base_url + '/usuario/showContract&mh=' + val.mailh + '&idc=' + val.nroDoc + '" target="_blank"><button id="verContrato" class="btn btn-success" >Ver Contrato</button></a></td>';
        } else if (val.estado === "active") {
            html +=
                '<td> <a href="' + base_url + '/usuario/showContract&mh=' + val.mailh + '&idc=' + val.nroDoc + '" target="_blank"><button id="verContrato" class="btn btn-success" >Ver Contrato</button></a></td>';
        } else if (val.estado === "cancel") {
            html +=
                '<td>Contrato cancelado</td>';
        } else if (val.estado === "down") {
            html +=
                '<td> <a href="' + base_url + '/usuario/showContract&mh=' + val.mailh + '&idc=' + val.nroDoc + '" target="_blank"><button id="verContrato" class="btn btn-success" >Ver Contrato</button></a></td>';
        }
        html += "<td>" + val.tipoDeSolicitud + "</td>";
        html += "<td>" + val.momento + "</td>";
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
        if (val.motivo !== null) {
            html += "<td>" + val.motivo + "</td>";
            html += "<td>" + val.descripcion + "</td>";
        } else {
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
        beforeSend: function() {
            $("#loaderUsuarios").show()
            $("#loaderUsuarios").html('<div class="spinner-border text-primary" role="status"><span class="sr-only">Loading...</span></div>')
        },
    }).done(function(response) {
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

            if (object.stat === 'sign_contract') {
                setSatusUser(object)
            } else if (object.action === 'mensajeProntoActivo') {
                sendEmail(object);
            } else if (object.action === 'contratoEnviado') {
                sendEmail(object);
            } else if (object.stat === 'active') {
                setSatusUser(object)
            } else if (object.stat === 'otroAvisoActivo') {
                sendEmail(object);
            } else if (object.stat === 'down') {
                setSatusUser(object)
                removeUserTheCoverage(object.id_user, object.id_managent);

            }
        }
    })
}


function sendEmail(object) {

    $.ajax({
        url: "../helpers/email.php?email=" + object.method + "",
        type: "POST",
        data: { object },
        beforeSend: function() {},
    }).done(function(response) {
        $("#loaderUsuarios").hide()
        var objectResponse = JSON.parse(response);
        if (objectResponse.result === "1") {

            if (object.stat === 'sign_contract') {
                getDataUser(object)
                alertPositive("Contrato enviado exitosamente");
                coutNotificacions($("#id_user_default").val());
            } else if (object.stat === 'aviso') {
                alertPositive("Enviado con exito");
            } else if (object.stat === 'active') {
                alertPositive("Dado de alta exitosamente. El postulante recibio alerta por correo eléctronico");
                getDataUser(object)
                coutNotificacions($("#id_user_default").val());
            } else if (object.stat === 'otroAvisoActivo') {
                alertPositive("Enviado exitosamente!");
            } else if (object.stat === 'avisoEnviado') {
                alertPositive("Enviado exitosamente!");

            } else if (object.stat === 'down') {
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


function tableUser() {

    var table = $("#example").DataTable({
        columnDefs: [{ type: 'date', 'targets': [14] }],
        order: [
            [14, 'desc']
        ],
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
            info: "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
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
        buttons: [{
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



}

function table() {

    var table = $("#example").DataTable({

        language: {
            lengthMenu: "Mostrar _MENU_ registros",
            zeroRecords: "No se encontraron resultados",
            info: "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
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
        buttons: [{
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