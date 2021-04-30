$(document).on('click', '#createRange', function () {

    var html = "";

    $("#modalAsignacion").modal('show');
    $("#titleAssigned").text('Crear nuevo codigo postal');

    html = viewCreateRange();
    $("#content-range").html(html);

})

$(document).on('change', '#create_range_type', function () {

    $("#content-point").html('');
    $("#create_range_id_country").prop("selectedIndex", 0);
})

$(document).on('change', '#create_range_id_country', function () {


    var id_country = $("#create_range_id_country").val();
    var type = $("#create_range_type").val();


    var html = '';

    if (type === '0') {

        $("#create_range_id_country").prop("selectedIndex", 0);
        alertNegative('Debes escoger el tipo');
        return false;

    } else if (id_country !== "0" && $("#create_range_type").val() === 'comercio') {

        const objectTypePoint = {
            centinel: 'all',
            id_country,
            type
        }
        // para llenar el select de comercios
        getUsers(objectTypePoint);
        html = viewCreateRangeToCommerce();
        $("#content-point").html(html)

        const objectCreate = {
            id_country: $("#create_range_id_country").val(),
        }
        getProvinceCreateRange(objectCreate);


    } else if (id_country !== "0" && $("#create_range_type").val() === 'correo') {

        html = viewCreateRangeToCorreo();
        $("#content-point").html(html)

        const objectCreate = {
            id_country: $("#create_range_id_country").val(),
        }
        getProvinceCreateRange(objectCreate);

    } else if (id_country !== "0" && $("#create_range_type").val() === 'terminal') {

        html = viewCreateRangeToTerminal();
        $("#content-point").html(html)

        const objectCreate = {
            id_country: $("#create_range_id_country").val(),
        }
        getProvinceCreateRange(objectCreate);

    } else if (id_country !== "0" && $("#create_range_type").val() === 'recolector') {

        const objectTypePoint = {
            centinel: 'all',
            id_country,
            type
        }
        getUsers(objectTypePoint);
        html = viewCreateRangeToCollector();
        $("#content-point").html(html)

        const objectCreate = {
            id_country: $("#create_range_id_country").val(),
        }
        getProvinceCreateRange(objectCreate);

    }
    else {
        $("#content-point").html('')
    }

})

$(document).on('change', '#create_range_province', function () {
    id_province = $("#create_range_province").val();

    id_country = $("#create_range_id_country").val();

    const objectProvince = {
        id_province,
        id_country
    }

    getLocateCreateRange(objectProvince);

})

$(document).on('click', '#create_range_locate', function () {

    if ($("#create_range_province").val() === '0') {

        alertNegative('Debes seleccionar provincia');

    }else{
        
    }
})


$(document).on('click', '#btnCreateRange', function () {

    if ($("#create_range_type").val() === '0' || $("#create_range_type").val() === '') {

        alertNegative('Debes seleccionar el tipo');

        return false;
    } if ($("#create_range_id_country").val() === '0' || $("#create_range_id_country").val() === '') {

        alertNegative('Debes seleccionar el pais');

        return false;
    } if ($("#create_range_province").val() === '0' || $("#create_range_province").val() === '') {

        alertNegative('Debes seleccionar una provincia');

        return false;
    } if ($("#locate").val() === '0' || $("#locate").val() === '') {

        alertNegative('Debes seleccionar una localidad');

        return false;
    }

    if ($("#create_range_type").val() === 'correo') {

        validateCreateRangeCorreo();

    } else if ($("#create_range_type").val() === 'terminal') {

        validateCreateRangeTerminal();

    } else if ($("#create_range_type").val() === 'comercio') {

        validateCreateRangeCommerce();

    } else if ($("#create_range_type").val() === 'recolector') {

        validateCreateRangeCollector();
    }


})

function validateCreateRangeCorreo() {

    if ($("#create_range_type").val() === '' || $("#create_range_type").val() === '0') {
        alertNegative('Debes seleccionar el tipo');
        return false;

    } if ($("#create_range_id_country").val() === '' || $("#create_range_id_country").val() === '0') {
        alertNegative('Debes seleccionar el pais');
        return false;
    }
    else if ($("#home_address").val() === '') {

        alertNegative('Debes ingresar la direccion del correo');

        return false;

    } else if ($("#customer_service_hours").val() === '') {

        alertNegative('Debes ingresar el horario de atención');

        return false;

    } else if ($("#postal_code").val() === '' || $("#postal_code_range").val() === '') {

        alertNegative('Debes ingresar el rango del codigo postal');

        return false;

    } else {

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

  var created_at = hoy.getFullYear() + '-' + ("0" +(hoy.getMonth() + 1)).slice(-2) + '-' +
  ("0" + hoy.getDate()).slice(-2)+ ' ' + getHora + ':' + getMinutos + ':' + getSegundos;

        const objectDataCreateRange = {

            id_country: $("#create_range_id_country").val(),
            locate: $('select[name=locate] option:selected').text(),
            province: $('select[name=province] option:selected').text(),
            home_address: $("#home_address").val(),
            type: $("#create_range_type").val(),
            id_user: 'correo',
            name: 'correo',
            user_managent_id: $("#id_user_default").val(),
            customer_service_hours: $("#customer_service_hours").val(),
            postal_code: $("#postal_code").val(),
            postal_code_range: $("#postal_code_range").val(),
            created_at,
            action: 'createRange'
        }

        askSomething('¿Estas seguro/a de crear este rango entre codigos postales?', 'Esta acción tomara los datos que has ingresado y creara nuevos registros entre el rango indicado', 'info', 'Salir', 'Crear', 'createRange', objectDataCreateRange);
    }

}

function validateCreateRangeTerminal() {

    if ($("#create_range_type").val() === '' || $("#create_range_type").val() === '0') {
        alertNegative('Debes seleccionar el tipo');
        return false;

    } if ($("#create_range_id_country").val() === '' || $("#create_range_id_country").val() === '0') {
        alertNegative('Debes seleccionar el pais');
        return false;
    } else if ($("#home_address").val() === '') {

        alertNegative('Debes ingresar la direccion de la terminal');

        return false;

    } else if ($("#customer_service_hours").val() === '') {

        alertNegative('Debes ingresar el horario de atención');

        return false;

    } else if ($("#postal_code").val() === '' || $("#postal_code_range").val() === '') {

        alertNegative('Debes ingresar el rango del codigo postal');

        return false;

    } else {


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

  var created_at = hoy.getFullYear() + '-' + ("0" +(hoy.getMonth() + 1)).slice(-2) + '-' +
  ("0" + hoy.getDate()).slice(-2)+ ' ' + getHora + ':' + getMinutos + ':' + getSegundos;

        const objectDataCreateRange = {

            id_country: $("#create_range_id_country").val(),
            locate: $('select[name=locate] option:selected').text(),
            province: $('select[name=province] option:selected').text(),
            home_address: $("#home_address").val(),
            type: $("#create_range_type").val(),
            id_user: 'terminal',
            name: 'terminal',
            user_managent_id: $("#id_user_default").val(),
            customer_service_hours: $("#customer_service_hours").val(),
            postal_code: $("#postal_code").val(),
            postal_code_range: $("#postal_code_range").val(),
            created_at,
            action: 'createRange'
        }

        askSomething('¿Estas seguro/a de crear este rango entre codigos postales?', 'Esta acción tomara los datos que has ingresado y creara nuevos registros entre el rango indicado', 'info', 'Salir', 'Crear', 'createRange', objectDataCreateRange);
    }

}

function validateCreateRangeCommerce() {

    if ($("#create_range_type").val() === '' || $("#create_range_type").val() === '0') {
        alertNegative('Debes seleccionar el tipo');
        return false;

    } else if ($("#create_range_id_country").val() === '' || $("#create_range_id_country").val() === '0') {

        alertNegative('Debes seleccionar el pais');
        return false;

    }

    else if ($("#id_user").val() === '' || $("#id_user").val() === '0') {

        alertNegative('Debes seleccionar el comercio');
        return false;

    } else if ($("#home_address").val() === '') {

        alertNegative('Debes ingresar la direccion del comercio');
        return false;

    } else if ($("#customer_service_hours").val() === '') {

        alertNegative('Debes indicar el horario de atencion del comercio');
        return false;
    } else if ($("#postal_code").val() === '' || $("#postal_code_range").val() === '') {

        alertNegative('Debes ingresar el rango del codigo postal');

        return false;

    } else {
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
      
        var created_at = hoy.getFullYear() + '-' + ("0" +(hoy.getMonth() + 1)).slice(-2) + '-' +
        ("0" + hoy.getDate()).slice(-2)+ ' ' + getHora + ':' + getMinutos + ':' + getSegundos;


        const objectDataCreateRange = {

            id_country: $("#create_range_id_country").val(),
            locate: $('select[name=locate] option:selected').text(),
            province: $('select[name=province] option:selected').text(),
            home_address: $("#home_address").val(),
            type: $("#create_range_type").val(),
            id_user: $("#id_user").val(),
            name: $('select[name=id_user] option:selected').text(),
            user_managent_id: $("#id_user_default").val(),
            customer_service_hours: $("#customer_service_hours").val(),
            postal_code: $("#postal_code").val(),
            postal_code_range: $("#postal_code_range").val(),
            created_at,
            action: 'createRange'
        }

        askSomething('¿Estas seguro/a de crear este rango entre codigos postales?', 'Esta acción tomara los datos que has ingresado y creara nuevos registros entre el rango indicado', 'info', 'Salir', 'Crear', 'createRange', objectDataCreateRange);
    }

}

function validateCreateRangeCollector() {

    if ($("#create_range_type").val() === '' || $("#create_range_type").val() === '0') {
        alertNegative('Debes seleccionar el tipo');
        return false;

    } else if ($("#create_range_id_country").val() === '' || $("#create_range_id_country").val() === '0') {

        alertNegative('Debes seleccionar el pais');
        return false;

    } else if ($("#postal_code").val() === '' || $("#postal_code_range").val() === '') {

        alertNegative('Debes ingresar el rango del codigo postal');

        return false;

    }

    else if ($("#id_user").val() === '' || $("#id_user").val() === '0') {

        alertNegative('Debes seleccionar el recolector');

        return false;

    }
    else {

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

  var created_at = hoy.getFullYear() + '-' + ("0" +(hoy.getMonth() + 1)).slice(-2) + '-' +
  ("0" + hoy.getDate()).slice(-2)+ ' ' + getHora + ':' + getMinutos + ':' + getSegundos;

        const objectDataCreateRange = {

            id_country: $("#create_range_id_country").val(),
            locate: $('select[name=locate] option:selected').text(),
            province: $('select[name=province] option:selected').text(),
            type: $("#create_range_type").val(),
            id_user: $("#id_user").val(),
            name: $('select[name=id_user] option:selected').text(),
            user_managent_id: $("#id_user_default").val(),
            postal_code: $("#postal_code").val(),
            postal_code_range: $("#postal_code_range").val(),
            created_at,
            action: 'createRange'
        }
        askSomething('¿Estas seguro/a de crear este rango entre codigos postales?', 'Esta acción tomara los datos que has ingresado y creara nuevos registros entre el rango indicado', 'info', 'Salir', 'Crear', 'createRange', objectDataCreateRange);
    }

}

function viewCreateRange() {
    var html = '';

    html += '<div class="form-group">';
    html += '<label for="tipo">Tipo</label>';
    html += '<div class="d-flex justify-content-center flex-row">';
    html += '<div class="input-group-prepend">';
    html += '<div class="input-group-text"><i class="fas fa-user-check"></i></div>';
    html += '</div>';
    html += '<select class="form-control" id="create_range_type">';
    html += '<option value="0">Seleccione Tipo</option>';
    html += '<option value="correo"> Correo</option>';
    html += '<option value="terminal"> Terminal</option>';
    html += '<option value="comercio"> Comercio</option>';
    html += '<option value="recolector"> Recolector</option>';
    html += '</select>';
    html += '</div>';
    html += '</div>';


    //pais 

    html += '<div class="form-group">';
    html += '<label for="Pais">Pais</label>';

    html += '<div class="d-flex justify-content-center flex-row">';
    html += '<div class="input-group-prepend">';
    html += '<div class="input-group-text"><i class="fas fa-flag"></i></div>';
    html += '</div>';
    html += '<select class="form-control" id="create_range_id_country">';
    html += '<option value="0" >Seleccione un pais</option>';
    html += '<option value="1" >Argentina</option>';
    html += '<option value="2" >Uruguay</option>';
    html += '</select>';

    html += '</div>';
    html += '</div>';

    //type of point 

    html += '<div id="content-point" >';

    html += '</div>';



    return html;

}

function viewCreateRangeToCorreo() {

    var html = "";

    //choose province

    html += '<div class="form-group">';
    html += '<label id="labelProvince" for="Provincia"> Provincia <span class="textUbication" style="color:#0093f5;font-size:15px;"><strong></strong></span></label>';
    html += '<div class="d-flex justify-content-center flex-row">';
    html += '<div class="input-group-prepend">';
    html += '<div class="input-group-text"><i class="fab fa-font-awesome-flag"></i></div>';
    html += '</div>';
    html += '<select  name="province" class="form-control" id="create_range_province">';
    html += '</select>';
    html += '</div>';
    html += '</div>';

    //choose localidad

    html += '<div class="form-group">';
    html += '<label id="labelLocalidad" for="localidad"> Localidad<span class="textUbication" style="color:#0093f5;font-size:15px;"><strong</strong></span></label>';
    html += '<div class="d-flex justify-content-center flex-row">';
    html += '<div class="input-group-prepend">';
    html += '<div class="input-group-text"><i class="fas fa-location-arrow"></i></div>';
    html += '</div>';
    html += '<select  name="locate" class="form-control" id="create_range_locate">';
    html += '<option value="0" >Seleccione localidad </option>';
    html += '</select>';
    html += '</div>';

    //choose home_address

    html += '<div class="form-group">';
    html += '<label for="direccion"> Direccion</label>';
    html += '<div class="d-flex justify-content-center flex-row">';
    html += '<div class="input-group-prepend">';
    html += '<div class="input-group-text"><i class="fas fa-home"></i></div>';
    html += '</div>';
    html += '<input type="text" class="form-control" id="home_address" placeholder="Dirección">';
    html += '</div>';
    html += '</div>';

    //show customers_hours_service

    html += '<div class="form-group ">';
    html += '<label for="horario">Horario de atención</label>';
    html += '<div class="d-flex justify-content-center flex-row">';
    html += '<div class="input-group-prepend">';
    html += '<div class="input-group-text"><i class="far fa-clock"></i></div>';
    html += '</div>';
    html += '<input class="form-control" id="customer_service_hours" placeholder="Lunes a viernes 9 am - 17pm">';
    html += '</div>';
    html += '</div>';

    //codigo postal 

    html += '<label for="codigopostal"> Rango Codigo Postal</label>';
    html += '<div class="d-flex justify-content-center flex-row">';
            html += '<div class="form-group d-flex justify-content-center flex-row">';
                html += '<div class="input-group-prepend">';
                html += '<div class="input-group-text"><i class="far fa-compass"></i></div>';
                html += '</div>';
            html += '<input type="number" class="form-control" id="postal_code" placeholder="Desde">';
            html += '</div>';
        
            html += '<div class="form-group d-flex justify-content-center flex-row">';
                html += '<div class="input-group-prepend">';
                html += '<div class="input-group-text"><i class="far fa-compass"></i></div>';
                html += '</div>';
            html += '<input type="number" class="form-control"  id="postal_code_range" placeholder="Hasta">';
            html += '</div>';
        html += '</div>';



    html += '</div>';
    html += '</div>';

    html += '<div class="form-group ">';
    html += '<button id="btnCreateRange" class="btn btn-primary" > <span class="spinner-border hiddenLoader loaderBtn" role="status"></span> <span class="txtCreateRange"> Crear Rango </span> <i class="fas fa-plus"></i></button>';
    html += '</div>';


    return html;
}

function viewCreateRangeToTerminal() {

    var html = "";

    //choose province

    html += '<div class="form-group">';
    html += '<label id="labelProvince" for="Provincia"> Provincia <span class="textUbication" style="color:#0093f5;font-size:15px;"><strong></strong></span></label>';
    html += '<div class="d-flex justify-content-center flex-row">';
    html += '<div class="input-group-prepend">';
    html += '<div class="input-group-text"><i class="fab fa-font-awesome-flag"></i></div>';
    html += '</div>';
    html += '<select  name="province" class="form-control" id="create_range_province">';
    html += '</select>';
    html += '</div>';
    html += '</div>';

    //choose localidad

    html += '<div class="form-group">';
    html += '<label id="labelLocalidad" for="localidad"> Localidad<span class="textUbication" style="color:#0093f5;font-size:15px;"><strong</strong></span></label>';
    html += '<div class="d-flex justify-content-center flex-row">';
    html += '<div class="input-group-prepend">';
    html += '<div class="input-group-text"><i class="fas fa-location-arrow"></i></div>';
    html += '</div>';
    html += '<select  name="locate" class="form-control" id="create_range_locate">';
    html += '<option value="0" >Seleccione localidad </option>';
    html += '</select>';
    html += '</div>';



    //choose home_address

    html += '<div class="form-group">';
    html += '<label for="direccion"> Direccion</label>';
    html += '<div class="d-flex justify-content-center flex-row">';
    html += '<div class="input-group-prepend">';
    html += '<div class="input-group-text"><i class="fas fa-home"></i></div>';
    html += '</div>';
    html += '<input type="text" class="form-control" id="home_address" placeholder="Dirección">';
    html += '</div>';
    html += '</div>';

    //show customers_hours_service

    html += '<div class="form-group ">';
    html += '<label for="horario">Horario de atención</label>';
    html += '<div class="d-flex justify-content-center flex-row">';
    html += '<div class="input-group-prepend">';
    html += '<div class="input-group-text"><i class="far fa-clock"></i></div>';
    html += '</div>';
    html += '<input class="form-control" id="customer_service_hours" placeholder="Lunes a viernes 9 am - 17pm">';
    html += '</div>';
    html += '</div>';

    //codigo postal 

    html += '<label for="codigopostal"> Rango Codigo Postal</label>';
    html += '<div class="d-flex justify-content-center flex-row">';
            html += '<div class="form-group d-flex justify-content-center flex-row">';
                html += '<div class="input-group-prepend">';
                html += '<div class="input-group-text"><i class="far fa-compass"></i></div>';
                html += '</div>';
            html += '<input type="number" class="form-control" id="postal_code" placeholder="Desde">';
            html += '</div>';
        
            html += '<div class="form-group d-flex justify-content-center flex-row">';
                html += '<div class="input-group-prepend">';
                html += '<div class="input-group-text"><i class="far fa-compass"></i></div>';
                html += '</div>';
            html += '<input type="number" class="form-control"  id="postal_code_range" placeholder="Hasta">';
            html += '</div>';
        html += '</div>';

    html += '<div class="form-group ">';
    html += '<button id="btnCreateRange" class="btn btn-primary" > <span class="spinner-border hiddenLoader loaderBtn" role="status"></span> <span class="txtCreateRange"> Crear Rango </span> <i class="fas fa-plus"></i></button>';
    html += '</div>';


    return html;
}

function viewCreateRangeToCommerce() {

    var html = "";
    //choose province

    html += '<div class="form-group">';
    html += '<label id="labelProvince" for="Provincia"> Provincia <span class="textUbication" style="color:#0093f5;font-size:15px;"><strong></strong></span></label>';
    html += '<div class="d-flex justify-content-center flex-row">';
    html += '<div class="input-group-prepend">';
    html += '<div class="input-group-text"><i class="fab fa-font-awesome-flag"></i></div>';
    html += '</div>';
    html += '<select  name="province" class="form-control" id="create_range_province">';
    html += '</select>';
    html += '</div>';
    html += '</div>';

    //choose localidad

    html += '<div class="form-group">';
    html += '<label id="labelLocalidad" for="localidad"> Localidad<span class="textUbication" style="color:#0093f5;font-size:15px;"><strong</strong></span></label>';
    html += '<div class="d-flex justify-content-center flex-row">';
    html += '<div class="input-group-prepend">';
    html += '<div class="input-group-text"><i class="fas fa-location-arrow"></i></div>';
    html += '</div>';
    html += '<select  name="locate" class="form-control" id="create_range_locate">';
    html += '<option value="0" >Seleccione localidad </option>';
    html += '</select>';
    html += '</div>';



    //choose comercio
    html += '<div class="form-group">';
    html += '<label for="comercio"> Comercio</label>';
    html += '<div class="d-flex justify-content-center flex-row">';
    html += '<div class="input-group-prepend">';
    html += '<div class="input-group-text"><i class="fas fa-store-alt"></i></div>';
    html += '</div>';
    html += '<select class="form-control" name="id_user" id="id_user">';


    html += '</select>';
    html += '</div>';

    html += '</div>';

    //choose home_address

    html += '<div class="form-group">';
    html += '<label for="direccion"> Direccion</label>';
    html += '<div class="d-flex justify-content-center flex-row">';
    html += '<div class="input-group-prepend">';
    html += '<div class="input-group-text"><i class="fas fa-home"></i></div>';
    html += '</div>';
    html += '<input type="text" class="form-control" id="home_address" placeholder="Dirección">';
    html += '</div>';
    html += '</div>';

    //show customers_hours_service

    html += '<div class="form-group ">';
    html += '<label for="horario">Horario de atención</label>';
    html += '<div class="d-flex justify-content-center flex-row">';
    html += '<div class="input-group-prepend">';
    html += '<div class="input-group-text"><i class="far fa-clock"></i></div>';
    html += '</div>';
    html += '<input class="form-control" id="customer_service_hours" placeholder="Lunes a viernes 9 am - 17pm">';
    html += '</div>';
    html += '</div>';

    html += '<div id="content-point" >';

    html += '</div>';

    //codigo postal 

    html += '<label for="codigopostal"> Rango Codigo Postal</label>';
    html += '<div class="d-flex justify-content-center flex-row">';
            html += '<div class="form-group d-flex justify-content-center flex-row">';
                html += '<div class="input-group-prepend">';
                html += '<div class="input-group-text"><i class="far fa-compass"></i></div>';
                html += '</div>';
            html += '<input type="number" class="form-control" id="postal_code" placeholder="Desde">';
            html += '</div>';
        
            html += '<div class="form-group d-flex justify-content-center flex-row">';
                html += '<div class="input-group-prepend">';
                html += '<div class="input-group-text"><i class="far fa-compass"></i></div>';
                html += '</div>';
            html += '<input type="number" class="form-control"  id="postal_code_range" placeholder="Hasta">';
            html += '</div>';
        html += '</div>';



    html += '<div class="form-group ">';
    html += '<button id="btnCreateRange" class="btn btn-primary" > <span class="spinner-border hiddenLoader loaderBtn" role="status"></span> <span class="txtCreateRange"> Crear Rango </span> <i class="fas fa-plus"></i></button>';
    html += '</div>';


    return html;
}

function viewCreateRangeToCollector() {

    var html = "";

    //choose province

    html += '<div class="form-group">';
    html += '<label id="labelProvince" for="Provincia"> Provincia <span class="textUbication" style="color:#0093f5;font-size:15px;"><strong></strong></span></label>';
    html += '<div class="d-flex justify-content-center flex-row">';
    html += '<div class="input-group-prepend">';
    html += '<div class="input-group-text"><i class="fab fa-font-awesome-flag"></i></div>';
    html += '</div>';
    html += '<select  name="province" class="form-control" id="create_range_province">';
    html += '</select>';
    html += '</div>';
    html += '</div>';

    //choose localidad

    html += '<div class="form-group">';
    html += '<label id="labelLocalidad" for="localidad"> Localidad<span class="textUbication" style="color:#0093f5;font-size:15px;"><strong</strong></span></label>';
    html += '<div class="d-flex justify-content-center flex-row">';
    html += '<div class="input-group-prepend">';
    html += '<div class="input-group-text"><i class="fas fa-location-arrow"></i></div>';
    html += '</div>';
    html += '<select  name="locate" class="form-control" id="create_range_locate">';
    html += '<option value="0" >Seleccione localidad </option>';
    html += '</select>';
    html += '</div>';

    //choose recolector
    html += '<div class="form-group">';
    html += '<label for="recolector"> Recolector</label>';
    html += '<div class="d-flex justify-content-center flex-row">';
    html += '<div class="input-group-prepend">';
    html += '<div class="input-group-text"><i class="fas fa-truck"></i></div>';
    html += '</div>';
    html += '<select class="form-control" name="id_user" id="id_user">';

    html += '</select>';
    html += '</div>';

    html += '</div>';


    html += '<div id="content-point" >';

    html += '</div>';

    //codigo postal 

    html += '<label for="codigopostal"> Rango Codigo Postal</label>';
    html += '<div class="d-flex justify-content-center flex-row">';
            html += '<div class="form-group d-flex justify-content-center flex-row">';
                html += '<div class="input-group-prepend">';
                html += '<div class="input-group-text"><i class="far fa-compass"></i></div>';
                html += '</div>';
            html += '<input type="number" class="form-control" id="postal_code" placeholder="Desde">';
            html += '</div>';
        
            html += '<div class="form-group d-flex justify-content-center flex-row">';
                html += '<div class="input-group-prepend">';
                html += '<div class="input-group-text"><i class="far fa-compass"></i></div>';
                html += '</div>';
            html += '<input type="number" class="form-control"  id="postal_code_range" placeholder="Hasta">';
            html += '</div>';
        html += '</div>';


    html += '<div class="form-group ">';
    html += '<button id="btnCreateRange" class="btn btn-primary" > <span class="spinner-border hiddenLoader loaderBtn" role="status"></span> <span class="txtCreateRange"> Crear Rango </span> <i class="fas fa-plus"></i></button>';
    html += '</div>';


    return html;
}

function getProvinceCreateRange(object) {

    $.ajax({
        url: base_url + 'coberturaController.php?cobertura=getProvince',
        type: 'POST',
        data: { object },
        beforeSend: function () {
            $("#labelProvince .textUbication").html(' Cargando...');
        },
    }).done(function (response) {
        $("#labelProvince .textUbication").html('');
        var objectResponse = JSON.parse(response);
        var template = "";

        if (objectResponse[0].result === '1') {
            template = showProvinceCreateRange(objectResponse);
            $("#create_range_province").html(template);
        } else {
            alertNegative('No existe provincia');
        }
    })

}

function showProvinceCreateRange(object) {

    var html = "";
    html += '<option value="0">Seleccione provincia</option>';
    object.forEach((val) => {

        html += '<option value="' + val.id + '" >' + val.province + '</option>';

    })

    return html;

}

function getLocateCreateRange(object) {

    $.ajax({
        url: base_url + 'coberturaController.php?cobertura=getLocate',
        type: 'POST',
        data: { object },
        beforeSend: function () {
            $("#labelLocalidad .textUbication").html(' Cargando...')
        },
    }).done(function (response) {
        var objectResponse = JSON.parse(response);
        $("#labelLocalidad .textUbication").html('')
        if (objectResponse[0].result === '1') {

            var template = "";

            template = showLocateCreateRange(objectResponse);
            $("#create_range_locate").html(template);
        } else {
            template += `<option value="0" >Seleccione localidad</option>`;
            $("#create_range_locate").html(template);
        }
    })
}

function showLocateCreateRange(object) {

    var html = "";
    html += '<option value="0" >Seleccione localidad</option>';
    object.forEach((val) => {
        html += '<option value="' + val.locate + '" >' + val.locate + '</option>';
    })

    return html;

}

function createRange(object) {

    $.ajax({

        url: base_url + 'coberturaController.php?cobertura=saveRange',
        type: 'POST',
        data: { object },
        beforeSend: function () {
            showLoader('#btnCreateRange', '.loaderBtn', '.txtCreateRange');
        },
    }).done(function (response) {

        hideLoader('#btnCreateRange', '.loaderBtn', '.txtCreateRange', 'Crear Rango');

        var objectResponse = JSON.parse(response);


        if (objectResponse[0].result === '1') {

            if (object.action === 'createRange') {

                var html = showAllAssigned(objectResponse);
                html = showAllAssigned(objectResponse);
                $("#contentTable").html(html);
                table();
                alertPositive('Realizado correctamente');
                $("#modalAsignacion").modal('hide');
            }

        } else {
            alertNegative('No se creo correctamente');
        }
    })
}
