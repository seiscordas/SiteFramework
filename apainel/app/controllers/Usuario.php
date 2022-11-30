<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Usuario extends CI_Controller {
	var $usuario = '';
	function __construct()
	{
		parent::__construct();
		$this->load->helper('klhelper');
		$this->load->model('usuariomod');
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
	////////////////////////////// Usuário ////////////////////////////////
	function lista($status,$pg = 1)
	{
		//pega valores do banco de dados
		//verifica usuario
		if($this->usuario['fk_idperfil'] != 1)
		{
			$dados = $this->usuariomod->usuario($this->usuario['iduser']);
		}
		else
		{
			$dados = $this->usuariomod->lista($status);
		}
		
		$data['curStatus'] = $status;
		$data['goStatus']  = ($status == 'A') ? 'I' : 'A';
		
		$data['dados'] = $dados;
		
		$data['nav'] = 'usuario';
		$data['titulo_pag'] = 'Usuários';
		$data['styleSheet'] = NULL;//array('');
		$data['javaScript'] = NULL;//array('');
		$this->load->view('header_view', $data);
		$this->load->view('usuario_list_view', $data);
		$this->load->view('footer_view', $data);
	}
	function form_add($status)
	{
		if($this->usuario['fk_idperfil'] != 1)
		{
			//Se não tiver permissão, bloqueia a ação.
			$this->load->view('header_view', $data);
			$mensagem = 'Você não tem permissão para concluir esta ação!';
			echo '<script type="text/javascript">alert("'. $mensagem .'")</script>';
			echo '<script type="text/javascript">history.back()</script>';
			die;
		}
		$data['id'] = novo_id('user','iduser');
		$data['status'] = $status;
		
		$data['nav'] = 'usuario';
		$data['titulo_pag'] = 'Adicionar Usuário';
		$data['styleSheet'] = NULL;//array('');
		$data['javaScript'] = NULL;//array('');
		$this->load->view('header_view', $data);
		$this->load->view('usuario_form_add_view', $data);
		$this->load->view('footer_view', $data);
	}
	function add($status)
	{
		$this->usuariomod->add();
		redirect(base_url('usuario/lista/'.$status));
	}
	function form_up($id,$status)
	{
		if($this->usuario['fk_idperfil'] != 1 && $this->usuario['id'] != $id)
		{
			$this->load->view('header_view', $data);
			//Se não tiver permissão, bloqueia a ação.
			$mensagem = 'Você não tem permissão para concluir esta ação!';
			echo '<script type="text/javascript">alert("'. $mensagem .'")</script>';
			echo '<script type="text/javascript">history.back()</script>';
			die;
		}
		$data['status'] = $status;
		$data['row'] = $this->usuariomod->get($id);
		
		$data['nav'] = 'usuario';
		$data['titulo_pag'] = 'Ver / Alterar Usuário';
		$data['styleSheet'] = NULL;//array('');
		$data['javaScript'] = NULL;//array('');
		$this->load->view('header_view', $data);
		$this->load->view('usuario_form_up_view', $data);
		$this->load->view('footer_view', $data);
	}
	function up($status)
	{
		$id = $this->input->post('iduser');
		$this->usuariomod->up($id);
		redirect(base_url('usuario/lista/'.$status));
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
			$this->usuariomod->ativa_desativa($id,$novoStatus);
			$msg = ($novoStatus == 'A')?"Ativado com Sucesso!":"Desativado com Sucesso!";
			$retorno = array("bool"=>"1","id"=>$id,"msg"=>$msg,"tab"=>1);
			echo json_encode($retorno);
			return;
		}
	}
	function verifica_registro($tabela)
	{
		//Verifica se um dado já está cadastrado
		if($this->klhelper->verifica_registro($tabela) === TRUE)
			echo json_encode(1);
		return ;
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
			if($this->usuariomod->del($id) === true)
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