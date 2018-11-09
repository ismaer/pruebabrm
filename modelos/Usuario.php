<?php

//Incluimos inicialmente la conexion a la base de datos
require "../config/Conexion.php";

Class Usuario
{

	public function __construct()
	{

	}
	
	//Funcion para verificar el acceso al sistema
	public function verificar($login,$clave){
		$sql = "SELECT idusuarios,nombre,correo FROM usuarios WHERE correo='$login' AND contrasena='$clave' ";
		return ejecutarConsulta($sql);
	}
}
?>