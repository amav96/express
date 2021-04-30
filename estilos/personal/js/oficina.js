$.when( $.ready, $.getScript("../estilos/personal/js/lightslider.js")). then (function() {
    var autoplaySlider = $('#autoplay').lightSlider({
        auto:true,
        loop:true,
        pauseOnHover: true,
        onBeforeSlide: function (el) {
            $('#current').text(el.getCurrentSlideCount());
        } 
    });
    $('#total').text(autoplaySlider.getTotalSlideCount());
 }).catch(function(){
     console.log("no paso");
 });


