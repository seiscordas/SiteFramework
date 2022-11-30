<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class GaleriaMod extends CI_Model {
	
	function lista($status)
	{
		$this->db->select('
			galeria.*,
			img.idimg,
			img.nomeImg,
			');
		$this->db->order_by('idgaleria','desc');
		$this->db->where('galeria.fk_idstatus',$status);
		$this->db->join('status','status.idstatus = galeria.fk_idstatus');
		$this->db->join('img','img.idimg = galeria.fk_idimg');
		return $this->db->get('galeria')->result();
	}
	function add()
	{
		$dados = array(
			'nomeGal' => $this->input->post('nomeGal'),
			'dtCadastro' => date("Y-m-d"),
			'fk_iduser' => $this->input->post('fk_iduser'),
			'fk_idstatus' => $this->input->post('fk_idstatus'),
			'fk_idimg' => $this->input->post('fk_idimg'),
			);
		$this->db->insert('galeria',$dados);
	}
	function get($id)
	{
		$this->db->select('
			galeria.*,
			img.idimg,
			img.nomeImg,
			');
		$this->db->join('img','img.idimg = galeria.fk_idimg','left');
		$this->db->where('idgaleria',$id);
		return $this->db->get('galeria')->row();
	}
	function get_img($id)
	{
		$this->db->where('fk_idgaleria',$id);
		return $this->db->get('img')->result();
	}
	function up($id)
	{
		$dados = array(
			'nomeGal' => $this->input->post('nomeGal'),
			'fk_iduser' => $this->input->post('fk_iduser'),
			'fk_idstatus' => $this->input->post('fk_idstatus'),
			'fk_idimg' => $this->input->post('fk_idimg'),
			);
		$where = array('idgaleria' => $id);
		$this->db->update('galeria',$dados,$where);
	}
	function auto_complete($status)
	{
		$this->db->where('galeria.fk_idstatus',$status);
		$termo = $this->input->post('termo');
		$this->db->select('idgaleria, nomeGal');
		$this->db->like('galeria.nomeGal',$termo);
		$dados = $this->db->get('galeria')->result();
		return $dados;
	}
	function busca()
	{
		$status = $this->input->post('status');
		$termo = $this->input->post('termo');
		$this->db->or_like('nomeGal',$termo);
		$this->db->select('
			galeria.*,
			img.idimg,
			img.nomeImg,
			');
		$this->db->order_by('idgaleria','desc');
		$this->db->where('galeria.fk_idstatus',$status);
		$this->db->join('status','status.idstatus = galeria.fk_idstatus');
		$this->db->join('img','img.idimg = galeria.fk_idimg');
		return $this->db->get('galeria')->result();
	}
	function ativa_desativa($id,$novoStatus)
	{
		$dados = array('fk_idstatus' => $novoStatus);
		$this->db->update('galeria', $dados, array('idgaleria' => $id));
	}
	function del($id)
	{
		if($this->db->delete('galeria',array('idgaleria'=>$id)) == FALSE)
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