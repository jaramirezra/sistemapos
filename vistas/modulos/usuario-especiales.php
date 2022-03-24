<div class="content-wrapper">

       <div class="col-md-15">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#" data-toggle="tab">Actividad</a></li>

            </ul>
            <div class="tab-content">
              <div class="active tab-pane" id="activity">

                <div class="post">
                  <div class="user-block">
                          <?php
                            if($_SESSION["foto"] != ""){
                              echo '<img src="'.$_SESSION["foto"].'" class="img-circle img-bordered-sm">';
                            }else{
                              echo '<img src="vistas/img/usuarios/default/anonymous.png" class="img-circle img-bordered-sm">';
                            }
                          ?>
                        <span class="username">
                          <a><?php  echo $_SESSION["nombre"]; ?></a>
                        </span>
                    <a class="description">Su Perfil es: <?php  echo $_SESSION["perfil"]; ?></a>
                  </div>

            <p>
            <?php  echo $_SESSION["descripcion"]; ?>
          </p>
        </div>
      
      <div class="row">
            <div class="col-md-6">
              <div class="box box-danger">
                <div class="box-header with-border">
                  <h3 class="box-title">Miembros de ERP</h3>

                  <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                  </div>
                </div>

                <div class="box-body no-padding">
                  <ul class="users-list clearfix">
                     <?php

                        $item = null;
                        $valor = null;
                        $usuarios = ControladorUsuarios::ctrMostrarUsuarios($item, $valor);

                        foreach ($usuarios as $key => $value){
                      
                            if($value["foto"] != ""){
                                echo '<li>
                                        <img src="'.$value["foto"].'" class="img-circle img-bordered-sm">
                                        <a class="users-list-name">'.$value["nombre"].'</a>
                                        <span class="users-list-date">'.$value["perfil"].'</span>                                      
                                      </li>';
                            }else{
                              echo '<li>
                                      <img src="vistas/img/usuarios/default/anonymous.png" class="img-circle img-bordered-sm" width="100px">
                                      <a class="users-list-name">'.$value["nombre"].'</a>
                                      <span class="users-list-date">'.$value["perfil"].'</span>                                    
                                    </li>';
                            }
                          
                        }
                        ?>
                  </ul>
                </div>
              </div>
            </div>
          </div> 
</div>



