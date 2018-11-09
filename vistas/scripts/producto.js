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

	//Cargamos los items al select categoria
	$.post("../ajax/producto.php?op=selectMarca", function(r)
	{
		$("#idmarca").html(r);
		$("#idmarca").selectpicker('refresh');
	});
	$("#imagenmuestra").hide();
}

//Función limpiar 
function limpiar()
{
	$("#nombre").val("");
	$("#observaciones").val("");
	$("#fecha").val("");
	$("#cant_invto").val("");
	$("#fecha_embar").val("");
	$("#idproducto").val("");
	$("#idmarca").val("");
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
					'csvHtml5',
				 ],
		"ajax":
				{
					url:'../ajax/producto.php?op=listar',
					type : 'get',
					dataType : "json",
					error: function(e){
						console.log(e.responseText);
					}
				},
		"bDestroy": true,
		"iDisplayLength": 5, //Paginacion
		"order": [[0,"desc"]] //Ordenar (columna,orden)

	}).DataTable();
}
//Funcion para guardar o editar

function guardaryeditar(e)
{
    e.preventDefault(); //No se activará la accion predeterminada del evento
    $("#btnGuardar").prop("disabled",true);
    var formData = new FormData($("#formulario")[0]);
    
    $.ajax({

    	url: "../ajax/producto.php?op=guardaryeditar",
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
function mostrar(idproducto)
{
	$.post("../ajax/producto.php?op=mostrar",{idproducto : idproducto}, function(data, status)
	{
		data = 	JSON.parse(data);
		mostrarform(true);

		$("#idmarca").val(data.idmarca);
		$("#idmarca").selectpicker('refresh');
		$("#nombre").val(data.nombre);
		$("#cant_invto").val(data.cant_invto);
		$("#observaciones").val(data.observaciones);
		$("#idproducto").val(data.idproducto);
		generarbarcode();

	});
}
//Funcion para eliminar registros
function eliminar(idproducto)
{
	bootbox.confirm("¿Está seguro que desea eliminar el producto?", function(result){
		if (result) {
			$.post("../ajax/producto.php?op=eliminar", {idproducto: idproducto}, function(e){
				bootbox.alert(e);
				tabla.ajax.reload();

			});
		}

	})
	
}
//Funcion para activar registros
function activar(idproducto)
{
	bootbox.confirm("¿Está seguro que desea activar el producto?", function(result){
		if (result) {
			$.post("../ajax/producto.php?op=activar", {idproducto: idproducto}, function(e){
				bootbox.alert(e);
				tabla.ajax.reload();

			});
		}

	})
	
}

init();