<?php

require_once "conexion.php";

class ModeloConfig{

	/*=============================================
	MOSTRAR CONFIGURACIÓN
	=============================================*/

	static public function mdlMostrarConfig($tabla, $item, $valor){

		if($item != null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");
			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);
			$stmt -> execute();
			return $stmt -> fetch();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");
			$stmt -> execute();
			return $stmt -> fetchAll();

		}

		$stmt -> close();
		$stmt = null;

	}

	/*=============================================
	EDITAR CONFIGURACIÓN
	=============================================*/

	static public function mdlEditarConfig($tabla, $datos){
	
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET nombre = :nombre, nit = :nit, iva = :iva, telefono = :telefono, correo = :correo, direccion = :direccion, adicional = :adicional, Ciudad = :Ciudad, fotoconfig = :fotoconfig WHERE NomPos = :NomPos");
		$stmt->bindParam(":NomPos", $datos["NomPos"], PDO::PARAM_STR);
		$stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
		$stmt->bindParam(":nit", $datos["nit"], PDO::PARAM_STR);
		$stmt->bindParam(":iva", $datos["iva"], PDO::PARAM_INT);
		$stmt->bindParam(":telefono", $datos["telefono"], PDO::PARAM_INT);
		$stmt->bindParam(":correo", $datos["correo"], PDO::PARAM_STR);
        $stmt->bindParam(":direccion", $datos["direccion"], PDO::PARAM_STR);
		$stmt->bindParam(":adicional", $datos["adicional"], PDO::PARAM_STR);
		$stmt->bindParam(":Ciudad", $datos["Ciudad"], PDO::PARAM_STR);
		$stmt->bindParam(":fotoconfig", $datos["fotoconfig"], PDO::PARAM_STR);
		
		if($stmt -> execute()){
			return "ok";
		}else{
			return "error";	
		}

		$stmt -> close();
		$stmt = null;

	}


}

