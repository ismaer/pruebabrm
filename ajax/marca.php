<?php
require_once "../modelos/Marca.php";

$marca=new Marca();

$idmarca=isset($_POST["idmarca"])? limpiarCadena($_POST["idmarca"]):"";
$nombre=isset($_POST["nombre"])? limpiarCadena($_POST["nombre"]):"";
$referencia=isset($_POST["referencia"])? limpiarCadena($_POST["referencia"]):"";

switch ($_GET["op"]){
	case 'guardaryeditar':
		if(empty($idmarca)) {
			$rspta=$marca->insertar($nombre, $referencia);
			echo $rspta ? "Marca registrada": "Marca no se pudo registrar";
		}
		else{
			$rspta=$marca->editar($idmarca, $nombre, $referencia);
			echo $rspta ? "Marca actualizada": "Marca no se pudo Actualizar";
		}
	break;
		
	case 'eliminar':
		$rspta=$marca->eliminar($idmarca);
		echo $rspta ? "Marca Eliminada": "Marca no se puede Eliminar";
	break;
	
	case 'activar':
		$rspta=$marca->activar($idmarca);
		echo $rspta ? "Marca Activada": "Marca no se pudo Activar";
	break;
	
	case 'mostrar':
		$rspta=$marca->mostrar($idmarca);
		//Codificar el resultado utilizando json
		echo json_encode($rspta);
	break;
		
	case 'listar':
		
		$rspta=$marca->listar();
		//Vamos a declarar un array
		
		$data= array();

		while ($reg=$rspta->fetch_object()) {
			$data[] = array(
				"0"=>($reg->idmarca)?'<button class="btn btn-warning" onclick="mostrar('.$reg->idmarca.')"><i class="fa fa-pencil"> </i></button>'.
				' <button class="btn btn-danger" onclick="eliminar('.$reg->idmarca.')"><i class="fa fa-close"> </i></button>':
				'<button class="btn btn-warning" onclick="mostrar('.$reg->idmarca.')"><i class="fa fa-pencil"> </i></button>'.
				' <button class="btn btn-primary" onclick="activar('.$reg->idmarca.')"><i class="fa fa-check"> </i></button>',
				"1"=>$reg->nombre,
				"2"=>$reg->referencia
				);
		}
		
		$results = array("sEcho"=>1, //Informacion para el datatables
			"iTotalRecords"=>count($data), //Enviamos el total registros al datatable
			"iTotalDisplayRecords"=>count($data), //Enviamos el total registros a visualizar
			"aaData"=>$data
			);
		
		echo json_encode($results);
	break;
}

?>