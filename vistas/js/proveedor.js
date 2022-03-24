/*=============================================
EDITAR PROVEEDOR
=============================================*/
$(".tablas").on("click", ".btnEditarProveedor", function(){

	var idProveedor = $(this).attr("idProveedor");

	var datos = new FormData();
    datos.append("idProveedor", idProveedor);

    $.ajax({

      url:"ajax/proveedor.ajax.php",
      method: "POST",
      data: datos,
      cache: false,
      contentType: false,
      processData: false,
      dataType:"json",
      success:function(respuesta){
      	 $("#idProveedor").val(respuesta["id"]);
	       $("#editarCodigos").val(respuesta["codigo"]);
	       $("#editarNit").val(respuesta["nit"]);
	       $("#editarNombres").val(respuesta["nombre"]);
	       $("#editarContacto").val(respuesta["contacto"]);
	       $("#editarCargo").val(respuesta["cargo"]);
         $("#editarDirecciones").val(respuesta["direccion"]);
         $("#editarTelefono").val(respuesta["telefono"]);
         $("#ediatarSuministro").val(respuesta["suministro"]);
         $("#ediatarWeb").val(respuesta["web"]);
	  }

  	})

})

/*=============================================
ELIMINAR CLIENTE
=============================================*/
$(".tablas").on("click", ".btnEliminarProveedor", function(){

	var idProveedor = $(this).attr("idProveedor");
	
	swal({
        title: '¿Está seguro de borrar el proveedor?',
        text: "¡Si no lo está puede cancelar la acción!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Si, borrar proveedor!'
      }).then(function(result){
        if (result.value) {
          
            window.location = "index.php?ruta=proveedores&idProveedor="+idProveedor;
        }

  })

})