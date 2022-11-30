<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Categoria extends CI_Controller {

	var $usuario = '';
	function __construct()
	{
		parent::__construct();
		$this->load->helper('klhelper');
		$this->load->model('categoriamod','categoria');
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
	function lista($status)
	{
		$data['status'] = $status;
		$data['statusTxt'] = ($status == 'A') ? 'Ativo' : 'Inativo';
		$data['goStatus'] = ($status == 'A') ? 'I' : 'A';
		$data['goStatusTxt'] = ($status == 'A') ? 'Inativo' : 'Ativo';
		
		$categorias = $this->categoria->lista($status);
		$data['dados'] = $categorias;
		
		$data['nav'] = 'categoria';
		$data['titulo_pag'] = 'Categorias';
		$data['styleSheet'] = NULL;//array('');
		$data['javaScript'] = NULL;//array('');
		
		if($this->input->is_ajax_request())
		{			
			$this->load->view('categoria_list_ajax_view', $data);
		}
		else
		{
			$this->load->view('header_view', $data);
			$this->load->view('categoria_list_view', $data);
			$this->load->view('footer_view', $data);
		}
	}
	function form_add()
	{
		$data['loadList'] = $this->input->get('loadlist');
		$this->load->view('categoria_form_add_view', $data);
	}
	function add()
	{
		$loadList = $this->input->get('loadlist');
		if($this->categoria->add() == 'null')
			$dados = 0;
		else
		{
			$msg = "Dados inseridos com sucesso!";
			$dados = array("loadList" => $loadList,"resetForm" => '1', "msgBool" => 1, "msgTxt" => $msg);
		}
						
		echo json_encode($dados);
	}
	function form_up($id)
	{
		$data['row'] = $this->categoria->get($id);
		$this->load->view('categoria_form_up_view', $data);
	}
	function up()
	{
		$id = $this->input->post('idcategoria');
		if($this->categoria->up($id) == 'null')
			$dados = 0;
		else
		{
			$msg = "Dados alterados com sucesso!";
			$dados = array("loadList" => 1, "fechaModal" => 1,"msgBool" => 1, "msgTxt" => $msg);
		}
						
		echo json_encode($dados);
	}
	function auto_complete()
	{
		$dados = $this->categoria->auto_complete('A');
		echo json_encode($dados);
	}
	function busca($status)
	{
		$data['dados'] = $this->categoria->busca($status);
		$this->load->view('categoria_list_ajax_view',$data);
	}
	function ativa_desativa($id,$novoStatus)
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
			$this->categoria->ativa_desativa($id,$novoStatus);
			$msg = ($novoStatus == 'A')?"Ativado com Sucesso!":"Desativado com Sucesso!";
			$retorno = array("bool"=>"1","id"=>$id,"msg"=>$msg);
			echo json_encode($retorno);
			return;
		}
	}
	function del($id)
	{
		if($this->usuario['fk_idperfil'] != 1)
		{
			//Se não tiver permissão, bloqueia a ação.
			$msg = "Você não tem permissão para concluir esta ação!";
			$retorno = array("bool"=>"0","id"=>$id,"msg"=>$msg,"tab"=>1);
			echo json_encode($retorno);
		}
		else
		{
			if($this->categoria->del($id) === true)
			{
				$msg ="Removido com Sucesso!";
				$retorno = array("bool"=>"1","id"=>$id,"msg"=>$msg,"tab"=>1);
				echo json_encode($retorno);
			}
			else
			{
				$msg ="Este registro não pode ser removido porque existem outros registro dependente!";
				$retorno = array("bool"=>"0","msg"=>$msg);
				echo json_encode($retorno);
			}
			return;
		}
	}
}

?>