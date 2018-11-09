<?php

require_once "../modelos/Producto.php";
error_reporting(E_ALL);
ini_set('display_errors', 1);

$producto=new Producto();

$idproducto=isset($_POST["idproducto"])? limpiarCadena($_POST["idproducto"]):"";
$idmarca=isset($_POST["idmarca"])? limpiarCadena($_POST["idmarca"]):"";
$nombre=isset($_POST["nombre"])? limpiarCadena($_POST["nombre"]):"";
$observaciones=isset($_POST["observaciones"])? limpiarCadena($_POST["observaciones"]):"";
$cant_invto=isset($_POST["cant_invto"])? limpiarCadena($_POST["cant_invto"]):"";
$fecha_embar=isset($_POST["fecha_embar"])? limpiarCadena($_POST["fecha_embar"]):"";

switch ($_GET["op"]){
	case 'guardaryeditar':
		/*if (!file_exists($_FILES['imagen']['tmp_name']) || !is_uploaded_file($_FILES['imagen']['tmp_name'])) {
			$imagen =$_POST["imagenactual"];
		}
		else
		{
			$ext = explode(".", $_FILES["imagen"]["name"]);  //extraigo la extension del archivo
			if ($_FILES['imagen']['type']== "image/jpg" || $_FILES["imagen"]["type"]== "image/jpeg" || $_FILES["imagen"]["type"]== "image/png") 
			{
				$imagen = round(microtime(true)) . '.' . end($ext); //renombro la imagen
				move_uploaded_file($_FILES["imagen"]["tmp_name"], "../files/articulos/". $imagen);	
			}
		}*/
		$fecha_embar = date("Y-m-d");
		if (empty($idproducto)) {
			
			$rspta=$producto->insertar($idmarca, $nombre, $observaciones, $cant_invto, $fecha_embar);
			echo $rspta ? "Producto registrado": "Producto no se pudo registrar";
		}
		else{
			$rspta=$producto->editar($idproducto, $idmarca, $nombre, $observaciones, $cant_invto);
			echo $rspta ? "Producto actualizado": "Producto no se pudo Actualizar";
		}
	break;
		
	case 'eliminar':
		$rspta=$producto->eliminar($idproducto);
		echo $rspta ? "Producto Eliminado": "Producto no se puede Eliminar";
	break;
	
	case 'activar':
		$rspta=$articulo->activar($idproducto);
		echo $rspta ? "Producto Activado": "Producto no se pudo Activar";
	break;
	
	case 'mostrar':
		$rspta=$producto->mostrar($idproducto);
		//Codificar el resultado utilizando json
		echo json_encode($rspta);
	break;
		
	case 'listar':
		$rspta=$producto->listar();
		//Vamos a declarar un array
		$data= array();
		while ($reg=$rspta->fetch_object()) {
			
			$data[]=array(
				"0"=>($reg->idproducto)?'<button class="btn btn-warning" onclick="mostrar('.$reg->idproducto.')"><i class="fa fa-pencil"> </i></button>'.
				' <button class="btn btn-danger" onclick="eliminar('.$reg->idproducto.')"><i class="fa fa-close"> </i></button>':
				'<button class="btn btn-warning" onclick="mostrar('.$reg->idproducto.')"><i class="fa fa-pencil"> </i></button>'.
				' <button class="btn btn-primary" onclick="activar('.$reg->idproducto.')"><i class="fa fa-check"> </i></button>',
				"1"=>$reg->nombre,
				"2"=>$reg->marca,
				"3"=>$reg->observaciones,
				"4"=>$reg->cant_invto,
				"5"=>$reg->fecha_embar
				); 
		}
		$results = array(
			"sEcho"=>1, //Informacion para el datatables
			"iTotalRecords"=>count($data), //Enviamos el total registros al datatable
			"iTotalDisplayRecords"=>count($data), //Enviamos el total registros a visualizar
			"aaData"=>$data
			);
		echo json_encode($results);
	break;

	case 'selectMarca':
		require_once "../modelos/Marca.php";
		$marca = new Marca();
		$rspta = $marca->select();
		while ($reg = $rspta->fetch_object())
		{
			echo '<option value='. $reg->idmarca . '>' . $reg->nombre . '</option>';
		}
		break;
}

?>