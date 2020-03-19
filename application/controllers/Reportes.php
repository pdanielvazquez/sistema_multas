<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reportes extends CI_Controller {

	public function __construct(){
        parent::__construct();
        $this->load->model("Reportes_model");
	}
	public function index(){
		if($this->session->userdata('usuario')['activo']){
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
		}else{
			$ruta=base_url();
			header("Location: $ruta");
		}
	}	
	//
	public function informe(){
		if($this->session->userdata('usuario')['activo']){
			$usuarioName='';
			if(isset($this->session->userdata('usuario')['id'])){
				$usuarioName=$this->session->userdata('usuario')['nombre'];
			}
			$data_header = array('titulo' => 'Sistema de multas',
								'usuario' => $usuarioName
							);	
			$this->load->view('default/header_simple', $data_header);
			//datos
			$yearOne=$this->input->post('yearOne');
			$yearTwo=$this->input->post('yearTwo');
			$mesOne=$this->input->post('mesOne');
			$mesTwo=$this->input->post('mesTwo');
			
			
			if (isset($yearOne)&&isset($yearTwo)&&isset($mesOne)&&isset($mesTwo)) {
				$datos= $this->Reportes_model->get_reporte($yearOne,$yearTwo,$mesOne,$mesTwo);
				$data_body=array(
					'titulo_seccion'=>'Informes',
					'tabla'			=>$datos
				);
				$this->load->view('body/body_informe',$data_body);
			}else{
				$data_body=array(
					'titulo_seccion'=>'Informes',
					'tabla'			=>null
				);
				$this->load->view('body/body_informe',$data_body);
			}
			
			$this->load->view('default/footer_data_table');        
		}else{
			$ruta=base_url();
			header("Location: $ruta");
		}
	}

	public function get_data_grafica(){
		
		$year=$this->input->post('year');
		//'pagada'

		
		$respuesta=array(
			'pagada'=>$this->Reportes_model->chart_data($year,'pagada'),
			'no_pagada'=>$this->Reportes_model->chart_data($year,'no pagada'),
			'status'=>'success'
		);
		echo json_encode($respuesta);

	}
}