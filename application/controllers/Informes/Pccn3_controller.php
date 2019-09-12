<?php
/**
 * Created by Cesar Mejía.
 * User: Sistemas
 * Date: 6/9/2019 16:23 2019
 * FileName: Pccn3.php
 */
class Pccn3_Controller extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library("session");
        $this->load->model("Informes/CNS_model");
        $this->load->model("Informes/Pccn3_model");
        if ($this->session->userdata("logged") != 1) {
            redirect(base_url() . 'index.php', 'refresh');
        }
    }

    public function index()
    {
        $this->load->view('header/header');
        $this->load->view('header/menu');
        $this->load->view('informes/pccn3/pccn3');
        $this->load->view('footer/footer');
        //$this->load->view('jsview/informes/veced/jsVeced');
    }

    public function	nuevoPCCN3()
    {
        $data["monit"] = $this->CNS_model->getMonitoreo();
        $this->load->view('header/header');
        $this->load->view('header/menu');
        $this->load->view('informes/pccn3/crearPCCN3',$data);
        $this->load->view('footer/footer');
        $this->load->view('jsview/informes/pccn3/jsPCCN3');
    }

    public function guardarPccn3()
    {
        $this->Pccn33_model->guardarPccn3(
            $this->input->post("enc"),
            $this->input->post("datos")
        );
    }
}