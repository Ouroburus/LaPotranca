<section class="full-width navLateral scroll" id="navLateral">
	<div class="full-width navLateral-body">
		<div class="full-width navLateral-body-logo has-text-centered tittles is-uppercase">
			Sistema de ventas 
		</div>
		<figure class="full-width" style="height: 77px;">
			<div class="navLateral-body-cl">
				<?php
                    if(is_file("./app/views/fotos/".$_SESSION['foto'])){
                        echo '<img class="is-rounded img-responsive" src="'.APP_URL.'app/views/fotos/'.$_SESSION['foto'].'">';
                    }else{
                        echo '<img class="is-rounded img-responsive" src="'.APP_URL.'app/views/fotos/default.png">';
                    }
                ?>
			</div>
			<figcaption class="navLateral-body-cr">
				<span>
					<?php echo $_SESSION['nombre']; ?><br>
					<small><?php echo $_SESSION['usuario']; ?></small>
				</span>
			</figcaption>
		</figure>
		<div class="full-width tittles navLateral-body-tittle-menu has-text-centered is-uppercase">
			<i class="fas fa-th-large fa-fw"></i> &nbsp; <?php echo APP_NAME; ?>
		</div>
		<nav class="full-width">
			<ul class="full-width list-unstyle menu-principal">

				<li class="full-width">
					<a href="<?php echo APP_URL; ?>dashboard/" class="full-width">
						<div class="navLateral-body-cl">
							<i class="fab fa-dashcube fa-fw"></i>
						</div>
						<div class="navLateral-body-cr">
							Inicio
						</div>
					</a>
				</li>

				<li class="full-width divider-menu-h"></li>

				<li class="full-width">
					<a href="#" class="full-width btn-subMenu">
						<div class="navLateral-body-cl">
							<i class="fas fa-cash-register fa-fw"></i>
						</div>
						<div class="navLateral-body-cr">
							CAJAS
						</div>
						<span class="fas fa-chevron-down"></span>
					</a>
					<ul class="full-width menu-principal sub-menu-options">
						<li class="full-width">
							<a href="<?php echo APP_URL; ?>nuevoCajero/" class="full-width">
								<div class="navLateral-body-cl">
									<i class="fas fa-cash-register fa-fw"></i>
								</div>
								<div class="navLateral-body-cr">
									Nueva caja
								</div>
							</a>
						</li>
						<li class="full-width">
							<a href="<?php echo APP_URL; ?>listaCajero/" class="full-width">
								<div class="navLateral-body-cl">
									<i class="fas fa-clipboard-list fa-fw"></i>
								</div>
								<div class="navLateral-body-cr">
									Lista de cajas
								</div>
							</a>
						</li>
						<li class="full-width">
							<a href="<?php echo APP_URL; ?>buscarCajero/" class="full-width">
								<div class="navLateral-body-cl">
									<i class="fas fa-search fa-fw"></i>
								</div>
								<div class="navLateral-body-cr">
									Buscar caja
								</div>
							</a>
						</li>
					</ul>
				</li>

				<li class="full-width divider-menu-h"></li>

				<li class="full-width">
					<a href="#" class="full-width btn-subMenu">
						<div class="navLateral-body-cl">
							<i class="fas fa-users fa-fw"></i>
						</div>
						<div class="navLateral-body-cr">
							USUARIOS
						</div>
						<span class="fas fa-chevron-down"></span>
					</a>
					<ul class="full-width menu-principal sub-menu-options">
						<li class="full-width">
							<a href="<?php echo APP_URL; ?>nuevoUsuario/" class="full-width">
								<div class="navLateral-body-cl">
									<i class="fas fa-cash-register fa-fw"></i>
								</div>
								<div class="navLateral-body-cr">
									Nuevo usuario
								</div>
							</a>
						</li>
						<li class="full-width">
							<a href="<?php echo APP_URL; ?>verListaUsuarios/" class="full-width">
								<div class="navLateral-body-cl">
									<i class="fas fa-clipboard-list fa-fw"></i>
								</div>
								<div class="navLateral-body-cr">
									Lista de usuarios
								</div>
							</a>
						</li>
						<li class="full-width">
							<a href="<?php echo APP_URL; ?>vistaBuscarUsuario/" class="full-width">
								<div class="navLateral-body-cl">
									<i class="fas fa-search fa-fw"></i>
								</div>
								<div class="navLateral-body-cr">
									Buscar usuario
								</div>
							</a>
						</li>
					</ul>
				</li>

				<li class="full-width divider-menu-h"></li>

				<li class="full-width">
					<a href="#" class="full-width btn-subMenu">
						<div class="navLateral-body-cl">
							<i class="fas fa-address-book fa-fw"></i>
						</div>
						<div class="navLateral-body-cr">
							CLIENTES
						</div>
						<span class="fas fa-chevron-down"></span>
					</a>
					<ul class="full-width menu-principal sub-menu-options">
						<li class="full-width">
							<a href="<?php echo APP_URL; ?>nuevoCliente/" class="full-width">
								<div class="navLateral-body-cl">
									<i class="fas fa-male fa-fw"></i>
								</div>
								<div class="navLateral-body-cr">
									Nuevo cliente
								</div>
							</a>
						</li>
						<li class="full-width">
							<a href="<?php echo APP_URL; ?>vistaListaClientes/" class="full-width">
								<div class="navLateral-body-cl">
									<i class="fas fa-clipboard-list fa-fw"></i>
								</div>
								<div class="navLateral-body-cr">
									Lista de clientes
								</div>
							</a>
						</li>
						<li class="full-width">
							<a href="<?php echo APP_URL; ?>vistaBusquedaCliente/" class="full-width">
								<div class="navLateral-body-cl">
									<i class="fas fa-search fa-fw"></i>
								</div>
								<div class="navLateral-body-cr">
									Buscar cliente
								</div>
							</a>
						</li>
					</ul>
				</li>

				<li class="full-width divider-menu-h"></li>

				<li class="full-width">
					<a href="#" class="full-width btn-subMenu">
						<div class="navLateral-body-cl">
							<i class="fas fa-tags fa-fw"></i>
						</div>
						<div class="navLateral-body-cr">
							CATEGORIAS
						</div>
						<span class="fas fa-chevron-down"></span>
					</a>
					<ul class="full-width menu-principal sub-menu-options">
						<li class="full-width">
							<a href="<?php echo APP_URL; ?>nuevaCategoria/" class="full-width">
								<div class="navLateral-body-cl">
									<i class="fas fa-tag fa-fw"></i>
								</div>
								<div class="navLateral-body-cr">
									Nueva categoría
								</div>
							</a>
						</li>
						<li class="full-width">
							<a href="<?php echo APP_URL; ?>listaCategoria/" class="full-width">
								<div class="navLateral-body-cl">
									<i class="fas fa-clipboard-list fa-fw"></i>
								</div>
								<div class="navLateral-body-cr">
									Lista de categorías
								</div>
							</a>
						</li>
						<li class="full-width">
							<a href="<?php echo APP_URL; ?>busquedaCategoria/" class="full-width">
								<div class="navLateral-body-cl">
									<i class="fas fa-search fa-fw"></i>
								</div>
								<div class="navLateral-body-cr">
									Buscar categoría
								</div>
							</a>
						</li>
					</ul>
				</li>

				<li class="full-width divider-menu-h"></li>

				<li class="full-width">
					<a href="#" class="full-width btn-subMenu">
						<div class="navLateral-body-cl">
							<i class="fas fa-cubes fa-fw"></i>
						</div>
						<div class="navLateral-body-cr">
							PRODUCTOS
						</div>
						<span class="fas fa-chevron-down"></span>
					</a>
					<ul class="full-width menu-principal sub-menu-options">
						<li class="full-width">
							<a href="<?php echo APP_URL; ?>nuevoProducto/" class="full-width">
								<div class="navLateral-body-cl">
									<i class="fas fa-box fa-fw"></i>
								</div>
								<div class="navLateral-body-cr">
									Nuevo producto
								</div>
							</a>
						</li>
						<li class="full-width">
							<a href="<?php echo APP_URL; ?>listaProducto/" class="full-width">
								<div class="navLateral-body-cl">
									<i class="fas fa-clipboard-list fa-fw"></i>
								</div>
								<div class="navLateral-body-cr">
									Lista de productos
								</div>
							</a>
						</li>
						<li class="full-width">
							<a href="<?php echo APP_URL; ?>categoriaProducto/" class="full-width">
								<div class="navLateral-body-cl">
									<i class="fas fa-boxes fa-fw"></i>
								</div>
								<div class="navLateral-body-cr">
									Productos por categoría
								</div>
							</a>
						</li>
						<li class="full-width">
							<a href="<?php echo APP_URL; ?>buscarProducto/" class="full-width">
								<div class="navLateral-body-cl">
									<i class="fas fa-search fa-fw"></i>
								</div>
								<div class="navLateral-body-cr">
									Buscar producto
								</div>
							</a>
						</li>
					</ul>
				</li>

				<li class="full-width divider-menu-h"></li>

				<li class="full-width">
					<a href="#" class="full-width btn-subMenu">
						<div class="navLateral-body-cl">
							<i class="fas fa-shopping-cart fa-fw"></i>
						</div>
						<div class="navLateral-body-cr">
							VENTAS
						</div>
						<span class="fas fa-chevron-down"></span>
					</a>
					<ul class="full-width menu-principal sub-menu-options">
						<li class="full-width">
							<a href="<?php echo APP_URL; ?>nuevaVenta/" class="full-width">
								<div class="navLateral-body-cl">
									<i class="fas fa-cart-plus fa-fw"></i>
								</div>
								<div class="navLateral-body-cr">
									Nueva venta
								</div>
							</a>
						</li>
						<li class="full-width">
							<a href="<?php echo APP_URL; ?>listaVenta/" class="full-width">
								<div class="navLateral-body-cl">
									<i class="fas fa-clipboard-list fa-fw"></i>
								</div>
								<div class="navLateral-body-cr">
									Lista de ventas
								</div>
							</a>
						</li>
						<li class="full-width">
							<a href="<?php echo APP_URL; ?>busquedaVenta/" class="full-width">
								<div class="navLateral-body-cl">
									<i class="fas fa-search-dollar fa-fw"></i>
								</div>
								<div class="navLateral-body-cr">
									Buscar venta
								</div>
							</a>
						</li>
					</ul>
				</li>

				<li class="full-width divider-menu-h"></li>

				<li class="full-width">
					<a href="#" class="full-width btn-subMenu">
						<div class="navLateral-body-cl">
							<i class="fas fa-cogs fa-fw"></i>
						</div>
						<div class="navLateral-body-cr">
							CONFIGURACIONES
						</div>
						<span class="fas fa-chevron-down"></span>
					</a>
					<ul class="full-width menu-principal sub-menu-options">
						<li class="full-width">
							<a href="<?php echo APP_URL; ?>nuevaCompania/" class="full-width">
								<div class="navLateral-body-cl">
									<i class="fas fa-store-alt fa-fw"></i>
								</div>
								<div class="navLateral-body-cr">
									Datos de empresa
								</div>
							</a>
						</li>
						<li class="full-width">
							<a href="<?php echo APP_URL."actualizacionUsuario/".$_SESSION['id']."/"; ?>" class="full-width">
								<div class="navLateral-body-cl">
									<i class="fas fa-user-tie fa-fw"></i>
								</div>
								<div class="navLateral-body-cr">
									Mi cuenta
								</div>
							</a>
						</li>
						<li class="full-width">
							<a href="<?php echo APP_URL."vistaFotoUsuario/".$_SESSION['id']."/"; ?>" class="full-width">
								<div class="navLateral-body-cl">
									<i class="fas fa-camera"></i>
								</div>
								<div class="navLateral-body-cr">
									Mi foto
								</div>
							</a>
						</li>
					</ul>
				</li>

				<li class="full-width divider-menu-h"></li>

				<li class="full-width mt-5">
					<a href="<?php echo APP_URL."logOut/"; ?>" class="full-width btn-exit" >
						<div class="navLateral-body-cl">
							<i class="fas fa-power-off"></i>
						</div>
						<div class="navLateral-body-cr">
							Cerrar sesión
						</div>
					</a>
				</li>

			</ul>
		</nav>
	</div>
</section>