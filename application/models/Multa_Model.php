<?php
class Multa_Model extends CI_Model{
    public function __construct(){
        $this->load->database();
    }
    /*
    * funcion que obtiene el precio dependiendo el tipo de personal estudiante o maestro
    */
    public function get_precio($personal){
        $sql="  SELECT precio 
                FROM preciosmulta INNER JOIN personal  
                on id_presonal=tipo_personal
                WHERE nombre='$personal' and activo=true";

        $resultados = $this->db->query($sql);
        return $resultados->result();
    }
}
?>