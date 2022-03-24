<?php

$item = null;
$valor = null;

$ventas = ControladorVentas::ctrMostrarVentas($item, $valor);
$usuarios = ControladorUsuarios::ctrMostrarUsuarios($item, $valor);

$arrayVendedores = array();
$arraylistaVendedores = array();

foreach ($ventas as $key => $valueVentas) {
  foreach ($usuarios as $key => $valueUsuarios) {

    if($valueUsuarios["id"] == $valueVentas["id_vendedor"]){

        #Capturamos los vendedores en un array
        array_push($arrayVendedores, $valueUsuarios["nombre"]);

        #Capturamos las nombres y los valores netos en un mismo array
        $arraylistaVendedores = array($valueUsuarios["nombre"] => $valueVentas["neto"]);

         #Sumamos los netos de cada vendedor

        foreach ($arraylistaVendedores as $key => $value) {

            $sumaTotalVendedores[$key] += $value;

         }
    }
  
  }

}

#Evitamos repetir nombre
$noRepetirNombres = array_unique($arrayVendedores);

?>


<!--===============================================
GRAFICOS DE VENTAS MES
===============================================-->
<div class="box box-solid bg-teal-gradient">
	<div class="box-header">
      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
      <i class="fa fa-th"></i><h3 class="box-title">Gráfico de Ventas por Vendedor</h3>
	</div>

	<div class="box-body border-radius-none nuevoGraficoVentas">
		<div class="chart" id="bar-chart1" style="height: 300px;"></div>
  </div>
</div>


<script>
	
    //BAR CHART
    var bar = new Morris.Bar({
    element: 'bar-chart1',
    resize: true,
    data: [

    <?php
        
        foreach($noRepetirNombres as $value){

        echo "{y: '".$value."', a: '".$sumaTotalVendedores[$value]."'},";

        }

    ?>
    ],
    barColors: ['#D5D5D5'],
    gridTextColor: '#fff',
    xkey: 'y',
    ykeys: ['a'],
    labels: ['ventas'],
    preUnits: '$',
    hideHover: 'auto'
    });

</script>