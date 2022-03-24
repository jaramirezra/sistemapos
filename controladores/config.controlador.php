<?php

class ControladorConfig{

	/*=============================================
	MOSTRAR CONFIGURACIÓN
	=============================================*/

	static public function ctrMostrarConfig($item, $valor){

		$tabla = "config";
		$respuesta = ModeloConfig::mdlMostrarConfig($tabla, $item, $valor);
		return $respuesta;
	
	}

	/*=============================================
	EDITAR CONFIGURACIÓN
	=============================================*/

	static public function ctrEditarConfig(){

		if(isset($_POST["Version"])){

				if(preg_match('/^[#\.\-a-zA-Z0-9 ]+$/', $_POST["Version"]) &&
				   preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["NuevoNombre"]) &&
				   preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["EmpresaNueva"]) &&
				   preg_match('/^[0-9]+$/', $_POST["nuevoIva"]) &&
				   preg_match('/^[0-9]+$/', $_POST["nuevoTelefono"]) &&
				   preg_match('/^(([A-Za-z0-9]+_+)|([A-Za-z0-9]+\-+)|([A-Za-z0-9]+\.+)|([A-Za-z0-9]+\++))*[A-Za-z0-9]+@((\w+\-+)|(\w+\.))*\w{1,63}\.[a-zA-Z]{2,6}$/', $_POST["nuevoCorreo"]) && 
				   preg_match('/^[#\.\-a-zA-Z0-9 ]+$/', $_POST["nuevaDireccion"]) &&
				   preg_match('/^[#\.\-a-zA-Z0-9 ]+$/', $_POST["nuevaCiudad"]) &&
				   preg_match('/^[0-9]+$/', $_POST["nuevoCodigo"]) &&
				   preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevosCambios"])){

				/*=============================================
				VALIDAR IMAGEN
				=============================================*/

				$ruta = $_POST["fotoActual"];
	
				if(isset($_FILES["nuevaFoto"]["tmp_name"]) && !empty($_FILES["nuevaFoto"]["tmp_name"])){

					list($ancho, $alto) = getimagesize($_FILES["nuevaFoto"]["tmp_name"]);
					$nuevoAncho = 680;
					$nuevoAlto = 190;

					/*=============================================
					CREAMOS EL DIRECTORIO DONDE VAMOS A GUARDAR LA FOTO DEL USUARIO
					=============================================*/

					$directorio = "vistas/img/config/".$_POST["editarConfig"];

					/*=============================================
					PRIMERO PREGUNTAMOS SI EXISTE OTRA IMAGEN EN LA BD
					=============================================*/

					if(!empty($_POST["nuevaFoto"])){
						unlink($_POST["nuevaFoto"]);
					}else{
						mkdir($directorio, 0755);
					}	

					/*=============================================
					DE ACUERDO AL TIPO DE IMAGEN APLICAMOS LAS FUNCIONES POR DEFECTO DE PHP
					=============================================*/

					if($_FILES["nuevaFoto"]["type"] == "image/jpeg"){

						/*=============================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/

						$aleatorio = mt_rand(100,999);
						$ruta = "extensiones/tcpdf/pdf/img/".$_POST["EmpresaNueva"].".jpg";
						$origen = imagecreatefromjpeg($_FILES["nuevaFoto"]["tmp_name"]);						
						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
						imagejpeg($destino, $ruta);

					}

					if($_FILES["nuevaFoto"]["type"] == "image/png"){

						/*=============================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/

						$aleatorio = mt_rand(100,999);
						$ruta = "extensiones/tcpdf/pdf/img/".$_POST["EmpresaNueva"].".png";
						$origen = imagecreatefrompng($_FILES["nuevaFoto"]["tmp_name"]);						
						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
						imagepng($destino, $ruta);

					}

				}
	
					$tabla = "config";
					 $datos = array("NomPos" => $_POST["Version"],
					 				"nombre" => $_POST["NuevoNombre"],
                          			"nit" => $_POST["EmpresaNueva"],
                          			"iva" => $_POST["nuevoIva"],
                          			"telefono" => $_POST["nuevoTelefono"],
                          			"correo" => $_POST["nuevoCorreo"],
                          			"direccion" => $_POST["nuevaDireccion"],
									"adicional" => $_POST["nuevosCambios"],
									"Ciudad" => $_POST["nuevaCiudad"],
									"codigo" => $_POST["nuevoCodigo"],
                          			"fotoconfig"=>$ruta);
	
					$respuesta = ModeloConfig::mdlEditarConfig($tabla, $datos);
	
					if($respuesta == "ok"){
	
						echo'<script>
	
						swal({
								type: "success",
								title: "La Configuración ha sido editada correctamente",
								showConfirmButton: true,
								confirmButtonText: "Cerrar"
								}).then(function(result) {
										if (result.value) {
											window.location = "config";
										}
									})
	
						</script>';
	
					}
	
	
				}else{
	
					echo'<script>
	
						swal({
								type: "error",
								title: "¡Los campos no puede ir vacío o llevar caracteres especiales!",
								showConfirmButton: true,
								confirmButtonText: "Cerrar"
								}).then(function(result) {
								if (result.value) {
									window.location = "config";
								}
							})
	
						</script>';
	
				}
	
			}
		}
	
}
