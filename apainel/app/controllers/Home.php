<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->helper('klhelper');
		$this->load->model('homemod','home');
		error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
		ob_start();
		if($this->session->userdata('logged_in'))
		{
			$session_data = $this->session->userdata('logged_in');
			$data['username'] = $session_data['username'];
			var_dump($this->session->userdata('logged_in'));
		}
		else
		{
			//If no session, redirect to login page
			//var_dump($this->session->userdata());die;
			redirect('', 'refresh');
		}
	}
	public function index()
	{
		$data['nav'] = 'home';
		$data['titulo_pag'] = 'Home';
		$data['styleSheet'] = NULL;//array('');
		$data['javaScript'] = NULL;//array('');
		$this->load->view('header_view', $data);
		$this->load->view('home_view', $data);
		$this->load->view('footer_view', $data);
	}
}
