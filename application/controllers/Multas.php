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
		if($this->session->userdata('usuario')['activo']){
			$data_header = array('titulo' => 'Sistema de multas',
								'usuario' => 'Usuario'
							);
			$data_body = array('titulo_seccion' => 'El título'
							);
			//$this->load->view('blank', $data);
			$this->load->view('default/header_simple', $data_header);
			$this->load->view('body_simple', $data_body);
			$this->load->view('default/footer_simple');	
		}else{
			$ruta=base_url();
			header("Location: $ruta");
		}
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
		if($this->session->userdata('usuario')['activo']){
			$usuarioName='';
			if(isset($this->session->userdata('usuario')['id'])){
				$usuarioName=$this->session->userdata('usuario')['nombre'];
			}
			$data_header = array('titulo' => 'Sistema de multas',
								'usuario' => $usuarioName
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
		}else{
			$ruta=base_url();
    		header("Location: $ruta");
		}
	}

	public function existente(){
		if($this->session->userdata('usuario')['activo']){
			$usuarioName='';
			if(isset($this->session->userdata('usuario')['id'])){
				$usuarioName=$this->session->userdata('usuario')['nombre'];
			}
			$fecha = date("d") . "/" . date("m") . "/" . date("Y");
			$data_body = array(
				'titulo_seccion' => 'Multa Registrada',
				'lista' => $this->Estudiante_Model->get_select(),
				'lista_id'=>$this->Maestro_Model->get_id(),
				'materiales'=>$this->Material_Model->get_material(),
				'etiquetas'=>$this->Etiquetas_Model->get_etiquetas(),
				'fecha' => $fecha
			);
			
			$data_header = array('titulo' => 'Sistema de multas',
								'usuario' => $usuarioName
							);
			$this->load->view('default/header_simple', $data_header);
			
			$this->load->view('body/body_multa_existente',$data_body);
			$this->load->view('default/footer_simple');
		}else{
			$ruta=base_url();
			header("Location: $ruta");
		}
	}

	public function find_Multa(){
		$folio=$this->input->post('folio');
		$datos=$this->Multa_Model->get_multa($folio);
		$res=array(
			'folio'=>$folio,
			'datos'=>$datos
		);
		echo json_encode($res);	
				
	}
	public function find_articulo(){
		$folio=$this->input->post('folio');
		$datos=$this->Multa_Model->get_material_multa($folio);
		$res=array(
			'articulos'=>$datos
		);
		echo json_encode($res);
		
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
		echo json_encode($multa);		
	}

	public function pdf(){
		if($this->session->userdata('usuario')['activo']){

			$data_header = array('titulo' => 'Sistema de multas',
			'usuario' => 'Usuario'
			);					
			$data_multa=$this->session->userdata('datos');
			$this->load->view('default/head_pdf', $data_header);
			$this->load->view('body/body_pdf',$data_multa);
		}else{
			/////////////
		}
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
	
	public function renueva(){
		#recogiendo datos
		$fecha_creada=$this->input->post('fecha_creada');
		$fecha_limite=$this->input->post('fecha_limite');		
		$etiqueta=$this->input->post('etiqueta');
		$tipo_personal=$this->input->post('Tipo_personal');
		$multado=$this->input->post('multado');
		$monto=$this->input->post('monto');
		$montoTexto=$this->input->post('montoText');
		$material1=$this->input->post('material1');
		$material2=$this->input->post('material2');
		$nombre=$this->input->post('nombre');
		$diasAtrasados=$this->input->post('dias_atrasados');
		$folio=$this->input->post('folio');
		$fecha=$this->input->post('fecha');
		$monto=$this->input->post('monto');
		#formato de fecha para insertar
		$separaFecha=explode('/',$fecha);
		$fecha=$separaFecha[2].'-'.$separaFecha[1].'-'.$separaFecha[0];
		
		$res=$this->Multa_Model->renueva_Multa($folio,$fecha,$monto);
		$separaFecha=explode('-',$fecha_limite);
		$fecha_limite=$separaFecha[2].'/'.$separaFecha[1].'/'.$separaFecha[0];
		if($res){			
			$multa=array(
				'status'=>'success',
				'msg'=>'Operacion satisfecha',
				'datos'=>array(	
					'folio'=>$folio,	
					'fecha_creada'=>$fecha_creada,
					'fecha_limite'=>$fecha_limite,
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
			echo json_encode($multa);			
		}else{
			$res=array(
				'status'=>'error',	
				'msg'=>'Error en operacion',				
			);
			echo json_encode($res);
		}
	}
}

