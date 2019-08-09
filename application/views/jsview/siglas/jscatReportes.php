<?php

/**
 * @Author: cesar mejia
 * @Date:   2019-08-09 10:55:30
 * @Last Modified by:   cesar mejia
 * @Last Modified time: 2019-08-09 14:59:09
 */
?>
<script type="text/javascript">
	$(document).ready(function(){

	});

	$("#btnModal").click(function(){
		$("#modalEncabezado").text("Nueva Categoria Reporte");
		$("#idsiglas,#siglas,#descripcion").val("");
		$("#btnGuardar").show();
		$("#btnActualizar").hide();
		$("#modalReport").modal("show");
	});
</script>