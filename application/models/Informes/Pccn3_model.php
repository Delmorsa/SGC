<?php
/**
 * Created by Cesar Mejía.
 * User: Sistemas
 * Date: 11/9/2019 14:17 2019
 * FileName: Pccn3_model.php
 */
class Pccn3_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function guardarPccn3($enc,$datos)
    {
        $this->db->trans_begin();

        date_default_timezone_set("America/Managua");
        $mensaje = array();
        $query = $this->db->query("SELECT * FROM Monitoreos WHERE cast(FECHAINICIO AS DATE) = CAST(getdate() AS DATE) AND
									 CAST(FECHAFIN AS DATE) = cast(getdate() AS DATE) AND ESTADO = 'A' ");
        if($query->num_rows() > 0)
        {
            $id = $this->db->query("SELECT ISNULL(MAX(IDREPORTE),0)+1 AS ID FROM Reportes");
            $encabezado = array(
                "IDREPORTE" => $id->result_array()[0]["ID"],
                "IDMONITOREO" => $enc[0],
                "VERSION" => $enc[1],
                "NOMBRE" => $enc[2],
                "CODIGOPRODUCCION" => $enc[3],
                "FECHAINICIO" => gmdate($enc[4]),
                "FECHAFIN" => gmdate($enc[4]),
                "FECHACREA" => gmdate(date("Y-m-d H:i:s")),
                "IDUSUARIOCREA" => $this->session->userdata("id"),
            );
            $guardarEnc = $this->db->insert("Reportes",$encabezado);
            if($guardarEnc){
                $num = 1; $bandera = false; $bandera1 = false;
                $idreporte = $this->db->query("SELECT MAX(IDREPORTE) AS IDREPORTE FROM Reportes");
                for ($i=0; $i < count($datos); $i++) {
                    $array = explode(",",$datos[$i]);
                    $idArticulo = $this->db->query("SELECT ISNULL(MAX(IDARTICULO),0)+1 AS IDARTICULO FROM ReportesArticulos");
                    $idAccion = $this->db->query("SELECT ISNULL(MAX(IDACCION),0)+1 AS IDACCION FROM Acciones");
                    $rpt = array(
                        "IDARTICULO" => $idArticulo->result_array()[0]["IDARTICULO"],
                        "IDREPORTE" => $idreporte->result_array()[0]["IDREPORTE"],
                        "NUMERO" => $num,
                        "ESTADO" => "A",
                        "CODIGO" => $array[0],
                        "DESCRIPCION" => $array[1],
                        "HORAENTRADA" => $array[2],
                        "HORASALIDA" => $array[3],
                        "TC" => $array[4],
                        "FECHACREA" => gmdate(date("Y-m-d H:i:s")),
                        "IDUSUARIOCREA" => $this->session->userdata("id")
                    );

                    $acc = array(
                        "IDACCION" => $idAccion->result_array()[0]["IDACCION"],
                        "IDREPORTE" => $idreporte->result_array()[0]["IDREPORTE"],
                        "NUMERO" => $num,
                        "ESTADO" => "A",
                        "HORA" => gmdate(date("H:i:s")),
                        "HORAIDENTIFICACION" => gmdate(date("H:i:s")),
                        "OBSERVACIONES" => $array[5],
                        "ACCIONESCORRECTIVAS" => $array[6]
                    );

                    $num++;
                    $guardarRpt = $this->db->insert("ReportesArticulos",$rpt);

                    if($array[5] != ""){
                        $guardarRptAcciones = $this->db->insert("Acciones",$acc);
                        if($guardarRptAcciones){
                            $bandera1 = true;
                        }
                    }

                    if($guardarRpt){
                        $bandera = true;
                    }
                }
                if($bandera == true){
                    $mensaje[0]["mensaje"] = "Datos guardados correctamente";
                    $mensaje[0]["tipo"] = "success";
                    echo json_encode($mensaje);
                }else{
                    $mensaje[0]["mensaje"] = "Error al guardar los datos del informe COD(2_DET)";
                    $mensaje[0]["tipo"] = "error";
                    echo json_encode($mensaje);
                }
                if($bandera1 != true){
                    $mensaje[0]["mensaje"] = "Error al guardar los datos del informe COD(3_DET_ACCIONES)";
                    $mensaje[0]["tipo"] = "error";
                    echo json_encode($mensaje);
                }
            }else{
                $mensaje[0]["mensaje"] = "Error al guardar los datos COD(1_ENC)";
                $mensaje[0]["tipo"] = "error";
                echo json_encode($mensaje);
            }
        }else{
            $mensaje[0]["mensaje"] = "No se pudo guardar el informe porque no exsite un codigo de 
										monitoreo para la fecha ".date("d-m-Y")."";
            $mensaje[0]["tipo"] = "error";
            echo json_encode($mensaje);
        }

        if ($this->db->trans_status() === FALSE)
        {
            $this->db->trans_rollback();
        }
        else
        {
            $this->db->trans_commit();
        }
    }
}