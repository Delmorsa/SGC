<?php
/**
 * Created by Cesar Mejía.
 * User: Sistemas
 * Date: 24/10/2019 10:10 2019
 * FileName: Mdtde_controller.php
 */
class Mdtde_controller extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library("session");
        $this->load->model("Informes/CNS_model");
        $this->load->model("Informes/Mdtde_model");
        if ($this->session->userdata("logged") != 1) {
            redirect(base_url() . 'index.php', 'refresh');
        }
    }

    public function index()
    {
        $this->load->view('header/header');
        $this->load->view('header/menu');
        $this->load->view('informes/mdtde/mdtde');
        $this->load->view('footer/footer');
        $this->load->view('jsview/informes/mdtde/jsmdtde');
    }

    public function crearMdtde()
    {
        $data["monit"] = $this->CNS_model->getMonitoreo();
        $data["areas"] = $this->Mdtde_model->getAreas();
        $this->load->view('header/header');
        $this->load->view('header/menu');
        $this->load->view('informes/mdtde/crearMdtde',$data);
        $this->load->view('footer/footer');
        $this->load->view('jsview/informes/mdtde/jsmdtde');
    }
}