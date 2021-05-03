//open modal update for range
$(document).on('click', '#updateRange', function () {
    var template = "";
    $("#modalAsignacion").modal("show");
    $("#titleAssigned").text('Actualizar por rango de codigo postal');
    template = viewContentUpdateRange();
    $("#content-range").html(template);
})

$(document).on('change', '#type', function () {
   
    $("#content-point").html('');
    $("#id_country").prop("selectedIndex", 0);
})

$(document).on('change','#id_country',function(){

    var id_country = $("#id_country").val();
    var type = $("#type").val();
    var flag = $("#flag").val();
  
    var html = '';

    const object = {
        centinel: 'all',
        id_country,
        type
      }
    
      if(type==='correo'&& flag === 'updateRange'){
    
        getProvince(object);
        getProvinceZone(object);
        html = viewUpatedRangeToCorreo();
        $("#content-point").html(html);
      
      }else if(type==='terminal'&& flag === 'updateRange'){

        getProvince(object);
        getProvinceZone(object);
        html = viewUpatedRangeToTerminal();
        $("#content-point").html(html);


      }else if(type==='comercio' && flag === 'updateRange'){

        getProvince(object);
        getProvinceZone(object);
        getUsers(object);
        html = viewUpatedRangeToCommerce();
        $("#content-point").html(html);

          
      }
      else if(type==='recolector' && flag === 'updateRange'){
      
          getProvince(object);
          getProvinceZone(object);
          getUsers(object);
          html = viewUpatedRangeToCollector();
          $("#content-point").html(html);
      
      
        }

})

//examinar informacion, / buscar que hay en ese rango

$(document).on('click', '#examine', function () {

    var id_operator = $("#id_operator").val();
    var name = $("#namer").val();
    var type = $("#type").val();
    var lat = $("#lat").val();
    var lng = $("#lng").val();

    if( type === 'correo' || type === 'terminal' || type === 'comercio'){

        if(lat === '' || lng === ''){
            alertInfo('Debes geocodificar la ubicación','','info');

            setTimeout(function(){
                $('#modalAsignacion').animate({
                    scrollTop: 0
                }, 1000);
    
            },3000)

            return false;
        }
       
    }


    if(validateFieldUpdateRange() !== 'success'){
        alertNegative(validateFieldUpdateRange());
        return false;
    }else{

        if(type === 'comercio' || type==='recolector'){

            if($("#id_user").val() === '0' || $("#id_user").val() === ''){

                alertNegative('Debes seleccionar el '+type);

                return false;
            }
        }

        const object = {
            postal_code: $("#postal_code_start").val(),
            postal_code_range: $("#postal_code_finish").val(),
            id_country: $("#id_country").val(),
            id: '',
            action: 'beforeUpdate'
        }

        searchZipCodes(object);

    }

})

$(document).on('click', '#updateZipCodes', function () {

    var type = $("#type").val();
    var id_country = $("#id_country").val();
    var type_color= "";
    var country_color = "";
    var detailed_type = "";
    var arrCodesUpdate = new Array();
    //aca tendria que validar si hay algun codigo seleccionado
    var count = 0;
    var countChecked = 0;

    $("input[name=code]").each(function () {
        count = $("input[name=code]").length
        if ($(this).is(':checked')) {
            //lo que se reemplaza
            arrCodesUpdate.push($(this).val());
        }else{
            countChecked++;
        }
    })

    
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
    id_country === '1' ? country_color='primary' : country_color='light';

    id_country === '1' ? country_color='primary' : country_color='light';

    if(id_country === '1' && type=== 'correo'){

        detailed_type = 'Correo Argentino';

    }if(id_country === '1' && type=== 'terminal'){

        detailed_type = 'Buspack';

    }if(id_country === '2' && type=== 'correo'){

        detailed_type = 'Correo Uruguayo';

    }if(id_country === '2' && type=== 'terminal'){
        detailed_type = 'Turil';

    }

    var objectDataUpdate = "";

               if (type === 'correo') {

                if(validateFieldUpdateRange() !== 'success'){
                    alertNegative(validateFieldUpdateRange());
                    return false;
                }

            var customer_service_hours =  $("#start_day").val()+' '+'-'+' '+$("#finish_day").val()+ ' ' +$("#hours_schedule_start").val() +' '+'-'+' '+ $("#hours_schedule_finish").val() ;
            type_color = 'warning';
        

            objectDataUpdate = {

                postal_code: $("#postal_code_start").val(),
                postal_code_range: $("#postal_code_finish").val(),
                home_address: $("#home_address").val(),
                id: arrCodesUpdate,
                type:$("#type").val(), 
                id_user:'correo' , 
                name: 'correo',
                customer_service_hours,
                user_managent_id: $("#id_user_default").val(),
                lat: $("#lat").val(),
                lng: $("#lng").val(),
                id_operator: $("#id_operator").val(),
                detailed_type,
                country_color,
                type_color,
                created_at: created_at,
                action: 'updateRange'
            }

        } else if (type === 'terminal') {

            if(validateFieldUpdateRange() !== 'success'){
                alertNegative(validateFieldUpdateRange());
                return false;
            }

            var customer_service_hours =  $("#start_day").val()+' '+'-'+' '+$("#finish_day").val()+ ' ' +$("#hours_schedule_start").val() +' '+'-'+' '+ $("#hours_schedule_finish").val() ;
            type_color = 'danger';

            objectDataUpdate = {

                postal_code: $("#postal_code_start").val(),
                postal_code_range: $("#postal_code_finish").val(),
                home_address: $("#home_address").val(),
                id: arrCodesUpdate,
                type:$("#type").val(), 
                id_user:'terminal' , 
                name: 'terminal',
                customer_service_hours,
                user_managent_id: $("#id_user_default").val(),
                lat: $("#lat").val(),
                lng: $("#lng").val(),
                id_operator: $("#id_operator").val(),
                detailed_type,
                country_color,
                type_color,
                created_at: created_at,
                action: 'updateRange'
            }

        } else if (type === 'comercio') {

            if(validateFieldUpdateRange() !== 'success'){
                alertNegative(validateFieldUpdateRange());
                return false;
            }

            if ($("#id_user").val() === '0' | $("#id_user").val() === '') {

                alertNegative('Debes seleccionar un comercio');
                return false;

            }

            type_color = 'primary';

            objectDataUpdate = {

                postal_code: $("#postal_code_start").val(),
                postal_code_range: $("#postal_code_finish").val(),
                home_address: $("#home_address").val(),
                id: arrCodesUpdate,
                type: 'comercio',
                name: $('select[name=id_user] option:selected').text(),
                customer_service_hours: $("#customer_service_hours").val(),
                id_user: $("#id_user").val(),
                user_managent_id: $("#id_user_default").val(),
                lat: $("#lat").val(),
                lng: $("#lng").val(),
                id_operator: $("#id_operator").val(),
                detailed_type:type,
                country_color,
                type_color,
                created_at: created_at,
                action: 'updateRange'
            }

        } else if (type === 'recolector') {

            if ($("#id_user").val() === '0' | $("#id_user").val() === '') {

                alertNegative('Debes seleccionar un recolector');
                return false;
            }

            type_color = 'success';

            objectDataUpdate = {

                postal_code: $("#postal_code_start").val(),
                postal_code_range: $("#postal_code_finish").val(),
                id_country: $("#id_country").val(),
                id: arrCodesUpdate,
                type: 'recolector',
                name: $('select[name=id_user] option:selected').text(),
                id_user: $("#id_user").val(),
                user_managent_id: $("#id_user_default").val(),
                id_operator: $("#id_operator").val(),
                detailed_type:type,
                country_color,
                type_color,
                created_at: created_at,
                action: 'updateRange'
            }

        }

    if (count == countChecked) {
        alertNegative('No hay codigos postales para actualizar');
        return false;
    }

    //se le pasa como 7mo parametro o (6to posicionandolo como array) el metodo del back.
    askSomething('Estas seguro/a de actualizar los codigos postales', 'Para poder aplicar la actualizacion debe estar como minimo un codigo postal seleccionado', 'info', 'Salir', 'Actualizar', 'updateRangeZipCode', objectDataUpdate);

})

//select all zip codes
var selected = true;
$(document).on('click', '#selectAll', function () {

    if (selected) {
        $('#code input[type=checkbox]').prop("checked", true);
        $('#txtselectAll').text('Dejar de seleccionar ');
        selected = false;

    } else {
        $('#code input[type=checkbox]').prop("checked", false);
        $('#txtselectAll').text('Seleccionar todo');
        selected = true;

    }
})

function validateFieldUpdateRange(){
 
    var messages = '';
    var type = $("#type").val();

    if ($("#id_country").val() === '0') {
        messages = 'Debes escoger el pais';

    }
    else if ($("#home_address").val() === '') {
        messages = 'Debes ingresar la dirección';
   
    }
    else if ($("#hours_schedule_start").val() === '') {

        messages = 'Debes ingresar el horario de apertura';
   
        
    }else if ($("#hours_schedule_finish").val() === '') {
        messages = 'Debes ingresar el horario de cierre';
 

    }else if ($("#start_day").val() === '0') {

        messages = 'Debes ingresar el dia inicial';


    }else if ($("#finish_day").val() === '0') {

        messages = 'Debes ingresar el dia final';

    }

    else if ($("#postal_code_start").val() === '') {

        messages = 'Debes ingresar el codigo postal donde inicia la cobertura';

    }
    else if ($("#postal_code_finish").val() === '') {

        messages = 'Debes ingresar el codigo postal donde finaliza la cobertura';

    }else if($("#id_operator").val() === '' || $("#name").val() === ''){

        messages = 'Debes asignar operador/a a esta zona';

    }
    else {

        messages = 'success';
    }

    return messages
    
}

function codesSelection(objectResponse) {

    var html = "";

   
    html +='<div class="row identy shadow p-4 rounded my-4">';
        
            html +='<div class="col-md-6 ">';   
                html += '<span  ><strong style="color:#fff;">Codigos disponibles en el rango</strong> <i class="fas fa-map-marked-alt"></i></span>'
            html +='</div>';

            html +='<div class="col-md-6" >';   
                html += '<span  ><strong style="color:#fff;">Seleccione los codigos que desea reemplazar</strong> <i class="fas fa-hand-pointer"></i></span>'
            html +='</div>';
    html +='</div>';

        html +='<div class="d-flex justify-content-center">';
            html += '<div class="form-group">';
            html += '<button class="btn identy" id="selectAll" ><span id="txtselectAll">Seleccionar todo</span> <i class="far fa-object-ungroup"></i></button>';
            html += '</div>';
        html += '</div>';

    html += '<div class="d-flex justify-content-center row">';
      
    objectResponse.forEach((val) => {

        
        if (val.type === 'correo') {
            html += '<div class="form-check form-check-inline col-md-3" id="code">';
                html += '<div class="alert alert-warning"> <i class="mx-2 far fa-envelope"></i>';
                html += '<input class="form-check-input code-check" type="checkbox" value="' + val.id + '" name="code"><span><strong>' + val.postal_code + '</strong> | ' + val.type + ' | <strong>' + val.locate + '</strong> | ' + val.home_address;
                html += '</div>';
            html += '</div>';

        } else if (val.type === 'comercio') {

            html += '<div class="form-check form-check-inline col-md-3" id="code">';
                html += '<div class="alert alert-primary"><i class="mx-2 fas fa-store"></i>';
                html += '<input class="form-check-input code-check" type="checkbox" value="' + val.id + '" name="code"> <strong>' + val.postal_code + ' </strong>| ' + val.type + ' | ' + val.name + ' |<strong> ' + val.locate + ' </strong>| ' + val.home_address;
                html += '</div>';
            html += '</div>';

        } else if (val.type === 'terminal') {

            html += '<div class="form-check form-check-inline col-md-3" id="code">';
                html += '<div class="alert alert-danger"><i class="mx-2 fas fa-bus"></i>';
                html += '<input class="form-check-input code-check" type="checkbox" value="' + val.id + '" name="code"> <strong>' + val.postal_code + '</strong> | ' + val.type + ' | <strong>' + val.locate + ' </strong>| ' + val.home_address;
                html += '</div>';
            html += '</div>';

        } else if (val.type === 'recolector') {

            html += '<div class="form-check form-check-inline col-md-3" id="code">';
                html += '<div class="alert alert-success"> <i class="mx-2 fas fa-truck"></i>';
                html += '<input class="form-check-input code-check" type="checkbox" value="' + val.id + '" name="code"> <strong>' + val.postal_code + '</strong> | ' + val.type + ' | ' + val.name + ' | <strong>' + val.locate + '</strong> | ' + val.home_address;
                html += '</div>';
            html += '</div>';    

        }
    
    })

    html += '</div>';
    

    html +='<div class="row d-flex justify-content-center">';
        html +='<div class="col-md-6">';
            html += '<button id="updateZipCodes" class="btn btn-success col-12"><span class="spinner-border hiddenLoader loaderBtn" role="status"></span> <span class="txtCodeSelection">Ejecutar actualización de codigos postales</span> <i class="far fa-check-circle"></i></button>';
        html +='</div>';
    html +='</div>';

    return html;

}

function viewContentUpdateRange() {

    var html = '';

    html = '<input id="flag" type="hidden" value="updateRange">';

    html += '<div  class="row my-2">';
            html += ' <div  class="col-md-5">';
                    html += '<label  class="txtBlue">Seleccione el tipo de recuperación para esta zona</label>';
            html += '</div>';
        html += ' </div>';

    html += '<div class="row">';
        html += '<div class="col-md-6">';
            html += '<div class="form-group">';
            html += '<label for="tipo">Tipo</label>';
                html += '<div class="d-flex justify-content-center flex-row">';
                        html += '<div class="input-group-prepend">';
                        html += '<div class="input-group-text"><i class="fas fa-user-check"></i></div>';
                        html += '</div>';
                            html += '<select class="form-control" id="type">';
                            html += '<option value="0">Seleccione Tipo</option>';
                            html += '<option value="correo"> Correo</option>';
                            html += '<option value="terminal"> Terminal</option>';
                            html += '<option value="comercio"> Comercio</option>';
                            html += '<option value="recolector"> Recolector</option>';
                            html += '</select>';
                html += '</div>';
            html += '</div>';
        html +='</div>';
    

    //pais 

        html += '<div class="col-md-6">';
            html += '<div class="form-group">';
            html += '<label for="Pais">Pais</label>';
                    html += '<div class="d-flex justify-content-center flex-row">';
                        html += '<div class="input-group-prepend">';
                        html += '<div class="input-group-text"><i class="fas fa-flag"></i></div>';
                        html += '</div>';
                            html += '<select class="form-control" id="id_country">';
                            html += '<option value="0" >Seleccione un pais</option>';
                            html += '<option value="1" >Argentina</option>';
                            html += '<option value="2" >Uruguay</option>';
                            html += '</select>';
                    html += '</div>';
            html += '</div>';
        html += '</div>';
        //final row    
    html +='</div>';

    //type of point 

    html += '<div id="content-point">';

    html += '</div>';



    return html;

}

function viewUpatedRangeToCorreo() {
    var html = "";
      
     //titulo ubicacion del point

     html += '<div  class="row my-2">';
        html += ' <div  class="col-md-4">';
        html +='<label  class="txtBlue">Ubicación del correo</label>';
        html += '</div>';
     html += '</div>';
    
    //choose province

    html += '<div  class="row">';
        html += ' <div  class="col-md-3">';
            html += '<div class="form-group">';
            html += '<label  id="labelProvince" for="Provincia"> Provincia<span class="textUbication" style="color:#0093f5;font-size:15px;"><strong</strong></span></label>';
                html += '<div class="d-flex justify-content-center flex-row">';
                        html += '<div class="input-group-prepend">';
                        html += '<div class="input-group-text"><i class="fab fa-font-awesome-flag"></i></div>';
                        html += '</div>';
                        html += '<select  name="province" class="form-control" id="province">';
                        html += '</select>';
                html += '</div>';
            html += '</div>';
        html += '</div>';

    //choose localidad
    
    html += ' <div  class="col-md-3">';
        html += '<div class="form-group">';
        html += '<label id="labelLocalidad" for="localidad"> Localidad <span class="textUbication" style="color:#0093f5;font-size:15px;"><strong</strong></span></label>';
                html += '<div class="d-flex justify-content-center flex-row">';
                            html += '<div class="input-group-prepend">';
                            html += '<div class="input-group-text"><i class="fas fa-location-arrow"></i></div>';
                            html += '</div>';
                            html += '<select  name="locate" class="form-control" id="locate">';
                              html += '<option value="0"> Seleccione una localidad </option>';
                            html += '</select>';
                html += '</div>';
       html += '</div>';
    html += '</div>';

    // codigo postal

    html += ' <div  class="col-md-4">';
        html += '<div class="form-group ">';
            html += '<label for="codigo postal">Codigo postal</label>';
                    html += '<div class="d-flex justify-content-center flex-row">';
                            html += '<div class="input-group-prepend">';
                            html += '<div class="input-group-text"><i class="far fa-compass"></i></div>';
                            html += '</div>';
                            html += '<input class="form-control" id="postal_code" placeholder="Ingrese codigo postal" readonly>';
                    html += '</div>';
            html += '</div>';
        html += '</div>';
        //fin row
    html += '</div>';

    //choose home_address

    html += '<div  class="row">';

        html += ' <div  class="col-md-4">';
            html += '<div class="form-group">';
                html += '<label for="direccion"> Direccion</label>';
                    html += '<div class="d-flex justify-content-center flex-row">';
                        html += '<div class="input-group-prepend">';
                        html += '<div class="input-group-text"><i class="fas fa-home"></i></div>';
                        html += '</div>';
                        html += '<input type="text" class="form-control" id="home_address" placeholder="Dirección" >';
                    html += '</div>';
            html += '</div>';
        html += '</div>';

         // lat long

         html += ' <div  class="col-md-3">';
            html += '<div class="form-group">';
            html += '<label for="latitud"> Latitud</label>';
                html += '<div class="d-flex justify-content-center flex-row">';
                    html += '<div class="input-group-prepend">';
                    html += '<div class="input-group-text"><i class="fas fa-map-pin"></i></div>';
                    html += '</div>';
                    html += '<input type="text" class="form-control" id="lat" placeholder="Latitud" data-toggle="tooltip" data-placement="top" title="Geocodificar" readonly>';
                html += '</div>';
            html += '</div>';
         html += '</div>';

        html += ' <div  class="col-md-3">';
            html += '<div class="form-group">';
            html += '<label for="longitud"> Longitud</label>';
                html += '<div class="d-flex justify-content-center flex-row">';
                    html += '<div class="input-group-prepend">';
                    html += '<div class="input-group-text"><i class="fas fa-map-pin"></i></div>';
                    html += '</div>';
                    html += '<input type="text" class="form-control" id="lng" placeholder="Longitud" data-toggle="tooltip" data-placement="top" title="Geocodificar" readonly>';
                html += '</div>';
            html += '</div>';
        html += '</div>';

        //boton para ubicar las direcciones

        html += ' <div class="col-md-3 align-self-center mt-3">';
            html +='<button id="geocoding" class="btn btn-success"><span class="spinner-border hiddenLoader loaderBtn" role="status"></span> <span class="txtGeocode"> Geocodificar </span> <i class="fas fa-map-marked-alt"></i></button>';
        html += '</div>';
    
    // fin row
    html +='</div>';
       

        html +='<div id="contentGeo"> </div>';

        //titulo horarios de atencion

     html += '<div  class="row my-2">';
        html += ' <div  class="col-md-4 ">';
        html +='<label  class="txtBlue">Horarios de atención</label>';
        html += '</div>';
     html += '</div>';
 

    //show customers_hours_service

    html += '<div  class="row">';
        html += ' <div  class="col-md-2">';
                    html += '<div class="d-flex justify-content-center flex-row ">';
                                html += '<div class="input-group-prepend">';
                                html += '<div class="input-group-text"><i class="far fa-clock"></i></div>';
                                html += '</div>';
                                    html += '<input type="time" class="form-control" id="hours_schedule_start" >';
                    html+='</div>';
            html+='</div>';

                html += ' <div  class="d-flex justify-content-center col-md-1">';
                        html += '<label class="align-items-center align-self-center"> Hasta</label>';
                html+='</div>';
    
        html += ' <div  class="col-md-2">';
                html += '<div class="d-flex justify-content-center flex-row ">';
                        html += '<div class="input-group-prepend">';
                        html += '<div class="input-group-text"><i class="far fa-clock"></i></div>';
                        html += '</div>';
                            html += '<input type="time" class="form-control"  id="hours_schedule_finish" >';
                html += '</div>';
            html += '</div>';

            //dias

            // html += '<div class="d-flex justify-content-center flex-row">';
                html += ' <div  class="col-md-3">';   
                        html += '<div class="form-group d-flex justify-content-center flex-row">';
                            html += '<div class="input-group-prepend">';
                            html += '<div class="input-group-text"><i class="far fa-clock"></i></div>';
                            html += '</div>';
                                    html += '<select class="form-control" id="start_day">';
                                            html += '<option value="0" >Seleccione día</option>';
                                            html += '<option value="Lunes" >Lunes</option>';
                                            html += '<option value="Martes" >Martes</option>';
                                            html += '<option value="Miercoles" >Miercoles</option>';
                                            html += '<option value="Jueves" >Jueves</option>';
                                            html += '<option value="Viernes" >Viernes</option>';
                                            html += '<option value="Sabado" >Sabado</option>';
                                            html += '<option value="Domingo" >Domingo</option>';
                                    html += '</select>';
                        html +='</div>';
                html +='</div>';

                html += ' <div  class="d-flex justify-content-center col-md-1">';
                        html += '<label class="align-items-center align-self-center"> Hasta</label>';
                html+='</div>';
            

            html += '<div  class="col-md-3">';
                        html += '<div class="form-group d-flex justify-content-center flex-row">';
                                html += '<div class="input-group-prepend">';
                                html += '<div class="input-group-text"><i class="far fa-clock"></i></div>';
                                html += '</div>';
                                    html += '<select class="form-control" id="finish_day">';
                                        html += '<option value="0" >Seleccione día</option>';
                                        html += '<option value="Lunes" >Lunes</option>';
                                        html += '<option value="Martes" >Martes</option>';
                                        html += '<option value="Miercoles" >Miercoles</option>';
                                        html += '<option value="Jueves" >Jueves</option>';
                                        html += '<option value="Viernes" >Viernes</option>';
                                        html += '<option value="Sabado" >Sabado</option>';
                                        html += '<option value="Domingo" >Domingo</option>';
                                    html += '</select>';
                        html += '</div>';
            html += '</div>';
    html += '</div>'; 

            //datos del codigo postal a cubrir/asignar/actualizar

        html += '<div  class="row my-2">';
            html += ' <div  class="col-md-5">';
                    html += '<label  class="txtBlue">Datos de la zona a cubrir</label>';
            html += '</div>';
        html += ' </div>';

        html += '<div  class="row">';
            html += ' <div  class="col-md-3">';
                html += '<div class="form-group">';
                html += '<label  id="labelProvince" for="Provincia"> Provincia<span class="textUbication" style="color:#0093f5;font-size:15px;"><strong</strong></span></label>';
                    html += '<div class="d-flex justify-content-center flex-row">';
                            html += '<div class="input-group-prepend">';
                            html += '<div class="input-group-text"><i class="fab fa-font-awesome-flag"></i></div>';
                            html += '</div>';
                            html += '<select  name="province_zone" class="form-control" id="province_zone">';
                            html += '</select>';
                    html += '</div>';
                html += '</div>';
            html += '</div>';

        //choose localidad
        
        html += ' <div  class="col-md-3">';
            html += '<div class="form-group">';
            html += '<label id="labelLocalidad" for="localidad"> Localidad <span class="textUbication" style="color:#0093f5;font-size:15px;"><strong</strong></span></label>';
                    html += '<div class="d-flex justify-content-center flex-row">';
                                html += '<div class="input-group-prepend">';
                                html += '<div class="input-group-text"><i class="fas fa-location-arrow"></i></div>';
                                html += '</div>';
                                html += '<select  name="locate_zone" class="form-control" id="locate_zone">';
                                html += '<option value="0"> Seleccione una localidad </option>';
                                html += '</select>';
                    html += '</div>';
            html += '</div>';
        html += '</div>';

        html += ' <div  class="col-md-4">';
            html += '<div class="form-group ">';
                html += '<label for="codigo postal">Codigo postal</label>';
                        html += '<div class="d-flex justify-content-center flex-row">';
                                html += '<div class="input-group-prepend">';
                                html += '<div class="input-group-text"><i class="far fa-compass"></i></div>';
                                html += '</div>';
                                html += '<input class="form-control" id="postal_code_zone" placeholder="Ingrese codigo postal" readonly>';
                        html += '</div>';
                html += '</div>';
            html += '</div>';
            //fin row
        html += '</div>';
        // ---------------------------------------------------------


    //datos del operador 

    html += '<div  class="row my-2">';
        html += ' <div  class="col-md-5">';
                 html += '<label  class="txtBlue">Datos del operador asignado a esta zona</label>';
        html += '</div>';
    html += ' </div>';


    html += ' <div  class="row">';

        html += ' <div  class="col-md-3">';
            html += '<div class="form-group">';
                html += '<label for="operador"> Operador</label>';
                    html += '<div class="d-flex justify-content-center flex-row">';
                        html += '<div class="input-group-prepend">';
                        html += '<div class="input-group-text"><i class="fas fa-users"></i></div>';
                        html += '</div>';
                        html += '<input type="text" class="form-control" id="name" placeholder="Operador" readonly > ';
                    html += '</div>';
            html += '</div>';
        html += '</div>';

        html += ' <div  class="col-md-3">';
            html += '<div class="form-group">';
            html += '<label for="id"> identificacion</label>';
                html += '<div class="d-flex justify-content-center flex-row">';
                    html += '<div class="input-group-prepend">';
                    html += '<div class="input-group-text"><i class="fas fa-address-card"></i></div>';
                    html += '</div>';
                    html += '<input type="text" class="form-control" id="id_operator" placeholder="Identificación" data-toggle="tooltip" data-placement="top" title="Geolocalizar" readonly>';
                html += '</div>';
            html += '</div>';
        html += '</div>';


        html += ' <div  class="col-md-5 align-self-center mt-3">';
            html += '<button class="btn btn-success" id="assigned"> Asignar operador/a </button>';
        html += '</div>';

        html += ' <div  class="col-md-3 align-self-center mt-3">';
            html += '<div id="alert-toast" ></div>';
        html += '</div>';
        
    //fin row
    html += '</div>';



    //titulo rango de codigo postal a actualizar
    html += '<div  class="row my-2">';
        html += ' <div  class="col-md-8">';
         html += '<label  class="txtBlue">Rango del codigo postal a cubrir <span style="font-weight:400;" >(Realizara una busqueda entre el rango de los codigos postales ingresados)</span></label>';
        html += '</div>';
    html += '</div>';


    //choose codigo postal
    html += '<div class="row">';

        html +='<div class="col-md-3">';
            html +='<label> Inicio  codigo postal </label>';
                    html += '<div class="form-group d-flex justify-content-center flex-row">';
                        html += '<div class="input-group-prepend">';
                        html += '<div class="input-group-text"><i class="far fa-compass"></i></div>';
                        html += '</div>';
                        html += '<input type="number" class="form-control" id="postal_code_start" placeholder="Desde">';
                    html += '</div>';
        html +='</div>';


        html +='<div class="col-md-3">';
        html +='<label> Final  codigo postal </label>';
                    html += '<div class="form-group d-flex justify-content-center flex-row">';
                        html += '<div class="input-group-prepend">';
                        html += '<div class="input-group-text"><i class="far fa-compass"></i></div>';
                        html += '</div>';
                        html += '<input type="number" class="form-control"  id="postal_code_finish" placeholder="Hasta">';
                    html += '</div>';
        html += '</div>';

        html +='<div class="col-md-4 d-flex align-self-center mt-3">';
                        html += '<button id="examine" class="btn btn-primary"><span class="spinner-border hiddenLoader loaderBtn" role="status"></span> <span class="txtExamine"> Siguiente </span> <i class="fas fa-search"></i></button>';
        html += '</div>';
    
    // fin de row
    html += '</div>';

    //seleccion de codigos postales a actualizar
    html += '<div class="text-center" id="content_codes_selection" >';

    html += '</div>';


    return html;

}

function viewUpatedRangeToTerminal() {

    var html = "";

    // terminal / id
    html += '<input type="hidden" class="form-control" value="2" id="id_user" >';

    //titulo ubicacion del point

    html += '<div  class="row my-2">';
        html += ' <div  class="col-md-4">';
        html +='<label  class="txtBlue">Ubicación de la terminal</label>';
        html += '</div>';
    html += '</div>';


    //choose province

    html += '<div  class="row">';
        html += ' <div  class="col-md-3">';
            html += '<div class="form-group">';
            html += '<label  id="labelProvince" for="Provincia"> Provincia<span class="textUbication" style="color:#0093f5;font-size:15px;"><strong</strong></span></label>';
                html += '<div class="d-flex justify-content-center flex-row">';
                        html += '<div class="input-group-prepend">';
                        html += '<div class="input-group-text"><i class="fab fa-font-awesome-flag"></i></div>';
                        html += '</div>';
                        html += '<select  name="province" class="form-control" id="province">';
                        html += '</select>';
                html += '</div>';
            html += '</div>';
        html += '</div>';

    //choose localidad
    
    html += ' <div  class="col-md-3">';
        html += '<div class="form-group">';
        html += '<label id="labelLocalidad" for="localidad"> Localidad <span class="textUbication" style="color:#0093f5;font-size:15px;"><strong</strong></span></label>';
                html += '<div class="d-flex justify-content-center flex-row">';
                            html += '<div class="input-group-prepend">';
                            html += '<div class="input-group-text"><i class="fas fa-location-arrow"></i></div>';
                            html += '</div>';
                            html += '<select  name="locate" class="form-control" id="locate">';
                            html += '<option value="0"> Seleccione una localidad </option>';
                            html += '</select>';
                html += '</div>';
       html += '</div>';
    html += '</div>';

    html += ' <div  class="col-md-4">';
        html += '<div class="form-group ">';
            html += '<label for="codigo postal">Codigo postal</label>';
                    html += '<div class="d-flex justify-content-center flex-row">';
                            html += '<div class="input-group-prepend">';
                            html += '<div class="input-group-text"><i class="far fa-compass"></i></div>';
                            html += '</div>';
                            html += '<input class="form-control" id="postal_code" placeholder="Ingrese codigo postal" readonly>';
                    html += '</div>';
            html += '</div>';
        html += '</div>';
        //fin row
    html += '</div>';

    //choose home_address

    html += '<div  class="row">';

        html += ' <div  class="col-md-4">';
            html += '<div class="form-group">';
                html += '<label for="direccion"> Direccion</label>';
                    html += '<div class="d-flex justify-content-center flex-row">';
                        html += '<div class="input-group-prepend">';
                        html += '<div class="input-group-text"><i class="fas fa-home"></i></div>';
                        html += '</div>';
                        html += '<input type="text" class="form-control" id="home_address" placeholder="Dirección" >';
                    html += '</div>';
            html += '</div>';
        html += '</div>';

         // lat long

         html += ' <div  class="col-md-3">';
            html += '<div class="form-group">';
            html += '<label for="latitud"> Latitud</label>';
                html += '<div class="d-flex justify-content-center flex-row">';
                    html += '<div class="input-group-prepend">';
                    html += '<div class="input-group-text"><i class="fas fa-map-pin"></i></div>';
                    html += '</div>';
                    html += '<input type="text" class="form-control" id="lat" placeholder="Latitud" data-toggle="tooltip" data-placement="top" title="Geocodificar" readonly>';
                html += '</div>';
            html += '</div>';
         html += '</div>';

        html += ' <div  class="col-md-3">';
            html += '<div class="form-group">';
            html += '<label for="longitud"> Longitud</label>';
                html += '<div class="d-flex justify-content-center flex-row">';
                    html += '<div class="input-group-prepend">';
                    html += '<div class="input-group-text"><i class="fas fa-map-pin"></i></div>';
                    html += '</div>';
                    html += '<input type="text" class="form-control" id="lng" placeholder="Longitud" data-toggle="tooltip" data-placement="top" title="Geocodificar" readonly>';
                html += '</div>';
            html += '</div>';
        html += '</div>';

        //boton para ubicar las direcciones

        html += ' <div class="col-md-3 align-self-center mt-3">';
            html +='<button id="geocoding" class="btn btn-success"><span class="spinner-border hiddenLoader loaderBtn" role="status"></span> <span class="txtGeocode"> Geocodificar </span> <i class="fas fa-map-marked-alt"></i></button>';
        html += '</div>';
    
    // fin row
    html +='</div>';
       

        html +='<div id="contentGeo"> </div>';

        //titulo horarios de atencion

     html += '<div  class="row my-2">';
        html += ' <div  class="col-md-4 ">';
        html +='<label  class="txtBlue">Horarios de atención</label>';
        html += '</div>';
     html += '</div>';
 

    //show customers_hours_service

    html += '<div  class="row">';
        html += ' <div  class="col-md-2">';
                    html += '<div class="d-flex justify-content-center flex-row ">';
                                html += '<div class="input-group-prepend">';
                                html += '<div class="input-group-text"><i class="far fa-clock"></i></div>';
                                html += '</div>';
                                    html += '<input type="time" class="form-control" id="hours_schedule_start" >';
                    html+='</div>';
            html+='</div>';

                html += ' <div  class="d-flex justify-content-center col-md-1">';
                        html += '<label class="align-items-center align-self-center"> Hasta</label>';
                html+='</div>';
    
        html += ' <div  class="col-md-2">';
                html += '<div class="d-flex justify-content-center flex-row ">';
                        html += '<div class="input-group-prepend">';
                        html += '<div class="input-group-text"><i class="far fa-clock"></i></div>';
                        html += '</div>';
                            html += '<input type="time" class="form-control"  id="hours_schedule_finish" >';
                html += '</div>';
            html += '</div>';

            //dias

            // html += '<div class="d-flex justify-content-center flex-row">';
                html += ' <div  class="col-md-3">';   
                        html += '<div class="form-group d-flex justify-content-center flex-row">';
                            html += '<div class="input-group-prepend">';
                            html += '<div class="input-group-text"><i class="far fa-clock"></i></div>';
                            html += '</div>';
                                    html += '<select class="form-control" id="start_day">';
                                            html += '<option value="0" >Seleccione día</option>';
                                            html += '<option value="Lunes" >Lunes</option>';
                                            html += '<option value="Martes" >Martes</option>';
                                            html += '<option value="Miercoles" >Miercoles</option>';
                                            html += '<option value="Jueves" >Jueves</option>';
                                            html += '<option value="Viernes" >Viernes</option>';
                                            html += '<option value="Sabado" >Sabado</option>';
                                            html += '<option value="Domingo" >Domingo</option>';
                                    html += '</select>';
                        html +='</div>';
                html +='</div>';

                html += ' <div  class="d-flex justify-content-center col-md-1">';
                        html += '<label class="align-items-center align-self-center"> Hasta</label>';
                html+='</div>';
            

            html += '<div  class="col-md-3">';
                        html += '<div class="form-group d-flex justify-content-center flex-row">';
                                html += '<div class="input-group-prepend">';
                                html += '<div class="input-group-text"><i class="far fa-clock"></i></div>';
                                html += '</div>';
                                    html += '<select class="form-control" id="finish_day">';
                                        html += '<option value="0" >Seleccione día</option>';
                                        html += '<option value="Lunes" >Lunes</option>';
                                        html += '<option value="Martes" >Martes</option>';
                                        html += '<option value="Miercoles" >Miercoles</option>';
                                        html += '<option value="Jueves" >Jueves</option>';
                                        html += '<option value="Viernes" >Viernes</option>';
                                        html += '<option value="Sabado" >Sabado</option>';
                                        html += '<option value="Domingo" >Domingo</option>';
                                    html += '</select>';
                        html += '</div>';
            html += '</div>';
    html += '</div>'; 

        //datos del codigo postal a cubrir/asignar/actualizar

        html += '<div  class="row my-2">';
        html += ' <div  class="col-md-5">';
                html += '<label  class="txtBlue">Datos de la zona a cubrir</label>';
        html += '</div>';
    html += ' </div>';

    html += '<div  class="row">';
        html += ' <div  class="col-md-3">';
            html += '<div class="form-group">';
            html += '<label  id="labelProvince" for="Provincia"> Provincia<span class="textUbication" style="color:#0093f5;font-size:15px;"><strong</strong></span></label>';
                html += '<div class="d-flex justify-content-center flex-row">';
                        html += '<div class="input-group-prepend">';
                        html += '<div class="input-group-text"><i class="fab fa-font-awesome-flag"></i></div>';
                        html += '</div>';
                        html += '<select  name="province_zone" class="form-control" id="province_zone">';
                        html += '</select>';
                html += '</div>';
            html += '</div>';
        html += '</div>';

    //choose localidad
    
    html += ' <div  class="col-md-3">';
        html += '<div class="form-group">';
        html += '<label id="labelLocalidad" for="localidad"> Localidad <span class="textUbication" style="color:#0093f5;font-size:15px;"><strong</strong></span></label>';
                html += '<div class="d-flex justify-content-center flex-row">';
                            html += '<div class="input-group-prepend">';
                            html += '<div class="input-group-text"><i class="fas fa-location-arrow"></i></div>';
                            html += '</div>';
                            html += '<select  name="locate_zone" class="form-control" id="locate_zone">';
                            html += '<option value="0"> Seleccione una localidad </option>';
                            html += '</select>';
                html += '</div>';
        html += '</div>';
    html += '</div>';

    html += ' <div  class="col-md-4">';
        html += '<div class="form-group ">';
            html += '<label for="codigo postal">Codigo postal</label>';
                    html += '<div class="d-flex justify-content-center flex-row">';
                            html += '<div class="input-group-prepend">';
                            html += '<div class="input-group-text"><i class="far fa-compass"></i></div>';
                            html += '</div>';
                            html += '<input class="form-control" id="postal_code_zone" placeholder="Ingrese codigo postal" readonly>';
                    html += '</div>';
            html += '</div>';
        html += '</div>';
        //fin row
    html += '</div>';
    // ---------------------------------------------------------

    //datos del operador 

    html += '<div  class="row my-2">';
        html += ' <div  class="col-md-5">';
                 html += '<label  class="txtBlue">Datos del operador asignado a esta zona</label>';
        html += '</div>';
    html += ' </div>';


    html += ' <div  class="row">';
        html += ' <div  class="col-md-3">';
            html += '<div class="form-group">';
                html += '<label for="operador"> Operador</label>';
                    html += '<div class="d-flex justify-content-center flex-row">';
                        html += '<div class="input-group-prepend">';
                        html += '<div class="input-group-text"><i class="fas fa-users"></i></div>';
                        html += '</div>';
                        html += '<input type="text" class="form-control" id="name" placeholder="Operador" readonly > ';
                    html += '</div>';
            html += '</div>';
        html += '</div>';

        html += ' <div  class="col-md-3">';
            html += '<div class="form-group">';
            html += '<label for="id"> identificacion</label>';
                html += '<div class="d-flex justify-content-center flex-row">';
                    html += '<div class="input-group-prepend">';
                    html += '<div class="input-group-text"><i class="fas fa-address-card"></i></div>';
                    html += '</div>';
                    html += '<input type="text" class="form-control" id="id_operator" placeholder="Identificación" data-toggle="tooltip" data-placement="top" title="Geolocalizar" readonly>';
                html += '</div>';
            html += '</div>';
        html += '</div>';


        html += ' <div  class="col-md-5 align-self-center mt-3">';
            html += '<button class="btn btn-success" id="assigned"> Asignar operador/a </button>';
        html += '</div>';

        html += ' <div  class="col-md-3 align-self-center mt-3">';
            html += '<div id="alert-toast" ></div>';
        html += '</div>';
        
    //fin row
    html += '</div>';


    //titulo rango de codigo postal a actualizar
    html += '<div  class="row my-2">';
        html += ' <div  class="col-md-8">';
            html += '<label  class="txtBlue">Rango del codigo postal a cubrir <span style="font-weight:400;" >(Realizara una busqueda entre el rango de los codigos postales ingresados)</span></label>';

        html += '</div>';
    html += '</div>';


    //choose codigo postal
    html += '<div class="row">';

        html +='<div class="col-md-3">';
            html +='<label> Inicio  codigo postal </label>';
                    html += '<div class="form-group d-flex justify-content-center flex-row">';
                        html += '<div class="input-group-prepend">';
                        html += '<div class="input-group-text"><i class="far fa-compass"></i></div>';
                        html += '</div>';
                        html += '<input type="number" class="form-control" id="postal_code_start" placeholder="Desde">';
                    html += '</div>';
        html +='</div>';


        html +='<div class="col-md-3">';
        html +='<label> Final  codigo postal </label>';
                    html += '<div class="form-group d-flex justify-content-center flex-row">';
                        html += '<div class="input-group-prepend">';
                        html += '<div class="input-group-text"><i class="far fa-compass"></i></div>';
                        html += '</div>';
                        html += '<input type="number" class="form-control"  id="postal_code_finish" placeholder="Hasta">';
                    html += '</div>';
        html += '</div>';

        html +='<div class="col-md-4 d-flex align-self-center mt-3">';
                        html += '<button id="examine" class="btn btn-primary"><span class="spinner-border hiddenLoader loaderBtn" role="status"></span> <span class="txtExamine"> Siguiente </span> <i class="fas fa-search"></i></button>';
        html += '</div>';
    
    // fin de row
    html += '</div>';

    //seleccion de codigos postales a actualizar
    html += '<div class="text-center" id="content_codes_selection" >';

    html += '</div>';


    return html;

}

function viewUpatedRangeToCommerce() {

    var html = "";


    //datos del comercio

    html += '<div  class="row my-2">';
        html += ' <div  class="col-md-5">';
                html += '<label  class="txtBlue">Datos del comercio</label>';
        html += '</div>';
    html += ' </div>';

    //choose comercio
    html += '<div class="row">';
        html +='<div class="col-md-4">';
            html += '<div class="form-group">';
            html += '<label  for="comercio"> Comercio</label>';
                html += '<div class="d-flex justify-content-center flex-row">';
                        html += '<div class="input-group-prepend">';
                        html += '<div class="input-group-text"><i class="fas fa-store-alt"></i></div>';
                        html += '</div>';
                            html += '<select class="form-control" name="id_user" id="id_user">';

                            html += '</select>';
                html += '</div>';
            html += '</div>';
        html +='</div>';

            //choose province

        html += ' <div  class="col-md-4">';
            html += '<div class="form-group">';
            html += '<label  id="labelProvince" for="Provincia"> Provincia<span class="textUbication" style="color:#0093f5;font-size:15px;"><strong</strong></span></label>';
                html += '<div class="d-flex justify-content-center flex-row">';
                        html += '<div class="input-group-prepend">';
                        html += '<div class="input-group-text"><i class="fab fa-font-awesome-flag"></i></div>';
                        html += '</div>';
                        html += '<input  name="province" class="form-control" id="province" >';
                html += '</div>';
            html += '</div>';
        html += '</div>';

    //choose localidad

        html += ' <div  class="col-md-4">';
            html += '<div class="form-group">';
            html += '<label id="labelLocalidad_range" for="localidad"> Localidad <span class="textUbication" style="color:#0093f5;font-size:15px;"><strong</strong></span></label>';
                    html += '<div class="d-flex justify-content-center flex-row">';
                                html += '<div class="input-group-prepend">';
                                html += '<div class="input-group-text"><i class="fas fa-location-arrow"></i></div>';
                                html += '</div>';
                                html += '<input  name="locate" class="form-control" id="locate" >';
                    html += '</div>';
            html += '</div>';
        html += '</div>';
    html += '</div>';
   
    //choose home_address

    html += '<div class="row">';

        html += '<div class="col-md-5">';
            html += '<div class="form-group">';
            html += '<label for="direccion"> Direccion</label>';
                html += '<div class="d-flex justify-content-center flex-row">';
                        html += '<div class="input-group-prepend">';
                        html += '<div class="input-group-text"><i class="fas fa-home"></i></div>';
                        html += '</div>';
                html += '<input type="text" class="form-control" id="home_address" placeholder="Dirección">';
                html += '</div>';
            html += '</div>';
        html += '</div>';

    // fini row
    html +='</div>';

    html +='<div class="row">';

        // lat long

        html += ' <div  class="col-md-3">';
        html += '<div class="form-group">';
        html += '<label for="latitud"> Latitud</label>';
            html += '<div class="d-flex justify-content-center flex-row">';
                html += '<div class="input-group-prepend">';
                html += '<div class="input-group-text"><i class="fas fa-map-pin"></i></div>';
                html += '</div>';
                html += '<input type="text" class="form-control" id="lat" placeholder="Latitud" data-toggle="tooltip" data-placement="top" title="Geocodificar" readonly>';
            html += '</div>';
        html += '</div>';
        html += '</div>';


        html += ' <div  class="col-md-3">';
        html += '<div class="form-group">';
        html += '<label for="longitud"> Longitud</label>';
            html += '<div class="d-flex justify-content-center flex-row">';
                html += '<div class="input-group-prepend">';
                html += '<div class="input-group-text"><i class="fas fa-map-pin"></i></div>';
                html += '</div>';
                html += '<input type="text" class="form-control" id="lng" placeholder="Longitud" data-toggle="tooltip" data-placement="top" title="Geocodificar" readonly>';
            html += '</div>';
        html += '</div>';
        html += '</div>';

        //boton para ubicar las direcciones

        html += ' <div class="col-md-3 align-self-center mt-3">';
            html +='<button id="geocoding" class="btn btn-success"><span class="spinner-border hiddenLoader loaderBtn" role="status"></span> <span class="txtGeocode"> Geocodificar </span> <i class="fas fa-map-marked-alt"></i></button>';
        html += '</div>';


    //fin de row 
    html += '</div>';



    html +='<div id="contentGeo"> </div>';
    
    //show customers_hours_service

        html += '<div class="row">';
            html +='<div class="col-md-6">';
                html += '<div class="form-group">';
                html += '<label  for="horario"> Horario de atención</label>';
                    html += '<div class="d-flex justify-content-center flex-row">';
                            html += '<div class="input-group-prepend">';
                            html += '<div class="input-group-text"><i class="fas fa-store-alt"></i></div>';
                            html += '</div>';
                                html += '<input class="form-control" name="customer_service_hours" id="customer_service_hours">';
                    html += '</div>';
                html += '</div>';
            html +='</div>';
        html +='</div>';


            //datos del codigo postal a cubrir/asignar/actualizar

    html += '<div  class="row my-2">';
            html += ' <div  class="col-md-5">';
                    html += '<label  class="txtBlue">Datos de la zona a cubrir</label>';
            html += '</div>';
        html += ' </div>';

        html += '<div  class="row">';
            html += ' <div  class="col-md-3">';
                html += '<div class="form-group">';
                html += '<label  id="labelProvince" for="Provincia"> Provincia<span class="textUbication" style="color:#0093f5;font-size:15px;"><strong</strong></span></label>';
                    html += '<div class="d-flex justify-content-center flex-row">';
                            html += '<div class="input-group-prepend">';
                            html += '<div class="input-group-text"><i class="fab fa-font-awesome-flag"></i></div>';
                            html += '</div>';
                            html += '<select  name="province_zone" class="form-control" id="province_zone">';
                            html += '</select>';
                    html += '</div>';
                html += '</div>';
            html += '</div>';

        //choose localidad
        
        html += ' <div  class="col-md-3">';
            html += '<div class="form-group">';
            html += '<label id="labelLocalidad" for="localidad"> Localidad <span class="textUbication" style="color:#0093f5;font-size:15px;"><strong</strong></span></label>';
                    html += '<div class="d-flex justify-content-center flex-row">';
                                html += '<div class="input-group-prepend">';
                                html += '<div class="input-group-text"><i class="fas fa-location-arrow"></i></div>';
                                html += '</div>';
                                html += '<select  name="locate_zone" class="form-control" id="locate_zone">';
                                html += '<option value="0"> Seleccione una localidad </option>';
                                html += '</select>';
                    html += '</div>';
            html += '</div>';
        html += '</div>';

        html += ' <div  class="col-md-4">';
            html += '<div class="form-group ">';
                html += '<label for="codigo postal">Codigo postal</label>';
                        html += '<div class="d-flex justify-content-center flex-row">';
                                html += '<div class="input-group-prepend">';
                                html += '<div class="input-group-text"><i class="far fa-compass"></i></div>';
                                html += '</div>';
                                html += '<input class="form-control" id="postal_code_zone" placeholder="Ingrese codigo postal" readonly>';
                        html += '</div>';
                html += '</div>';
            html += '</div>';
            //fin row
    html += '</div>';
        // ---------------------------------------------------------

        //datos del operador 

        html += '<div  class="row my-2">';
            html += ' <div  class="col-md-5">';
                    html += '<label  class="txtBlue">Datos del operador asignado a esta zona</label>';
            html += '</div>';
        html += ' </div>';


        html += ' <div  class="row">';

            html += ' <div  class="col-md-3">';
                html += '<div class="form-group">';
                    html += '<label for="operador"> Operador</label>';
                        html += '<div class="d-flex justify-content-center flex-row">';
                            html += '<div class="input-group-prepend">';
                            html += '<div class="input-group-text"><i class="fas fa-users"></i></div>';
                            html += '</div>';
                            html += '<input type="text" class="form-control" id="name" placeholder="Operador" readonly > ';
                        html += '</div>';
                html += '</div>';
            html += '</div>';

            html += ' <div  class="col-md-3">';
                html += '<div class="form-group">';
                html += '<label for="id"> identificacion</label>';
                    html += '<div class="d-flex justify-content-center flex-row">';
                        html += '<div class="input-group-prepend">';
                        html += '<div class="input-group-text"><i class="fas fa-address-card"></i></div>';
                        html += '</div>';
                        html += '<input type="text" class="form-control" id="id_operator" placeholder="Identificación" data-toggle="tooltip" data-placement="top" title="Geolocalizar" readonly>';
                    html += '</div>';
                html += '</div>';
            html += '</div>';


            html += ' <div  class="col-md-5 align-self-center mt-3">';
                html += '<button class="btn btn-success" id="assigned"> Asignar operador/a </button>';
            html += '</div>';

            html += ' <div  class="col-md-3 align-self-center mt-3">';
                html += '<div id="alert-toast" ></div>';
            html += '</div>';
            
        //fin row
        html += '</div>';

    //choose codigo postal

    html += '<div  class="row my-2">';
        html += ' <div  class="col-md-8">';
                html += '<label  class="txtBlue">Rango del codigo postal a cubrir <span style="font-weight:400;" >(Esto solo realizara una busqueda entre el rango)</span></label>';
        html += '</div>';
    html += ' </div>';

    html += '<div class="row">';

        html +='<div class="col-md-3">';
            html +='<label> Inicio  codigo postal </label>';
                    html += '<div class="form-group d-flex justify-content-center flex-row">';
                        html += '<div class="input-group-prepend">';
                        html += '<div class="input-group-text"><i class="far fa-compass"></i></div>';
                        html += '</div>';
                        html += '<input type="number" class="form-control" id="postal_code_start" placeholder="Desde">';
                    html += '</div>';
        html +='</div>';


        html +='<div class="col-md-3">';
        html +='<label> Final  codigo postal </label>';
                    html += '<div class="form-group d-flex justify-content-center flex-row">';
                        html += '<div class="input-group-prepend">';
                        html += '<div class="input-group-text"><i class="far fa-compass"></i></div>';
                        html += '</div>';
                        html += '<input type="number" class="form-control"  id="postal_code_finish" placeholder="Hasta">';
                    html += '</div>';
        html += '</div>';

        html +='<div class="col-md-4 d-flex align-self-center mt-3">';
                        html += '<button id="examine" class="btn btn-primary"><span class="spinner-border hiddenLoader loaderBtn" role="status"></span> <span class="txtExamine"> Siguiente </span> <i class="fas fa-search"></i></button>';
        html += '</div>';
    
    // fin de row
    html += '</div>';
    
    
    //seleccion de codigos si amerita
    html += '<div class="text-center" id="content_codes_selection" >';

    html += '</div>';




    return html;
}

function viewUpatedRangeToCollector() {

    var html = "";


    html += '<div  class="row my-2">';
        html += ' <div  class="col-md-5">';
                html += '<label  class="txtBlue">Datos del recolector</label>';
        html += '</div>';
    html += ' </div>';  

    //choose recolector
    html += '<div class="row">';
        html +='<div class="col-md-4">';
            html += '<div class="form-group">';
            html += '<label  for="recolector"> Recolector</label>';
                html += '<div class="d-flex justify-content-center flex-row">';
                        html += '<div class="input-group-prepend">';
                        html += '<div class="input-group-text"><i class="fas fa-store-alt"></i></div>';
                        html += '</div>';
                            html += '<select class="form-control" name="id_user" id="id_user">';

                            html += '</select>';
                html += '</div>';
            html += '</div>';
        html +='</div>';

        // fin row
    html +='</div>';


    //datos del codigo postal a cubrir/asignar/actualizar

    html += '<div  class="row my-2">';
            html += ' <div  class="col-md-5">';
                    html += '<label  class="txtBlue">Datos de la zona a cubrir</label>';
            html += '</div>';
        html += ' </div>';

        html += '<div  class="row">';
            html += ' <div  class="col-md-3">';
                html += '<div class="form-group">';
                html += '<label  id="labelProvince" for="Provincia"> Provincia<span class="textUbication" style="color:#0093f5;font-size:15px;"><strong</strong></span></label>';
                    html += '<div class="d-flex justify-content-center flex-row">';
                            html += '<div class="input-group-prepend">';
                            html += '<div class="input-group-text"><i class="fab fa-font-awesome-flag"></i></div>';
                            html += '</div>';
                            html += '<select  name="province" class="form-control" id="province_zone">';
                            html += '</select>';
                    html += '</div>';
                html += '</div>';
            html += '</div>';

        //choose localidad
        
        html += ' <div  class="col-md-3">';
            html += '<div class="form-group">';
            html += '<label id="labelLocalidad" for="localidad"> Localidad <span class="textUbication" style="color:#0093f5;font-size:15px;"><strong</strong></span></label>';
                    html += '<div class="d-flex justify-content-center flex-row">';
                                html += '<div class="input-group-prepend">';
                                html += '<div class="input-group-text"><i class="fas fa-location-arrow"></i></div>';
                                html += '</div>';
                                html += '<select  name="locate" class="form-control" id="locate_zone">';
                                html += '<option value="0"> Seleccione una localidad </option>';
                                html += '</select>';
                    html += '</div>';
            html += '</div>';
        html += '</div>';

        html += ' <div  class="col-md-4">';
            html += '<div class="form-group ">';
                html += '<label for="codigo postal">Codigo postal</label>';
                        html += '<div class="d-flex justify-content-center flex-row">';
                                html += '<div class="input-group-prepend">';
                                html += '<div class="input-group-text"><i class="far fa-compass"></i></div>';
                                html += '</div>';
                                html += '<input class="form-control" id="postal_code_zone" placeholder="Ingrese codigo postal" readonly>';
                        html += '</div>';
                html += '</div>';
            html += '</div>';
            //fin row
    html += '</div>';
        // ---------------------------------------------------------


    //datos del operador 

    html += '<div  class="row my-2">';
        html += ' <div  class="col-md-5">';
                html += '<label  class="txtBlue">Datos del operador asignado a esta zona</label>';
        html += '</div>';
    html += ' </div>';


    html += ' <div  class="row">';

        html += ' <div  class="col-md-3">';
            html += '<div class="form-group">';
                html += '<label for="operador"> Operador</label>';
                    html += '<div class="d-flex justify-content-center flex-row">';
                        html += '<div class="input-group-prepend">';
                        html += '<div class="input-group-text"><i class="fas fa-users"></i></div>';
                        html += '</div>';
                        html += '<input type="text" class="form-control" id="name" placeholder="Operador" readonly > ';
                    html += '</div>';
            html += '</div>';
        html += '</div>';

        html += ' <div  class="col-md-3">';
            html += '<div class="form-group">';
            html += '<label for="id"> identificacion</label>';
                html += '<div class="d-flex justify-content-center flex-row">';
                    html += '<div class="input-group-prepend">';
                    html += '<div class="input-group-text"><i class="fas fa-address-card"></i></div>';
                    html += '</div>';
                    html += '<input type="text" class="form-control" id="id_operator" placeholder="Identificación" data-toggle="tooltip" data-placement="top" title="Geolocalizar" readonly>';
                html += '</div>';
            html += '</div>';
        html += '</div>';


        html += ' <div  class="col-md-5 align-self-center mt-3">';
            html += '<button class="btn btn-success" id="assigned"> Asignar operador/a </button>';
        html += '</div>';

        html += ' <div  class="col-md-3 align-self-center mt-3">';
            html += '<div id="alert-toast" ></div>';
        html += '</div>';
        
    //fin row
    html += '</div>';


    html += '<div  class="row my-2">';
        html += ' <div  class="col-md-8">';
        html += '<label  class="txtBlue">Rango del codigo postal a cubrir <span style="font-weight:400;" >(Esto solo realizara una busqueda entre el rango)</span></label>';

        html += '</div>';
    html += ' </div>';


        //choose codigo postal
    html += '<div class="row">';

    html +='<div class="col-md-3">';
        html +='<label> Inicio  codigo postal </label>';
                html += '<div class="form-group d-flex justify-content-center flex-row">';
                    html += '<div class="input-group-prepend">';
                    html += '<div class="input-group-text"><i class="far fa-compass"></i></div>';
                    html += '</div>';
                    html += '<input type="number" class="form-control" id="postal_code_start" placeholder="Desde">';
                html += '</div>';
    html +='</div>';


    html +='<div class="col-md-3">';
    html +='<label> Final  codigo postal </label>';
                html += '<div class="form-group d-flex justify-content-center flex-row">';
                    html += '<div class="input-group-prepend">';
                    html += '<div class="input-group-text"><i class="far fa-compass"></i></div>';
                    html += '</div>';
                    html += '<input type="number" class="form-control"  id="postal_code_finish" placeholder="Hasta">';
                html += '</div>';
    html += '</div>';

    html +='<div class="col-md-4 d-flex align-self-center mt-3">';
                    html += '<button id="examine" class="btn btn-primary"><span class="spinner-border hiddenLoader loaderBtn" role="status"></span> <span class="txtExamine"> Siguiente </span> <i class="fas fa-search"></i></button>';
    html += '</div>';
    
    // fin de row
    html += '</div>';


    //seleccion de codigos si amerita
    html += '<div class="text-center" id="content_codes_selection" >';

    html += '</div>';

   


    return html;

}

function updateRange(object) {

    $.ajax({

        url: base_url + 'controllers/coberturaController.php?cobertura=update',
        type: 'POST',
        data: { object },
        beforeSend: function () {
            showLoader('#updateZipCodes', '.loaderBtn', '.txtCodeSelection');
        },
    }).done(function (response) {

        var objectResponse = JSON.parse(response);

        if (objectResponse[0].result === '1') {

            // resetear titulo
            $("#title-table").html('')

            var html = showAllAssigned(objectResponse);
            $("#contentTable").html(html);
            table();

            $("#modalAsignacion").modal('hide');
          
        }else if(objectResponse[0].result === '2'){
            hideLoader('#updateZipCodes','.loaderBtn','.txtCodeSelection','Ejecutar actualización de codigos postales');
            alertNegative('No se realizo correctamente la actualizacion de codigos postales');
        }else if(objectResponse[0].result === '3') {
            hideLoader('#updateZipCodes','.loaderBtn','.txtCodeSelection','Ejecutar actualización de codigos postales');
            alertNegative('No se pueden mostrar los cambios realizados');
        }
    })
}

