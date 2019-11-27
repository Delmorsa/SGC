<?php
date_default_timezone_set("America/Managua");
setlocale(LC_ALL,'Spanish_Nicaragua');
/**
 * Created by Cesar Mejía.
 * User: Sistemas
 * Date: 5/11/2019 10:57 2019
 * FileName: mdtdeDetalle.php
 */
?>
<div class="content-wrapper">
    <section class="content-header">
        <h3 class="text-center">
            INDUSTRIAS DELMOR, S.A.
            <!--<small>Blank example to the fixed layout</small>-->
        </h3>
        <h4 class="text-center">
            <?php
            if(!$detalle){
                echo "";
            }else{
                foreach ($detalle as $key) {
                }
                echo '<span id="nombreRpt">'.$key["NOMBRE"].'</span>';
            }
            ?>
        </h4>
        <h4 class="text-center">
            <?php
            if(!$detalle){
                echo "";
            }else{
                foreach ($detalle as $key) {
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
                            <div class="col-xs-4 col-sm-3 col-md-3 col-lg-3">
                                <div class="form-group">
                                    <?php
                                    if(!$detalle){
                                    }else{
                                        foreach ($detalle as $key) {
                                        }
                                        echo '<input readonly value="'.$key["IDTEMPESTERILIZADOR"].'" autocomplete="off" type="hidden" id="idtempest" class="form-control">';
                                    }
                                    ?>
                                    <label>Area</label>
                                    <select disabled id="ddlAreas" class="form-control select2" style="width: 100%;">
                                        <?php
                                        if(!$detalle){
                                        }else{
                                            foreach ($detalle as $key) {
                                            }
                                            echo "
														<option selected value='".$key["IDAREA"]."'>".$key["AREA"]."</option>
													";
                                        }
                                        ?>
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
                            <div class="col-xs-4 col-sm-3 col-md-2 col-lg-2">
                                <div class="form-group has-feedback">
                                    <label for="vigencia">Version</label>
                                    <?php
                                    if(!$detalle){
                                    }else{
                                        foreach ($detalle as $key) {
                                        }
                                        echo '
                                          <input readonly value="'.$key["VERSION"].'" autocomplete="off" type="text" id="version" class="form-control" placeholder="Version del informe">
                                          ';
                                    }
                                    ?>
                                    <span class="fa fa-code-fork form-control-feedback"></span>
                                </div>
                            </div>
                            <div class="col-xs-4 col-sm-3 col-md-2 col-lg-2">
                                <div class="form-group has-feedback">
                                    <label for="vigencia">Lote</label>
                                    <?php
                                    if(!$detalle){
                                    }else{
                                        foreach ($detalle as $key) {
                                        }
                                        echo '
                                          <input readonly autocomplete="off" value="'.$key["LOTE"].'" type="text" id="Lote" class="form-control" placeholder="">
                                          ';
                                    }
                                    ?>
                                    <span class="fa fa-barcode form-control-feedback"></span>
                                </div>
                            </div>
                            <div class="col-xs-4 col-sm-3 col-md-3 col-lg-3">
                                <div class="form-group has-feedback">
                                    <label for="vigencia">Fecha</label>
                                    <?php
                                    if(!$detalle){
                                    }else{
                                        foreach ($detalle as $key) {
                                        }
                                        echo '
                                          <input readonly value="'.date_format(new DateTime($key["FECHAINICIO"]),"Y-m-d").'" type="text" id="Fecha" class="form-control" placeholder="">
                                          ';
                                    }
                                    ?>
                                    <span class="fa fa-calendar form-control-feedback"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="col-xs-4 col-sm-4 col-md-3 col-lg-3">
                                <div class="form-group has-feedback">
                                    <label for="vigencia">Mes</label>
                                    <?php
                                    date_default_timezone_set("America/Managua");
                                    setlocale(LC_TIME, "spanish");
                                    echo '
                                            <input value="'.strftime("%B %Y").'" readonly autocomplete="off" type="text" id="Mes" class="form-control" placeholder="">
                                       ';
                                    ?>
                                    <span class="fa fa-calendar form-control-feedback"></span>
                                </div>
                            </div>
                            <!--<div class="col-xs-3 col-sm-3 col-md-2 col-lg-2">
                                <div class="form-group has-feedback">
                                    <label for="vigencia">Hora</label>
                                    <?php
                                   /* if(!$detalle){
                                    }else{
                                        foreach ($detalle as $key) {
                                        }
                                        echo '
                                        <input readonly value="'.date("H:i").'" autocomplete="off" type="text" id="Hora" class="form-control">
                                          ';
                                    }*/
                                    ?>
                                    <span class="fa fa-clock-o form-control-feedback"></span>
                                </div>
                            </div>-->
                            <div class="col-xs-3 col-sm-3 col-md-2 col-lg-2">
                                <div class="form-group has-feedback">
                                    <label for="">Semana del</label>
                                    <?php
                                    if(!$detalle){
                                    }else{
                                        foreach ($detalle as $key) {
                                        }
                                        echo '
                                          <input READONLY="" value="'.$key["SEMANA"].'" autocomplete="off" type="text" id="semana" class="form-control">
                                          ';
                                    }
                                    ?>
                                    <span class="fa fa-calendar-plus-o form-control-feedback"></span>
                                </div>
                            </div>
                            <div class="col-xs-3 col-sm-3 col-md-2 col-lg-2">
                                <div class="form-group has-feedback">
                                    <label for="">Dia</label>
                                    <?php
                                    if(!$detalle){
                                    }else{
                                        foreach ($detalle as $key) {
                                        }
                                        echo '
                                         <input value="'.utf8_encode($key["DIA"]).'" readonly autocomplete="off"
                                            type="text" id="Dia" class="form-control" placeholder="">
                                          ';
                                    }
                                    ?>
                                    <span class="fa fa-calendar-check-o form-control-feedback"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="col-xs-3 col-sm-3 col-md-2 col-lg-2">
                                <div class="form-group has-feedback">
                                    <label for="">1ra toma</label>
                                    <?php
                                    if(!$detalle){
                                    }else{
                                        foreach ($detalle as $key) {
                                        }
                                        echo '
                                         <input value="'.$key["TOMA1"].'" autocomplete="off" type="text" id="toma1" class="form-control">';
                                    }
                                    ?>
                                    <span class="fa fa-file-text-o form-control-feedback"></span>
                                </div>
                            </div>
                            <div class="col-xs-3 col-sm-3 col-md-2 col-lg-2">
                                <div class="form-group has-feedback">
                                    <label for="">2da toma</label>
                                    <?php
                                    if(!$detalle){
                                    }else{
                                        foreach ($detalle as $key) {
                                        }
                                        echo '
                                         <input value="'.$key["TOMA2"].'" autocomplete="off" type="text" id="toma2" class="form-control">';
                                    }
                                    ?>
                                    <span class="fa fa-file-text-o form-control-feedback"></span>
                                </div>
                            </div>
                            <div class="col-xs-3 col-sm-3 col-md-2 col-lg-2">
                                <div class="form-group has-feedback">
                                    <label for="">3ra toma</label>
                                    <?php
                                    if(!$detalle){
                                    }else{
                                        foreach ($detalle as $key) {
                                        }
                                        echo '
                                         <input value="'.$key["TOMA3"].'" autocomplete="off" type="text" id="toma3" class="form-control">';
                                    }
                                    ?>
                                    <span class="fa fa-file-text-o form-control-feedback"></span>
                                </div>
                            </div>
                            <div class="col-xs-3 col-sm-3 col-md-2 col-lg-2">
                                <div class="form-group has-feedback">
                                    <label for="">4ta toma</label>
                                    <?php
                                    if(!$detalle){
                                    }else{
                                        foreach ($detalle as $key) {
                                        }
                                        echo '
                                         <input value="'.$key["TOMA4"].'" autocomplete="off" type="text" id="toma4" class="form-control">';
                                    }
                                    ?>
                                    <span class="fa fa-file-text-o form-control-feedback"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12">
                            <!-- <div class="col-xs-3 col-sm-3 col-md-2 col-lg-2">
                                 <div class="form-group">
                                     <label for="">Toma</label>
                                     <select name="" id="Toma" class="form-control select2" style="width: 100%;">
                                         <option></option>
                                         <option value="1">1ra</option>
                                         <option value="2">2da</option>
                                         <option value="3">3ra</option>
                                         <option value="4">4ta</option>
                                     </select>
                                 </div>
                             </div>
                             <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                                 <div class="form-group has-feedback">
                                     <label for="">Temperatura</label>
                                     <input type="text" id="Temperatura" class="form-control" placeholder="Temperatura">
                                     <span class="fa fa-thermometer-4 form-control-feedback"></span>
                                 </div>
                             </div>-->
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                                <div class="form-group has-feedback">
                                    <label for="">monitoreado por</label>
                                    <input readonly="" value="<?php echo $this->session->userdata("nombre")." ".$this->session->userdata("apellidos")?>" autocomplete="off" type="text" id="monituser" class="form-control" placeholder="monitoreado por">
                                    <span class="fa fa-user form-control-feedback"></span>
                                </div>
                            </div>
                            <div class="col-xs-7 col-sm-9 col-md-7 col-lg-7">
                                <div class="form-group has-feedback">
                                    <label for="">Observaciones</label>
                                    <?php
                                    if(!$detalle){
                                    }else{
                                        foreach ($detalle as $key) {
                                        }
                                        echo '
                                         <input type="text" value="'.$key["OBSERVACIONES"].'" id="observaciones" class="form-control" placeholder="Observaciones">
                                          ';
                                    }
                                    ?>
                                    <span class="fa fa-pencil form-control-feedback"></span>
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
                        <th class="text-center">N°</th>
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
                    <?php
                    if(!$detalle){
                    }else{
                        $i = 1;
                        foreach ($detalle as $key) {
                            echo "
                                <tr>
                                    <td>".$i."</td>
                                    <td>".$key["SEMANA"]."</td>
                                    <td>".$key["DIA"]."</td>
                                    <td>".$key["TOMA1"]."</td>
                                    <td>".$key["TOMA2"]."</td>
                                    <td>".$key["TOMA3"]."</td>
                                    <td>".$key["TOMA4"]."</td>
                                    <td>".$key["OBSERVACIONES"]."</td>
                                </tr>
                            ";
                            $i++;
                        }
                    }
                    ?>
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

