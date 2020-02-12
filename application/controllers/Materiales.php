<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Materiales extends CI_Controller {

	public function __construct(){
		parent::__construct();				
    }
    /**
     * funcion que sirve para ir llenando array de session de los material a multar
     * y regresa yn json con los materiales
     * {
     *  "noInventario":"xxxx",
     *  "tipo":"xxxx",
     *  "otro":"xxxx",
     *  "descripcion":"xxxx"
     * }
    */
	public function addMateriales(){
        $no_inventario=$this->input->post('');
        $tipoMaterial=$this->input->post('');
        $otro_Material=$this->input->post('');
        $descripcion=$this->input->post('');
	}
}