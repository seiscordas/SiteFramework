<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class produtoMod extends CI_Model {
	
	function lista($status)
	{
		$this->db->select('
			produto.*,
			img.idimg,
			img.nomeImg,
			categoria.idcategoria,
			categoria.nomeCat
			');
		$this->db->order_by('idproduto','desc');
		$this->db->where('produto.fk_idstatus',$status);
		$this->db->join('status','status.idstatus = produto.fk_idstatus');
		$this->db->join('img','img.idimg = produto.fk_idimg');
		$this->db->join('categoria','categoria.idcategoria = produto.fk_idcategoria');
		return $this->db->get('produto')->result();
	}
	function add()
	{
		$dados = array(
			'nomeProd' => $this->input->post('nomeProd'),
			'descProd' => $this->input->post('descProd'),
			'dtCadastro' => date("Y-m-d"),
			'fk_iduser' => $this->input->post('fk_iduser'),
			'fk_idstatus' => $this->input->post('fk_idstatus'),
			'fk_idcategoria' => $this->input->post('fk_idcategoria'),
			'fk_idimg' => $this->input->post('fk_idimg'),
			'destaque' => $this->input->post('destaque'),
			);
		$this->db->insert('produto',$dados);
	}
	function get($id)
	{
		$this->db->select('
			produto.*,
			img.idimg,
			img.nomeImg,
			categoria.idcategoria,
			categoria.nomeCat
			');
		$this->db->join('img','img.idimg = produto.fk_idimg','left');
		$this->db->join('categoria','categoria.idcategoria = produto.fk_idcategoria','left');
		$this->db->where('idproduto',$id);
		return $this->db->get('produto')->row();
	}
	function get_img($id)
	{
		$this->db->where('fk_idproduto',$id);
		return $this->db->get('img')->result();
	}
	function up($id)
	{
		$dados = array(
			'nomeProd' => $this->input->post('nomeProd'),
			'descProd' => $this->input->post('descProd'),
			'fk_iduser' => $this->input->post('fk_iduser'),
			'fk_idstatus' => $this->input->post('fk_idstatus'),
			'fk_idcategoria' => $this->input->post('fk_idcategoria'),
			'fk_idimg' => $this->input->post('fk_idimg'),
			'destaque' => $this->input->post('destaque'),
			);
		$where = array('idproduto' => $id);
		$this->db->update('produto',$dados,$where);
	}
	function busca()
	{
		$status = $this->input->post('status');
		$termo = $this->input->post('termo');
		$this->db->or_like('nomeProd',$termo);
		$this->db->select('
			produto.*,
			img.idimg,
			img.nomeImg,
			categoria.idcategoria,
			categoria.nomeCat
			');
		$this->db->order_by('idproduto','desc');
		$this->db->where('produto.fk_idstatus',$status);
		$this->db->where('categoria.fk_idstatus',$status);
		$this->db->join('status','status.idstatus = produto.fk_idstatus');
		$this->db->join('img','img.idimg = produto.fk_idimg');
		$this->db->join('categoria','categoria.idcategoria = produto.fk_idcategoria');
		return $this->db->get('produto')->result();
	}
	function ativa_desativa($id,$novoStatus)
	{
		$dados = array('fk_idstatus' => $novoStatus);
		$this->db->update('produto', $dados, array('idproduto' => $id));
	}
	function del($id)
	{
		if($this->db->delete('produto',array('idproduto'=>$id)) == FALSE)
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