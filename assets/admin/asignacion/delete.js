
var tdr = 

$(document).on('click','#delete',function(){

  var td = this.parentElement;
  tdr = $(this).parents('tr');
  var id_to_delete = $(td).attr('tdid');
  var id_country = $(td).attr('tdCountry');
  var postal_code = $(td).attr('tdPostal_code');
  var locate = $(td).attr('tdLocate');
  var country = "";

  var html ="";
  $("#modalAsignacion").modal("show");
  $("#titleAssigned").text("Eliminar punto de la red");

    html = viewDelete();
    $("#content-range").html(html);
    $("#id_to_delete").val(id_to_delete);
    $("#id_country_to_delete").val(id_country);

    if(id_country == 1){
      country = 'Argentina';
  }else if(id_country == 2){
      country = 'Uruguay';
  }


  var text = country + ' ' + '-' + ' ' + locate + ' ' + '-' + ' ' + postal_code;
  $("#contentUpdate").text(text);

})

$(document).on('click','#btnDelete',function(){

  var motive = $("#motive").val();
  var id_to_delete = $("#id_to_delete").val();
  var id_country_to_delete = $("#id_country_to_delete").val();
  var user_managent_id = $("#id_user_default").val();

  if(motive === '' || motive === '0'){
    alertNegative('Debes ingresar un motivo por el cual realizaras esta acción');
    return false;
    
  }else if(id_to_delete === ''){
    alertNegative('No hay registro seleccionado, vuelva a intentarlo');
    return false;

  }else if(id_country_to_delete === ''){
    alertNegative('No hay registro seleccionado, vuelva a intentarlo');
    return false;

  }else{

    var id = Array();

    id.push(id_to_delete);

    object = {
      id,
      id_country:id_country_to_delete,
      user_managent_id,
      motive

  }

   askSomethingDelete('¿Estas seguro de eliminar este registro?','Saldra del asignado de codigos postales','info','No, cancelar','Eliminar','delete',object);

  }

})

function askSomethingDelete(title,text,icon,txtCancel,txtConfirm,action,object){

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
        if(action === 'delete'){
            deleteCP(object);
        }
      }
    })

}

function viewDelete(){

  var html = '';

  html += '<input type="hidden" id="id_to_delete">';
  html += '<input type="hidden" id="id_country_to_delete">';

  html += '<div class="container" >';
        html += '<div class="row mb-2">';
            html += '<div class="col-12 p-2 shadow rounded text-center identy">';
            html += '<span ><strong id="contentUpdate" ></strong> </span>';
            html += '</div>';
        html += '</div>';
    html += '</div>';

  html += '<div class="form-group my-4 ">';
    html += '<label style="font-weight: 500;margin: 20px 0;" for="motivo">¿Porque realizaras esta acción?</label>';
      html += '<div class="d-flex">';
          html += '<div class="input-group-prepend">';
          html += '<div class="input-group-text"><i class="far fa-keyboard"></i></div>';
          html += '</div>';
          html += '<select id="motive" style="border: 0.5px solid #dcd5d5;border-radius: 5px;padding: 6px;">';
            html += '<option value="0" >Seleccione un motivo</option>';
            html += '<option value="cambio de ubicacion" >Cambio de ubicación</option>';
            html += '<option value="cerro" >Cerro el correo/terminal/comercio</option>';
            html += '<option value="no esta mas" >No esta más</option>';
            html += '<option value="desicion propia" >Desición propia</option>';
            html += '<option value="baja performance" >Baja performance</option>';
            html += '<option value="conflicto" >Conflicto</option>';
            html += '<option value="consiguio algo mejor" >Consiguio algo mejor</option>';
          html += '</select>';
      html += '</div>';
  html += '</div>';


  
   //pais - hidden porque no se cambia el pais del registro que se quiere actualizar unicamente

  //type of point 

  html += '<div id="content-point" >';

  html += '</div>';

  html += '<div class="row">';
      html += '<div class="d-flex justify-content-center col-4 ">';
            html += '<button id="btnDelete" class="btn btn-danger col-12"> <span class="spinner-border hiddenLoader loaderBtn" role="status"></span> <span class="txtDelete"> Eliminar </span> <i class="far fa-trash-alt"></i></button>';
      html += '</div>';
    html += '</div>';



  return html;

}

function deleteCP(object){

   $.ajax({
    url: base_url + 'controllers/coberturaController.php?cobertura=delete',
        type: 'POST',
        data: { object },
   beforeSend:function(){
    showLoader('#btnDelete', '.loaderBtn', '.txtDelete');
   },
   }).done(function(response){
      hideLoader('#btnDelete','.loaderBtn','.txtDelete','Eliminar');
      var objectResponse = JSON.parse(response);

      if(objectResponse[0].result === '1'){
        alertPositive('Eliminado con éxito');
        $("#modalAsignacion").modal("hide");
         setTimeout(function(){ 
           tdr.fadeOut();
          }, 3100);
    
      }
     
   })

}