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
			 TRAEMOS LA IMAGEN
			 =============================================*/ 

			if (!$productos[$i]["imagen"]) {
				$imagen = "<center><img src='views/img/productos/default/anonymous.png' width='40px'></center>";
			} else {
				$imagen = "<center><img src='".$productos[$i]["imagen"]."' width='40px'></center>";
			}
						  
			/*=============================================
 	 		TRAEMOS EL PROVEEDOR
  			=============================================*/ 
			
			//$item = "id";
		  	//$valor = $productos[$i]["id_proveedores"];
		  	//$proveedor = ControladorProveedor::ctrMostrarProveedor($item, $valor);

			/*=============================================
 	 		TRAEMOS LA CATEGORIA
  			=============================================*/ 

		  	$item = "id";
		  	$valor = $productos[$i]["id_categoria"];
		  	$categorias = ControladorCategorias::ctrMostrarCategorias($item, $valor);
			
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

			 /*=============================================
			 TRAEMOS LAS ACCIONES
			 =============================================*/ 

			 $botones =  "<div class='btn-group'><button class='btn btn-primary agregarProducto recuperarBoton' idProducto='".$productos[$i]["id"]."'>Agregar</button></div>"; 
			 $datosJson .='[
				 "'.($i+1).'",
				 "'.$imagen.'",
				 "'.$productos[$i]["codigo"].'",
				 "'.$productos[$i]["descripcion"].'",
				 "'.$categorias["categoria"].'",
				 "'.$stock.'",
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



