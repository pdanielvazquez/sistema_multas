<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Alumno extends CI_Controller {

    public function __construct(){
		parent::__construct();
		$this->load->model("Estudiante_Model");
    }
    
	public function get_name(){
        //recogemos la matricula
        $matricula=$this->input->post('matricula');
        //consulta 
        $datos= $this->Estudiante_Model->get_name($matricula);
        $name='';
        foreach ($datos as $key => $item) {
            $name=$item->nombre;
        }
        //respuesta
        $arreglo=array(array(
            "estados"=>"success",
            "nombre"=>$name
        ));
        echo json_encode($arreglo);
    }
}
