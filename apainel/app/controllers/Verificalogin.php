<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class VerificaLogin extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('user','',TRUE);
		$this->load->helper('security');
		error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
		ob_start();
	}
	function index()
	{
		//Este metodo vai ter as credenciais de validação
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('usuario', 'Usuário', 'trim|required|xss_clean');
		$this->form_validation->set_rules('senha', 'Senha', 'trim|required|md5|callback_check_database|xss_clean');

		if($this->form_validation->run() == FALSE)
		{
			// Redireciona para página de login caso não esteja correto
			$this->load->view('login_view');
		}
		else
		{
			// Vai para área privada
			//redirect('home', 'refresh');
		}
	}
	function check_database($password)
	{ 
		$username = $this->input->post('usuario');
		
		// Consulta banco de dados
		$result = $this->user->login($username, $password);
		if($result->username)
		{
			foreach($result as $row)
			{
				$sess_array = array(
					'iduser' => $result->iduser,
					'nome' => $result->nome,
					'username' => $result->username,
					'email' => $result->email,
					'fk_idperfil' => $result->fk_idperfil,
					'fk_idstatus' => $result->fk_idstatus,
				);
				$this->session->set_userdata('logged_in', $sess_array);
			}
			return TRUE;
		}
		else
		{
			$this->form_validation->set_message('check_database', 'Usuário ou Senha incorreto!');
			return false;
		}
	}
}
?>
