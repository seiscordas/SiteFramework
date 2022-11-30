<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class ComparaReg extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
		ob_start();
		if($this->session->userdata('logged_in'))
		{
			$this->usuario = $this->session->userdata('logged_in');
		}
		else
		{
			//If no session, redirect to login page
			redirect('', 'refresh');
		}
	}
	function verifica($tabela)
	{
		$this->load->helper('klhelper');
				
		//Verifica se um dado já está cadastrado
		if(verifica_registro($tabela) === TRUE)
			echo json_encode(1);
		return ;
	}
}

?>