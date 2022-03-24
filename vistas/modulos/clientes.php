<div class="content-wrapper">
  <section class="content-header">
    <h1>
      Administrar clientes
    </h1>
    <ol class="breadcrumb">
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li class="active">Administrar clientes</li>
    </ol>
  </section>

  <section class="content">
    <div class="box">
      <div class="box-header with-border">
        <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarCliente">
          Agregar cliente
        </button>
        <button class="btn btn-primary" data-toggle="modal" data-target="#modalImportarProveedor">
          Importar cliente
        </button>
      </div>

      <div class="box-body">
       <table class="table table-bordered table-striped dt-responsive tablas" width="100%">
        <thead>
         <tr>
           <th style="width:5px">No.</th>
           <th>Nombre</th>
           <th>Razon Social</th>
           <th>CC/NIT</th>
           <th>Ciudad</th>
           <th style="width:130px">Dirección</th>
           <th style="width:130px">Email</th>
           <th>Teléfono</th>
           <th>Total compras</th>
           <th>Última compra</th>
           <th>Ingreso al sistema</th>
           <th>Acciones</th>
         </tr> 
        </thead>
        <tbody>

        <?php

          $item = null;
          $valor = null;
          $clientes = ControladorClientes::ctrMostrarClientes($item, $valor);

          foreach ($clientes as $key => $value) {

            echo '<tr>
                    <td>'.($key+1).'</td>
                    <td>'.$value["nombre"].'</td>
                    <td>'.$value["razonSocial"].'</td>
                    <td>'.$value["documento"].'</td>
                    <td>'.$value["ciudad"].'</td>
                    <td>'.$value["direccion"].'</td>
                    <td>'.$value["email"].'</td>
                    <td>'.$value["telefono"].'</td>
                    <td>'.$value["compras"].'</td>
                    <td>'.$value["ultima_compra"].'</td>
                    <td>'.$value["fecha"].'</td>
                    <td>
                      <div class="btn-group">
                        <button class="btn btn-warning btnEditarCliente" data-toggle="modal" data-target="#modalEditarCliente" idCliente="'.$value["id"].'"><i class="fa fa-pencil"></i></button>
                        <button class="btn btn-danger btnEliminarCliente" idCliente="'.$value["id"].'"><i class="fa fa-times"></i></button>
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

<div id="modalAgregarCliente" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <form role="form" method="post">

        <div class="modal-header" style="background:#08070766; color:white">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Agregar cliente</h4>
        </div>

        <div class="modal-body">
          <div class="box-body">

            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span> 
                <input type="text" class="form-control input-lg" name="nuevoCliente" placeholder="Ingresar nombre" id="nuevoCliente" required>
              </div>
            </div>

            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-key"></i></span> 
                <input type="number" min="0" class="form-control input-lg" name="nuevoDocumentoId" placeholder="Ingresar documento" maxlength="10" required>
              </div>
            </div>

            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-envelope"></i></span> 
                <input type="email" class="form-control input-lg" name="nuevoEmail" placeholder="Ingresar email" required>
              </div>
            </div>

            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-phone"></i></span> 
                <input type="number" class="form-control input-lg" name="nuevoTelefono" placeholder="Ingresar teléfono" data-inputmask="'mask':'(999) 999-9999'" data-mask maxlength="10" required>
              </div>
            </div>

            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-map-marker"></i></span> 
                <input type="text" class="form-control input-lg" name="nuevaDireccion" placeholder="Ingresar dirección" required>
              </div>
            </div>

            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span> 
                <input type="text" class="form-control input-lg" name="nuevoRazon" placeholder="Ingresar Razon Social" required>
              </div>
            </div>

            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span> 
                <input type="text" class="form-control input-lg" name="nuevoCiudad" placeholder="Ingresar Ciudad" required>
              </div>
            </div>

            
          </div>
        </div>


        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
          <button type="submit" class="btn btn-primary">Guardar cliente</button>
        </div>

      </form>

      <?php
        $crearCliente = new ControladorClientes();
        $crearCliente -> ctrCrearCliente();
      ?>

    </div>
  </div>
</div>


<div id="modalEditarCliente" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <form role="form" method="post">

        <div class="modal-header" style="background:#08070766; color:white">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Editar cliente</h4>
        </div>

        <div class="modal-body">
          <div class="box-body">

            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span> 
                <input type="text" class="form-control input-lg" name="editarCliente" id="editarCliente" required>
                <input type="hidden" id="idCliente" name="idCliente">
              </div>
            </div>

            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-key"></i></span> 
                <input type="number" min="0" class="form-control input-lg" name="editarDocumentoId" id="editarDocumentoId" maxlength="10" required>
              </div>
            </div>

            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-envelope"></i></span> 
                <input type="email" class="form-control input-lg" name="editarEmail" id="editarEmail" required>
              </div>
            </div>

            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-phone"></i></span> 
                <input type="text" class="form-control input-lg" name="editarTelefono" id="editarTelefono" data-inputmask="'mask':'(999) 999-9999'" data-mask  maxlength="10" required>
              </div>
            </div>

            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-map-marker"></i></span> 
                <input type="text" class="form-control input-lg" name="editarDireccion" id="editarDireccion"  required>
              </div>
            </div>

            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span> 
                <input type="text" class="form-control input-lg" name="editarRazon" id="editarRazon" required>
              </div>
            </div>

            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span> 
                <input type="text" class="form-control input-lg" name="editarCiudad" id="editarCiudad" required>
              </div>
            </div>
          
            
          </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
          <button type="submit" class="btn btn-primary">Guardar cambios</button>
        </div>

      </form>

      <?php
        $editarCliente = new ControladorClientes();
        $editarCliente -> ctrEditarCliente();
      ?>

    </div>
  </div>
</div>

<?php

  $eliminarCliente = new ControladorClientes();
  $eliminarCliente -> ctrEliminarCliente();

?>

<div id="modalImportarProveedor" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <form role="form" method="post" enctype="multipart/form-data">

        
        <div class="modal-header" style="background:#08070766; color:white">  
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Importar Clientes</h4>
        </div>

        <div class="modal-body">
          <div class="box-body">
              <h3>Archivo Plano CSV</h3>
              <br>
              <input type="file" name="file" id="file">
              <br>
              <a href="Archivos/Excel/excel.clientes.php" >Descargar Archivo Plano</a>
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
          $CargarCliente = new ControladorClientes();
          $CargarCliente -> ctrCargarClientes();
        ?>      
      </form>
    </div>
  </div>
</div>


