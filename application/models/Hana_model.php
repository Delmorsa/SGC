<?php

/**
 * @Author: cesar mejia
 * @Date:   2019-08-23 09:58:33
 * @Last Modified by:   cesar mejia
 * @Last Modified time: 2019-08-27 16:05:00
 */
class Hana_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public $BD = 'SBO_DELMOR';

	public function OPen_database_odbcSAp()
	{
		$conn = @odbc_connect("HANAPHP","DELMOR","CazeheKuS2th", SQL_CUR_USE_ODBC);
         if(!$conn){
            echo '<div class="row errorConexion white-text center">
                    ¡ERROR DE CONEXION CON EL SERVIDOR!
                </div>';
         } else {
           return $conn;
         }    
	}

	public function getProductosSAP($search)
	{
    	$qfilter = '';
       if($search){
        	$qfilter = 'WHERE ("ItemName" LIKE '."'%".$search."%'".'
                        OR "ItemCode" LIKE '."'%".$search."%'".') ';
		}else{
            $qfilter = '';
        }
        $conn = $this->OPen_database_odbcSAp();
                    $query = 'SELECT DISTINCT "ItemCode","ItemName"
                        FROM '.$this->BD.'."VIEW_BODEGAS_EXISTENCIAS"
                        '.$qfilter.'
                        GROUP BY "ItemCode","ItemName" 
                        LIMIT 10';

            $resultado = @odbc_exec($conn,$query);
            $json = array();
            $i = 0;
            while ($fila = @odbc_fetch_array($resultado)) {
                $json[$i]["ItemCode"] = utf8_encode($fila["ItemCode"]);
                $json[$i]["ItemName"] = utf8_encode($fila["ItemName"]);
                $i++;
            }
            echo json_encode($json);
            echo @odbc_error($conn);
    }
}