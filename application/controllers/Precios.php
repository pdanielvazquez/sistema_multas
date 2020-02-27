<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Precios extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model("Estudiante_Model");
		$this->load->model("Multa_Model");
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
			$list=$this->Multa_Model->get_litas_precios();			
			$data_body=array(
				'titulo_seccion'=>'Precios',
				'list'=>$list
			);
			$this->load->view('default/header_simple', $data_header);
			$this->load->view('body/body_precios',$data_body);
			$this->load->view('default/footer_simple');        
		}else{
			$ruta=base_url();
			header("Location: $ruta");
		}
	}
	function Insertprecio(){
		if($this->session->userdata('usuario')['activo']){
			$year=$this->input->post('year');
			$precio=$this->input->post('precio');
			$persona=$this->input->post('persona');
			$res =$this->Multa_Model->Insert_multa($year,$precio,$persona);
			if($res){
				$usuarioName='';
				if(isset($this->session->userdata('usuario')['id'])){
					$usuarioName=$this->session->userdata('usuario')['nombre'];
				}
				$data_header = array('titulo' => 'Sistema de multas',
									'usuario' => $usuarioName
								);			
				$list=$this->Multa_Model->get_litas_precios();			
				$data_body=array(
					'titulo_seccion'=>'Precios',
					'list'=>$list,
					'msg'=>"Operacion satisfecha"
				);
				$this->load->view('default/header_simple', $data_header);
				$this->load->view('body/body_precios',$data_body);
				$this->load->view('default/footer_simple');
			}else{
				$usuarioName='';
				if(isset($this->session->userdata('usuario')['id'])){
					$usuarioName=$this->session->userdata('usuario')['nombre'];
				}
				$data_header = array('titulo' => 'Sistema de multas',
									'usuario' => $usuarioName
								);			
				$list=$this->Multa_Model->get_litas_precios();			
				$data_body=array(
					'titulo_seccion'=>'Precios',
					'list'=>$list,
					'msg'=>"Error al guardar precio"
				);
				$this->load->view('default/header_simple', $data_header);
				$this->load->view('body/body_precios',$data_body);
				$this->load->view('default/footer_simple');
			}
		}else{
			$ruta=base_url();
			header("Location: $ruta");
		}
	}
	public function get_activos(){
		$datos=$this->Multa_Model->get_activos();
		echo  json_encode($datos);
	}
	public function update_activo(){
		$id=$this->input->post('id');
		$accion=$this->input->post('accion');
		$status=0;
		if ($accion=='desactiva') {
			$status=0;
		}
		if ($accion=='activa') {
			$status=1;
		}
		$satisfecho=$this->Multa_Model->update_stado_precio($id,$status);
		if ($satisfecho) {
			$res=array(
				'status'=>'success',
				'msg'=>'operaciòn satisfecha'
			);	
			echo json_encode($res);
		}else{
			$res=array(
				'status'=>'error',
				'msg'=>'Error en la peticiòn'
			);	
			echo json_encode($res);
		}

	}
}