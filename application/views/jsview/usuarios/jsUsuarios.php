<?php
/**
 * Created by Cesar Mejía.
 * User: Sistemas
 * Date: 29/4/2019 14:05 2019
 * FileName: jsUsuarios.php
 */
?>
<script type="text/javascript">
$(document).ready(function () {
	$('.select2').select2({
		placeholder: "Seleccione un Rol",
		allowClear: true,
		language: "es"
	});

	$("#tblUsuarios").DataTable({
		"processing": true,
		"info": true,
		"sort": true,
		"destroy": true,
		"responsive": true,
		"lengthMenu": [
			[10,20,50,100, -1],
			[10,20,50,100, "Todo"]
		],
		"order": [
			[0, "asc"]
		],
		"language": {
			"info": "Registro _START_ a _END_ de _TOTAL_ entradas",
			"infoEmpty": "Registro 0 a 0 de 0 entradas",
			"zeroRecords": "No se encontro coincidencia",
			"infoFiltered": "(filtrado de _MAX_ registros en total)",
			"emptyTable": "NO HAY DATOS DISPONIBLES",
			"lengthMenu": '_MENU_ ',
			"search": 'Buscar:  ',
			"loadingRecords": "",
			"processing": "Procesando datos  <i class='fa fa-spin fa-refresh'></i>",
			"paginate": {
				"first": "Primera",
				"last": "Última ",
				"next": "Siguiente",
				"previous": "Anterior"
			}
		}
	});
});

function validatePassword(){
	let bandera = 0;
	if($("#confirmPass").val() != $("#password").val()){
		Swal.fire({
			type: "info",
			text: "Las contraseñas no coinciden",
			allowOutsideClick: false
		}).then((result)=>{
			$("#formConfPass").addClass("has-error");
			$("#formPass").addClass("has-error");
		});
		bandera = 1;
	}
	return bandera;
}

$("#btnModal").click(function () {
	$("#modalEncabezado").text("Nuevo Usuario");
	$("#usuario").val("");
	$("#password").val("");
	$("#confirmPass").val("");
	$("#password").attr("disabled",false);
	$("#confirmPass").attr("disabled",false);
	$("#formConfPass").removeClass("has-error");
	$("#formPass").removeClass("has-error");
	$("#nombre").val("");
	$("#apellido").val("");
	$("#correo").val("");
	$("#roles option:selected").text("Seleccione un Rol");
	$("#roles option:selected").val("");
	$("#M").prop("checked",true);
	$("#roles option:selected").trigger("change.select2");
	$("#btnGuardar").show();
	$("#btnActualizar").hide();
	$("#modalUsuarios").modal('show');
});

$("#btnGuardar").click(function () {
	if($("#usuario").val() == "" || $("#password").val() == ""
		|| $("#nombre").val() == "" || $("#apellido").val() == ""
		|| $("#correo").val() == "" || $("#roles option:selected").val() ==""){
		Swal.fire({
			text: "Todos los campos son requeridos",
			type: "error",
			allowOutsideClick: false
		});
	}else{
		if(validatePassword() == 0){
			let genero = 0; let mensaje = '', tipo = '';
			if($("#M").is(":checked") == true){
				genero = 1;
			}else if($("#F").is(":checked") == true){
				genero = 2;
			}

			let form_data = {
				idrol: $("#roles option:selected").val(),
				usuario: $("#usuario").val(),
				nombre: $("#nombre").val(),
				apellido: $("#apellido").val(),
				sexo: genero,
				password: $("#password").val(),
				correo:  $("#correo").val()
			};

			$.ajax({
				url: "guardarUsuario",
				type: "POST",
				data: form_data,
				success: function (data) {
					let obj = jQuery.parseJSON(data);
					$.each(obj, function (i, item) {
						mensaje = item["mensaje"];
						tipo = item["tipo"];
					});

					Swal.fire({
						type: tipo,
						text: mensaje,
						allowOutsideClick: false
					}).then((result)=>{
						location.reload();
					});
				}
			});
		}
	}
});

function Editar(user,nombre,apellido,correo,rol,nombrerol,genero){
	$("#modalEncabezado").text("Editar Usuario");
	$("#usuario").val(user);
	$("#password").attr("disabled",true);
	$("#confirmPass").attr("disabled",true);
	$("#formConfPass").removeClass("has-error");
	$("#formPass").removeClass("has-error");
	$("#nombre").val(nombre);
	$("#apellido").val(apellido);
	$("#correo").val(correo);
	$("#roles option:selected").text(nombrerol);
	$("#roles option:selected").val(rol);
	if(genero == 1){
		$("#M").prop("checked",true);
		$("#F").prop("checked",false);
	}else{
		$("#M").prop("checked",false);
		$("#F").prop("checked",true);
	}
	$("#btnGuardar").hide();
	$("#btnActualizar").show();
	$("#roles option:selected").val(rol).trigger("change.select2");
	$("#modalUsuarios").modal('show');
}
</script>
