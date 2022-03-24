<?php

require_once "../controladores/config.controlador.php";
require_once "../modelos/config.modelo.php";

class AjaxConfig{

	/*=============================================
	EDITAR CONFIGURACIÓN
	=============================================*/	

	public $idConfig;
	public function ajaxEditarConfig(){
		$item = "1";
		$valor = $this->idConfig;
		$respuesta = ControladorConfig::ctrMostrarConfig($item, $valor);
		echo json_encode($respuesta);
	}

}

	/*=============================================
	EDITAR CONFIGURACIÓN
	=============================================*/

	if(isset($_POST["idConfig"])){
		$editar = new AjaxConfig();
		$editar -> idConfig = $_POST["idConfig"];
		$editar -> ajaxEditarConfig();
	}

	/*=============================================
	VALIDAR NO REPETIR USUARIO
	=============================================*/

	if(isset( $_POST["validarConfig"])){
		$valUsuario = new AjaxUsuarios();
		$valUsuario -> validarConfig = $_POST["validarConfig"];
		$valUsuario -> ajaxvalidarConfig();
	}