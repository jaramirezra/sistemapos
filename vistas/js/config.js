

/*=============================================
EDITAR CONFIGURACIÓN
=============================================*/

$(document).on("click", ".btnEditarConfig", function(){
  var idConfig = $(this).attr("idConfig");
  var datos = new FormData();
  datos.append("idConfig", idConfig);
    $.ajax({
      url:"ajax/config.ajax.php",
      method: "POST",
      data: datos,
      cache: false,
      contentType: false,
      processData: false,
      dataType: "json",

      success: function(respuesta){
        $("#Version").val(respuesta["NomPos"]);
        $("#NuevoNombre").val(respuesta["nombre"]);
        $("#EmpresaNueva").val(respuesta["nit"]);
        $("#nuevoIva").val(respuesta["iva"]);
        $("#nuevoTelefono").val(respuesta["telefono"]);
        $("#nuevoCorreo").val(respuesta["correo"]);
        $("#nuevaDireccion").val(respuesta["direccion"]);
        $("#nuevosCambios").val(respuesta["adicional"]);
        $("#nuevaCiudad").val(respuesta["Ciudad"]);
        $("#nuevoCodigo").val(respuesta["codigo"]);
        $("#fotoActual").val(respuesta["fotoconfig"]);
  
          if(respuesta["fotoconfig"] != ""){
            $("#fotoActual").val(respuesta["imagen"]);
            $(".previsualizar").attr("src",  respuesta["imagen"]);
          }
      }
	});
})