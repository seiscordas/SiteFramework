<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

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
