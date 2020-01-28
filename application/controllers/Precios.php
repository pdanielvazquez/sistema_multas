<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Precios extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model("Estudiante_Model");
		$this->load->model("Multa_Model");
	}
	public function index(){
		$data_header = array('titulo' => 'Sistema de multas',
							'usuario' => 'Usuario'
						);			
		$list=$this->Multa_Model->get_litas_precios();			
		$data_body=array(
			'titulo_seccion'=>'Precios',
			'list'=>$list
		);
		$this->load->view('default/header_simple', $data_header);
		$this->load->view('body/body_precios',$data_body);
        $this->load->view('default/footer_simple');
        
	}

	function update_precio(){

	}
}