<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class HomeMod extends CI_Model {
	
	function get_contrato()
	{
		$this->db->select('
			contrato.*,
			plano.*,
			fisica.*,
			fisica.nome nomeCliente,
			
			juridica.*,
			plano.valor valorPlano,
			contrato.valor valorContrato,
			evento.*,
			evento.nome nomeEvento,
			');
		$this->db->join('evento','evento.idevento = contrato.fk_idevento','left');
		$this->db->join('plano','plano.idplano = contrato.fk_idplano','left');
		$this->db->join('fisica','fisica.idfisica = contrato.fk_idcliente','left');
		$this->db->join('juridica','juridica.idjuridica = contrato.fk_idcliente','left');
		
		$this->db->order_by('vigenciaAte', 'desc');
		$this->db->where("vigenciaAte < NOW()");
		$this->db->where("fk_idstatus", 'A'); 
		return $this->db->get('contrato')->result();
	}
	function get_caixa($fk_idcaixa_tipo)
	{
		$this->db->select('caixa.*, evento.*, users.username usuario');

		$this->db->where('caixa.fk_idstatus', 'A');
		$this->db->where('caixa.fk_idstatus_finan', 'A');
		$this->db->where("dtVenc < NOW()");
		$this->db->where('caixa.fk_idcaixa_tipo', $fk_idcaixa_tipo);
		
		$this->db->join('users','users.id = caixa.fk_users_id','left');
		$this->db->join('evento','evento.idevento = caixa.fk_idevento','left');
		
		$this->db->order_by('dtVenc','asc');
		
		return $this->db->get('caixa')->result();
	}
}
/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */