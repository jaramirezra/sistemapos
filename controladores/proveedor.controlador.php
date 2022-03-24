<?php

class ControladorProveedor{

	/*=============================================
	CREAR PROVEEDOR
	=============================================*/

	static public function ctrCrearProveedor(){

		if(isset($_POST["nuevoCodigo"])){

			if(preg_match('/^[A-Z0-9]+$/', $_POST["nuevoCodigo"]) &&
			   preg_match('/^[0-9]+$/', $_POST["nuevoNit"]) &&
			   preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoNombre"]) && 
			   preg_match('/^[()\-0-9 ]+$/', $_POST["nuevoContacto"]) &&
			   preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoCargo"]) &&
			   preg_match('/^[#\.\-a-zA-Z0-9 ]+$/', $_POST["nuevoDireccion"]) &&
			   preg_match('/^[()\-0-9 ]+$/', $_POST["nuevoTelefono"]) &&
			   preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoSuministro"]) &&
			   preg_match('/^[#\.\-a-zA-Z0-9 ]+$/', $_POST["nuevoWeb"]) 
			   ){

			   	$tabla = "proveedores";
				$datos = array("codigo"=>$_POST["nuevoCodigo"],
							   "nit"=>$_POST["nuevoNit"],
							   "nombre"=>$_POST["nuevoNombre"],
							   "contacto"=>$_POST["nuevoContacto"],
							   "cargo"=>$_POST["nuevoCargo"],
							   "direccion"=>$_POST["nuevoDireccion"],
							   "telefono"=>$_POST["nuevoTelefono"],
							   "suministro"=>$_POST["nuevoSuministro"],
							   "web"=>$_POST["nuevoWeb"]);
				
				/* var_dump($datos); */
						   
			   	$respuesta = ModeloProveedor::mdlIngresarProveedor($tabla, $datos);

			   	if($respuesta == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "El Proveedor ha sido guardado correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "proveedores";

									}
								})

					</script>';

				}

			   }else{

				echo'<script>

					swal({
						  type: "error",
						  title: "¡El Proveedor no puede ir vacío o llevar caracteres especiales!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "proveedores";

							}
						})

			  	</script>';



			}

		}

	}

	/*=============================================
	MOSTRAR PROVEEDOR
	=============================================*/

	static public function ctrMostrarProveedor($item, $valor){

		$tabla = "proveedores";
		$respuesta = ModeloProveedor::mdlMostrarProveedor($tabla, $item, $valor);
		return $respuesta;

	}

	/*=============================================
	EDITAR PROVEEDOR
	=============================================*/

	static public function ctrEditarProveedor(){

		if(isset($_POST["editarCodigos"])){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarCodigos"]) &&
			   preg_match('/^[()\-0-9 ]+$/', $_POST["editarNit"]) &&
			   preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarNombres"]) && 
			   preg_match('/^[()\-0-9 ]+$/', $_POST["editarContacto"]) &&
			   preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarCargo"]) &&
			   preg_match('/^[#\.\-a-zA-Z0-9 ]+$/', $_POST["editarDirecciones"]) &&
			   preg_match('/^[()\-0-9 ]+$/', $_POST["editarTelefono"]) &&
			   preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["ediatarSuministro"]) &&
			   preg_match('/^[#\.\-a-zA-Z0-9 ]+$/', $_POST["ediatarWeb"]) 
			   ){

			   	$tabla = "proveedores";
			   	$datos = array("id"=>$_POST["idProveedor"],
					   		   "codigo"=>$_POST["editarCodigos"],
							   "nit"=>$_POST["editarNit"],
							   "nombre"=>$_POST["editarNombres"],
							   "contacto"=>$_POST["editarContacto"],
							   "cargo"=>$_POST["editarCargo"],
							   "direccion"=>$_POST["editarDirecciones"],
							   "telefono"=>$_POST["editarTelefono"],
							   "suministro"=>$_POST["ediatarSuministro"],
							   "web"=>$_POST["ediatarWeb"]);

			   	$respuesta = ModeloProveedor::mdlEditarProveedor($tabla, $datos);

			
			   	if($respuesta == "ok"){

					echo'<script>
						swal({
							type: "success",
							title: "El Proveedor ha sido cambiado correctamente",
							showConfirmButton: true,
							confirmButtonText: "Cerrar"
							}).then(function(result){
										if (result.value) {

										window.location = "proveedores";

										}
									})
						</script>';

				}

			}else{

				echo'<script>

						swal({
							type: "error",
							title: "¡El Proveedor no puede ir vacío o llevar caracteres especiales!",
							showConfirmButton: true,
							confirmButtonText: "Cerrar"
							}).then(function(result){
								if (result.value) {

								window.location = "proveedores";

								}
							})

					</script>';



			}

		}

	}

	/*=============================================
	ELIMINAR PROVVEDOR
	=============================================*/

	static public function ctrEliminarProveedor(){

		if(isset($_GET["idProveedor"])){

			$tabla ="proveedores";
			$datos = $_GET["idProveedor"];
			$respuesta = ModeloProveedor::mdlEliminarProveedor($tabla, $datos);

			if($respuesta == "ok"){

				echo'<script>

					swal({
						type: "success",
						title: "El proveedor ha sido borrado correctamente",
						showConfirmButton: true,
						confirmButtonText: "Cerrar",
						closeOnConfirm: false
						}).then(function(result){
									if (result.value) {

									window.location = "proveedores";

									}
								})

					</script>';

			}else{
				
				echo'<script>

					swal({
						type: "error",
						title: "El proveedor ha tenido problemas para eliminar intente nuevamente",
						showConfirmButton: true,
						confirmButtonText: "Cerrar",
						closeOnConfirm: false
						}).then(function(result){
									if (result.value) {

									window.location = "proveedores";

									}
								})

					</script>';
			}		

		}

	}

	/*=============================================
	IMPORTAR PROVEEDORES
	=============================================*/

	static public function ctrCargarProveedores(){
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
					$tabla = "proveedores";
					$datos = array("codigo"=>$Cvalor[0],
								   "nit"=>$Cvalor[1],
								   "nombre"=>$Cvalor[2],
								   "contacto"=>$Cvalor[3],
								   "cargo"=>$Cvalor[4],
								   "direccion"=>$Cvalor[5],
								   "telefono"=>$Cvalor[6],
								   "suministro"=>$Cvalor[7],
								   "web"=>$Cvalor[8]
								   );
				$respuesta = ModeloProveedor::mdlCargarProveedores($tabla, $datos);				   	
				}
				if ($respuesta == "ok") {
					echo '<script>
							swal({
								type: "success",
								title: "Los proveedores han sido cargados correctamente",
								showConfirmButton: true,
								confirmButtonText: "Cerrar",
								closeOnConfirm: false
								}).then(function(result){
									if (result.value) {
										window.location = "proveedores";
									}
								})
						</script>';
				} else {
					echo '<script>
							swal({
								type: "error",
								title: "Los proveedores no pudieron ser registrodos, intentelo nuevamente",
								showConfirmButton: true,
								confirmButtonText: "Cerrar",
								closeOnConfirm: false
								}).then(function(result){
									if (result.value) {
										window.location = "proveedores";
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

