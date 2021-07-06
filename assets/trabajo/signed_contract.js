var btnDonwload = document.getElementById("donwload");
var btnAccept = document.getElementById("acepto");
var btnDontAccept = document.getElementById("noacepto");
var modalSignedContract = document.getElementById("firmarContrato")


if (btnDonwload != null) {
    btnDonwload.addEventListener("click", () => {

        const invoice = this.document.getElementById("invoice");

        var opt = {
            margin: 0.3,
            filename: 'myfile.pdf',
            image: { type: 'jpeg', quality: 0.98 },
            html2canvas: { scale: 2 },
            jsPDF: { unit: 'in', format: 'letter', orientation: 'portrait' },
            pagebreak: { mode: ['avoid-all', 'css', 'legacy'] }
        };

        // New Promise-based usage:
        html2pdf().set(opt).from(invoice).save();

        //   // Old monolithic-style usage:
        //   html2pdf(element, opt);


        // html2pdf().from(invoice).save();
    })
}

if (btnAccept != null) {


    // domicilio.addEventListener("click",()=>{domicilio.removeAttribute('readonly')})
    //    $(telefono).on("click",function(){telefono.removeAttr("readonly")})
    btnAccept.addEventListener("click", () => {


        var marca = $("#marca")
        var modelo = $("#modelo")
        var patente = $("#patente")
        var getCbu = $("#cbu").val()
        var cbu = getCbu.replace(/ /g, "").replace(/-/g, "");

        var banco = $("#banco")
        var dayStart = $("#dayStart")
        var dayEnd = $("#dayEnd")
        var timeStart = $("#timeStart")
        var timeEnd = $("#timeEnd")

        var nombre_comercio = $("#nombre_comercio")

        if (dayStart.is(':visible')) {
            if (dayStart.val() === '0' || dayEnd.val() === '0') {
                alertNegative("Debes seleccionar el dia en los que abre y cierra el comercio")

                setTimeout(() => {
                    $('html, body').animate({
                        scrollTop: $('#topHorarios').offset().top
                    }, 500);
                }, 3000)
                return
            }

            if (timeStart.val() === '' || timeEnd.val() === '') {
                alertNegative("Debes ingresar los horarios del comercio")
                setTimeout(() => {
                    $('html, body').animate({
                        scrollTop: $('#topHorarios').offset().top
                    }, 500);
                }, 3000)
                return
            }

        }
        if (marca.is(':visible')) {
            if (marca.val() === "") { alertNegative('Debes ingresar la marca del auto'); return false; }
        }
        if (modelo.is(':visible')) {
            if (modelo.val() === "") { alertNegative('Debes ingresar el modelo del auto'); return false; }
        }
        if (patente.is(':visible')) {
            if (patente.val() === "") { alertNegative('Debes ingresar el nro de pantente del auto'); return false; }
        }
        if (nombre_comercio.is(':visible')) {
            if (nombre_comercio.val() === "") {
                alertNegative('Debes ingresar el nombre del comercio');
                return false;
            }
        }
        if (cbu === "") {

            alertNegative('Debes ingresar el CBU');
            return false;
        }
        if ($("#id_usuario_country").val() === 'Argentina') {
            if (cbu.length < 21) { alertNegative('El CBU debe tener minimo 21 digitos'); return false; }
        } else if ($("#id_usuario_country").val() === 'Uruguay') {
            if (cbu.length < 9) { alertNegative('El CBU debe tener minimo 9 digitos'); return false; }
        }
        //validar que pais es y segun el pais validar el cbu bro..

        if (!(/^[0-9]/g).test(cbu)) {
            alertNegative('El CBU debe estar conformado solo por numeros');
            return false;
        }
        if (banco.val() === "") { alertNegative('Debes ingresar el Banco'); return false; }
        if ($("#cuenta").val() === '0') {
            alertNegative('Debes escoger un tipo de cuenta');
            return false;
        }


        $("#firmarContrato").modal("show")

    })
}


$(document).on("click", "#noacepto", function() {


    var urlencodedtext = '%20Hola%20estuve%20mirando%20el%20contrato%20y%20no%20estoy%20conforme%20con%20el%20mismo'

    window.open('https:api.whatsapp.com/send?phone=541138622964&text=' + urlencodedtext, '_blank');

})



// Obtenenemos un intervalo regular(Tiempo) en la pamtalla
window.requestAnimFrame = (function(callback) {
    return window.requestAnimationFrame ||
        window.webkitRequestAnimationFrame ||
        window.mozRequestAnimationFrame ||
        window.oRequestAnimationFrame ||
        window.msRequestAnimaitonFrame ||
        function(callback) {
            window.setTimeout(callback, 1000 / 60);
            // Retrasa la ejecucion de la funcion para mejorar la experiencia
        };
})();

// Traemos el canvas mediante el id del elemento html
var canvas = document.getElementById("firma");
var ctx = canvas.getContext("2d");



$(canvas).on("touchmove", function() {

    $("#crear-imagen").show()
    $("#borrar-imagen").show()
})
$(canvas).on("click", function() {

    $("#crear-imagen").show()
    $("#borrar-imagen").show()
})


// Mandamos llamar a los Elemetos interactivos de la Interfaz HTML
// var urlImagen = document.getElementById("url-imagen");

var borrarImagen = document.getElementById("borrar-imagen");
// CREAR FIRMA SIMULA EL SIGUIENTE PERO DE FIRMAR !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
var crearImagen = document.getElementById("crear-imagen");
borrarImagen.addEventListener("click", function(e) {
    // Definimos que pasa cuando el boton imagen-creada es pulsado
    clearCanvas();
    $("#crear-imagen").hide()
}, false);

// Definimos que pasa cuando el boton crear-imagen es pulsado
crearImagen.addEventListener("click", function(e) {

    var hoy = new Date();
    var fecha = hoy.getFullYear() + '-' + ("0" + (hoy.getMonth() + 1)).slice(-2) + '-' +
        ("0" + hoy.getDate()).slice(-2);
    // esta fecha viene en este formato porque asi es que la guardo en el hostingla imagen

    $("#fechafirma").val(fecha)

    var dataUrl = canvas.toDataURL();

    var documento = $("#documentoFirmar").val().trim()
    var key = 'firmaContrato';

    if (documento == "") {
        alertNegative('Debes ingresar tu nro de documento');
        return false
    } else if (!(/^[0-9.]+$/).test(documento)) {

        alertNegative('El documento ingresado es inválido');
        return false
    } else {

        var marca = $("#marca").val()
        var modelo = $("#modelo").val()
        var patente = $("#patente").val()
        var getCbu = $("#cbu").val()
        var cbu = getCbu.replace(/[^0-9]/, "").replace(/-/g, "");
        var banco = $("#banco").val()
        if ($("#dayStart").is(':visible')) {
            var horarios = $("#dayStart").val() + '-' + $("#dayEnd").val() + ' ' + $("#timeStart").val() + '-' + $("#timeEnd").val()
        } else {
            var horarios = ''
        }

        var nombre_comercio = $("#nombre_comercio").val()
        var cuenta = $("#cuenta").val()

        Swal.fire({
            title: 'Estas por firmar el contrato. Revisaste todos los datos cuidadosamente?',
            text: "Aun tienes la posibilidad de modificar algún dato si te equivocaste",
            icon: 'info',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, estoy seguro!'
        }).then((result) => {
            if (result.isConfirmed) {

                $("#laoderfirma").html('<div class="spinner-border" role="status"><span class="sr-only">Loading...</span></div>')
                    //  reseteo formulario firmas

                $.ajax({
                        url: "../controllers/usuarioController.php?usuario=signedContract",
                        type: "post",
                        data: { marca, modelo, patente, fecha, key, dataUrl, documento, cbu, banco, horarios, nombre_comercio, cuenta },
                        beforedSend: function() {



                        },
                    }).done(function(response) {
                        var object = JSON.parse(response)


                        if (object[0].result === '1') {
                            var mh = $('#mh').val()
                            var idc = $('#idc').val()

                            var url = location.href = base_url + "usuario/showContract&mh=" + mh + "&idc=" + idc + "";

                            return true

                        } else if (object[0].result === '2') {
                            alertNegative('No se recibio la información correctamente')
                        } else if (object[0].result === '3') {
                            alertNegative('No se firmo el contrato exitosamente')
                        } else if (object[0].result === '4') {
                            alertNegative('No se recibieron los datos correctamente')
                        }

                    })
                    // 			$("#subspinner-firmar").hide()


            }
        })
    }


}, false);


// Activamos MouseEvent para nuestra pagina
var drawing = false;
var mousePos = { x: 0, y: 0 };
var lastPos = mousePos;
canvas.addEventListener("mousedown", function(e) {
    /*
      Mas alla de solo llamar a una funcion, usamos function (e){...}
      para mas versatilidad cuando ocurre un evento
    */
    var tint = document.getElementById("color");
    var punta = document.getElementById("puntero");
    // console.log(e);
    drawing = true;
    lastPos = getMousePos(canvas, e);
}, false);
canvas.addEventListener("mouseup", function(e) {
    drawing = false;
}, false);
canvas.addEventListener("mousemove", function(e) {
    mousePos = getMousePos(canvas, e);
}, false);

// Activamos touchEvent para nuestra pagina
canvas.addEventListener("touchstart", function(e) {
    mousePos = getTouchPos(canvas, e);
    // OJOOOOO console.log(mousePos);
    e.preventDefault(); // Prevent scrolling when touching the canvas
    var touch = e.touches[0];
    var mouseEvent = new MouseEvent("mousedown", {
        clientX: touch.clientX,
        clientY: touch.clientY
    });
    canvas.dispatchEvent(mouseEvent);
}, false);
canvas.addEventListener("touchend", function(e) {
    e.preventDefault(); // Prevent scrolling when touching the canvas
    var mouseEvent = new MouseEvent("mouseup", {});
    canvas.dispatchEvent(mouseEvent);
}, false);
canvas.addEventListener("touchleave", function(e) {
    // Realiza el mismo proceso que touchend en caso de que el dedo se deslice fuera del canvas
    e.preventDefault(); // Prevent scrolling when touching the canvas
    var mouseEvent = new MouseEvent("mouseup", {});
    canvas.dispatchEvent(mouseEvent);
}, false);
canvas.addEventListener("touchmove", function(e) {
    e.preventDefault(); // Prevent scrolling when touching the canvas
    var touch = e.touches[0];
    var mouseEvent = new MouseEvent("mousemove", {
        clientX: touch.clientX,
        clientY: touch.clientY
    });
    canvas.dispatchEvent(mouseEvent);
}, false);

// Get the position of the mouse relative to the canvas
function getMousePos(canvasDom, mouseEvent) {
    var rect = canvasDom.getBoundingClientRect();
    /*
      Devuelve el tamaño de un elemento y su posición relativa respecto
      a la ventana de visualización (viewport).
    */
    return {
        x: mouseEvent.clientX - rect.left,
        y: mouseEvent.clientY - rect.top
    };
}

// Get the position of a touch relative to the canvas
function getTouchPos(canvasDom, touchEvent) {
    var rect = canvasDom.getBoundingClientRect();
    //   OOOJOOOOOOO console.log(touchEvent);
    /*
      Devuelve el tamaño de un elemento y su posición relativa respecto
      a la ventana de visualización (viewport).
    */
    return {
        x: touchEvent.touches[0].clientX - rect.left, // Popiedad de todo evento Touch
        y: touchEvent.touches[0].clientY - rect.top
    };
}

// Draw to the canvas
function renderCanvas() {
    if (drawing) {
        var tint = document.getElementById("color");
        var punta = document.getElementById("puntero");
        ctx.strokeStyle = tint.value;
        ctx.beginPath();
        ctx.moveTo(lastPos.x, lastPos.y);
        ctx.lineTo(mousePos.x, mousePos.y);

        ctx.lineWidth = punta.value;
        ctx.stroke();
        ctx.closePath();
        lastPos = mousePos;
    }
}

function clearCanvas() {
    canvas.width = canvas.width;
}

// Allow for animation
(function drawLoop() {
    requestAnimFrame(drawLoop);
    renderCanvas();
})();



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
        timer: 3000,
        showConfirmButton: false,
    });
}