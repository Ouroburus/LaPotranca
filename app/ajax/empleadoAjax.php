<?php
	
	require_once "../../config/app.php";
	require_once "../views/inc/session_start.php";
	require_once "../../autoload.php";
	
	use app\controllers\empleadoController;

	if(isset($_POST['modulo_empleado'])){

		$insempleado = new empleadoController();

		if($_POST['modulo_empleado']=="registrar"){
			echo $insempleado->registrarempleadoControlador();
		}

		if($_POST['modulo_empleado']=="eliminar"){
			echo $insempleado->eliminarempleadoControlador();
		}

		if($_POST['modulo_empleado']=="actualizar"){
			echo $insempleado->actualizarempleadoControlador();
		}
		
	}else{
		session_destroy();
		header("Location: ".APP_URL."login/");
	}