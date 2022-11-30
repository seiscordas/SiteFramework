<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Depoimento extends CI_Controller {

	var $usuario = '';
	
	function __construct()
	{
		parent::__construct();
		$this->load->helper('klhelper');
		$this->load->model('depoimentomod','depoimento');
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
		
		$depoimentos = $this->depoimento->lista($status);
		$data['dados'] = $depoimentos;
		
		$data['nav'] = 'depoimento';
		$data['titulo_pag'] = 'Depoimentos';
		
		if($this->input->is_ajax_request())
		{			
			$this->load->view('depoimento_list_ajax_view', $data);
		}
		else
		{
			$this->load->view('header_view', $data);
			$this->load->view('depoimento_list_view', $data);
			$this->load->view('footer_view', $data);
		}
	}
	function form_add()
	{
		$data['iduser'] = $this->usuario->iduser;
		$this->load->view('depoimento_form_add_view', $data);
	}
	function add()
	{
		if($this->depoimento->add() == 'null')
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
		$data['row'] = $this->depoimento->get($id);
		$this->load->view('depoimento_form_up_view', $data);
	}
	function up()
	{
		$id = $this->input->post('iddepoimento');
		if($this->depoimento->up($id) == 'null')
			$dados = 0;
		else
		{
			$msg = "Dados alterados com sucesso!";
			$dados = array("loadList" => 1, "fechaModal" => 1,"msgBool" => 1, "msgTxt" => $msg);
		}
						
		echo json_encode($dados);
	}
	function add_up_gal()
	{
		if($this->depoimento->add_up_gal() == 'null')
			$dados = 0;
		else
		{
			$msg = "Dados inseridos com sucesso!";
			$dados = array("fechaModal" => '1', "msgBool" => 1, "msgTxt" => $msg);
		}
						
		echo json_encode($dados);
	}
	function busca()
	{
		$data['dados'] = $this->depoimento->busca($status);
		$this->load->view('depoimento_list_ajax_view',$data);
	}
	function ativa_desativa($id,$novoStatus)
	{
		if($this->usuario['fk_idperfil'] != 1)
		{
			//Se não tiver permissão, bloqueia a ação.
			$msg = "Você não tem permissão para concluir esta ação!";
			$retorno = array("bool"=>"0","id"=>$id,"msg"=>$msg);
			echo json_encode($retorno);
			return;
		}
		else
		{
			$this->depoimento->ativa_desativa($id,$novoStatus);
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
			return;
		}
		else
		{
			if($this->depoimento->del($id) === true)
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