<?php

require_once "../controladores/proveedor.controlador.php";
require_once "../modelos/proveedor.modelo.php";

class AjaxProveedor{

	/*=============================================
	EDITAR CLIENTE
	=============================================*/	

	public $idProveedor;
	public function ajaxEditarProveedor(){
		$item = "id";
		$valor = $this->idProveedor;
		$respuesta = ControladorProveedor::ctrMostrarProveedor($item, $valor);
		echo json_encode($respuesta);
	}

}

/*=============================================
EDITAR CLIENTE
=============================================*/	

if(isset($_POST["idProveedor"])){
	$cliente = new AjaxProveedor();
	$cliente -> idProveedor = $_POST["idProveedor"];
	$cliente -> ajaxEditarProveedor();
}