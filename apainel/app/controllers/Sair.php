<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sair extends CI_Controller {
	function index()
	{
		$this->session->unset_userdata('logged_in');
		session_destroy();
		redirect('', 'refresh');
	}
}
?>