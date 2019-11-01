<?php
/**
 * Created by Cesar Mejía.
 * User: Sistemas
 * Date: 25/10/2019 11:29 2019
 * FileName: Mdtde_model.php
 */
class Mdtde_model extends CI_Model
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

    public function getMdtde()
    {
        $query = $this->db->query("SELECT IDREPORTE,IDMONITOREO,SIGLA,ANIO,VERSION,AREA,MES,SEMANA,USUARIO,ESTADO
                                    FROM view_InformesTemEsteri
                                    GROUP BY
                                    IDREPORTE,IDMONITOREO,SIGLA,VERSION,ANIO,AREA,MES,SEMANA,USUARIO,ESTADO");
        if($query->num_rows() > 0){
            return $query->result_array();
        }
        return 0;
    }

    public function getMdtdeAjax($idreporte){
        $json = array(); $i = 0;
        $query = $this->db->where("IDREPORTE",$idreporte)->get("TempEsterilizador ");
        if($query->num_rows() > 0){
            foreach ($query->result_array() as $key) {
                $json[$i]["Dia"] = $key["DIA"];
                $json[$i]["Toma"] = $key["TOMA"];
                $json[$i]["Temp"] = number_format($key["TEMPERATURA"],0)."°f";
                $json[$i]["Hora"] = date_format(new DateTime($key["HORA"]), "H:i");
                $json[$i]["Observaciones"] = $key["OBSERVACIONES"];
                $i++;
            }
            echo json_encode($json);
        }
    }

    public function guardarMdtde($enc,$detalle)
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
                "IDTIPOREPORTE" => 13,
                "NOMBRE" => $enc[2],
                "LOTE" => $enc[3],
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
                    $idtemp = $this->db->query("SELECT ISNULL(MAX(IDTEMPESTERILIZADOR),0)+1 AS IDTEMP FROM TempEsterilizador");
                    $insertdet = array(
                        "IDTEMPESTERILIZADOR" => $idtemp->result_array()[0]["IDTEMP"],
                        "IDREPORTE" => $idreporte->result_array()[0]["IDREPORTE"],
                        "IDAREA" => $enc[0],
                        "ANIO" => gmdate(date("Y")),
                        "MES" => gmdate(date("m")),
                        "SEMANA" => $obj[0],
                        "DIA" => $obj[1],
                        "TOMA" => $obj[2],
                        "TEMPERATURA" => $obj[3],
                        "HORA" => $obj[4],
                        "OBSERVACIONES" => $obj[5],
                        "FECHACREA" => gmdate("Y-m-d H:i:s"),
                        "USUARIOCREA" => $this->session->userdata('id')

                    );
                    $num++;
                    $guardaDet = $this->db->insert("TempEsterilizador",$insertdet);
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

    public function bajaMdtde($idreporte,$estado){
        $mensaje = array();
        $this->db->where("IDREPORTE", $idreporte);
        $datos = array(
            "ESTADO" => $estado
        );
        $actualizar = $this->db->update("Reportes",$datos);
        if($actualizar){
            $mensaje[0]["mensaje"] = "La operación se llevo a cabo con éxito.";
            $mensaje[0]["tipo"] = "success";
            echo json_encode($mensaje);
        }else{
            $mensaje[0]["mensaje"] = "Fallo en la operación.
			 Ocurrió un error inesperado en el servidor, si el error persiste contáctece con el administrador.";
            $mensaje[0]["tipo"] = "error";
            echo json_encode($mensaje);
        }
    }
}