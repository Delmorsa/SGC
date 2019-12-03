<?php
/**
 * Created by Cesar Mejía.
 * User: Sistemas
 * Date: 22/4/2019 15:14 2019
 * FileName: roles.php
 */
?>

<div class="content-wrapper">
	<section class="content-header">
		<h1>
			Estudio de Peso y Diametro
		</h1>		
		<br>
	</section>
	<!-- Main content -->
	<section class="content">
		<div class="box box-danger">
			<div class="box-header with-border">
				<div class="box-tools pull-right">
					<button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Minimizar">
						<i class="fa fa-minus"></i></button>
				</div>

				<div class="col-xs-12">
                        <div class="col-xs-3 col-sm-3 col-md-2 col-lg-2">
                            <div class="form-group has-feedback">
                                <label for="version">Lote</label>
                                <input autocomplete="off" type="text" id="idlote" value="454-2" class="form-control" placeholder="Lote">
                                <span class="fa fa-code-fork form-control-feedback"></span>
                            </div>
                        </div>                        
                        <div class="col-xs-4 col-sm-6 col-md-6 col-lg-4">
                        	<div class="form-group has-feedback">
	                                    <label>Nombre del producto</label><br>
	                            <select class="js-data-example-ajax form-control" id="codigo"></select>
	                      	</div>                      	
                    	</div>
                    	<div class="col-xs-4 col-sm-6 col-md-6 col-lg-2">
                    		<div class="form-group has-feedback">
		                      	<button class="pull-right btn btn-primary" id="btnFiltrar">
									Filtrar <i class="fa fa-save"></i>
								</button>
							</div>
						</div>
                </div>
			</div>
			<div class="box-body" style="overflow-y: scroll;">
				<table class="table table-bordered table-condensed table-striped w-100" id="tabla" >
					<thead>
						<tr class="text-center">
							<th>CODIGO</th>
							<th>NOMBRE</th>
							<th>LOTE</th>
							<th>DIAMETRO UTILIZADO</th>
							<th>DIAMETRO ESPERADO</th>
							<th>FUNDA DIAMETRO</th>
							<th>FUNDA LARGO</th>
							<th>FUNDA PESO ESPERADO</th>
							<th>PESO PROMEDIO</th>
							<th>VARIABILIDAD ±3</th>
							<th>MAQUINA</th>
							<th>TAMAÑO MUESTRA</th>
							<th>PESO EXACTO</th>
							<th>DEBAJO DEL LIMITE</th>
							<th>ENCIMA DEL LIMITE</th>
							<th>EN RANGO</th>
						</tr>
					</thead>
					<tbody>

					</tbody>
				</table>
			</div>			
		</div>
		<div class="row">
			<div style="width:100%;">
				<canvas id="canvas"></canvas>
			</div>
		</div>
	</section>

	
</div>


<div class="modal fade" id="modalRoles" data-backdrop="static">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title"><i class="fa fa-users"></i> <span id="modalEncabezado"></span></h4>
			</div>
			<div class="modal-body text-center">
				<h4>¿Desea Crear Consecutivo de Monitero?</h4>
			</div>
			<div class="modal-footer">
				<button id="btnGuardar" type="button" class="btn btn-primary">Si</button>
        		<button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>				
			</div>
		</div>
	</div>
</div>