$(document).on('click','#update',function(){
    var html ="";

    $("#modalAsignacion").modal('show');
    $("#titleAssigned").text('Actualizar codigo postal');

    var td = this.parentElement;
    var id_to_update = $(td).attr('tdid');
    var id_country = $(td).attr('tdCountry');
    var postal_code = $(td).attr('tdPostal_code');
    var locate = $(td).attr('tdLocate');
    var type = $(td).attr('tdtype');
    var country = "";
  


    html = viewContentUpdate();
    $("#content-range").html(html);

    if(id_country == 1){
        country = 'Argentina';
    }else if(id_country == 2){
        country = 'Uruguay';
    }


    var text = country + ' ' + '-' + ' ' + locate + ' ' + '-' + ' ' + postal_code + ' ' + '-' + ' ' + type;
    
    $("#contentUpdate").text(text);
    $("#id_country").val(id_country);
    $("#id_to_update").val(id_to_update)
    $("#postal_code_zone").val(postal_code);


   
    
})

//check type
//aca defino el tipo de form que mostrare 

$(document).on('change','#type',function(){

    var id_country = $("#id_country").val();
    
    var type = $("#type").val();
    var flag = $("#flag").val();

    
    var html = '';

    if (type === '0') {

        $("#id_country").prop("selectedIndex", 0);
        alertNegative('Debes escoger el tipo');
        $("#content-point").html('')
        
        return false;

    }else if (id_country !== "0" && type === 'correo' && flag === 'update') {

        const object = {
            centinel: 'all',
            id_country,
            type
        }

        
        html = viewUpatedToCorreo();
        $("#content-point").html(html);
        getProvince(object);
      

    }else if (id_country !== "0" && type === 'terminal' && flag === 'update') {

        const object = {
            centinel: 'all',
            id_country,
            type
        }

       
        html = viewUpatedToTerminal();
        $("#content-point").html(html);
        getProvince(object);
    }else if (id_country !== "0" && type === 'comercio' && flag === 'update') {

        const object = {
            centinel: 'all',
            id_country,
            type
        }

        // para llenar el select de comercios
        getUsers(object);
        html = viewUpatedToCommerce();
        $("#content-point").html(html)

    }else if (id_country !== "0" && type === 'recolector' && flag === 'update') {

        const object = {
            centinel: 'all',
            id_country,
            type
        }

     
        // para llenar el select de comercios
        getUsers(object);
        html = viewUpatedToCollector();
        $("#content-point").html(html)

    }else if(id_country === '0' && type === '0') {
        
        $("#content-point").html('')
    }

})

$(document).on('click','#btnUpdate',function(){

    var type = $("#type").val();
    var object = '';
    var type_color= "";
    var country_color = "";
    var detailed_type = type;

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

    var convertIdToArray =  new Array();
    convertIdToArray.push($("#id_to_update").val());


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


        var customer_service_hours =  $("#start_day").val()+' '+'-'+' '+$("#finish_day").val()+ ' ' +$("#hours_schedule_start").val() +' '+'-'+' '+ $("#hours_schedule_finish").val() ;

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

           if (type === 'correo') {

            if(validateFieldUpdate() !== 'success'){
                alertNegative(validateFieldUpdate());
                return false;
            }

        var customer_service_hours =  $("#start_day").val()+' '+'-'+' '+$("#finish_day").val()+ ' ' +$("#hours_schedule_start").val() +' '+'-'+' '+ $("#hours_schedule_finish").val() ;
        type_color = 'warning';
        
        object = {

            id : convertIdToArray,  
            type:$("#type").val(), 
            id_user:'correo' , 
            name: 'correo',
            home_address : $("#home_address").val(),
            user_managent_id:$("#id_user_default").val(),
            customer_service_hours,
            lat: $("#lat").val(),
            lng: $("#lng").val(),
            id_operator: $("#id_operator").val(),
            detailed_type,
            country_color,
            type_color,
            created_at,
            action:'update'
        }

    } else if (type === 'terminal') {

        if(validateFieldUpdate() !== 'success'){
            alertNegative(validateFieldUpdate());
            return false;
        }

        var customer_service_hours =  $("#start_day").val()+' '+'-'+' '+$("#finish_day").val()+ ' ' +$("#hours_schedule_start").val() +' '+'-'+' '+ $("#hours_schedule_finish").val() ;
        type_color = 'danger';

        object = {

            id : convertIdToArray,  
            type:$("#type").val(), 
            id_user:'terminal' , 
            name: 'terminal',
            home_address : $("#home_address").val(),
            user_managent_id:$("#id_user_default").val(),
            customer_service_hours,
            lat: $("#lat").val(),
            lng: $("#lng").val(),
            id_operator: $("#id_operator").val(),
            detailed_type,
            country_color,
            type_color,
            created_at,
            action:'update'
        }
    } else if (type === 'comercio') {

        if(validateFieldUpdate() !== 'success'){
            alertNegative(validateFieldUpdate());
            return false;
        }

        if ($("#id_user").val() === '0' | $("#id_user").val() === '') {

            alertNegative('Debes seleccionar un '+type);
            return false;

        }

        type_color = 'primary';

        object = {

            id : convertIdToArray,  
            home_address : $("#home_address").val(), 
            type:$("#type").val(), 
            id_user:$("#id_user").val() , 
            name: $('select[name=id_user] option:selected').text(),
            user_managent_id:$("#id_user_default").val(),
            customer_service_hours: $("#customer_service_hours").val(),
            lat: $("#lat").val(),
            lng: $("#lng").val(),
            id_operator: $("#id_operator").val(),
            detailed_type:type,
            country_color,
            type_color,
            created_at,
            action:'update'
        }

    } else if (type === 'recolector') {

        if(validateFieldUpdate() !== 'success'){
            alertNegative(validateFieldUpdate());
            return false;
        }

        if ($("#id_user").val() === '0' | $("#id_user").val() === '') {

            alertNegative('Debes seleccionar un '+type);
            return false;

        }
        type_color = 'success';

            object = {

                id : convertIdToArray,  
                type:$("#type").val(), 
                id_user:$("#id_user").val() , 
                name: 'correo',
                user_managent_id:$("#id_user_default").val(),
                id_operator: $("#id_operator").val(),
                detailed_type:type,
                country_color,
                type_color,
                created_at,
                action:'update'
            }
        
    } 

    if($("#id_operator").val() === '' || $("#name").val() === ''){

        alertNegative('Debes asignar operador/a a la zona');
        return false;
    }

       
        askSomething('¿Estas seguro/a de actualizar este codigo postal?', 'Esta acción tomara los datos que has ingresado y reemplazara el registro que has seleccionado', 'info', 'Salir', 'Actualizar', 'update', object);

    
})

function validateFieldUpdate(){

    var messages = '';

    if($("#type").val()==='' || $("#type").val()==='0'){

        messages = 'Debes seleccionar el tipo';

    } else if($("#home_address").val() ===''){
        messages = 'Debes ingresar la dirección';
     
    }else if ($("#hours_schedule_start").val() === '') {
        messages = 'Debes ingresar el horario de apertura';
    
    }else if ($("#hours_schedule_finish").val() === '') {
        messages = 'Debes ingresar el horario de cierre';
        
    }else if ($("#start_day").val() === '0') {
        messages = 'Debes ingresar el dia inicial';
        
    }else if ($("#finish_day").val() === '0') {
        messages = 'Debes ingresar el dia final';
    }
    
    else if($("#id_to_update").val() ===''){
        messages = 'No se ha seleccionado un registro para actualizar | Vuelva a intentarlo';
    }else{
        
        messages = 'success';
    }

    return messages;

}

function viewContentUpdate() {

    var html = '';

    html = '<input id="flag" type="hidden" value="update">';

    html += '<input type="hidden" id="id_country" readonly>';

    html += '<input id="postal_code_zone" type="hidden" readonly>';

    //id que traigo del registro seleccionado para actualizarlo
    html += '<input type="hidden" id="id_to_update" readonly>';

 
    
    html += '<div class="container" >';
        html += '<div class="row mb-4">';
            html += '<div class="col-12 p-2 shadow rounded text-center identy">';
            html += '<span ><strong id="contentUpdate" ></strong> </span>';
            html += '</div>';
        html += '</div>';
    html += '</div>';

    html += '<div  class="row my-2">';
    html += ' <div  class="col-md-5">';
            html += '<label  class="txtBlue">Seleccione el tipo de recuperación para reemplazar el actual.</label>';
    html += '</div>';
html += ' </div>';

    html += '<div class="row">';
        html +='<div class="col-md-3">';
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
    html += '</div>';

    //type of point 

    html += '<div id="content-point" >';

    html += '</div>';

    return html;

}

function viewUpatedToCorreo(){
   
    var html = "";


    //titulo horarios de atencion

    html += '<div  class="row my-2">';
        html += ' <div  class="col-md-4 ">';
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

        html +='<div class="row" >';
  
            html += ' <div  class="col-md-4">';
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


            //boton para ubicar las direcciones

            html += ' <div class="col-md-3 align-self-center mt-3">';
                html +='<button id="geocoding" class="btn btn-success"><span class="spinner-border hiddenLoader loaderBtn" role="status"></span> <span class="txtGeocode"> Geocodificar </span> <i class="fas fa-map-marked-alt"></i></button>';
            html += '</div>';
         //fin row 
        html += '</div>';


         // lat long

    html +='<div class="row" >';
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

        //fin row 
    html += '</div>';

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

        
    //Datos del operador

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


    html += '<div class="row">';
      html += '<div class="d-flex justify-content-center col-12 ">';
            html += '<button id="btnUpdate" class="btn btn-success col-12"> <span class="spinner-border hiddenLoader loaderBtn" role="status"></span> <span class="txtCreate"> Actualizar </span> <i class="fas fa-plus"></i></button>';
      html += '</div>';
    html += '</div>';


    return html;
}

function viewUpatedToTerminal(){
   
    var html = "";

    html += '<div  class="row my-2">';
        html += ' <div  class="col-md-5">';
                html += '<label  class="txtBlue">Ubicación de la terminal</label>';
        html += '</div>';
    html += ' </div>';

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

        html +='<div class="row" >';
  
            html += ' <div  class="col-md-4">';
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


            //boton para ubicar las direcciones

            html += ' <div class="col-md-3 align-self-center mt-3">';
                html +='<button id="geocoding" class="btn btn-success"><span class="spinner-border hiddenLoader loaderBtn" role="status"></span> <span class="txtGeocode"> Geocodificar </span> <i class="fas fa-map-marked-alt"></i></button>';
            html += '</div>';
         //fin row 
        html += '</div>';


         // lat long

    html +='<div class="row" >';
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

        //fin row 
    html += '</div>';

    html +='<div id="contentGeo"> </div>';

    html += '<div  class="row my-2">';
        html += ' <div  class="col-md-5">';
                html += '<label  class="txtBlue">Horarios de atención</label>';
        html += '</div>';
    html += ' </div>';


    //show customers_hours_service

    html += '<div  class="row">';
        html += ' <div  class="col-md-5">';
                 html += '<label> Horarios de atencion</label>';
        html += '</div>';

        html += ' <div  class="col-md-6">';
                 html += '<label> Días de atención</label>';
        html += '</div>';
    html += ' </div>';

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
            // fin row
    html += '</div>';    

    //Datos del operador

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


    html += '<div class="row">';
      html += '<div class="d-flex justify-content-center col-12 ">';
            html += '<button id="btnUpdate" class="btn btn-success col-12"> <span class="spinner-border hiddenLoader loaderBtn" role="status"></span> <span class="txtCreate"> Actualizar </span> <i class="fas fa-plus"></i></button>';
      html += '</div>';
    html += '</div>';


    return html;
}

function viewUpatedToCommerce() {

    var html = "";


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
                            html += '<input  name="province" class="form-control" id="province" placeholder="Escoge el comercio" readonly>';
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
                                    html += '<input  name="locate" class="form-control" id="locate" readonly >';
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

        html += '<div class="row">';
        html += '<div class="col-12 d-flex justify-content-center">';
                html += '<button id="btnUpdate" class="btn btn-success col-12"> <span class="spinner-border hiddenLoader loaderBtn" role="status"></span> <span class="txtCreate"> Actualizar </span> <i class="fas fa-plus"></i></button>';
        html += '</div>';
        html += '</div>';



    return html;
}

function viewUpatedToCollector() {

    var html = "";

    //choose recolector
  
    html += '<div class="row">';
        html +='<div class="col-md-6">';
            html += '<div class="form-group">';
                html += '<label  for="recolector"> Recolector</label>';
                html += '<div class="d-flex justify-content-center flex-row">';
                        html += '<div class="input-group-prepend">';
                        html += '<div class="input-group-text"><i class="fas fa-truck"></i></div>';
                        html += '</div>';
                            html += '<select class="form-control" name="id_user" id="id_user">';
                            html += '</select>';
                html += '</div>';
            html += '</div>';
        html +='</div>';
    html +='</div>';

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

    html += '<div class="row">';
      html += '<div class="d-flex justify-content-center col-12">';
            html += '<button id="btnUpdate" class="btn btn-success col-12"> <span class="spinner-border hiddenLoader loaderBtn" role="status"></span> <span class="txtCreate"> Actualizar </span> <i class="fas fa-plus"></i></button>';
      html += '</div>';
    html += '</div>';


    return html;
}

function update(object) {

    $.ajax({

        url: base_url + 'controllers/coberturaController.php?cobertura=update',
        type: 'POST',
        data: { object },
        beforeSend: function () {
            showLoader('#btnUpdate', '.loaderBtn', '.txtActualizar');
        },
    }).done(function (response) {

        hideLoader('#btnUpdate','.loaderBtn','.txtActualizar','Actualizar');

        var objectResponse = JSON.parse(response);


       
        if (objectResponse[0].result === '1') {

             if(object.action === 'update'){

                // resetear titulo
                $("#title-table").html("")
                
                var html = showAllAssigned(objectResponse);
                $("#contentTable").html(html);
                table();

                alertPositive('Realizado correctamente');
                $("#modalAsignacion").modal('hide');

            }

        } else {
            alertNegative('No se realizo correctamente la actualizacion de codigos postales');
        }
    })
}
