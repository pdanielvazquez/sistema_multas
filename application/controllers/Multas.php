<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Multas extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

	public function __construct(){
		parent::__construct();
		
		//$this->load->helper('url'); * lo cargué en autoload.php
	}

	public function index()
	{
		$this->load->view('welcome_message');
	}

	public function blank(){
		$data_header = array('titulo' => 'Sistema de multas',
							'usuario' => 'Usuario'
						);
		$data_body = array('titulo_seccion' => 'El título'

						);
		//$this->load->view('blank', $data);
		$this->load->view('header_simple', $data_header);
		$this->load->view('body_simple', $data_body);
		$this->load->view('footer_simple');
	}

	public function nueva(){
		$data_header = array('titulo' => 'Sistema de multas',
							'usuario' => 'Usuario'
						);
		$data_body = array('titulo_seccion' => 'Nueva multa'

						);
		$this->load->view('header_simple', $data_header);
		$this->load->view('body_nuevo', $data_body);
		$this->load->view('footer_simple');
	}
}
