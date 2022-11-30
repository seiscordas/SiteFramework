<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Produto extends CI_Controller {

	var $usuario = '';
	
	function __construct()
	{
		parent::__construct();
		$this->load->helper('klhelper');
		$this->load->model('produtomod','produto');
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
		
		$produtos = $this->produto->lista($status);
		$data['dados'] = $produtos;
		
		$data['nav'] = 'produto';
		$data['titulo_pag'] = 'Produtos';
		
		if($this->input->is_ajax_request())
		{			
			$this->load->view('produto_list_ajax_view', $data);
		}
		else
		{
			$this->load->view('header_view', $data);
			$this->load->view('produto_list_view', $data);
			$this->load->view('footer_view', $data);
		}
	}
	function form_add()
	{
		$data['iduser'] = $this->usuario->iduser;
		$this->load->view('produto_form_add_view', $data);
	}
	function add()
	{
		if($this->produto->add() == 'null')
			$dados = 0;
		else
		{
			$msg = "Dados inseridos com sucesso!";
			$dados = array("loadList" => 1,"resetForm" => '1', "msgBool" => 1, "msgTxt" => $msg);
		}
						
		echo json_encode($dados);
	}
	function form_up($id)
	{
		$data['row'] = $this->produto->get($id);
		$this->load->view('produto_form_up_view', $data);
	}
	function up()
	{
		$id = $this->input->post('idproduto');
		if($this->produto->up($id) == 'null')
			$dados = 0;
		else
		{
			$msg = "Dados alterados com sucesso!";
			$dados = array("loadList" => 1, "fechaModal" => 1,"msgBool" => 1, "msgTxt" => $msg);
		}
						
		echo json_encode($dados);
	}
	function busca()
	{
		$data['dados'] = $this->produto->busca($status);
		$this->load->view('produto_list_ajax_view',$data);
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
			$this->produto->ativa_desativa($id,$novoStatus);
			$msg = ($novoStatus == 'A')?"Ativado com Sucesso!":"Desativado com Sucesso!";
			$retorno = array("bool"=>"1","id"=>$id,"msg"=>$msg,"tab"=>1);
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
			$retorno = array("bool"=>"0","id"=>$id,"msg"=>$msg);
			echo json_encode($retorno);
		}
		else
		{
			if($this->produto->del($id) === true)
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