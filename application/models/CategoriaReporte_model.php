<?php

/**
 * @Author: cesar mejia
 * @Date:   2019-08-09 14:07:53
 * @Last Modified by:   cesar mejia
 * @Last Modified time: 2019-08-09 15:01:39
 */
class CategoriaReporte_model extends CI_Model{
	public function __construct()
	 {
	 	parent::__construct();
	 	$this->load->database();
	 } 

	 public function mostrarCatRepor()
	 {
	 	$query = $this->db->get("CatReportes");
	 	if($query->num_rows() > 0){
	 		return $query->result_array();
	 	}
	 	return 0;
	 }

	 
}