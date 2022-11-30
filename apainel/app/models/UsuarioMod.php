<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class UsuarioMod extends CI_Model {
	
	//pega dados de usuarios
	function lista($status)
	{
		$this->db->order_by('iduser','desc');
		$this->db->where('fk_idstatus',$status);
		$this->db->join('perfil','perfil.idperfil = user.fk_idperfil');
		$this->db->join('status','status.idstatus = user.fk_idstatus');
		return $this->db->get('user')->result();
	}
	function usuario($id)
	{
		$this->db->join('perfil','perfil.idperfil = user.fk_idperfil');
		$this->db->join('status','status.idstatus = user.fk_idstatus');
		$this->db->where('iduser', $id);
		return $this->db->get('user')->result();
	}
	function get($id)
	{
		$this->db->join('perfil','perfil.idperfil = user.fk_idperfil');
		$this->db->join('status','status.idstatus = user.fk_idstatus');
		$this->db->where(array('iduser'=>$id));
		return $this->db->get('user')->row();
	}
	function add()
	{
		//criptografa a senha
		$senha = md5($this->input->post('password'));	
		$dados = array(
			'nome' => $this->input->post('nome'),
			'email' => $this->input->post('email'),
			'username' => $this->input->post('username'),
			'password' => $senha,
			'dtCadastro' => $this->input->post('dtCadastro'),
			'fk_idperfil' => $this->input->post('fk_idperfil'),
			'fk_idstatus' => $this->input->post('fk_idstatus'),
			);
		//insere os dados em usuario
		$this->db->insert('user',$dados);
	}
	function up($id)
	{
		$dados = array(
			'nome' => $this->input->post('nome'),
			'fk_idperfil' => $this->input->post('fk_idperfil'),
			'email' => $this->input->post('email'),
			'fk_idstatus' => $this->input->post('fk_idstatus'),
			);
		//trata a senha
		$senha = $this->input->post('password');
		if($senha)
		{
			$senha = array('password'=>md5($senha));
			$this->db->update('user', $senha, array('iduser'=>$id));
		}
		$this->db->update('user', $dados, array('iduser'=>$id));
	}
	function ativa_desativa($id,$novoStatus)
	{
		$dados = array('fk_idstatus' => $novoStatus);
		$this->db->update('user', $dados, array('iduser' => $id));
	}
	function del($id)
	{
		$this->db->db_debug = FALSE;
		$this->db->delete('user',array('iduser'=>$id));
		if($this->db->_error_message())
		{
			return false;
		}
		else
		{
			return true;
		}
	}
}
/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */