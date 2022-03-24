<?php

require_once "../../../controladores/ventas.controlador.php";
require_once "../../../modelos/ventas.modelo.php";

require_once "../../../controladores/clientes.controlador.php";
require_once "../../../modelos/clientes.modelo.php";

require_once "../../../controladores/usuarios.controlador.php";
require_once "../../../modelos/usuarios.modelo.php";

require_once "../../../controladores/productos.controlador.php";
require_once "../../../modelos/productos.modelo.php";

require_once "../../../controladores/config.controlador.php";
require_once "../../../modelos/config.modelo.php";

class imprimirFactura{

public $codigo;

public function traerImpresionFactura(){

//TRAEMOS LA INFORMACIÓN DE LA VENTA

$itemVenta = "codigo";
$valorVenta = $this->codigo;
$respuestaVenta = ControladorVentas::ctrMostrarVentas($itemVenta, $valorVenta);

$fecha = substr($respuestaVenta["fecha"],0,-8);
$productos = json_decode($respuestaVenta["productos"], true);
$neto = number_format($respuestaVenta["neto"],2);
$impuesto = number_format($respuestaVenta["impuesto"],2);
$total = number_format($respuestaVenta["total"],2);

//TRAEMOS LA INFORMACIÓN DEL CLIENTE

$itemCliente = "id";
$valorCliente = $respuestaVenta["id_cliente"];
$respuestaCliente = ControladorClientes::ctrMostrarClientes($itemCliente, $valorCliente);

//TRAEMOS LA INFORMACIÓN DEL VENDEDOR

$itemVendedor = "id";
$valorVendedor = $respuestaVenta["id_vendedor"];
$respuestaVendedor = ControladorUsuarios::ctrMostrarUsuarios($itemVendedor, $valorVendedor);

//INFORMACIÓN DE LA CONFIGURACION
$item = null;
$valor = null;
$config = ControladorConfig::ctrMostrarConfig($item, $valor);
foreach ($config as $key => $value) {
	$nombre = $value["nombre"];
	$nit = $value["nit"];
	$direccion = $value["direccion"];
	$telefono = $value["telefono"]; 
	$iva = $value["iva"];		
}

//REQUERIMOS LA CLASE TCPDF

require_once('tcpdf_include.php');

$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);

$pdf->AddPage('P', 'A7');

//---------------------------------------------------------

$bloque1 = <<<EOF

<table style="font-size:7px; text-align:center">
	<img src="img/$nit.png" style="width:100px">
	<br><br>
	<tr>
		
		<td style="width:160px;">
			<div>
				Fecha: $fecha
				<br><br>
				$nombre
				
				<br>
				NIT: $nit

				<br>
				Dirección: $direccion

				<br>
				Teléfono: $telefono

				<br>
				FACTURA N.$valorVenta

				<br><br>					
				Cliente: $respuestaCliente[nombre]

				<br>
				Vendedor: $respuestaVendedor[nombre]
				<br>
			</div>
		</td>
	</tr>
</table>

<table style="font-size:8px; text-align:left">
	<tr>
		<td style="width:160px;">
		--------------------------------------------------------
		</td>
	</tr>
</table>

<table style="font-size:6px;">
	<tr>
		<td style="text-align:left">
		DESCRIPCION
		</td>

		<td style="text-align:center">
		CANT
		</td>

		<td style="text-align:right">
		VALOR
		</td>
	</tr>
</table>



EOF;

$pdf->writeHTML($bloque1, false, false, false, false, '');

// ---------------------------------------------------------


foreach ($productos as $key => $item) {

$valorUnitario = number_format($item["precio"], 2);

$precioTotal = number_format($item["total"], 2);

$bloque2 = <<<EOF

<table style="font-size:6px;">
	<tr>
		<td style="text-align:left">
		$item[descripcion]
		</td>
		<td style="text-align:center">
		$item[cantidad]
		</td>
		<td style="text-align:right">
		$ $valorUnitario
		</td>
		
	</tr>
</table>

EOF;

$pdf->writeHTML($bloque2, false, false, false, false, '');

}

// ---------------------------------------------------------

$bloque3 = <<<EOF

<table style="font-size:6px; text-align:left">
	<br><br>
	<tr>
		<td style="width:160px;">
			============================================
		</td>
	</tr>
	<br>
	<tr>
		<td style="width:80px;">
			 SUBTOTAL: 
		</td>
		<td style="width:80px;">
			$ $neto
		</td>
	</tr>

	<tr>
		<td style="width:80px;">
			 TOTAL: 
		</td>
		<td style="width:80px;">
			$ $total
		</td>
	</tr>

	<tr>
		<td style="width:80px;">
			IVA INCLUIDO DEL: $iva% 
		</td>
		<td style="width:80px;">
			$ $impuesto
		</td>
	</tr>



</table>

<table style="font-size:8px; text-align:center">
	<br><br><br>
	<tr>
		<td style="width:160px;" >
			Gracias por su compra
		</td>
	</tr>
</table>

EOF;

$pdf->writeHTML($bloque3, false, false, false, false, '');

// ---------------------------------------------------------
//SALIDA DEL ARCHIVO 

//$pdf->Output('factura.pdf', 'D');
$pdf->Output('factura.pdf');

}

}

$factura = new imprimirFactura();
$factura -> codigo = $_GET["codigo"];
$factura -> traerImpresionFactura();

?>