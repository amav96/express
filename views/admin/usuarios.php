<?php
session_start();


if (isset($_SESSION["tipo"])) {

    if ($_SESSION["tipo"]["tipo"] != 'admin') {
        header("Location: ../../index.html");
    }
} else {
    header("Location: ../../");
}

?>

<?php require_once '../layout/headerAdmin.php'; ?>

<div class="container">
    

    <div class="container-datos-solicitante" id="container-datos-solicitante">

        <div class="box-solicitante" id="box-solicitante">

        </div>
    </div>

    <div class="text-center  d-flex justify-content-center">
           <div class="form-group w-40 p-3 ">

           <div  class="text-center m-2" id="loaderUsuarios">
                
                </div>

              <label  for="">Ingresar Usuario</label>
              <input id="usuario" class="form-control" type="text">
              <button id="buscar-usuario" class="btn btn-warning m-2" >Buscar</button>
              <button id="mostrar-todos-usuarios" class="btn btn-info m-2" >Mostrar Todos</button>
           </div>
    </div>


    <div class="table-solicitudes" id="table-solicitudes">


    </div>

    </div>


    <script>

$(document).on("click","#buscar-usuario",function(){
    
    var usuario = $("#usuario").val()
 
    $.ajax({
        url:"../../control/usuarioControllers.php?usuario&accion=trabajadores",
        type:"POST",
        data:{usuario},
        beforeSend: function(){}
    }).done(function(response){
        var object = JSON.parse(response);
        var template ="";
        if(object[0].result === '1'){

            template = showUsuariosReco(object)
            $("#table-solicitudes").html(template)

        }else{
            alertNegative("Usuario incorrecto");
        }
    })

})

$(document).on("click","#mostrar-todos-usuarios",function(){

    
    $.ajax({
        url:"../../control/usuarioControllers.php?usuario&accion=trabajadores",
        type:"POST",
        beforeSend: function(){}
    }).done(function(response){
        var object = JSON.parse(response);
        var template ="";
        if(object[0].result === '1'){
            template = showUsuariosReco(object)
            $("#table-solicitudes").html(template)
            }else{
                alertNegative("No hay datos");
            }
    })

})

function showUsuariosReco(object){

    var html="";



    
    html+='<table class="table table-responsive">';
            html+=' <thead>';
            html+='<tr>';
            
            html+='<th>Usuario<th>';
            html+='<th>Nombre<th>';
            html+='<th>Email<th>';
            html+='<th>Estado<th>';
            html+='<th>tipo<th>';
            html+='<th>Ingreso<th>';
           
            html+=' </tr>';
            html+='</thead>';
            html+='<tbody>';

         object.forEach((val)=>{

           html+='<tr>';
                    
                    html+='<td>'+val.id + '<td>';
                    html+='<td>'+val.nombre + '<td>';
                    html+='<td>'+val.email + '<td>';
                    html+='<td>'+val.status + '<td>';
                    html+='<td>'+val.tipo + '<td>';
                    html+='<td>'+val.fecha + '<td>';

                    
                    
                    
           html+='</tr>';

         })

         html+='</tbody>';
         html+='</table>';


   
    return html;

}




    </script>

   
    
    <?php require_once '../layout/footerAdmin.php'; ?>
