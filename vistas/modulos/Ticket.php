<?php

  if($_SESSION["perfil"] == "Especial"){
    echo '<script>
      window.location = "inicio";
    </script>';
    return;
  }
?>

<div class="content-wrapper">
  <section class="content-header">
    <h1>
      Administrar ventas
    </h1>

    <ol class="breadcrumb">
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li><a href="" data-target="#PreguntaUsuario" data-toggle="modal"><i class="fa fa-question"></i>Informacíon</a></li>
      <li>Fecha del Sistema:
          <script> 
              var mydate=new Date(); 
              var year=mydate.getYear(); 
                if (year < 1000) 
                year+=1900; 
                var day=mydate.getDay(); 
                var month=mydate.getMonth()+1; 
                if (month<10) 
                month="0"+month; 
                var daym=mydate.getDate(); 
                if (daym<10) 
                daym="0"+daym; 
                document.write("<small><font color='000000' face='Arial'><b>"+daym+"/"+month+"/"+year+"</b></font></small>") 
          </script> 
      </li>
      <li class="active">Administrar ventas</li>
    </ol>
  </section>

  <section class="content">
    <div class="box">
      <div class="box-header with-border">
        <a href="crear-venta">
          <button class="btn btn-primary">
            Agregar venta
          </button>
        </a>

         <button type="button" class="btn btn-default pull-right" id="daterange-btn">
            <span>
              <i class="fa fa-calendar"></i> Rango de fecha
            </span>
            <i class="fa fa-caret-down"></i>
         </button>
      </div>

      <div class="box-body">
       <table class="table table-bordered table-striped dt-responsive tablas" width="100%">
        <thead>
         <tr>
           <th style="width:10px">#</th>
           <th>Código factura</th>
           <th>Cliente</th>
           <th>Vendedor</th>
           <th>Forma de pago</th>
           <th>Neto</th>
           <th>Total</th> 
           <th>Fecha</th>
           <th>Acciones</th>
         </tr> 
        </thead>
        <tbody>

        <?php

          if(isset($_GET["fechaInicial"])){

            $fechaInicial = $_GET["fechaInicial"];
            $fechaFinal = $_GET["fechaFinal"];

          }else{

            $fechaInicial = null;
            $fechaFinal = null;

          }

          $respuesta = ControladorVentas::ctrRangoFechasVentas($fechaInicial, $fechaFinal);

          foreach ($respuesta as $key => $value) {
           
           echo '<tr>

                  <td>'.($key+1).'</td>
                  <td>'.$value["codigo"].'</td>';

                  $itemCliente = "id";
                  $valorCliente = $value["id_cliente"];
                  $respuestaCliente = ControladorClientes::ctrMostrarClientes($itemCliente, $valorCliente);

                  echo '<td>'.$respuestaCliente["nombre"].'</td>';

                  $itemUsuario = "id";
                  $valorUsuario = $value["id_vendedor"];
                  $respuestaUsuario = ControladorUsuarios::ctrMostrarUsuarios($itemUsuario, $valorUsuario);

                  echo '<td>'.$respuestaUsuario["nombre"].'</td>

                  <td>'.$value["metodo_pago"].'</td>
                  <td>$ '.number_format($value["neto"],2).'</td>
                  <td>$ '.number_format($value["total"],2).'</td>
                  <td>'.$value["fecha"].'</td>
                  <td>

                    <div class="btn-group">
                      <button class="btn btn-info btnImprimirFacturaTicket" codigoVenta="'.$value["codigo"].'">
                        <i class="fa fa-print"></i>
                      </button>';

                      if($_SESSION["perfil"] == "Administrador"){
                      echo '<button class="btn btn-warning btnEditarVenta" idVenta="'.$value["id"].'"><i class="fa fa-pencil"></i></button>';

                    }

                    echo '</div>  
                  </td>
                </tr>';
            }
        ?>
               
        </tbody>
       </table>

      <?php
      $eliminarVenta = new ControladorVentas();
      $eliminarVenta -> ctrEliminarVenta();
      ?>
       
      </div>
    </div>

    <div class="modal" id="PreguntaUsuario">
      <div class="modal-dialog">
        <div class="modal-content">

          <div class="modal-header" style="background:#22806d; color:white">
            <h4 class="modal-title">Para que Funciona esto</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>

          <div class="modal-body">
              <div class="timeline-item">
                    <span class="time"><i class="fa fa-clock-o"></i> 8 de Noviembre del 2018</span>
                      <h3 class="timeline-header text-center">Crear Cotización</h3>
                    <div class="timeline-body">
                      <video width="400" controls>
                        <source src="vistas/img/video/tutorial1.mp4" type="video/mp4">
                      </video>
                      
                      <br><br>
                    </div>
                    <div class="timeline-footer">
                      <h4>De esta forma se puede realizar la Cotización</h4>
                    </div>
                </div>
          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-info" data-dismiss="modal">Cerrar</button>
          </div>

        </div>
      </div>
    </div>

  </section>
</div>




