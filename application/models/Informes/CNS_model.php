<?php

/**
 * @Author: cesar mejia
 * @Date:   2019-08-13 14:31:59
 * @Last Modified by:   cesar mejia
 * @Last Modified time: 2019-08-16 15:20:48
 */
class CNS_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function getMonitoreo()
	{
		$query = $this->db->query("SELECT * FROM Monitoreos
									WHERE cast(FECHAINICIO AS DATE) = CAST(getdate() AS DATE) AND
									 CAST(FECHAFIN AS DATE) = cast(getdate() AS DATE) AND ESTADO = 'A' ");
		if($query->num_rows() > 0)
		{
			return $query->result_array();
		}
		return 0;
	}

	public function mostrarAreas(){
		$query = $this->db->query("SELECT t1.*,CONCAT(t2.NOMBRES,' ',t2.APELLIDOS) as NOMBRES FROM Areas t1
		                           inner join [Usuarios] t2 on t1.USUARIOCREA = t2.IDUSUARIO where t1.ESTADO = 1");
		if($query->num_rows() > 0){
			return $query->result_array();
		}
		return 0;
	} 

	public function mostrarCNS()
	{
		$query = $this->db->query("SELECT t1.SIGLA,t1.DIA,CAST(t1.HORA AS time(0)) HORA,t1.AREA,t1.ESTADOENC,
		t1.OBSERVACIONES,t1.IDREPORTE,t1.IDUSUARIOCREA,
		CONCAT(t2.NOMBRES,' ',t2.APELLIDOS) MONITOREADO_POR
		FROM view_InformesPeso t1
		INNER JOIN Usuarios t2 ON t1.IDUSUARIOCREA = t2.IDUSUARIO 
		WHERE NOMBRE LIKE '%CONTROL DE NITRITO DE SODIO%'
		GROUP BY IDREPORTE,SIGLA,DIA,HORA,AREA,OBSERVACIONES,IDUSUARIOCREA,
		NOMBRES,APELLIDOS,ESTADOENC");
		if($query->num_rows() > 0)
		{	
			return $query->result_array();
		}
		return 0;
	}

	public function guardarCNS($enc,$datos)
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
		      "IDAREA" => $enc[1],
		      "VERSION" => $enc[2],
		      "NOMBRE" => $enc[3],
		      "OBSERVACIONES" => $enc[4],
		      "FECHAINICIO" => gmdate(date("Y-m-d H:i:s")),
		      "FECHAFIN" => gmdate(date("Y-m-d H:i:s")),
		      "FECHACREA" => gmdate(date("Y-m-d H:i:s")),
		      "IDUSUARIOCREA" => $this->session->userdata("id"),
			);
			$guardarEnc = $this->db->insert("Reportes",$encabezado);
			if($guardarEnc){
				$num = 1; $bandera = false; 
				$idreporte = $this->db->query("SELECT MAX(IDREPORTE) AS IDREPORTE FROM Reportes");
				for ($i=0; $i < count($datos); $i++) { 
					$array = explode(",",$datos[$i]);
					$idpeso = $this->db->query("SELECT ISNULL(MAX(IDPESO),0)+1 AS IDPESO FROM ReportesPeso");
					$rpt = array(
						"IDPESO" => $idpeso->result_array()[0]["IDPESO"],
		                "IDREPORTE" => $idreporte->result_array()[0]["IDREPORTE"],
		                "ESTADO" => "A",
		                "NUMERO" => $num,
		                "HORA" => gmdate(date("H:i:s")),
		                "FECHAINGRESO" => $array[0],
		                "CANTIDADNITRITO" => $array[1],
		                "CANTIDADKG" => $array[2],
		                "FECHACREA" => gmdate(date("Y-m-d H:i:s")),
		                "IDUSUARIOCREA" => $this->session->userdata("id")
				    );	
				    $num++;	
				    $guardarRpt = $this->db->insert("ReportesPeso",$rpt);
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