<?php

if($_SESSION["perfil"] == "Vendedor" || $_SESSION["perfil"] == "Especial"){
  echo '<script>
            window.location = "inicio";
        </script>';
  return;
}

?>

<div class="content-wrapper">
  <section class="content-header">
    
    <h1>
      Administrar usuarios
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
      <li class="active">Administrar usuarios</li>
    </ol>

  </section>
  <section class="content">
    <div class="box">
      <div class="box-header with-border">
        <button class="btn" style="background-color:#08070766; color:#fff;" data-toggle="modal" data-target="#modalAgregarUsuario">
          Agregar usuario
        </button>
      </div>

      <div class="box-body">
       <table class="table table-bordered table-striped dt-responsive tablas" width="100%">
        <thead>
         <tr>
           
           <th style="width:10px">#</th>
           <th>Nombre</th>
           <th>Usuario</th>
           <th>Foto</th>
           <th>Descripción</th>
           <th>Perfil</th>
           <th>Estado</th>
           <th>Último login</th>
           <th>Acciones</th>

         </tr> 
        </thead>
        <tbody>

        <?php

        $item = null;
        $valor = null;
        $usuarios = ControladorUsuarios::ctrMostrarUsuarios($item, $valor);

        foreach ($usuarios as $key => $value){
         
          echo ' <tr>
                  <td>'.($key+1).'</td>
                  <td>'.$value["nombre"].'</td>
                  <td>'.$value["usuario"].'</td>';

                  if($value["foto"] != ""){
                    echo '<td><img src="'.$value["foto"].'" class="img-thumbnail" width="40px"></td>';
                  }else{
                    echo '<td><img src="vistas/img/usuarios/default/anonymous.png" class="img-thumbnail" width="40px"></td>';
                  }
                  echo '<td>'.$value["descripcion"].'</td>';
                  echo '<td>'.$value["perfil"].'</td>';

                  if($value["estado"] != 0){
                    echo '<td><button class="btn btn-success btn-xs btnActivar" idUsuario="'.$value["id"].'" estadoUsuario="0">Activado</button></td>';
                  }else{
                    echo '<td><button class="btn btn-danger btn-xs btnActivar" idUsuario="'.$value["id"].'" estadoUsuario="1">Desactivado</button></td>';
                  }             
                  echo '<td>'.$value["ultimo_login"].'</td>
                  <td>

                    <div class="btn-group">
                      <button class="btn btn-warning btnEditarUsuario" idUsuario="'.$value["id"].'" data-toggle="modal" data-target="#modalEditarUsuario"><i class="fa fa-pencil"></i></button>
                      <button class="btn btn-danger btnEliminarUsuario" idUsuario="'.$value["id"].'" fotoUsuario="'.$value["foto"].'" usuario="'.$value["usuario"].'"><i class="fa fa-times"></i></button>
                    </div>  
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


<div id="modalAgregarUsuario" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <form role="form" method="post" enctype="multipart/form-data">


        <div class="modal-header" style="background:#08070766; color:white">  
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Agregar usuario</h4>
        </div>


        <div class="modal-body">
          <div class="box-body">
            
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span> 
                <input type="text" class="form-control input-lg" name="nuevoNombre" placeholder="Ingresar nombre" required>
              </div>
            </div>

             <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-envelope"></i></span> 
                <input type="text" class="form-control input-lg" name="nuevoUsuario" placeholder="Ingresar Correo Electrónico" id="nuevoUsuario" required>
              </div>
            </div>

             <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-lock"></i></span> 
                <input type="password" class="form-control input-lg" name="nuevoPassword" placeholder="Ingresar contraseña" required>
              </div>
            </div>

            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-lock"></i></span> 
                <input type="text" class="form-control input-lg" name="nuevaDescripcion" placeholder="Describa sus Funciones" required>
              </div>
            </div>


            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-users"></i></span> 
                <select class="form-control input-lg" name="nuevoPerfil">
                  <option value="">Selecionar perfil</option>
                  <option value="Especial">Especial</option>
                  <option value="Vendedor">Vendedor</option>
                </select>
              </div>
            </div>

             <div class="form-group">
              <div class="panel">SUBIR FOTO</div>
              <input type="file" class="nuevaFoto" name="nuevaFoto">
              <p class="help-block">Peso máximo de la foto 2MB</p>
              <img src="vistas/img/usuarios/default/anonymous.png" class="img-thumbnail previsualizar" width="100px">
            </div>
          </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
          <button type="submit" class="btn" style="background-color:#08070766; color:#fff;">Guardar usuario</button>
        </div>

        <?php
          $crearUsuario = new ControladorUsuarios();
          $crearUsuario -> ctrCrearUsuario();
        ?>

      </form>
    </div>
  </div>
</div>


<div id="modalEditarUsuarios" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <form role="form" method="post" enctype="multipart/form-data">

        <div class="modal-header" style="background:#08070766; color:white">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Editar usuarios</h4>
        </div>

        <div class="modal-body">
          <div class="box-body">

            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span> 
                <input type="text" class="form-control input-lg" id="editarNombre" name="editarNombre" value="" required>
              </div>
            </div>

             <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-key"></i></span> 
                <input type="text" class="form-control input-lg" id="editarUsuario" name="editarUsuario" value="" disabled>
              </div>
            </div>

             <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-lock"></i></span> 
                <input type="password" class="form-control input-lg" name="editarPassword" placeholder="Escriba la nueva contraseña">
                <input type="hidden" id="passwordActual" name="passwordActual">
              </div>
            </div>

            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span> 
                <input type="text" class="form-control input-lg" id="editarDescripcion" name="editarDescripcion" value="" readonly>
              </div>
            </div>

            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-users"></i></span> 
                <select class="form-control input-lg" name="editarPerfil">
                  <option value="" id="editarPerfil"></option>
                  <option value="Administrador">Administrador</option>
                  <option value="Especial">Especial</option>
                  <option value="Vendedor">Vendedor</option>
                </select>
              </div>
            </div>

             <div class="form-group">
              <div class="panel">SUBIR FOTO</div>
              <input type="file" class="nuevaFoto" name="editarFoto">
              <p class="help-block">Peso máximo de la foto 2MB</p>
              <img src="vistas/img/usuarios/default/anonymous.png" class="img-thumbnail previsualizar" width="100px">
              <input type="hidden" name="fotoActual" id="fotoActual">
            </div>
          </div>
        </div>


        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
          <button type="submit" class="btn btn-primary">Modificar usuario</button>
        </div>
    
        <?php
          $editarUsuario = new ControladorUsuarios();
          $editarUsuario -> ctrEditarUsuario();
        ?> 

      </form>
    </div>
  </div>
</div>

<?php
  $borrarUsuario = new ControladorUsuarios();
  $borrarUsuario -> ctrBorrarUsuario();
?> 
