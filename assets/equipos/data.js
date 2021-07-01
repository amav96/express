$(window).on("load", function() {
    $(".loader").fadeOut("slow");
});
var cont;

async function mostrarNuevaSeccion() {
    try {

        var id_user = $("#id_recoleorden").val()
        var form = new FormData();
        form.append('id_user', id_user)

        await axios.post('../controllers/noticeController.php?notice=searchNewSection',
                form)
            .then(res => {

                const dataDB = res.data
                if (dataDB[0].result) {
                    var htmlnew = `<a href="${base_url}notice/avisos" class="boton-new" > Nueva sección <i class="fas fa-ad"></i></a>`;
                    $("#gestion-nueva").append(htmlnew)
                        // var htmlnew = `<a  class="boton-new" > Nueva sección <i class="fas fa-ad"></i></a>`;
                        // $("#gestion-nueva").append(htmlnew)
                }

            })
            .catch(res => {
                alertNegative('Informacion : ' + res)
            })

        // const dataDB = await res

    } catch (error) {
        console.log(error)
    }


}

async function removeNewSection() {

    try {

        var id_user = $("#id_recoleorden").val()
        var form = new FormData();
        form.append('id_user', id_user)

        await axios.post('../controllers/noticeController.php?notice=removeNewSection',
                form)
            .then(res => {
                if (!res.data[0].result) {
                    alertNegative('Al parecer ocurrio problema. No afectara tu gestón')
                }
            })
            .catch(res => {
                alertNegative(res.data)

            })

    } catch (error) {
        alertNegative(error)
    }

}

function botonesSegunEstado() {
    const transaccionProcesada = localStorage.getItem('en')
    const equiposLS = JSON.parse(localStorage.getItem('transito'))

    if (transaccionProcesada === 's') {
        $("#text-caja-confirmar").text("Transacción actual")
        $("#finalizar-text").text("Finalizar transacción")
    }

    if (equiposLS !== null && equiposLS.length > 0) {
        if (transaccionProcesada === 'n') {
            $("#text-caja-confirmar").text("Confirmar transacción")
            $("#finalizar-text").text("Salir de transacción transacción")
        }

    }

}

$(document).on('click', '#gestion-nueva', function() {
    removeNewSection()
})

$(document).ready(function() {

    mostrarNuevaSeccion()

    $("#caja-box").html('<img  src="' + base_url + 'estilos/imagenes/front/box1.png" alt="">')
    $("#caja-box").fadeIn()

    // 1) LEO LO QUE HAY EN EL LOCALSTORAGE PARA LLENAR LA CAJA

    if (localStorage.getItem('transito')) {
        var trans = localStorage.getItem('transito')
        if (trans.length > 2) {
            $("#abrir-caja-equipos").show()
            $("#app").show()
        }
        if (trans.length <= 2) {
            $("#abrir-caja-equipos").hide()
            $("#app").hide()
        }
    } else {

        $("#abrir-caja-equipos").hide()
        $("#app").hide()

    }

    leerLocalStorageAlRecargarPagina();

    procesarEquipos();
    siHayUnEquipoAgregadoALacaja();
    ContarEquiposEnLS()
    leerDatosEquipos();
    leerDatosEquiposAutorizar();



    // 2) Si existe una orden generada, siempre mantener elementos para seguir operando



    if (JSON.parse(localStorage.getItem("odh")) !== null) {
        mantenerOrdenGeneradaAlActualizarPantallaSiNoHaFinalizado();
        asignoDatosDeLaOrdenYUsuarioDeLocalStorageEnFormularioDeRecupero();
    } else {
        VolverAlInicio();
    }

});



function asignoDatosDeLaOrdenYUsuarioDeLocalStorageEnFormularioDeRecupero() {

    //Obtener orden datos del localstorage

    var orderHasheada = JSON.parse(localStorage.getItem("odh"));
    var orderEntera = JSON.parse(localStorage.getItem("odi"));
    var idRecolector = JSON.parse(localStorage.getItem("rec"));


    $("#edit_id_orden_pass").val(orderHasheada);
    $("#edit_id_orden").val(orderEntera);
    $("#recolector").val(idRecolector);


}

//  3) HAGO CLICK EN INICIAR PARA COMENZAR UNA TRANSACCION



$(document).on("click", "#iniciar", function() {



    var id_recolector = $("#id_recoleorden").val();

    if (id_recolector === '') {
        alertNegative('Error de reconocimiento de recolector, comunicarse con operador/a');
        return false;

    }

    $("#caja-box").html('')
    $("#caja-box").hide()
    $("#q").val("");

    $("#app").show()
    $("#text-caja-confirmar").text("Confirmar transacción")


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

    var fechaMomento = hoy.getFullYear() + '-' + ("0" + (hoy.getMonth() + 1)).slice(-2) + '-' +
        ("0" + hoy.getDate()).slice(-2) + ' ' + getHora + ':' + getMinutos + ':' + getSegundos;


    $.ajax({
        url: "../controllers/equipoController.php?equipo=transaccion",
        type: "POST",
        data: { id_recolector, fechaMomento },
        beforeSend: function() {

        },
    }).done(function(response) {
        var reciboDatos = JSON.parse(response);

        if (reciboDatos.result === '1') {

            var recolector = reciboDatos.id_recolector;
            var ordenHash = reciboDatos.ordenHash;
            var ordenInt = reciboDatos.ordenInt;

            // 4) GUARDO INFORMACION EN EL LOCALSTORAGE DE LA ORDEN
            DarClickAIniciar();
            localStorage.setItem('rec', JSON.stringify(recolector));
            localStorage.setItem('odh', JSON.stringify(ordenHash));
            localStorage.setItem('odi', JSON.stringify(ordenInt));
            localStorage.setItem('en', 'n');


        } else {
            alertPositive('Vuelve a abrir la caja ');
            finalizarTransaccion();
            return false;

        }

    })

})

// 5) BUSCO CLIENTE Y MUESTROS DATOS DEL CLIENTE


$(document).on('submit', '#form-buscar', function(e) {

    e.preventDefault()
    var getDatoIngresado = $("#q").val().trim();
    var datoIngresadoABuscar = getDatoIngresado

    var ordenLSSub = localStorage.getItem("odi")
    var ordenhsLSSub = localStorage.getItem("odh")
    var recLsSub = localStorage.getItem("rec")

    if (ordenLSSub === null || ordenLSSub === '' || ordenhsLSSub === null || ordenhsLSSub === '' || recLsSub === null || recLsSub === '') {

        alertNegative('Vuelve a abrir la caja');
        finalizarTransaccion();
        return false;

    }

    if (datoIngresadoABuscar == "") {
        alertNegative('Complete cliente')
        return false;
    }
    if (datoIngresadoABuscar !== "") {
        if (!/^[-a-zA-Z0-9./]+$/.test(datoIngresadoABuscar)) {
            alertNegative('El número de identificacion tiene caracteres inválido')
            return false;
        }
    }

    searchCustomerDB(datoIngresadoABuscar);

})



//Dom

// 1) accesorios
// 2) motivo
// 3) accesorios otros
// 4) estado rec
// 5) terminal
// 6) serie
// 7) concide nro sim card / tarjeta
// 8) base serie

//    Botonera de acciones
var iniciarBtn = $("#iniciar");
var agregarEquipoBtn = $("#btnAutorizar");
var remitoBtn = $("#remito");

var cajaBtn = $("#abrir-caja-equipos");
var cajaBuscador = $("#cajaBuscador");
var valorBusqueda = $("#q");

var abrirFirmarBtn = $("#abrirfirmar");
var finalizarBtn = $("#finalizar");

var enviarBtn = $("#confirmar");

// textos informativas dinamicos

//COMPONENTES
var componentes = $("#componentes");
var accesorioUnoTxt = $("#txtComponenteUno");
var accesorioDosTxt = $("#txtComponenteDos");
var accesorioTresTxt = $("#txtComponenteTres");
var accesorioCuatroTxt = $("#txtComponenteCuatro");

// contenedores de informacion

//   1) accesorios
contAccesorioUno = $("#cont-accesorio-uno")
var contAccesorioDos = $("#cont-accesorio-dos");
var contAccesorioTres = $("#cont-accesorio-tres");
var contAccesorioCuatro = $("#cont-accesorio-cuatro");

var contenidoInputs = $("#inputEnBase")
    //   2) motivo
var contMotivo = $("#cont-motivo");

//   3) accesorios otros
var contAccesoriosOtros = $("#cont-accesorios-otros");

var contEstadoRec = $("#cont-estado-en-base");

var contTerminal = $("#cont-terminal");

var contSerieEnBase = $("#cont-serie-en-base");

var labelCoincideChip = $("#label-coincide-chip");
var contOpcionCoincideChip = $("#cont-opcion-coincide-chip");
var contSimCardEnBase = $("#cont-simCardEnBase");
var contChipAlt = $("#cont-chip-alt");

var contbaseSerie = $("#cont-base-serie");

// input

//   1)  accesorios
var accesorioUnoCheck = $('input[name="accesorio-uno"]');
var accesorioDosCheck = $('input[name="accesorio-dos"]');
var accesorioTresCheck = $('input[name="accesorio-tres"]');
var accesorioCuatroCheck = $('input[name="accesorio-cuatro"]');
//    1.1) accesorios radio
var siEntregaAccesorioDos = $("#si-entrega-accesorio-dos");
var noEntregaAccesorioDos = $("#no-entrega-accesorio-dos");
var siEntregaAccesorioCuatro = $("#si-entrega-accesorio-cuatro");
var noEntregaAccesorioCuatro = $("#no-entrega-accesorio-cuatro");

// 2) input motivo de retiro
var motivoSelect = $("#motivo-retiro-en-base");
// 3) input accesorios
var otrosAccesoriosINPUT = $("#input-otrosaccesorios-en-base");
// 4) estado rec
var estadoRecSelect = $("#estado-rec-en-base");

// 5) terminal
var terminalEnBaseINPUT = $("#input-terminal-en-base");
// 6)  serie
var serieEnBaseINPUT = $("#input-serie-en-base");
// 7) sim card
var chipEnBaseINPUT = $("#input-chip-base");
var chipAltINPUT = $("#input-chip-alt");
// 8) base serie
var baseSerieINPUT = $("#input-base-serie");

// -----------------------------------------

// 7) LLENAR FORMULARIOS CON DATOSE SEGUN EMPRESA



// -----------------------ENVIO DE DATA PARA POSNET -----------------------------//

// -------------LLENO FORMULARIO DE POSNET ----------------//

$(document).on('submit', '#form-buscar', function(e) {
    e.preventDefault()
    var datoIngresadoABuscar = $("#q").val().trim();
    pasarClienteAMayuscula = datoIngresadoABuscar.toUpperCase();

    inicialesEmpresa = pasarClienteAMayuscula.substr(0, 2);

    //resetear input checkbox terminal 

    var terminalCheckBox = $("#noVisibleTerminal")
    terminalCheckBox.prop("checked", false);
    var terminalEstylo = document.getElementById('input-terminal-en-base')
    terminalEstylo.style.background = "#D6EAF8";

    if (inicialesEmpresa === "PS") {
        // $("#input-serie-en-base").prop('disabled', false);

        $("#mantenerEnvioDeRemito").hide()

        setearDomFormBase()
        showAccesoryAndComponentsOfCompanyDifferent()

        // esconderCamposParaEmpezarPorComponentes();

        $("#editProductModal").on("show.bs.modal", function(event) {
            var button = $(event.relatedTarget);

            var id_equipo = button.data("id_equipo");
            $("#id_cli").val(id_equipo);

            var identificacionModal = button.data("identificacion");
            $("#edit_identificacion").val(identificacionModal);

            var tarjeta = button.data("tarjeta");
            chipEnBaseINPUT.val(tarjeta);


            var serie = button.data("serie");
            var terminal = button.data("terminal");

            serieEnBaseINPUT.val(terminal);

            terminalEnBaseINPUT.val(serie);
            localStorage.setItem('terminal', serie);

            var seriebase = button.data("seriebase");
            baseSerieINPUT.val(seriebase);

            var idd = button.data("idd");
            $("#idd").val(idd)

            // Dato Nombre para modal firmar

            var nombre_cliente = button.data("nombre");
            $("#nombre_cliente").val(nombre_cliente);

            $("#nombreaclaracion").val(nombre_cliente);
        });


    }
})

$(document).on('click', '#abrirEquipo', function() {
    resetearDomFormBase();

})

// MUESTRO LOS ACCESORIOS A MEDIDA QUE VOY SELECCIONANDO POSNET

$(document).on("click", "#abrirEquipo", function() {

    var datoIngresadoABuscar = $("#q").val().trim();
    pasarClienteAMayuscula = datoIngresadoABuscar.toUpperCase();

    inicialesEmpresa = pasarClienteAMayuscula.substr(0, 2);

    if (inicialesEmpresa === "PS") {
        var terminalCheckBox = $("#noVisibleTerminal")
        terminalCheckBox.prop("checked", false);
        $("#input-terminal-en-base").attr("readonly", true);

        if ($("#input-serie-en-base").val() !== '') {
            $("#input-serie-en-base").prop('readonly', true);
        } else {
            $("#input-serie-en-base").prop('readonly', false);
        }


        var terminalEstylo = document.getElementById('input-terminal-en-base')
        terminalEstylo.style.background = "#D6EAF8";
        showFormDiferent()

    }
})


$(siEntregaAccesorioDos).click(function() {

    var datoIngresadoABuscar = $("#q").val().trim();
    pasarClienteAMayuscula = datoIngresadoABuscar.toUpperCase();
    inicialesEmpresa = pasarClienteAMayuscula.substr(0, 2);

    if (inicialesEmpresa === "PS") {

        ifYouDeliverAccessoryNumberTwoFromTheDifferentCompany()
    }
})

$(noEntregaAccesorioDos).click(function() {

    var datoIngresadoABuscar = $("#q").val().trim();
    pasarClienteAMayuscula = datoIngresadoABuscar.toUpperCase();
    inicialesEmpresa = pasarClienteAMayuscula.substr(0, 2);

    if (inicialesEmpresa === "PS") {

        ifYouDoNotDeliverAccessoryNumberTwoFromAnotherCompany()
    }
})

$(siEntregaAccesorioCuatro).click(function() {
    var datoIngresadoABuscar = $("#q").val().trim();
    pasarClienteAMayuscula = datoIngresadoABuscar.toUpperCase();

    inicialesEmpresa = pasarClienteAMayuscula.substr(0, 2);

    if (inicialesEmpresa === "PS") {
        ifYouDeliverAccessoryNumberFourFromAnotherCompany()
    }
})

$(noEntregaAccesorioCuatro).click(function() {
    var datoIngresadoABuscar = $("#q").val().trim();
    pasarClienteAMayuscula = datoIngresadoABuscar.toUpperCase();

    inicialesEmpresa = pasarClienteAMayuscula.substr(0, 2);

    if (inicialesEmpresa === "PS") {

        ifYouDoNotDeliverAccessoryNumberFourFromAnotherCompany()
    }
})

// entrega sim card

$("#nro_chip_no").click(function() {
    doeNnotDeliverChip()
});


$("#nro_chip_si").click(function() {
    ifItDeliversChip()
})


// -------------ENVIO DATOS DE RECUPERO POSNET ----------------//


$(document).on("click", "#salirModal", function() {
    var datoIngresadoABuscar = $("#q").val().trim();
    pasarClienteAMayuscula = datoIngresadoABuscar.toUpperCase();

    inicialesEmpresa = pasarClienteAMayuscula.substr(0, 2);

    if (inicialesEmpresa === "PS") {

        contOpcionCoincideChip.hide()
        labelCoincideChip.hide()
        resetCompanyDifferent();
        setearDomFormBase()
        localStorage.removeItem('terminal')
        var terminalEstylo = document.getElementById('input-terminal-en-base')
        terminalEstylo.style.background = "#D6EAF8";

    }
})

// envio de formulario equipos en base
$("#confirmar").click(function() {

    var datoIngresadoABuscar = $("#q").val().trim();
    pasarClienteAMayuscula = datoIngresadoABuscar.toUpperCase();

    inicialesEmpresa = pasarClienteAMayuscula.trim().toUpperCase().substr(0, 2);
    // prueba


    //validacion de campos / datos

    //  if (inicialesEmpresa === "PS") {

    if (contTerminal.is(":visible")) {

        if (terminalEnBaseINPUT.val() === "") {
            alertNegative('Debes ingresar nro de terminal');
            return false;
        }

        if (terminalEnBaseINPUT.val().length < 5) {

            alertNegative('La terminal debe tener minimo 5 digitos');
            return false;
        }
    }




    if (contChipAlt.is(":visible")) {

        if (chipAltINPUT.val() === "") {
            alertNegative('Debes ingresar el numero de SIM');
            return false;
        }

        if (chipAltINPUT.val().length < 19) {

            alertNegative('La SIM debe tener un minimo de 19 digitos');
            return false;
        }
    }

    if (contSerieEnBase.is(":visible") || serieEnBaseINPUT.is(":visible")) {

        if (serieEnBaseINPUT.val() === "") {
            if (inicialesEmpresa === 'MV' || inicialesEmpresa === 'CL') {
                alertNegative('Debes ingresar nro de MAC');
                return false;
            }

            alertNegative('Debes ingresar la serie del equipo');
            return false;

        } else if (serieEnBaseINPUT.val().length < 5 && inicialesEmpresa != 'MV' && inicialesEmpresa != 'CL') {
            alertNegative('La serie debe tener un minimo de 5 digitos');
            return false;
        }

    }

    if (baseSerieINPUT.is(":visible")) {


        if (baseSerieINPUT.val() === "") {
            alertNegative('Debes ingresar la serie de la base');
            return false;
        }

        if (baseSerieINPUT.val().length < 5) {

            alertNegative('La serie de la base debe tener un minimo de 5 digitos');
            return false;
        }
    }

    // }
    if (inicialesEmpresa === "IP" || inicialesEmpresa == "MV" || inicialesEmpresa == "CL") {

        if (inicialesEmpresa === 'MV' || inicialesEmpresa == "CL") {
            let validate = validateMovistar()
            if (!validate) {
                return false
            }

        }

        if (serieEnBaseINPUT.val() === "") {
            alertNegative('Debes ingresar la serie del equipofd');
            return false;
        }



    }
});

// -------------CARGAR  DATA PARA LAPOS ----------------//
//°°°°°°°°°°°°°°°LAPOS°°°°°°°°°°°°°°°°°°°

//-------------------Formulario Cliente Lapos------------------------------------------//

// BUSCAR CLIENTES LAPOS 
$(document).on('submit', '#form-buscar', function(e) {
    e.preventDefault()
    var datoIngresadoABuscar = $("#q").val().trim();

    pasarClienteAMayuscula = datoIngresadoABuscar.toUpperCase();

    inicialesEmpresa = pasarClienteAMayuscula.substr(0, 2);

    if (inicialesEmpresa === "LA" || inicialesEmpresa === "GC") {

        // $("#input-serie-en-base").prop('disabled', false);
        $("#mantenerEnvioDeRemito").hide()

        $("#mantenerEnvioDeRemito").hide()

        setearDomFormBase()
        showAccesoryAndComponentsOfCompanyDifferent()

        $("#editProductModal").on("show.bs.modal", function(event) {
            var button = $(event.relatedTarget);

            var id_equipo = button.data("id_equipo");
            $("#id_cli").val(id_equipo);

            var identificacionModal = button.data("identificacion");
            $("#edit_identificacion").val(identificacionModal);

            var terminal = button.data("terminal");
            var serie = button.data("serie");

            terminalEnBaseINPUT.val(serie);
            localStorage.setItem('terminal', serie);
            var idd = button.data("idd");
            $("#idd").val(idd)


            serieEnBaseINPUT.val(terminal);

            // $("#input-serie-en-base").val(serie)


            var tarjeta = button.data("tarjeta");
            chipEnBaseINPUT.val(tarjeta);

            // Dato Nombre para modal firmar

            var nombre_cliente = button.data("nombre");
            $("#nombre_cliente").val(nombre_cliente);

            $("#nombreaclaracion").val(nombre_cliente);
        });


    }
})

//   MUESTRO ACCESORIOS PARA LAPOS

// RECUPERAR LAPOS

$(document).on("click", "#abrirEquipo", function() {


    var datoIngresadoABuscar = $("#q").val().trim();
    pasarClienteAMayuscula = datoIngresadoABuscar.toUpperCase();

    inicialesEmpresa = pasarClienteAMayuscula.substr(0, 2);

    if (inicialesEmpresa === "LA" || inicialesEmpresa === "GC") {
        var terminalCheckBox = $("#noVisibleTerminal")
        terminalCheckBox.prop("checked", false);
        var terminalEstylo = document.getElementById('input-terminal-en-base')
        terminalEstylo.style.background = "#D6EAF8";

        showFormCommon()
    }

    if ($("#input-serie-en-base").val() !== '') {
        $("#input-serie-en-base").prop('readonly', true);
    } else {
        $("#input-serie-en-base").prop('readonly', false);
    }

});

// ENVIO DATOS DE RECUPERO LAPOS
$(document).on("click", "#salirModal", function() {
    var datoIngresadoABuscar = $("#q").val().trim();
    pasarClienteAMayuscula = datoIngresadoABuscar.toUpperCase();

    inicialesEmpresa = pasarClienteAMayuscula.substr(0, 2);

    if (inicialesEmpresa === "LA" || inicialesEmpresa === "GC") {
        localStorage.removeItem('terminal')
        var terminalEstylo = document.getElementById('input-terminal-en-base')
        terminalEstylo.style.background = "#D6EAF8";
        setearDomFormBase()
        resetCompanyCommon()
    }
});

$("#confirmar").click(function() {
    if (inicialesEmpresa === "LA" || inicialesEmpresa === "GC") {

        if (contSerieEnBase.is(":visible")) {

            if (serieEnBaseINPUT.val() === "") {

                alertNegative('Debes ingresar el numero de serie');
                return false;

            } else if (serieEnBaseINPUT.val().length < 5) {

                alertNegative('La serie debe tener un minimo de 5 digitos');
                return false;
            }
        }
    }
});

//°°°°°°°°°°°LAPOS°°°°°°°°°°°°°°


//   NORMALES
//-------------------Formulario Cliente Normales------------------------------------------//
$(document).on('submit', '#form-buscar', function(e) {
    e.preventDefault()
    var datoIngresadoABuscar = $("#q").val().trim();
    pasarClienteAMayuscula = datoIngresadoABuscar.toUpperCase();

    inicialesEmpresa = pasarClienteAMayuscula.substr(0, 2);

    if (inicialesEmpresa !== "LA" && inicialesEmpresa !== "PS" && inicialesEmpresa !== "GC") {

        $("#mantenerEnvioDeRemito").hide()
        setearDomFormBase()
        showAccesoryAndComponentOfCompanyCommon()

        $("#editProductModal").on("show.bs.modal", function(event) {
            var button = $(event.relatedTarget);

            var id_equipo = button.data("id_equipo");
            $("#id_cli").val(id_equipo);

            var identificacionModal = button.data("identificacion");
            $("#edit_identificacion").val(identificacionModal);

            var terminal = button.data("terminal");
            terminalEnBaseINPUT.val(terminal);

            var idd = button.data("idd");
            $("#idd").val(idd)

            var serie = button.data("serie");
            serieEnBaseINPUT.val(serie);


            //   Dato Nombre para modal firmar

            var nombre_cliente = button.data("nombre");
            $("#nombre_cliente").val(nombre_cliente);

            $("#nombreaclaracion").val(nombre_cliente);


        });
    }
})

// MUESTRO LOS ACCESORIOS A MEDIDA QUE VOY SELECCIONANDO °°°°NORMAL°°°

$(document).on("click", "#abrirEquipo", function() {

    $("#mantenerEnvioDeRemito").hide()
    var datoIngresadoABuscar = $("#q").val().trim();
    pasarClienteAMayuscula = datoIngresadoABuscar.toUpperCase();

    inicialesEmpresa = pasarClienteAMayuscula.substr(0, 2);

    if (inicialesEmpresa !== "LA" && inicialesEmpresa !== "PS" && inicialesEmpresa !== "GC") {
        $("#input-serie-en-base").prop('readonly', true);
        showFormCommon()

        if (inicialesEmpresa == "IP" || inicialesEmpresa == "MV" || inicialesEmpresa == "CL") {

            $("#input-serie-en-base").prop('readonly', false);
        }

    }
});



$(document).on("click", "#salirModal", function() {
    var datoIngresadoABuscar = $("#q").val().trim();
    pasarClienteAMayuscula = datoIngresadoABuscar.toUpperCase();

    inicialesEmpresa = pasarClienteAMayuscula.substr(0, 2);

    if (inicialesEmpresa !== "LA" && inicialesEmpresa !== "PS" && inicialesEmpresa !== "GC") {

        $(document).on("click", "#salirModal", function() {

            setearDomFormBase()

            resetCompanyCommon()
        });
    }
});

// abrir la caja // terminales listas
$(document).on('click', '#abrir-caja-equipos', function() {
    siHayUnEquipoAgregadoALacaja();
    $("#caja-de-equipos").modal("show");

})

// SEND TO INFO BACKEND

$(abrirFirmarBtn).click(function() {

    Swal.fire({
        title: '¿Revisaste detalladamente la información ?',
        text: "Aun podes realizar alguna modificación",
        icon: 'success',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si',
        cancelButtonText: 'No'
    }).then((result) => {
        if (result.isConfirmed) {

            var getTransitoEstadosMotivos = JSON.parse(localStorage.getItem('transito'))
            var flag = '';
            var flagdb = '';

            getTransitoEstadosMotivos.forEach((val) => {

                if (val.estado === 'RECUPERADO' || val.estado === 'AUTORIZAR') {

                    $("#crear-imagen").hide()
                    $("#borrar-imagen").hide()
                    $("#caja-de-equipos").modal("hide");
                    $("#firmar").modal("show");

                    flag = '1';
                    flagdb = '1';

                } else if (val.estado !== 'RECUPERADO' && val.estado !== 'AUTORIZAR') {
                    flag = '0';
                }
            })
            if (flag !== '1' && flagdb !== '1') {
                recuperar();
                flag = '';
            }
        }
    })
})


function recuperar() {

    let sendData = JSON.parse(localStorage.getItem('transito'))
    localStorage.setItem('en', 's');
    localStorage.setItem('te', 're');

    $.ajax({
        url: "../controllers/equipoController.php?equipo=recuperar",
        type: "POST",
        data: { sendData },
        beforeSend: function() {
            $("#laoderenbase").show()
            $("#laoderenbase").html('<div class="spinner-border" role="status"><span class="sr-only">Loading...</span></div>')
        },
        success: function(response) {

            $("#laoderenbase").hide()

            if (response === '1') {
                alertPositive('Equipos cargados con exito!');
                $("#caja-de-equipos").modal("hide");
                finalizarTransaccion();

            }
            if (response === '2') {
                alertNegative('Error CODE DB');
                return false;
            }
            if (response === '3') {
                alertNegative('Error CODE AR DATA');
                return false;
            }

        }

    })

}

// enviar datos de recupero a la base de datos

$("#siguienteNormal").click(function() {

    let sendData = JSON.parse(localStorage.getItem('transito'))
    Swal.fire({
        title: '¿Revisaste detalladamente la información ?',
        text: "Aun podes realizar alguna modificación",
        icon: 'success',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si',
        cancelButtonText: 'Modificar'
    }).then((result) => {
        if (result.isConfirmed) {
            $("#laoderenbase").show()
            $("#laoderenbase").html('<div class="spinner-border" role="status"><span class="sr-only">Loading...</span></div>')

            $.ajax({
                url: "../controllers/equipoController.php?equipo=recuperar",
                type: "POST",
                data: { sendData },
                success: function(response) {
                    $("#laoderenbase").hide()

                    if (response === '1') {

                        localStorage.setItem('en', 's');
                        localStorage.setItem('te', 're');

                        $("#text-caja-confirmar").text("Transacción actual")
                        $("#finalizar-text").text("Finalizar transacción")
                        $("#btnAutorizar").hide()

                        $("#caja-de-equipos").modal("hide");

                        var getTransitoEstadosMotivos = JSON.parse(localStorage.getItem('transito'))
                        var flag = '';
                        var flagdb = '';

                        getTransitoEstadosMotivos.forEach((val) => {

                            if (val.estado === 'RECUPERADO' || val.estado === 'AUTORIZAR') {
                                $("#modoEmail").val("remitoRecupero")
                                $("#enviarRemito").modal("show");
                                veryCountry();
                                $("#closeEnvioRemito").hide();

                                flag = '1';
                                flagdb = '1';

                            } else if (val.estado !== 'RECUPERADO' && val.estado !== 'AUTORIZAR') {
                                flag = '0';
                            }
                        })
                        if (flag !== '1' && flagdb !== '1') {



                            alertPositive('Notificado exitosamente')
                            finalizarTransaccion();

                            flag = '';
                        }



                        // modo de envio de email

                    }
                    if (response === '2') { alertNegative('Error CODE DB'); return false; }
                    if (response === '3') { alertNegative('La firma ingresada ya existe!'); return false; }
                }

            })

        }
    })
})

function veryCountry() {

    if ($("#country_recolector").val() === 'Argentina') {
        document.getElementById('numeroWats').placeholder = 'Obligatorio anteponer el (54) antes del número';
    } else if ($("#country_recolector").val() === 'Uruguay') {
        document.getElementById('numeroWats').placeholder = 'Obligatorio anteponer el (598) antes del número';
    }


}

//  enviar remito digital -----------------

$(document).on("click", "#btnEnviarRemito", function() {

    var emailDestino = $("#email-remito").val()
    var codCapture = $("#codEmail").val()

    if (emailDestino === '') {
        alertNegative('Debes ingresar el email');
        return false;
    } else if (!(/^[_a-z0-9]+(\.[_a-z0-9]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,15})/i).test(emailDestino)) {

        alertNegative('El email ingresado es invalido');
        return false;
    } else if (codCapture === '') {

        youMustManageATeam();
        return false
    } else if ($("#modoEmail").val() !== 'remitoConsignacion' && $("#modoEmail").val() !== 'remitoRecupero') {

        alertNegative('Debes gestionar un equipo para enviar un remito');
        return false;
    } else {
        var modo = $("#modoEmail").val();

        //llenar este objeto si transito existe, si no es client aconsignacion y hacer otro objeto apra eso
        var getDatosCliente = JSON.parse(localStorage.getItem('transito'));
        if (getDatosCliente !== null) {
            //remito recupero transito
            var identificacion = getDatosCliente[0].identificacion;
            var id_orden = getDatosCliente[0].codHash;
            var id_user = getDatosCliente[0].codUser;

        } else {
            //remito a consignacion
            var identificacion = $("#documentoConsignacion").val();
            var id_orden = $("#documentoConsignacion").val();
            var id_user = $("#id_recoleorden").val();
        }
        var mail = $("#email-remito").val()
        var numeroWhatsapp = $("#numeroWats").val()
        var telefono = numeroWhatsapp !== '' ? numeroWhatsapp.replace(/ /g, "") : '';

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

        const datosCliente = {
            id_user,
            id_orden,
            identificacion,
            telefono,
            mail,
            fecha,
            elemento: 'clickEmail'
        }

        $.ajax({
            url: "../helpers/email.php?email=remito",
            type: "POST",
            data: { emailDestino, codCapture, modo },
            beforeSend: function(objeto) {
                $("#subspinner-remito").show()
            },
            success: function(response) {

                if (response) {
                    var respuestaEmail = JSON.parse(response)
                    if (respuestaEmail.result === 1) {
                        $("#subspinner-remito").hide()
                        $("#closeEnvioRemito").show();
                        alertPositive('Remito enviado con exito!');
                        localStorage.setItem('rem', 's')
                        saveDataCliente(datosCliente);
                    }
                    if (respuestaEmail.result === 2) {
                        $("#subspinner-remito").hide()
                        alertNegative('Envio de email rechazado, revise cuidadosamente el email ingresado');
                        return false
                    }
                }
            }
        })
    }
})

// enviar remito por whatsapp

$("#sendWhats").click(function() {
    var numeroWhatsapp = $("#numeroWats").val()
    var numW = numeroWhatsapp.replace(/ /g, "");

    var exNumWAr = numW.substr(0, 2)
    var exNumWUr = numW.substr(0, 3)

    var getDatosCliente = JSON.parse(localStorage.getItem('transito'));

    if (getDatosCliente !== null) {
        //remito recupero transito
        var identificacion = getDatosCliente[0].identificacion;
        var id_orden = getDatosCliente[0].codHash;
        var id_user = getDatosCliente[0].codUser;

    } else {
        //remito a consignacion
        var identificacion = $("#documentoConsignacion").val();
        var id_orden = $("#documentoConsignacion").val();
        var id_user = $("#id_recoleorden").val();
    }


    var mail = $("#email-remito").val() !== '' ? $("#email-remito").val() : '';
    var telefono = numeroWhatsapp !== '' ? numeroWhatsapp.replace(/ /g, "") : '';
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

    const datosCliente = {
        id_user,
        id_orden,
        identificacion,
        telefono,
        mail,
        fecha,
        elemento: 'clickWhatsapp'
    }


    if (numW === '') {
        alertNegative('Debes ingresar el Nro de Whatsapp');
        return false
    } else if (!(/^[0-9+]+$/).test(numW)) {

        alertNegative('Solo se aceptan numeros y el signo +');
        return false
    } else if (numW.length > 14) {
        alertNegative('El numero puede tener hasta un máximo de 14 digitos ');
        return false
    } else if ($("#country_recolector").val() === 'Argentina') {
        if (exNumWAr !== '54') {
            alertNegative('Debes incluir el codigo Pais (54) seguido del Número. Ejemplo : 54 5555-7777 ');
            return false
        } else if (numW.length < 10) {
            alertNegative('El numero debe tener un minimo de 10 digitos');
            return false
        }

    } else if ($("#country_recolector").val() === 'Uruguay') {

        if (exNumWUr !== '598') {
            alertNegative('Debes incluir el codigo Pais (598) seguido del Número. Ejemplo : 598 5555-7777 ');
            return false
        } else if (numW.length < 9) {
            alertNegative('El numero debe tener un minimo de 9 digitos');
            return false
        }

    }

    //guardar datos 
    localStorage.setItem('rem', 's')
    saveDataCliente(datosCliente);
    // enviar modo de email por whatsapp
    if ($("#modoEmail").val() === 'remitoRecupero') {

        $('#closeEnvioRemito').show()
        var urlencodedtext = '*Hola!*%20Para%20descargar%20el%20comprobante:%0a*1)*%20En%20el%20chat%20hac%C3%A9%20click%20en%20*%22a%C3%B1adir%20a%20contactos%22*,%20si%20no%20lo%20visualizas%20podes%20encontrarlo%20en%20*-%3E%20Opciones%20-%3E%20A%C3%B1adir%20a%20contactos.*%20%0a*2)*%20Hace%20click%20en%20el%20siguiente%20link.%0a' + base_url + 'equipo/remito%26cd=' + $("#codEmail").val() + '%26tp=rmkcmmownloqwld';

        window.open('https://api.whatsapp.com/send?phone=' + numW + '&text=' + urlencodedtext, '_blank');
    } else {


        var urlencodedtext = '*Hola!*%20Para%20descargar%20el%20comprobante:%0a*1)*%20En%20el%20chat%20hac%C3%A9%20click%20en%20*%22a%C3%B1adir%20a%20contactos%22*,%20si%20no%20lo%20visualizas%20podes%20encontrarlo%20en%20*-%3E%20Opciones%20-%3E%20A%C3%B1adir%20a%20contactos.*%20%0a*2)*%20Hace%20click%20en%20el%20siguiente%20link.%0a' + base_url + 'equipo/remito%26cd=' + $("#codEmail").val() + '%26tp=okghvmnatrqzopo';


        window.open('https://api.whatsapp.com/send?phone=' + numW + '&text=' + urlencodedtext, '_blank');
    }
})

$("#equisSalirEnvioRemito, #closeEnvioRemito").click(function() {


    const enviado = localStorage.getItem('rem')

    console.log(enviado)

    var titulo = ''
    var icon = ''
    var textoConfirm = ''
    var textoCancel = ''

    if (enviado == null) {
        titulo = 'Aun no has enviado el remito'
        icon = 'info'
        textoConfirm = 'Finalizar transacción'
        textoCancel = 'Enviar Remito'
    } else {
        titulo = '¿Estas seguro?'
        icon = 'success'
        textoConfirm = 'Si'
        textoCancel = 'No'
    }

    Swal.fire({
        title: titulo,
        icon: icon,
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: textoConfirm,
        cancelButtonText: textoCancel

    }).then((result) => {
        if (result.isConfirmed) {
            finalizarTransaccion();
            $("#enviarRemito").modal("hide")

        }
    })

})


$("#mantenerEnvioDeRemito").click(function() {
    $("#caja-de-equipos").modal("hide")
    $("#enviarRemito").modal("show")
    veryCountry();
})

// buscar modelos disponibles para retirar por autorizar ---------------||||

$(".modelos").click(function() {

    $("#cuadraditocheck").prop("checked", false);
    $("#modelosPermitidos").modal("show");

})


$(".modelos").click(function() {

    var pedirEmpresas = "empresas";

    $.ajax({
        url: "../controllers/equipoController.php?equipo=empresa",
        type: "POST",
        data: { pedirEmpresas },
        beforeSend: function() {
            $("#loaderModel").append('<div id="laoderModelCont" class="spinner-border text-primary" role="status"><span class="sr-only">Loading...</span></div>')
        },
        success: function(response) {
            $("#laoderModelCont").remove()

            var reciboEmpresa = JSON.parse(response)

            var templateEmpresas = `<option value="">Seleccione</option>`;
            if (reciboEmpresa[0].result === false) {

                templateEmpresas += `
        <option value="" >No hay equipos disponibles en BD</option>
        `;
                $("#empresa").html(templateEmpresas);
            }
            if (reciboEmpresa[0].result !== false) {

                reciboEmpresa.forEach((recorro) => {

                    templateEmpresas += `
          <option value="${recorro.id}" >${recorro.empresa}</option>
          `;

                })
                $("#empresa").html(templateEmpresas);
            }

        }
    })
})

$("select#empresa").change(function() {

    var valor = $(this).val()


    $.ajax({
        url: "../controllers/equipoController.php?equipo=modelo",
        type: "POST",
        data: { valor },
        beforeSend: function() {
            $("#loaderModel").append('<div id="laoderModelCont" class="spinner-border text-primary" role="status"><span class="sr-only">Loading...</span></div>')
        },
        success: function(response) {
            $("#laoderModelCont").remove()
            var reciboDataModel = JSON.parse(response)
            var tempatemodelos = "";
            if (reciboDataModel) {

                if (reciboDataModel[0].result === false) {
                    tempatemodelos += `
    <ul></ul>
    
    `;
                    $("#modelosDisponibles").html(tempatemodelos)

                }
                if (reciboDataModel[0].result !== false) {

                    reciboDataModel.forEach((recorroModel) => {

                        tempatemodelos += `
      <div  class="contenedor-imagen ">
      <div class="cont-adentro">
      <span> ${recorroModel.modelo}</span>
        <img class="img-model" src="../estilos/imagenes/modelos/${recorroModel.modelo}.png"></ul>
        </div>
      </div>
    `;
                    })
                    $("#modelosDisponibles").html(tempatemodelos)

                }
            }
        }
    })
})

$("#cerrarModelos").click(function() {

    $("#modelosPermitidos").modal("hide")
})

// agregar nuevo cliente 

$("#nuevosClientes").click(function() {

    $("#cuadraditocheck").prop("checked", false);

    $("#nuevosClientesModal").modal("show");


    $("#idReceptorNuevosClientes").val($("#id_recoleorden").val())
})

$("#enviarInfoNuevo").click(function(e) {
    e.preventDefault()

    var nombreNuevoINPUT = $("#nombreNuevo").val()
    var apellidoNuevoINPUT = $("#apellidoNuevo").val()
    var documentoNuevoINPUT = $("#documentoNuevo").val()
    var direccionNuevoINPUT = $("#direccionNuevo").val()
    var provinciaNuevoINPUT = $("#provinciaNuevo").val()
    var localidadNuevoINPUT = $("#localidadNuevo").val()
    var codigoPostalNuevoINPUT = $("#codigoPostalNuevo").val()
    var telefonoNuevoINPUT = $("#telefonoNuevo").val()
    var emailNuevoINPUT = $("#emailNuevo").val()
    var empresaNuevoINPUT = $("#empresaNuevo").val()
    var terminalNuevoINPUT = $("#terminalNuevo").val()
    var serieNuevoINPUT = $("#serieNuevo").val()
    var modeloNuevoINPUT = $("#modeloNuevo").val()
    var motivoNuevoINPUT = $("#motivoNuevo").val()
    var tipoDocNuevo = $("#tipoDocNuevo").val()
    var idrec = $("#idReceptorNuevosClientes").val()


    if (nombreNuevoINPUT === "") {
        alertNegative('Debes ingresar el Nombre del cliente');
        return false
    }
    if (apellidoNuevoINPUT === "") {
        alertNegative('Debes ingresar el Apellido del cliente');
        return false
    } else if (documentoNuevoINPUT === "") {
        alertNegative('Debes ingresar el Documento del cliente');
        return false
    } else if (direccionNuevoINPUT === "") {
        alertNegative('Debes ingresar la dirección del cliente');
        return false
    } else if (provinciaNuevoINPUT === "") {
        alertNegative('Debes ingresar la provincia del cliente');
        return false
    } else if (localidadNuevoINPUT === "") {
        alertNegative('Debes ingresar la localidad del cliente');
        return false
    } else if (codigoPostalNuevoINPUT === "") {
        alertNegative('Debes ingresar el Codigo Postal del cliente');
        return false
    } else if (telefonoNuevoINPUT === "") {
        alertNegative('Debes ingresar el telefono del cliente');
        return false
    } else if (telefonoNuevoINPUT.length < 8) {
        alertNegative('El telefono del cliente debe tener un minimo de 8 digitos');
        return false
    } else if (emailNuevoINPUT === "") {
        alertNegative('Debes ingresar el Email del cliente');
        return false
    } else if (!(/^[_a-z0-9]+(\.[_a-z0-9]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,15})/i).test(emailNuevoINPUT)) {
        alertNegative('El email ingresado es inválido');
        return false
    } else if (empresaNuevoINPUT === "") {
        alertNegative('Debes ingresar la empresa del cliente');
        return false
    } else if (terminalNuevoINPUT === "") {
        alertNegative('Debes ingresar la terminal del equipo');
        return false
    } else if (serieNuevoINPUT === "") {

        alertNegative('Debes ingresar la serie/mac del equipos');
        return false

    } else if (modeloNuevoINPUT === "") {
        alertNegative('Debes ingresar el modelo del equipo');
        return false
    } else {

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

        var fechaMomento = hoy.getFullYear() + '-' + ("0" + (hoy.getMonth() + 1)).slice(-2) + '-' +
            ("0" + hoy.getDate()).slice(-2) + ' ' + getHora + ':' + getMinutos + ':' + getSegundos;

        var tabla = 'nuevos_clientes';
        $.ajax({
            url: "../controllers/equipoController.php?equipo=cliente",
            type: "POST",
            data: {
                nombreNuevoINPUT,
                apellidoNuevoINPUT,
                documentoNuevoINPUT,
                direccionNuevoINPUT,
                provinciaNuevoINPUT,
                localidadNuevoINPUT,
                codigoPostalNuevoINPUT,
                telefonoNuevoINPUT,
                emailNuevoINPUT,
                empresaNuevoINPUT,
                terminalNuevoINPUT,
                serieNuevoINPUT,
                modeloNuevoINPUT,
                motivoNuevoINPUT,
                tipoDocNuevo,
                fechaMomento,
                idrec,
                tabla
            },
            success: function(response) {
                var reciboRespuestaDeNuevoCliente = JSON.parse(response)

                if (reciboRespuestaDeNuevoCliente[0].result === true) {

                    $("#terminalNuevo").val("")
                    $("#serieNuevo").val("")
                    $("#modeloNuevo").val("")

                    alertPositive('Cliente agregado con exito!')
                    return true

                }

                if (reciboRespuestaDeNuevoCliente[0].result !== true) {
                    alertNegative('Hubo un problema al insertar Cliente!')
                    return false
                }
            }

        })
    }
})

$("#salirNuevoCliente").click(function() {

    Swal.fire({
        title: 'Seguro que querés salir?',
        text: "Si ya agregaste todos los equipos del cliente podes salir, si no, agrega mas equipos.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, salir!'
    }).then((result) => {
        if (result.isConfirmed) {

            $("#nuevosClientesModal").modal("hide");
            $('#formNuevosClientes').trigger("reset");

        }
    })

})

// abrir modal equipos a consignacion 

$("#abrirEquiposAConsignacion").click(function() {

    $("#enviarRemitoConsignacion").hide()
    $("#cuadraditocheck").prop("checked", false);
    $("#clienteConsignacion").modal("show")

    $("#idReceptor").val($("#id_recoleorden").val())
})

$("#enviarAConsignacion").click(function(e) {

    e.preventDefault()

    var nombreNuevoINPUT = $("#nombreConsignacion").val()
    var apellidoNuevoINPUT = $("#apellidoConsignacion").val()
    var documentoNuevoINPUT = $("#documentoConsignacion").val()
    var direccionNuevoINPUT = $("#direccionConsignacion").val()
    var provinciaNuevoINPUT = $("#provinciaConsignacion").val()
    var localidadNuevoINPUT = $("#localidadConsignacion").val()
    var codigoPostalNuevoINPUT = $("#codigoPostalConsignacion").val()
    var telefonoNuevoINPUT = $("#telefonoConsignacion").val()
    var emailNuevoINPUT = $("#emailConsignacion").val()
    var empresaNuevoINPUT = $("#empresaConsignacion").val()
    var terminalNuevoINPUT = $("#terminalConsignacion").val()
    var serieNuevoINPUT = $("#serieConsignacion").val()
    var modeloNuevoINPUT = $("#modeloConsignacion").val()
    var motivoNuevoINPUT = $("#motivoConsignacion").val()
    var tipoDocNuevo = $("#tipoDocConsignacion").val()
    var idrec = $("#idReceptor").val()

    if (nombreNuevoINPUT === "") {
        alertNegative('Debes ingresar el nombre del cliente!');
        return false
    } else if (apellidoNuevoINPUT === "") {
        alertNegative('Debes ingresar el apellido del cliente!');
        return false
    } else if (documentoNuevoINPUT === "") {
        alertNegative('Debes ingresar el documento del cliente!');
        return false
    } else if (!(/^[a-z0-9A-Z]+$/).test(documentoNuevoINPUT)) {
        alertNegative('El Documento del cliente es inválido!');
        return false
    } else if (direccionNuevoINPUT === "") {
        alertNegative('Debes ingresar la dirección del cliente!');
        return false
    } else if (provinciaNuevoINPUT === "") {
        alertNegative('Debes ingresar la provincia del cliente!');
        return false
    } else if (localidadNuevoINPUT === "") {
        alertNegative('Debes ingresar la localidad del cliente!');
        return false
    } else if (codigoPostalNuevoINPUT === "") {
        alertNegative('Debes ingresar el codigo postal del cliente!');
        return false
    } else if (telefonoNuevoINPUT === "") {
        alertNegative('Debes ingresar el número de telefono del cliente!');
        return false
    } else if (telefonoNuevoINPUT.length < 8) {
        alertNegative('El número de telefono debe tener un minimo de 8 digitos!');
        return false
    } else if (emailNuevoINPUT === "") {
        alertNegative('Debes ingresar el email del cliente!');
        return false
    } else if (!(/^[_a-z0-9]+(\.[_a-z0-9]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,15})/i).test(emailNuevoINPUT)) {
        alertNegative('El email ingresado es inválido, revisar cuidadosamente!');
        return false
    } else if (empresaNuevoINPUT === "") {
        alertNegative('Debes ingresar la empresa del cliente');
        return false
    } else if (terminalNuevoINPUT === "") {
        alertNegative('Debes ingresar la terminal del equipo');
        return false
    } else if (serieNuevoINPUT === "") {
        alertNegative('Debes ingresar la serie/mac del equiposd');
        return false
    } else if (modeloNuevoINPUT === "") {
        alertNegative('Debes ingresar el modelo del equipo');
        return false
    } else {

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

        var fechaMomento = hoy.getFullYear() + '-' + ("0" + (hoy.getMonth() + 1)).slice(-2) + '-' +
            ("0" + hoy.getDate()).slice(-2) + ' ' + getHora + ':' + getMinutos + ':' + getSegundos;



        var tabla = 'clientes_consignacion';



        $.ajax({
            url: "../controllers/equipoController.php?equipo=cliente",
            type: "POST",
            data: {
                nombreNuevoINPUT,
                apellidoNuevoINPUT,
                documentoNuevoINPUT,
                direccionNuevoINPUT,
                provinciaNuevoINPUT,
                localidadNuevoINPUT,
                codigoPostalNuevoINPUT,
                telefonoNuevoINPUT,
                emailNuevoINPUT,
                empresaNuevoINPUT,
                terminalNuevoINPUT,
                serieNuevoINPUT,
                modeloNuevoINPUT,
                motivoNuevoINPUT,
                tipoDocNuevo,
                idrec,
                fechaMomento,
                tabla
            },
            success: function(response) {
                var reciboRespuestaDeConsignacionCliente = JSON.parse(response)

                if (reciboRespuestaDeConsignacionCliente[0].result === true) {

                    alertPositive("Agregado con éxito")

                    $("#enviarRemitoConsignacion").show()
                    $("#terminalConsignacion").val("")
                    $("#serieConsignacion").val("")
                    $("#modeloConsignacion").val("")

                    return true

                }

                if (reciboRespuestaDeConsignacionCliente[0].result !== true) {

                    alertNegative("No pudo ser agregado con éxito!");
                    return false

                }
            }

        })
    }

})

$("#salirAConsignacion").click(function() {

    Swal.fire({
        title: 'Estas seguro?',
        text: "No podras enviarle el comprobante",
        icon: 'info',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si'
    }).then((result) => {
        if (result.isConfirmed) {

            $("#clienteConsignacion").modal("hide");

            $('#formClientesConsignacion').trigger("reset");

        }
    })

})

// apretar boton enviar remito consignacion

$("#enviarRemitoConsignacion").click(function() {

    Swal.fire({
        title: 'Agregaste todos los equipos?',
        text: "Una vez enviado, no podras modificarlo",
        icon: 'info',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, enviar!'
    }).then((result) => {
        if (result.isConfirmed) {
            $("#clienteConsignacion").modal("hide")
            $("#enviarRemito").modal("show")
            veryCountry();
            $("#codEmail").val($("#documentoConsignacion").val())
            $("#email-remito").val($("#emailConsignacion").val())

            // modo de envio de email
            $("#modoEmail").val("remitoConsignacion")
            localStorage.setItem('te', 'cs');



        }
    })
})


//check terminal

$(document).on('click', '#noVisibleTerminal', function() {

    const terminalStyle = document.getElementById('input-terminal-en-base')
    var boxTerminal = $("#noVisibleTerminal")
    if (boxTerminal.is(":checked")) {
        terminalStyle.style.background = "#b2beca";
        document.getElementById('input-terminal-en-base').value = "no-visible";
    } else {
        var getTerminal = localStorage.getItem('terminal');

        terminalStyle.style.background = "#D6EAF8";
        if (getTerminal !== null) {
            document.getElementById('input-terminal-en-base').value = getTerminal;
        }
    }
})


$(document).on('change', '#estado-rec-en-base', function() {

    var estadoNotificacion = $("#estado-rec-en-base").val()
    var identificacionCliente = $("#q").val().trim().substr(0, 2).toUpperCase();

    $("#cont-estado-en-base").hide();
    if (estadoNotificacion === '0') {
        alertNegative("Debes seleccionar un estado");
        return false;

    }

    if (estadoNotificacion !== 'RECUPERADO') {
        componentes.hide();

        $('#no-entrega-accesorio-uno').prop("checked", true)
        $('#no-entrega-accesorio-dos').prop("checked", true)
        $('#no-entrega-accesorio-tres').prop("checked", true)
        $('#no-entrega-accesorio-cuatro').prop("checked", true)

        // if(identificacionCliente !== 'PS' && identificacionCliente !== 'LA' && identificacionCliente !== 'GC' ){

        contenidoInputs.fadeIn()
        labelCoincideChip.hide();
        contOpcionCoincideChip.hide();
        contSimCardEnBase.hide();
        contbaseSerie.hide();
        contChipAlt.hide()
        chipAltINPUT.hide()
        contTerminal.hide()
        terminalEnBaseINPUT.hide()

        chipAltINPUT.val("");
        chipEnBaseINPUT.val("");
        baseSerieINPUT.val("");

        contMotivo.hide()
        motivoSelect.prop("selectedIndex", 20)

        enviarBtn.fadeIn();
        contSerieEnBase.show();
        serieEnBaseINPUT.show();

        if (identificacionCliente === 'LA' || identificacionCliente === 'PS' || identificacionCliente === 'GC') {
            contTerminal.show()
            terminalEnBaseINPUT.show()
            contSerieEnBase.hide()
            serieEnBaseINPUT.hide()
        }


    } else if (estadoNotificacion === 'RECUPERADO') {
        componentes.show();
    }
    if (identificacionCliente === 'IP' || identificacionCliente === 'MV' || identificacionCliente == "CL") {
        if (estadoNotificacion !== 'RECUPERADO') {
            $("#input-serie-en-base").val('-----')
        }

    }

})

//guardar datos cliente 

function saveDataCliente(object) {

    $.ajax({
        url: '../controllers/equipoController.php?equipo=saveDataCustomer',
        type: 'POST',
        data: object,
        beforeSend: function() {},
    }).done(function(response) {
        // guardar detalles de cliente
    })
}

//buscar cliente en base 
var objectGlobalResponse = []

function searchCustomerDB(datoIngresadoABuscar) {
    objectGlobalResponse = []
    axios.get(base_url + "/controllers/equipoController.php?equipo=getEquipment", {
            params: { identificacion: datoIngresadoABuscar }
        })
        .then(res => {
            if (res.data.error) {
                alertNegative(res.data.error);
                return
            }
            console.log(res)
        })
        .catch(err => {
            console.log(err)
        })

    // $.ajax({
    //         url: "../controllers/equipoController.php?equipo=ver",
    //         type: "POST",
    //         data: { datoIngresadoABuscar },
    //         beforeSend: function(objeto) {
    //             $("#subspinner").show()
    //         },
    //     })
    //     .done(function(response) {
    //         $("#subspinner").hide()
    //         var template = '';
    //         var object = JSON.parse(response);

    //         if (object[0].result !== false) {
    //             objectGlobalResponse = object
    //             template = tableEquiposEnBase(object)

    //             // $("#btnAutorizar").show()

    //             $("#table").show();
    //             $("#cuerpo").html(template);

    //             $('html, body').animate({
    //                 scrollTop: $('#table').offset().top
    //             }, 500);

    //         }
    //         if (object[0].result === false) {
    //             alertNegative('Identificacion no encontrada')
    //             $("#textTable").text('')
    //             $("#table").hide();

    //             return false;
    //         }
    //     })

}

function tableEquiposEnBase(object) {
    var equipmentLocalStorage;
    if (localStorage.getItem('transito') !== undefined && localStorage.getItem('transito') !== null && localStorage.getItem('transito') !== '') {
        equipmentLocalStorage = JSON.parse(localStorage.getItem('transito'))
    }

    $("#textTable").text('Seleccione equipos')
    var html = "";
    html += '<thead>';
    html += '<tr class="bg-indigo-static text-white">';
    html += '<th ></th>';
    html += '<th>Terminal </th>';
    html += '<th>Serie </th>';
    html += '<th>Equipo</th>';
    html += '<th class="text-center">Tarjeta</th>';
    html += '<th>Nombre</th>';
    html += '<th>Identificación </th>';
    html += '<th>Dirección </th>';
    html += '<th>Localidad </th>';
    html += '<th>Provincia </th>';
    html += '<th class="text-right">Telefono</th>';
    html += '<th class="text-right">Empresa</th>';
    html += '<th class="text-right">Estado</th>';
    html += '</tr>';
    html += '</thead>';
    html += '<tbody>';

    object.forEach((val) => {

        if (equipmentLocalStorage && equipmentLocalStorage.length > 0) {
            equipmentLocalStorage.forEach((valFront) => {
                if (val.idd === valFront.idd) {
                    if (valFront.estado === 'RECUPERADO') {
                        html += '<tr colspan="6" class="bg-success text-white" >';
                    } else {
                        html += '<tr colspan="6" class="bg-info text-white" >';
                    }
                }
            })
        } else {
            html += '<tr colspan="6" class="bg-white" >';
        }

        html += '<td  id="abrirEquipo" class="open-modal bg-indigo-static d-flex align-content-center align-item-center align-self-center" data-target="#editProductModal"  data-toggle="modal" data-id_equipo="' + val.id + '" data-terminal="' + val.terminal + '" data-identificacion="' + val.identificacion + '" data-nombre="' + val.nombreCli + '" data-tarjeta="' + val.tarjeta + '" data-serie="' + val.serie + '" data-seriebase="' + val.seriebase + '" data-idd="' + val.idd + '" >';

        html += '<i style="color:#fff;" class="far fa-hand-point-up icon-recu"></i>';


        html += '</td>';

        // TERMINAL

        if (object[0].identificacion.toUpperCase().substr(0, 2) === 'PS' || object[0].identificacion.toUpperCase().substr(0, 2) === 'LA') {

            if (val.serie === '' || val.serie === null) {
                html += '<td item="' + val.id + '"></td>';
            } else {
                html += '<td item="' + val.id + '">' + val.serie + '</td>';
            }


        } else {

            if (val.terminal === '' || val.terminal === null) {
                html += '<td item="' + val.id + '"></td>';
            } else {
                html += '<td item="' + val.id + '">' + val.terminal + '</td>';
            }

        }


        // SERIE

        if (object[0].identificacion.toUpperCase().substr(0, 2) === 'PS' || object[0].identificacion.toUpperCase().substr(0, 2) === 'LA') {

            if (val.terminal === '' || val.terminal === null) {
                html += '<td item="' + val.id + '"></td>';
            } else {
                html += '<td item="' + val.id + '">' + val.terminal + '</td>';
            }

        } else {

            if (val.serie === '' || val.serie === null) {
                html += '<td item="' + val.id + '"></td>';
            } else {
                html += '<td item="' + val.id + '">' + val.serie + '</td>';
            }

        }

        // equipo

        if (val.equipo !== '' && val.equipo !== undefined && val.equipo !== null) {
            html += '<td>' + val.equipo + '</td>';
        } else { html += '<td></td>'; }

        // tarjeta

        if (val.tarjeta !== '' && val.tarjeta !== null) {
            html += '<td>' + val.tarjeta + '</td>';
        } else {
            html += '<td></td>';
        }


        html += '<td>' + val.nombreCli + '</td>';
        html += '<td>' + val.identificacion + '</td>';
        html += '<td>' + val.direccion + '</td>';
        html += '<td>' + val.localidad + '</td>';
        html += '<td>' + val.provincia + '</td>';
        html += '<td>' + val.telefono + '</td>';
        html += '<td>' + val.empresa + '</td>';

        if (val.estadoEquipo !== null && val.estadoEquipo !== 'AUTORIZAR') {
            html += '<td>' + val.estadoEquipo + '</td>';
        } else {
            html += '<td></td>';
        }

        html += '</tr>';

    })
    html += '</tbody>';

    return html;
}

function verifyStatusRow() {

    $("#cuerpo").html('');
    var templateFrontEquipos = ''
    templateFrontEquipos = tableEquiposEnBase(objectGlobalResponse)
    $("#cuerpo").html(templateFrontEquipos);
}

//MENSAJES

// lectura de datos para mantener

function mantenerOrdenGeneradaAlActualizarPantallaSiNoHaFinalizado() {

    iniciarBtn.hide();
    // aviso de visita
    $("#app").show()


    remitoBtn.hide();
    cajaBuscador.show();
    $("#caja-box").html('');
    $("#caja-box").hide();

}
//inciar transaccion

function DarClickAIniciar() {

    iniciarBtn.hide()
        // aviso de visita
    $("#app").show()


    abrirFirmarBtn.hide();
    remitoBtn.hide();

    agregarEquipoBtn.show();
    cajaBuscador.show();
    finalizarBtn.show();

    if (localStorage.getItem('transito') !== null) {

        $("#abrir-caja-equipos").show()
    } else {

        $("#abrir-caja-equipos").hide()
    }

}
// volve al inicio
function VolverAlInicio() {

    agregarEquipoBtn.hide();
    cajaBuscador.hide();
    remitoBtn.hide();

    abrirFirmarBtn.hide();
    finalizarBtn.hide();

    if (localStorage.getItem('transito') !== null) {

        $("#abrir-caja-equipos").show()
        $("#app").show()

    } else {

        $("#abrir-caja-equipos").hide()
        $("#app").hide()
    }
}

function alertPositive(str) {

    Swal.fire({

        icon: 'success',
        title: str,
        showConfirmButton: false,
        timer: 1600
    })

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

function alertInfo(str, txt, icon) {
    Swal.fire(
        str,
        txt,
        icon
    )
}

//transaccion en proceso
function transactionInProcess() {

    Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: 'Debes salir de la transacción actual para volver a agregar equipos',
        timer: 8000,
        showConfirmButton: false
    })

    setTimeout(() => {
        $('html,body').animate({
            scrollTop: $('#finalizar').offset().top - 80
        }, 500);


    }, 3000)
}

//--FIN MENSAJES

// setear doom del formulario equipos en base 

function setearDomFormBase() {

    componentes.show();

    contAccesorioUno.show();
    contAccesorioDos.hide();
    contAccesorioTres.hide();
    contAccesorioCuatro.hide();

    accesorioUnoCheck.prop("checked", false);
    accesorioDosCheck.prop("checked", false);
    accesorioTresCheck.prop("checked", false);
    accesorioCuatroCheck.prop("checked", false);

    $("#inputEnBase").hide()

    terminalEnBaseINPUT.val("");
    serieEnBaseINPUT.val("");
    chipEnBaseINPUT.val("");
    chipAltINPUT.val("");
    baseSerieINPUT.val("");
    otrosAccesoriosINPUT.val("");

    estadoRecSelect.prop("selectedIndex", 0);

}

function resetearDomFormBase() {

    componentes.show();

    contAccesorioUno.show();
    contAccesorioDos.hide();
    contAccesorioTres.hide();
    contAccesorioCuatro.hide();

    accesorioUnoCheck.prop("checked", false);
    accesorioDosCheck.prop("checked", false);
    accesorioTresCheck.prop("checked", false);
    accesorioCuatroCheck.prop("checked", false);

    $("#inputEnBase").hide()
    estadoRecSelect.prop("selectedIndex", 0);

}

//click en abrir equipo para empresa diferente

function showFormDiferent() {

    $("#labelSerie").text("Serie")
    $("#cableRed").html('')
    $("#cont-estado-en-base").show()
    componentes.hide();
    $("#mantenerEnvioDeRemito").hide()
        // motivo de retiro por defecto
    motivoSelect.prop("selectedIndex", 0);


    chipAltINPUT.val("No");
    baseSerieINPUT.val("");

    estadoRecSelect.prop("selectedIndex", 0);

    enviarBtn.hide();
    $("#siguienteNormal").hide()

    $(accesorioUnoCheck).change(function() {
        contAccesorioDos.fadeIn();
    })
    $(accesorioDosCheck).change(function() {
        contAccesorioTres.fadeIn();
    })
    $(accesorioTresCheck).change(function() {
        contAccesorioCuatro.fadeIn();
    })
    $(accesorioCuatroCheck).change(function() {

        contTerminal.show()
        terminalEnBaseINPUT.show()
        $("#confirmar").fadeIn()
        componentes.hide();
        contenidoInputs.fadeIn()
        enviarBtn.fadeIn();
    })
}
// click en abrir equipo para empresa "normal / comun "

function showFormCommon() {
    $("#cont-estado-en-base").show()
    componentes.hide();
    enviarBtn.hide();

    $(accesorioUnoCheck).change(function() {
        contAccesorioDos.fadeIn();
    })
    $(accesorioDosCheck).change(function() {
        contAccesorioTres.fadeIn();
    })
    $(accesorioTresCheck).change(function() {
        contAccesorioCuatro.fadeIn();
    })


    $(accesorioCuatroCheck).change(function() {
        var identificacionIniciales = $("#q").val().trim().toUpperCase().substr(0, 2)
        if (identificacionIniciales !== 'PS') {

            componentes.hide();
            contenidoInputs.fadeIn()
            labelCoincideChip.hide();
            contOpcionCoincideChip.hide();
            contSimCardEnBase.hide();
            contbaseSerie.hide();
            contChipAlt.hide();
            chipAltINPUT.hide();
            contTerminal.hide();
            terminalEnBaseINPUT.hide();

            chipAltINPUT.val("");
            chipEnBaseINPUT.val("");
            baseSerieINPUT.val("");

            contMotivo.hide()
            motivoSelect.prop("selectedIndex", 20)
            $("#labelSerie").text("Serie")
            $("#cableRed").html('')
            if (identificacionIniciales === 'MV' || identificacionIniciales == "CL") {
                var templateMovisar = templateMovistar()
                $("#cableRed").html(templateMovisar)
            }

            enviarBtn.fadeIn();

        }
        if (identificacionIniciales === 'LA' || identificacionIniciales === 'GC' || identificacionIniciales === 'PS') {

            // $("#input-terminal-en-base").attr('readonly', false);
            contTerminal.show()
            terminalEnBaseINPUT.show()

        }
    });

}

// cabla de red movistar

function templateMovistar() {

    $("#labelSerie").text("Nro MAC")

    var html = ""
    html += '<label ><strong >Cable de red</strong></label>'

    html += '<div class="form-check">'
    html += '<input class="form-check-input cable-red" type="radio" name="examplecable" id="cable-si" value="si"></input>'
    html += '<label class="form-check-label" for="Si tiene cable red">'
    html += 'Si'
    html += '</label>'
    html += '</div>'
    html += '<div class="form-check">'
    html += ' <input class="form-check-input cable-red" type="radio"  name="examplecable" id="cable-no" value="no">'
    html += '<label class="form-check-label" for="No tiene cable red">'
    html += ' No'
    html += '</label>'
    return html

}

function validateMovistar() {

    var validate = true;
    let serieEnBaseINPUT = $("#input-serie-en-base")
    let estado = $("#estado-rec-en-base").val()
    if (estado === 'RECUPERADO') {

        if (serieEnBaseINPUT.val() === "") {
            alertNegative('Debes ingresar nro de MAC');
            validate = false
        }

        if (serieEnBaseINPUT.val().length < 6) {
            alertNegative('El nro de MAC debe tener minimo 6 digitos');
            validate = false
        }


        let cableSi = $("#cable-si")
        let cableNo = $("#cable-no")





        if (!cableSi.is(":checked") && !cableNo.is(":checked")) {

            alertNegative('Debes indicar si posee cable de red');
            validate = false
        }

    }


    return validate;

}


$(document).on('click', '.cable-red', function() {
    var esto = this
    var value = $(esto).val()
    $("#input-chip-base").val(value)

})

// resetear al enviar data o salir de form empresa diferente
function resetCompanyDifferent() {

    chipEnBaseINPUT.val("");
    chipAltINPUT.val("No");
    baseSerieINPUT.val("");
    motivoSelect.prop("selectedIndex", 0);
    estadoRecSelect.prop("selectedIndex", 0);
}

// resetear al enviar data o salir de form empresa "comun"

function resetCompanyCommon() {

    chipEnBaseINPUT.val("");
    chipAltINPUT.val("");
    baseSerieINPUT.val("");
    componentes.show();
    estadoRecSelect.prop("selectedIndex", 0);

}
// mostrar accesorios y componentes de empresa diferente

function showAccesoryAndComponentsOfCompanyDifferent() {
    // accesorios

    accesorioUnoTxt.text("Cable telefonico");
    accesorioDosTxt.text("Sim Card");
    accesorioTresTxt.text("Cargador");
    accesorioCuatroTxt.text("Base");
    $("#input-serie-en-base").attr("placeholder", "Ingrese serie")
    componentes.fadeIn()
    contAccesorioDos.hide()
    contAccesorioTres.hide()
    contAccesorioCuatro.hide()
    contenidoInputs.hide()
}

//mostrar accesorios y componentes de empresa "comun"

function showAccesoryAndComponentOfCompanyCommon() {

    enviarBtn.hide();
    accesorioUnoTxt.text("Cable HDMI");
    accesorioDosTxt.text("Cable AV");
    accesorioTresTxt.text("Fuente");
    accesorioCuatroTxt.text("Control");
    $("#labelSerie").text("Serie/Verificar")
    $("#input-serie-en-base").attr("placeholder", "Ingrese serie")

    let identificacion = $("#q").val().trim().toUpperCase().substr(0, 2)

    if (identificacion === 'MV' || identificacion === 'CL') {
        $("#input-serie-en-base").attr("placeholder", "Ingrese MAC")
    }
    componentes.fadeIn()
    contAccesorioDos.hide()
    contAccesorioTres.hide()
    contAccesorioCuatro.hide()
    contenidoInputs.hide()

}

// si entrega accesorios Dos de empresa diferente

function ifYouDeliverAccessoryNumberTwoFromTheDifferentCompany() {

    contOpcionCoincideChip.show()
    labelCoincideChip.show()

    contSimCardEnBase.show()
    chipEnBaseINPUT.show()

    contChipAlt.hide()
    chipAltINPUT.hide()

}
// si no entrega accesorio dos de empresa diferente

function ifYouDoNotDeliverAccessoryNumberTwoFromAnotherCompany() {

    contOpcionCoincideChip.hide()
    labelCoincideChip.hide()

    contSimCardEnBase.hide()
    chipEnBaseINPUT.hide()

    contChipAlt.hide()
    chipAltINPUT.val("No")

}
//si entrega accesorio cuatro de empresa diferente
function ifYouDeliverAccessoryNumberFourFromAnotherCompany() {
    contbaseSerie.fadeIn();
    baseSerieINPUT.fadeIn();
}
// si no entrega accesorio cuatro de empresa diferente
function ifYouDoNotDeliverAccessoryNumberFourFromAnotherCompany() {

    contbaseSerie.hide()
    baseSerieINPUT.hide()
    baseSerieINPUT.val("No");
}

//no entrega chip
function doeNnotDeliverChip() {

    contSimCardEnBase.hide();
    chipEnBaseINPUT.hide();

    contOpcionCoincideChip.hide();
    contChipAlt.fadeIn();
    chipAltINPUT.fadeIn();
    chipAltINPUT.val("");
    chipEnBaseINPUT.val("no coincide");
}

// si entrega chip
function ifItDeliversChip() {
    contSimCardEnBase.fadeIn();
    contChipAlt.hide();
    contOpcionCoincideChip.hide();
    labelCoincideChip.hide();
    chipAltINPUT.val("no");
}
// credencial

var hoy = new Date();
var dia = ("0" + hoy.getDate()).slice(-2);


$(document).on("click", "#getcre", function() {

    var templateFront = "";
    var templatePost = "";

    if ($("#usuario-credencial").val() === '') {

    } else {
        var object = $("#usuario-credencial").val()

        $(".soli-credencial").fadeOut();

        templateFront = showCredencialFront(object)

        $(".credencial-contenedor").html(templateFront).fadeIn()


        templatePost = showCredencialPost()
        $(".credencial-contenedor-post").html(templatePost).fadeIn()


    }

})



function showCredencialFront() {

    var img_person = $('#img_person').val()
    var name = $('#first_name').val()
    var role = $('#rol').val()
    var id_number = $('#id_number').val()


    var html = "";

    var hoy = new Date();
    var diasAgregar = 6;
    hoy.setDate(hoy.getDate() + diasAgregar)

    fecha = hoy.getFullYear() + '-' + ("0" + (hoy.getMonth() + 1)).slice(-2) + '-' + ("0" + hoy.getDate()).slice(-2)


    var dateTime = fecha;

    html += '<div class="card-credencial">';
    html += '<div class="credencial-contenido">';
    html += '<div class="cont-img">';
    html += '<img class="img-cre" src="' + base_url + 'resources/imgRegister/' + img_person + '" alt="">';
    html += '<img class="img-cre-empre"  src="' + base_url + 'estilos/imagenes/logo/logocir.png" alt="">';
    html += '</div>';
    html += '</div>';
    html += '<div class="credencial-contenido">';
    html += '<div class="datos-cre">';
    html += '<div class="titulo">';
    html += '<span>Nombre </span>';
    html += '</div>';
    html += '<div class="respuesta">';
    html += '<span> ' + name + ' </span>';
    html += '</div>';
    html += '<div class="titulo">';
    html += '<span>Trabajo </span>';
    html += '</div>';
    html += '<div class="respuesta">';
    html += '<span>' + role + ' </span>';
    html += '</div>';
    html += '<div class="titulo">';
    html += '<span>DNI / CI </span>';
    html += '</div>';
    html += '<div class="respuesta">';
    html += '<span>' + id_number + ' </span>';
    html += '</div>';
    html += '<div class="titulo">';
    html += '<span >Vence </span>';
    html += '</div>';

    html += '<div class="respuesta vence">';

    html += '<span style=" box-shadow:0 10px 30px rgba(0,0,0,0.2); background:white;color:#0093f5;padding:5px;border-radius:10px;" > ' + dateTime + ' </span>';
    html += '</div>';
    html += '</div>';
    html += '</div>';
    html += '</div>';

    return html;
}

function showCredencialPost() {


    var html = "";

    html += '<div class="card-credencial-post">';
    html += '<div class="credencial-contenido-post">';
    html += '<div class="img-dorso-cont">';
    html += '<img class="img-dorso" src="' + base_url + 'estilos/imagenes/empresas/creantina.png">';
    html += '</div>';
    html += '<div class="img-dorso-cont">';
    html += '<img class="img-dorso" src="' + base_url + 'estilos/imagenes/empresas/creiplan.png">';
    html += '</div>';
    html += '<div class="img-dorso-cont">';
    html += '<img class="img-dorso" src="' + base_url + 'estilos/imagenes/empresas/cremetrotel.png">';
    html += '</div>';
    html += '<div class="img-dorso-cont">';
    html += '<img class="img-dorso" src="' + base_url + 'estilos/imagenes/empresas/crecablevision.png">';
    html += '</div>';
    html += '<div class="img-dorso-cont">';
    html += '<img class="img-dorso" src="' + base_url + 'estilos/imagenes/empresas/crelapos.png">';
    html += '</div>';
    html += '<div class="img-dorso-cont">';
    html += '<img class="img-dorso" src="' + base_url + 'estilos/imagenes/empresas/creintv.png">';
    html += '</div>';
    html += '<div class="img-dorso-cont">';
    html += '<img class="img-dorso" src="' + base_url + 'estilos/imagenes/empresas/creposnet.png">';
    html += '</div>';



    html += '</div>';
    html += '</div>';



    return html;


}


function tableJquery() {

    $("#cuerpo").DataTable({

        language: {
            lengthMenu: "Mostrar _MENU_ registros",
            zeroRecords: "No se encontraron resultados",
            info: "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            infoEmpty: "Mostrando registros del 0 al 0 de un total de 0 registros",
            infoFiltered: "(filtrado de un total de _MAX_ registros)",
            sSearch: "Filtro:",
            oPaginate: {
                sFirst: "Primero",
                sLast: "Último",
                sNext: "Siguiente",
                sPrevious: "Anterior",
            },
            sProcessing: "Procesando...",
        },
        "bDestroy": true
            //para usar los botones
            // responsive: "true",

    });

}