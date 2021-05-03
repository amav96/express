

    <?php require_once 'views/layout/header.php'; ?>
    <link rel="stylesheet" href="<?=base_url?>estilos/personal/css/productos/recursos_productos.css">

    <!-- titulo  de productos -->
    <div class="container-artisan">
        <section class="contenedor-titulo-productos">

            <div class="titulo-productos">
                <h1>Si todavia no conoces a Express, <br> estos son nuestros productos </h1>
            </div>

        </section>
    </div>
    <!-- END titulo de productos -->

    <!-- Productos -->
    <div class="container-artisan">
        <article class="contenedor-productos">

            <div class="box-productos">
                <a href="<?=base_url?>express/corporativo" class="vinculo-productos">
                    <div class="ilustracion-producto">
                        <img class="tamano-imagen-producto" src="<?=base_url?>estilos/imagenes/front/car2.png" alt="">
                    </div>
                    <h4>Recupero</h4>
                    <p>Recuperacion y gestión de equipos</p>
                    <i class="more-info fas fa-plus-circle"></i>
                </a>
                </a>
            </div>
            <div class="box-productos">
                <a href="<?=base_url?>express/ecommerce" class="vinculo-productos">
                    <div class="ilustracion-producto">
                        <img class="tamano-imagen-producto" src="<?=base_url?>estilos/imagenes/front/computer.png" alt="">
                    </div>
                    <h4>Ecommerce</h4>
                    <p>Podras enviar paquetes a tus clientes.</p>
                    <i class="more-info fas fa-plus-circle"></i>
                </a>
            </div>
            <div class="box-productos">
                <a href="<?=base_url?>express/particulares" class="vinculo-productos">
                    <div class="ilustracion-producto">
                        <img class="tamano-imagen-producto" src="<?=base_url?>estilos/imagenes/front/shoes.png" alt="">
                    </div>
                    <h4>Particulares</h4>
                    <p>Envia lo que quieras</p>
                    <i class="more-info fas fa-plus-circle"></i>
                </a>
            </div>
            <div class="box-productos">
                <a href="<?=base_url?>express/traslados" class="vinculo-productos">
                    <div class="ilustracion-producto">
                        <img class="tamano-imagen-producto" src="<?=base_url?>estilos/imagenes/front/bow2.png" alt="">
                    </div>
                    <h4>Distribución</h4>
                    <p>Traslado, logistica y stock de equipos</p>
                    <i class="more-info fas fa-plus-circle"></i>
                </a>
            </div>

        </article>
    </div>
<?php require_once 'views/layout/footer.php'; ?>

  