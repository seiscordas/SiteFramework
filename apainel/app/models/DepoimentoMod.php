<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class DepoimentoMod extends CI_Model {
	
	function lista($status)
	{
		$this->db->select('
			depoimento.*,
			img.idimg,
			img.nomeImg,
			');
		$this->db->order_by('iddepoimento','desc');
		$this->db->where('depoimento.fk_idstatus',$status);
		$this->db->join('status','status.idstatus = depoimento.fk_idstatus');
		$this->db->join('img','img.idimg = depoimento.fk_idimg');
		return $this->db->get('depoimento')->result();
	}
	function add()
	{
		$dados = array(
			'nomeDep' => $this->input->post('nomeDep'),
			'depoimento' => $this->input->post('depoimento'),
			'dtCadastro' => date("Y-m-d"),
			'fk_iduser' => $this->input->post('fk_iduser'),
			'fk_idstatus' => $this->input->post('fk_idstatus'),
			'fk_idimg' => $this->input->post('fk_idimg'),
			'destaque' => $this->input->post('destaque'),
			);
		$this->db->insert('depoimento',$dados);
	}
	function get($id)
	{
		$this->db->select('
			depoimento.*,
			img.idimg,
			img.nomeImg,
			');
		$this->db->join('img','img.idimg = depoimento.fk_idimg','left');
		$this->db->where('iddepoimento',$id);
		return $this->db->get('depoimento')->row();
	}
	function up($id)
	{
		$dados = array(
			'nomeDep' => $this->input->post('nomeDep'),
			'depoimento' => $this->input->post('depoimento'),
			'fk_iduser' => $this->input->post('fk_iduser'),
			'fk_idstatus' => $this->input->post('fk_idstatus'),
			'fk_idimg' => $this->input->post('fk_idimg'),
			'destaque' => $this->input->post('destaque'),
			);
		$where = array('iddepoimento' => $id);
		$this->db->update('depoimento',$dados,$where);
	}
	function busca()
	{
		$status = $this->input->post('status');
		$termo = $this->input->post('termo');
		$this->db->or_like('nomeDep',$termo);
		$this->db->select('
			depoimento.*,
			img.idimg,
			img.nomeImg,
			');
		$this->db->order_by('iddepoimento','desc');
		$this->db->where('depoimento.fk_idstatus',$status);
		$this->db->join('status','status.idstatus = depoimento.fk_idstatus');
		$this->db->join('img','img.idimg = depoimento.fk_idimg');
		return $this->db->get('depoimento')->result();
	}
	function ativa_desativa($id,$novoStatus)
	{
		$dados = array('fk_idstatus' => $novoStatus);
		$this->db->update('depoimento', $dados, array('iddepoimento' => $id));
	}
	function del($id)
	{
		if($this->db->delete('depoimento',array('iddepoimento'=>$id)) == FALSE)
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