/*
		El siguiente codigo en JS Contiene mucho codigo
		de las siguietes 3 fuentes:
		https://stipaltamar.github.io/dibujoCanvas/
		https://developer.mozilla.org/samples/domref/touchevents.html - https://developer.mozilla.org/es/docs/DOM/Touch_events
		http://bencentra.com/canvas/signature/signature.html - https://bencentra.com/code/2014/12/05/html5-canvas-touch-events.html
*/





(function () { // Comenzamos una funcion auto-ejecutable


	$("#abrirfirmar").click(function(){
		
		$("#contenedor").show();
		$("#exito-firmar").hide();
		$("#debes-recuperar").hide();

		
		$("#crear-imagen").show()
        $("#borrar-imagen").show()
	
	})



		// Obtenenemos un intervalo regular(Tiempo) en la pamtalla
		window.requestAnimFrame = (function (callback) {
			return window.requestAnimationFrame ||
				window.webkitRequestAnimationFrame ||
				window.mozRequestAnimationFrame ||
				window.oRequestAnimationFrame ||
				window.msRequestAnimaitonFrame ||
				function (callback) {
					window.setTimeout(callback, 1000 / 60);
					// Retrasa la ejecucion de la funcion para mejorar la experiencia
				};
		})();
	
		// Traemos el canvas mediante el id del elemento html
		var canvas = document.getElementById("firma");
		var ctx = canvas.getContext("2d");

		

		$(canvas).on("touchmove",function(){

			$("#crear-imagen").show()
			$("#borrar-imagen").show()
		})
		$(canvas).on("click",function(){

			$("#crear-imagen").show()
			$("#borrar-imagen").show()
		})


		// Mandamos llamar a los Elemetos interactivos de la Interfaz HTML
		// var urlImagen = document.getElementById("url-imagen");
	
		var borrarImagen = document.getElementById("borrar-imagen");
		// CREAR FIRMA SIMULA EL SIGUIENTE PERO DE FIRMAR !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
		var crearImagen = document.getElementById("crear-imagen");

		borrarImagen.addEventListener("click", function (e) {
			// Definimos que pasa cuando el boton imagen-creada es pulsado
			clearCanvas();
			$("#crear-imagen").hide()
		}, false);
	
			// Definimos que pasa cuando el boton crear-imagen es pulsado
			crearImagen.addEventListener("click", function (e) {
				

				var identificacionInicio = $("#q").val()
	
			var identiMayus = identificacionInicio.toUpperCase()
			 
			var hoy = new Date();
			var fecha = hoy.getFullYear() + '-' + ("0" +(hoy.getMonth() + 1)).slice(-2) + '-' +
			("0" + hoy.getDate()).slice(-2)

			
			
	
			$("#fechafirma").val(fecha)

				var dataUrl = canvas.toDataURL();
				$("#abrirRemito").show();
	
				var aclaracion = $("#nombreaclaracion").val()
				var documento = $("#documentoFirmar").val()
				var idfirmar = $("#idFirmar").val()
                var keyComprobar = 'existe';


	
				if(idfirmar == ""){
						   
					      $("#firmar").modal("hide");
						   clearCanvas(),
						   $("#nombreaclaracion").val(""),
						   $("#documentoFirmar").val("")
                            $("#loaderFirmar").remove()
						   alertNegative('Debes recuperar un equipo para agregar una firma'); return false
				}
	
	
				if (aclaracion == "") {
					$("#loaderFirmar").remove()
					alertNegative('Debes ingresar el nombre de quien entrega'); return false
				} 
				if (documento == "") {  
					$("#loaderFirmar").remove()
					alertNegative('Debes ingresar el documento de quien entrega'); return false
				} if (!(/^[0-9.]+$/).test(documento)) {
					$("#loaderFirmar").remove()
					alertNegative('El documento ingresado es inválido'); return false
				}

				Swal.fire({
					title: 'Estas seguro de enviar la firma?',
					text: "Aun podes realizar alguna modificacion",
					icon: 'info',
					showCancelButton: true,
					confirmButtonColor: '#3085d6',
					cancelButtonColor: '#d33',
					confirmButtonText: 'Si, estoy seguro!'
				  }).then((result) => {
					if (result.isConfirmed) {
						$("#cont-loader-firmando").append('<div id="loaderFirmar" class="spinner-border" role="status"><span class="sr-only">Loading...</span></div>')
						
					// reseteo formulario firmas
						$.ajax({
							url:"../controllers/equipoController.php?equipo=firma",
							type: "post",
							data: {fecha,idfirmar,keyComprobar,dataUrl,aclaracion, documento},
						
							success: function(response){
								
								
								let reciboExistenciaFirma = JSON.parse(response)
					 if(reciboExistenciaFirma[0].result === true){
						 
						//si no existe la firma insertarda y si se inserto la nueva firma correctamente...
						// ingreso la data de la recuperacion en la base de datos
					let sendData = JSON.parse(localStorage.getItem('transito'))
					localStorage.setItem('en','s');
					localStorage.setItem('te','re');
					

					$.ajax({
						url: "../controllers/equipoController.php?equipo=recuperar",
						type: "POST",
						data: { sendData },
						success: function (response) {
							$("#loaderFirmar").remove()
							
							if (response === '1') {

								clearCanvas();
								$("#nombreaclaracion").val("")
								$("#documentoFirmar").val("")
								$("#errorDocumento").hide()
								$("#crear-imagen").hide()
								$("#borrar-imagen").hide()
								$("#firmar").modal("hide");

								// modo de envio de email
								$("#modoEmail").val("remitoRecupero")
								$("#enviarRemito").modal("show");
								veryCountry();
								$("#closeEnvioRemito").hide();
	
								alertPositive('Equipos cargados con exito!')
								$("#text-caja-confirmar").text("Transacción actual")
								$("#finalizar-text").text("Finalizar transacción")
								$("#btnAutorizar").hide()

							}
							if (response === '2') {
								alertNegative('Error CODE DB'); return false;
							  }
							  if (response === '3') {
								alertNegative('Error CODE AR DATA'); return false;
							  }

						}
				
					  })

					}if(reciboExistenciaFirma[0].result === 'failInsert'){
						$("#loaderFirmar").remove()
						  clearCanvas()
						  alertNegative('Error CODE DB'); return false;
					}
					if(reciboExistenciaFirma[0].result === 'existeFirma'){
						$("#loaderFirmar").remove()
						
				   		clearCanvas()
				   		alertNegative('La firma ingresada ya existe!'); return false;
					           }
							}
						})
					}else{
						$("#loaderFirmar").remove()
					}
				  })
	

			}, false);

			$("#salirEquisFirmar").click(function () {
				Swal.fire({
				  title: '¿Estas seguro?',
				  icon: 'info',
				  showCancelButton: true,
				  confirmButtonColor: '#3085d6',
				  cancelButtonColor: '#d33',
				  confirmButtonText: 'Si'
				}).then((result) => {
				  if (result.isConfirmed) {
					  clearCanvas();
					  $("#nombreaclaracion").val('')
					  $("#documentoFirmar").val('')
					$("#firmar").modal("hide")
				  }
				})
			  })
		
		// Activamos MouseEvent para nuestra pagina
		var drawing = false;
		var mousePos = { x: 0, y: 0 };
		var lastPos = mousePos;
		canvas.addEventListener("mousedown", function (e) {
			/*
			  Mas alla de solo llamar a una funcion, usamos function (e){...}
			  para mas versatilidad cuando ocurre un evento
			*/
			var tint = document.getElementById("color");
			var punta = document.getElementById("puntero");
			// console.log(e);
			drawing = true;
			lastPos = getMousePos(canvas, e);
		}, false);
		canvas.addEventListener("mouseup", function (e) {
			drawing = false;
		}, false);
		canvas.addEventListener("mousemove", function (e) {
			mousePos = getMousePos(canvas, e);
		}, false);
	
		// Activamos touchEvent para nuestra pagina
		canvas.addEventListener("touchstart", function (e) {
			mousePos = getTouchPos(canvas, e);
			// OJOOOOO console.log(mousePos);
			e.preventDefault(); // Prevent scrolling when touching the canvas
			var touch = e.touches[0];
			var mouseEvent = new MouseEvent("mousedown", {
				clientX: touch.clientX,
				clientY: touch.clientY
			});
			canvas.dispatchEvent(mouseEvent);
		}, false);
		canvas.addEventListener("touchend", function (e) {
			e.preventDefault(); // Prevent scrolling when touching the canvas
			var mouseEvent = new MouseEvent("mouseup", {});
			canvas.dispatchEvent(mouseEvent);
		}, false);
		canvas.addEventListener("touchleave", function (e) {
			// Realiza el mismo proceso que touchend en caso de que el dedo se deslice fuera del canvas
			e.preventDefault(); // Prevent scrolling when touching the canvas
			var mouseEvent = new MouseEvent("mouseup", {});
			canvas.dispatchEvent(mouseEvent);
		}, false);
		canvas.addEventListener("touchmove", function (e) {
			e.preventDefault(); // Prevent scrolling when touching the canvas
			var touch = e.touches[0];
			var mouseEvent = new MouseEvent("mousemove", {
				clientX: touch.clientX,
				clientY: touch.clientY
			});
			canvas.dispatchEvent(mouseEvent);
		}, false);
	
		// Get the position of the mouse relative to the canvas
		function getMousePos(canvasDom, mouseEvent) {
			var rect = canvasDom.getBoundingClientRect();
			/*
			  Devuelve el tamaño de un elemento y su posición relativa respecto
			  a la ventana de visualización (viewport).
			*/
			return {
				x: mouseEvent.clientX - rect.left,
				y: mouseEvent.clientY - rect.top
			};
		}
	
		// Get the position of a touch relative to the canvas
		function getTouchPos(canvasDom, touchEvent) {
			var rect = canvasDom.getBoundingClientRect();
			//   OOOJOOOOOOO console.log(touchEvent);
			/*
			  Devuelve el tamaño de un elemento y su posición relativa respecto
			  a la ventana de visualización (viewport).
			*/
			return {
				x: touchEvent.touches[0].clientX - rect.left, // Popiedad de todo evento Touch
				y: touchEvent.touches[0].clientY - rect.top
			};
		}
	
		// Draw to the canvas
		function renderCanvas() {
			if (drawing) {
				var tint = document.getElementById("color");
				var punta = document.getElementById("puntero");
				ctx.strokeStyle = tint.value;
				ctx.beginPath();
				ctx.moveTo(lastPos.x, lastPos.y);
				ctx.lineTo(mousePos.x, mousePos.y);
				console.log(punta.value);
				ctx.lineWidth = punta.value;
				ctx.stroke();
				ctx.closePath();
				lastPos = mousePos;
			}
		}
	
		function clearCanvas() {
			canvas.width = canvas.width;
		}

	
	
		// Allow for animation
		(function drawLoop() {
			requestAnimFrame(drawLoop);
			renderCanvas();
		})();
	
	})();
	
    