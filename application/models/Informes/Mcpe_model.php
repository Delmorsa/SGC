<?php
/**
 * Created by Cesar Mejía.
 * User: Sistemas
 * Date: 27/9/2019 11:33 2019
 * FileName: Mcpe_model.php
 */
class Mcpe_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function getMaquinas()
    {
        $query = $this->db->get("CatMaquinas");
        if($query->num_rows() > 0)
        {
            return $query->result_array();
        }
        return 0;
    }

    public function guardarMcpeVerificPeso($enc,$detalle)
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
                "IDMONITOREO" => $enc[0],
                "IDAREA" => 2,
                "VERSION" => $enc[1],
                "IDTIPOREPORTE" => 4,
                "NOMBRE" => $enc[2],
                "ESTADO" => "A",
                "FECHAINICIO" => gmdate($enc[3]),
                "FECHAFIN" => gmdate($enc[3]),
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
                    $idpeso = $this->db->query("SELECT ISNULL(MAX(IDPESO),0)+1 AS IDPESO FROM ReportesPeso");
                    $insertdet = array(
                        "IDPESO" => $idpeso->result_array()[0]["IDPESO"],
                        "IDREPORTE" => $idreporte->result_array()[0]["IDREPORTE"],
                        "ESTADO" => "A",
                        "NUMERO" => $num,
                        "CODBASCULA" => $obj[0],
                        "HORA" => $obj[1],
                        "FECHAINGRESO" => $enc[3],
                        "UNIDADPESO" => $obj[2],
                        "PESOMASA" => $obj[3],
                        "PESOBASCULA" => $obj[4],
                        "DIFERENCIA" => $obj[5],
                        "FECHACREA" => gmdate(date("Y-m-d H:i:s")),
                        "IDUSUARIOCREA" => $this->session->userdata('id')
                    );
                    $num++;
                    $guardaDet = $this->db->insert("ReportesPeso",$insertdet);
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

    public function guardarMcpeVerificCaract($enc,$detalle)
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
                "IDMONITOREO" => $enc[0],
                "IDAREA" => 2,
                "VERSION" => $enc[1],
                "IDTIPOREPORTE" => 4,
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
                    $idpeso = $this->db->query("SELECT ISNULL(MAX(IDARTICULO),0)+1 AS IDARTICULO FROM ReportesArticulos");
                    $insertdet = array(
                        "IDARTICULO" => $idpeso->result_array()[0]["IDARTICULO"],
                        "IDREPORTE" => $idreporte->result_array()[0]["IDREPORTE"],
                        "NUMERO" => $num,
                        "ESTADO" => "A",
                        "CODIGO" => $obj[0],
                        "NOMBRE" => $obj[1],
                        "VACIO" => $obj[2],
                        "GRANEL" => $obj[3],
                        "LOTE" => $obj[4],
                        "FECHAVENCIMIENTO" => gmdate($obj[5]),
                        "PRESENTACION" => $obj[6],
                        "UNIDADPRESENTACION" => $obj[7],
                        "PV" => $obj[8],
                        "MS" => $obj[9],
                        "MC" => $obj[10],
                        "TC" => $obj[11],
                        "IDMAQUINA" => $obj[12],
                        "OPERARIO" => $obj[13],
                        "DEFECTO" => $obj[14],
                        "FECHACREA" => gmdate(date("Y-m-d H:i:s")),
                        "IDUSUARIOCREA" => $this->session->userdata('id')
                    );
                    $num++;
                    $guardaDet = $this->db->insert("ReportesArticulos",$insertdet);
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