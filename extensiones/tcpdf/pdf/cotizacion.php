<?php

require_once "../../../controladores/preventa.controlador.php";
require_once "../../../modelos/preventa.modelo.php";

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
$respuestaVenta = ControladorPreventa::ctrMostrarPreventa($itemVenta, $valorVenta);

$fecha = substr($respuestaVenta["fecha"],0,-8);
$productos = json_decode($respuestaVenta["productos"], true);
$neto = number_format($respuestaVenta["neto"],2);
$impuesto = number_format($respuestaVenta["impuesto"],2);
$total = number_format($respuestaVenta["total"],2);
$notas = $respuestaVenta["notas"];


//INFORMACIÓN DEL CLIENTE

$itemCliente = "id";
$valorCliente = $respuestaVenta["id_cliente"];
$respuestaCliente = ControladorClientes::ctrMostrarClientes($itemCliente, $valorCliente);

//INFORMACIÓN DEL VENDEDOR

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
    $email = $value["correo"];
    $iva = $value["iva"];	
    $Ciudad = $value["Ciudad"];
}

//REQUERIMOS LA CLASE TCPDF

require_once('tcpdf_include.php');

$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

$pdf->startPageGroup();
$pdf->AddPage();


// ---------------------------------------------------------

$bloque1 = <<<EOF

	<table>
		<tr>
			<td style="width:150px"><img src="img/$nit.png"></td>
			<td style="background-color:white; width:140px">
				<div style="font-size:8.5px; text-align:right; line-height:15px;">
					
					<br>
					NIT: $nit
					<br>
					Dirección: $direccion

				</div>
			</td>

			<td style="background-color:white; width:140px">
				<div style="font-size:8.5px; text-align:right; line-height:15px;">
					
					<br>
					Teléfono: $telefono
					<br>
					$email
				</div>
			</td>
            <td style="background-color:white; width:110px; text-align:center; color:red"><br><br>COTIZACION N.<br>$valorVenta</td>
		</tr>
	</table>

EOF;

$pdf->writeHTML($bloque1, false, false, false, false, '');

// ---------------------------------------------------------

$bloque2 = <<<EOF

	<table>
		<tr>
			<td style="width:540px"><img src="images/back.jpg"></td>
		</tr>
	</table>

	<table style="font-size:10px; padding:5px 10px;">
		<tr>
			<td style="border: 1px solid #666; background-color:white; width:200,5px">Razón Socal: $respuestaCliente[nombre]</td>
            <td style="border: 1px solid #666; background-color:white; width:146,9px">NIT: $respuestaCliente[documento]</td>
			<td style="border: 1px solid #666; background-color:white; width:194,5px;">Ciudad: $Ciudad</td>
		</tr>

		<tr>
            <td style="border: 1px solid #666; background-color:white; width:200,5px">Dirección: $respuestaCliente[direccion]</td>
            <td style="border: 1px solid #666; background-color:white; width:146,9px">Teléfono: $respuestaCliente[telefono]</td>
            <td style="border: 1px solid #666; background-color:white; width:194,5px;">Correo: $respuestaCliente[email]</td>
		</tr>

    </table>
    <br><br><br>

EOF;

$pdf->writeHTML($bloque2, false, false, false, false, '');

// ---------------------------------------------------------

$bloque3 = <<<EOF

	<table style="font-size:10px; padding:2px 5px;">
		<tr>
			<td style="border: 1px solid #666; background-color:white; width:44,218px; text-align:center">CANT</td>
            <td style="border: 1px solid #666; background-color:white; width:316,141px;">DESCRIPCIÓN</td>
            <td style="border: 1px solid #666; background-color:white; width:37px; text-align:center">IVA</td>
			<td style="border: 1px solid #666; background-color:white; width:80,583px; text-align:center">VLR. UNITARIO</td>
			<td style="border: 1px solid #666; background-color:white; width:64,083px; text-align:center">VLR. TOTAL</td>
		</tr>
	</table>

EOF;

$pdf->writeHTML($bloque3, false, false, false, false, '');

// ---------------------------------------------------------

foreach ($productos as $key => $item) {

$itemProducto = "descripcion";
$valorProducto = $item["descripcion"];
$orden = null;

$respuestaProducto = ControladorProductos::ctrMostrarProductos($itemProducto, $valorProducto, $orden);
$valorUnitario = number_format($respuestaProducto["precio_venta"], 2);
$precioTotal = number_format($item["total"], 2);

$bloque4 = <<<EOF

	<table style="font-size:10px; padding:2px 5px;">
		<tr>
			<td style="border: 1px solid #666; color:#333; background-color:white; width:44,218px; text-align:center">
				$item[cantidad]
			</td>

			<td style="border: 1px solid #666; color:#333; background-color:white; width:316,141px">
                $item[descripcion] 
			</td>

			<td style="border: 1px solid #666; color:#333; background-color:white; width:37px; text-align:center"> 
				$iva%
			</td>

			<td style="border: 1px solid #666; color:#333; background-color:white; width:80,583px; text-align:center">$ 
				$precioTotal
            </td>
            
            <td style="border: 1px solid #666; color:#333; background-color:white; width:64,083px; text-align:center">$ 
            $precioTotal
            </td>

		</tr>
	</table>


EOF;

$pdf->writeHTML($bloque4, false, false, false, false, '');

}

// ---------------------------------------------------------

$bloque5 = <<<EOF
<br><br>
<table style="font-size:10px; padding:2px 5px;">
    <tr>
        <label>Notas</label>
        <br>
        <td style="border: 1px solid #666; color:#333; background-color:white; width:250; text-align:left">
            $notas
        </td>
    </tr>
</table>

EOF;

$pdf->writeHTML($bloque5, false, false, false, false, '');

// ---------------------------------------------------------

$bloque6 = <<<EOF

	<table style="font-size:10px; padding:5px 10px;">
		<tr>
			<td style="color:#333; background-color:white; width:340px; text-align:center"></td>
			<td style="border-bottom: 1px solid #666; background-color:white; width:100px; text-align:center"></td>
			<td style="border-bottom: 1px solid #666; color:#333; background-color:white; width:100px; text-align:center"></td>
		</tr>
		
		<tr>
			<td style="border-right: 1px solid #666; color:#333; background-color:white; width:340px; text-align:center"></td>
			<td style="border: 1px solid #666;  background-color:white; width:100px; text-align:center">
				Neto:
			</td>
			<td style="border: 1px solid #666; color:#333; background-color:white; width:100px; text-align:center">
				$ $neto
			</td>
		</tr>

		<tr>
			<td style="border-right: 1px solid #666; color:#333; background-color:white; width:340px; text-align:center"></td>
			<td style="border: 1px solid #666; background-color:white; width:100px; text-align:center">
				Impuesto:
			</td>
			<td style="border: 1px solid #666; color:#333; background-color:white; width:100px; text-align:center">
				$ $impuesto
			</td>
		</tr>

		<tr>
			<td style="border-right: 1px solid #666; color:#333; background-color:white; width:340px; text-align:center"></td>
			<td style="border: 1px solid #666; background-color:white; width:100px; text-align:center">
				Total:
			</td>
			<td style="border: 1px solid #666; color:#333; background-color:white; width:100px; text-align:center">
				$ $total
			</td>
		</tr>
	</table>

EOF;

$pdf->writeHTML($bloque6, false, false, false, false, '');

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