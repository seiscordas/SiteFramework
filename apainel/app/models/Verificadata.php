<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class VerificaData extends CI_Model {
	function vencido($tabela = '', $coluna = '')
	{
		$this->db->where($coluna." < NOW()");
		return $this->db->get($tabela);
	}
	function mes($tabela = '', $coluna = '', $meses = 1)
	{
		$difMes = mktime(0,0,0, date("m")+$meses, date("d"), date("Y"));
		$difMes = date("m",$difMes);
		$this->db->where("MONTH(". $coluna . ") = " . $difMes);
		return $this->db->get($tabela);
	}
	function dias($tabela = '', $coluna = '', $dias = 5)
	{
		$difMes = mktime(0,0,0, date("m"), date("d")+$dias, date("Y"));
		$difMes = date("d",$difMes);
		$this->db->where("DAY(". $coluna . ") = " . $difMes);
		return $this->db->get($tabela);
	}
	function anirversario($tabela = '', $coluna = '', $dias = 1)
	{
		$this->db->where("CONCAT_WS('-',YEAR(NOW()),MONTH(". $coluna . "),DAY(". $coluna . ")) >= NOW() AND
		CONCAT_WS('-',YEAR(NOW()),MONTH(". $coluna . "),DAY(". $coluna . ")) <= DATE_ADD(NOW(), INTERVAL 7 DAY)");
		$this->db->or_where("CONCAT_WS('-',YEAR(NOW()),MONTH(". $coluna . "),DAY(". $coluna . ")) = CURDATE()");
		return $this->db->get($tabela);
	}
	function compara_venc($vencimento)
	{
		list($ano, $mes, $dia) = explode("-", $vencimento);
		$difMes = mktime(0,0,0, date($mes)-1, date($dia), date($ano));
		$vencimento = strtotime($vencimento);
		$dataAtual = mktime(0,0,0, date("m"), date("d"), date("Y"));
		$diasRestantes = ((($vencimento - $dataAtual) / 60) / 60) / 24;
		$diasRestantes = intval($diasRestantes);
		
		if($vencimento <= $dataAtual)
			echo '<span class="label label-important">Vencido</span>';
		elseif($dataAtual >= $difMes && $dataAtual <= $vencimento)
			echo '<span class="label label-warning">A '. $diasRestantes  .' dias do Vencimento</span>';
		else
			echo '<span class="label label-success">A '. $diasRestantes  .' dias do Vencimento</span>';  
	}
	function compara_niver($niver,$N_dia = 7,$N_mes = 1)
	{
		list($ano, $mes, $dia) = explode("-", $niver);
		$data_nive = mktime(0,0,0, date($mes), date($dia), date("Y"));
		$dataAtual = mktime(0,0,0, date("m"), date("d"), date("Y"));
		$dif_dias = mktime(0,0,0, date("m"), date($dia)-$N_dia, date("Y"));
		$dif_mes = mktime(0,0,0, date($mes)-$mes, date("d"), date("Y"));
		$diasRestantes = ((($data_nive - $dataAtual) / 60) / 60) / 24;
		$diasRestantes = intval($diasRestantes);
		
		if($data_nive == $dataAtual)
			echo '<span class="label label-success">Aniversario Hoje</span>';
		elseif($dataAtual >= $dif_dias && $dataAtual <= $data_nive)
			echo '<span class="label label-info">A '. $diasRestantes  .' dias do Aniversario</span>';
		elseif($dataAtual >= $dif_mes && $dataAtual <= $data_nive)
			echo '<span class="label label-info">A '. $diasRestantes  .' dias do Aniversario</span>';
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */