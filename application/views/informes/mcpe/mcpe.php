<?php
/**
 * Created by Cesar Mejía.
 * User: Sistemas
 * Date: 23/9/2019 13:54 2019
 * FileName: mcpe.php
 */?>
<div class="content-wrapper">
    <section class="content-header">
        <h1>
             Monitoreos De Calidad En Proceso De Empaque

            <a href="<?php echo base_url("index.php/nuevoMCPE")?>" class="pull-right btn btn-primary">
                Agregar <i class="fa fa-plus"></i>
            </a>
            <!--<small>Blank example to the fixed layout</small>-->
        </h1>
        <!--<ol class="breadcrumb">
            <li class="active"></li>
        </ol>-->
        <br>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="box box-danger">
            <div class="box-header with-border">
                <h3 class="box-title"></h3>
                <a class="btn-flat" href="<?php echo base_url("index.php/Informes")?>">
                    <i class="fa fa-arrow-circle-left fa-2x"></i>
                </a>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Minimizar">
                        <i class="fa fa-minus"></i>
                    </button>
                    <!--<button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                        <i class="fa fa-times"></i></button>-->
                </div>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <table class="table table-bordered table-condensed table-striped table-responsive" id="tblVeced">
                                <thead>
                                <tr>
                                    <!--<th>Fecha de ingreso <br>a premezcla</th>
                                    <th>Canitdad de nitrito <br>solicitado</th>
                                    <th>Cantidad Kg. <br>sal de cura obtenida</th>
                                    <th>Monitoreado por</th>
                                    <th>Acciones</th>-->
                                    <th>Cod <br> Reporte</th>
                                    <th>Monitoreo</th>
                                    <th>Dia</th>
                                    <th>Hora <br> Identific.</th>
                                    <th>Area</th>
                                    <th>Fecha</th>
                                    <th>Producto</th>
                                    <th>Cod <br> Produccion</th>
                                    <th>N° Estibas</th>
                                    <th>Monitoreado por</th>
                                    <th>Estado</th>
                                    <th>Acciones</th>
                                </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.box-body
            <div class="box-footer">
                Footer
            </div>-->
            <!-- /.box-footer-->
        </div>

    </section>
</div>
