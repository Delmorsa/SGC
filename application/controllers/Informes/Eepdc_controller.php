<?php
/**
 * Created by Cesar Mejía.
 * User: Sistemas
 * Date: 14/10/2019 11:32 2019
 * FileName: Eepdc_controller.php
 */
class Eepdc_controller extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library("session");
        if ($this->session->userdata("logged") != 1) {
            redirect(base_url() . 'index.php', 'refresh');
        }
        $this->load->model("Informes/CNS_model");
        $this->load->model("Informes/Eepdc_model");
    }

    public function index()
    {
        $this->load->view('header/header');
        $this->load->view('header/menu');
        $this->load->view('informes/eepdc/eepdc');
        $this->load->view('footer/footer');
        $this->load->view('jsview/informes/eepdc/jsEEPDC');
    }

    public function crearEepdc()
    {
        $data["monit"] = $this->CNS_model->getMonitoreo();
        $data["areas"] = $this->Eepdc_model->getAreas();
        $this->load->view('header/header');
        $this->load->view('header/menu');
        $this->load->view('informes/eepdc/crearEepdc',$data);
        $this->load->view('footer/footer');
        $this->load->view('jsview/informes/eepdc/jsEEPDC');
    }

    public function guardarEepdc()
    {
        $this->Eepdc_model->guardarEepdc(
            $this->input->post("enc"),
            $this->input->post("detalle")
        );
    }
}