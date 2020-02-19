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
		$montoTexto=$this->input->post('montoText');
		$material1=$this->input->post('material1');
		$material2=$this->input->post('material2');
		$nombre=$this->input->post('nombre');
		$diasAtrasados=$this->input->post('diasAtrasados');

		$formato=explode('/',$fecha_creada);
		$fecha_creada=$formato[2].'-'.$formato[1].'-'.$formato[0];

		#formatos de fecha para la vista
		$View_fecha_creada=$this->FechaDormato($fecha_creada);
		$View_fecha_limite=$this->FechaDormato($fecha_limite);

		$folio=$this->Multa_Model->multar('null',$fecha_creada,$fecha_limite,$etiqueta,$tipo_personal,$multado,$monto,$material1,$material2);

		//$this->Multa_model->agregaMateriales($folio,'numInventario','Material','otro','descripcion');
		$separa1=explode(',',$material1);
		$separa2=explode(',',$material2);

		$this->Multa_Model->asigna_Material($folio,$separa1[0],$separa1[1],$separa1[2],$separa1[3]);
		if($separa2[0]!=''&&$separa2[1]!=''){
			$this->Multa_Model->asigna_Material($folio,$separa2[0],$separa2[1],$separa2[2],$separa2[3]);
		}		

		#Damos Formatos a las fechas
		$fecha_creadaView=$this->FormatoFecha($fecha_creada);
		$fecha_limiteView=$this->FormatoFecha($fecha_limite);
		#damos formato al tipo Tipo personal
		($tipo_personal=='alumno')?$tipo_personal='Alumno':$tipo_personal='Docente o Administrativo';

		#FormatoMaterial
		$material1=$this->FormatoMaterial($material1);
		$material2=$this->FormatoMaterial($material2);
		
		$multa=array(
			'datos'=>array(	
				'folio'=>$folio,	
				'fecha_creada'=>$fecha_creadaView,
				'fecha_limite'=>$fecha_limiteView,
				'etiqueta'=>$etiqueta,
				'Tipo_personal'=>$tipo_personal,
				'multado'=>$multado,
				'monto'=>$monto,
				'montoText'=>$montoTexto,
				'dias_arasados'=>$diasAtrasados,
				'nombre'=>$nombre,
				'material1'=>$material1,
				'material2'=>$material2,
				'ruta'=>base_url('/multas/pdf')
			)
		);
		$this->session->set_userdata($multa);
		//echo json_encode($multa);		
	}

	public function pdf(){
		$data_header = array('titulo' => 'Sistema de multas',
		'usuario' => 'Usuario'
		);			
		//echo json_encode($this->session->userdata('datos'));
		$data_multa=$this->session->userdata('datos');
		$this->load->view('default/head_pdf', $data_header);
		$this->load->view('body/body_pdf',$data_multa);
	}
	public function FormatoFecha($fecha){
		$NewFecha=explode('-',$fecha);
		return $NewFecha[2].'/'.$NewFecha[1].'/'.$NewFecha[0];
	}
	public function FormatoMaterial($cadena){
		$separa=explode(',',$cadena);
		$numero=0;
		$string='';
		foreach ($separa as $key => $value) {
			if($value!=''){
				$numero++;
				switch ($numero) {
					case 1:
						$string.="No. de inventario: $value ";
						break;
					case 2:
						$string.="Tipo de material: ".$this->NombreTipo($value);
						break;
					case 3:
						$string.=" Otro material: $value";
						break;
					case 4:
						$string.=" descripcion: $value";
						break;
				}	
			}					
		}
		return $string;
	}

	public function NombreTipo($tipo_material){
		if ($tipo_material == 1) return "REVISTA";
    	if ($tipo_material == 2) return "LIBRO";
    	if ($tipo_material == 3) return "CD";
   	 	if ($tipo_material == 4) return "OTRO";
	}
	/***
	 * Da formato de la fecha para la vista
	 */
	public function FechaDormato($fecha){
		$separa=explode('-',$fecha);
		$newFecha=$separa[2].'/'.$separa[1].'/'.$separa[0];
		return $newFecha;
	}
}

