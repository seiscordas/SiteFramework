<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class LojaMod extends CI_Model {
	
	function add($tabela,$dados,$id,$coluna)
	{
		$registro = $this->db->get_where($tabela,array($coluna => $id))->row();
		if(!$registro)
		{
			$this->db->insert($tabela,$dados);
		}
		else
		{
			$this->db->where(array($coluna => $id));
			$this->db->update($tabela,$dados);
		}
	}
	function get()
	{
		return $this->db->get('loja')->row();
	}
}
/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */