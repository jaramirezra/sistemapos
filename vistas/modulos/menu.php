<aside class="main-sidebar">
	 <section class="sidebar">
		<ul class="sidebar-menu">

		<?php

		if($_SESSION["perfil"] == "Administrador"){

			echo '<li class="active">
					<a href="inicio">
						<i class="fa fa-home"></i>
						<span>Inicio</span>
					</a>
				</li>';
		}

		if($_SESSION["perfil"] == "Administrador"){

			echo '<li>
					<a href="usuarios">
						<i class="fa fa-user-plus"></i>
						<span>Rol</span>
					</a>
				</li>';

		}

		if($_SESSION["perfil"] == "Administrador" || $_SESSION["perfil"] == "Vendedor"){

			echo '<li>
				<a href="clientes">
					<i class="fa fa-users"></i>
					<span>Clientes</span>
				</a>
			</li>';

		}

		if($_SESSION["perfil"] == "Administrador" || $_SESSION["perfil"] == "Especial"){

			echo '
			<li>
				<a href="proveedores">
					<i class="fa fa-truck"></i>
					<span>Proveedores</span>
				</a>
			</li>';

		}

		if($_SESSION["perfil"] == "Administrador" || $_SESSION["perfil"] == "Especial"){

			echo '
			<li>
				<a href="productos">
					<i class="fa fa-cubes"></i>
					<span>Productos</span>
				</a>
			</li>';

		}

		if($_SESSION["perfil"] == "Administrador"){

			echo '<li>
				<a href="reportes">
					<i class="fa fa-pie-chart" aria-hidden="true"></i>
					<span>Reportes</span>
				</a>
			</li>';

		}
		

		if($_SESSION["perfil"] == "Administrador" || $_SESSION["perfil"] == "Vendedor"){

			echo '<li class="treeview">

				<a href="#">
					<i class="fa fa-list-alt"></i>
					<span>Cotización</span>
					<span class="pull-right-container">
						<i class="fa fa-angle-left pull-right"></i>
					</span>
				</a>

				<ul class="treeview-menu">
					<li>
						<a href="preventa">
							<i class="fa fa-circle-o"></i>
							<span>Banco de Cotización</span>
						</a>
					</li>

					<li>
						<a href="crear-Preventa">
							<i class="fa fa-circle-o"></i>
							<span>Nueva Cotización</span>
						</a>
					</li>';
					
				echo '</ul>
			</li>';

		}


		if($_SESSION["perfil"] == "Administrador" || $_SESSION["perfil"] == "Vendedor"){

			echo '<li class="treeview">

				<a href="#">
					<i class="fa fa-clipboard"></i>
					<span>Ventas</span>
					<span class="pull-right-container">
						<i class="fa fa-angle-left pull-right"></i>
					</span>
				</a>

				<ul class="treeview-menu">
					<li>
						<a href="ventas">
							<i class="fa fa-circle-o"></i>
							<span>Banco de ventas</span>
						</a>
					</li>

					<li>
						<a href="Ticket">
							<i class="fa fa-circle-o"></i>
							<span>Banco de Ticket</span>
						</a>
					</li>

					<li>
						<a href="crear-venta">
							<i class="fa fa-circle-o"></i>
							<span>Nueva venta</span>
						</a>
					</li>';


				echo '</ul>
			</li>';

		}
				echo '</ul>
			</li>';

		?>

		</ul>
	 </section>
</aside>