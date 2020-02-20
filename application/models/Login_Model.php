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

    /**
     * actualizar informacion
    */
    public function adtualiza(){
        # code...
    }
}
