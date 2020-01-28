<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Multas extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model("Estudiante_Model");
	}
	public function index(){
		$this->load->view('welcome_message');
	}
	public function blank(){
		$data_header = array('titulo' => 'Sistema de multas',
							'usuario' => 'Usuario'
						);
		$data_body = array('titulo_seccion' => 'El título'
						);
		//$this->load->view('blank', $data);
		$this->load->view('header_simple', $data_header);
		$this->load->view('body_simple', $data_body);
		$this->load->view('footer_simple');
	}

	public function nueva(){
		$data_header = array('titulo' => 'Sistema de multas',
							'usuario' => 'Usuario'
						);						
		$fecha= date("d")."/".date("m")."/".date("Y");
		$data_body = array('titulo_seccion' => 'Nueva multa',
						   'lista'=>$this->Estudiante_Model->get_select(),
						   'fecha'=>$fecha
						);
		$this->load->view('header_simple', $data_header);
		$this->load->view('body_nuevo', $data_body);
		$this->load->view('footer_simple');
	}
}