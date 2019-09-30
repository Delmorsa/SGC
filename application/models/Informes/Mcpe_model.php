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

    public function guardarMcpe($enc,$datos)
    {

    }
}