<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class PortifolioMod extends CI_Model {
	
	function lista($status)
	{
		$this->db->select('
			portifolio.*,
			img.idimg,
			img.nomeImg,
			');
		$this->db->order_by('idportifolio','desc');
		$this->db->where('portifolio.fk_idstatus',$status);
		$this->db->join('status','status.idstatus = portifolio.fk_idstatus');
		$this->db->join('img','img.idimg = portifolio.fk_idimg');
		return $this->db->get('portifolio')->result();
	}
	function add()
	{
		$dados = array(
			'nomePort' => $this->input->post('nomePort'),
			'descPort' => $this->input->post('descPort'),
			'linkPort' => $this->input->post('linkPort'),
			'dtCadastro' => date("Y-m-d"),
			'fk_iduser' => $this->input->post('fk_iduser'),
			'fk_idstatus' => $this->input->post('fk_idstatus'),
			'fk_idimg' => $this->input->post('fk_idimg'),
			'destaque' => $this->input->post('destaque'),
			);
		$this->db->insert('portifolio',$dados);
	}
	function get($id)
	{
		$this->db->select('
			portifolio.*,
			img.idimg,
			img.nomeImg,
			');
		$this->db->join('img','img.idimg = portifolio.fk_idimg','left');
		$this->db->where('idportifolio',$id);
		return $this->db->get('portifolio')->row();
	}
	function up($id)
	{
		$dados = array(
			'nomePort' => $this->input->post('nomePort'),
			'descPort' => $this->input->post('descPort'),
			'linkPort' => $this->input->post('linkPort'),
			'fk_iduser' => $this->input->post('fk_iduser'),
			'fk_idstatus' => $this->input->post('fk_idstatus'),
			'fk_idimg' => $this->input->post('fk_idimg'),
			'destaque' => $this->input->post('destaque'),
			);
		$where = array('idportifolio' => $id);
		$this->db->update('portifolio',$dados,$where);
	}
	function busca()
	{
		$status = $this->input->post('status');
		$termo = $this->input->post('termo');
		$this->db->or_like('nomePort',$termo);
		$this->db->select('
			portifolio.*,
			img.idimg,
			img.nomeImg,
			');
		$this->db->order_by('idportifolio','desc');
		$this->db->where('portifolio.fk_idstatus',$status);
		$this->db->join('status','status.idstatus = portifolio.fk_idstatus');
		$this->db->join('img','img.idimg = portifolio.fk_idimg');
		return $this->db->get('portifolio')->result();
	}
	function ativa_desativa($id,$novoStatus)
	{
		$dados = array('fk_idstatus' => $novoStatus);
		$this->db->update('portifolio', $dados, array('idportifolio' => $id));
	}
	function del($id)
	{
		if($this->db->delete('portifolio',array('idportifolio'=>$id)) == FALSE)
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