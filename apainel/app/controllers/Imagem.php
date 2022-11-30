<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Imagem extends CI_Controller {

	var $usuario = '';
	
	function __construct()
	{
		parent::__construct();
		$this->load->helper('klhelper');
		$this->load->model('imagemmod','imagem');
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
	function lista()
	{
		$data['dest_img'] = $this->input->get('dest_img');
		$data['usar_img'] = $this->input->get('usar_img');
		$imagems = $this->imagem->lista();
		$data['dados'] = $imagems;
		$this->load->view('imagem_view', $data);
	}
	function img_lista()
	{
		$data['dest_img'] = $this->input->get('dest_img');
		$data['usar_img'] = $this->input->get('usar_img');
		$imagems = $this->imagem->lista();
		$data['dados'] = $imagems;
		$this->load->view('imagem_lista_view', $data);
	}
	function img_gal_lista($id)
	{
		$data['id'] = $id;
		$data['gal'] = TRUE;
		$data['usar_img'] = 'n';
		$imagems = $this->imagem->img_gal_lista($id);
		$data['dados'] = $imagems;
		$this->load->view('imagem_view', $data);
	}
	function img_gal_lista_ajax($id)
	{
		$imagems = $this->imagem->img_gal_lista($id);
		$data['dados'] = $imagems;
		$data['usar_img'] = 'n';
		$this->load->view('imagem_lista_view', $data);
	}
	function up_img_gal()
	{
		$id = $this->input->post('idgaleria');
		$retorno = $this->imagem->add_img_gal($id);
		if($retorno === true)
			$dados = 1;
		else
			$dados = 0;
						
		echo json_encode($dados);
	}
	function form_add($status)
	{
		$data['status'] = $status;
		$this->template->load('template_view','imagem_form_add_view', $data);
	}
	function up_img($status)
	{
		$retorno = $this->imagem->up_img();
		if($retorno['up'] === false)
		{
			echo $retorno['msg'];
		}
		else
		{
			echo $retorno;
		}
	}
	function add_img($status)
	{
		$retorno = $this->imagem->add();
		if($retorno['add'] === false)
		{
			echo $retorno['msg'];
		}
		else
		{
			echo json_encode($retorno);
		}
	}
	function del($id)
	{
		if($this->usuario['fk_idperfil'] != 1)
		{
			//Se não tiver permissão, bloqueia a ação.
			$msg = "Você não tem permissão para concluir esta ação!";
			$retorno = array("bool"=>"0","id"=>$id,"msg"=>$msg);
			echo json_encode($retorno);
		}
		else
		{
			if($this->imagem->del($id) === true)
			{
				$msg = 'Apagando...';
				$retorno = array("bool"=>"1","id"=>$id,"msg"=>$msg);
				echo json_encode($retorno);
			}
			else
			{
				$msg ="Este registro não pode ser removido porque existem outro registro relacionado!";
				$retorno = array("bool"=>"0","msg"=>$msg);
				echo json_encode($retorno);
			}
			return;
		}
	}
}

?>