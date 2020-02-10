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
                on id_personal=tipo_personal
                WHERE nombre='$personal' and activo=true";

        $resultados = $this->db->query($sql);
        return $resultados->result();
    }
    /**
     * funcion que regresa listado de todos los precio para la multa
     */
    public function get_litas_precios(){
        $sql="SELECT id,years,activo,precio,nombre
                 FROM preciosmulta INNER JOIN personal 
                 on tipo_personal= id_personal";
        $resultados = $this->db->query($sql);
        return $resultados->result();
    }

    /**
     * funcion que actualiza el estado del precio 
     */
    public function update_stado_precio($id,$tipoPersona){
        //falta buscar el id activo dependiendo del tipo de persona y cambiarlo a false
        $sql ="UPDATE  preciosmulta set activo=true where id =$id";
    }

    /**
     * funcion que inserta un nuevo precio de la multa
    */
    function Insert_multa($year,$precio,$persona){
        if($persona=='alumno'){
            $persona='1';
        }else{
            $persona='2';
        }
        $data = array(
            'precio'=>$precio,
            'tipo_personal'=>$persona,
            'years'=>$year,
            'id'=>'null',
            'activo'=>'0'
        );
        $this->db->insert('preciosmulta',$data);
        return ($this->db->affected_rows() != 1) ? false : true;                              
    }
}
?>