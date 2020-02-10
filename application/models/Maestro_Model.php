<?php

class Maestro_Model extends CI_Model{
    public function __construct(){
        $this->load->database();
    }
    /*
    * se utiliza para el select con los id de los alumnos
    */
    public function get_id(){
        $sql="SELECT id FROM docente";
        $resultados = $this->db->query($sql);
        return $resultados->result();
    }

    /**
     * Regresa el nombre del alumno dependiendo la matricula
     */
    public function get_name($id){
        $sql="SELECT nombre FROM viewnombremaestro  WHERE id='$id' ";
        $resultados = $this->db->query($sql);
        return $resultados->result();
    }

}
?>