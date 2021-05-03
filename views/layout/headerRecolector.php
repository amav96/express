<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="shortcut icon" href="<?=base_url?>estilos/imagenes/logo/logo.png"><link rel="shortcut icon" href="estilos/imagenes/logo/logo.png">
	
	<script src="<?=base_url?>estilos/personal/js/jquery.min.js"></script>
	<script src="<?=base_url?>estilos/personal/js/bootstrap.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js"></script>
    <script src="https://unpkg.com/vuex@3.6.2/dist/vuex.js"></script> 
	<script src="https://cdn.jsdelivr.net/npm/vuetify@2.x/dist/vuetify.js"></script>

	<link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/@mdi/font@4.x/css/materialdesignicons.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/vuetify@2.x/dist/vuetify.min.css" rel="stylesheet">
	
	
	<script src="https://cdn.jsdelivr.net/npm/es6-promise@4/dist/es6-promise.auto.js"></script>
	<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
	<link rel="stylesheet" href="<?=base_url?>estilos/personal/fontawesome/css/all.css">

	<link rel="stylesheet" href="<?=base_url?>estilos/personal/css/bootstrap/bootstrap.min.css">

	<link rel="stylesheet" href="<?=base_url?>estilos/personal/css/index/recursos_index.css?v=21042021">

	<link rel="stylesheet" href="<?=base_url?>estilos/personal/css/sidebarper.css?v=21042021">
	

	<link rel="stylesheet" href="<?=base_url?>estilos/personal/css/panel_recolector/panel_recolector.css?v=21042021">
	<link rel="stylesheet" href="<?=base_url?>estilos/personal/css/panel_recolector/visita.css?v=21042021">
	

	<title>Express | Logistica inversa</title>

</head>

<body>



	<div class="container-artisan">


		<div class="fondoimagen" id="fondoimagen">


			<img class="logo-main" id="logodos" src="<?=base_url?>estilos/imagenes/logo2.png" alt="">

			<img class="logo-main-dos" id="logouno" src="<?=base_url?>estilos/imagenes/logo.png" alt="">

		</div>

	</div>

	<nav>
		<div class="contenedordemenu">
			<ul>
				<li>
					<a href="<?=base_url?>">

						<div class="fondocirculodelicono">
							<i class="iconoadentrodelcirculo fas fa-home"></i>
						</div>

						<p class="textoicono">Inicio</p>

					</a>
				</li>
				
				<li>
					<a href="<?=base_url?>express/contacto">
						<div class="fondocirculodelicono">
							<i class="iconoadentrodelcirculo fas fa-phone"></i>
						</div>
						<p class="textoicono">Contacto</p>
					</a>
				</li>
				
			</ul>
		</div>
	</nav>

	 <input class="input-form" type="checkbox" id="cuadraditocheck">
	  <label class="titulo-label" for="cuadraditocheck">
		<i class="fas fa-bars" id="boton"></i>
		<i class="fas fa-times" id="cancel"></i>
	</label>
	<div class="sidebarper completo">
		<header>Express</header>
		<ul class="completo">
			
		    <li>
				<a href="<?=base_url?>" ><i class="fas fa-home"></i>Inicio</a>
			</li>

			<li>
				<a href="<?=base_url?>equipo/collector" ><i class="fas fa-mobile-alt"></i>Gestión de equipos</a>
			</li>

			<li>
				<a href="<?=base_url?>notice/avisos" ><i class="far fa-envelope"></i>Gestión de avisos</a>
			</li>

			<li class="modelos">
				<a href="#" ><i class=" fas fa-vote-yea"></i>Modelos</a>
			</li>
			
			<!-- <li>
				<a href="#" id="nuevosClientes"><i class="fas fa-user-plus"></i>Nuevos Clientes</a>
			</li> -->
			<!-- <li>
				<a href="#" id="abrirEquiposAConsignacion"><i class="fas fa-box-open"></i>Equipos a consignación</a>
			</li> -->

			<li>
				<a href="<?=base_url?>equipo/credencial" ><i class="far fa-address-card"></i>Mi credencial</a>
			</li>
			
			<li>
				<a href="<?=base_url?>usuario/logOut" id="cerrarSesion"><i class="fas fa-sign-out-alt"></i>Cerrar Sesion</a>
			</li>

		</ul>

	</div> 
	<!--Datos de uso-->
			<input type="hidden" id="img_person" value="<?= $_SESSION["username"]->img_person ?>">
            <input type="hidden" id="first_name" value="<?= $_SESSION["username"]->name ?>">
            <input type="hidden" id="rol" value="<?= $_SESSION["username"]->role ?>">
			<input type="hidden"  id="id_number" value="<?= $_SESSION["username"]->id_number ?>">
			<input type="hidden" id="country_recolector" value="<?=$_SESSION["username"]->country?>">
			
            <input type="hidden" class="form-control" name="id_recoleorden" id="id_recoleorden" value="<?php if (isset($_SESSION["username"])) { echo $_SESSION["username"]->id;} ?>">