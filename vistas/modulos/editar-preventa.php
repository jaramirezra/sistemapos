<div class="content-wrapper">
  <section class="content-header">
    <h1>
      Editar venta
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

                <?php

                    $item = "id";
                    $valor = $_GET["idPreVenta"];
                    $venta = ControladorPreventa::ctrMostrarPreventa($item, $valor);

                    $itemUsuario = "id";
                    $valorUsuario = $venta["id_vendedor"];
                    $vendedor = ControladorUsuarios::ctrMostrarUsuarios($itemUsuario, $valorUsuario);

                    $itemCliente = "id";
                    $valorCliente = $venta["id_cliente"];
                    $cliente = ControladorClientes::ctrMostrarClientes($itemCliente, $valorCliente);

                    $porcentajeImpuesto = $venta["impuesto"] * 100 / $venta["neto"];

                ?>

                <div class="form-group">
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-user"></i></span> 
                    <input type="text" class="form-control" id="nuevoVendedor" value="<?php echo $vendedor["nombre"]; ?>" readonly>
                    <input type="hidden" name="idVendedor" value="<?php echo $vendedor["id"]; ?>">
                  </div>
                </div> 

                <div class="form-group">
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-key"></i></span>
                   <input type="text" class="form-control" id="nuevaVenta" name="editarVenta" value="<?php echo $venta["codigo"]; ?>" readonly>
                  </div>
                </div>

                <div class="form-group">
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-users"></i></span>
                    <select class="form-control" id="seleccionarCliente" name="seleccionarCliente" required>
                    <option value="<?php echo $cliente["id"]; ?>"><?php echo $cliente["nombre"]; ?></option>

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

                <?php

                $listaProducto = json_decode($venta["productos"], true);

                foreach ($listaProducto as $key => $value) {

                  $item = "id";
                  $valor = $value["id"];
                  $orden = "id";
                  $respuesta = ControladorProductos::ctrMostrarProductos($item, $valor, $orden);

                  $stockAntiguo = $respuesta["stock"] + $value["cantidad"];
                  
                  echo '<div class="row" style="padding:5px 15px">
                        <div class="col-xs-6" style="padding-right:0px">
                          <div class="input-group">
                            <span class="input-group-addon"><button type="button" class="btn btn-danger btn-xs quitarProducto" idProducto="'.$value["id"].'"><i class="fa fa-times"></i></button></span>
                            <input type="text" class="form-control nuevaDescripcionProducto" idProducto="'.$value["id"].'" name="agregarProducto" value="'.$value["descripcion"].'" readonly required>
                          </div>
                        </div>

                        <div class="col-xs-3">
                          <input type="number" class="form-control nuevaCantidadProducto" name="nuevaCantidadProducto" min="1" value="'.$value["cantidad"].'" stock="'.$stockAntiguo.'" nuevoStock="'.$value["stock"].'" required>
                        </div>
                        <div class="col-xs-3 ingresoPrecio" style="padding-left:0px">
                          <div class="input-group">
                            <span class="input-group-addon"><i class="ion ion-social-usd"></i></span>
                            <input type="text" class="form-control nuevoPrecioProducto" precioReal="'.$respuesta["precio_venta"].'" name="nuevoPrecioProducto" value="'.$value["total"].'" readonly required>
                          </div>
                        </div>
                      </div>';
                }

                ?>

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
                              <input type="number" class="form-control input-lg" min="0" id="nuevoImpuestoVenta" name="nuevoImpuestoVenta" value="<?php echo $porcentajeImpuesto; ?>" required>
                               <input type="hidden" name="nuevoPrecioImpuesto" id="nuevoPrecioImpuesto" value="<?php echo $venta["impuesto"]; ?>" required>
                               <input type="hidden" name="nuevoPrecioNeto" id="nuevoPrecioNeto" value="<?php echo $venta["neto"]; ?>" required>
                              <span class="input-group-addon"><i class="fa fa-percent"></i></span>
                            </div>
                          </td>
                           <td style="width: 50%">
                            <div class="input-group">
                              <span class="input-group-addon"><i class="ion ion-social-usd"></i></span>
                              <input type="text" class="form-control input-lg" id="nuevoTotalVenta" name="nuevoTotalVenta" total="<?php echo $venta["neto"]; ?>"  value="<?php echo $venta["total"]; ?>" readonly required>
                              <input type="hidden" name="totalVenta" value="<?php echo $venta["total"]; ?>" id="totalVenta">
                            </div>
                          </td>
                        </tr>
                      </tbody>

                    </table>
                  </div>
                </div>
                <hr>

                <label>Adicionales para la Factura</label>
                  <div class="form-group">
                    <label class="bmd-label-floating"> En la casilla coloque los que quiere agregar de notas a la cotizacion.</label>
                    <textarea class="form-control" rows="5" name="nuevosCambios" placeholder=""><?php echo $venta["notas"]; ?></textarea>
                  </div>

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


          <div class="box-footer">
            <button type="submit" class="btn btn-primary pull-right">Guardar cambios</button>
          </div>
        </form>

        <?php
          $editarVenta = new ControladorPreventa();
          $editarVenta -> ctrEditarPreventa();
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

        <div class="modal-header" style="background:#3c8dbc; color:white">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Agregar cliente</h4>
        </div>

        <div class="modal-body">
          <div class="box-body">

            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span> 
                <input type="text" class="form-control input-lg" name="nuevoCliente" placeholder="Ingresar nombre" required>
              </div>
            </div>

            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-key"></i></span> 
                <input type="number" min="0" class="form-control input-lg" name="nuevoDocumentoId" placeholder="Ingresar documento" required>
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
