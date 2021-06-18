const statsForm = localStorage.getItem('form');

var nombre = '';
var email = '';
var pass = '';
var cpass = '';
var tipo = '';
var i = '';
var m = '';
var mh = '';
var z = '';
var as = '';
var md = '';
var getCountryOnEstep = ''
var getProvinceOnEstep = ''
var getLocateOnEstep = ''
var getPostalCodeOnEstep = ''


const pais = document.getElementById('getPais')
const footer_dos = document.querySelector(".footer-dos")
const footer_dos_input = document.querySelector(".footer-dos-input")
const container_form = document.querySelector(".form-outer")

$(document).ready(function() {
    if (window.location.pathname.search('process') > -1) {
        textDifferentesByCountry()
    }

    getPaisSelect('#getPais')

    var getTypeLS = localStorage.getItem('tipo')

    if (getTypeLS !== null) {
        $("#form-tipo").val(getTypeLS)
    }
    // errores

    if (document.getElementById('errorMonotribute') !== null && document.getElementById('errorMonotribute') !== undefined) {
        const errorMonotribute = document.getElementById('errorMonotribute')
        localStorage.setItem('iden', 'n')
        errorMonotribute.style.display = 'none'
    }
    // errores
    $("#messageResponse").remove()
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

    $("#fecha").val(fecha)

    if (statsForm === 'y') {
        $("#requisitos").hide();
        $("#container-form").show();
    }


})

$(document).on("submit", "#form-one-step", function(e) {

    e.preventDefault();

    nombre = $("#form-name").val();
    email = $("#form-email").val();
    pass = $("#form-pass").val();
    cpass = $("#cform-pass").val();
    tipo = $("#form-tipo").val();
    getCountryOnEstep = $("#getPais").val()
    getProvinceOnEstep = $("#getProvincia").val()
    getLocateOnEstep = $("#getLocate").val()
    getPostalCodeOnEstep = $("#codigoPostal").val()
    var textpais = $("#pais").val()
    var textprovincia = $("#provincia").val()



    if (getCountryOnEstep === '0') {
        alertNegative('Debes seleccionar pais');
        return false;
    }
    if (getProvinceOnEstep === '0') {
        alertNegative('Debes selecionar provincia');
        return false;
    }
    if (getLocateOnEstep === '0') {
        alertNegative('Debes selecionar localidad');
        return false;
    }
    if (getPostalCodeOnEstep === '') {
        alertNegative('Debes ingresar tu codigo postal');
        return false;
    }
    if (nombre === '') {

        alertNegative('Debes ingresar tu nombre y apellido');
        return false;
    } else if (email === '') {

        alertNegative('Debes ingresar email')
        return false;

    } else if (!(/^[-_a-z0-9]+(\.[-_a-z0-9]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,15})/i).test($("#form-email").val())) {

        alertNegative('El email ingresado es invalido');
        return false;

    } else if (pass === '') {

        alertNegative('Debes ingresar la contraseña')
        return false;


    } else if (cpass === '') {

        alertNegative('Debes confirmar la contraseña')
        return false;

    } else if (pass !== cpass) {

        alertNegative('Las contraseñas deben coincidir')
        return false;

    } else if (tipo === '') {

        alertNegative('Vuelve a escoger tu modalidad de trabajo por favor')

        setTimeout(() => {
            window.location.href = base_url;
        }, 3000)
        return false;
    } else {

        sendDataFirstStep(nombre, email, pass, tipo, getLocateOnEstep, getPostalCodeOnEstep,
            textpais, textprovincia);
    }

})

function sendDataFirstStep(nombre, email, pass, tipo, getLocateOnEstep, getPostalCodeOnEstep,
    textpais, textprovincia) {

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
        url: "../controllers/usuarioController.php?usuario=registerOneStep",
        type: "POST",
        data: {
            nombre,
            email,
            pass,
            tipo,
            fecha,
            getLocateOnEstep,
            getPostalCodeOnEstep,
            textpais,
            textprovincia
        },
        beforeSend: function() {
            showLoader('#send-data', '.loaderBtn', '.txtFirstRegister');
        }
    }).done(function(response) {
        var object = JSON.parse(response)
        if (object[0].result === '1') {

            i = object[0].i;
            m = object[0].m;
            mh = object[0].mh;
            z = object[0].z;
            as = 'reonstp';
            md = 'regtp';

            sendEmail(nombre, i, m, mh, z, as, md, 'primerEmail');

        } else if (object[0].result === '2') {
            hideLoader('#send-data', '.loaderBtn', '.txtFirstRegister', 'Registrarme');
            alertNegative('El email ingresado ya esta registrado')
        }
    })

}

$(document).on('click', '#cont-message-response .reSendEmail', function() {

    showLoader('#cont-message-response', '.loaderBtn', '.txtSendEmail');

    // me quede en reenviar el email de nuevo
    sendEmail(nombre, i, m, mh, z, as, md, 'reenviar');

})

$(document).on("click", "#empezar", function() {

    $("#requisitos").hide();
    $("#container-form").show();
    localStorage.setItem('form', 'y')

})

$(document).on("change", "#getPais", function() {

    var idPais = $("#getPais").val()
    $('#getProvincia').prop("selectedIndex", 0)
    $("#localidad").val('')

    $("#pais").val($('select[name="getPais"] option:selected').text())
    getProvincia('#getProvincia', idPais)
    $("#loaderProvincia").append('<span id="loaderProvinciaCont" style="color:red;">Cargando...</span>')

    var codigopostal;
    if (idPais === '1') {
        codigopostal = 'https://www.correoargentino.com.ar/formularios/cpa';
        $("#label_contribuyente").text('Cuit')
    } else if (idPais === '2') {
        codigopostal = 'https://www.correo.com.uy/codigospostales';
        $("#label_contribuyente").text('Rut / Mides')
    }
    $("#box-cp").html('<a class="cp" id="" href="' + codigopostal + '" target="_blank">Consulta tu Codigo Postal</a>')
})

$(document).on('change', '#getProvincia', function() {
    $("#provincia").val($('select[name="getProvincia"] option:selected').text().toLowerCase())
    var idProvincia = $("#getProvincia").val()
    getLocate(idProvincia)
        .then(res => {
            console.log(res)
            var template = ''
            template = showLocate(res)
            $("#getLocate").html(template)
        })
        .catch(err => {
            console.log(err)
        })

    // document.getElementById('domicilio').value = ''
    // document.getElementById('numero-documento').value = ''
    // document.getElementById('monotributo').value = ''
    // document.getElementById('imgMonotributo').value = ''
    // document.getElementById('codigoPostal').value = ''
    // document.getElementById('localidad').value = ''
})

$(document).on('change', '#getLocate', function() {
    $("#localidad").val(this.value.toLowerCase())

})

function showLocate(res) {
    var html = ""
    res.forEach((val) => {
        html += "<option value='" + val.locate + "' > " + val.locate + "</option>"
    })

    return html

}

async function getLocate(idProvincia) {
    var promise = false
    var pais = $("#getPais").val()
    var object = new FormData()
    object.append('id_province', idProvincia)
    object.append('id_country', pais)

    await axios.post(base_url + 'controllers/coberturaController.php?cobertura=getLocate', object)
        .then(res => {
            if (res.data[0].result === '1') {
                promise = res.data
            } else {
                promise = false
            }
        })
        .catch(err => {
            console.log(err)
            promise = false
        })
    return promise
}

// validar primera pagina

$(document).on('click', '#primer-siguiente', function() {

    var domicilio = $('#domicilio').val()
    var monotributo = $('#monotributo').val()
    var imgMonotributo = $('#imgMonotributo').val()
    var tipoDocumento = $('#tipo-documento').val()
    var numeroDocumento = $('#numero-documento').val()
    var getImgMonotributo = $('#imgMonotributo').val()

    if (domicilio === '') {
        alertNegative("Debes ingresar tu domicilio")
        prevSecondPage()
    } else if (monotributo === '') {


        if (pais.value === 'Argentina') {
            showErrorMonotribute('Debe ingresar CUIT', 'block', 'n');
            prevSecondPage();
            return
        }
        if (pais.value === 'Uruguay') {
            alertNegative("Debes ingresar el RUT")
            prevSecondPage();
            return
        }


    } else if (numeroDocumento === '') {
        alertNegative("Debes ingresar tu numero de documento")
        prevSecondPage()
    } else if (localStorage.getItem('iden') === 'n') {

        if (pais.value === 'Argentina') {
            showErrorMonotribute('Debes revisar CUIT/CUIL', 'block', 'n');
        }
        if (pais.value === 'Uruguay') {
            alertNegative("Debes revisar el RUT")
        }

        prevSecondPage()
        return
    } else if ($('#numero-documento').val().length < 7) {
        alertNegative("El dni debe tener minimo de 7 digitos")
        prevSecondPage();

    } else if (imgMonotributo === '') {
        if (pais.value === 'Argentina') {
            alertNegative("Debes ingresar constancia de inscripcion AFIP")
            prevSecondPage();
            return
        }
        if (pais.value === 'Uruguay') {
            alertNegative("Debes ingresar constancia de RUT")
            prevSecondPage();
            return
        }
    } else if (imgMonotributo !== '') {

        if (pais.value === 'Argentina') {
            validarExt(getImgMonotributo, 'primeraPagina', 'Comprobante de inscripcion AFIP')
            return
        }
        if (pais.value === 'Uruguay') {
            validarExt(getImgMonotributo, 'primeraPagina', 'Comprobante de inscripcion DGI')
            return
        }
    }


})

function textDifferentesByCountry() {


    const tipoUser = localStorage.getItem('tipo')
    const textDomicilio = document.getElementById('textDomicilio')
    if (tipoUser === 'comercio') {
        textDomicilio.innerHTML = 'Domicilio comercial'
    } else {
        textDomicilio.innerHTML = 'Domicilio'
    }

    // var telefono = $('#telefono_celular').val()
    var pais = $('#getPais').val()


    const textNroCuit = document.getElementById('textNroCuit')
    const textImgConstancia = document.getElementById('textImgConstancia')
    const textImgCuil = document.getElementById('textImgCuil')

    if (pais === 'Argentina') {

        footer_dos_input.style.transform = 'none'
        footer_dos.style.transform = 'none'
        container_form.style.height = 'auto'
        textNroCuit.innerHTML = 'Ingrese CUIT'
        textImgConstancia.innerHTML = 'Constancia de inscripción AFIP'
        textImgCuil.innerHTML = 'Foto Constancia de CUIT'
        showErrorMonotribute('', 'none', 'n');
        $("#tipo-documento").prop("selectedIndex", 0)
    }
    if (pais === 'Uruguay') {
        footer_dos_input.style.transform = 'translateY(112px)'
        footer_dos.style.transform = 'translateY(100px)'
        container_form.style.height = '30rem'

        textNroCuit.innerHTML = 'Ingrese RUT'
        $("#tipo-documento").prop("selectedIndex", 1)

        let html = ''
        html += '<span><strong>Constancia de inscripción DGI</strong></span>';
        html += '<p><strong style="color:red;" >Nota:</strong> Debes ingresar al siguiente link  <a href="https://servicios.dgi.gub.uy/ServiciosEnLinea/dgi--servicios-en-linea--consulta-de-certifcado-unico" target="blank" > Constancia DGI</a></p>';
        html += '<p>- Descargar la constancia </p>';
        html += '<p>- Tomar captura de pantalla en la constancia </p>';
        html += '<p>- Clic en Selecionar archivo</p>';
        html += '</div>';

        textImgConstancia.innerHTML = html
        textImgCuil.innerHTML = 'Foto Constancia de RUT'
        showErrorMonotribute('', 'none', 'n');

    }

}

// validar segunda pagina


// validar cuit/rut
// validar monotributo
// validar rut
let role = $("#tipo-user").val()

var resultValidate = false
if (document.getElementById('monotributo') !== null && document.getElementById('monotributo') !== undefined) {

    document.getElementById('monotributo').addEventListener('keyup', function() {

        var thisMonotribute = this.value.trim().replace(/-/g, "")
        const monotributeClear = document.getElementById('monotributo').value = thisMonotribute
        if (monotributeClear !== '30709441023' && monotributeClear !== '') {
            delay(function() {
                validateDocumentCuit(monotributeClear)
            }, 500);
        } else {
            showErrorMonotribute('', 'none', 's');
            showErrorRut('', 'none', 's');
        }
    })
}

async function validateDocumentCuit(item) {
    await validateExistCuit(item)
        .then(res => {
            if (res !== 'success') {
                showErrorMonotribute('El documento ingresado ya existe', 'block', 'n');
                resultValidate = false
                return
            }
            showErrorMonotribute('', 'none', 's');
            resultValidate = true
            return
        })
        .catch(err => {
            showErrorMonotribute('err', 'block', 'n');
            resultValidate = false
            return
        })

    if (resultValidate) {
        if (pais.value === 'Argentina') {
            if (item === '') {
                showErrorMonotribute('Debe ingresar CUIT', 'block', 'n');
                return
            } else {
                if (pais.value === 'Argentina') {
                    await validateCuit(item)
                        .then(res => {
                            if (res !== 'success') {
                                showErrorMonotribute(res, 'block', 'n');
                                return
                            }
                            showErrorMonotribute('', 'none', 's');
                            return
                        })
                        .catch(err => {
                            showErrorMonotribute(err, 'block', 'n');
                            return
                        })
                }
            }
        }

        if (pais.value === 'Uruguay') {
            if (item === '') {
                if (pais.value === 'Uruguay') {
                    alertNegative('Debes ingresar el RUT')
                }
            } else {
                if (pais.value === 'Uruguay') {
                    showErrorMonotribute('', 'none', 'n');
                    validate_isRUT(item)
                        .then(res => {
                            if (!res) {
                                showErrorRut(' ' + ' ' + ' | ' + 'Rut inválido', 'inline', 'n');
                                return
                            }
                            showErrorRut('', 'none', 's');
                            return
                        })
                        .catch(err => {
                            showErrorRut(err, 'inline', 'n');
                            return
                        })
                }
            }
        }
    }

}

async function validateCuit(cuit) {
    var message = 'success'
    await axios.get('https://afip.tangofactura.com/Rest/GetContribuyenteFull?cuit=' + cuit + '')
        .then(res => {
            if (res.data.errorGetData) {
                return message = 'No existe Cuit/cuil'
            }
            if (res.data.Contribuyente.estadoClave === undefined) {
                return message = 'Debes regular situación en AFIP/'
            }
            if (res.data.Contribuyente.estadoClave !== 'ACTIVO') {
                return message = 'Debes regular situación AFIP'
            }
        })
        .catch(err => {
            return message = err
        })
    return message
}

async function validateExistCuit(cuit) {
    var message = 'success'
    await axios.get(base_url + 'controllers/usuarioController.php?usuario=validateCuit', {
            params: {
                cuit
            }
        })
        .then(res => {
            if (!res.data.result) {
                return message = 'El documento ingresado ya existe en nuestros registros'
            }
            return message = 'success'
        })
        .catch(err => {
            return message = err
        })
    return message
}

async function validate_isRUT(rut) {
    if (rut.length != 12) {
        return false;
    }
    if (!/^([0-9])*$/.test(rut)) {
        return false;
    }
    var dc = rut.substr(11, 1);
    var rut = rut.substr(0, 11);
    var total = 0;
    var factor = 2;

    for (i = 10; i >= 0; i--) {
        total += (factor * rut.substr(i, 1));
        factor = (factor == 9) ? 2 : ++factor;
    }

    var dv = 11 - (total % 11);

    if (dv == 11) {
        dv = 0;
    } else if (dv == 10) {
        dv = 1;
    }
    if (dv == dc) {
        return true;
    }
    return false;

}


function showErrorMonotribute(message, style, Storage) {
    localStorage.setItem('iden', Storage)
    errorMonotribute.style.display = style
    var html = "";
    html += '<div style="margin:10px 10px; color:white;">' + message + '</div>'
    errorMonotribute.innerHTML = html
}

function showErrorRut(message, style, Storage) {
    localStorage.setItem('iden', Storage)
    const textRut = document.getElementById('textRut')
    textRut.style.display = style
    var html = "";
    html += '' + message + ''
    textRut.innerHTML = html

}

$(document).on('click', '#secondNext', function() {

    var imgDocumentoFrontal = $('#imgDocumentoFrontal').val()
    var imgDocumentoDorsal = $('#imgDocumentoDorsal').val()
    var imgCuilRut = $('#imgCuilRut').val()
    var imgComprobanteDomicilio = $('#imgComprobanteDomicilio').val()

    if (imgDocumentoFrontal === '') {
        alertNegative('Debes ingresar imagen de tu documento (Frente del documento)')
        prevThirdPage()
    } else if (imgDocumentoDorsal === '') {
        alertNegative('Debes ingresar imagen de tu documento (Dorso del documento) ')
        prevThirdPage()
    } else if (imgCuilRut === '') {
        alertNegative('Debes ingresar una imagen de tu  cuil ó rut ')
        prevThirdPage()
    } else if (imgComprobanteDomicilio === '') {
        alertNegative('Debes ingresar un comprobante de tu domicilio')
        prevThirdPage()
    }

    if (docfront === 'fail' || docdor === 'fail' || cuil === 'fail' || domi === 'fail') {
        alertNegative("Asegurate de haber seleccionado archivos  .JPG O .PNG");
        prevThirdPage();
        return false
    }
})

// validar documento
$("#numero-documento").keyup(function() {
    delay(function() {
        validateDocument($("#numero-documento").val())
    }, 400);
});

$(document).on('change', '#monotributo', function() {
    var monotributo = $('#monotributo').val()
    var codigoPostal = $('#codigoPostal').val()

    if (monotributo === 'no') {

        $("#loaderMonotribute").append('<span id="loaderMonotributeCont" style="color:red;font-size:14px;">Cargando...</span>')
        getTelefonoAndIdOperator(codigoPostal)

    } else {
        $(".container-monotributo").hide();
    }

})

//  validar imagen monotributi
$(document).on('change', '#imgMonotributo', function() {
    var getImgMonotributo = $('#imgMonotributo').val()

    if (pais.value === 'Argentina') {
        validarExt(getImgMonotributo, 'terceraPagina', 'Constancia de inscripción AFIP')
    }
    if (pais.value === 'Uruguay') {
        validarExt(getImgMonotributo, 'terceraPagina', 'Constancia de inscripción DGI')
    }

})


// validar tercera pagina
$(document).on('click', '#preparar', function(e) {
    e.preventDefault();

    var imgFrontalPersona = $('#imgFrontalPersona').val()
    var telefono_celular = $('#telefono_celular').val()
    var imgFrontalCommerce = $("#imgFrontalCommerce").val()
    var template = "";

    if (imgFrontalPersona === '') {
        alertNegative('Debes ingresar una imagen frontal tuya (Selfie)');
        return false;
    } else if (!validarExtAlone(imgFrontalPersona, 'Foto frontal (selfie)')) {
        alertNegative('La foto frontal (Selfie) debe ser un archivo PNG o JPG');
        return false;
    } else if ($("#cont-commerce").length > 0 && imgFrontalCommerce === '') {

        alertNegative('Debes ingresar una foto frontal del comercio');
        return false;
    } else if ($("#cont-commerce").length > 0 && !validarExtAlone(imgFrontalCommerce, 'Foto frontal comercio')) {
        alertNegative('La foto frontal de comercio debe ser un archivo PNG o JPG')
        return false;
    } else if (telefono_celular === '') {
        alertNegative('Debes ingresar tu numero de telefono')
        return false;
    } else if ($('#telefono_celular').val().length < 8) {
        alertNegative('El telefono ingresado debe tener minimo 8 digitos de largo')
        return false;
    } else if ($('#telefono_celular').val().substr(0, 2) === '54') {
        alertNegative('El telefono ingresado debe ser Ejemplo: 11 12548596')
        return false;
    } else if ($('#telefono_celular').val().substr(0, 3) === '+54') {
        alertNegative('El telefono ingresado debe ser Ejemplo: 11 12548596')
        return false;
    } else if (countSubmit >= 1) {

        alertNegative('Asegurate de haber seleccionado un archivo .JPG O .PNG')
        return false;

    } else if ($('#via_conocimiento').val() === '0' || $('#via_conocimiento').val() === '') {
        alertNegative('Debes indicarnos por donde nos conociste')
        return false;
    } else {
        const datos = {
            pais: $('select[name="getPais"] option:selected').text(),
            provincia: $('select[name="getProvincia"] option:selected').text(),
            localidad: $('#localidad').val(),
            codigoPostal: $('#codigoPostal').val(),
            domicilio: $('#domicilio').val(),
            monotributo: $('#monotributo').val(),
            tipoDocumento: $('#tipo-documento').val(),
            numeroDocumento: $('#numero-documento').val(),
            telefono_celular: $('#telefono_celular').val(),
            via_conocimiento: $('#via_conocimiento').val()
        }
        $("#cont-selfie").hide()
        $("#cont-telefono").hide()
        $("#cont-conocimiento").hide()
        $("#cont-commerce").hide()
        $("#footer-btn").hide()
        template = showPreviusData(datos)
        $("#last-page").html(template)

    }

})

$(document).on('change', '#imgDocumentoFrontal', function() {
    var imgDocumentoFrontal = $('#imgDocumentoFrontal').val()
    validarExt(imgDocumentoFrontal, 'hoja4', 'Documento Frontal', 'docfont');

})

$(document).on('change', '#imgDocumentoDorsal', function() {
    var imgDocumentoDorsal = $('#imgDocumentoDorsal').val()
    validarExt(imgDocumentoDorsal, 'hoja4', 'Documento Dorsal', 'docdor');

})

$(document).on('change', '#imgCuilRut', function() {
    var imgCuilRut = $('#imgCuilRut').val()
    validarExt(imgCuilRut, 'hoja4', 'Comprobante de tu cuil ó rut', 'cuil');

})

$(document).on('change', '#imgComprobanteDomicilio', function() {
    var imgComprobanteDomicilio = $('#imgComprobanteDomicilio').val()
    validarExt(imgComprobanteDomicilio, 'hoja4', 'Comprobante de tu domicilio', 'domi');

})

//  validar cuarta pagina

//validar imagen personal
$(document).on('change', '#imgFrontalPersona', function() {
    var imgFrontalPersona = $('#imgFrontalPersona').val()
    validarExt(imgFrontalPersona, 'hoja5', 'Foto personal');
})

//validar imagen commercio
$(document).on('change', '#imgFrontalCommerce', function() {
    var imgFrontalCommerce = $('#imgFrontalCommerce').val()
    validarExt(imgFrontalCommerce, 'hoja5', 'Foto del comercio');
})

$(document).on('change', '#cont-conocimiento', function() {
    if ($("#via_conocimiento").val() === 'otros') {
        $("#via_conocimiento").remove();
        var template = "";
        template = otherTemplate();
        $("#cont-conocimiento").append(template);
    }
})

// $(document).on('click','#preparar',function(e){
// e.preventDefault()


// })

$(document).on('click', '#modificar', function(e) {
    e.preventDefault();
    $("#footer-btn").show()
    $("#cont-selfie").show()
    $("#cont-telefono").show()
    $("#cont-conocimiento").show()
    $("#cont-commerce").show()
    $("#cont-data").hide()

})

$(document).on('click', '#enviar', function() {

    $("#loaderSend").append('<img style="width:150px;height:100px;" src="../estilos/imagenes/front/loader.gif">')

})


//envio de primer email
function sendEmail(nombre, i, m, mh, z, as, md, centinela) {

    $.ajax({
        url: "../helpers/email.php?email=validateEmailRegister",
        type: "POST",
        data: { nombre, i, m, mh, z, as, md },
        beforeSend: function() {}
    }).done(function(response) {
        $("#loaderStepOne").hide();
        var object = JSON.parse(response)



        if (object.result === '1') {

            alertPositive('Correo enviado exitosamente!');

            if (centinela === 'reenviar') {

                hideLoader('#cont-message-response', '.loaderBtn', '.txtSendEmail', 'NO RECIBÍ EMAIL');
            } else if (centinela === 'primerEmail') {

                hideLoader('#send-data', '.loaderBtn', '.txtFirstRegister', 'Registrarme');
            }
            //  alertPositive("Revisa tu casilla de correo"+ m )
            $("#form-one-step").hide();

            if ($('.btn-send').length) {
                $('.btn-send').remove();
                $("#cont-message-response").append('<div class="btn-send"><h5 id="messageResponse" class="button text-center">Revisá tu casilla de correo </h5><h6 class="text-center" ><strong>' + m + '</strong></h6><br><p>¡Debes validar tu email para continuar con el siguiente paso!</p><div class="mx-auto text-center" ><button class="btn btn-danger reSendEmail"> <span class="spinner-border hiddenLoader loaderBtn" role="status"></span><span class="txtSendEmail">NO RECIBÍ EMAIL</span></button></div></div>')
                $("#form-one-step").trigger("reset");
                $('html, body').animate({
                    scrollTop: $('#tope').offset().top
                }, 500);

            } else {
                $("#cont-message-response").append('<div class="btn-send"><h5 id="messageResponse" class="button text-center">Revisá tu casilla de correo </h5><h6 class="text-center" ><strong>' + m + '</strong></h6><br><p>¡Debes validar tu email para continuar con el siguiente paso!</p><div class="mx-auto text-center" ><button class="btn btn-danger reSendEmail"> <span class="spinner-border hiddenLoader loaderBtn" role="status"></span><span class="txtSendEmail">NO RECIBÍ EMAIL</span></button></div></div>')
                $("#form-one-step").trigger("reset");
                $('html, body').animate({
                    scrollTop: $('#tope').offset().top
                }, 500);
            }


        }

    })

}

function showPreviusData(datos) {

    var html = "";

    html += '<div class="cont-data" id="cont-data">';
    html += '<p><span class="previusContenido" ><strong>Domicilio:</strong></span><span>' + datos.domicilio + '</span></p>';
    html += '<p><span class="previusContenido" ><strong>Monotributo:</strong></span><span>' + datos.monotributo + '</span></p>';
    html += '<p><span class="previusContenido" ><strong>Documento:</strong></span><span>' + datos.tipoDocumento + '</span></p>';
    html += '<p><span class="previusContenido" ><strong>Nro documento:</strong></span><span>' + datos.numeroDocumento + '</span></p>';
    html += '<p><span class="previusContenido" ><strong>Telefono:</strong></span><span>' + datos.telefono_celular + '</span></p>';
    html += '<p><span class="previusContenido" ><strong>Como nos conociste:</strong></span><span>' + datos.via_conocimiento + '</span></p>';
    html += '<div class="pie-button">';
    html += '<button class="button btn-send-form" type="submit" class="btn btn-success"  id="enviar" >Enviar</button>';
    html += '<button class="button btn-modify" id="modificar" >Modificar</button>';
    html += '</div>';
    html += '</div>';
    return html;

}

// enviar data de registro

//  sendDataRegister I'm not using it

function sendDataRegister() {

    var imgMonotributo = $('input[name="imgMonotributo"]')[0].files[0];
    var imgDocumentoFrontal = $('input[name="imgDocumentoFrontal"]')[0].files[0];
    var imgDocumentoDorsal = $('input[name="imgDocumentoDorsal"]')[0].files[0];
    var imgCuilRut = $('input[name="imgCuilRut"]')[0].files[0];
    var imgComprobanteDomicilio = $('input[name="imgComprobanteDomicilio"]')[0].files[0];
    var imgFrontalPersona = $('input[name="imgFrontalPersona"]')[0].files[0];

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

    const datos = new FormData();
    datos.append("imgMonotributo", imgMonotributo);
    datos.append("imgDocumentoFrontal", imgDocumentoFrontal);
    datos.append("imgDocumentoDorsal", imgDocumentoDorsal);
    datos.append("imgCuilRut", imgCuilRut);
    datos.append("imgComprobanteDomicilio", imgComprobanteDomicilio);
    datos.append("imgFrontalPersona", imgFrontalPersona);
    datos.append("pais", $('select[name="pais"] option:selected').text());
    datos.append("provincia", $('select[name="provincia"] option:selected').text());
    datos.append("localidad", $('#localidad').val());
    datos.append("codigoPostal", $('#codigoPostal').val());
    datos.append("domicilio", $('#domicilio').val());
    datos.append("monotributo", $('#monotributo').val());
    datos.append("tipo-documento", $('#tipo-documento').val());
    datos.append("numero-documento", $('#numero-documento').val());
    datos.append("telefono_celular", $('#telefono_celular').val());
    datos.append("via_conocimiento", $('#via_conocimiento').val());
    datos.append("fecha", fecha);
    datos.append("id_reclute_guia", $("#id_reclute_guia").val());



    $.ajax({
        url: '../controllers/usuarioController.php?usuario=registerComplete',
        type: 'POST',
        data: datos,
        processData: false,
        contentType: false,
        beforeSend: function() {
            $("#preparar").hide()
        },
    }).done(function(response) {
        $("#preparar").show()
        if (response === '1') {
            localStorage.clear()
            location.href = base_url + 'usuario/waiting';

        } else if (response === '2') {

            alertNegative("su registro no fue posible")
        } else if (response === '3') {
            alertNegative("Su registro no fue posible porque no ingresaste todos los datos requeridos")
        }
    })


}

//template para cuando notifica que nos conocio por otro motivo

function otherTemplate() {
    var html = "";
    html += '<input type="text" name="via_conocimiento" id="via_conocimiento" placeholder="Como nos conocio?">';
    return html;
}

// validar imagen
var docfront = 'success';
var docdor = 'success';
var cuil = 'success';
var domi = 'success';

var countSubmit = 0;

function validarExt(map, func, txt, centinela) {

    var extPermitidas = /\.(jpg|png|gif|jpeg)$/i;

    if (!extPermitidas.exec(map)) {

        alertNegativeInfo('Alerta de imagen', 'El achivo que intentas subir como ' + txt + ' tiene un formato no aceptado. El archivo puede tener estos formatos de imagen : ' + ' ' + ' .JPG | .PNG | .JPEG  ', 'error');

        if (func === 'primeraPagina') {
            prevSecondPage()
        } else if (func === 'hoja4') {

            if (centinela === 'docfont') {
                docfront = 'fail';
            } else if (centinela === 'docdor') {
                docdor = 'fail';
            } else if (centinela === 'cuil') {
                cuil = 'fail';
            } else if (centinela === 'domi') {
                domi = 'fail';
            }

        } else if (func === 'hoja5') {
            countSubmit++;
        }

        return false;
    } else {
        if (func === 'hoja4') {

            if (centinela === 'docfont') {
                docfront = 'success';
            } else if (centinela === 'docdor') {
                docdor = 'success';
            } else if (centinela === 'cuil') {
                cuil = 'success';
            } else if (centinela === 'domi') {
                domi = 'success';
            }


        } else if (func === 'hoja5') {

            countSubmit--;
            $("#preparar").show()
        }
    }
}

function validarExtAlone(map, txt) {

    var extPermitidas = /\.(jpg|png|gif|jpeg)$/i;

    if (!extPermitidas.exec(map)) {
        alertNegative('Debes ingresar una foto correcta de ' + txt);
        return false;
    } else {
        return true;
    }
}

//validar documento 

function validateDocument(object) {
    $.ajax({
        url: '../controllers/usuarioController.php?usuario=validateDocumento',
        type: 'POST',
        data: { object },
        beforeSend: function() {},
    }).done(function(response) {

        if (response === '2') {
            alertNegative("El documento ingresado ya existe!");
            $("#errorDoc").show()
            $("#errorDoc").html('duplicado')
            $("#secondNext").hide();
        } else if (response === '1') {
            $("#secondNext").show();
            $("#errorDoc").hide()
        }
    })


}

//traer telefono y id de operador que corresponda a codigo postal

function getTelefonoAndIdOperator(object) {
    $.ajax({
        url: '../controllers/usuarioController.php?usuario=telefonoAndIdOperator',
        type: 'POST',
        data: { object },
        beforeSend: function() {},
    }).done(function(response) {
        $("#loaderMonotributeCont").remove()
        var object = JSON.parse(response)
        var template = "";
        if (object[0].result === '1') {
            template += `
            <div class="mensajeMonotributo">Si no cuentas con monotributo comunicate con nosotros 
           <a href="https://api.whatsapp.com/send?phone=${object[0].telefono}&text=Hola%20Express%20,%20solicito%20información%20para%20trabajar%20como%20recolector%20.%20No%20poseo%20monotributo/Mides" target="_blank"><img class="imagen-mensaje" src="../estilos/imagenes/front/whatsapp.png" alt=""></a>
           </div>
            `;
            $(".container-monotributo").show();
            $("#box-monitributo").html(template)
        } else if (object[0].result !== '1') {
            template += `
            <div class="mensajeMonotributo">Si no cuentas con monotributo comunicate con nosotros 
            <a href="https:api.whatsapp.com/send?phone=+5491138741772&text=Hola%20Express%20,%20solicito%20información%20para%20trabajar%20como%20recolector%20.%20No%20poseo%20monotributo/Mides" target="_blank"><img class="imagen-mensaje" src="../estilos/imagenes/front/whatsapp.png" alt=""></a>
             </div>
             `;
            $(".container-monotributo").show();
            $("#box-monitributo").html(template);
        }


    })
}
// traer pais

function getPaisSelect(atributo) {

    $.ajax({
        url: "../controllers/equipoController.php?equipo=pais",
        beforeSend: function() {

        }
    }).done(function(response) {
        var objectPais = JSON.parse(response)
        var templatePais = "";
        templatePais += `<option value="0" >Seleccione Pais</option>`;
        if (objectPais[0].result === '1') {

            objectPais.forEach((val) => {
                templatePais += `
           <option value='${val.id}' >${val.country}</option>
           `;
            })
            $(atributo).html(templatePais)
        }

    })

}
//  traer provincias
function getProvincia(atributo, object) {
    var idPais = object;
    $.ajax({
        url: "../controllers/equipoController.php?equipo=provincias",
        type: "POST",
        data: { idPais },
        beforeSend: function() {

        }
    }).done(function(response) {
        $("#loaderProvinciaCont").remove()
        var objectProvincia = JSON.parse(response)

        var templateProvincia = "";
        templateProvincia += `<option value="0" >Seleccione Provincia</option>`;
        if (objectProvincia[0].result === '1') {

            objectProvincia.forEach((val) => {
                templateProvincia += `
               <option value='${val.id}' >${val.province}</option>
               `;
            })

            $(atributo).html(templateProvincia)

        }

    })
}

//  validar con keyup

var delay = (function() {
    var timer = 0;
    return function(callback, ms) {
        clearTimeout(timer);
        timer = setTimeout(callback, ms);
    };
})();

// MENSAJES

function alertPositive(str) {
    Swal.fire({
        icon: "success",
        title: str,
        showConfirmButton: false,
        timer: 1600,
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

function alertNegativeInfo(title, txt, img) {
    Swal.fire(
        title,
        txt,
        img
    )
    return false
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