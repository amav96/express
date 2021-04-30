$(document).on('click','#create',function(){
    var template ="";

     $("#modalAsignacion").modal('show');
     $("#titleAssigned").text('Crear nuevo codigo postal');
     template = viewCreate();
     $("#content-range").html(template);
    
 })

$(document).on('change','#id_country',function(){


    var id_country = $("#id_country").val();
    var type = $("#type").val();
    var flag = $("#flag").val();

    var html = '';

    if (type === '0') {


        $("#id_country").prop("selectedIndex", 0);
        alertNegative('Debes escoger el tipo');
        return false;

          }   else if (id_country !== "0" && $("#type").val() === 'comercio' && flag==='create') {

                const objectTypePoint = {
                    centinel: 'all',
                    id_country,
                    type
                }
                // para llenar el select de comercios
                getUsers(objectTypePoint);
                html = viewCreateToCommerce();
        
                $("#content-point").html(html);
                // $("#btnCreate").prop('disabled', true);
        
                const object = {
                    id_country: $("#id_country").val(),
                }
                getProvince(object);

            } else if (id_country !== "0" && $("#type").val() === 'correo' && flag==='create') {
        
                html = viewCreateToCorreo();
        
                $("#content-point").html(html);
                //  $("#btnCreate").prop('disabled', true);
                
                const object = {
                    id_country: $("#id_country").val(),
                }
                getProvince(object);
        
            } else if (id_country !== "0" && $("#type").val() === 'terminal' && flag==='create') {
        
                html = viewCreateToTerminal();
        
                $("#content-point").html(html)
                //  $("#btnCreate").prop('disabled', true);
        
                const object = {
                    id_country: $("#id_country").val(),
                }
                getProvince(object);
        
            } else if (id_country !== "0" && $("#type").val() === 'recolector' && flag==='create') {
        
                const objectTypePoint = {
                    centinel: 'all',
                    id_country,
                    type
                }
                getUsers(objectTypePoint);
                html = viewCreateToCollector();
        
                $("#content-point").html(html);
                // $("#btnCreate").prop('disabled', true);
        
                const object = {
                    id_country: $("#id_country").val(),
                }
                getProvince(object);
        
            }else if(id_country == '0' && $("#type").val()=== '0') {

                $("#content-point").html('')
               
            }
    
 })

 $(document).on('click','#btnCreate',function(){

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
    
     if(validateFieldCreate() !== 'success'){
        alertNegative(validateFieldCreate());
        return false;

    }else if(validateCoverageByCp() === 'selectFail'){

        alertNegative('Debes seleccionar al menos un codigo postal');

        setTimeout(function(){
            $('#modalAsignacion').animate({
                scrollTop: 0
            }, 1000);

        },3000)

        return false;
    }else if(validateCoverageByCp() === 'selectAndInputFail'){

        alertNegative('Debes ingresar al menos un codigo postal');

        setTimeout(function(){
            $('#modalAsignacion').animate({
                scrollTop: 0
            }, 1000);
    
        },3000)
    
        return false;
    }

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

      if(type === 'correo'){

        var customer_service_hours =  $("#start_day").val()+' '+'-'+' '+$("#finish_day").val()+ ' ' +$("#hours_schedule_start").val() +' '+'-'+' '+ $("#hours_schedule_finish").val() ;

        type_color = 'warning';
          object = {
 
            id_country: $("#id_country").val(),
            locate: $('select[name=locate] option:selected').text(),
            province:$('select[name=province] option:selected').text(),
            home_address:$("#home_address").val(),
            type, 
            id_user:'correo' , 
            name: 'correo',
            user_managent_id:$("#id_user_default").val(),
            customer_service_hours,
            postal_code : validateCoverageByCp(),
            lat: $("#lat").val(),
            lng: $("#lng").val(),
            id_operator: $("#id_operator").val(),
            detailed_type,
            country_color,
            type_color,
            created_at,
            action:'create'
        }

       
    } else if(type === 'terminal'){

        var customer_service_hours =  $("#start_day").val()+' '+'-'+' '+$("#finish_day").val()+ ' ' +$("#hours_schedule_start").val() +' '+'-'+' '+ $("#hours_schedule_finish").val() ;

        type_color = 'danger';

          object = {

            id_country: $("#id_country").val(),
            locate: $('select[name=locate] option:selected').text(),
            province:$('select[name=province] option:selected').text(),
            home_address:$("#home_address").val(),
            type, 
            id_user:'terminal' , 
            name: 'terminal',
            user_managent_id:$("#id_user_default").val(),
            customer_service_hours,
            postal_code : validateCoverageByCp(),
            lat: $("#lat").val(),
            lng: $("#lng").val(),
            id_operator: $("#id_operator").val(),
            detailed_type,
            country_color,
            type_color,
            created_at,
            action:'create'
        }


    } else if(type === 'comercio'){

        var customer_service_hours = $("#customer_service_hours").val();

         if($("#id_user").val() ==='' || $("#id_user").val()==='0'){

            alertNegative('Debes seleccionar el comercio');
    
            return false;
    
        }
        type_color = 'primary';
       
          object = {

            id_country: $("#id_country").val(),
            locate: $('select[name=locate] option:selected').text(),
            province:$('select[name=province] option:selected').text(),
            home_address : $("#home_address").val(), 
            type, 
            id_user:$("#id_user").val() , 
            name: $('select[name=id_user] option:selected').text(),
            user_managent_id:$("#id_user_default").val(),
            customer_service_hours,
            postal_code :validateCoverageByCp(),
            lat: $("#lat").val(),
            lng: $("#lng").val(),
            id_operator: $("#id_operator").val(),
            detailed_type:type,
            country_color,
            type_color,
            created_at,
            action:'create'
        }


    } else if(type === 'recolector'){

        if($("#id_user").val() ==='' || $("#id_user").val()==='0'){

            alertNegative('Debes seleccionar el recolector');
    
            return false;
    
        }
        type_color = 'success';
          object = {

            id_country: $("#id_country").val(),
            locate: $('select[name=locate] option:selected').text(),
            province:$('select[name=province] option:selected').text(),
            type, 
            id_user:$("#id_user").val() , 
            name: $('select[name=id_user] option:selected').text(),
            user_managent_id:$("#id_user_default").val(),
            postal_code : validateCoverageByCp(),
            id_operator: $("#id_operator").val(),
            detailed_type:type,
            country_color,
            type_color,
            created_at,
            action:'create'
        }

    }

    
    if($("#id_operator").val() === '' || $("#name").val() === ''){

        alertNegative('Debes asignar operador/a a la zona');
        return false;
    }

    askSomething('¿Estas seguro/a de crear este codigo postal?', 'Esta acción tomara los datos que has ingresado y creara uno registro nuevo', 'info', 'Salir', 'Crear', 'create', object);


 })


function validateFieldCreate(){

    var success= '';

    if($("#type").val()==='' || $("#type").val()==='0'){
        
        $("#btnCreate").prop('disabled', true);
        success ='Debes seleccionar el tipo';

    } if($("#id_country").val()==='' || $("#id_country").val()==='0'){

        $("#btnCreate").prop('disabled', true);
        success ='Debes seleccionar el pais';
      
    }else if($("#home_address").val() ===''){

        $("#btnCreate").prop('disabled', true);
        success ='Debes ingresar la direccion del ' + $("#type").val();
    }else if ($("#hours_schedule_start").val() === '') {

        $("#btnCreate").prop('disabled', true);
        success ='Debes ingresar el horario de apertura';
  
    }else if ($("#hours_schedule_finish").val() === '') {

        $("#btnCreate").prop('disabled', true);
        success ='Debes ingresar el horario de cierre';

    }else if ($("#start_day").val() === '0') {

        $("#btnCreate").prop('disabled', true);
        success ='Debes ingresar el dia inicial';

    }else if ($("#finish_day").val() === '0') {

        $("#btnCreate").prop('disabled', true);
        success ='Debes ingresar el dia final';

    }else if($("#postal_code").val() ===''){

        $("#btnCreate").prop('disabled', true);
        success ='Debes ingresar el codigo postal a crear';

    }else {
        success = 'success';
    }

    return success;

}

function viewCreate(){
    var html = '';

    html = '<input id="flag" type="hidden" value="create">';

    html += '<div  class="row">';
        html += ' <div  class="col-md-6">';
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
        html += '</div>';
   
    //pais 


    html += ' <div  class="col-md-6">';
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
    html += '</div>';  

    html += '</div>'; 
    //type of point 

    html += '<div id="content-point" >';

    html += '</div>';
    return html;

}

function viewCreateToCorreo(){
   
    var html = "";

     //titulo datos del cp

    html += '<div  class="row">';
        html += ' <div  class="col-md-4 ">';
          html +='<label  class="txtBlue">Datos del codigo postal a crear</label>';
        html += '</div>';
    html += '</div>';


    //choose province

    html += '<div  class="row">';
        html += ' <div  class="col-md-4">';
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
    
        html += ' <div  class="col-md-4">';
            html += '<div class="form-group">';
            html += '<label id="labelLocalidad" for="localidad"> Localidad <span class="textUbication" style="color:#0093f5;font-size:15px;"><strong</strong></span></label>';
                    html += '<div class="d-flex justify-content-center flex-row">';
                                html += '<div class="input-group-prepend">';
                                html += '<div class="input-group-text"><i class="fas fa-location-arrow"></i></div>';
                                html += '</div>';
                                html += '<select id="locate" name="locate" class="form-control" >';
                                html += '<option value="0"> Seleccione una localidad </option>';
                                html += '</select>';
                    html += '</div>';
        html += '</div>';
        html += '</div>';
        //codigo postal 

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
    html += '</div>';

     //cobertura total de codigos postales

    
        html += ' <div id="content_postal_code" ></div>';
       
    //titulo ubicacion del point

        html += '<div  class="row">';
            html += ' <div  class="col-md-4">';
            html +='<label  class="txtBlue">Ubicación del correo</label>';
            html += '</div>';
        html += '</div>';

    //choose home_address
    html += ' <div  class="row">';
        html += ' <div  class="col-md-6">';
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

        html += '<div class="col-md-4 align-self-center mt-3">';
                html +='<button id="geocoding" class="btn btn-success"><span class="spinner-border hiddenLoader loaderBtn" role="status"></span> <span class="txtGeocode"> Geocodificar </span> <i class="fas fa-map-marked-alt"></i></button>';
        html += '</div>';
    
    //fin row
    html += '</div>';
    

    //contenedor del geolocalizador
      html +='<div id="contentGeo">';
      html += '</div>';
    

    //show customers_hours_service

    html += '<div  class="row my-4">';
        html += ' <div  class="col-md-5">';
                 html += '<label class="txtBlue p-1 rounded" > Horarios de atencion</label>';
        html += '</div>';
    html += ' </div>';

    html += '<div  class="row">';
            html +='<div  class="col-md-4">';
                    html += '<div class="d-flex justify-content-center flex-row ">';
                                html += '<div class="input-group-prepend">';
                                html += '<div class="input-group-text"><i class="far fa-clock"></i></div>';
                                html += '</div>';
                                    html += '<input type="time" class="form-control" id="hours_schedule_start" >';
                    html+=  '</div>';
            html +='</div>';

                html +=' <div  class="d-flex justify-content-center col-md-1">';
                        html += '<label class="align-items-center align-self-center"> Hasta</label>';
                html +='</div>';
    
            html += ' <div  class="col-md-4">';
                html += '<div class="d-flex justify-content-center flex-row ">';
                        html += '<div class="input-group-prepend">';
                        html += '<div class="input-group-text"><i class="far fa-clock"></i></div>';
                        html += '</div>';
                            html += '<input type="time" class="form-control"  id="hours_schedule_finish" >';
                html += '</div>';
            html += '</div>';

    //fin row        
    html += '</div>';

            //dias

    html += '<div  class="row my-4">';
        html += ' <div  class="col-md-4">';
            html += '<label class="txtBlue p-1 rounded" > Días de atención</label>';
        html += '</div>';
    html += ' </div>';

            // html += '<div class="d-flex justify-content-center flex-row">';
    html += '<div  class="row">';
                html += ' <div  class="col-md-4">';   
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

                html +=' <div  class="d-flex justify-content-center col-md-1">';
                        html += '<label class="align-items-center align-self-center"> Hasta</label>';
                html +='</div>';
            

                html += '<div  class="col-md-4">';
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
        //fin de row    
     html += '</div>';  


  //datos del operador 

    html += '<div  class="row my-4">';
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
                    html += '<input type="text" class="form-control" id="id_operator" placeholder="Identificación" title="Geolocalizar" readonly>';
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
  

    html += '<div class="row my-2 d-flex justify-content-center">';
      html += '<div class="col-6">';
            html += '<button id="btnCreate"  class="btn btn-success col-12"  title="Este boton se activará al hacer clic en [ Asignar operador/a ] "> <span class="spinner-border hiddenLoader loaderBtn" role="status"></span> <span class="txtCreate"> Crear </span> <i class="fas fa-plus"></i></button>';
      html += '</div>';
    html += '</div>';


    return html;
}

function viewCreateToTerminal(){
   
    var html = "";


     //titulo datos del cp

    html += '<div  class="row">';
        html += ' <div  class="col-md-4">';
          html +='<label class="txtBlue p-1 rounded">Datos del codigo postal a crear</label>';
        html += '</div>';
    html += '</div>';

    //choose province

    html += '<div  class="row">';
        html += ' <div  class="col-md-4">';
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
    
        html += ' <div  class="col-md-4">';
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

      //codigo postal 

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


    //cobertura total de codigos postales
    html += ' <div id="content_postal_code" ></div>';

      //titulo ubicacion del point

    html += '<div  class="row">';
        html += ' <div  class="col-md-4">';
          html +='<label class="txtBlue p-1 rounded" >Ubicación de la terminal</strong></label>';
        html += '</div>';
    html += '</div>';

    //choose home_address
    html += ' <div  class="row">';
        html += ' <div  class="col-md-3">';
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

        //latitud

        html += ' <div  class="col-md-3">';
            html += '<div class="form-group">';
            html += '<label for="latitud"> Latitud</label>';
                html += '<div class="d-flex justify-content-center flex-row">';
                    html += '<div class="input-group-prepend">';
                    html += '<div class="input-group-text"><i class="fas fa-map-pin"></i></div>';
                    html += '</div>';
                    html += '<input type="text" class="form-control" id="lat" placeholder="Latitud" data-toggle="tooltip" data-placement="top" title="Geolocalizar" readonly> ';
                html += '</div>';
            html += '</div>';
        html += '</div>';

        //longitud

        html += ' <div  class="col-md-3">';
            html += '<div class="form-group">';
            html += '<label for="longitud"> longitud</label>';
                html += '<div class="d-flex justify-content-center flex-row">';
                    html += '<div class="input-group-prepend">';
                    html += '<div class="input-group-text"><i class="fas fa-map-pin"></i></div>';
                    html += '</div>';
                    html += '<input type="text" class="form-control" id="lng" placeholder="Longitud" data-toggle="tooltip" data-placement="top" title="Geolocalizar" readonly>';
                html += '</div>';
            html += '</div>';
        html += '</div>';

         //fin de row
     html += '</div>';

        //boton para ubicar las direcciones

        html += ' <div  class="row">';
          
                html += '<div class="col-md-4 align-self-center mt-3">';
                        html +='<button id="geocoding" class="btn btn-success"><span class="spinner-border hiddenLoader loaderBtn" role="status"></span> <span class="txtGeocode"> Geocodificar </span> <i class="fas fa-map-marked-alt"></i></button>';
                html += '</div>';
           
        //fin row
        html += '</div>';

       

    //contenedor del geolocalizador
    html +='<div id="contentGeo">';
    html += '</div>';
    

    //show customers_hours_service

    html += '<div  class="row my-4">';
        html += ' <div  class="col-md-5">';
                 html += '<label class="txtBlue p-1 rounded" > Horarios de atencion</label>';
        html += '</div>';
    html += ' </div>';

    html += '<div  class="row">';
            html +='<div  class="col-md-4">';
                    html += '<div class="d-flex justify-content-center flex-row ">';
                                html += '<div class="input-group-prepend">';
                                html += '<div class="input-group-text"><i class="far fa-clock"></i></div>';
                                html += '</div>';
                                    html += '<input type="time" class="form-control" id="hours_schedule_start" >';
                    html+=  '</div>';
            html +='</div>';

                html +=' <div  class="d-flex justify-content-center col-md-1">';
                        html += '<label class="align-items-center align-self-center"> Hasta</label>';
                html +='</div>';
    
            html += ' <div  class="col-md-4">';
                html += '<div class="d-flex justify-content-center flex-row ">';
                        html += '<div class="input-group-prepend">';
                        html += '<div class="input-group-text"><i class="far fa-clock"></i></div>';
                        html += '</div>';
                            html += '<input type="time" class="form-control"  id="hours_schedule_finish" >';
                html += '</div>';
            html += '</div>';

    //fin row        
    html += '</div>';

            //dias

    html += '<div  class="row my-4">';
        html += ' <div  class="col-md-4">';
            html += '<label class="txtBlue p-1 rounded" > Días de atención</label>';
        html += '</div>';
    html += ' </div>';

            // html += '<div class="d-flex justify-content-center flex-row">';
    html += '<div  class="row">';
                html += ' <div  class="col-md-4">';   
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

                html +=' <div  class="d-flex justify-content-center col-md-1">';
                        html += '<label class="align-items-center align-self-center"> Hasta</label>';
                html +='</div>';
            

                html += '<div  class="col-md-4">';
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
        //fin de row    
     html += '</div>';  
    
    
    //datos del operador 

    html += '<div  class="row my-2">';
        html += ' <div  class="col-md-5">';
                 html += '<label  class="txtBlue"><strong>Datos del operador asignado a esta zona</strong></label>';
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
            html += '<button class="btn btn-success" id="assigned"> Asignar operador/a</button>';
        html += '</div>';

        html += ' <div  class="col-md-3 align-self-center mt-3">';
            html += '<div id="alert-toast" ></div>';
        html += '</div>';
        
    //fin row
    html += '</div>';

  
    html += '<div class="row my-2 d-flex justify-content-center">';
    html += '<div class="col-6">';
          html += '<button id="btnCreate"  class="btn btn-success col-12" data-toggle="tooltip" data-placement="top" title="Este boton se activará al hacer clic en [ Asignar operador/a ] "> <span class="spinner-border hiddenLoader loaderBtn" role="status"></span> <span class="txtCreate"> Crear </span> <i class="fas fa-plus"></i></button>';
    html += '</div>';
  html += '</div>';


    return html;
}

function viewCreateToCommerce() {

    var html = "";

    //titulo datos del cp

    html += '<div  class="row">';
        html += ' <div  class="col-md-4">';
          html +='<label class="txtBlue p-1 rounded">Datos del codigo postal a crear</label>';
        html += '</div>';
    html += '</div>';


    //choose province

    html += '<div  class="row">';
    html += ' <div  class="col-md-4">';
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
    

    html += ' <div  class="col-md-4">';
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

    //codigo postal 

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

        //fin de div 
    html += '</div>';

    //titulo ubicacion del point

    html += '<div  class="row">';
        html += ' <div  class="col-md-4">';
          html +='<label class="txtBlue p-1 rounded" >Ubicación del comercio</label>';
        html += '</div>';
    html += '</div>';

    //choose comercio

    html += '<div  class="row">';
        html += '<div  class="col-md-4">';
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
        html += '</div>';

        //localidad del comercio

        html += ' <div  class="col-md-4">';
        html += '<div class="form-group">';
        html += '<label for="localidad"> localidad</label>';
            html += '<div class="d-flex justify-content-center flex-row">';
                html += '<div class="input-group-prepend">';
                html += '<div class="input-group-text"><i class="fas fa-map-pin"></i></div>';
                html += '</div>';
                html += '<input type="text" class="form-control" id="locate_user" placeholder="Localidad" data-toggle="tooltip" data-placement="top" readonly> ';
            html += '</div>';
        html += '</div>';
        html += '</div>';

        
    //choose home_address del comercio
   
        html += ' <div  class="col-md-4">';
            html += '<div class="form-group">';
            html += '<label for="direccion"> Direccion</label>';
                html += '<div class="d-flex justify-content-center flex-row">';
                    html += '<div class="input-group-prepend">';
                    html += '<div class="input-group-text"><i class="fas fa-home"></i></div>';
                    html += '</div>';
                    html += '<input type="text" class="form-control" id="home_address" placeholder="Dirección" readonly>';
                html += '</div>';
            html += '</div>';
        html += '</div>';

        //fin row
    html += '</div>';

     //cobertura total de codigos postales

     html += ' <div id="content_postal_code" ></div>';

         //latitud
    html += '<div  class="row">';
        html += ' <div  class="col-md-3">';
            html += '<div class="form-group">';
            html += '<label for="latitud"> Latitud</label>';
                html += '<div class="d-flex justify-content-center flex-row">';
                    html += '<div class="input-group-prepend">';
                    html += '<div class="input-group-text"><i class="fas fa-map-pin"></i></div>';
                    html += '</div>';
                    html += '<input type="text" class="form-control" id="lat" placeholder="Latitud" data-toggle="tooltip" data-placement="top" title="Geolocalizar" readonly> ';
                html += '</div>';
            html += '</div>';
        html += '</div>';

        //longitud

        html += ' <div  class="col-md-3">';
            html += '<div class="form-group">';
            html += '<label for="longitud"> longitud</label>';
                html += '<div class="d-flex justify-content-center flex-row">';
                    html += '<div class="input-group-prepend">';
                    html += '<div class="input-group-text"><i class="fas fa-map-pin"></i></div>';
                    html += '</div>';
                    html += '<input type="text" class="form-control" id="lng" placeholder="Longitud" data-toggle="tooltip" data-placement="top" title="Geolocalizar" readonly>';
                html += '</div>';
            html += '</div>';
        html += '</div>';

         //boton para ubicar las direcciones

         html += '<div class="col-md-3 align-self-center mt-3">';
            html +='<button id="geocoding" class="btn btn-success"><span class="spinner-border hiddenLoader loaderBtn" role="status"></span> <span class="txtGeocode"> Geocodificar </span> <i class="fas fa-map-marked-alt"></i></button>';
         html += '</div>';

    //fin row
    html += '</div>';




    //contenedor del geolocalizador
    html +='<div id="contentGeo">';
    html += '</div>';

    //show customers_hours_service

    html += '<div  class="row my-2">';
        html += ' <div  class="col-md-5">';
                 html += '<label class="txtBlue p-1 rounded" > Horarios de atencion</label>';
        html += '</div>';
    html += ' </div>';


    html += '<div  class="row">';
        html += ' <div  class="col-md-4">';
                    html += '<div class="d-flex justify-content-center flex-row ">';
                                html += '<div class="input-group-prepend">';
                                html += '<div class="input-group-text"><i class="far fa-clock"></i></div>';
                                html += '</div>';
                                    html += '<input type="text" class="form-control" id="customer_service_hours" placeholder="Horario de atención" >';
                    html+='</div>';
        html+='</div>';
            //fin de row
    html += '</div>';    

     //datos del operador 

     html += '<div  class="row my-3">';
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
            html += '<button class="btn btn-success" id="assigned"> Asignar operador/a</button>';
        html += '</div>';

        html += ' <div  class="col-md-3 align-self-center mt-3">';
            html += '<div id="alert-toast" ></div>';
        html += '</div>';
        
    //fin row
    html += '</div>';

    html += '<div class="row my-2 d-flex justify-content-center">';
      html += '<div class="col-6">';
            html += '<button id="btnCreate"  class="btn btn-success col-12" data-toggle="tooltip" data-placement="top" title="Este boton se activará al hacer clic en [ Asignar operador/a ] "> <span class="spinner-border hiddenLoader loaderBtn" role="status"></span> <span class="txtCreate"> Crear </span> <i class="fas fa-plus"></i></button>';
      html += '</div>';
    html += '</div>';



    return html;
}

function viewCreateToCollector() {

    var html = "";

      //titulo datos del cp

    html += '<div  class="row">';
        html += ' <div  class="col-md-4">';
          html +='<label class="txtBlue p-1 rounded">Datos del codigo postal a crear</label>';
        html += '</div>';
    html += '</div>';


    //choose province

    html += '<div  class="row">';
        html += ' <div  class="col-md-4">';
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
    
    html += '<div class="col-md-4">';
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
    
      //codigo postal 

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
        //fin de row
    html += '</div>';

    //cobertura total de codigos postales
    html += ' <div id="content_postal_code" ></div>';

    //choose recolector
    html += '<div class="row">';
        html += ' <div  class="col-md-4">';
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
        html += '</div>';
        //fin de row
    html += '</div>';

    //datos del operador 

    html += '<div  class="row my-2">';
        html += ' <div  class="col-md-5">';
                 html += '<label  class="txtBlue"><strong>Datos del operador asignado a esta zona</strong></label>';
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
            html += '<button class="btn btn-success" id="assigned"> Asignar operador/a</button>';
        html += '</div>';

        html += ' <div  class="col-md-3 align-self-center mt-3">';
            html += '<div id="alert-toast" ></div>';
        html += '</div>';
        
    //fin row
    html += '</div>';

    html += '<div class="row my-2 d-flex justify-content-center">';
    html += '<div class="col-6">';
          html += '<button id="btnCreate"  class="btn btn-success col-12" data-toggle="tooltip" data-placement="top" title="Este boton se activará al hacer clic en [ Asignar operador/a ] "> <span class="spinner-border hiddenLoader loaderBtn" role="status"></span> <span class="txtCreate"> Crear </span> <i class="fas fa-plus"></i></button>';
    html += '</div>';
  html += '</div>';


    return html;
}

function validateCoverageByCp(){


    var count = 0;
    var countSelect = 0;
    var id_province = $("#province").val();
    var flag = $("#flag").val();

    // por defecto tomara el input postal_code
    var arrayCodeSelect = new Array();
    arrayCodeSelect.push($("#postal_code").val());

    // si es province 1 se divide en muchos codigos postales y
    // elejimos que codigos postales cubriremos 
    
    if (id_province === '1' && flag === 'create'){
    //    quito el ultimo CP del array porque puede haber mas de un CP y lo voy a seleccionar
        arrayCodeSelect.pop();

        $("input[name=input-cp-coverage]").each(function () {

            count = $("input[name=input-cp-coverage]").length;
                
                if($(this).is(":checked")){
                arrayCodeSelect.push($(this).val());
                
                }else{
                    countSelect++;
                }
        });
        
         // agrego lo que hay en los inputs creados dinamicamente si no estan vacios

        if($('.newInputsCp').is(":visible")){

            $(".newInputsCp").each(function () {

                if($(this).val() !== ''){
                    arrayCodeSelect.push($(this).val());
                }
            });
        }
               
    }
    // si la cantidad de los check es igual a la cantidad que no esta seleccionada y no esta visible los inputs para agregar nuevos codigos, es decir: no hay valor que retornar
     if(count === countSelect && id_province === '1' && !$('.newInputsCp').is(":visible")){
        
        arrayCodeSelect ='selectFail';

    }

    // si la cantidad de los check es igual a la cantidad que no esta seleccionada y esta visible los inputs para agregar nuevos codigos y estan vacios los inputs , es decir: no hay valor que retornar
     if(count === countSelect && id_province === '1' && $('.newInputsCp').is(":visible") && $(".newInputsCp").val() === '' ){

        arrayCodeSelect ='selectAndInputFail';
    } 
    
    return arrayCodeSelect;
  
}

function create(object){

    $.ajax({
 
         url: base_url + 'controllers/coberturaController.php?cobertura=save',
         type: 'POST',
         data: { object },
         beforeSend: function () {
             showLoader('#btnCreate', '.loaderBtn', '.txtCreate');
         },
     }).done(function (response) {
 
         hideLoader('#btnCreate','.loaderBtn','.txtCreate','Crear');
        
         var objectResponse = JSON.parse(response);
        
         if (objectResponse[0].result === '1') {

                // resetear titulo
                $("#title-table").html("")
             
                var html = showAllAssigned(objectResponse);
                 $("#contentTable").html(html);
                 table();

                 alertPositive('Realizado correctamente');
                 $("#modalAsignacion").modal('hide');

         } else {
             alertNegative('No se creo correctamente');
             return false;
         }
     })
 }






