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

	function Insertprecio(){
		$year=$this->input->post('year');
		$precio=$this->input->post('precio');
		$persona=$this->input->post('persona');

		$res =$this->Multa_Model->Insert_multa($year,$precio,$persona);
		if($res){
			$r=array('status'=>'success');
			echo json_encode($r);
		}else{
			$r=array('status'=>'error');
			echo json_encode($r);
		}
	}

	function update_precio(){

	}
}