<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Multas extends CI_Controller
{
	public function __construct(){
		parent::__construct();
		$this->load->model("Estudiante_Model");
		$this->load->model("Maestro_Model");
		$this->load->model("Material_Model");
		$this->load->model("Multa_Model");
		$this->load->model("Etiquetas_Model");
		// Cargamos la librería
		$this->load->library('pdf');
		
	}

	public function index(){
		$data_header = array('titulo' => 'Sistema de multas',
							'usuario' => 'Usuario'
						);
		$data_body = array('titulo_seccion' => 'El título'
						);
		//$this->load->view('blank', $data);
		$this->load->view('default/header_simple', $data_header);
		$this->load->view('body_simple', $data_body);
		$this->load->view('default/footer_simple');	
	}

	public function get_precio_multa(){
		$TipoPersona = $this->input->post('personal');
		$datos = $this->Multa_Model->get_precio($TipoPersona);
		$precio = 0;

		foreach ($datos as $key => $value) {
			$precio = $value->precio;
		}
		$res = array(array(
			"precio" => $precio
		));
		echo json_encode($res);
	}
	
	public function nueva(){
		$data_header = array(
			'titulo' => 'Sistema de multas',
			'usuario' => 'Usuario'
		);
		$fecha = date("d") . "/" . date("m") . "/" . date("Y");
		$data_body = array(
			'titulo_seccion' => 'Nueva multa',
			'lista' => $this->Estudiante_Model->get_select(),
			'lista_id'=>$this->Maestro_Model->get_id(),
			'materiales'=>$this->Material_Model->get_material(),
			'etiquetas'=>$this->Etiquetas_Model->get_etiquetas(),
			'fecha' => $fecha
		);
		
		$this->load->view('default/header_simple', $data_header);
		$this->load->view('body/body_nuevo', $data_body);
		$this->load->view('default/footer_simple');
	}

	public function multar(){

		$fecha_creada=$this->input->post('fecha_devolucion');
		$fecha_limite=$this->input->post('fecha_limite');
		$etiqueta=$this->input->post('etiqueta');
		$tipo_personal=$this->input->post('tipo_persona');
		$multado=$this->input->post('identidicador');
		$monto=$this->input->post('monto');
		$no_inventario=$this->input->post('no_inventario');
		$tipo_material=$this->input->post('tipo_Material');
		$otro_material=$this->input->post('otro_tipo_Material');
		$descripcion=$this->input->post('descripcion');
		$nombre=$this->input->post('nombre');

		$formato=explode('/',$fecha_creada);
		$fecha_creada=$formato[2].'-'.$formato[1].'-'.$formato[0];		
		$res =$this->Multa_Model->multar('null',$fecha_creada,$fecha_limite,$etiqueta,
		$tipo_personal,$multado,$monto,$no_inventario,$tipo_material,$otro_material,$descripcion );

		if($res){
			$res=array('status'=>'success');
		}else{
			$res=array('status'=>'error');
		}
		echo json_encode($res);
		
	}

	function pdf(){
		$data_header = array('titulo' => 'Sistema de multas',
		'usuario' => 'Usuario'
		);	

		$list=$this->Multa_Model->get_litas_precios();			
		/*$data_body=array(
		'titulo_seccion'=>'Precios',
		'list'=>$list
		);*/
		$this->load->view('default/header_simple', $data_header);
		$this->load->view('body/body_pdf');
		$this->load->view('default/footer_simple');  
	}
}

/*

$this->session->set_userdata($arraydata);

**/

