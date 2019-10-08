<?php
/**
 * Created by Cesar Mejía.
 * User: Sistemas
 * Date: 23/9/2019 11:36 2019
 * FileName: Mcpe_controller.php
 */
class Mcpe_controller extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library("session");
        $this->load->model("Informes/CNS_model");
        $this->load->model("Informes/Mcpe_model");
        if ($this->session->userdata("logged") != 1) {
            redirect(base_url() . 'index.php', 'refresh');
        }
    }

    public function index()
    {
        $this->load->view('header/header');
        $this->load->view('header/menu');
        $this->load->view('informes/mcpe/mcpe');
        $this->load->view('footer/footer');
        //$this->load->view('jsview/informes/pccn3/jsPCCN3');
    }

    public function nuevoMCPE()
    {
        $data["monit"] = $this->CNS_model->getMonitoreo();
        $data["maq"] = $this->Mcpe_model->getMaquinas();
        $this->load->view('header/header');
        $this->load->view('header/menu');
        $this->load->view('informes/mcpe/crearMcpe',$data);
        $this->load->view('footer/footer');
        $this->load->view('jsview/informes/mcpe/jsMCPE');
    }

    public function guardarMcpeVerificPeso()
    {
        $this->Mcpe_model->guardarMcpeVerificPeso(
            $this->input->post("enc"),
            $this->input->post("detalle")
        );
    }

    public function guardarMcpeVerificCaract()
    {
        $this->Mcpe_model->guardarMcpeVerificCaract(
            $this->input->post("enc"),
            $this->input->post("detalle")
        );
    }

}