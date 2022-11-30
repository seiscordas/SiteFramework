<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class EventoMod extends CI_Model {
	
	function lista($status)
	{
		$this->db->select('
			evento.*,
			img.idimg,
			img.nomeImg,
			galeria.nomeGal
			');
		$this->db->order_by('idevento','desc');
		$this->db->where('evento.fk_idstatus',$status);
		$this->db->join('status','status.idstatus = evento.fk_idstatus');
		$this->db->join('img','img.idimg = evento.fk_idimg');
		$this->db->join('galeria','galeria.idgaleria = evento.fk_idgaleria','left');
		return $this->db->get('evento')->result();
	}
	function add()
	{
		$dados = array(
			'nomeEvent' => $this->input->post('nomeEvent'),
			'descEvent' => $this->input->post('descEvent'),
			'dtCadastro' => date("Y-m-d"),
			'fk_iduser' => $this->input->post('fk_iduser'),
			'fk_idstatus' => $this->input->post('fk_idstatus'),
			'fk_idimg' => $this->input->post('fk_idimg'),
			'destaque' => $this->input->post('destaque'),
			);
		$this->db->insert('evento',$dados);
	}
	function get($id)
	{
		$this->db->select('
			evento.*,
			img.idimg,
			img.nomeImg,
			galeria.nomeGal
			');
		$this->db->join('img','img.idimg = evento.fk_idimg','left');
		$this->db->join('galeria','galeria.idgaleria = evento.fk_idgaleria','left');
		$this->db->where('idevento',$id);
		return $this->db->get('evento')->row();
	}
	function get_img($id)
	{
		$this->db->where('fk_idevento',$id);
		return $this->db->get('img')->result();
	}
	function up($id)
	{
		$dados = array(
			'nomeEvent' => $this->input->post('nomeEvent'),
			'descEvent' => $this->input->post('descEvent'),
			'fk_iduser' => $this->input->post('fk_iduser'),
			'fk_idstatus' => $this->input->post('fk_idstatus'),
			'fk_idimg' => $this->input->post('fk_idimg'),
			'destaque' => $this->input->post('destaque'),
			);
		$where = array('idevento' => $id);
		$this->db->update('evento',$dados,$where);
	}
	function add_up_gal()
	{
		$id = $this->input->post('idevento');
		$dados = array(
			'fk_idgaleria' => $this->input->post('fk_idgaleria'),
			);
		$where = array('idevento' => $id);
		$this->db->update('evento',$dados,$where);
	}
	function busca()
	{
		$status = $this->input->post('status');
		$termo = $this->input->post('termo');
		$this->db->or_like('nomeEvent',$termo);
		$this->db->select('
			evento.*,
			img.idimg,
			img.nomeImg,
			');
		$this->db->order_by('idevento','desc');
		$this->db->where('evento.fk_idstatus',$status);
		$this->db->join('status','status.idstatus = evento.fk_idstatus');
		$this->db->join('img','img.idimg = evento.fk_idimg');
		return $this->db->get('evento')->result();
	}
	function ativa_desativa($id,$novoStatus)
	{
		$dados = array('fk_idstatus' => $novoStatus);
		$this->db->update('evento', $dados, array('idevento' => $id));
	}
	function del($id)
	{
		if($this->db->delete('evento',array('idevento'=>$id)) == FALSE)
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