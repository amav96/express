$(document).ready(function(){

    $("#corporativo").click(function(){
        location.href = 'express/corporativo';
    })
    
    $("#corptraslados").click(function(){
        location.href = 'express/traslados';
    })
    
    $('#ecommerce').click(function (){
    
        location.href = 'express/ecommerce';
    })
    
     $('#gestion').click(function (){
    
         location.href = 'express/red';
     })
    $('#recolectores').click(function (){
       
    
        location.href = 'equipo/collector';
    })
    
     $('#red').click(function (){
    
         location.href = 'express/red';
     })
    
     myFunction()
    
     function myFunction() {
        setInterval(function(){ 
            $("#gestion").addClass("botonAnimation");
         }, 3000);
         setInterval(function(){ 
            $("#gestion").removeClass("botonAnimation");
         }, 5000);

         setInterval(function(){ 
            $("#tengoEquipo").addClass("botonAnimationLetra");
         }, 3000);
         setInterval(function(){ 
            $("#tengoEquipo").removeClass("botonAnimationLetra");
         }, 5000);
      }

    })

    $(document).on("click","#preguntas-frecuentes", function(){
        $('html,body').animate({
            scrollTop: $('#acordion-ancla').offset().top - 80
        }, 500);
    })
