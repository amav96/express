// 2) capturo los datos del formulario y los envio al localstorage

var estadoInfo;
async function leerDatosEquiposAutorizar() {

    $(document).on("click", "#enviar", function(e) {
        e.preventDefault();
        $("#contLoaderAutorizar").append('<div id="loaderAutorizar" class="spinner-border" role="status"><span class="sr-only">Loading...</span></div>')

        $("#enviar").hide();
        var motivoRetiro = document.getElementById('motivo-retiro-select').value
        var estado = document.getElementById('input-estado-aut').value
        var accesorioUnoLS = $('input[name="accesorio-uno-aut"]:checked').val()
        var accesorioDosLS = $('input[name="accesorio-dos-aut"]:checked').val()
        var accesorioTresLS = $('input[name="accesorio-tres-aut"]:checked').val()
        var accesorioCuatroLS = $('input[name="accesorio-cuatro-aut"]:checked').val()
        var accesorios = document.getElementById('input-otrosaccesorios-en-base').value
        var id = document.getElementById('idServ').value
        var identificacion = document.getElementById('input-identificacion-aut').value

        if (identificacion.toUpperCase().substr(0, 2) === 'PS' || identificacion.toUpperCase().substr(0, 2) === 'LA') {

            var terminal = document.getElementById('input-serie-aut').value
            var serie = document.getElementById('input-terminal-aut').value

        } else {

            var terminal = document.getElementById('input-terminal-aut').value
            var serie = document.getElementById('input-serie-aut').value
        }


        var serie_base = document.getElementById('serie-base-aut').value
        var chipAlternativo = 'No aplica'
        var tarjeta = document.getElementById('input-chip-aut').value

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

        var dateTime = hoy.getFullYear() + '-' + ("0" + (hoy.getMonth() + 1)).slice(-2) + '-' +
            ("0" + hoy.getDate()).slice(-2) + ' ' + getHora + ':' + getMinutos + ':' + getSegundos;

        // falta tarjeta /chip ---------------- 

        var codHash = JSON.parse(localStorage.getItem('odh'))
        var codOrden = JSON.parse(localStorage.getItem('odi'))
        var codUser = JSON.parse(localStorage.getItem('rec'))
        estadoInfo = localStorage.getItem('en');
        ++contadorGuiaEquipoLs

        const infoEquipo = {
            estado,
            motivoRetiro,
            accesorioUnoLS,
            accesorioDosLS,
            accesorioTresLS,
            accesorioCuatroLS,
            accesorios,
            id,
            terminal,
            identificacion,
            serie,
            serie_base,
            chipAlternativo,
            tarjeta,
            codHash,
            codOrden,
            codUser,
            dateTime,
            contadorGuiaEquipoLs,

        }

        var equiposLS;


        var getIdentificacionComparar;
        var identificacionComparar;

        equiposLS = obtenerEquiposLocalStorageAut();
        equiposLS.forEach(function(equipoLS) {


            getIdentificacionComparar = equipoLS.identificacion
            identificacionComparar = getIdentificacionComparar.substr(0, 2)

            if (equipoLS.serie === infoEquipo.serie) {
                equiposLS = equipoLS.serie;

            }

        });

        let empresasLS;
        empresasLS = obtenerEquiposLocalStorageAut();
        empresasLS.forEach(function(empresaLS) {

            if (empresaLS.identificacion === infoEquipo.identificacion) {
                empresasLS = empresaLS.identificacion
            }

        })

        if (equiposLS === infoEquipo.serie) { //si la terminal que entra existe en el localstorage ya cargado, 

            $("#loaderAutorizar").remove();
            alertNegative('Esta serie ya fue agregada en la caja');
            $("#enviar").show();
            return false;

        } else if ($("#input-serie-aut").val() === '') {

            $("#enviar").show();
            $("#loaderAutorizar").remove();

            let identificacion = $("#q").val().trim().toUpperCase().substr(0, 2)

            if (identificacion === 'MV' || inicialesEmpresa === 'CL') {
                alertNegative('Debes ingresar numero de MAC');
                return false;
            }
            alertNegative('Debes ingresar numero de serie');
            return false;
        }

        if (empresasLS.length !== 0) { //si  el numero de cliente existe en el localstorage- validame todo esto (ES DECIR: ya hay equipos en la caja)

            if (empresasLS !== infoEquipo.identificacion) {
                $("#abrirfirmar").hide()
                $("#enviar").show();
                $("#loaderAutorizar").remove();
                alertNegative('Si queres cargar equipos de otro cliente: Hace clic en "Salir de transacci��n"');
                return false;

            }
            if (identificacionComparar !== 'LA' && identificacionComparar !== 'PS' && identificacionComparar !== 'GC') {
                if (serieAutINPUT.val() === "") {
                    $("#enviar").show();
                    $("#loaderAutorizar").remove();

                    if (identificacionComparar == 'MV' || identificacionComparar === 'CL') {
                        alertNegative('Debes ingresar el nro de MAC');
                        return false
                    }

                    alertNegative('Debes ingresar el nro de serie');
                    return false;

                } else if (serieAutINPUT.val().length < 5) {
                    $("#enviar").show();
                    $("#loaderAutorizar").remove();
                    if (identificacionComparar == 'MV' || identificacionComparar === 'CL') {
                        alertNegative('La MAC debe tener un minimo de 8 digitos');
                        return false
                    }

                    alertNegative('La serie debe tener un minimo de 5 digitos');
                    return false;
                }

            } else {
                if (terminalAutINPUT.val() === "") {
                    $("#enviar").show();
                    $("#loaderAutorizar").remove();
                    alertNegative('Debes ingresar el nro de terminal ');
                    return false;

                } else if (terminalAutINPUT.val().length < 7) {
                    $("#enviar").show();
                    $("#loaderAutorizar").remove();
                    alertNegative('La terminal debe tener un minimo de 7 digitos');
                    return false;
                }

            }
            validateEquipoDB(infoEquipo, '1', '#input-serie-aut', estadoInfo);
        } else { //si el id que entra no existe en el LocalStorage, evaluamos esto
            var getIdentificacionInputCuandoNoHayNada = $("#q").val().trim()
            if (getIdentificacionInputCuandoNoHayNada.substr(0, 2) !== 'LA' && getIdentificacionInputCuandoNoHayNada.substr(0, 2) !== 'PS' && getIdentificacionInputCuandoNoHayNada.substr(0, 2) !== 'GC') {

                if (serieAutINPUT.val() === "") {
                    $("#enviar").show();
                    $("#loaderAutorizar").remove();

                    if (getIdentificacionInputCuandoNoHayNada.substr(0, 2) == 'MV' || getIdentificacionInputCuandoNoHayNada.substr(0, 2) == 'CL') {
                        alertNegative("Debes ingresar el nro de MAC");
                        return false;
                    }
                    alertNegative("Debes ingresar el nro de serie");
                    return false;
                } else if (serieAutINPUT.val().length < 7) {
                    $("#enviar").show();
                    $("#loaderAutorizar").remove();
                    alertNegative("El nro de serie contiene minimo 7 digitos");
                    return false;
                }
            } else {

                if (terminalAutINPUT.val() === "") {
                    $("#enviar").show();
                    $("#loaderAutorizar").remove();
                    alertNegative("Debes ingresar el nro de terminal del equipo");
                    return false;
                } else if (terminalAutINPUT.val().length < 7) {
                    $("#enviar").show();
                    $("#loaderAutorizar").remove();
                    alertNegative("El nro de terminal contiene minimo 7 digitos");
                    return false;
                }

            }

            var template = "";
            template = showLoader();
            $("#cargandoAutorizar").html(template)
                // este es load que se genera

            validateEquipoDB(infoEquipo, '1', '#input-serie-aut', estadoInfo);

        }

    })
}

function insertarEquiposAut(infoEquipo) {

    mayusEmpresaCaja = infoEquipo.identificacion.toUpperCase()
    nombreEmpresaCaja = mayusEmpresaCaja.substr(0, 2)
    const row = document.createElement('div');
    if (nombreEmpresaCaja === 'PS') {
        row.innerHTML = `
 <div class="lista">
<span><strong>Terminal:</strong>  ${infoEquipo.terminal} </span>
<span><strong>Serie:</strong>  ${infoEquipo.serie} </span>
<span><strong>Identificacion:</strong>  ${infoEquipo.identificacion} </span>
<span><strong>Nro Sim Card:</strong>  ${infoEquipo.tarjeta} </span>
<span><strong>Estado:</strong>  ${infoEquipo.estado} </span>
<span><strong>Motivo:</strong>  ${infoEquipo.motivoRetiro} </span>
<span><strong>C.Telefonico:</strong>  ${infoEquipo.accesorioUnoLS} </span>
<span><strong>Sim Card:</strong>  ${infoEquipo.accesorioDosLS} </span>
<span><strong>Cargador:</strong>  ${infoEquipo.accesorioTresLS} </span>
<span><strong>Base:</strong>  ${infoEquipo.accesorioCuatroLS} </span>
<span><strong>Otros accesorios:</strong>  ${infoEquipo.accesorios} </span>
<span><strong>Sim Alt:</strong>  ${infoEquipo.chipAlternativo} </span>
<span><strong>Base serie:</strong>  ${infoEquipo.serie_base} </span>
<span><strong>Horario:</strong>  ${infoEquipo.dateTime} </span>
<span>
<a href="#" style="transform:scale(1.5);margin:0.5rem;" id="borrar-equipo" class="borrar-equipo fas fa-times-circle" data-contadorGuiaEquipoLs="${infoEquipo.contadorGuiaEquipoLs}"></a> 
</span>
</div>
`;

    }
    if (nombreEmpresaCaja === 'LA' || nombreEmpresaCaja === 'GC') {
        row.innerHTML = `
 <div class="lista">
<span><strong>Terminal:</strong>  ${infoEquipo.terminal} </span>
<span><strong>Serie:</strong>  ${infoEquipo.serie} </span>
<span><strong>Identificacion:</strong>  ${infoEquipo.identificacion} </span>
<span><strong>Estado:</strong>  ${infoEquipo.estado} </span>
<span><strong>C.Telefonico:</strong>  ${infoEquipo.accesorioUnoLS} </span>
<span><strong>Sim Card:</strong>  ${infoEquipo.accesorioDosLS} </span>
<span><strong>Cargador:</strong>  ${infoEquipo.accesorioTresLS} </span>
<span><strong>Base:</strong>  ${infoEquipo.accesorioCuatroLS} </span>
<span><strong>Otros accesorios:</strong>  ${infoEquipo.accesorios} </span>
<span><strong>Horario:</strong>  ${infoEquipo.dateTime} </span>
<span>
<a href="#" style="transform:scale(1.5);margin:0.5rem;" id="borrar-equipo" class="borrar-equipo fas fa-times-circle" data-contadorGuiaEquipoLs="${infoEquipo.contadorGuiaEquipoLs}"></a> 
</span>
</div>
`;

    }

    if (nombreEmpresaCaja !== 'LA' && nombreEmpresaCaja !== 'PS' && nombreEmpresaCaja !== 'GC' && nombreEmpresaCaja !== 'MV' && nombreEmpresaCaja !== 'CL') {

        row.innerHTML = `
 <div class="lista">
<span><strong>Serie:</strong>  ${infoEquipo.serie} </span>
<span><strong>Identificacion:</strong>  ${infoEquipo.identificacion} </span>
<span><strong>Estado:</strong>  ${infoEquipo.estado} </span>
<span><strong>C.HDMI:</strong>  ${infoEquipo.accesorioUnoLS} </span>
<span><strong>C.AV :</strong>  ${infoEquipo.accesorioDosLS} </span>
<span><strong>Fuente:</strong>  ${infoEquipo.accesorioTresLS} </span>
<span><strong>Control:</strong>  ${infoEquipo.accesorioCuatroLS} </span>
<span><strong>Otros accesorios:</strong>  ${infoEquipo.accesorios} </span>
<span><strong>Horario:</strong>  ${infoEquipo.dateTime} </span>
<span>
<a href="#" style="transform:scale(1.5);margin:0.5rem;" id="borrar-equipo" class="borrar-equipo fas fa-times-circle" data-contadorGuiaEquipoLs="${infoEquipo.contadorGuiaEquipoLs}"></a> 
</span>
</div>
`;

    }
    if (nombreEmpresaCaja === 'MV' || nombreEmpresaCaja === 'CL') {

        row.innerHTML = `
 <div class="lista">
<span><strong>MAC:</strong>  ${infoEquipo.serie} </span>
<span><strong>Identificacion:</strong>  ${infoEquipo.identificacion} </span>
<span><strong>Estado:</strong>  ${infoEquipo.estado} </span>
<span><strong>Cable red:</strong>  ${infoEquipo.tarjeta} </span>
<span><strong>C.HDMI:</strong>  ${infoEquipo.accesorioUnoLS} </span>
<span><strong>C.AV :</strong>  ${infoEquipo.accesorioDosLS} </span>
<span><strong>Fuente:</strong>  ${infoEquipo.accesorioTresLS} </span>
<span><strong>Control:</strong>  ${infoEquipo.accesorioCuatroLS} </span>
<span><strong>Otros accesorios:</strong>  ${infoEquipo.accesorios} </span>
<span><strong>Horario:</strong>  ${infoEquipo.dateTime} </span>
<span>
<a href="#" style="transform:scale(1.5);margin:0.5rem;" id="borrar-equipo" class="borrar-equipo fas fa-times-circle" data-contadorGuiaEquipoLs="${infoEquipo.contadorGuiaEquipoLs}"></a> 
</span>
</div>
`;

    }
    listaEquipos.appendChild(row);

    obtenerEquiposLocalStorageAut()

    guardarEquiposLocalStorageAut(infoEquipo)

}

function guardarEquiposLocalStorageAut(infoEquipo) {

    let equipos;
    equipos = this.obtenerEquiposLocalStorage();
    equipos.push(infoEquipo);
    localStorage.setItem('transito', JSON.stringify(equipos));
}

function obtenerEquiposLocalStorageAut() {

    let equipoLS;

    if (localStorage.getItem('transito') === null) {
        equipoLS = [];
    } else {
        equipoLS = JSON.parse(localStorage.getItem('transito'));
    }
    return equipoLS;

}


function showLoader() {

    var html = "";
    html += '<div class="spinner-border" id="loadloadload" role="status">';
    html += '<span class="sr-only">Loading...</span>';
    html += '</div>';

    return html;
}

function validateEquipoDB(infoEquipo, campo, input, estadoEnvioLS) {
    var codHash = JSON.parse(localStorage.getItem('odh'))

    let EnviarParaValidar = $("" + input + "").val()

    $.ajax({

        url: "../controllers/equipoController.php?equipo=validar",
        type: "POST",
        data: { EnviarParaValidar, campo },
        beforeSend: function() {

        },
        success: function(response) {

            var reciboDataValidar = JSON.parse(response)

            if (reciboDataValidar[0].result !== 1) {
                $("#enviar").show();
                $("#loaderAutorizar").remove();
                alertNegative('El nro de SERIE/MAC ya existe en nuestra base de datos, ingrese otro o comuniquese con nuestras operadoras');
                return false;
            } else if (estadoEnvioLS === 's') {

                $("#mantenerEnvioDeRemito").show()
                $("#text-caja-confirmar").text("Transacción actual")
                $("#loaderAutorizar").remove();
                $("#abrirfirmar").hide()
                $("#enviar").show();
                alertNegative('Debes cerrar la caja para poder agregar mas equipos');
                return false;

            }

            if (reciboDataValidar[0].result === 1) {

                var datoIngresadoABuscar = $("#q").val().trim();
                var pasarClienteAMayuscula = datoIngresadoABuscar.toUpperCase();
                var inicialesEmpresa = pasarClienteAMayuscula.substr(0, 2);

                $("#loaderAutorizar").remove();
                $("#table").hide();
                $("#enviar").show();
                $("#codEmail").val(codHash)
                $("#idFirmar").val(codHash);
                $("#abrir-caja-equipos").show()
                $("#idServ").val("")
                $("#agregarTeams").modal("hide");
                alertPositive('Equipo agregado correctamente');
                $("#textTable").text('')
                $("#loaderAutorizar").remove();
                ContarEquiposEnLS();
                setearDomForm();

                if (inicialesEmpresa === 'PS' || inicialesEmpresa === 'MV' || inicialesEmpresa === 'CL') {
                    $("#abrirfirmar").show();
                    $("#mantenerEnvioDeRemito").hide();
                }
                if (inicialesEmpresa !== 'PS' && inicialesEmpresa !== 'MV' || inicialesEmpresa === 'CL') {

                    $("#abrirfirmar").hide();
                    $("#siguienteNormal").show();
                }

                insertarEquiposAut(infoEquipo);
                ContarEquiposEnLS();
                return true

            }
        }
    })

}

// 2) Si existe una orden en el localstorage, mantener items de transaccion