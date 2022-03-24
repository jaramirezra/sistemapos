<?php

require_once "../controladores/productos.controlador.php";
require_once "../modelos/productos.modelo.php";

require_once "../controladores/categorias.controlador.php";
require_once "../modelos/categorias.modelo.php";

require_once "../controladores/proveedor.controlador.php";
require_once "../modelos/proveedor.modelo.php";

class TablaProductos{

	/*=============================================
	 MOSTRAR LA TABLA DE PRODUCTOS
	 =============================================*/ 

   public function mostrarTablaProducto(){

	   $item = null;
	   $valor = null;
	   $orden = "id";
	   $productos = ControladorProductos::ctrMostrarProductos($item, $valor, $orden);
		
		if(count($productos) == 0){
			echo '{"data": []}';
			return;
		}	
	   
		$datosJson = '{
		"data": [';
  
		for($i = 0; $i < count($productos); $i++){

			/*=============================================
 	 		TRAEMOS LA CATEGORIA
  			=============================================*/ 
		  	$item = "id";
		  	$valor = $productos[$i]["id_categoria"];
		  	$categorias = ControladorCategorias::ctrMostrarUnaCategorias($item, $valor);
			
			/*=============================================
 	 		TRAEMOS EL PROVEEDOR
  			=============================================*/ 
			$item = "id";
		  	$valor = $productos[$i]["id_proveedores"];
		  	$proveedor = ControladorProveedor::ctrMostrarUnProveedor($item, $valor);

			/*=============================================
			TRAEMOS LA IMAGEN
			=============================================*/ 
			if (!$productos[$i]["imagen"]) {
				$imagen = "<center><img src='views/img/productos/default/anonymous.png' width='40px'></center>";
			} else {
				$imagen = "<center><img src='".$productos[$i]["imagen"]."' width='40px'></center>";
			}

			/*=============================================
			STOCK
			=============================================*/ 
			 if($productos[$i]["stock"] <= 10){
				$stock = "<button class='btn btn-danger'>".$productos[$i]["stock"]."</button>";
				}else if($productos[$i]["stock"] > 11 && $productos[$i]["stock"] <= 29){
				$stock = "<button class='btn btn-warning'>".$productos[$i]["stock"]."</button>";
				}else{
				$stock = "<button class='btn btn-success'>".$productos[$i]["stock"]."</button>";
			}
			$botones =  "<div class='btn-group'><button class='btn btn-info'>Ver</button></div>"; 
			$datosJson .='[
				"'.($i+1).'",
				"'.$categorias.'",
				"'.$proveedor.'",
				"'.$productos[$i]["codigo"].'",
				"'.$productos[$i]["descripcion"].'",
				"'.$imagen.'",
				"'.$stock.'",
				"$'.$productos[$i]["precio_venta"].'",
				"'.$botones.'"
			],';
		}
  
		$datosJson = substr($datosJson, 0, -1);
		$datosJson .=   '] 
  
		}';
		  
		echo $datosJson;
   }

}

/*=============================================
ACTIVAR TABLA DE PRODUCTOS
=============================================*/ 
$activarProductosPreVenta = new TablaProductos();
$activarProductosPreVenta -> mostrarTablaProducto();



