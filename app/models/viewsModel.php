<?php
	
	namespace app\models;

	class viewsModel{

		/*---------- Modelo obtener vista ----------*/
		protected function obtenerVistasModelo($vista){

			$listaBlanca=["dashboard","nuevoCajero","listaCajero","buscarCajero","actualizarCajero","nuevoUsuario","verListaUsuarios","actualizacionUsuario","vistaBuscarUsuario","vistaFotoUsuario","nuevoCliente","vistaListaClientes","vistaBusquedaCliente","vistaActualizacionCliente","nuevaCategoria","listaCategoria","busquedaCategoria","actualizarCategoria","nuevoProducto","listaProducto","buscarProducto","actualizarProducto","fotoProducto","categoriaProducto","nuevaCompania","nuevaVenta","listaVenta","busquedaVenta","detallesVenta","logOut", "actualizarEmpleado","empleadoBuscar", "empleadoNuevo", "empleadoLista"];

			if(in_array($vista, $listaBlanca)){
				if(is_file("./app/views/content/".$vista."-vista.php")){
					$contenido="./app/views/content/".$vista."-vista.php";
				}else{
					$contenido="404";
				}
			}elseif($vista=="login" || $vista=="index"){
				$contenido="login";
			}else{
				$contenido="404";
			}
			return $contenido;
		}

	}