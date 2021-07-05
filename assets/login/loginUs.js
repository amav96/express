$(document).ready(function() {
    $(document).on('submit', '#form-login', function(e) {
        e.preventDefault()
        var username = document.getElementById("username").value;
        var password = document.getElementById("password").value;

        $.ajax({
            url: "../controllers/usuarioController.php?usuario=login",
            type: "POST",
            data: { username, password },
            beforeSend: function() {

                showLoader('#loguear', '.loaderBtn', '.txtLogin');

            },
            success: function(response) {
                hideLoader('#loguear', '.loaderBtn', '.txtLogin', 'Ingresar')

                var object = JSON.parse(response)




                if (object[0].result === '1') {


                    if (object[0].user.status_process === 'first') {

                        location.href = base_url + 'usuario/chekYourMail';

                    } else if (object[0].user.status_process === 'registered') {
                        location.href = base_url + 'usuario/waiting';
                    } else if (object[0].user.status_process === 'active' && object[0].user.role === 'admin') {

                        location.href = base_url + 'equipo/gestion';

                    } else if (object[0].user.status_process === 'active' && object[0].user.role === 'recolector' ||
                        object[0].user.role === 'comercio') {

                        location.href = base_url + 'equipo/collector';

                    } else if (object[0].user.role === 'superadmin') {

                        localStorage.setItem('tipo', 'admin');
                        location.href = base_url + 'usuario/Register';

                    } else if (object[0].user.status_process === 'down') {
                        alertNegative("No estas habilitado para iniciar sesión actualmente");
                        setTimeout(function() {
                            location.href = base_url;
                        }, 4000);
                    } else {
                        location.href = base_url;
                    }



                } else if (object[0].result === '2') {
                    alertNegative("La contraseña es incorrecta");
                    return false;

                } else if (object[0].result === '3') {
                    alertNegative("El email es incorrecto");
                    return false;
                } else {
                    true
                }

                object[0].user.status_process === 'registered' || object[0].user.status_process === 'sign_contract' || object[0].user.status_process === 'signed_contract'

            }
        });
    });
});


$(document).on('submit', '#form-recuperar', function(e) {

    e.preventDefault();

    var email = $('#email').val()


    if (email === '') {
        alertNegative("Debes ingresar email");
        return false;
    } else if (!/^[_a-z0-9]+(\.[_a-z0-9]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,15})/i.test(email)) {
        alertNegative("Email inválido");
        return false;
    } else {
        sendDataRestorePass(email, 'checkEmailToRestore')
    }

})

$(document).on('submit', '#form-restablecer', function(e) {
    e.preventDefault()

    var pOne = $('#form-pass-one').val()
    var pTwo = $('#form-pass-two').val()

    if (pOne === '') {
        alertNegative("Debes ingresar nueva contraseña")
        return false;
    } else if (pTwo === '') {
        alertNegative("Debes ingresar nuevamente la contraseña para verificar que coincidan")
        return false;
    } else {
        validatePassSubmit($('#form-pass-two').val())
    }

})

// validar contraseñas
// validar segunda contraseña
$("#form-pass-two").keyup(function() {
    delay(function() {
        validatePassKeypUp($("#form-pass-two").val());
    }, 300);
});



// delay time

var delay = (function() {
    var timer = 0;
    return function(callback, ms) {
        clearTimeout(timer);
        timer = setTimeout(callback, ms);
    };
})();


function updatePassword(object) {

    var i = $("#i").val()
    var p = $("#p").val()
    var mh = $("#mh").val()

    $.ajax({
        url: '../controllers/usuarioController.php?usuario=updatePassword',
        type: 'POST',
        data: { object, i, p, mh },
        beforeSend: function() {
            $("#cargarLoaderInsertarContrasena").append('<div id="loaderInsertando" class="spinner-border text-primary" role="status"><span class="sr-only">Loading...</span></div>')
        },
    }).done(function(response) {
        $("#loaderInsertando").remove()
        if (response === '1') {
            alertPositive("Has actualizado tu contraseña exitosamente!!")
            $("#i").val('')
            $("#p").val('')
            $("#mh").val('')
            $('#form-pass-one').val('')
            $('#form-pass-two').val('')

            redireccionarLoguin()

        } else if (response === '2') {

            alertNegative("No se actualizo su contraseña")
            return false;
        }
    })

}

function redireccionarLoguin() {
    setTimeout(function() {
        location.href = base_url + '/usuario/active';
    }, 3000);
}

function validatePassKeypUp(object) {
    var pOne = $('#form-pass-one').val()

    if (pOne !== object) {

        $("#txtError").html('Deben coincidar las contraseñas')

    } else {
        $("#txtError").html("");

    }

}

function validatePassSubmit(object) {
    var pOne = $('#form-pass-one').val()
    if (pOne !== object) {

        $("#txtError").html('Deben coincidar las contraseñas')
        return false;

    } else {

        updatePassword(object)

    }

}


function sendDataRestorePass(email, stat) {

    $.ajax({
        url: '../controllers/usuarioController.php?usuario=validateEmail',
        type: 'POST',
        data: { email, stat },
        beforeSend: function() {
            $("#cargarContrasena").append('<div id="loaderRecuperarContrasena" class="spinner-border" role="status"><span class="sr-only">Loading...</span></div>')
        },
    }).done(function(response) {
        $("#loaderRecuperarContrasena").remove()
        var object = JSON.parse(response);
        if (object[0].result === '1') {

            sendEmailRestorePass(object)

        } else if (object[0].result === '2') {
            $("#loaderRecuperarContrasena").remove()
            alertNegative("No se puede restaurar esta cuenta");
        } else if (object[0].result === '3') {
            $("#loaderRecuperarContrasena").remove()
            alertNegative("El email ingresado no pertenece a un usuario registrado");

        }

    })

}

function sendEmailRestorePass(object) {


    var hoy = new Date();
    var getMinutos = hoy.getMinutes();
    var getSegundos = hoy.getSeconds()
    var getHora = hoy.getHours()

    if (getMinutos < 10) {
        getMinutos = '0' + hoy.getMinutes()
    }
    if (getSegundos < 10) {
        getSegundos = '0' + hoy.getSeconds()
    }
    if (getHora < 10) {
        getHora = '0' + hoy.getHours()
    }

    var fecha = hoy.getFullYear() + '-' + ("0" + (hoy.getMonth() + 1)).slice(-2) + '-' +
        ("0" + hoy.getDate()).slice(-2) + ' ' + getHora + ':' + getMinutos + ':' + getSegundos;


    $.ajax({
        url: '../helpers/email.php?email=validateEmailPass',
        type: 'POST',
        data: { object, fecha },
        beforeSend: function() {

            $("#cargarContrasena").append('<div id="loaderRecuperarContrasena" class="spinner-border" role="status"><span class="sr-only">Loading...</span></div>')
        },
    }).done(function(response) {
        $("#loaderRecuperarContrasena").remove()
        alertPositive("te hemos enviado un correo electronico para verificar tu email")
    })



}


// MENSAJES

function alertPositive(str) {
    Swal.fire({
        icon: "success",
        title: str,
        showConfirmButton: false,
        timer: 2500,
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
    return false;
}

function showLoader(idParent, btnClass, txtClass) {

    $(idParent + ' ' + btnClass).removeClass('hiddenLoader');
    $(idParent + ' ' + txtClass).attr('disabled', true);
    $(idParent + ' ' + txtClass).text('');

}

function hideLoader(idParent, btnClass, txtClass, txtBtn) {

    $(idParent + ' ' + btnClass).addClass('hiddenLoader');
    $(idParent + ' ' + txtClass).attr('disabled', false);
    $(idParent + ' ' + txtClass).text(txtBtn);
}