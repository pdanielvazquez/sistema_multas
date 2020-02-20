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
      $key="Luis Enrique Gonzalez";
      $encriptada=$this->encrypt($pass,$key);
      echo 'Clave encriptada: '.$encriptada;

      $desEncriptada=$this->decrypt($encriptada,$key);
      echo 'Clave no encriptada: '.$desEncriptada;

      $this->Login_Model->registraUsuario($usuario,$encriptada);

     /*echo "cadena encriptada $encrypted_string";
      $encrypted_string = $this->encrypt->decode($pass);
      echo "cadena no encriptada encrypted_string";*/

    }else{
      $data=array('msg'=>'Datos no validos');
      $this->load->view('login/ingresa',$data);
    }
    
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
