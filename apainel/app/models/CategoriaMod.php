<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class CategoriaMod extends CI_Model {
	
	//pega dados de usuarios
	function lista($status)
	{
		$this->db->join('img','img.idimg = categoria.fk_idimg');
		$this->db->order_by('idcategoria','desc');
		$this->db->where('fk_idstatus',$status);
		return $this->db->get('categoria')->result();
	}
	function add()
	{
		$dadosCategoria = array(
			'nomeCat' => $this->input->post('nomeCat'),
			'descCat' => $this->input->post('descCat'),
			'dtCadastro' => date("Y-m-d"),
			'fk_iduser' => $this->input->post('fk_users_id'),
			'fk_idstatus' => $this->input->post('fk_idstatus'),
			'fk_idimg' => $this->input->post('fk_idimg'),
			);
		$this->db->insert('categoria',$dadosCategoria);
	}
	function get($id)
	{
		$this->db->join('img','img.idimg = categoria.fk_idimg','left');
		$this->db->where('idcategoria',$id);
		return $this->db->get('categoria')->row();
	}
	function up($id)
	{		
		$dadosCategoria = array(
			'nomeCat' => $this->input->post('nomeCat'),
			'descCat' => $this->input->post('descCat'),
			'fk_iduser' => $this->input->post('fk_users_id'),
			'fk_idstatus' => $this->input->post('fk_idstatus'),
			'fk_idimg' => $this->input->post('fk_idimg'),
			);
		$where = array('idcategoria' => $id);
		$this->db->update('categoria',$dadosCategoria,$where);
	}
	function auto_complete($status)
	{
		$this->db->where('categoria.fk_idstatus',$status);
		$termo = $this->input->post('termo');
		$this->db->select('idcategoria, nomeCat');
		$this->db->like('categoria.nomeCat',$termo);
		$dados = $this->db->get('categoria')->result();
		return $dados;
	}
	function busca()
	{
		$status = $this->input->post('status');
		$termo = $this->input->post('termo');
		$this->db->like('nomeCat',$termo);
		$this->db->join('img','img.idimg = categoria.fk_idimg','left');
		$this->db->where('fk_idstatus', $status);
		$this->db->order_by('idcategoria', 'desc');
		return $this->db->get('categoria')->result();
	}
	function ativa_desativa($id,$novoStatus)
	{
		$dados = array('fk_idstatus' => $novoStatus);
		$this->db->update('categoria', $dados, array('idcategoria' => $id));
	}
	function del($id)
	{
		if($this->db->delete('categoria',array('idcategoria'=>$id)) == FALSE)
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