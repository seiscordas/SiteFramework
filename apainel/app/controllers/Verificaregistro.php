<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class VerificaRegistro extends CI_Controller {

	function verifica($tabela = '')
	{
		//Verifica se um dado já está cadastrado
		foreach($this->input->post() as $row => $input)
		{
			$this->db->or_where(array($row => $input));
		}
		$verifica = $this->db->get($tabela)->row();
		//var_dump($verifica);
		if(!empty($verifica))
		{
			echo json_encode(1);
		}
	}
}

?>