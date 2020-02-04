<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Multas extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model("Estudiante_Model");
		$this->load->model("Multa_Model");
	}
	/*public function index(){
		$this->load->view('welcome_message');
	}*/
	public function index()
	{
		$data_header = array(
			'titulo' => 'Sistema de multas',
			'usuario' => 'Usuario'
		);
		$data_body = array(
			'titulo_seccion' => 'El título'
		);
		//$this->load->view('blank', $data);
		$this->load->view('default/header_simple', $data_header);
		$this->load->view('body_simple', $data_body);
		$this->load->view('default/footer_simple');
	}

	public function get_precio_multa()
	{
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

	public function nueva()
	{
		$data_header = array(
			'titulo' => 'Sistema de multas',
			'usuario' => 'Usuario'
		);
		$fecha = date("d") . "/" . date("m") . "/" . date("Y");
		$data_body = array(
			'titulo_seccion' => 'Nueva multa',
			'lista' => $this->Estudiante_Model->get_select(),
			'fecha' => $fecha
		);
		$this->load->view('default/header_simple', $data_header);
		$this->load->view('body/body_nuevo', $data_body);
		$this->load->view('default/footer_simple');
	}


	function GeneraPDF()
	{
		// Cargamos la librería
		$this->load->library('pdfgenerator');
		// definamos un nombre para el archivo. No es necesario agregar la extension .pdf
		$filename = 'comprobante_pago';
		$viewdata=array();

		$html = $this->load->view('formato/pdf', $viewdata, TRUE);
		// generamos el PDF. Pasemos por encima de la configuración general y definamos otro tipo de papel
		$this->pdfgenerator->generate($html, $filename, true, 'Letter', 'portrait');
		echo json_encode(array('status'=>'success'));
	}
}
