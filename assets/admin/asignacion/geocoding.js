
$(document).on('click','#geocoding',function(){

 var type = $("#type").val();
 var flag = $("#flag").val();

 var id_country = $("#id_country").val();

 var province = $('select[name="province"] option:selected').text();
 var locate = $('select[name="locate"] option:selected').text();
 var home_address = $("#home_address").val();
//  var id_user = $("#id_user");


 if(type === 'comercio' && flag === 'create'){

     province = $('select[name="id_user"] option:selected').attr('province')
     locate = $("#locate_user").val();
     if(locate === ''){
         alertNegative('La localidad del comercio no puede estar vacia');
         return false;
 }
 }else if (flag === 'update' && type === 'recolector' || type==='comercio' ){

     province = $("#province").val();
     locate = $("#locate").val();
    

 }else if(flag === 'updateRange' && type === 'recolector' || type==='comercio'){

    province = $("#province").val();
    locate = $("#locate").val();
    

 }

    var provinceValue = $('#province').val();
    var locateValue = $('#locate').val();

    // if(flag === 'create'){
    //     $("#btnCreate").prop('disabled', false);
    // }
 
    if(id_country === '0' || id_country === ''){

        $("#btnCreate").prop('disabled', true);
        alertNegative("Debes ingresar el pais");
        return false;

    }else if(provinceValue === '0' || provinceValue === ''){

        $("#btnCreate").prop('disabled', true);
        alertNegative("Debes ingresar la provincia");
        return false;

    }else if(locateValue === '0' || locateValue === ''){
        
        $("#btnCreate").prop('disabled', true);
        alertNegative("Debes ingresar la localidad");
        return false;

    }else if(home_address === '0' || home_address === ''){

        $("#btnCreate").prop('disabled', true);
        alertNegative("Debes ingresar dirección");
        return false;

    }else{

            const object = {
                id_country,
                province,
                locate,
                home_address
                }
                console.log(object)

            showLoader('#geocoding', '.loaderBtn', '.txtGeocode')
            geocoding(object);

    }

})


//mapear
$(document).on('click','#geo',function(e){
    e.preventDefault();
  

    //tomo los datos del link que se genera despues de la geolocalización
    var lat  = $("#geo").attr('lat');
    var lng = $("#geo").attr('lng');
    var home_address = $("#geo").text().trim();

    $("#lat").val(lat);
    $("#lng").val(lng);
    $("#home_address").val(home_address);

     var a = 'https://maps.googleapis.com/maps/api/staticmap?key=AIzaSyDasdhwGs_A9SbZUezcx9VhSSGkxl46bko&center=' + lat + ',' + lng + '&zoom=16&size=360x230&maptype=roadmap&markers=color:red%7C' + lat + ',' + lng;
     var img = "<img id='imgMap' src='" + a + "' />";

     var contentFail ="";
     
    contentFail += '<div class="row d-flex justify-content-center flex-column">';
        contentFail += '<div class="row d-flex justify-content-center">';
                contentFail += '<div class="col-8" >';
                    contentFail += '<label> Si la geolocalización arrojada en el mapa  no es correcta, puedes seguir el proceso sin esta información </label>';
                contentFail += '</div>';
            contentFail += '</div>';

            contentFail += '<div class="row d-flex justify-content-center">';
                contentFail += '<div class="col-4" >';  
                    contentFail += '<button id="resultFail" class="btn btn-sm btn-info" >Seguir sin geolocalización</button>';
                contentFail += '</div>';
            contentFail += '</div>';

    contentFail += '</div>';

     $("#img").html(img);
     $("#content-fail").html(contentFail);

})

$(document).on('click','#resultFail',function(){
    //si el resultado es erroneo hago esto:
    //vacio el contenedor de geolocalización y el campo dirección

    $("#contentGeo").html('');
    $("#home_address").val('');

    //flag a las coordenadas para indicar que fue error
    $("#lat").val('00000');
    $("#lng").val('00000');

})


function geocoding(object){

    var value;
    var provinceApi = object.province;
    var locateApi = object.locate; 
    var countryApi;
    if(object.id_country === '1'){
     countryApi= 'Argentina';
    }else if(object.id_country === '2'){
     countryApi= 'Uruguay';
    }
    var home_addressApi = object.home_address; 
    var string;
    string= 'json?'+home_addressApi+','+locateApi+','+provinceApi+','+countryApi;
    var value = string.replace(/\s+/g,'%20');

    console.log(value)
    fetch('https://maps.googleapis.com/maps/api/geocode/json?address='+value+'&key=AIzaSyDasdhwGs_A9SbZUezcx9VhSSGkxl46bko')
        .then(response => response.json())
        .then(geocode => {

                hideLoader('#geocoding','.loaderBtn','.txtGeocode','Geocodificar');
                var lat = $("#lat");
                var lng = $("#lng");

                if(geocode.status === 'OK'){

                    var html;
                    hideLoader('#geocoding','.loaderBtn','.txtGeocode','Geocodificar');
                    lat.val() != '' ? lat.val('') : true;
                    lng.val() != '' ? lng.val('') : true;
                    html = showGeocoding(geocode.results);
                    $("#contentGeo").html(html);
                
                }else{
    
                    alertInfo('La geocodificación no ha sido posible','1) Verifique la dirección. 2) Asegurese que la dirección pertenezca a la localidad. 3) Intente con una localidad cercana y la misma dirección. 4) Si la dirección son dos calles Ejem. Maza & Agrelo. Coloque "y" en lugar de "&".  5) Puede continuar sin geocodificar','info');
                    lat.val('00000');
                    lng.val('00000');
                    $("#contentGeo").html('');
                
                    return false
                }
        })
        .catch(error => {
            console.log("entro al error")
            alertNegative(error);
            return false;
        });

 
}

function showGeocoding(geocode){

    var filtered_array;
    var html = "";

    html +='<div class="row my-4 mx-1 d-flex justify-content-center">';
        html +='<h5 class="alert alert-primary"> Por favor, seleccione una dirección de la siguiente lista</h5>';
    html += '</div>'; 

    html +='<div class="row my-4">';
        html +='<div class="shadow col-md-12 d-flex justify-content-center flex-column pt-2 shadow-edit">';
            html += '<div class="d-flex form-group flex-column mt-4">';  
            geocode.forEach((elemento)=>{

                filtered_array = elemento.address_components.filter(function(address_component){
                    return address_component.types.includes("administrative_area_level_2");
                  });

         
                  if(filtered_array && filtered_array != undefined && filtered_array.length > 0){

                     html +='<h6 class=" d-flex justify-content-center align-item-center align-content-center text-center" >' +filtered_array[0].long_name+'</h6>';
                  } 
                html +="<a href='#' id='geo' lat="+elemento.geometry.location.lat+" lng="+elemento.geometry.location.lng+" class='m-2 btn btn-danger' ><i class='fas fa-home'> </i> "+elemento.formatted_address+"</a>";
            
            })

            html += '</div>';
        html += '</div>'; 
    html += '</div>';  

    html +='<div class="row my-4 d-flex justify-content-center">';
        html +='<div id="img"> </div>';
    html += '</div>';  

    html +='<div class="row my-4 d-flex justify-content-center">';
         html += '<div id="content-fail" ></div>';  
    html += '</div>';  
   

    return html;
}

