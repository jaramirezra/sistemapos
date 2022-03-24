<div id="back"></div>
<div class="login-box">
  <div class="login-logo">
  </div>
   
      <div class="login-box-body">
      <img src="vistas/img/plantilla/logo-blanco-bloque.png" class="img-responsive" style="padding:30px 100px 0px 100px">
      <hr>
      <p class="login-box-msg">Inicie sesión en su cuenta:</p>

      <form method="post">
        <div class="form-group has-feedback">
          <input type="email" class="form-control" placeholder="Correo Electronico" name="ingUsuario" required>
          <span class="glyphicon glyphicon-user form-control-feedback"></span>
        </div>

        <div class="form-group has-feedback">
          <input type="password" class="form-control" placeholder="Contraseña" name="ingPassword" required>
          <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        </div>

        <div class="row">
          <div class="col-xs-4">
              <button type="submit" class="btn btn-primary btn-block btn-flat">Ingresar</button>
          </div>
          <a href="#modalPassword" data-dismiss="modal" data-toggle="modal" class="btn btn-primary">¿Olvidaste tu Contraseña?</a>
        </div>

        <?php
        $login = new ControladorUsuarios();
        $login -> ctrIngresoUsuario();
        ?>

    </form>
  </div>
</div>


<div class="modal" id="modalPassword">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header" style="background:#22806d; color:white">
        <h4 class="modal-title">Solicitud de Nueva Contraseña</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <div class="modal-body">
      <form method="post">
      <label class="text-muted">Escribe el correo electrónico con el que estás registrado y allí te enviaremos una contraseña
      nueva contraseña:</label>
      <br><br>
        <div class="form-group has-feedback">
          <input type="email" class="form-control" id="passEmail" name="passEmail" placeholder="Correo Electronico" required>
          <span class="glyphicon glyphicon-user form-control-feedback"></span>
        </div>

        <div class="modal-footer">
          <button type="submit" class="btn btn-primary btn-block btn-flat" value="Enviar">Ingresar</button>
        </div>

        <?php
        $password = new ControladorUsuarios();
        $password -> ctrOlvidoPassword();
        ?>

      </form>
    </div>
  </div>
</div>