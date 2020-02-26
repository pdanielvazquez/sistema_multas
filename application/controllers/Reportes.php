<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reportes extends CI_Controller {

	public function __construct(){
        parent::__construct();
        $this->load->model("Reportes_model");
	}
	public function index(){
		$usuarioName='';
		if(isset($this->session->userdata('usuario')['id'])){
			$usuarioName=$this->session->userdata('usuario')['nombre'];
		}
		$data_header = array('titulo' => 'Sistema de multas',
							'usuario' => $usuarioName
						);			
		$list=$this->Reportes_model->get_datos();			
		$data_body=array(
			'titulo_seccion'=>'Reportes',
			'list'=>$list
		);
		$this->load->view('default/header_simple', $data_header);
		$this->load->view('body/body_reporte',$data_body);
        $this->load->view('default/footer_data_table');        
	}	
}