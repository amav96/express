// DOM

//    1) accesorios
//    2) otros accesorios
//    3) motivos
//    4) estado
//    5) identificacion
//    6) terminal
//    7) serie
//    8) serie de la base
//    9) nro sim / chip
//    10) sugerencias
//    11) id recolector

var componentesAut = $("#componentes-aut");
var inputComplete = $("#inputs-aut");
// accesorios

var contAccesorioUnoAut = $("#cont-accesorio-uno-aut");
var contAccesorioDosAut = $("#cont-accesorio-dos-aut");
var contAccesorioTresAut = $("#cont-accesorio-tres-aut");
var contAccesorioCuatroAut = $("#cont-accesorio-cuatro-aut");

var txtAccesorioUnoAut = $("#txtAccesorioUnoAut");
var txtAccesorioDosAut = $("#txtAccesorioDosAut");
var txtAccesorioTresAut = $("#txtAccesorioTresAut");
var txtAccesorioCuatroAut = $("#txtAccesorioCuatroAut");

var noEntregoAccesorioDosAut = $("#noEntregoAccesorioDosAut");
var siEntregaAccesorioDos = $("#siEntregoAccesorioDosAut");
var noEntregoAccesorioCuatroAut = $("#noEntregoAccesorioCuatroAut");
var siEntregaAccesorioCuatro = $("#siEntregoAccesorioCuatroAut")


//    otro accesorios
var contOtrosAccesoriosAut = $("#cont-otros-accesorio-aut");
//    motivo retiro
var contMotivoRetiroAut = $("#cont-motivoRetiro-aut");
var contEstadoAut = $("#cont-estado-aut");
var contTerminalAut = $("#cont-terminal-aut");
var contIdentificacionAut = $("#cont-identificacion-aut");
var contSerieAut = $("#cont-serie-aut");
var contSimCardAut = $("#cont-chip-aut");
var contSerieBaseAut = $("#cont-serie-base-aut");

// input

var accesorioUnoAutINPUT = $('input[name="accesorio-uno-aut"]');
var accesorioDosAutINPUT = $('input[name="accesorio-dos-aut"]');
var accesorioTresAutINPUT = $('input[name="accesorio-tres-aut"]');
var accesorioCuatroAutINPUT = $('input[name="accesorio-cuatro-aut"]');

var otrosAccesoriosAutINPUT = $("#input-otrosaccesorios-aut");
var motivoRetiroSelect = $("#motivo-retiro-select");
var estadoAutINPUT = $("#input-estado-aut");
var identificacionAutINPUT = $("#input-identificacion-aut");
var terminalAutINPUT = $("#input-terminal-aut");
var serieAutINPUT = $("#input-serie-aut");
var serieBaseAutINPUT = $("#serie-base-aut");
var simCardAutINPUT = $("#input-chip-aut");
var idRecolectorINPUT = $("#input-id-recolector-aut");


$("#btnAutorizar").click(function() {


    if ($("#q").val().trim() === "") {
        alertPositive('Complete cliente')
        return false;
    }
});


// la hacer click en autorizar compruebo si ya esta el id del cliente en el local storage para guardarlo como guia
$("#btnAutorizar").click(function() {

    var terminalCheckBox = $("#noVisibleTerminalAut")
    terminalCheckBox.prop("checked", false);
    var terminalEstylo = document.getElementById('input-terminal-aut')
    terminalEstylo.style.background = "#D6EAF8";

    var transito = JSON.parse(localStorage.getItem('transito'));

    if (transito === null || transito.length === 0) {

        valorBusqueda = $("#q").val().trim();
        setDataAutorizar(valorBusqueda)
    } else {

        var getGuia = transito[0].id
        $("#idServ").val(getGuia)
        $("#agregarTeams").modal("show")
        $("#enviar").show()

    }

})


function setDataAutorizar(valorBusqueda) {

    var datoIngresadoABuscar = valorBusqueda.toUpperCase();
    if (datoIngresadoABuscar !== '') {

        $.ajax({
            url: "../controllers/equipoController.php?equipo=ver",
            type: "POST",
            data: { datoIngresadoABuscar },
            beforeSend: function() {
                $("#subspinner").show()
            },
        }).done(function(response) {
            $("#subspinner").hide()
            template = "";
            var object = JSON.parse(response)


            if (object[0].result !== false) {

                template = tableAutorizar(object);

                $("#table").show();
                $("#cuerpo").html(template);


                Swal.fire({
                    icon: "success",
                    title: 'Escoge la posible ubicación del equipo',
                    timer: 2100,
                    showConfirmButton: false,
                    showClass: {
                        popup: 'animate__animated animate__fadeInDown'
                    },
                    hideClass: {
                        popup: 'animate__animated animate__fadeOutUp'
                    }
                })

            } else {

                alertNegative('Identificacion no encontrada')
                $("#textTable").text('')
                $("#table").hide();
                return false;

            }
        })
    }


}


// al hacer click en agregar se guarda el id en el formulario autorizar

$(document).on("click", "#agregar", function(event) {
    event.preventDefault();
    var element = $(this)[0].parentElement

    var id = $(element).attr('elemento')

    $("#agregarTeams").modal("show")
    $("#enviar").show()

    $("#idServ").val(id)

})


// POSNET ----------------||||||
//cuando abro para llenar eL formulario
$(document).on("click", "#agregar,#btnAutorizar", function() {
    valorBusqueda = $("#q").val().trim();
    $("#enviar").show()

    valorMayus = valorBusqueda.toUpperCase();
    iniEmpresa = valorMayus.substr(0, 2);

    if (iniEmpresa === "PS") {

        var terminalCheckBox = $("#noVisibleTerminalAut")
        terminalCheckBox.prop("checked", false);
        var terminalEstylo = document.getElementById('input-terminal-aut')
        terminalEstylo.style.background = "#D6EAF8";

        identificacionAutINPUT.val(valorMayus);
        showAccesorysAndComponentsOfCompanyDifferentAut()
        showFormOfCompanyDifferentAut()


    }
});


//formulario abierto

$(noEntregoAccesorioDosAut).click(function() {

    valorMayus = valorBusqueda.toUpperCase();
    iniEmpresa = valorMayus.substr(0, 2);
    (iniEmpresa === "PS") ?
    ifYouDoNotDeliverAccessoryNumberTwoFromAnotherOfCompanyAut(): true;

});

$(siEntregaAccesorioDos).click(function() {

    (iniEmpresa === "PS") ?
    ifYouDeliverAccessoryNumberTwoFromAnotherOfCompanyAut(): true;

});

$(noEntregoAccesorioCuatroAut).click(function() {

    (iniEmpresa === "PS") ?
    ifYouDoNotDeliverAccessoryNumberFourFromAnotherOfCompanyAut(): true;

});

$(siEntregaAccesorioCuatro).click(function() {
    (iniEmpresa === "PS") ?
    ifYouDeliverAccessoryNumberFourFromAnotherOfCompanyAut(): true;
});



$("#salirAgregar").click(function() {
    setTimeout(function() {
        setearDomForm();
    }, 1500);
});


$("#enviar").click(function() {


    valorBusqueda = $("#q").val().trim();

    valorMayus = valorBusqueda.toUpperCase();
    iniEmpresa = valorMayus.substr(0, 2);

    // APROVECHO Y USO EL VALIDADOR DE SERIE,TERMINAL Y SIM CARD PARA LAPOS SI EXISTE EL ELEMENTO
    // validaciones 
    if (iniEmpresa === "PS" || iniEmpresa === "LA" || iniEmpresa === "GC") {
        if (contSerieAut.is(":visible")) {
            if (serieAutINPUT.val() === "") {
                alertNegative('Debes ingresar la serie del equipo')
                return false;
            }
            if (serieAutINPUT.val().length < 5) {
                alertNegative('La serie tiene un minimo de 5 digitos')
                return false;
            }
        }
        if (serieBaseAutINPUT.is(":visible")) {
            if (serieBaseAutINPUT.val() === "") {
                alertNegative('Debes ingresar la serie de la base')
                return false;
            }

            if (serieBaseAutINPUT.val().length < 7) {
                alertNegative('La serie de la base tiene un minimo de 8 digitos')
                return false;
            }
        }
        if (simCardAutINPUT.is(":visible")) {
            if (simCardAutINPUT.val() === "") {
                alertNegative('Debes ingresar el Nro de SIM CARD')
                return false;
            }
            if (simCardAutINPUT.val().length < 19) {
                alertNegative('La SIM CARD tiene un minimo de 19 digitos')
                return false;
            }
        }
    }

    if (iniEmpresa === 'MV' || iniEmpresa === 'CL') {
        let validate = validateMovistarAut();

        if (!validate) {
            return false
        }
    }

});


$(document).on("click", "#agregar,#btnAutorizar", function() {
    valorBusqueda = $("#q").val().trim();

    valorMayus = valorBusqueda.toUpperCase();
    iniEmpresa = valorMayus.substr(0, 2);

    if (iniEmpresa === "LA" || iniEmpresa === "GC") {

        var terminalCheckBox = $("#noVisibleTerminalAut")
        terminalCheckBox.prop("checked", false);
        var terminalEstylo = document.getElementById('input-terminal-aut')
        terminalEstylo.style.background = "#D6EAF8";

        identificacionAutINPUT.val(valorMayus);
        showAccesorysAndComponentsOfCompanyDifferentAut()

    }
});

$(document).on("click", "#agregar,#btnAutorizar", function() {

    valorBusqueda = $("#q").val().trim();
    valorMayus = valorBusqueda.toUpperCase();
    iniEmpresa = valorMayus.substr(0, 2);

    if (iniEmpresa === "LA" || iniEmpresa === "GC") {
        showFormOfCompanyCommonAut()
    }

});

$(noEntregoAccesorioDosAut).click(function() {

    (iniEmpresa === "LA" || iniEmpresa === "GC") ? contSimCardAut.hide(): true;

})

$(siEntregoAccesorioDosAut).click(function() {
    if (iniEmpresa === "LA" || iniEmpresa === "GC") {
        contSimCardAut.hide();
        simCardAutINPUT.hide();
    }

});


$("#salirAgregar").click(function() {
    valorBusqueda = $("#q").val().trim();

    valorMayus = valorBusqueda.toUpperCase();
    iniEmpresa = valorMayus.substr(0, 2);

    if (iniEmpresa === "LA" || iniEmpresa === "GC") {
        motivoRetiroSelect.prop("selectedIndex", 20);
        setTimeout(function() {
            setearDomForm();
        }, 1500);
    }
});


// LAPOS ---------------------- END |||||| 

// EMPRESA NORMALES

$(document).on("click", "#agregar,#btnAutorizar", function() {
    valorBusqueda = $("#q").val().trim();

    valorMayus = valorBusqueda.toUpperCase();
    iniEmpresa = valorMayus.substr(0, 2);

    if (iniEmpresa !== "LA" && iniEmpresa !== "PS" && iniEmpresa !== "GC") {
        identificacionAutINPUT.val(valorMayus);



        showAccesorysAndComponentsOfCompanyCommon()
        showFormOfCompanyCommonAut()

    }
});



$("#salirAgregar").click(function() {
    valorBusqueda = $("#q").val().trim();

    valorMayus = valorBusqueda.toUpperCase();
    iniEmpresa = valorMayus.substr(0, 2);

    if (iniEmpresa !== "LA" && iniEmpresa !== "PS" && iniEmpresa !== "GC") {
        motivoRetiroSelect.prop("selectedIndex", 20);
        setTimeout(function() {
            setearDomForm();
        }, 1500);
    }
});

// poner la identificacion del cliente siempre en el input 

$(document).on("click", "#agregar,#btnAutorizar", function() {

    ingresoEmp = $("#q").val().trim()

    ingresoMayusEmpre = ingresoEmp.toUpperCase()

    identificacionAutINPUT.val(ingresoMayusEmpre)

})


function tableAutorizar(object) {

    var html = "";
    html += '<thead>';
    html += '<tr>';
    html += '<th></th>';
    html += '<th>Provincia</th>';
    html += '<th>Localidad</th>';
    html += '<th>Nombre Cliente</th>';
    html += '<th>Identificacion</th>';
    html += '</tr>';
    html += '</thead>';
    html += '<tbody>';

    object.forEach((val) => {

        html += '<tr>';
        html += '<td elemento=' + val.id + '>';
        html += '<button id="agregar" class="btn btn-warning" >Escoger</button>';
        html += '</td>';
        html += '<td>' + val.provincia + '</td>';
        html += '<td>' + val.localidad + '</td>';
        html += '<td>' + val.nombreCli + '</td>';
        html += '<td>' + val.identificacion + '</td>';

        html += '<tr>';
    })

    html += '</tbody>';


    return html;



}


function setearDomForm() {
    componentesAut.show();

    contAccesorioUnoAut.show();
    contAccesorioDosAut.hide();
    contAccesorioTresAut.hide();
    contAccesorioCuatroAut.hide();

    accesorioUnoAutINPUT.prop("checked", false);
    accesorioDosAutINPUT.prop("checked", false);
    accesorioTresAutINPUT.prop("checked", false);
    accesorioCuatroAutINPUT.prop("checked", false);

    inputComplete.hide();

    terminalAutINPUT.val("")
    serieAutINPUT.val("")
    serieBaseAutINPUT.val("")
    simCardAutINPUT.val("")
    idRecolectorINPUT.val("")

}

// mostrar accesorios y componentes de empresa diferente
function showAccesorysAndComponentsOfCompanyDifferentAut() {


    // 1) Asigno texto para accesorios

    txtAccesorioUnoAut.text("Cable Telefonico");
    txtAccesorioDosAut.text("Sim Card");
    txtAccesorioTresAut.text("Cargador");
    txtAccesorioCuatroAut.text("Base");

    // 2) muestro los accesorios de a uno y escondo todo el body
    componentesAut.fadeIn();


    contAccesorioDosAut.hide();
    contAccesorioTresAut.hide();
    contAccesorioCuatroAut.hide();

    inputComplete.hide();
    $("#enviar").hide()

}

// mostrar accesorios y componentes de empresa "comun"
function showAccesorysAndComponentsOfCompanyCommon() {

    // 1) Asigno texto para accesorios

    txtAccesorioUnoAut.text("Cable HDMI");
    txtAccesorioDosAut.text("Cable AV");
    txtAccesorioTresAut.text("Fuente");
    txtAccesorioCuatroAut.text("Control");

    $("#labelSerieAut").text("Serie/Verificar")
    $("#input-serie-aut").attr("placeholder", "Ingrese serie")

    // 2) muestro los accesorios de a uno y escondo todo el body
    componentesAut.fadeIn();
    contAccesorioDosAut.hide();
    contAccesorioTresAut.hide();
    contAccesorioCuatroAut.hide();

    inputComplete.hide();



    $("#enviar").hide()

}


function showFormOfCompanyDifferentAut() {


    componentesAut.fadeIn();
    contAccesorioDosAut.hide();
    contAccesorioTresAut.hide();
    contAccesorioCuatroAut.hide();

    inputComplete.hide();


    $(contAccesorioUnoAut).change(function() {
        contAccesorioDosAut.fadeIn();
    });

    $(contAccesorioDosAut).change(function() {
        contAccesorioTresAut.fadeIn();
    });

    $(contAccesorioTresAut).change(function() {
        contAccesorioCuatroAut.fadeIn();
    });

    $(contAccesorioCuatroAut).change(function() {

        contEstadoAut.hide();
        inputComplete.fadeIn();
        componentesAut.hide();
        // contSimCardAut.show();
        // contSerieBaseAut.show();
        $("#enviar").fadeIn()

    })
}

function showFormOfCompanyCommonAut() {



    $(contAccesorioUnoAut).change(function() {
        contAccesorioDosAut.fadeIn();
    });

    $(contAccesorioDosAut).change(function() {
        contAccesorioTresAut.fadeIn();
    });

    $(contAccesorioTresAut).change(function() {

        contAccesorioCuatroAut.fadeIn();
    });

    $(contAccesorioCuatroAut).change(function() {

        // esto es para templateMovistarAut, para resetear
        $("#labelSerieAut").text("Serie")
        $("#input-serie-aut").attr("placeholder", "Ingrese serie")
        $("#cableRedAut").html('')

        var idenCompararAut = $("#q").val().trim().substr(0, 2).toUpperCase();



        if (idenCompararAut === 'MV' || idenCompararAut === 'CL') {
            var templateMovistarAut = templateMovisarAut()
            $("#cableRedAut").html(templateMovistarAut)
        }


        if (idenCompararAut !== 'LA' && idenCompararAut !== 'PS' && idenCompararAut !== 'GC') {

            inputComplete.fadeIn()
            contTerminalAut.hide();
            contSimCardAut.hide();
            contSerieBaseAut.hide();
            motivoRetiroSelect.prop("selectedIndex", 20);
            $("#enviar").fadeIn()

        } else {

            inputComplete.fadeIn()
            $("#enviar").fadeIn()

            if (idenCompararAut === 'LA' || idenCompararAut === 'GC') {
                contTerminalAut.show();
                contSerieAut.show();
                contSerieBaseAut.hide();
                contSimCardAut.hide();
            } else if (idenCompararAut === 'PS') {
                contTerminalAut.show();
            }
        }
        contMotivoRetiroAut.hide();
        contEstadoAut.hide();
        componentesAut.hide();
    });
}

$(document).on('click', '#noVisibleTerminalAut', function() {
    const terminalStyle = document.getElementById('input-terminal-aut')
    var boxTerminal = $("#noVisibleTerminalAut")
    if (boxTerminal.is(":checked")) {
        terminalStyle.style.background = "#b2beca";
        document.getElementById('input-terminal-aut').value = "no-visible";
    } else {
        var getTerminal = localStorage.getItem('terminal');

        terminalStyle.style.background = "#D6EAF8";
        if (getTerminal !== null) {
            document.getElementById('input-terminal-aut').value = getTerminal;
        }

    }

})

function templateMovisarAut() {

    $("#labelSerieAut").text("Nro MAC")
    $("#input-serie-aut").attr("placeholder", "Ingrese nro de MAC")

    var html = ""
    html += '<label ><strong >Cable de red</strong></label>'

    html += '<div class="form-check">'
    html += '<input class="form-check-input cable-red-aut" type="radio" name="examplecable" id="cable-si" value="si"></input>'
    html += '<label class="form-check-label" for="Si tiene cable red">'
    html += 'Si'
    html += '</label>'
    html += '</div>'
    html += '<div class="form-check">'
    html += ' <input class="form-check-input cable-red-aut" type="radio"  name="examplecable" id="cable-no" value="no">'
    html += '<label class="form-check-label" for="No tiene cable red">'
    html += ' No'
    html += '</label>'

    return html

}

function validateMovistarAut() {

    var validate = true;
    let serieEnBaseINPUTAut = $("#input-serie-aut")

    if (serieEnBaseINPUTAut.val() === "") {
        alertNegative('Debes ingresar nro de MAC');
        validate = false
    }

    if (serieEnBaseINPUTAut.val().length < 6) {
        alertNegative('El nro de mac debe tener 6 digitos como minimo');
        validate = false
    }

    let cableSi = $("#cable-si")
    let cableNo = $("#cable-no")

    if (!cableSi.is(":checked") && !cableNo.is(":checked")) {

        alertNegative('Debes indicar si posee cable de red');
        validate = false
    }

    return validate;

}


$(document).on('click', '.cable-red-aut', function() {

    var esto = this
    var value = $(esto).val()
    $("#input-chip-aut").val(value)


})

// si no entrega accesorio dos de empresa diferente
function ifYouDoNotDeliverAccessoryNumberTwoFromAnotherOfCompanyAut() {

    contSimCardAut.hide();
    simCardAutINPUT.hide();
    simCardAutINPUT.val("no");
}

//si entrega accesorio cuatro de empresa diferente
function ifYouDeliverAccessoryNumberTwoFromAnotherOfCompanyAut() {

    contSimCardAut.show();
    simCardAutINPUT.show();
    simCardAutINPUT.val("");
}

//si entrega accesorio cuatro de empresa diferente
function ifYouDoNotDeliverAccessoryNumberFourFromAnotherOfCompanyAut() {

    contSerieBaseAut.hide();
    serieBaseAutINPUT.hide();
    serieBaseAutINPUT.val("No");
}

function ifYouDeliverAccessoryNumberFourFromAnotherOfCompanyAut() {

    contSerieBaseAut.show();
    serieBaseAutINPUT.show();
    serieBaseAutINPUT.val("");
}