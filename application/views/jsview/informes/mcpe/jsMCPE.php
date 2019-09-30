<?php
/**
 * Created by Cesar Mejía.
 * User: Sistemas
 * Date: 26/9/2019 15:22 2019
 * FileName: jsMCPE.php
 */?>
<script type="text/javascript">
    $(document).ready(function(){
        let counter = 1;
        let counter1 = 1;
        $('#tblcrear,#tblcrear1').DataTable( {
            "scrollX": false,
            "searching": false,
            "ordering": false,
            "paginate": false,
            "info": false,
            "language": {
                "info": "Registro _START_ a _END_ de _TOTAL_ entradas",
                "infoEmpty": "Registro 0 a 0 de 0 entradas",
                "zeroRecords": "No se encontro coincidencia",
                "infoFiltered": "(filtrado de _MAX_ registros en total)",
                "emptyTable": "NO HAY DATOS",
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
        } );
        $('#fecha,#fecha1,#fechaVenc').datepicker({"autoclose":true});
        $("#ddlTipo").select2();
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
            }
        ).trigger('change');

        $("#btnAdd").click(function () {
            let t = $('#tblcrear').DataTable({
                "info": false,
                "scrollX": true,
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
            let fecha = $("#fecha").val(),
                ddlprod = $("#ddlprod option:selected").text(),
                ddlcodprod = $("#ddlprod option:selected").val(),
                ddlTipo = $("#ddlTipo option:selected").text(),
                produccion = $("#produccion").val(),
                fechaVenc = $("#fechaVenc").val(),
                presentacion = $("#"+ddlcodprod+"txtpeso").val(),
                PV = $("#PV").val(),
                MS = $("#MS").val(),
                MC = $("#MC").val(),
                TC = $("#TC").val(),
                operario = $("#operario").val(),
                Defecto = $("#Defecto").val();
                presentacion = Number(presentacion).toFixed(0);

            if(fecha == "" || produccion == "" || ddlprod == "" || ddlTipo == "" || fechaVenc == "" || PV== "" || MS == ""
                || MC == "" || TC == "" || operario == ""){
                Swal.fire({
                    text: "Todos los campos son requeridos",
                    type: "warning",
                    allowOutsideClick: false
                });
            }else{
                t.row.add([
                    counter,
                    ddlcodprod,
                    ddlprod,
                    ddlTipo,
                    produccion,
                    fechaVenc,
                    presentacion,
                    PV,
                    MS,
                    MC,
                    TC,
                    operario,
                    Defecto
                ]).draw(false);
                //$("#ddlAreas").val("").trigger("change");
            }
            counter++;
        });

        $("#btnAdd1").click(function () {
            let t = $('#tblcrear1').DataTable({
                "info": false,
                "scrollX": true,
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
            let fecha = $("#fecha1").val(),
                Hora = $("#Hora").val(),
                Codigo1 = $("#Codigo1").val(),
                pesoMasaUtil = $("#pesoMasaUtil").val(),
                pesoRegistrado = $("#pesoRegistrado").val(),
                Diferencia = $("#Diferencia").val(),
                observaciones = $("#observaciones").val();

            if(fecha == "" || Hora == "" || Codigo1 == "" || pesoMasaUtil == "" || pesoRegistrado == ""){
                Swal.fire({
                    text: "Todos los campos son requeridos",
                    type: "warning",
                    allowOutsideClick: false
                });
            }else{
                t.row.add([
                    counter1,
                    Hora,
                    Codigo1,
                    pesoMasaUtil,
                    pesoRegistrado,
                    Diferencia,
                    observaciones
                ]).draw(false);
                //$("#ddlAreas").val("").trigger("change");
            }
            counter1++;
        });

        $('#tblcrear tbody').on( 'click', 'tr', function () {
            $(this).toggleClass('danger');
        });

        $('#tblcrear1 tbody').on( 'click', 'tr', function () {
            $(this).toggleClass('danger');
        });

        $("#btnDelete").click(function (){
            let table = $("#tblcrear").DataTable();
            let rows = table.rows( '.danger' ).remove().draw();
        });

        $("#btnDelete1").click(function (){
            let table = $("#tblcrear1").DataTable();
            let rows = table.rows( '.danger' ).remove().draw();
        });
    });

    $("#MC").on("keyup",function () {
        let  PV = Number($("#PV").val()),
            MS = Number($("#MS").val()),
            MC = Number($("#MC").val()),
            suma = 0;
        suma = PV+MS+MC;
        $("#Defecto").val(suma);
    });

    $("#pesoRegistrado").on("keyup",function () {
        let pesoMasaUtil = $("#pesoMasaUtil").val(),
            pesoRegistrado = $("#pesoRegistrado").val(),
            diferencia = 0;
        diferencia = pesoMasaUtil-pesoRegistrado;
        $("#Diferencia").val(diferencia);
    });

</script>
