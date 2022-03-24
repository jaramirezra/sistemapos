<?php

if($_SESSION["perfil"] == "Especial" || $_SESSION["perfil"] == "Vendedor"){

  echo '<script>
          window.location = "inicio";
        </script>';
  return;
}

?>

<div class="content-wrapper">
  <section class="content-header">
    <h1>
      Reportes de ventas
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
      <li class="active">Reportes de ventas</li>
    </ol>

  </section>

  <section class="content">
    <div class="box">
      <div class="box-header with-border">
        <div class="input-group">
          <button type="button" class="btn btn-default" id="daterange-btn2">
            <span>
              <i class="fa fa-calendar"></i> Rango de fecha
            </span>
            <i class="fa fa-caret-down"></i>
          </button>
        </div>
        <div class="box-tools pull-right">

        <?php

        if(isset($_GET["fechaInicial"])){

          echo '<a href="vistas/modulos/descargar-reporte.php?reporte=reporte&fechaInicial='.$_GET["fechaInicial"].'&fechaFinal='.$_GET["fechaFinal"].'">';

        }else{

           echo '<a href="vistas/modulos/descargar-reporte.php?reporte=reporte">';

        }         

        ?>
           
           <button class="btn btn-success" style="margin-top:5px">Descargar reporte en Excel</button>
          </a>
        </div>
      </div>

      <div class="box-body">
        <div class="row">
          <div class="col-xs-12">
            
            <?php
              include "reportes/grafico-ventas.php";
            ?>

          </div>
           <div class="col-md-6 col-xs-12">
             
            <?php
              include "reportes/productos-mas-vendidos.php";
            ?>

           </div>

            <div class="col-md-6 col-xs-12">
             
            <?php
              include "reportes/vendedores.php";
            ?>

           </div>

           <div class="col-md-6 col-xs-12">
             
            <?php

              include "reportes/compradores.php";

            ?>

           </div>

        </div>
      </div>
    </div>
  </section>
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
                  <h3 class="timeline-header text-center">Nuevos Usuarios</h3>
                <div class="timeline-body">
                  <video width="400" controls>
                    <source src="vistas/img/video/tutorial1.mp4" type="video/mp4">
                  </video>
                  
                  <br><br>
                </div>
                <div class="timeline-footer">
                  <h4>Aquí el listado de los Usuarios que han sido recientemente agregados.</h4>
                </div>
            </div>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-info" data-dismiss="modal">Cerrar</button>
      </div>

    </div>
  </div>
</div>