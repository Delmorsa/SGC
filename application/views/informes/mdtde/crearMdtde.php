<?php
/**
 * Created by Cesar Mejía.
 * User: Sistemas
 * Date: 24/10/2019 11:40 2019
 * FileName: crearMdtde.php
 */
?>
<div class="content-wrapper">
    <section class="content-header">
        <h3 class="text-center">
            INDUSTRIAS DELMOR, S.A.
            <!--<small>Blank example to the fixed layout</small>-->
        </h3>
        <h4 class="text-center">
            <span id="nombreRpt">MONITOREO DE TEMPERATURA DEL ESTERILIZADOR</span>
        </h4>
        <h4 class="text-center">
            <?php
            if(!$monit){
                echo "
                <h5 class='text-center text-danger text-bold'>
                    No existe código de monitoreo para el dia actual. para agregar un nuevo codigo </br>
                    haga click en <a href='".base_url("index.php/monitoreos")."'>Crear</a>
                </h5>";
            }else{
                foreach ($monit as $key) {
                    echo "ISO-HACCP-".$key["SIGLA"]."";
                    echo '<div class="form-group has-feedback">
								<input type="hidden" id="idmonitoreo" class="form-control" value="'.$key["IDMONITOREO"].'">
							</div>';
                }
            }
            ?>
        </h4>
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
                <a class="btn-flat" href="javascript:history.back()">
                    <i class="fa fa-arrow-circle-left fa-2x"></i>
                </a>
                <button class="pull-right btn btn-primary" id="btnGuardar">
                    Guardar <i class="fa fa-save"></i>
                </button>
                <div class="box-tools pull-right">

                    <!--<button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                        <i class="fa fa-times"></i></button>-->
                </div>
            </div>
            <div class="box-body">
                <div>
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="col-xs-4 col-sm-4 col-md-3 col-lg-3">
                                <div class="form-group">
                                    <label>Area</label>
                                    <select id="ddlAreas" class="form-control select2" style="width: 100%;">
                                        <option></option>
                                        <?php
                                        if(!$areas){
                                        }else{
                                            foreach ($areas as $key) {
                                                echo "
														<option value='".$key["IDAREA"]."'>".$key["AREA"]."</option>
													";
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2">
                                <div class="form-group has-feedback">
                                    <label for="vigencia">Version</label>
                                    <input autocomplete="off" type="text" id="version" class="form-control" placeholder="Version del informe">
                                    <span class="fa fa-code-fork form-control-feedback"></span>
                                </div>
                            </div>
                            <div class="col-xs-8 col-sm-8 col-md-6 col-lg-6">
                                <div class="form-group has-feedback">
                                    <label for="vigencia">Observaciones</label>
                                    <input autocomplete="off" type="text" id="observaciones" class="form-control" placeholder="Observaciones">
                                    <span class="fa fa-pencil form-control-feedback"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="col-xs-3 col-sm-3 col-md-3 col-lg-2">
                                <div class="form-group has-feedback">
                                    <label for="vigencia">Fecha ingreso</label>
                                    <input autocomplete="off" type="text" id="fecha" class="form-control" placeholder="Fecha ingreso">
                                    <span class="fa fa-calendar form-control-feedback"></span>
                                </div>
                            </div>
                            <div class="col-xs-3 col-sm-3 col-md-2 col-lg-2">
                                <div class="form-group has-feedback">
                                    <label for="">Cantidad nitrito s.</label>
                                    <input autofocus="" autocomplete="off" type="text" id="nitrito" class="form-control" placeholder="cantidad nitrito">
                                    <span class="fa fa-sort-alpha-desc form-control-feedback"></span>
                                </div>
                            </div>
                            <div class="col-xs-3 col-sm-3 col-md-2 col-lg-2">
                                <div class="form-group has-feedback">
                                    <label for="">Cantidad kg.</label>
                                    <input autofocus="" autocomplete="off" type="text" id="kg" class="form-control col-xs-4" placeholder="cantidad Kg">
                                    <span class="fa fa-sort-alpha-desc form-control-feedback"></span>
                                </div>
                            </div>
                            <div class="col-xs-3 col-sm-3 col-md-3 col-lg-2">
                                <div class="form-group has-feedback">
                                    <label for="">monitoreado por</label>
                                    <input readonly="" value="<?php echo $this->session->userdata("nombre")." ".$this->session->userdata("apellidos")?>" autocomplete="off" type="text" id="monituser" class="form-control" placeholder="monitoreado por">
                                    <span class="fa fa-user form-control-feedback"></span>
                                </div>
                            </div>
                            <div class="col-xs-4 col-sm-4 col-md-2 col-lg-2">
                                <div class="form-group has-feedback">
                                    <label for=""> </label>
                                    <button id="btnAdd" class="btn btn-primary"><i class="fa fa-plus"></i></button>
                                    <label for=""> </label>
                                    <button id="btnDelete" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
                <table class="table table-bordered table-condensed table-striped" id="tblcrear">
                    <thead>
                    <tr>
                        <th class="text-center">Semana</th>
                        <th class="text-center">Dia</th>
                        <th class="text-center">1era Toma <br> 8:00 A.M</th>
                        <th class="text-center">2da Toma <br> 10:00 A.M</th>
                        <th class="text-center">3era Toma <br> 2:00 P.M</th>
                        <th class="text-center">4ta Toma <br> 4:00 P.M</th>
                        <th class="text-center">Observaciones</th>
                    </tr>
                    </thead>
                    <tbody class="text-center">
                    </tbody>
                </table>
            </div>
        </div>

    </section>
</div>

<div class="modal" id="loading" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
        <div class="modal-content" style="background-color:transparent;box-shadow: none; border: none;margin-top: 26vh;">
            <div class="text-center">
                <img width="130px" src="<?php echo base_url()?>assets/img/loading.gif">
            </div>
        </div>
    </div>
</div>
