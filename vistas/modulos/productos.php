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
      Administrar productos
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
      <li class="active">Administrar productos</li>
    </ol>

  </section>


  <section class="content">
    <div class="box">
      <div class="box-header with-border"></div>
      <div class="box-body">

        <nav class="navbar navbar-default">
          <div class="container-fluid">
            <div class="navbar-header">
              <a class="navbar-brand" href="#"></a>
            </div>
              <ul class="nav navbar-nav">
                <li><a class="btn" data-toggle="modal" data-target="#modalAgregarProveedor">Agregar Proveedor</a></li>
                <li><a class="btn" data-toggle="modal" data-target="#modalAgregarCategoria">Agregar Categor&Iacute;a</a></li>
                <li><a class="btn" data-toggle="modal" data-target="#modalAgregarProducto">Agregar Producto</a></li>
                <li><a class="btn" data-toggle="modal" data-target="#modalMostrarCategorias">Ver Categor&Iacute;a</a></li>
                <li><a class="btn" data-toggle="modal" data-target="#modalImportarUsuarios">Importar Producto en CSV</a></li>
                <li><a class="btn" data-toggle="modal" data-target="#modalMostrarProducAgotados">Productos Agotados</a></li>
              </ul></div>
        </nav>

       <table class="table table-bordered table-striped dt-responsive tablaProductos" width="100%">
        <thead>
         <tr>
           <th style="width:5px">#</th>
           <th>Categoria</th>
           <th>Proveedor</th>
           <th>Código</th>
           <th>Descripción</th>
           <th>Imagen</th>
           <th>Stock</th>
           <th>Precio de venta</th>
           <th>Acciones</th>
         </tr> 
        </thead>
          <input type="hidden" value="<?php echo $_SESSION['perfil']; ?>" id="perfilOculto">      
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

<div id="modalAgregarProducto" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <form role="form" method="post" enctype="multipart/form-data">


        <div class="modal-header" style="background:#08070766; color:white">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Agregar producto</h4>
        </div>


        <div class="modal-body">
          <div class="box-body">

            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-th"></i></span> 
                <select class="form-control input-lg" id="nuevasProveedor" name="nuevasProveedor" required>
                  <option value="">Selecionar Proveedor</option>

                  <?php

                  $item = null;
                  $valor = null;
                  $proveedor = ControladorProveedor::ctrMostrarProveedor($item, $valor);

                  foreach ($proveedor as $key => $value) {
                    echo '<option value="'.$value["id"].'">'.$value["codigo"].'</option>';
                  }

                  ?>
  
                </select>
              </div>
            </div>

            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-th"></i></span> 
                <select class="form-control input-lg" id="nuevasCategorias" name="nuevasCategorias" required>
                  <option value="">Selecionar categoría</option>

                  <?php

                  $item = null;
                  $valor = null;
                  $categorias = ControladorCategorias::ctrMostrarCategorias($item, $valor);

                  foreach ($categorias as $key => $value) {
                    echo '<option value="'.$value["id"].'">'.$value["categoria"].'</option>';
                  }

                  ?>
  
                </select>
              </div>
            </div>

            
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-code"></i></span> 
                <input type="text" class="form-control input-lg" id="nuevoCodigo" name="nuevoCodigo" placeholder="Ingresar código" required>
              </div>
            </div>

             <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-product-hunt"></i></span> 
                <input type="text" class="form-control input-lg" name="nuevaDescripcion" placeholder="Ingresar descripción" required>
              </div>
            </div>

             <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-check"></i></span> 
                <input type="number" class="form-control input-lg" name="nuevoStock" min="0" placeholder="Stock" required>
              </div>
            </div>

             <div class="form-group row">
                <div class="col-xs-6">
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-arrow-up"></i></span> 
                    <input type="number" class="form-control input-lg" id="nuevoPrecioCompra" name="nuevoPrecioCompra" step="any" min="0" placeholder="Precio de compra" required>
                  </div>
                </div>

                <div class="col-xs-6">
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-arrow-down"></i></span> 
                    <input type="number" class="form-control input-lg" id="nuevoPrecioVenta" name="nuevoPrecioVenta" step="any" min="0" placeholder="Precio de venta" required>
                  </div>
                  <br>

                  <div class="col-xs-6">
                    <div class="form-group">
                      <label>
                        <input type="checkbox" class="minimal porcentaje" checked>
                        Utilizar procentaje
                      </label>
                    </div>
                  </div>

                  <div class="col-xs-6" style="padding:0">
                    <div class="input-group">
                      <input type="number" class="form-control input-lg nuevoPorcentaje" min="0" value="40" required>
                      <span class="input-group-addon"><i class="fa fa-percent"></i></span>
                    </div>
                  </div>
                </div>
            </div>

             <div class="form-group">
              <div class="panel">SUBIR IMAGEN</div>
              <input type="file" class="nuevaImagen" name="nuevaImagen">
              <p class="help-block">Peso máximo de la imagen 2MB</p>
              <img src="vistas/img/productos/default/anonymous.png" class="img-thumbnail previsualizar" width="100px">
            </div>
          </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
          <button type="submit" class="btn" style="background-color:#08070766; color:#fff;">Guardar producto</button>
        </div>
      </form>

        <?php
          $crearProducto = new ControladorProductos();
          $crearProducto -> ctrCrearProducto();
        ?>  

    </div>
  </div>
</div>


<div id="modalEditarProducto" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <form role="form" method="post" enctype="multipart/form-data">

        <div class="modal-header" style="background:#08070766; color:white">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Editar producto</h4>
        </div>

        <div class="modal-body">
          <div class="box-body">

            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-th"></i></span> 
                <select class="form-control input-lg"  name="editarCategoria" readonly required>
                  <option id="editarCategoria"></option>
                </select>
              </div>
            </div>

            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-code"></i></span> 
                <input type="text" class="form-control input-lg" id="editarCodigo" name="editarCodigo" readonly required>
              </div>
            </div>

             <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-product-hunt"></i></span> 
                <input type="text" class="form-control input-lg" id="editarDescrip" name="editarDescrip" required>
              </div>
            </div>

             <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-check"></i></span> 
                <input type="number" class="form-control input-lg" id="editarStock" name="editarStock" min="0" required>
              </div>
            </div>

             <div class="form-group row">
                <div class="col-xs-6">
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-arrow-up"></i></span> 
                    <input type="number" class="form-control input-lg" id="editarPrecioCompra" name="editarPrecioCompra" step="any" min="0" required>
                  </div>
                </div>

                <div class="col-xs-6">
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-arrow-down"></i></span> 
                    <input type="number" class="form-control input-lg" id="editarPrecioVenta" name="editarPrecioVenta" step="any" min="0" readonly required>
                  </div>
                  <br>

                  <div class="col-xs-6">
                    <div class="form-group">
                      <label>
                        <input type="checkbox" class="minimal porcentaje" checked>
                        Utilizar procentaje
                      </label>
                    </div>
                  </div>

                  <div class="col-xs-6" style="padding:0">
                    <div class="input-group">
                      <input type="number" class="form-control input-lg nuevoPorcentaje" min="0" value="40" required>
                      <span class="input-group-addon"><i class="fa fa-percent"></i></span>
                    </div>
                  </div>
                </div>
            </div>

             <div class="form-group">
              <div class="panel">SUBIR IMAGEN</div>
              <input type="file" class="nuevaImagen" name="editarImagen">
              <p class="help-block">Peso máximo de la imagen 2MB</p>
              <img src="vistas/img/productos/default/anonymous.png" class="img-thumbnail previsualizar" width="100px">
              <input type="hidden" name="imagenActual" id="imagenActual">
            </div>
          </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
          <button type="submit" class="btn" style="background-color:#08070766; color:#fff;">Guardar cambios</button>
        </div>
      </form>

        <?php
          $editarProducto = new ControladorProductos();
          $editarProducto -> ctrEditarProducto();
        ?>      

    </div>
  </div>
</div>

<?php
  $eliminarProducto = new ControladorProductos();
  $eliminarProducto -> ctrEliminarProducto();
?>


<div id="modalImportarUsuarios" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <form role="form" method="post" enctype="multipart/form-data" >

        <div class="modal-header" style="background:#08070766; color:white">  
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Importar Producto</h4>
        </div>

        <div class="modal-body">
          <div class="box-body">
              <h3>Archivo Plano CSV</h3>
              <br>
              <input type="file" name="file" id="file">
              <br>
              <a href="Excel/excel.producto.php" >Descargar Archivo Plano</a>
              <br><br>
              <div class="alert alert-info alert-dismissable">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong>¡Cuidado!</strong> Este mensaje requiere de tu atención, solo puede cargar 350 productos en el archivo de Excel, si necesita subir mas productos realícelo por archivos separados de la misma cantidad.
              </div>    
          </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
          <button type="submit" class="btn" style="background-color:#08070766; color:#fff;" value="Enviar" name="enviar">Cargar Archivo</button>
        </div>
        <?php
          $CargarProducto = new ControladorProductos();
          $CargarProducto -> ctrCargarProducto();
        ?>         
      </form>
    </div>
  </div>
</div>

<div id="modalAgregarProveedor" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#08070766; color:white">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Agregar proveedor</h4>
        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">
          <div class="box-body">

            <!-- ENTRADA PARA EL CODIGO -->
            
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span> 
                <input type="text" class="form-control input-lg" name="nuevoCodigo" placeholder="Ingresar Codigo" maxlength="4" required>
              </div>
            </div>

            <!-- ENTRADA PARA EL NIT -->
            
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-key"></i></span> 
                <input type="tel" min="0" class="form-control input-lg" name="nuevoNit" placeholder="Ingresar Numero" maxlength="10" required>
              </div>
            </div>

            <!-- ENTRADA PARA EL NOMBRE -->
            
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-envelope"></i></span> 
                <input type="text" class="form-control input-lg" name="nuevoNombre" placeholder="Ingresar Nombre" required>
              </div>
            </div>

            <!-- ENTRADA PARA EL CONTACTO -->
            
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-phone"></i></span> 
                <input type="text" class="form-control input-lg" name="nuevoContacto" placeholder="Ingresar Contacto" required>
              </div>
            </div>

            <!-- ENTRADA PARA LA CARGO -->
            
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-map-marker"></i></span> 
                <input type="text" class="form-control input-lg" name="nuevoCargo" placeholder="Ingresar Cargo" required>
              </div>
            </div>

            <!-- ENTRADA PARA EL DIRECCIÓN -->
            
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span> 
                <input type="text" class="form-control input-lg" name="nuevoDireccion" placeholder="Ingresar Dirección" required>
              </div>
            </div>

            <!-- ENTRADA PARA EL TELÉFONO -->
            
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span> 
                <input type="text" class="form-control input-lg" name="nuevoTelefono" placeholder="Ingresar Teléfono" required>
              </div>
            </div>


            <!-- ENTRADA PARA EL SUMINISTRO -->
            
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span> 
                <input type="text" class="form-control input-lg" name="nuevoSuministro" placeholder="Ingresar Suministro" required>
              </div>
            </div>

            <!-- ENTRADA PARA EL WEB -->
            
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span> 
                <input type="text" class="form-control input-lg" name="nuevoWeb" placeholder="Ingresar Sitio Web" required>
              </div>
            </div>


          </div>
        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
          <button type="submit" class="btn btn-primary">Guardar cliente</button>
        </div>

      </form>

      <?php
        $crearProveedor = new ControladorProveedor();
        $crearProveedor -> ctrCrearProveedor();
      ?>

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
          <button type="submit" class="btn" style="background-color:#08070766; color:#fff;">Guardar categoría</button>
        </div>

        <?php
          $crearCategoria = new ControladorCategorias();
          $crearCategoria -> ctrCrearCategoria();
        ?>

      </form>
    </div>
  </div>
</div>

<div id="modalMostrarCategorias" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <form role="form" method="post">

        <div class="modal-header" style="background:#08070766; color:white">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Mostrar Categorias</h4>
        </div>

        <div class="modal-body">
          <div class="box-body">

            <div class="form-group">
              <div class="input-group">
                <table class="table table-bordered table-striped dt-responsive tablas" width="100%">
                    <thead>
                      <tr>
                        <th style="width:10px">#</th>
                        <th>Categoria</th>
                        <th></th>
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
                              </td>
                            </tr>';
                        }
                    ?>

                    </tbody>
                  </table>
              </div>
            </div>

          </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
        </div>

      </form>
    </div>
  </div>
</div>

<div id="modalMostrarProducAgotados" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <form role="form" method="post">

        <div class="modal-header" style="background:#08070766; color:white">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Mostrar Producto</h4>
        </div>

        <div class="modal-body">
          <div class="box-body">

            <div class="form-group">
              <div class="input-group">
               <h1>Productos Agotados</h1>
              <!--=================================  CAJA DE COLORES =================================-->
                  <?php
                  $item = null;
                  $valor = null;
                  $producto = ControladorProductos::ctrMostrarProductos2($item, $valor);
                      //,,
                  foreach ($producto as $key => $value) {
                    if ($value["stock"] == "40") {

                        echo '<div class="info-box btn-success">
                              <span class="info-box-icon"><img src="'.$value["imagen"].'" alt=""></i></span>
              
                              <div class="info-box-content">
                              <span class="info-box-number"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">No.'.$value["id"].'</font></font></span>
                              <span class="info-box-text"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Codigo: '.$value["codigo"].'</font></font></span>
                              <span class="info-box-text"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Stock: '.$value["stock"].'</font></font></span>
                              <span class="info-box-text"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Descripcion: '.$value["descripcion"].'</font></font></span>

                              </div>
                              </div>';

                    } else {
                      //echo "#2 tu amor de ayer";
                    }

                    if ($value["stock"] == "25") {

                        echo '<div class="info-box btn-warning">
                        <span class="info-box-icon"><img src="'.$value["imagen"].'" alt=""></i></span>
        
                        <div class="info-box-content">
                        <span class="info-box-number"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">No.'.$value["id"].'</font></font></span>
                        <span class="info-box-text"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Codigo: '.$value["codigo"].'</font></font></span>
                        <span class="info-box-text"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Stock: '.$value["stock"].'</font></font></span>
                        <span class="info-box-text"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Descripcion: '.$value["descripcion"].'</font></font></span>

                        </div>
                        </div>';
                    } else {
                      //echo "#4 tu amor de ayer";
                    }

                    if ($value["stock"] == "10") {
                      
                        echo '<div class="info-box btn-danger">
                        <span class="info-box-icon"><img src="'.$value["imagen"].'" alt=""></i></span>
        
                        <div class="info-box-content">
                        <span class="info-box-number"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">No.'.$value["id"].'</font></font></span>
                        <span class="info-box-text"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Codigo: '.$value["codigo"].'</font></font></span>
                        <span class="info-box-text"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Stock: '.$value["stock"].'</font></font></span>
                        <span class="info-box-text"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Descripcion: '.$value["descripcion"].'</font></font></span>

                        </div>
                        </div>';

                    } else {
                      //echo "#6 tu amor de ayer";
                    }

                  }
                      
                ?>
                
              </div>
            </div>

          </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
        </div>

      </form>
    </div>
  </div>
</div>
  