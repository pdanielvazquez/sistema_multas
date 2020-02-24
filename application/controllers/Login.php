<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

  public function __construct(){
    parent::__construct();    
    $this->load->model('Login_Model');
  }

  public function index(){
    $this->load->view('login/ingresa');
  }
  public function verifica(){
    
    $usuario=$this->input->post('username');
    $pass =$this->input->post('password');
    if(strlen($usuario)>0&&strlen($pass)>0){
      $key="{UTPu3bla}";
      //$encriptada=$this->encrypt($pass,$key);      
      $contrasena=$this->Login_Model->get_password($usuario);      
      if (isset($contrasena[0]->pasw)) {
        $desEncriptada=$this->decrypt($contrasena[0]->pasw,$key);
        if ($desEncriptada===$pass) {
          if($contrasena[0]->fulldate){
            $usser=array(
              'usuario'=>array(
                'activo'=>true,
                'nombre'=>$contrasena[0]->nombres.' '.$contrasena[0]->apellidos,
                'id'=>$contrasena[0]->id
              )
            );
            $this->session->set_userdata($usser);
            redirect(base_url('multas'));
          }else{
            $usser=array(
              'usuario'=>array(
                'activo'=>true,
                'id'=>$contrasena[0]->id
              )
            );
            $this->session->set_userdata($usser);
            redirect(base_url('update'));
          }                    
        }else{
          $data=array('msg'=>'Contraseña invalidad');
          $this->load->view('login/ingresa',$data);
        }
      }else{
        $data=array('msg'=>'Usuario invalido');
        $this->load->view('login/ingresa',$data);
      }
      //$this->Login_Model->registraUsuario($usuario,$encriptada);
    }else{
      $data=array('msg'=>'Datos no validos');
      $this->load->view('login/ingresa',$data);
    }
  }
  public function UpdateUseer(){
    $data_header = array('titulo' => 'Sistema de multas',
							'usuario' => 'Usuario'
    );
		$this->load->view('default/header_simple', $data_header);
		$data_body=array(
			'titulo_seccion'=>'Actualiza información',
		);
		$this->load->view('body/body_usser',$data_body);
    $this->load->view('default/footer_simple'); 
    
  }
  public function Update(){    
    $nombre= $this->input->post('nombres');
    $apellidos= $this->input->post('apellidos');
    $alias =$this->input->post('username');
    $pasw= $this->input->post('password');
    $id=$this->session->userdata('usuario')['id'];
    if(strlen($nombre)>4&&strlen($apellidos)>4&&strlen($alias)>4&&strlen($pasw)>4){
      //echo $nombre;
      $key="{UTPu3bla}";
      $pasw=$this->encrypt($pasw,$key);
      $this->Login_Model->actualiza($id,$nombre,$apellidos,$alias,$pasw);
      //actualizamos la session 
      $datos=$this->Login_Model->get_password($id);      
      $usser=array(
        'usuario'=>array(
          'activo'=>true,
          'nombre'=>$datos[0]->nombres.' '.$datos[0]->apellidos,
          'id'=>$datos[0]->id
        )
      );
      $this->session->set_userdata($usser);
    }else{
      echo "NA";
    }
    /*var_dump($nombre);
    echo $id;*/

  }  
  public function encrypt($data,$key){
    $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('aes-256-cbc'));
    $encrypted=openssl_encrypt($data, "aes-256-cbc", $key, 0, $iv);
    // return the encrypted string with $iv joined 
    return base64_encode($encrypted."::".$iv);
  }

  public function decrypt($data,$key){
    list($encrypted_data, $iv) = explode('::', base64_decode($data), 2);
    return openssl_decrypt($encrypted_data, 'aes-256-cbc', $key, 0, $iv);
  }


}
