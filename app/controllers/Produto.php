<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Produto extends CI_Controller {

	public function index()
	{
		$data['nav'] = 'produto';
		$data['titulo_pag'] = 'Produto';
		$data['styleSheet'] = NULL;//array('');
		$data['javaScript'] = NULL;//array('');
		$this->load->view('header_view', $data);
		$this->load->view('produto_view', $data);
		$this->load->view('footer_view', $data);
	}
}
