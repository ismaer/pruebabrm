<?php

//Incluimos inicialmente la conexion a la base de datos
require "../config/Conexion.php";

Class Marca
{
	//Implementamos nuestro constructor
	public function __construct()
	{

	}

	//Implementamos un metodo para insertar registros
	public function insertar($nombre, $referencia)
	{
		$sql = "INSERT INTO marca (nombre, referencia)
		VALUES ('$nombre', '$referencia')";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para editar registros
	public function editar($idmarca, $nombre, $referencia)
	{
		$sql = "UPDATE marca SET nombre='$nombre', referencia='$referencia'
		WHERE idmarca='$idmarca'";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para desactivar categorias
	public function eliminar($idmarca)
	{
		$sql = "DELETE FROM marca
    WHERE idmarca = '$idmarca'";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para activar categorias
	public function activar($idmarca)
	{
		$sql = "UPDATE marca SET condicion='1'
		WHERE idmarca='$idmarca'";
		return ejecutarConsulta($sql);
	}

	//Implementar un método para mostrar los datos de un registro a modificar
	public function mostrar($idmarca)
	{
		$sql = "SELECT * FROM marca
		WHERE idmarca='$idmarca'";
		return ejecutarConsultaSimpleFila($sql);
	}

	//Implementar un método para listar los registros
	public function listar()
	{
		$sql = "SELECT * FROM marca";
		return ejecutarConsulta($sql);
	}

	//Implementar un método para listar los registros y mostrar en el select
	public function select()
	{
		$sql = "SELECT * FROM marca ";
		return ejecutarConsulta($sql);
	}

}
?>