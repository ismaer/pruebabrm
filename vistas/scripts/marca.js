var tabla;
//funcion que se ejecuta al inicio

function init()
{
	mostrarform(false);
	listar();

	$("#formulario").on("submit",function(e)
	{
		guardaryeditar(e);

	})
}

//Función limpiar 
function limpiar()
{
	$("#idmarca").val("");
	$("#nombre").val("");
	$("#referencia").val("");
}

//Funcion mostrar formulario
function mostrarform(flag)
{
	limpiar();
	if (flag)
	{
		$("#listadoregistros").hide();
		$("#formularioregistros").show();
		$("#btnGuardar").prop("disabled",false);
		$("#btnagregar").hide();
	}
	else
	{
		$("#listadoregistros").show();
		$("#formularioregistros").hide();
		$("#btnagregar").show();
	}
}

//Funcion cancelarform
function cancelarform()
{
	limpiar();
	mostrarform(false);
}
//Funcion Listar
function listar()
{
	tabla=$('#tbllistado').dataTable(
	{
		"aProcessing": true, //Activamos el procesamiento del datatables
		"aServerSide": true, //Paginación y filtrados realizados por el servidor
		dom: 'Bfrtip', //Definimos los elementos del control de tabla
		buttons: [
					'copyHtml5',
					'excelHtml5',
					'csvHtml5'
					
				],
		"ajax":
				{
					url :'../ajax/marca.php?op=listar',
					type : "get",
					dataType : "json",
					error: function(e){
						console.log('adfasfasf');
						console.log(e.responseText);
						console.log(e);
					}
				},
		"bDestroy": true,
		"iDisplayLength": 5, //Paginacion
		"order": [[0,"desc"]], //Ordenar (columna,orden)

	}).DataTable();
	
}
//Funcion para guardar o editar

function guardaryeditar(e)
{
    e.preventDefault(); //No se activará la accion predeterminada del evento
    $("#btnGuardar").prop("disabled",true);
    var formData = new FormData($("#formulario")[0]);
    
    $.ajax({

    	url: "../ajax/marca.php?op=guardaryeditar",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,

        success: function(datos)
        {
            bootbox.alert(datos);
            mostrarform(false);
            tabla.ajax.reload();
        }
    });
    limpiar();
}

function mostrar(idmarca)
{
	$.post("../ajax/marca.php?op=mostrar",{idmarca : idmarca}, function(data, status)
	{
		data = 	JSON.parse(data);
		mostrarform(true);

		$("#nombre").val(data.nombre);
		$("#referencia").val(data.referencia);
		$("#idmarca").val(data.idmarca);
	});
}
//Funcion para desactivar registros
function eliminar(idmarca)
{
	bootbox.confirm("¿Está seguro que desea eliminar la marca?", function(result){
		if (result) {
			$.post("../ajax/marca.php?op=eliminar", {idmarca: idmarca}, function(e){
				bootbox.alert(e);
				tabla.ajax.reload();

			});
		}

	})
	
}
//Funcion para activar registros
function activar(idmarca)
{
	bootbox.confirm("¿Está seguro que desea activar la categoria?", function(result){
		if (result) {
			$.post("../ajax/marca.php?op=activar", {idmarca: idmarca}, function(e){
				bootbox.alert(e);
				tabla.ajax.reload();

			});
		}

	})
	
}

init();