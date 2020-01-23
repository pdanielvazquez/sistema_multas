<?php

class Estudiante_Model extends CI_Model{
    public function __construct(){
        $this->load->database();
    }
    /*
    * se utiliza para el select con las matriculas del alumno
    */
    public function get_select(){
        #prueba del select $sql="SELECT nombre from alumno";
        
        $sql="SELECT matricula FROM estudiante ";
        $resultados = $this->db->query($sql);
        return $resultados->result();
        
    }

}
?>