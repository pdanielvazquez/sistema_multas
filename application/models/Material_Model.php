<?php

class Material_Model extends CI_Model{
    public function __construct(){
        $this->load->database();
    }
    /*
    * se utiliza para saber el tipo de materiales|libro|revista|cd 
    */
    public function get_material(){
        $sql="SELECT * FROM `tipo_material` ORDER by id";
        $resultados = $this->db->query($sql);
        return $resultados->result();
    }

    
}
?>