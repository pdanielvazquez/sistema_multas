<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Maestro extends CI_Controller {

    public function __construct(){
		parent::__construct();
		$this->load->model("Maestro_Model");
    }
    
	public function get_name(){
        //recogemos el id del maestro
        $id=$this->input->post('id');
        //consulta 
        $datos= $this->Maestro_Model->get_name($id);
        $name='';
        foreach ($datos as $key => $item) {
            $name=$item->nombre;
        }
        //respuesta
        $arreglo=array(
            "estados"=>"success",
            "nombre"=>$name
        );
        echo json_encode($arreglo);
    }
}
