 <header class="main-header">
 	
	<a href="inicio" class="logo">
		<span class="logo-mini">
			<img src="vistas/img/plantilla/icono-blanco.png" class="img-responsive" style="padding:10px">
		</span>

		<span class="logo-lg">
			<img src="vistas/img/plantilla/logo-blanco-lineal.png" class="img-responsive" style="padding:10px 0px">
		</span>
	</a>

	<nav class="navbar navbar-static-top" role="navigation">
		
	 	<a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
      <span class="sr-only">Toggle navigation</span>
    </a>
				
		<div class="navbar-custom-menu">
			<ul class="nav navbar-nav">
				<li class="dropdown user user-menu">
				<a href="#modal-perfil" class="dropdown-toggle" data-toggle="dropdown">
				<?php
					if($_SESSION["foto"] != ""){
						echo '<img src="'.$_SESSION["foto"].'" class="user-image">';
					}else{
						echo '<img src="vistas/img/usuarios/default/anonymous.png" class="user-image">';
					}
				?>
				<span class="hidden-xs"><?php  echo $_SESSION["nombre"]; ?></span>
				</a>
		
					<ul class="dropdown-menu">

					<li class="user-header">
							<?php
							if($_SESSION["foto"] != ""){
								echo '<img src="'.$_SESSION["foto"].'" class="img-circle" alt="User Image">';
							}else{
								echo '<img src="vistas/img/usuarios/default/anonymous.png" clas	s="user-image">';
							}

							?>

						<p>
						<?php  echo $_SESSION["nombre"]; ?>
						<small><?php  echo $_SESSION["usuario"]; ?></small>
						</p>
						<?php				
							$item = null;
							$valor = null;
							$usuarios = ControladorUsuarios::ctrMostrarUsuarios($item, $valor);
						?>
					<li class="user-footer">
						<div class="pull-left">
						<button class="btn btn-info btn-sm btnEditarUsuario" idUsuario="<?php echo $_SESSION["id"] ?>" data-toggle="modal" data-target="#modalEditarUsuario"><i>Perfil</i></button>
						</div>
						<div class="pull-right">
						<a href="salir" class="btn btn-info btn-sm">Salir</a>
						</div>
					</li>
						
						<ul class="dropdown-menu">
							<li class="user-body">
								<div class="pull-right">	 
									<a href="#" class="btn btn-default btn-flat">Salir</a>
								</div>
							</li>
						</ul>
				</li>
			</ul>
			
			<?php
				if($_SESSION["perfil"] == "Administrador"){
					echo '<li><a href="config"><i class="fa fa-cog" aria-hidden="true"></i></a>';
				}
			?>

		</div>
	</nav>
 </header>

 <div id="modalEditarUsuario" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <form role="form" method="post" enctype="multipart/form-data">

        <div class="modal-header" style="background:#08070766; color:white">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Editar usuarios mi perro</h4>
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
                <input type="text" class="form-control input-lg" id="editarUsuario" name="editarUsuario" value="" readonly>
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
                <input type="text" class="form-control input-lg" id="editarDescripcion" name="editarDescripcion">
              </div>
            </div>

            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-users"></i></span>
				<input type="text" class="form-control input-lg" id="editarPerfil" name="editarPerfil" value="" readonly>
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
