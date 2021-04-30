<footer class="site-footer">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-md-6">
                    <h6>Nosotros</h6>
                    <p class="text-justify">Especialistas en ultima milla, logistica inversa y directa. Express traslada
                        paqueteria en Argentina y uruguay.
                    </p>

                </div>


                <div class="col-xs-6 col-md-3">
                    <h6>Navega</h6>
                    <ul class="footer-links">
                        <li><a href="<?=base_url?>express/productos">Productos</a></li>
                        <li><a href="<?=base_url?>express/nosotros">#Express</a></li>
                        <li><a href="<?=base_url?>express/contacto">Contacto</a></li>
                        <!-- <li><a href="http://scanfcode.com/category/java-programming-language/">Java</a></li> -->

                    </ul>
                </div>

                <div class="col-xs-6 col-md-3">
                    <h6>Socios y empleo</h6>
                    <ul class="footer-links">
                        <li><a href="<?=base_url?>express/recolector">Recolectores</a></li>
                        <li><a href="<?=base_url?>express/call">Call Center</a></li>
                        <li><a href="<?=base_url?>express/comercio">Comercios</a></li>
                       

                    </ul>
                </div>
            </div>
            <hr>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-sm-6 col-xs-12">
                    <p class="copyright-text">
                        <a href="#">Express metropolitana de servicios</a>.
                    </p>
                </div>

                <div class="col-md-4 col-sm-6 col-xs-12">
                    <ul class="social-icons">
                        
                        <!-- <li><a class="twitter" href="#"><i class="fa fa-twitter"></i></a></li>
                        <li><a class="dribbble" href="#"><i class="fa fa-dribbble"></i></a></li>
                        <li><a class="linkedin" href="#"><i class="fa fa-linkedin"></i></a></li> -->
                    </ul>
                </div>
            </div>
        </div>
    </footer>
    <script src="<?=base_url?>estilos/personal/js/jquery.js"></script>
    <script src="<?=base_url?>estilos/personal/js/logo.js"> </script>
    <script src="<?=base_url?>estilos/personal/js/lightslider.js"></script>
    <script src="<?=base_url?>estilos/personal/js/marvel.js"></script>
    <script src="<?=base_url?>estilos/personal/js/index.js?v=05042021"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    
    <script> 

        const accordionItemHeaders = document.querySelectorAll(".accordion-item-header");

        accordionItemHeaders.forEach(accordionItemHeader => {
            accordionItemHeader.addEventListener("click", event => {
                accordionItemHeader.classList.toggle("active");
                const accordionItemBody = accordionItemHeader.nextElementSibling;
                if (accordionItemHeader.classList.contains("active")) {
                    accordionItemBody.style.maxHeight = accordionItemBody.scrollHeight + "px";
                }
                else {
                    accordionItemBody.style.maxHeight = 0;
                }

            });
        });

</script>

    

    <script>


$(window).on("load",function(){
  $(".loader").fadeOut("slow");
});


    </script>
</body>

</html>