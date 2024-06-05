<?php

	namespace app\controllers;
	use app\models\viewsModel;

	class vistaController extends viewsModel{

		/*---------- Controlador obtener vistas ----------*/
		public function obtenerVistasControlador($vista){
			if($vista!=""){
				$respuesta=$this->obtenerVistasModelo($vista);
			}else{
				$respuesta="login";
			}
			return $respuesta;
		}
	}