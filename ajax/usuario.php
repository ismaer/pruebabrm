<?php
require_once "../modelos/Usuario.php";
session_start();
$usuario = new Usuario();

//error_reporting(E_ALL);
//ini_set('display_errors', 1);
switch ($_GET["op"]){
	
	case 'verificar':

		$logina=$_POST['logina'];
		$clavea=$_POST['clavea'];
		//Hash SHA256 en la contraseña
		$rspta=$usuario->verificar($logina, hash("SHA256", $clavea));
		$fetch=$rspta->fetch_object();
		
		if (isset($fetch)) {
			//Declaramos las variables de sesion
			$_SESSION['idusuarios']=$fetch->idusuarios;
			$_SESSION['nombre']=$fetch->nombre;
			$_SESSION['correo']=$fetch->correo;
		}
		echo json_encode($fetch);

	break;

	case 'salir':
		//limpiamos las variables de sesion
		session_unset();
		//Destruimos la sesion
		session_destroy();
		//Redireccionamos al login
		header('Location: ../index.php');
	break;
}
?>