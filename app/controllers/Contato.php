<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contato extends CI_Controller {

	public function index()
	{
		$data['nav'] = 'contato';
		$data['titulo_pag'] = 'Contato';
		$data['styleSheet'] = NULL;//array('');
		$data['javaScript'] = NULL;//array('');
		$this->load->view('header_view', $data);
		$this->load->view('contato_view', $data);
		$this->load->view('footer_view', $data);
	}
}
