<?php
/**
 * Created by Cesar Mejía.
 * User: Sistemas
 * Date: 14/10/2019 14:59 2019
 * FileName: Eepdc_model.php
 */
class Eepdc_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function getAreas()
    {
        $query = $this->db->get("Areas");
        if($query->num_rows() > 0){
               return $query->result_array();
        }
        return 0;
    }

    public function guardarEepdc($enc,$detalle)
    {
        $this->db->trans_begin();
        date_default_timezone_set("America/Managua");
        $mensaje = array(); $bandera = false;
        $query = $this->db->query("SELECT * FROM Monitoreos WHERE cast(FECHAINICIO AS DATE) = CAST(getdate() AS DATE) AND
									 CAST(FECHAFIN AS DATE) = cast(getdate() AS DATE) AND ESTADO = 'A' ");
        if($query->num_rows() > 0){
            $id = $this->db->query("SELECT ISNULL(MAX(IDREPORTE),0)+1 AS ID FROM Reportes");
            $encabezado = array(
                "IDREPORTE" => $id->result_array()[0]["ID"],
                "IDMONITOREO" => $query->result_array()[0]["IDMONITOREO"],
                "IDAREA" => $enc[0],
                "VERSION" => $enc[1],
                "IDTIPOREPORTE" => 11,
                "NOMBRE" => $enc[2],
                "OBSERVACIONES" => $enc[3],
                "ESTADO" => "A",
                "FECHAINICIO" => gmdate($enc[4]),
                "FECHAFIN" => gmdate($enc[4]),
                "FECHACREA" => gmdate(date("Y-m-d H:i:s")),
                "IDUSUARIOCREA" => $this->session->userdata("id"),
            );
            $guardarEnc = $this->db->insert("Reportes",$encabezado);
            if($guardarEnc){
                $bandera = true;
            }else{
                $mensaje[0]["mensaje"] = "Se produjo un error al guardar los datos. COD-1(ENC)";
                $mensaje[0]["tipo"] = "error";
                echo json_encode($mensaje);
            }
            if($bandera == true){
                $num = 1; $bandera1 = false;
                $idreporte = $this->db->query("SELECT MAX(IDREPORTE) AS IDREPORTE FROM Reportes");

                $det = json_decode($detalle,true);
                foreach($det as $obj){
                    $idenavse = $this->db->query("SELECT ISNULL(MAX(IDENVASE),0)+1 AS IDENVASE FROM ReportesEnvases");
                    $insertdet = array(
                        "IDENVASE" => $idenavse->result_array()[0]["IDENVASE"],
                        "IDREPORTE" => $idreporte->result_array()[0]["IDREPORTE"],
                        "IDEMPRESA" => $obj[0],
                        "NUMERO" => $num,
                        "ESTADO" => "A",
                        "CODIGO" => $obj[1],
                        "NOMBRE" => $obj[2],
                        "LOTE" => $obj[3],
                        "CABEZALMAQUINA" => $obj[4],
                        "T" => $obj[5],
                        "L" => $obj[6],
                        "GC" => $obj[7],
                        "GT" => $obj[8],
                        "FECHACREA" => gmdate(date("Y-m-d H:i:s")),
                        "USUARIOCREA" => $this->session->userdata("id")
                    );
                    $num++;
                    $guardaDet = $this->db->insert("ReportesEnvases",$insertdet);
                    if($guardaDet){
                        $bandera1 = true;
                    }
                }
                if($bandera1){
                    $mensaje[0]["mensaje"] = "Datos guardados con éxito";
                    $mensaje[0]["tipo"] = "success";
                    echo json_encode($mensaje);
                }else{
                    $mensaje[0]["mensaje"] = "Se produjo un error al guardar los datos. COD-2(DET)";
                    $mensaje[0]["tipo"] = "error";
                    echo json_encode($mensaje);
                }
            }
        }else{
            $mensaje[0]["mensaje"] = "No se pudo guardar el informe porque no exsite un codigo de monitoreo para la fecha ".date("d-m-Y")."";
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