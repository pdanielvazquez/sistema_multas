<?php

class Login_Model extends CI_Model{
    public function __construct(){
        $this->load->database();
    }

    /**
     * registrar nuevo user
    */
    public function registraUsuario($name,$passw){
        $data = array(
            'username'=>$name,
            'foto'=>'NA',
            'pasw'=>$passw
        );
        $this->db->insert('usuarios',$data);
        return ($this->db->affected_rows() != 1) ? false : true;                              
    }

    public function get_password($usuario){
        $sql="SELECT * FROM `usuarios` WHERE username='$usuario'";
        $resultados = $this->db->query($sql);
        return $resultados->result();
    }
    /**
     * actualizar informacion
    */
    public function actualiza($id,$names,$apellidos,$alias,$pasword){
       $data = [
            'username' => $alias,
            'pasw'=>$pasword,
            'nombres'=>$names,
            'apellidos'=>$apellidos,
            'fulldate'=>'1'
        ];
        $this->db->where('id',$id);
        $this->db->update('usuarios', $data);        
    }
}
