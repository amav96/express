
//show assignation
$(document).on('click','#AllAssigned',function(){

    getAssigned();
})

$(document).on('click','#history',function(){
  getHistoricalInactive();
})

// reactivar un punto del historico
$(document).on('click','#active',function(){

  var td = this.parentElement;
  var id_country = $(td).attr('tdCountry');
  var locate = $(td).attr('tdLocate');
  var province = $(td).attr('tdProvince');
  var home_address = $(td).attr('tdHome_address');
  var type = $(td).attr('tdType');
  var id_user = $(td).attr('tdId_user');
  var name = $(td).attr('tdNameDetalle');
  var user_managent_id = $("#id_user_default").val();
  var customer_service_hours = $(td).attr('tdCustomer_service_hours');
  var postal_code = $(td).attr('tdPostal_code');
  var lat = $(td).attr('tdLat');
  var lng = $(td).attr('tdLng');
  var id_operator = $(td).attr('tdId_operator');
  var detailed_type = $(td).attr('tdDetailed_type');
  var country_color = $(td).attr('tdCountry_color');
  var type_color = $(td).attr('tdType_color');
  var id = $(td).attr('tdId');
 
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

  const object = {
      id_country ,
      locate ,
      province ,
      home_address ,
      type ,
      id_user ,
      name ,
      user_managent_id ,
      customer_service_hours ,
      postal_code ,
      lat ,
      lng ,
      id_operator,
      detailed_type ,
      country_color ,
      type_color ,
      id ,
      created_at,
  }

  askSomething('¿Estas seguro?','Entrara nuevamente en el area de cobertura','success','Cancelar','Si','activate',object)

 
})

$(document).on('submit','#form_search_range',function(e){
  e.preventDefault();

  if($("#country").val() === '0'){
    alertNegative('Debes escoger un pais');
    return false;
  }

  var postal_code = $("#code_start").val();
  var postal_code_range = $("#code_finish").val();
  var id_country = $("#country").val();

  const objectSearchRange = {
    postal_code,
    postal_code_range,
    id_country,
    action:'getRange'
  }

  
  searchZipCodes(objectSearchRange);

})

//check country
//aca defino el tipo de form que mostrare
$(document).on('change', '#id_country', function () {

  var id_country = $("#id_country").val();
  var type = $("#type").val();

    if (type === '0') {

        $("#id_country").prop("selectedIndex", 0);
        alertNegative('Debes escoger el tipo');
        return false;
      
    }else if(id_country === '0'){

      alertNegative('Debes escoger el pais');
        return false;

    }
  

     if(id_country == '0' && $("#type").val()=== '0'){

        
          $("#content-point").html('');
    
      }
    


})

$(document).on('change','#province',function(){

    id_province = $("#province").val();
    id_country = $("#id_country").val();

    const objectProvince = {
        id_province,
        id_country
    }

    getLocate(objectProvince);

})

$(document).on('change','#province_zone',function(){

  id_province = $("#province_zone").val();
  id_country = $("#id_country").val();

  const objectProvince = {
      id_province,
      id_country
  }

  getLocateZone(objectProvince);

})

//este se encarga de asignar datos en campos al escoger el id comercio/recolector

$(document).on('change', '#id_user', function () {

  var province = $('#id_user option:selected').attr('province');
  var locate = $('#id_user option:selected').attr('locate');
  var home_address = $('#id_user option:selected').attr('home_address');
  var customer_service_hours = $('#id_user option:selected').attr('customer_service_hours');
  var postal_code = $('#id_user option:selected').attr('postal_code');
  var id_country = $("#id_country").val();
  var type = $("#type").val();
  var flag = $("#flag").val();

   if(flag === 'create' && type=== 'comercio'){

    $("#home_address").val(home_address);
    $("#locate_user").val(locate);
    $("#customer_service_hours").val(customer_service_hours);

  }else if (flag === 'updateRange' || flag === 'update' ){

    console.log("llego hasta aca");

    if(type=== 'comercio' || type=== 'recolector'){
      console.log("y hasta aca");

      $("#province").val(province)
      $("#home_address").val(home_address);
      $("#locate").val(locate);
      $("#customer_service_hours").val(customer_service_hours);

    }

  }

 


})

//asignar zona
$(document).on('click','#assigned',function(e){

  e.preventDefault();

  var postal_code =  $("#postal_code").val();
  var id_country = $("#id_country").val();
  var type = $("#type").val();
  var flag = $("#flag").val();

      if(flag === 'update' || flag === 'updateRange'){

        postal_code = $("#postal_code_zone").val();

      }

      if(id_country === '' || id_country ==='0'){

          alertNegative('El país es obligatorio para asignar operador/a');
          return false;

      }else if(postal_code === '' || postal_code === '0'){

          alertNegative('El codigo postal es obligatorio para asignar operador/a');
          return false;

      }else if(postal_code.length < 4){

        alertNegative('El codigo postal ingresado esta incompleto');
        return false;
      }
      else{

        // si se actualiza el codigo postal, el cp de referencia es el cp que se quiere actualizar
          
       

        const object = {
          id_country,
          postal_code
        }

      

      getOperators(object);

      }
})

//habilitar postal code para agregar un cp nuevo que no este en la lista
//escoger codigos postales que pertenecen a una localidad/barrio

$(document).on('change','#locate',function(){

  
  var type = $("#type").val();
  var flag = $("#flag").val();
  var nameLocate = $('select[name=locate] option:selected').text();
  var id_province = $("#province").val();
  var id_country = $("#id_country").val();
 
  if(id_province === '0'){

      alertNegative('Debes seleccionar provincia');

  }else{

      if (id_province === '1' && flag === 'create'){

         $("#postal_code").attr("readonly", false); 

         //asigno codigo postal cuando escogo la localidad (BIS)
         $("#postal_code").val($("#locate").val());
        
        const object = {
          id_province,
          id_country,
          locate: nameLocate,
          type
        }
        
          getAllCpByZone(object);

      }else{

        $("#content_postal_code").html('');
        $("#contentGeo").html('');
        resetUsually();

        //asigno codigo postal cuando escogo la localidad (BIS)
        $("#postal_code").val($("#locate").val());
        $("#postal_code").attr("readonly", true); 

      }
  }
})

// para asignar operador a zona en update range
$(document).on('change','#locate_zone',function(){

  var id_province = $("#province_zone").val();


  if(id_province === '0'){

      alertNegative('Debes seleccionar provincia');

  }else{

        //asigno codigo postal cuando escogo la localidad (BIS)
        $("#postal_code_zone").val($("#locate_zone").val());
        $("#postal_code_zone").attr("readonly", true); 

      }
  
})

// seleccionar todos los codigos postales de cada localidad dividida
$(document).on('click','#select-cp',function(){

     if(!$("input[name=input-cp-coverage]").is(":checked")){
       
      $("input[name=input-cp-coverage]").prop('checked',true);
      $("#text-select-all-cp").html('Deshacer seleccionado')

     }else{

      $("#text-select-all-cp").html('Seleccionar todo')
      $("input[name=input-cp-coverage]").prop('checked',false);

     }

})

// agregar inputs para agregar codigos postales 
$(document).on('click','#add-cp',function(e){
  
  var html= newInputByCP();
  $("#content-input-cp").append(html);
  
})

// eliminar inputs creados

$(document).on('click','#remove-cp',function(e){
  
  this.parentElement.remove()
  
})

$(document).on('click','#google-maps',function(){

   var than = $(this)
  
    var lat = than.attr("lat")
    var lng = than.attr("lng")

    var coordinates = lat+','+lng;
 
     url = "https://google.com.sa/maps/search/"+ coordinates;

     window.open(url, '_blank');

})

function newInputByCP(){
  var html='';
   html+='<div class="col-md-3 d-flex flex-row align-content-center align-self-center my-2">';
    html+='<input  class="form-control mx-2 newInputsCp"  placeholder="Codigo postal">';
      html+='<button id="remove-cp" class="btn btn-danger" ><i class="far fa-trash-alt"></i></button>';
   html+='</div>';
   
  return html;
}

function getAssigned(object){

    $.ajax({
    url: base_url + 'controllers/coberturaController.php?cobertura=AllAssigned',
    type:'POST',
    data:{object},
    beforeSend:function(){
      //arreglar algo aqui que no se esconde el texto del boton 
         showLoader('#AllAssigned','.loaderBtn','.txtAllAssigned');
    },
    }).done(function(response){
        hideLoader('#AllAssigned','.loaderBtn','.txtAllAssigned','Mostrar área de cobertura');
        
        
        $("#title-table").html("<div class='title-table d-flex justify-content-center align-item-center align-content-center shadow m-4 rounded p-2'>Activos</div>")
        $("#title-table").css("color", "rgb(49, 183, 35)")
        var objectResponse = JSON.parse(response);
        var template = showAllAssigned(objectResponse);
           $("#contentTable").html(template)
            table();
          
    })
}

function showAllAssigned(objectResponse){

  
      var html="";
      html +='<table class="table table-striped table-bordered" cellspacing="0" width="100%" id="example">';
      html += " <thead>";
          html += "<tr>";
              
              html += "<th >Codigo Postal</th>";
              html += "<th>Localidad</th>";
              html += "<th>Tipo</th>";
              html += "<th>Dirección</th>";
              html += "<th>Provincia</th>";
              html += "<th></th>";
              html += "<th>Pais</th>";
              html += "<th>Detalle</th>";
              // html += "<th>Ubicación </th>";
              html += "<th>Ubicación </th>";
              html += "<th>Atención</th>";
              html += "<th>Operador</th>";
              html += "<th>Latitud</th>";
              html += "<th>Longitud</th>";
             
              
              
          html += " </tr>";
      html += "</thead>";
      html += "<tbody>";

    objectResponse.forEach((val) => {

              html += "<tr>";

              html+="<td class='alert alert-"+val.country_color+"' ><strong>"+val.postal_code+"</strong></td>";
              html+="<td>"+val.locate+"</td>";

              if(val.detailed_type !== null && val.detailed_type !== undefined && val.detailed_type !== ''){
                html+="<td class='alert alert-"+val.type_color+"'><strong>"+val.detailed_type+"</strong></td>";
              }else{
                html+="<td class='alert alert-"+val.type_color+"'></td>";
              }
            
              html+="<td >"+val.home_address+"</td>";
              html+="<td >"+val.province+"</td>";
              html+="<td tdId='"+val.id+"' tdPostal_code='"+val.postal_code+"' tdType='"+val.type+"' tdCountry='"+val.id_country+"'  tdLocate='"+val.locate+"'  ><button class='m-2 btn btn-sm btn-primary' id='update' > <i class='fas fa-edit'></i></button><button class='m-2 btn btn-sm btn-danger' id='delete' > <i class='far fa-trash-alt'></i></button></td>";

            // td pais 
          
              html+="<td class='alert alert-"+val.country_color+"'><strong>"+val.name_country+"</strong></td>";
            
              html+="<td >"+val.name+"</td>";

               if(val.lat !== '' && val.lat !== undefined && val.lat !== null && val.lng !== '' && val.lng !== undefined && val.lng !== null ){

              html+='<td class="d-flex justify-content-center aling-content-center aling-item-center"><button id="google-maps" lat='+val.lat+'  lng='+val.lng+' class="btn btn-danger" > Google Maps </button></td>';

               }else{
                html+='<td ></td>';
               }


             
              if(val.customer_service_hours === '' ||  val.customer_service_hours === '0' || val.customer_service_hours !== null){
                html+="<td >"+val.customer_service_hours+"</td>";
              }else{
                html+="<td > s/r </td>";
              }
          
              //operador
              val.operator_name === null 
              ? html+="<td ></td>"
              :html+="<td >"+val.operator_name+"</td>";
          
          
               //cordenadas
          
               val.lat === null 
               ? html+="<td ></td>"
               :html+="<td >"+val.lat+"</td>";
          
               val.lng === null 
               ? html+="<td ></td>"
               :html+="<td >"+val.lng+"</td>";
               
              
    });

    html += "</tbody>";
    html += "</table>";

    // Do the normal stuff for this function


    return html;

   

    

}

function showHistory(objectResponse){

  
  var html="";
  html +='<table class="table table-striped table-bordered" cellspacing="0" width="100%" id="example">';
  html += " <thead>";
      html += "<tr>";
          
          html += "<th >Codigo Postal</th>";
          html += "<th>Localidad</th>";
          html += "<th>Tipo</th>";
          html += "<th>Dirección</th>";
          html += "<th>Provincia</th>";
          html += "<th></th>";
          html += "<th>Pais</th>";
          html += "<th>Motivo</th>";
          html += "<th>Nombre</th>";
          html += "<th>Atención</th>";
          html += "<th>Operador</th>";
          html += "<th>Latitud</th>";
          html += "<th>Longitud</th>";
          html += "<th>Fecha baja</th>";
          
      html += " </tr>";
  html += "</thead>";
  html += "<tbody>";

objectResponse.forEach((val) => {

          html += "<tr>";

          html+="<td class='alert alert-"+val.country_color+"' ><strong>"+val.postal_code+"</strong></td>";
          html+="<td>"+val.locate+"</td>";
          html+="<td class='alert alert-"+val.type_color+"'><strong>"+val.detailed_type+"</strong></td>";
          html+="<td >"+val.home_address+"</td>";
          html+="<td >"+val.province+"</td>";
           html+="<td tdId='"+val.id+"' tdPostal_code='"+val.postal_code+"' tdType='"+val.type+"' tdCountry='"+val.id_country+"'  tdLocate='"+val.locate+"' tdHome_address='"+val.home_address+"' tdProvince='"+val.province+"' tdNameDetalle='"+val.name+"' tdCustomer_service_hours='"+val.customer_service_hours+"' tdId_operator='"+val.id_operator+"' tdLat='"+val.lat+"' tdLng='"+val.lng+"' tdDetailed_type='"+val.detailed_type+"' tdCountry_color='"+val.country_color+"' tdType_color='"+val.type_color+"' tdId_user='"+val.id_user+"'  '><button class='m-2 btn btn-sm btn-success' id='active' > <i class='fas fa-user-check'></i></button></td>";

      
        // td pais 
      
          html+="<td class='alert alert-"+val.country_color+"'><strong>"+val.name_country+"</strong></td>";
          html+="<td><strong>"+val.motive+"</strong></td>";
        
          html+="<td >"+val.name+"</td>";
        
          if(val.customer_service_hours === '' ||  val.customer_service_hours === '0' || val.customer_service_hours !== null){
            html+="<td >"+val.customer_service_hours+"</td>";
          }else{
            html+="<td > s/r </td>";
          }
      
          //operador
          val.operator_name === null 
          ? html+="<td ></td>"
          :html+="<td >"+val.operator_name+"</td>";
      
      
           //cordenadas
      
           val.lat === null 
           ? html+="<td ></td>"
           :html+="<td >"+val.lat+"</td>";
      
           val.lng === null 
           ? html+="<td ></td>"
           :html+="<td >"+val.lng+"</td>";
           html+="<td >"+val.updated_at+"</td>";

});

html += "</tbody>";
html += "</table>";

// Do the normal stuff for this function


return html;

}

function getHistoricalInactive(){
  $.ajax({
  url: base_url + 'controllers/coberturaController.php?cobertura=HistoricalInactive',
  beforeSend:function(){
 showLoader('#history','.loaderBtn','.txtHistory');
  },
  }).done(function(response){
    hideLoader('#history','.loaderBtn','.txtHistory','Histórico Inactivo');
    var objectResponse = JSON.parse(response);

    if(objectResponse[0].result === '1'){

      // $("#title-table").html("Inactivos")
    $("#title-table").html("<div class='title-table d-flex justify-content-center align-item-center align-content-center shadow m-4 rounded p-2'>Histórico / Bajas / Inactivos</div>")
    $("#title-table").css("color", "rgb(240, 50, 50)")
    var template = showHistory(objectResponse);
       $("#contentTable").html(template)
        table();


    }else{
              alertNegative('No hay histórico disponible');
              return false;
            }
    
    
  })
}

function activateAgain(object){

  $.ajax({
  url:base_url + 'controllers/coberturaController.php?cobertura=activateAgain',
  type:'POST',
  data:{object},
  beforeSend:function(){},
  }).done(function(response){
    var objectResponse = JSON.parse(response);
    if(objectResponse[0].result === '1'){

      $("#title-table").html("<div class='title-table d-flex justify-content-center align-item-center align-content-center shadow m-4 rounded p-2'>Activos</div>")
      $("#title-table").css("color", "rgb(49, 183, 35)")
      alertPositive("Realizado correctamente");
      var template = showAllAssigned(objectResponse);
      $("#contentTable").html(template)
      table();
      
    }else if(objectResponse[0].result === '4'){

      alertNegative("No es posible la acción porque ya existe algún registro en esta ubicación");
      return false;

    }
    else {
      alertNegative("No se puede mostrar los datos creados correctamente");
      return false;
    }
  })
}

//helpers  
function getUsers(object){

  
  $.ajax({
    url: base_url + 'controllers/coberturaController.php?cobertura=getUsers',
    type:'POST',
    data:{object},
    beforeSend:function(){
  
    },
    }).done(function(response){

      var objectResponse = JSON.parse(response);

       if(objectResponse[0].result !== '2'){
      var template = "";
      template +=`<option value="0" >Seleccione Usuario</option> `;

      objectResponse.forEach((val)=>{
 
         if(object.type === 'comercio'){

          template += `
          <option postal_code="${val.postal_code}" customer_service_hours="${val.customer_service_hours}" home_address='${val.home_address}' province='${val.province}' locate='${val.location}' value="${val.id}" > ${val.name} | ${val.name_alternative} | ${val.location}</option>
          `;
         }else if(object.type === 'recolector'){

          template += `
          <option postal_code="${val.postal_code}" customer_service_hours="${val.customer_service_hours}" home_address='${val.home_address}' province='${val.province}' locate='${val.location}' value="${val.id}" > ${val.name} | ${val.location}</option>
          `;

         }
         
      })

    $("#id_user").html(template);

   }else{
          alertNegative('No hay personal disponible para esta zona');
          $("#content-point").html('');

   }


    })

}

function getOneUser(object){

  $.ajax({
    url: base_url + 'controllers/coberturaController.php?cobertura=getUsers',
    type:'POST',
    data:{object},
    beforeSend:function(){
    
    },
    }).done(function(response){
     

      var objectResponse = JSON.parse(response);
      if(objectResponse[0].role === 'comercio'){
        $("#customer_service_hours").val(objectResponse[0].customer_service_hours);
        $("#home_address").val(objectResponse[0].home_address);

      }

    })
}

function getOperators(object){

  $.ajax({
  url:base_url + 'controllers/coberturaController.php?cobertura=getOperators',
  type:'POST',
  data:{object},
  beforeSend:function(){},
  }).done(function(response){
    var responseObject =  JSON.parse(response);

    if(responseObject[0].result === '1'){

        responseObject.forEach((val)=>{

         $("#name").val(val.name);
         $("#id_operator").val(val.id);

         toastr.success('Operador/a asignado/a',{
            'progressBar': true
          });

          //desbloquear boton crear

          $("#btnCreate").prop('disabled', false);
    
        })

        if($("#name").attr('readonly',false) || $("#id_operator").attr('readonly',false)){

          $("#name").attr('readonly',true);
          $("#id_operator").attr('readonly',true);
  
         }

    }else{

         $("#name").attr('readonly',false);
         $("#id_operator").attr('readonly',false);

          alertNegative('No encontramos operador/a para esta zona. Asignelo manualmente');
          return false;
    }

   

  })

//  var identification
//  var name
 
}

function searchZipCodes(object){


  //from validateBeforeSendCommerce
  //from validateBeforeSendCorreo
  //from #form_search_range
  $.ajax({
  url: base_url + 'controllers/coberturaController.php?cobertura=searchCodes',
  type:'POST',
  data:{object},
  beforeSend:function(){
   if(object.action === 'beforeUpdate'){showLoader('#examine','.loaderBtn','.txtExamine');
  }else if(object.action === 'getRange'){showLoader('#searchRangeCode','.loaderBtn','.txtRangeCode');}
  },
  }).done(function(response){

    //escondo loader
    object.action === 'getRange' 
    ?hideLoader('#searchRangeCode','.loaderBtn','.txtRangeCode','Buscar')
    :object.action === 'beforeUpdate'
    ?hideLoader('#examine','.loaderBtn','.txtExamine','Buscar rango de codigos postales')
    :true;
      
      var objectResponse = JSON.parse(response);
      
      if(objectResponse[0].result === '1'){

          if(object.action === 'beforeUpdate'){
             var templateSelectCode =""; 
              
              templateSelectCode = codesSelection(objectResponse);
              $("#content_codes_selection").html(templateSelectCode);

          }else if(object.action === 'getRange'){

            var templateGetRange ="";  
                templateGetRange= showAllAssigned(objectResponse);
                 $("#contentTable").html(templateGetRange)
                 table();

          }else if (object.action === 'updateRange'){

              hideLoader('#updateZipCodes','.loaderBtn','.txtCodeSelection','Ejecutar actualización de codigos postales');
              alertPositive('Codigos actualizados correctamente');
              $("#modalAsignacion").modal("hide");
            var templateGetRange ="";  
            templateGetRange= showAllAssigned(objectResponse);
             $("#contentTable").html(templateGetRange)
             table();

          }



      }else {

        if(object.action === 'beforeUpdate'){
          
            alertNegative('No hay codigos postales en este rango');
            return false;

        }else if (object.action === 'getRange'){

          alertNegative('No hay codigos postales en este rango');
          return false;

        }else if(object.action === 'updateRange'){

          alertNegative('No hay codigos postales en este rango');
          return false;

        }
         
      }
     
  })
}

function searchOneCode(object){


    $.ajax({
    url:base_url + 'controllers/coberturaController.php?cobertura=searchOneCode',
    type:'POST',
    data:{object},
    beforeSend:function(){},
    }).done(function(response){
    var objectResponse =  JSON.parse(response);
    var html ="";

  
    if(objectResponse[0].result === '1'){

      html = showAllAssigned(objectResponse);
      $("#contentTable").html(html);
      table();

    }else{
      alertNegative('Hubo un inconveniente al listar los cambios recientes');
      return
    }
    })

}

function getProvince(object){

  $.ajax({
  url: base_url + 'controllers/coberturaController.php?cobertura=getProvince',
  type:'POST',
  data: {object},
  beforeSend:function(){
  $("#labelProvince .textUbication").html(' Cargando...')    
  },
  }).done(function(response){
  $("#labelProvince .textUbication").html('')    
     var objectResponse =  JSON.parse(response);
     var template = "";

     if(objectResponse[0].result === '1'){
     template = showProvince(objectResponse);
     $("#province").html(template);

    }else{
     
      alertNegative('No existe provincia');
    }
  })

}

function showProvince(object){

var html = "";
html+='<option value="0">Seleccione provincia</option>';
object.forEach((val)=>{

  html+='<option value="'+val.id+'" >'+val.province+'</option>';

})

return html;

}

function getProvinceZone(object){

  $.ajax({
  url: base_url + 'controllers/coberturaController.php?cobertura=getProvince',
  type:'POST',
  data: {object},
  beforeSend:function(){
  $("#labelProvince .textUbication").html(' Cargando...')    
  },
  }).done(function(response){
  $("#labelProvince .textUbication").html('')    
     var objectResponse =  JSON.parse(response);
     var template = "";

     if(objectResponse[0].result === '1'){
     template = showProvinceZone(objectResponse);
     $("#province_zone").html(template);

    }else{
     
      alertNegative('No existe provincia');
    }
  })

}

function showProvinceZone(object){

var html = "";
html+='<option value="0">Seleccione provincia</option>';
object.forEach((val)=>{

  html+='<option value="'+val.id+'" >'+val.province+'</option>';

})

return html;

}

function getLocate(object){


   $.ajax({
     url: base_url + 'controllers/coberturaController.php?cobertura=getLocate',
     type:'POST',
     data: {object},
     beforeSend:function(){
      $("#labelLocalidad .textUbication").html(' Cargando...')    
     },
     }).done(function(response){
      $("#labelLocalidad .textUbication").html('')    
     var objectResponse =  JSON.parse(response);
    
        if(objectResponse[0].result === '1'){
     
         var template = "";

         template = showLocate(objectResponse);
           $("#locate").html(template);

         }else{
           
          template+=`<option value="0" >Seleccione localidad</option>`;
          $("#locate").html(template);
  
           }
        
     })

}

function showLocate(object){

var html = "";

html+='<option value="0" >Seleccione localidad</option>';

object.forEach((val)=>{
html+='<option value="'+val.postal_code+'" >'+val.locate+'</option>';
})

return html;

}

function getLocateZone(object){


  $.ajax({
    url: base_url + 'controllers/coberturaController.php?cobertura=getLocate',
    type:'POST',
    data: {object},
    beforeSend:function(){
     $("#labelLocalidad .textUbication").html(' Cargando...')    
    },
    }).done(function(response){
     $("#labelLocalidad .textUbication").html('')    
    var objectResponse =  JSON.parse(response);
   
       if(objectResponse[0].result === '1'){
    
        var template = "";

        template = showLocate(objectResponse);
          $("#locate_zone").html(template);

        }else{
          
         template+=`<option value="0" >Seleccione localidad</option>`;
         $("#locate").html(template);
 
          }
       
    })

}

function showLocateZone(object){

var html = "";

html+='<option value="0" >Seleccione localidad</option>';

object.forEach((val)=>{
html+='<option value="'+val.postal_code+'" >'+val.locate+'</option>';
})

return html;

}

function getAllCpByZone(object){

  $.ajax({
  url: base_url + 'controllers/coberturaController.php?cobertura=getAllCpByZone',
  type:'POST',
  data: {object},
  beforeSend:function(){},
  }).done(function(response){
    var objectResponse = JSON.parse(response);
    var html;

      if(objectResponse[0].result === '1'){

        if(object.type !== 'recolector'){
          html = showAllCpByZone(objectResponse);
        }else{
          html = showAllCpByZoneCollector(objectResponse);
        }
    
    $("#content_postal_code").html(html);

        }else{
          alertNegative('Ocurrio un problema al mostrar los registros creados');
        }
  })

}

function showAllCpByZone(object){

  var html = '';

  html +='<div class="shadow rounded p-2 my-3" >';
      html +='<div class="row d-flex justify-content-center flex-column m-2 " >';

        html +='<div class="d-flex flex-row mb-3 align-items-center" >';
          html += '<span class="textBlack mx-2" >Por favor, seleccione los codigos postales que quiere abarcar.</span>';
          html += '<button id="select-cp" class="btn btn-sm btn-dark"><span id="text-select-all-cp" >Seleccionar todos</span> <i class="fas fa-object-group"></i></button>';
        html +='</div>';

          html += '<div class="d-flex  flex-row flex-wrap align-items-center" >';
            object.forEach((val) => {
              html += '<div class="col-md-3 ">';
                html += '<div  class="alert alert-primary d-flex justify-content-center align-items-center">';
                  html +='<input class="input-cp-coverage" name="input-cp-coverage" type="checkbox" value="'+val.postal_code+'"><span>'+val.postal_code+'</span>';
                html += '</div>';
              html += '</div>';
                  })
                
          html +='</div>';
      html +='</div>'

      html += '<div class="row d-flex flex-row flex-wrap m-2" id="content-input-cp" >';
      
      html +='</div>';

        html += '<div class="col-md-2 mb-2">';
          html += '<button id="add-cp" class="btn btn-primary" > <i class="fas fa-plus"></i></button>';
        html += '</div>';
      html +='</div>';
  html +='</div>';

      return html;

}
// este se usa para asignar cobertura creando un recolector, si ya existe un recolector en ese CP, que se muestre quien esta y sin input disponible
function showAllCpByZoneCollector(object){

  var html = '';

  html +='<div class="shadow rounded p-2 my-3" >';
      html +='<div class="row d-flex justify-content-center flex-column m-2 " >';

        html +='<div class="d-flex flex-row mb-3 align-items-center" >';
          html += '<span class="textBlack mx-2" >Por favor, seleccione los codigos postales que quiere abarcar.</span>';
          html += '<button id="select-cp" class="btn btn-sm btn-dark"><span id="text-select-all-cp" >Seleccionar todos</span> <i class="fas fa-object-group"></i></button>';
        html +='</div>';

          html += '<div class="d-flex  flex-row flex-wrap align-items-center" >';
            object.forEach((val) => {
              html += '<div class="col-md-3 ">';

              if(val.status == 'active' && val.type === 'recolector'){

                html += '<div  class="alert alert-success d-flex justify-content-center align-items-center">';
                  html +='<span><strong>'+val.postal_code+'</strong> |'+' '+val.name+'</span>';
                html += '</div>';

              }else{

              html += '<div  class="alert alert-primary d-flex justify-content-center align-items-center">';
                html +='<input class="input-cp-coverage" name="input-cp-coverage" type="checkbox" value="'+val.postal_code+'"><span>'+val.postal_code+'</span>';
              html += '</div>';

              }

              html += '</div>';
                  })
                
          html +='</div>';
      html +='</div>'

      html += '<div class="row d-flex flex-row flex-wrap m-2" id="content-input-cp" >';
      
      html +='</div>';

        html += '<div class="col-md-2 mb-2">';
          html += '<button id="add-cp" class="btn btn-primary" > <i class="fas fa-plus"></i></button>';
        html += '</div>';
      html +='</div>';
  html +='</div>';

    
      return html;

}

function table() {

 
    var table = $("#example").DataTable({
      
      language: {
        lengthMenu: "Mostrar _MENU_ registros",
        zeroRecords: "No se encontraron resultados",
        info:
          "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
        infoEmpty: "Mostrando registros del 0 al 0 de un total de 0 registros",
        infoFiltered: "(filtrado de un total de _MAX_ registros)",
        sSearch: "Buscar:",
        oPaginate: {
          sFirst: "Primero",
          sLast: "Último",
          sNext: "Siguiente",
          sPrevious: "Anterior",
        },
        sProcessing: "Procesando...",
      },
      //para usar los botones
      // responsive: "true",
      dom: "Bfrtilp",
      buttons: [
        {
          extend: "excelHtml5",
          text: '<i class="fas fa-file-excel"></i> ',
          titleAttr: "Exportar a Excel",
          className: "btn btn-success",
        },
        // {
        //   extend: "pdfHtml5",
        //   text: '<i class="fas fa-file-pdf"></i> ',
        //   titleAttr: "Exportar a PDF",
        //   className: "btn btn-danger",
        // },
        {
          extend: "print",
          text: '<i class="fa fa-print"></i> ',
          titleAttr: "Imprimir",
          className: "btn btn-info",
        },
      ],

      orderCellsTop: true,
      fixedHeader: false,
      
     

    });

   
    //Creamos una fila en el head de la tabla y lo clonamos para cada columna
    // $('#example thead tr').clone(true).appendTo( '#example thead' );
     
    // $('#example thead tr:eq(1) th').each( function (i) {
    //     var title = $(this).text(); //es el nombre de la columna+
    //    title !== '' ? $(this).html( '<input type="text" class="input-dinamic" placeholder="Buscar '+title+'" />' ) : true;
        
 
    //     $( 'input', this ).on( 'keyup change', function () {
    //         if ( table.column(i).search() !== this.value ) {
    //             table
    //                 .column(i)
    //                 .search( this.value )
    //                 .draw();
    //         }
    //     } );
    // } );



  }

  // MENSAJES

function alertPositive(str) {
  Swal.fire({
    icon: "success",
    title: str,
    showConfirmButton: false,
    timer: 3000,
  });
}

function alertNegative(str) {
  Swal.fire({
    icon: "error",
    title: "Info",
    text: str,
    timer: 2800,
    showConfirmButton: false,
  });
}

function alertInfo(first,second,icon){
  Swal.fire(
    first,
    second,
    icon
  )
}

function askSomething(title,text,icon,txtCancel,txtConfirm,action,object){



    Swal.fire({
      title: title,
      text: text,
      icon: icon,
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      cancelButtonText: txtCancel,
      confirmButtonText: txtConfirm
    }).then((result) => {
      if (result.isConfirmed) {

        //esta action es la que viene como parametro en la funcion, no en el objeto
        if(action === 'updateRangeZipCode'){
          updateRange(object);
        }else if(action === 'update'){
          update(object);
        }else if(action === 'create'){
          create(object);
         }else if(action === 'activate'){
          activateAgain(object);
         }
      }
    })

}

  // LOADER


function showLoader(idParent,btnClass,txtClass){

  $(idParent +' '+ btnClass).removeClass('hiddenLoader');
  $(idParent +' '+ txtClass).attr('disabled',true);
  $(idParent +' '+ txtClass).text('');

}

function hideLoader(idParent,btnClass,txtClass,txtBtn){

  $(idParent +' '+ btnClass).addClass('hiddenLoader');
  $(idParent +' '+ txtClass).attr('disabled',false);
  $(idParent +' '+ txtClass).text(txtBtn);
}

function resetUsually(){

  var type = $("#type").val()
  var flag = $("#flag").val()

    $("#postal_code").val('');

    if(type !== 'comercio'){
      $("#home_address").val('');
    }

    $("#lat").val('');
    $("#lng").val('');
    $("#hours_schedule_start").val('');
    $("#hours_schedule_finish").val('');
    $("#start_day").val('0');
    $("#finish_day").val('0');
    $("#name").val('');
    $("#id_operator").val('');

}

