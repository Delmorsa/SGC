<?php

/**
 * @Author: cesar mejia
 * @Date:   2019-08-13 13:59:25
 * @Last Modified by:   cesar mejia
 * @Last Modified time: 2019-08-15 10:25:39
 */
class CNS_controller extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library("session");
		$this->load->model("Informes/CNS_model");
		if ($this->session->userdata("logged") != 1) {
			redirect(base_url() . 'index.php', 'refresh');
		}
	}

	public function index()
	{
		$this->load->view('header/header');
		$this->load->view('header/menu');
		$this->load->view('informes/cns/CNS');
		$this->load->view('footer/footer');	
	}

	public function	nuevoCNS()
	{
		$data["monit"] = $this->CNS_model->getMonitoreo();
		$data["areas"] = $this->CNS_model->mostrarAreas();
		$this->load->view('header/header');
		$this->load->view('header/menu');
		$this->load->view('informes/cns/crearCNS',$data);
		$this->load->view('footer/footer');	
		$this->load->view('jsview/informes/cns/jsCNS');
	}		

	public function guardarCNS()
	{
		$this->CNS_model->guardarCNS(
			$this->input->post("enc"),
			$this->input->post("datos")
		);
	}

}