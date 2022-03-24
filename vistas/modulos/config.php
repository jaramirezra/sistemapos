
<div class="content-wrapper">
  <section class="content-header">
    
    <h1>
      Configuración
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
      <li class="active">Configuración</li>
    </ol>
  </section>

  <section class="content">
  <div class="content">

    <?php
      $item = null;
      $valor = null;
      $Configurar = ControladorConfig::ctrMostrarConfig($item, $valor);
      
      foreach ($Configurar as $key => $value) {
        
      }
    ?>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8">
              <div class="card">
                <div class="card-header card-header-primary">
                  <p class="card-category">Configure los ajustes para la pagina y factura</p>
                </div>
                <div class="card-body">
                  <form role="form" method="post" enctype="multipart/form-data">
                    <div class="row">

                      <div class="col-md-5">
                        <div class="form-group">
                          <label class="bmd-label-floating">Version Actual de Sistema Pos</label>
                          <input type="text" class="form-control" id="Version" name="Version" placeholder="Version de Sistema" readonly>
                        </div>
                      </div>

                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">Nombre de la Empresa</label>
                          <input type="text" class="form-control" id="NuevoNombre" name="NuevoNombre" placeholder="Ingresar Nombre de la Empresa">
                        </div>
                      </div>

                      <div class="col-md-4">
                        <div class="form-group">
                          <label class="bmd-label-floating">NIT de la Empresa</label>
                          <input type="text" class="form-control" id="EmpresaNueva" name="EmpresaNueva" placeholder="Ingresar NIT de la Empresa">
                        </div>
                      </div>

                    <div class="col-md-2">
                      <div class="form-group">
                          <label class="bmd-label-floating">IVA</label>
                          <input type="number" class="form-control" id="nuevoIva" name="nuevoIva" placeholder="Ingresar Iva"> 
                      </div>
                    </div>

                      <div class="col-md-3">
                        <div class="form-group">
                          <label class="bmd-label-floating">Telefono</label>
                          <input type="number" class="form-control" id="nuevoTelefono" name="nuevoTelefono" placeholder="Ingresar Telefono">
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-md-5">
                        <div class="form-group">
                          <label class="bmd-label-floating">Correo Electronico de la Empresa</label>
                          <input type="email" class="form-control" id="nuevoCorreo" name="nuevoCorreo" placeholder="Ingresar Correo Electronico de la Empresa">
                        </div>
                      </div>

                    <div class="col-md-3">
                        <div class="form-group">
                          <label class="bmd-label-floating">Numero de la Factura</label>
                          <input type="number" class="form-control" id="nuevoCodigo" name="nuevoCodigo" placeholder="Numeración de la Factura">
                        </div>
                      </div>
                    </div>

                      <div class="col-md-5">
                        <div class="form-group">
                          <label class="bmd-label-floating">Direccion de la Empresa</label>
                          <input type="text" class="form-control" id="nuevaDireccion" name="nuevaDireccion" placeholder="Ingresar Direccion de la Empresa">
                        </div>
                      </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                          <label class="bmd-label-floating">Ciudad de la Empresa</label>
                          <input type="text" class="form-control" id="nuevaCiudad" name="nuevaCiudad" placeholder="Ciudad de la Empresa">
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">
                          <label>Adicionales para la Factura</label>
                          <div class="form-group">
                            <label class="bmd-label-floating"> En la casilla coloque los que quiere agregar al final de la factura.</label>
                            <textarea class="form-control" rows="5" id="nuevosCambios" name="nuevosCambios" placeholder="Ingresar Texto"></textarea>
                          </div>
                        </div>
                      </div>
                    </div>
                    

                    <div class="form-group">
                        <div class="panel">SUBIR FOTO</div>
                            <input type="file" class="nuevaFoto" name="nuevaFoto">
                            <p class="help-block">Peso máximo de la foto 2MB, La imagen debe ser en formato PNG.</p>
                            <br>
                            <center><img src="" class="img-thumbnail previsualizar" width="300px"></center>
                            <input type="hidden" name="fotoActual" id="fotoActual">
                            <center><h5>Foto para logo de la factura.</h5></center>               
                        </div>
                    </div>

                    <center><a class="btn btn-primary btnEditarConfig" idConfig="1" >Cargar Configuración</a>
                    <br><br>
                    <button type="submit" class="btn btn-primary" value="Enviar" name="enviar">Guardar Cambios</button></center>
                      <?php
                        $editarConfig = new ControladorConfig();
                        $editarConfig -> ctrEditarConfig();
                      ?>
                  </form>
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
                    <h3 class="timeline-header text-center">Subir Imagenes para factura</h3>
                <div class="timeline-body">
                    <video width="400" controls>
                    <source src="vistas/img/video/tutorial1.mp4" type="video/mp4">
                    </video>
                      
                    <br><br>
                 </div>
                <div class="timeline-footer">
                    <h4>Descripción para los formatos de imagen para la factura.</h4>
                </div>
            </div>
        </div>

        <div class="modal-footer">
        <button type="button" class="btn btn-info" data-dismiss="modal">Cerrar</button>
        </div>

    </div>
    </div>
</div>

