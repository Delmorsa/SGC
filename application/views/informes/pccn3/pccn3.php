<?php
/**
 * Created by Cesar Mejía.
 * User: Sistemas
 * Date: 6/9/2019 16:34 2019
 * FileName: ppcn3.php
 */
?>
<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Monitoreo de Esterilizacion PCC N° 3

            <a href="<?php echo base_url("index.php/nuevoPCCN3")?>" class="pull-right btn btn-primary">
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
                <table class="table table-bordered table-condensed table-striped" id="tblCNS">
                    <thead>
                    <tr>
                        <!--<th>Fecha de ingreso <br>a premezcla</th>
                        <th>Canitdad de nitrito <br>solicitado</th>
                        <th>Cantidad Kg. <br>sal de cura obtenida</th>
                        <th>Monitoreado por</th>
                        <th>Acciones</th>-->
                        <th>CodReporte</th>
                        <th>Monitoreo</th>
                        <th>Dia</th>
                        <th>Hora</th>
                        <th>Area</th>
                        <th>Observaciones</th>
                        <th>Monitoreado por</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
            <!-- /.box-body
            <div class="box-footer">
                Footer
            </div>-->
            <!-- /.box-footer-->
        </div>

    </section>
</div>

