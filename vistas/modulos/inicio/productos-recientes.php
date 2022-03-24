<?php

$item = null;
$valor = null;
$orden = "id";
$productos = ControladorProductos::ctrMostrarProductos($item, $valor, $orden);

 ?>


<div class="box box-primary">
  <div class="box-header with-border">
    <h3 class="box-title">Productos recientemente añadidos</h3>
      <div class="box-tools pull-right">

      <a data-target="#Preguntas5" data-toggle="modal" class="btn btn-box-tool">
       Que es Esto <i class="fa fa-info"></i>
      </a>

      <button type="button" class="btn btn-box-tool" data-widget="collapse">
        <i class="fa fa-minus"></i>
      </button>

      <button type="button" class="btn btn-box-tool" data-widget="remove">
        <i class="fa fa-times"></i>
      </button>

    </div>
  </div>
  
  <div class="box-body">
    <ul class="products-list product-list-in-box">

    <?php

    for($i = 0; $i < 10; $i++){

      echo '<li class="item">
              <div class="product-img">
                <img src="'.$productos[$i]["imagen"].'" alt="Product Image">
              </div>

              <div class="product-info">
                <a href="" class="product-title">
                  '.$productos[$i]["descripcion"].'
                  <span class="label label-warning pull-right">$'.$productos[$i]["precio_venta"].'</span>
                </a>
            </div>
          </li>';

    }

    ?>

    </ul>
  </div>

  <div class="box-footer text-center">
    <a href="productos" class="uppercase">Ver todos los productos</a>
  </div>
</div>


<!--========================================
MODAL DE PREGUNTAS.
========================================-->

<div class="modal" id="Preguntas5">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header" style="background:#00c0ef; color:white">
        <h4 class="modal-title">Para que Funciona esto</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <div class="modal-body">
          <div class="timeline-item">
                <span class="time"><i class="fa fa-clock-o"></i> 8 de Noviembre del 2018</span>
                  <h3 class="timeline-header">Nuevos Productos</h3>
                <div class="timeline-body">
                  <img src="vistas/img/preguntas/recientes.png" class="img-fluid img-thumbnail" alt="">
                  <br><br>
                </div>
                <div class="timeline-footer">
                  <h4>Aquí el listado de los productos que han sido recientemente agregados.</h4>
                </div>
            </div>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-info" data-dismiss="modal">Cerrar</button>
      </div>

    </div>
  </div>
</div>