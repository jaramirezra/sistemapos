
<div class="content-wrapper">
  <section class="content-header">
    <h1>
      Tablero
      <small>Panel de Control</small>
    </h1>
    
    <script type="text/javascript">
          $(document).ready(function(){
            $.CrystalNotification({
              position: 4, 
              title: "Bienvenido al sistema pos",
              image: "vistas/plugins/Crystal-Notification-v2/img/Colorfull/icono-pos.png",
              content: "Sesión Iniciada correctamente",
            });
            
          });
    </script>
    
    <ol class="breadcrumb">
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li><a href="" data-target="#Preg" data-toggle="modal"><i class="fa fa-question"></i>Informacíon</a></li>
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
      <li class="active">Tablero</li>
    </ol>

  </section>
  <section class="content">
    <div class="row">
      
    <?php

    if($_SESSION["perfil"] =="Administrador"){
        include "inicio/cajas-superiores.php";
    }

    ?>

    </div> 
     <div class="row">
        <div class="col-lg-12">

          <?php
          if($_SESSION["perfil"] =="Administrador"){
           include "reportes/grafico-ventas.php";
          }
          ?>

        </div>

        <div class="col-lg-12">

        <?php
        if($_SESSION["perfil"] =="Administrador"){
        include "reportes/grafico-Vendedor.php";
        }
        ?>

        </div>

        <div class="col-lg-6">
            
          <?php

          if($_SESSION["perfil"] =="Administrador"){
            include "reportes/productos-mas-vendidos.php";
         }

          ?>

        </div>
         <div class="col-lg-6">

          <?php

          if($_SESSION["perfil"] =="Administrador"){
            include "inicio/productos-recientes.php";
         }

          ?>

        </div>
         <div class="col-lg-12">
           
          <?php

          if($_SESSION["perfil"] =="Especial" || $_SESSION["perfil"] =="Vendedor"){
            include "usuario-especiales.php";
          }

          ?>

         </div>
     </div>
  </section>
</div>


<div class="modal" id="Preg">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header" style="background:#22806D; color:white">
        <h4 class="modal-title">Para que Funciona esto</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <div class="modal-body">
          <div class="timeline-item">
                <span class="time"><i class="fa fa-clock-o"></i> 8 de Noviembre del 2018</span>
                  <h3 class="timeline-header">Dudas y Preguntas</h3>
                <div class="timeline-body">
                  <br><br>
                </div>
                <div class="timeline-footer">
                  <h4>Cada vez que veas este símbolo podrás darle clic para saber cual es la funcionalidad y saber información de su uso.</h4>
                </div>
            </div>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-info" data-dismiss="modal">Cerrar</button>
      </div>

    </div>
  </div>
</div>