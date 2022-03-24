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
      Crear venta
    </h1>

    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
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
      <li class="active">Crear venta</li>
    </ol>

  </section>
  <section class="content">
    <div class="row">

      
      <div class="col-lg-5 col-xs-12">
        <div class="box box-success">
          <div class="box-header with-border"></div>
          <form role="form" method="post" class="formularioVenta">
            <div class="box-body">
              <div class="box">

            
                <div class="form-group">
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-user"></i></span> 
                    <input type="text" class="form-control" id="nuevoVendedor" value="<?php echo $_SESSION["nombre"]; ?>" readonly>
                    <input type="hidden" name="idVendedor" value="<?php echo $_SESSION["id"]; ?>">
                  </div>
                </div> 


                <div class="form-group">
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-key"></i></span>

                    <?php

                    $item = null;
                    $valor = null;
                    $Configuracion = ControladorConfig::ctrMostrarConfig($item, $valor);
                    foreach ($Configuracion as $key => $value) {
                      
                    }

                    $item = null;
                    $valor = null;
                    $ventas = ControladorVentas::ctrMostrarVentas($item, $valor);

                    if(!$ventas){
                      echo '<input type="text" class="form-control" id="nuevaVenta" name="nuevaVenta" value="'.$value["codigo"].'" readonly>';
                    }else{
                      foreach ($ventas as $key => $value) {
                      
                      }

                      $codigo = $value["codigo"] + 1;
                      echo '<input type="text" class="form-control" id="nuevaVenta" name="nuevaVenta" value="'.$codigo.'" readonly>';
          
                    }

                    ?>
                    
                  </div>
                </div>


                <div class="form-group">
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-users"></i></span>
                    <select class="form-control" id="seleccionarCliente" name="seleccionarCliente" required>
                    <option value="">Seleccionar cliente</option>

                    <?php

                      $item = null;
                      $valor = null;
                      $categorias = ControladorClientes::ctrMostrarClientes($item, $valor);

                       foreach ($categorias as $key => $value) {
                         echo '<option value="'.$value["id"].'">'.$value["nombre"].'</option>';
                       }

                    ?>

                    </select>
                    <span class="input-group-addon"><button type="button" class="btn btn-default btn-xs" data-toggle="modal" data-target="#modalAgregarCliente" data-dismiss="modal">Agregar cliente</button></span>
                  </div>
                </div>


                <div class="form-group row nuevoProducto">
                </div>
                <input type="hidden" id="listaProductos" name="listaProductos">


                <button type="button" class="btn btn-default hidden-lg btnAgregarProducto">Agregar producto</button>
                <hr>
                <div class="row">

                  
                  <div class="col-xs-8 pull-right">
                    <table class="table">
                      <thead>
                        <tr>
                          <th>Impuesto</th>
                          <th>Total</th>      
                        </tr>
                      </thead>

                      <tbody>
                        <tr>
                          <td style="width: 50%">
                            <div class="input-group">
                                <?php
                                  $item = null;
                                  $valor = null;
                                  $respuesta = ControladorConfig::ctrMostrarConfig($item, $valor);

                                  foreach ($respuesta as $key => $value) {
                                    echo '<input type="number" class="form-control input-lg" min="0" id="nuevoImpuestoVenta" name="nuevoImpuestoVenta" placeholder="'.$value["iva"].'" value="'.$value["iva"].'" readonly required>';
                                  }
                                ?>
                               <input type="hidden" name="nuevoPrecioImpuesto" id="nuevoPrecioImpuesto" required>
                               <input type="hidden" name="nuevoPrecioNeto" id="nuevoPrecioNeto" required>
                              <span class="input-group-addon"><i class="fa fa-percent"></i></span>
                            </div>
                          </td>

                           <td style="width: 50%">
                            <div class="input-group">
                              <span class="input-group-addon"><i class="ion ion-social-usd"></i></span>
                              <input type="text" class="form-control input-lg" id="nuevoTotalVenta" name="nuevoTotalVenta" total="" placeholder="00000" readonly required>
                              <input type="hidden" name="totalVenta" id="totalVenta">
                            </div>
                          </td>
                        </tr>
                      </tbody>

                    </table>
                  </div>
                </div>
                <hr>


                <div class="form-group row">
                  <div class="col-xs-6" style="padding-right:0px">
                     <div class="input-group">
                        <select class="form-control" id="nuevoMetodoPago" name="nuevoMetodoPago" required>
                          <option value="">Seleccione método de pago</option>
                          <option value="Efectivo">Efectivo</option>
                          <option value="TC">Tarjeta Crédito</option>
                          <option value="TD">Tarjeta Débito</option>                  
                        </select>    
                    </div>
                  </div>

                  <div class="cajasMetodoPago"></div>
                  <input type="hidden" id="listaMetodoPago" name="listaMetodoPago">
                </div>
                <br>
              </div>
              
          </div>

          <div class="box-footer">
            <button type="submit" class="btn btn-primary pull-right">Guardar venta</button>
          </div>
        </form>

        <?php
          $guardarVenta = new ControladorVentas();
          $guardarVenta -> ctrCrearVenta();
        ?>

        </div>
      </div>


      <div class="col-lg-7 hidden-md hidden-sm hidden-xs">
        <div class="box box-warning">
          <div class="box-header with-border"></div>
          <div class="box-body">
            <table class="table table-bordered table-striped dt-responsive tablaVentas">
               
               <thead>
                 <tr>
                  <th style="width: 10px">#</th>
                  <th>Imagen</th>
                  <th>Código</th>
                  <th>Descripcion</th>
                  <th>Stock</th>
                  <th>Acciones</th>
                </tr>
              </thead>
            </table>
          </div>
        </div>
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
                <input type="text" class="form-control input-lg" name="nuevoNombre" placeholder="Ingresar a Nombre" required>
              </div>
            </div>

            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span> 
                <input type="text" class="form-control input-lg" name="nuevoApellido" placeholder="Ingresar su Apellido" required>
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
                <input type="text" class="form-control input-lg" name="nuevoTelefono" placeholder="Ingresar teléfono" data-inputmask="'mask':'(999) 999-9999'" data-mask required>
              </div>
            </div>

            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-phone"></i></span> 
                <input type="text" class="form-control input-lg" name="nuevoCelular" placeholder="Ingresar Celular" data-inputmask="'mask':'(9) 999-9999'" data-mask required>
              </div>
            </div>

            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-id-card"></i></span> 
                <input type="number" min="0" class="form-control input-lg" name="nuevoDocumentoId" placeholder="Ingresar documento" required>
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
                <span class="input-group-addon"><i class="fa fa-calendar"></i></span> 
                <input type="text" class="form-control input-lg" name="nuevaFechaNacimiento" placeholder="Ingresar fecha nacimiento" data-inputmask="'alias': 'yyyy/mm/dd'" data-mask required>
              </div>
            </div>

            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-check-square"></i></span> 
                <input type="text" class="form-control input-lg" name="nuevaDescripcion" placeholder="Descripción de Empresa u Razon Social" required>
              </div>
            </div>

            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-building"></i></span> 
                <input type="text" class="form-control input-lg" name="nuevaOrganizacion" placeholder="Ingrese Organización" required>
              </div>
            </div>

            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-commenting"></i></span> 
                <input type="text" class="form-control input-lg" name="nuevaRedesSociales" placeholder="Ingrese Redes Sociales" required>
              </div>
            </div>

          </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
          <button type="submit" class="btn btn-primary btnImprimirFactura">Guardar cliente</button>
        </div>
      </form>

      <?php
        $crearCliente = new ControladorClientes();
        $crearCliente -> ctrCrearCliente();
      ?>

    </div>
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
                        <h3 class="timeline-header text-center">Administrar Cotización</h3>
                      <div class="timeline-body">
                        <video width="400" controls>
                          <source src="vistas/img/video/tutorial1.mp4" type="video/mp4">
                        </video>
                        
                        <br><br>
                      </div>
                      <div class="timeline-footer">
                        <h4>Aquí el listado de las Cotización que han sido recientemente agregadas.</h4>
                      </div>
                  </div>
            </div>

            <div class="modal-footer">
              <button type="button" class="btn btn-info" data-dismiss="modal">Cerrar</button>
            </div>

          </div>
        </div>
      </div>

    </div>
  </div>
</div>
