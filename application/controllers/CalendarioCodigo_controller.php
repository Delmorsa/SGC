<?php
/**
 * Created by Cesar Mejía.
 * User: Sistemas
 * Date: 17/5/2019 15:39 2019
 * FileName: CalendarioCodigo_controller.php
 */
class CalendarioCodigo_controller extends CI_Controller{
	public function __construct()
	{
		parent::__construct();
		$this->load->library("session");
		if ($this->session->userdata("logged") != 1) {
			redirect(base_url() . 'index.php', 'refresh');
		}
	}

	public function index()
	{
		$this->load->view('header/header');
		$this->load->view('header/menu');
		$this->load->view('Calendario/Productos');
		$this->load->view('footer/footer');
		//$this->load->view('jsview/usuarios/jsRoles');
	}
}
?>

