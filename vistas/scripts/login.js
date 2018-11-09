$("#frmAcceso").on('submit',function(e)	{
	e.preventDefault();
	var $form = $(this);
    var formData = new FormData($form[0]);
    
	$.ajax({
        url: "../ajax/usuario.php?op=verificar",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,

        success: function(datos)
        {
            if (datos!="null") {
                $(location).attr("href","marca.php");
            }
            else{
                bootbox.alert("usuario y/o Passwords incorrectos");
        	}
            //bootbox.alert(datos);
            //mostrarform(false);
            //tabla.ajax.reload();
        }
    });
});


