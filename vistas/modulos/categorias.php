<?php

if($_SESSION["perfil"] == "Vendedor"){
  echo '<script>
            window.location = "inicio";
        </script>';
  return;
}

?>

<div class="content-wrapper">
  <section class="content-header">
    
    <h1>
      Administrar categorías
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
      <li class="active">Administrar categorías</li>
    </ol>

  </section>
  <section class="content">
    <div class="box">
      <div class="box-header with-border">
        <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarCategoria">
          Agregar categoría
        </button>
      </div>

      <div class="box-body">
       <table class="table table-bordered table-striped dt-responsive tablas" width="100%">
        <thead>
         
         <tr>
           <th style="width:10px">#</th>
           <th>Categoria</th>
           <th>Acciones</th>
         </tr> 

        </thead>

        <tbody>
        <?php

        $item = null;
        $valor = null;
        $categorias = ControladorCategorias::ctrMostrarCategorias($item, $valor);

        foreach ($categorias as $key => $value) {
        
          echo ' <tr>

                  <td>'.($key+1).'</td>
                  <td class="text-uppercase">'.$value["categoria"].'</td>
                  <td>

                    <div class="btn-group">
                      <button class="btn btn-warning btnEditarCategoria" idCategoria="'.$value["id"].'" data-toggle="modal" data-target="#modalEditarCategoria"><i class="fa fa-pencil"></i></button>';

                      if($_SESSION["perfil"] == "Administrador"){
                        echo '<button class="btn btn-danger btnEliminarCategoria" idCategoria="'.$value["id"].'"><i class="fa fa-times"></i></button>';
                      }

                    echo '</div>  
                  </td>
                </tr>';
            }
        ?>

        </tbody>
       </table>
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
                  <h3 class="timeline-header text-center">Nuevas Categorías</h3>
                <div class="timeline-body">
                  <video width="400" controls>
                    <source src="vistas/img/video/tutorial1.mp4" type="video/mp4">
                  </video>
                  
                  <br><br>
                </div>
                <div class="timeline-footer">
                  <h4>Aquí el listado de las Categorías que han sido recientemente agregadas.</h4>
                </div>
            </div>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-info" data-dismiss="modal">Cerrar</button>
      </div>

    </div>
  </div>
</div>


<div id="modalAgregarCategoria" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <form role="form" method="post">


        <div class="modal-header" style="background:#08070766; color:white">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Agregar categoría</h4>
        </div>


        <div class="modal-body">
          <div class="box-body">

            
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-th"></i></span> 
                <input type="text" class="form-control input-lg" name="nuevaCategoria" placeholder="Ingresar categoría" id="nuevaCategoria" required>
              </div>
            </div>
          </div>
        </div>


        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
          <button type="submit" class="btn btn-primary">Guardar categoría</button>
        </div>

        <?php
          $crearCategoria = new ControladorCategorias();
          $crearCategoria -> ctrCrearCategoria();
        ?>

      </form>
    </div>
  </div>
</div>


<div id="modalEditarCategoria" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <form role="form" method="post">


        <div class="modal-header" style="background:#08070766; color:white">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Editar categoría</h4>
        </div>


        <div class="modal-body">
          <div class="box-body">

            
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-th"></i></span> 
                <input type="text" class="form-control input-lg" name="editarCategoria" id="editarCategoria" required>
                <input type="hidden"  name="idCategoria" id="idCategoria" required>
              </div>
            </div>
          </div>
        </div>


        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
          <button type="submit" class="btn btn-primary">Guardar cambios</button>
        </div>

      <?php
          $editarCategoria = new ControladorCategorias();
          $editarCategoria -> ctrEditarCategoria();
        ?> 

      </form>
    </div>
  </div>
</div>

<?php
  $borrarCategoria = new ControladorCategorias();
  $borrarCategoria -> ctrBorrarCategoria();
?>


