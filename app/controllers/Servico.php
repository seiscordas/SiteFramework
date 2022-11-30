<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Servico extends CI_Controller {

	public function index()
	{
		$data['nav'] = 'servico';
		$data['titulo_pag'] = 'Serviço';
		$data['styleSheet'] = NULL;//array('');
		$data['javaScript'] = NULL;//array('');
		$this->load->view('header_view', $data);
		$this->load->view('servico_view', $data);
		$this->load->view('footer_view', $data);
	}
}
