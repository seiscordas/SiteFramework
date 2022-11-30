<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sobre extends CI_Controller {

	public function index()
	{
		$data['nav'] = 'sobre';
		$data['titulo_pag'] = 'Sobre';
		$data['styleSheet'] = NULL;//array('');
		$data['javaScript'] = NULL;//array('');
		$this->load->view('header_view', $data);
		$this->load->view('sobre_view', $data);
		$this->load->view('footer_view', $data);
	}
}
