 
<?php

class Etiquetas_Model extends CI_Model{
    public function __construct(){
        $this->load->database();
    }
    /*
    * se utiliza para el listado de las etiquetas
    */
    public function get_etiquetas(){
        $sql="SELECT * FROM etiqueta";
        $resultados = $this->db->query($sql);
        return $resultados->result();
    }   
}
?>