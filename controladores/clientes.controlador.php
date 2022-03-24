<?php

class ControladorClientes{

	/*=============================================
	CREAR CLIENTES
	=============================================*/

	static public function ctrCrearCliente(){

		if(isset($_POST["nuevoCliente"])){

			if(preg_match('/^[a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoCliente"]) &&
			   preg_match('/^[0-9]+$/', $_POST["nuevoDocumentoId"]) &&
			   preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $_POST["nuevoEmail"]) && 
			   preg_match('/^[()\-0-9 ]+$/', $_POST["nuevoTelefono"]) && 
			   preg_match('/^[#\.\-a-zA-Z0-9 ]+$/', $_POST["nuevaDireccion"]) &&
			   preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoRazon"]) &&
			   preg_match('/^[a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoCiudad"]) 
			   ){

			   	$tabla = "clientes";
			   	$datos = array("nombre"=>$_POST["nuevoCliente"],
					           "documento"=>$_POST["nuevoDocumentoId"],
					           "email"=>$_POST["nuevoEmail"],
					           "telefono"=>$_POST["nuevoTelefono"],
					           "direccion"=>$_POST["nuevaDireccion"],
							   "razonSocial"=>$_POST["nuevoRazon"],
							   "ciudad"=>$_POST["nuevoCiudad"]);

			   	$respuesta = ModeloClientes::mdlIngresarCliente($tabla, $datos);

			   	if($respuesta == "ok"){

					echo'<script>
						swal({
							type: "success",
							title: "El cliente ha sido guardado correctamente",
							showConfirmButton: true,
							confirmButtonText: "Cerrar"

							}).then(function(result){
									if (result.value) {
										window.location = "clientes";
										}
									})
						</script>';

				}

			}else{

				echo'<script>
					swal({
						  type: "error",
						  title: "¡El cliente no puede ir vacío o llevar caracteres especiales!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"

							}).then(function(result){
								if (result.value) {
									window.location = "clientes";
								}
							})
			  		</script>';

			}

		}

	}

	/*=============================================
	MOSTRAR CLIENTES
	=============================================*/

	static public function ctrMostrarClientes($item, $valor){

		$tabla = "clientes";
		$respuesta = ModeloClientes::mdlMostrarClientes($tabla, $item, $valor);
		return $respuesta;

	}

	/*=============================================
	EDITAR CLIENTE
	=============================================*/

	static public function ctrEditarCliente(){

		if(isset($_POST["editarCliente"])){

			if(preg_match('/^[a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarCliente"]) &&
			   preg_match('/^[0-9]+$/', $_POST["editarDocumentoId"]) &&
			   preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $_POST["editarEmail"]) && 
			   preg_match('/^[()\-0-9 ]+$/', $_POST["editarTelefono"]) && 
			   preg_match('/^[#\.\-a-zA-Z0-9 ]+$/', $_POST["editarDireccion"]) &&
			   preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarRazon"]) &&
			   preg_match('/^[a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarCiudad"])
			   ){

			   	$tabla = "clientes";
			   	$datos = array("id"=>$_POST["idCliente"],
			   				   "nombre"=>$_POST["editarCliente"],
					           "documento"=>$_POST["editarDocumentoId"],
					           "email"=>$_POST["editarEmail"],
					           "telefono"=>$_POST["editarTelefono"],
					           "direccion"=>$_POST["editarDireccion"],
							   "razonSocial"=>$_POST["editarRazon"],
							   "ciudad"=>$_POST["editarCiudad"]
								);

			   	$respuesta = ModeloClientes::mdlEditarCliente($tabla, $datos);

			   	if($respuesta == "ok"){

					echo'<script>
						swal({
							type: "success",
							title: "El cliente ha sido cambiado correctamente",
							showConfirmButton: true,
							confirmButtonText: "Cerrar"
							}).then(function(result){
										if (result.value) {
										window.location = "clientes";
										}
									})
						</script>';

				}

			}else{

				echo'<script>
					swal({
						  type: "error",
						  title: "¡El cliente no puede ir vacío o llevar caracteres especiales!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {
							window.location = "clientes";
							}
						})
			  		</script>';

			}

		}

	}

	/*=============================================
	ELIMINAR CLIENTE
	=============================================*/

	static public function ctrEliminarCliente(){

		if(isset($_GET["idCliente"])){

			$tabla ="clientes";
			$datos = $_GET["idCliente"];
			$respuesta = ModeloClientes::mdlEliminarCliente($tabla, $datos);

			if($respuesta == "ok"){

				echo'<script>
					swal({
						type: "success",
						title: "El cliente ha sido borrado correctamente",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"
						}).then(function(result){
							if (result.value) {
								window.location = "clientes";
							}
						})
					</script>';

			}		

		}

	}


	/*=============================================
	IMPORTAR CLIENTE
	=============================================*/

	static public function ctrCargarClientes(){
		if (isset($_POST['enviar'])) {
			
			$archivo = $_FILES["file"]["name"];
			$archivoCp = $_FILES["file"]["tmp_name"];
			$guardar = "copia_".$archivo;
			if (copy($archivoCp , "CSV/$guardar")) {
				
			} else {
				echo "no se copio";
			}
			
			if (file_exists($archivoCp)) {
				$FP = fopen($archivoCp, "r"); // ABRIR ARCHIVO PARA LECTURA
				while($Cvalor = fgetcsv($FP, 1000, ",")){
					$tabla = "clientes";
					$datos = array("nombre"=>$Cvalor[0],
								   "documento"=>$Cvalor[1],
								   "email"=>$Cvalor[2],
								   "telefono"=>$Cvalor[3],
								   "direccion"=>$Cvalor[4],
								   "razonSocial"=>$Cvalor[5],
								   "ciudad"=>$Cvalor[6],
								   );
				$respuesta = ModeloClientes::mdlCargarCliente($tabla, $datos);				   	
				}
				
				if ($respuesta == "ok") {

					echo'<script>
					swal({
						type: "success",
						title: "Los clientes han sido cargados correctamente",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"
						}).then(function(result){
							if (result.value) {
								window.location = "clientes";
							}
						})
					</script>';
					
				} else {
					echo'<script>
					swal({
						type: "error",
						title: "Los clientes no pudieron ser registrados, intentelo nuevamente",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"
						}).then(function(result){
							if (result.value) {
								window.location = "clientes";
							}
						})
					</script>';
				}
				

			} else {
				echo "No hay copia";
			}
			
		} else {
			# code...
		}
		
	}

}

