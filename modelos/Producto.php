<?php

//Incluimos inicialmente la conexion a la base de datos
require "../config/Conexion.php";

Class Producto
{
	//Implementamos nuestro constructor
	public function __construct()
	{

	}

	//Implementamos un metodo para insertar registros
	public function insertar($idmarca, $nombre, $observaciones, $cant_invto, $fecha_embar)
	{
		$sql = "INSERT INTO producto (idmarca,nombre,observaciones,cant_invto,fecha_embar)
		VALUES ('$idmarca', '$nombre', '$observaciones', '$cant_invto', '$fecha_embar')";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para editar registros
	public function editar($idproducto, $idmarca, $nombre, $observaciones, $cant_invto)
	{
		$sql = "UPDATE producto SET idproducto='$idproducto', idmarca='$idmarca', nombre='$nombre', observaciones='$observaciones', cant_invto='$cant_invto'
			WHERE idproducto='$idproducto'";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para desactivar registros
	public function eliminar($idproducto)
	{
		$sql = "DELETE FROM producto
		WHERE idproducto='$idproducto'";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para activar registros
	public function activar($idarticulo)
	{
		$sql = "UPDATE articulo SET condicion='1'
		WHERE idarticulo='$idarticulo'";
		return ejecutarConsulta($sql);
	}

	//Implementar un método para mostrar los datos de un registro a modificar
	public function mostrar($idproducto)
	{
		$sql = "SELECT * FROM producto 
		WHERE idproducto='$idproducto'";
		return ejecutarConsultaSimpleFila($sql);
	}

	//Implementar un método para listar los registros
	public function listar()
	{
		$sql = "SELECT a.idproducto, a.idmarca, c.nombre as marca, a.nombre, a.observaciones, a.cant_invto, a.fecha_embar FROM producto a INNER JOIN marca c ON a.idmarca= c.idmarca";
		return ejecutarConsulta($sql);
	}

}
?>