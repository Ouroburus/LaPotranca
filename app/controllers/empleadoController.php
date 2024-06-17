<?php

	namespace app\controllers;
	use app\models\mainModel;

	class empleadoController extends mainModel{

		/*----------  Controlador registrar empleado  ----------*/
		public function registrarempleadoControlador(){

			# Almacenando datos#
		    $tipo_documento=$this->limpiarCadena($_POST['empleado_tipo_documento']);
		    $numero_documento=$this->limpiarCadena($_POST['empleado_numero_documento']);
		    $nombre=$this->limpiarCadena($_POST['empleado_nombre']);
		    $apellido=$this->limpiarCadena($_POST['empleado_apellido']);

		    $provincia=$this->limpiarCadena($_POST['empleado_provincia']);
		    $ciudad=$this->limpiarCadena($_POST['empleado_ciudad']);
		    $direccion=$this->limpiarCadena($_POST['empleado_direccion']);

		    $telefono=$this->limpiarCadena($_POST['empleado_telefono']);
		    $email=$this->limpiarCadena($_POST['empleado_email']);

		    # Verificando campos obligatorios #
            if($numero_documento=="" || $nombre=="" || $apellido=="" || $provincia=="" || $ciudad=="" || $direccion==""){
            	$alerta=[
					"tipo"=>"simple",
					"titulo"=>"Ocurrió un error inesperado",
					"texto"=>"No has llenado todos los campos que son obligatorios",
					"icono"=>"error"
				];
				return json_encode($alerta);
		        exit();
            }

            # Verificando integridad de los datos #
		    if($this->verificarDatos("[a-zA-Z0-9-]{7,30}",$numero_documento)){
		    	$alerta=[
					"tipo"=>"simple",
					"titulo"=>"Ocurrió un error inesperado",
					"texto"=>"El NUMERO DE DOCUMENTO no coincide con el formato solicitado",
					"icono"=>"error"
				];
				return json_encode($alerta);
		        exit();
		    }

		    if($this->verificarDatos("[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,40}",$nombre)){
		    	$alerta=[
					"tipo"=>"simple",
					"titulo"=>"Ocurrió un error inesperado",
					"texto"=>"El NOMBRE no coincide con el formato solicitado",
					"icono"=>"error"
				];
				return json_encode($alerta);
		        exit();
		    }

		    if($this->verificarDatos("[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,40}",$apellido)){
		    	$alerta=[
					"tipo"=>"simple",
					"titulo"=>"Ocurrió un error inesperado",
					"texto"=>"El APELLIDO no coincide con el formato solicitado",
					"icono"=>"error"
				];
				return json_encode($alerta);
		        exit();
		    }

		    if($this->verificarDatos("[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{4,30}",$provincia)){
		    	$alerta=[
					"tipo"=>"simple",
					"titulo"=>"Ocurrió un error inesperado",
					"texto"=>"El ESTADO, PROVINCIA O DEPARTAMENTO no coincide con el formato solicitado",
					"icono"=>"error"
				];
				return json_encode($alerta);
		        exit();
		    }

		    if($this->verificarDatos("[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{4,30}",$ciudad)){
		    	$alerta=[
					"tipo"=>"simple",
					"titulo"=>"Ocurrió un error inesperado",
					"texto"=>"La CIUDAD O PUEBLO no coincide con el formato solicitado",
					"icono"=>"error"
				];
				return json_encode($alerta);
		        exit();
		    }

		    if($this->verificarDatos("[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{4,70}",$direccion)){
		    	$alerta=[
					"tipo"=>"simple",
					"titulo"=>"Ocurrió un error inesperado",
					"texto"=>"La DIRECCION O CALLE no coincide con el formato solicitado",
					"icono"=>"error"
				];
				return json_encode($alerta);
		        exit();
		    }

		    if($telefono!=""){
		    	if($this->verificarDatos("[0-9()+]{8,20}",$telefono)){
			    	$alerta=[
						"tipo"=>"simple",
						"titulo"=>"Ocurrió un error inesperado",
						"texto"=>"El TELEFONO no coincide con el formato solicitado",
						"icono"=>"error"
					];
					return json_encode($alerta);
			        exit();
			    }
		    }

		    # Comprobando tipo de documento #
			if(!in_array($tipo_documento, DOCUMENTOS_USUARIOS)){
				$alerta=[
					"tipo"=>"simple",
					"titulo"=>"Ocurrió un error inesperado",
					"texto"=>"El TIPO DE DOCUMENTO no es correcto o no lo ha seleccionado",
					"icono"=>"error"
				];
				return json_encode($alerta);
		        exit();
			}

		    # Verificando email #
		    if($email!=""){
				if(filter_var($email, FILTER_VALIDATE_EMAIL)){
					$check_email=$this->ejecutarConsulta("SELECT empleado_email FROM empleado WHERE empleado_email='$email'");
					if($check_email->rowCount()>0){
						$alerta=[
							"tipo"=>"simple",
							"titulo"=>"Ocurrió un error inesperado",
							"texto"=>"El EMAIL que acaba de ingresar ya se encuentra registrado en el sistema, por favor verifique e intente nuevamente",
							"icono"=>"error"
						];
						return json_encode($alerta);
						exit();
					}
				}else{
					$alerta=[
						"tipo"=>"simple",
						"titulo"=>"Ocurrió un error inesperado",
						"texto"=>"Ha ingresado un correo electrónico no valido",
						"icono"=>"error"
					];
					return json_encode($alerta);
					exit();
				}
            }

            # Comprobando documento #
		    $check_documento=$this->ejecutarConsulta("SELECT empleado_id FROM empleado WHERE empleado_tipo_documento='$tipo_documento' AND empleado_numero_documento='$numero_documento'");
		    if($check_documento->rowCount()>0){
		    	$alerta=[
					"tipo"=>"simple",
					"titulo"=>"Ocurrió un error inesperado",
					"texto"=>"El número y tipo de documento ingresado ya se encuentra registrado en el sistema",
					"icono"=>"error"
				];
				return json_encode($alerta);
		        exit();
		    }


		    $empleado_datos_reg=[
				[
					"campo_nombre"=>"empleado_tipo_documento",
					"campo_marcador"=>":TipoDocumento",
					"campo_valor"=>$tipo_documento
				],
				[
					"campo_nombre"=>"empleado_numero_documento",
					"campo_marcador"=>":NumeroDocumento",
					"campo_valor"=>$numero_documento
				],
				[
					"campo_nombre"=>"empleado_nombre",
					"campo_marcador"=>":Nombre",
					"campo_valor"=>$nombre
				],
				[
					"campo_nombre"=>"empleado_apellido",
					"campo_marcador"=>":Apellido",
					"campo_valor"=>$apellido
				],
				[
					"campo_nombre"=>"empleado_provincia",
					"campo_marcador"=>":Provincia",
					"campo_valor"=>$provincia
				],
				[
					"campo_nombre"=>"empleado_ciudad",
					"campo_marcador"=>":Ciudad",
					"campo_valor"=>$ciudad
				],
				[
					"campo_nombre"=>"empleado_direccion",
					"campo_marcador"=>":Direccion",
					"campo_valor"=>$direccion
				],
				[
					"campo_nombre"=>"empleado_telefono",
					"campo_marcador"=>":Telefono",
					"campo_valor"=>$telefono
				],
				[
					"campo_nombre"=>"empleado_email",
					"campo_marcador"=>":Email",
					"campo_valor"=>$email
				]
			];

			$registrar_empleado=$this->guardarDatos("empleado",$empleado_datos_reg);

			if($registrar_empleado->rowCount()==1){
				$alerta=[
					"tipo"=>"limpiar",
					"titulo"=>"empleado registrado",
					"texto"=>"El empleado ".$nombre." ".$apellido." se registro con exito",
					"icono"=>"success"
				];
			}else{
				$alerta=[
					"tipo"=>"simple",
					"titulo"=>"Ocurrió un error inesperado",
					"texto"=>"No se pudo registrar el empleado, por favor intente nuevamente",
					"icono"=>"error"
				];
			}

			return json_encode($alerta);
		}


		/*----------  Controlador listar empleado  ----------*/
		public function listarempleadoControlador($pagina,$registros,$url,$busqueda){

			$pagina=$this->limpiarCadena($pagina);
			$registros=$this->limpiarCadena($registros);

			$url=$this->limpiarCadena($url);
			$url=APP_URL.$url."/";

			$busqueda=$this->limpiarCadena($busqueda);
			$tabla="";

			$pagina = (isset($pagina) && $pagina>0) ? (int) $pagina : 1;
			$inicio = ($pagina>0) ? (($pagina * $registros)-$registros) : 0;

			if(isset($busqueda) && $busqueda!=""){

				$consulta_datos="SELECT * FROM empleado WHERE ((empleado_id!='1') AND (empleado_tipo_documento LIKE '%$busqueda%' OR empleado_numero_documento LIKE '%$busqueda%' OR empleado_nombre LIKE '%$busqueda%' OR empleado_apellido LIKE '%$busqueda%' OR empleado_email LIKE '%$busqueda%' OR empleado_provincia LIKE '%$busqueda%' OR empleado_ciudad LIKE '%$busqueda%')) ORDER BY empleado_nombre ASC LIMIT $inicio,$registros";

				$consulta_total="SELECT COUNT(empleado_id) FROM empleado WHERE ((empleado_id!='1') AND (empleado_tipo_documento LIKE '%$busqueda%' OR empleado_numero_documento LIKE '%$busqueda%' OR empleado_nombre LIKE '%$busqueda%' OR empleado_apellido LIKE '%$busqueda%' OR empleado_email LIKE '%$busqueda%' OR empleado_provincia LIKE '%$busqueda%' OR empleado_ciudad LIKE '%$busqueda%'))";

			}else{

				$consulta_datos="SELECT * FROM empleado WHERE empleado_id!='1' ORDER BY empleado_nombre ASC LIMIT $inicio,$registros";

				$consulta_total="SELECT COUNT(empleado_id) FROM empleado WHERE empleado_id!='1'";

			}

			$datos = $this->ejecutarConsulta($consulta_datos);
			$datos = $datos->fetchAll();

			$total = $this->ejecutarConsulta($consulta_total);
			$total = (int) $total->fetchColumn();

			$numeroPaginas =ceil($total/$registros);

			$tabla.='
		        <div class="table-container">
		        <table class="table is-bordered is-striped is-narrow is-hoverable is-fullwidth">
		            <thead>
		                <tr>
		                    <th class="has-text-centered">#</th>
		                    <th class="has-text-centered">Documento</th>
		                    <th class="has-text-centered">Nombre</th>
		                    <th class="has-text-centered">Email</th>
		                    <th class="has-text-centered">Actualizar</th>
		                    <th class="has-text-centered">Eliminar</th>
		                </tr>
		            </thead>
		            <tbody>
		    ';

		    if($total>=1 && $pagina<=$numeroPaginas){
				$contador=$inicio+1;
				$pag_inicio=$inicio+1;
				foreach($datos as $rows){
					$tabla.='
						<tr class="has-text-centered" >
							<td>'.$contador.'</td>
							<td>'.$rows['empleado_tipo_documento'].': '.$rows['empleado_numero_documento'].'</td>
							<td>'.$rows['empleado_nombre'].' '.$rows['empleado_apellido'].'</td>
							<td>'.$rows['empleado_email'].'</td>
			                <td>
			                    <a href="'.APP_URL.'clientUpdate/'.$rows['empleado_id'].'/" class="button is-success is-rounded is-small">
			                    	<i class="fas fa-sync fa-fw"></i>
			                    </a>
			                </td>
			                <td>
			                	<form class="FormularioAjax" action="'.APP_URL.'app/ajax/empleadoAjax.php" method="POST" autocomplete="off" >

			                		<input type="hidden" name="modulo_empleado" value="eliminar">
			                		<input type="hidden" name="empleado_id" value="'.$rows['empleado_id'].'">

			                    	<button type="submit" class="button is-danger is-rounded is-small">
			                    		<i class="far fa-trash-alt fa-fw"></i>
			                    	</button>
			                    </form>
			                </td>
						</tr>
					';
					$contador++;
				}
				$pag_final=$contador-1;
			}else{
				if($total>=1){
					$tabla.='
						<tr class="has-text-centered" >
			                <td colspan="6">
			                    <a href="'.$url.'1/" class="button is-link is-rounded is-small mt-4 mb-4">
			                        Haga clic acá para recargar el listado
			                    </a>
			                </td>
			            </tr>
					';
				}else{
					$tabla.='
						<tr class="has-text-centered" >
			                <td colspan="6">
			                    No hay registros en el sistema
			                </td>
			            </tr>
					';
				}
			}

			$tabla.='</tbody></table></div>';

			### Paginacion ###
			if($total>0 && $pagina<=$numeroPaginas){
				$tabla.='<p class="has-text-right">Mostrando empleados <strong>'.$pag_inicio.'</strong> al <strong>'.$pag_final.'</strong> de un <strong>total de '.$total.'</strong></p>';

				$tabla.=$this->paginadorTablas($pagina,$numeroPaginas,$url,7);
			}

			return $tabla;
		}


		/*----------  Controlador eliminar empleado  ----------*/
		public function eliminarempleadoControlador(){

			$id=$this->limpiarCadena($_POST['empleado_id']);

			if($id==1){
				$alerta=[
					"tipo"=>"simple",
					"titulo"=>"Ocurrió un error inesperado",
					"texto"=>"No podemos eliminar el empleado principal del sistema",
					"icono"=>"error"
				];
				return json_encode($alerta);
		        exit();
			}

			# Verificando empleado #
		    $datos=$this->ejecutarConsulta("SELECT * FROM empleado WHERE empleado_id='$id'");
		    if($datos->rowCount()<=0){
		        $alerta=[
					"tipo"=>"simple",
					"titulo"=>"Ocurrió un error inesperado",
					"texto"=>"No hemos encontrado el empleado en el sistema",
					"icono"=>"error"
				];
				return json_encode($alerta);
		        exit();
		    }else{
		    	$datos=$datos->fetch();
		    }

		    # Verificando ventas #
		    $check_ventas=$this->ejecutarConsulta("SELECT empleado_id FROM venta WHERE empleado_id='$id' LIMIT 1");
		    if($check_ventas->rowCount()>0){
		        $alerta=[
					"tipo"=>"simple",
					"titulo"=>"Ocurrió un error inesperado",
					"texto"=>"No podemos eliminar el empleado del sistema ya que tiene ventas asociadas",
					"icono"=>"error"
				];
				return json_encode($alerta);
		        exit();
		    }

		    $eliminarempleado=$this->eliminarRegistro("empleado","empleado_id",$id);

		    if($eliminarempleado->rowCount()==1){

		        $alerta=[
					"tipo"=>"recargar",
					"titulo"=>"empleado eliminado",
					"texto"=>"El empleado ".$datos['empleado_nombre']." ".$datos['empleado_apellido']." ha sido eliminado del sistema correctamente",
					"icono"=>"success"
				];

		    }else{
		    	$alerta=[
					"tipo"=>"simple",
					"titulo"=>"Ocurrió un error inesperado",
					"texto"=>"No hemos podido eliminar el empleado ".$datos['empleado_nombre']." ".$datos['empleado_apellido']." del sistema, por favor intente nuevamente",
					"icono"=>"error"
				];
		    }

		    return json_encode($alerta);
		}


		/*----------  Controlador actualizar empleado  ----------*/
		public function actualizarempleadoControlador(){

			$id=$this->limpiarCadena($_POST['empleado_id']);

			# Verificando empleado #
		    $datos=$this->ejecutarConsulta("SELECT * FROM empleado WHERE empleado_id='$id'");
		    if($datos->rowCount()<=0){
		        $alerta=[
					"tipo"=>"simple",
					"titulo"=>"Ocurrió un error inesperado",
					"texto"=>"No hemos encontrado el empleado en el sistema",
					"icono"=>"error"
				];
				return json_encode($alerta);
		        exit();
		    }else{
		    	$datos=$datos->fetch();
		    }

		    # Almacenando datos#
		    $tipo_documento=$this->limpiarCadena($_POST['empleado_tipo_documento']);
		    $numero_documento=$this->limpiarCadena($_POST['empleado_numero_documento']);
		    $nombre=$this->limpiarCadena($_POST['empleado_nombre']);
		    $apellido=$this->limpiarCadena($_POST['empleado_apellido']);

		    $provincia=$this->limpiarCadena($_POST['empleado_provincia']);
		    $ciudad=$this->limpiarCadena($_POST['empleado_ciudad']);
		    $direccion=$this->limpiarCadena($_POST['empleado_direccion']);

		    $telefono=$this->limpiarCadena($_POST['empleado_telefono']);
		    $email=$this->limpiarCadena($_POST['empleado_email']);

		    # Verificando campos obligatorios #
            if($numero_documento=="" || $nombre=="" || $apellido=="" || $provincia=="" || $ciudad=="" || $direccion==""){
            	$alerta=[
					"tipo"=>"simple",
					"titulo"=>"Ocurrió un error inesperado",
					"texto"=>"No has llenado todos los campos que son obligatorios",
					"icono"=>"error"
				];
				return json_encode($alerta);
		        exit();
            }

            # Verificando integridad de los datos #
		    if($this->verificarDatos("[a-zA-Z0-9-]{7,30}",$numero_documento)){
		    	$alerta=[
					"tipo"=>"simple",
					"titulo"=>"Ocurrió un error inesperado",
					"texto"=>"El NUMERO DE DOCUMENTO no coincide con el formato solicitado",
					"icono"=>"error"
				];
				return json_encode($alerta);
		        exit();
		    }

		    if($this->verificarDatos("[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,40}",$nombre)){
		    	$alerta=[
					"tipo"=>"simple",
					"titulo"=>"Ocurrió un error inesperado",
					"texto"=>"El NOMBRE no coincide con el formato solicitado",
					"icono"=>"error"
				];
				return json_encode($alerta);
		        exit();
		    }

		    if($this->verificarDatos("[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,40}",$apellido)){
		    	$alerta=[
					"tipo"=>"simple",
					"titulo"=>"Ocurrió un error inesperado",
					"texto"=>"El APELLIDO no coincide con el formato solicitado",
					"icono"=>"error"
				];
				return json_encode($alerta);
		        exit();
		    }

		    if($this->verificarDatos("[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{4,30}",$provincia)){
		    	$alerta=[
					"tipo"=>"simple",
					"titulo"=>"Ocurrió un error inesperado",
					"texto"=>"El ESTADO, PROVINCIA O DEPARTAMENTO no coincide con el formato solicitado",
					"icono"=>"error"
				];
				return json_encode($alerta);
		        exit();
		    }

		    if($this->verificarDatos("[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{4,30}",$ciudad)){
		    	$alerta=[
					"tipo"=>"simple",
					"titulo"=>"Ocurrió un error inesperado",
					"texto"=>"La CIUDAD O PUEBLO no coincide con el formato solicitado",
					"icono"=>"error"
				];
				return json_encode($alerta);
		        exit();
		    }

		    if($this->verificarDatos("[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{4,70}",$direccion)){
		    	$alerta=[
					"tipo"=>"simple",
					"titulo"=>"Ocurrió un error inesperado",
					"texto"=>"La DIRECCION O CALLE no coincide con el formato solicitado",
					"icono"=>"error"
				];
				return json_encode($alerta);
		        exit();
		    }

		    if($telefono!=""){
		    	if($this->verificarDatos("[0-9()+]{8,20}",$telefono)){
			    	$alerta=[
						"tipo"=>"simple",
						"titulo"=>"Ocurrió un error inesperado",
						"texto"=>"El TELEFONO no coincide con el formato solicitado",
						"icono"=>"error"
					];
					return json_encode($alerta);
			        exit();
			    }
		    }

		    # Comprobando tipo de documento #
			if(!in_array($tipo_documento, DOCUMENTOS_USUARIOS)){
				$alerta=[
					"tipo"=>"simple",
					"titulo"=>"Ocurrió un error inesperado",
					"texto"=>"El TIPO DE DOCUMENTO no es correcto",
					"icono"=>"error"
				];
				return json_encode($alerta);
		        exit();
			}

			# Verificando email #
		    if($email!="" && $datos['empleado_email']!=$email){
				if(filter_var($email, FILTER_VALIDATE_EMAIL)){
					$check_email=$this->ejecutarConsulta("SELECT empleado_email FROM empleado WHERE empleado_email='$email'");
					if($check_email->rowCount()>0){
						$alerta=[
							"tipo"=>"simple",
							"titulo"=>"Ocurrió un error inesperado",
							"texto"=>"El EMAIL que acaba de ingresar ya se encuentra registrado en el sistema, por favor verifique e intente nuevamente",
							"icono"=>"error"
						];
						return json_encode($alerta);
						exit();
					}
				}else{
					$alerta=[
						"tipo"=>"simple",
						"titulo"=>"Ocurrió un error inesperado",
						"texto"=>"Ha ingresado un correo electrónico no valido",
						"icono"=>"error"
					];
					return json_encode($alerta);
					exit();
				}
            }

            # Comprobando documento #
            if($tipo_documento!=$datos['empleado_tipo_documento'] || $numero_documento!=$datos['empleado_numero_documento']){
			    $check_documento=$this->ejecutarConsulta("SELECT empleado_id FROM empleado WHERE empleado_tipo_documento='$tipo_documento' AND empleado_numero_documento='$numero_documento'");
			    if($check_documento->rowCount()>0){
			    	$alerta=[
						"tipo"=>"simple",
						"titulo"=>"Ocurrió un error inesperado",
						"texto"=>"El número y tipo de documento ingresado ya se encuentra registrado en el sistema",
						"icono"=>"error"
					];
					return json_encode($alerta);
			        exit();
			    }
            }

            $empleado_datos_up=[
				[
					"campo_nombre"=>"empleado_tipo_documento",
					"campo_marcador"=>":TipoDocumento",
					"campo_valor"=>$tipo_documento
				],
				[
					"campo_nombre"=>"empleado_numero_documento",
					"campo_marcador"=>":NumeroDocumento",
					"campo_valor"=>$numero_documento
				],
				[
					"campo_nombre"=>"empleado_nombre",
					"campo_marcador"=>":Nombre",
					"campo_valor"=>$nombre
				],
				[
					"campo_nombre"=>"empleado_apellido",
					"campo_marcador"=>":Apellido",
					"campo_valor"=>$apellido
				],
				[
					"campo_nombre"=>"empleado_provincia",
					"campo_marcador"=>":Provincia",
					"campo_valor"=>$provincia
				],
				[
					"campo_nombre"=>"empleado_ciudad",
					"campo_marcador"=>":Ciudad",
					"campo_valor"=>$ciudad
				],
				[
					"campo_nombre"=>"empleado_direccion",
					"campo_marcador"=>":Direccion",
					"campo_valor"=>$direccion
				],
				[
					"campo_nombre"=>"empleado_telefono",
					"campo_marcador"=>":Telefono",
					"campo_valor"=>$telefono
				],
				[
					"campo_nombre"=>"empleado_email",
					"campo_marcador"=>":Email",
					"campo_valor"=>$email
				]
			];

			$condicion=[
				"condicion_campo"=>"empleado_id",
				"condicion_marcador"=>":ID",
				"condicion_valor"=>$id
			];

			if($this->actualizarDatos("empleado",$empleado_datos_up,$condicion)){
				$alerta=[
					"tipo"=>"recargar",
					"titulo"=>"empleado actualizado",
					"texto"=>"Los datos del empleado ".$datos['empleado_nombre']." ".$datos['empleado_apellido']." se actualizaron correctamente",
					"icono"=>"success"
				];
			}else{
				$alerta=[
					"tipo"=>"simple",
					"titulo"=>"Ocurrió un error inesperado",
					"texto"=>"No hemos podido actualizar los datos del empleado ".$datos['empleado_nombre']." ".$datos['empleado_apellido'].", por favor intente nuevamente",
					"icono"=>"error"
				];
			}

			return json_encode($alerta);
		}

	}