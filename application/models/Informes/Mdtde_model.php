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
}