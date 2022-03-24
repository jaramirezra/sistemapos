<div class="content-wrapper">
  <section class="content-header">
    <h1>
      Administrar Proveedores
    </h1>
    <ol class="breadcrumb">
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li class="active">Administrar Proveedores</li>
    </ol>
  </section>

  <section class="content">
    <div class="box">
      <div class="box-header with-border">
        <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarProveedor">
          Agregar proveedor
        </button>
        <button class="btn btn-primary" data-toggle="modal" data-target="#modalImportarProveedor">
          Importar proveedor
        </button>
      </div>

      <div class="box-body">
       <table class="table table-bordered table-striped dt-responsive tablas" width="100%">
        <thead>
         <tr>
           <th style="width:5px">No.</th>
           <th>Codigo</th>
           <th>CC/Nit</th>
           <th>Nombre</th>
           <th>Contacto</th>
           <th>Cargo</th>
           <th>Direccion</th>
           <th>Teléfono</th>
           <th>Suministro</th>
           <th>Web</th>
           <th>Acciones</th>
         </tr> 
        </thead>
        <tbody>

        <?php

          $item = null;
          $valor = null;
          $clientes = ControladorProveedor::ctrMostrarProveedor($item, $valor);

          foreach ($clientes as $key => $value) {

            echo '<tr>
                    <td>'.($key+1).'</td>
                    <td>'.$value["codigo"].'</td>
                    <td>'.$value["nit"].'</td>
                    <td>'.$value["nombre"].'</td>
                    <td>'.$value["contacto"].'</td>
                    <td>'.$value["direccion"].'</td>
                    <td>'.$value["cargo"].'</td>
                    <td>'.$value["telefono"].'</td>
                    <td>'.$value["suministro"].'</td>
                    <td>'.$value["web"].'</td>
                    
                    <td>
                      <div class="btn-group">
                        <button class="btn btn-warning btnEditarProveedor" data-toggle="modal" data-target="#modalEditarrProveedor" idProveedor="'.$value["id"].'"><i class="fa fa-pencil"></i></button>
                        <button class="btn btn-danger btnEliminarProveedor" idProveedor="'.$value["id"].'"><i class="fa fa-times"></i></button>
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

<!--=====================================
MODAL AGREGAR PROVEEDOR
======================================-->

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

<!--=====================================
MODAL EDITAR PROVEEDOR
======================================-->

<div id="modalEditarrProveedor" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#08070766; color:white">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Editar proveedor</h4>
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
                <input type="text" class="form-control input-lg" name="editarCodigos" id="editarCodigos" placeholder="Ingresar Codigo" maxlength="4" required>
                <input type="hidden" id="idProveedor" name="idProveedor">
              </div>
            </div>

            <!-- ENTRADA PARA EL NIT -->
            
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-key"></i></span> 
                <input type="tel" min="0" class="form-control input-lg" name="editarNit" id="editarNit" placeholder="Ingresar Numero" maxlength="10" required>
              </div>
            </div>

            <!-- ENTRADA PARA EL NOMBRE -->
            
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-envelope"></i></span> 
                <input type="text" class="form-control input-lg" name="editarNombres" id="editarNombres" placeholder="Ingresar Nombre" required>
              </div>
            </div>

            <!-- ENTRADA PARA EL CONTACTO -->
            
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-phone"></i></span> 
                <input type="text" class="form-control input-lg" name="editarContacto" id="editarContacto" placeholder="Ingresar Contacto" required>
              </div>
            </div>

            <!-- ENTRADA PARA LA CARGO -->
            
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-map-marker"></i></span> 
                <input type="text" class="form-control input-lg" name="editarCargo" id="editarCargo" placeholder="Ingresar Cargo" required>
              </div>
            </div>

            <!-- ENTRADA PARA EL DIRECCIÓN -->
            
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span> 
                <input type="text" class="form-control input-lg" name="editarDirecciones" id="editarDirecciones" placeholder="Ingresar Dirección" required>
              </div>
            </div>

            <!-- ENTRADA PARA EL TELÉFONO -->
            
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span> 
                <input type="text" class="form-control input-lg" name="editarTelefono" id="editarTelefono" placeholder="Ingresar Teléfono" required>
              </div>
            </div>

            <!-- ENTRADA PARA EL SUMINISTRO -->
            
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span> 
                <input type="text" class="form-control input-lg" name="ediatarSuministro" id="ediatarSuministro" placeholder="Ingresar Suministro" required>
              </div>
            </div>

            <!-- ENTRADA PARA EL WEB -->
            
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span> 
                <input type="text" class="form-control input-lg" name="ediatarWeb" id="ediatarWeb" placeholder="Ingresar Sitio Web" required>
              </div>
            </div>


          </div>
        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
          <button type="submit" class="btn btn-primary">Guardar proveedor</button>
        </div>

      </form>

      <?php
        $editarProveedor = new ControladorProveedor();
        $editarProveedor -> ctrEditarProveedor();
      ?>

    </div>
  </div>
</div>

<?php
  $eliminarCliente = new ControladorProveedor();
  $eliminarCliente -> ctrEliminarProveedor();
?>

<div id="modalImportarProveedor" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <form role="form" method="post" enctype="multipart/form-data" >

        
        <div class="modal-header" style="background:#08070766; color:white">  
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Importar Proveedores</h4>
        </div>

        <div class="modal-body">
          <div class="box-body">
              <h3>Archivo Plano CSV</h3>
              <br>
              <input type="file" name="file" id="file">
              <br>
              <a href="Excel/excel.proveedor.php" >Descargar Archivo Plano</a>
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
          $CargarProveedor = new ControladorProveedor();
          $CargarProveedor -> ctrCargarProveedores();
        ?>        
      </form>
    </div>
  </div>
</div>


