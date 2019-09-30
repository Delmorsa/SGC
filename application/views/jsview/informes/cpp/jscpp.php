<?php

?>
<script type="text/javascript">
	$(document).ready(function(){
        $('.select2').select2({
			placeholder: "Seleccione",
			allowClear: true,
			language: "es"
		});
		$(".js-data-example-ajax").select2({
			placeholder: '--- Seleccione un Producto ---',
			allowClear: true,
			ajax: {
				url: '<?php echo base_url("index.php/getProductosSAP")?>',
				dataType: 'json',
				type: "POST",
				quietMillis: 100,
				data: function (params) {
					return {
			        q: params.term,  // search term
        			page: params.page
			      };
				},
				processResults: function (data, params) {
					params.page = params.page || 1;
					let res = [];
					for(let i  = 0 ; i < data.length; i++) {
						res.push({id:data[i].ItemCode, text:data[i].ItemName});
						$("#campo").append('<input type="hidden" name="" id="'+data[i].ItemCode+'txtpeso" class="form-control" value="'+data[i].SWeight1+'">');
					}
					return {
						results: res
					}
				},
				cache: true
			}
		}).trigger('change');
				

		$("#txtPeso").numeric();

		$("#nitrito,#kg").numeric();
		$('#fecha').datepicker({"autoclose":true});
		$("#tblCNS").DataTable();

		$("#ddlprod").change(function (){
			let bandera = true;
			let tabla = $('#tblDatos').DataTable();
			let noRegistro = tabla.data().count();

			if (noRegistro>0) {
				tabla.clear().draw();
				Swal.fire({
				  title: 'Aviso',
				  text: "Se eliminaran los registros ingresados",
				  type: 'warning',
				  showCancelButton: false,
				  confirmButtonColor: '#3085d6',
				  confirmButtonText: 'Aceptar!'
				}).then((result) => {
				  	if (result.value) {
				  		$('#lote').val('');
				  		$('#batch').val('');
					}
				});
			}

			$("#loaderButtons").show();
			$("#cantidad").focus();
			if($(this).val() != ''){
			$.ajax({
				url: "<?php echo base_url("index.php/getGramos")?>"+"/"+$(this).val(),
				type: "POST",
				async: true,
					success: function (data) {
						if($("#ddlRutas option:selected").val() != ""){
							$.each(JSON.parse(data), function (i, item){
								$("#pesoGr").val(Number(item["GRAMOS"]).toFixed(2));
							});
							$("#loaderButtons").hide();
							$("#buttonsRem").show();
						}
					},
					error: function (data) {
						$("#pesoGr").val(Number(0).toFixed(2));						
					}
				});			
			}
		});

	});

	$('#cmbTamaño').change(function() {
	    calcularMuestra();
	});
	$('#cmdNivel').change(function() {
	    calcularMuestra();
	});
	$('#cmdNivel2').change(function() {
	    calcularMuestra();
	});

	$('#chkEspecial').change(function(){
		if ($('#chkEspecial').is(':checked')){
			$('.especial').removeClass('invisible');
		}else{
			$('.especial').addClass('invisible');
		}
	});


	$('#txtPeso').keyup(function(e){
	    if(e.keyCode == 13)
	    {
	        $('#btnAdd').trigger("click");
	    }
	});

	function calcularMuestra() {
		let tabla = $('#tblDatos').DataTable();
		let noRegistro = tabla.data().count();

		if (noRegistro>0) {
			tabla.clear().draw();
			Swal.fire({
				title: 'Aviso',
				text: "Se eliminaran los registros ingresados",
				type: 'warning',
				showCancelButton: false,
				confirmButtonColor: '#3085d6',
				confirmButtonText: 'Aceptar!'
			}).then((result) => {
			  	if (result.value) {
			  		$('#lote').val('');
			  		$('#batch').val('');
				}
			});
		}

		let ok = true;

		$('#btnAdd').prop('disabled',true);
		let tamano = null;
		let nivel = null;
		let tamano2 = null;
		let nivel2 = null;
		let bandera = null;
		bandera = $('#chkEspecial').prop("checked");

		tamano = ($("#cmbTamaño option:selected").val() != '') ? $("#cmbTamaño option:selected").val():null;
		nivel = ($("#cmdNivel option:selected").val() != '') ? $("#cmdNivel option:selected").val():null;
		//tamano2 = ($("#cmbTamaño2 option:selected").val() != '') ? $("#cmbTamaño2 option:selected").val():null;
		nivel2 = ($("#cmdNivel2 option:selected").val() != '') ? $("#cmdNivel2 option:selected").val():null;


		if (tamano == '' || nivel == '') {
			alert("primer if");
			ok = false;
		}if (bandera == false && nivel2 =='' /*&& tamano2 == ''*/) {
			alert("segundo if");
			ok = false;
		}
		if(ok){
			$.ajax({
				url: "<?php echo base_url("index.php/getMuestra")?>"+"/"+tamano+"/"+nivel+/*"/"+tamano2+*/"/"+nivel2+"/"+bandera,
				type: "POST",
				async: true,
					success: function (data) {
						//alert(data);
						$('#muestra').val(data);
						$('#btnAdd').prop('disabled',false)
					},
					error: function (data) {
						$("#muestra").val(Number(0).toFixed(2));
						$('#btnAdd').prop('disabled',false);
				}
			});
		}else{
			$('#muestra').val(0);
		}
	}

	$('#tblDatos tbody').on( 'click', 'tr', function () {
        $(this).toggleClass('danger');
    });

	$("#btnDelete").click(function (){
      	let table = $("#tblDatos").DataTable();
    	let rows = table.rows( '.danger' ).remove().draw();
  	});

   $("#btnAdd").click(function(){
   		let table = $("#tblDatos").DataTable();
   		let noRegistro = parseFloat(tabla.data().count());

   		let muestra = parseFloat($('#muestra').val());

   		if (noRegistro < mustra) {
	   		Swal.fire({
				title: 'Aviso',
				text: "No ha llenado el número de muestras total",
				type: 'warning',
				showCancelButton: false,
				confirmButtonColor: '#3085d6',
				confirmButtonText: 'Aceptar!'
			}).then((result) => {
			});
		}


   		if ($("#muestra").val() == 0 || $("#muestra").val() == '') {
   			Swal.fire({
   				text: "No existe Tamaño de muestra",
   				type: "warning",
   				allowOutsideClick: false
   			});
   		}

   		let t = $('#tblDatos').DataTable({
			"info": false,
			"sort": false,
			"destroy": true,
			"searching": false,
			"paginate": false,
			"lengthMenu": [
				[10,20,50,100, -1],
				[10,20,50,100, "Todo"]
			],
			"order": [
				[0, "desc"]
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
   		let area = $("#ddlAreas option:selected").val(),
   		fecha = $("#fecha").val(),
   		hora = $("#hora").val(),
   		codigo = $("#codigo").val(),
   		observacion = $("#observacionGeneral").val(),
   		codproducto = $("#ddlprod option:selected").val(),
   		descripcion = $("#ddlprod option:selected").text(),
   		gramos = $("#pesoGr").val(),
   		monituser = $("#monituser").val(),
		peso = $('#txtPeso').val();

   		if(fecha == "" || peso == "" || hora == "" || codigo == "" || monituser == "" || area == "" || gramos == ''){
   			Swal.fire({
   				text: "Todos los campos son requeridos,Excepto Observación",
   				type: "warning",
   				allowOutsideClick: false
   			});
   			return;
   		}else if(peso<1){
   			Swal.fire({
   				text: "Ingrese un peso valido",
   				type: "warning",
   				allowOutsideClick: false
   			});
   			return;
   		}else{
   			let diferencia = parseFloat(peso) - parseFloat(gramos);
   			t.row.add([
				codproducto,
				descripcion,
				gramos,
				peso,				
				diferencia				
   			]).draw(false);

	   		$("#txtPeso").val("");
	   		$("#txtPeso").focus();
   		}
   });
	

$("#btnGuardar").click(function(){
	Swal.fire({
		text: "¿Estas Seguro que Desea Guardar?",
		type: 'question',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		confirmButtonText: 'Aceptar',
		cancelButtonText: "Cancelar",
		allowOutsideClick: false
	}).then((result)=>{
		let validtable = $('#tblDatos').DataTable();
		if(result.value){
			if($("#ddlAreas option:selected").val() == "" || $("#instrumento").val() == "" 
				|| $("#iderror").val() == ""){
				Swal.fire({
					text: "Debe ingresar un Area, Version u Observacion",
					type: "error",
					allowOutsideClick: false
				});
			}else if (!validtable.data().count() ) {
		    	Swal.fire({
		    		text: "No se ha agregado ningún registro a la tabla",
		    		type: "error",
		    		allowOutsideClick: false
		    	});
			}else{
				$("#loading").modal("show");
			    let nombre = $("#nombreRpt").html(),
			    mensaje = '', tipo = '',	
				table = $("#tblDatos").DataTable();
				let datos = new Array(), i = 0;
				
				table.rows().eq(0).each(function(i, index){
					let row = table.row(index);
					let data = row.data();
					datos[i] = data[0]+"|"+data[1]+"|"+data[2]+"|"+data[3]+"|"+data[4]+"|"+data[5]+"|"+data[6]+"|"+data[7];
					i++;
				});

				let form_data = {
				    enc: [$("#idmonitoreo").val(),$("#ddlAreas option:selected").val(),nombre,$("#observaciones").val(),$("#iderror").val(),$("#instrumento").val(),$("#observacionGeneral").val()],
				    datos: datos
				};

				$.ajax({
					url: 'guardarRVPBP',
					type: 'POST',
					data: form_data,
					success: function(data)
					{
						$("#loading").modal("hide");
						let obj = jQuery.parseJSON(data);
						$.each(obj, function(index, val) {
							mensaje = val["mensaje"];
							tipo = val["tipo"]; 
						});
						Swal.fire({
							type: tipo,
							text: mensaje,
							allowOutsideClick: false
						}).then((result)=>{
							//window.location.href = "reporte_7";  
						});				
					},error:function(){
						Swal.fire({
							type: "error",
							text: "Error inesperado, Intentelo de Nuevo",
							allowOutsideClick: false
						});
						$("#loading").modal("hide");
					}
				});
			}
		}
	});
});
</script>