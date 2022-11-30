<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
#
#
#
#
#
#
#
// Versão 1.1
#
#	add caminho para up de arquivo
#	correção do nome da imagem (adicionado .jpg)
#
#
#
#
#
//////////////////////////////////////////////////
#
#
#
#
#
#
// Muda formato de data
#
#
#
#
#
#
#
if ( ! function_exists('data'))
{	
	function data($dt,$slug)
	{
		if($slug == '-')
			return $dt = implode('-',array_reverse(explode('/',$dt)));
		else if($slug == '/')
			return $dt = implode('/',array_reverse(explode('-',$dt)));
	}
}
#
#
#
#
#
#
#
// Muda formato de valores em moeda para insersçao em banco de dados
#
#
#
#
#
#
#
if ( ! function_exists('moeda'))
{	
	
	function moeda($valor)
	{
		$valor = str_replace('.','',$valor);
		return $valor = str_replace(',','.',$valor);
	}
}
#
#
#
#
#
#
#
// Tranform qualquer texto em link
#
#
#
#
#
#
#
if ( ! function_exists('txt_tolink'))
{
	function txt_tolink($string,$slug = '-')
	{
		$acentos = array('À','Á','Ã','Â','à','á','ã','â','Ê','É',
						'Í','í','Ó','Õ','Ô','ó','õ','ô','Ú','Ü',
						'Ç','ç','é','ê','ú','ü');
		$remove_acentos = array('a','a','a','a','a','a','a','a','e','e',
						'i','i','o','o','o','o','o','o','u','u','c','c',
						'e','e','u','u');
		$string = strtolower(str_replace($acentos, $remove_acentos, urldecode(trim($string))));
		//Insere o caracter desejado entres as palavras
		if ($slug)
		{
			// Troca tudo que não for letra ou número por um caractere ($slug)
			$string = preg_replace('/[^a-z0-9]/i', $slug, $string);
			// Tira os caracteres ($slug) repetidos
			$string = preg_replace('/' . $slug . '{2,}/i', $slug, $string);
			$string = trim($string, $slug);
		}
		return $string;
	}
}
#
#
#
#
#
#
#
// Faz uma verificação de um registro do banco de dados retornando em "JSON" 1 ou 0
#
#
#
#
#
#
#
if ( ! function_exists('verifica_registro'))
{
	function verifica_registro($tabela,$input = NULL)
	{
		$CI =& get_instance();
		if($input)
		{
			//Verifica se um dado já está cadastrado
			foreach($input as $row => $input)
			{
				$CI->db->or_where($row, $input);
			}
		}
		else
		{
			//Verifica se um dado já está cadastrado
			foreach($CI->input->post() as $row => $input)
			{
				$CI->db->or_where($row, $input);
			}
		}
		$verifica = $CI->db->get($tabela)->row();
		//var_dump($verifica);
		if(!empty($verifica))
		{
			return TRUE;
		}
		else
		    return FALSE;
	}
}
#
#
#
#
#
#
#
#
#
// Faz o Upload de imagem e retorna dados da imagem
#
#
#
#
#
#
#
if ( ! function_exists('add_img'))
{
	function add_img($caminho)
	{
		//Crica caminho se não existir.
		if(!is_dir($caminho))
		{
			mkdir($caminho, DIR_WRITE_MODE, true);
		}
		
		//Instancia a classe CI
		$CI =& get_instance();
		
		//Configurações de upload
		$config['upload_path']          = $caminho;
		$config['encrypt_name']         = true;
		$config['allowed_types']        = 'gif|jpg|png';
		$config['max_size']             = 2000;
		$config['max_width']            = 2816;
		$config['max_height']           = 2112;
		
		$CI->load->library('upload', $config);
		
		if ( ! $CI->upload->do_upload())
		{
			return array('up' => false, 'msg' => $CI->upload->display_errors());
		}
		else
		{
			$img = $CI->upload->data();
			return $img;
		}
	}
}
#
#
#
#
#
#
#
#
#
// Faz o Renderiza imagem e retorna um nome
#
#
#
#
#
#
#
if ( ! function_exists('rsize_img'))
{
	function rsize_img($dadosImg, $w ,$h = NULL)
	{		
		$imgNome    = $dadosImg['file_name'];
		$imgCaminho = $dadosImg['file_path'];
				
		$dimensao = getimagesize($imgCaminho . '/' . $imgNome);
		$x = $dimensao[0];
		$y = $dimensao[1];
		if($x > $w && $x > $y)
		{
			$h = ($w*$y) / $x;
		}
		elseif($y > $w && $x < $y)
		{
			$h = $w;
			$w = ($w*$x) / $y;
		}
		else
		{
			$w = $x;
			$h = $y;
		}
		
		$config['image_library'] = 'gd2';
		$config['source_image']  = $imgCaminho . $imgNome;
		$config['width']         = $w;
		$config['height']        = $h;
		
		//Instancia a classe CI
		$CI =& get_instance();
		
		$CI->load->library('image_lib',$config);
		if ( ! $CI->image_lib->resize())
		{
			return array('up' => false, 'msg' => $CI->image_lib->display_errors());
		}
		else
		{
			return array('up' => true, 'imgNome' => $imgNome);
		}
	}
}

#
#
#
#
#
#
#
#
#
// Caminho para uploads
#
# 
#
#
#
#
#
if ( ! function_exists('up_path'))
{
	function up_path($caminho = 'assets/images/uploads',$replace = 'apainel')
	{
		$CI =& get_instance();
		$CI->load->helper('path');
		$caminho = set_realpath().$caminho.'/';
		if($replace)
		{
			$caminho = str_replace($replace,'',$caminho);
		}
		$caminho = str_replace(array('\\\\','//'),array('\\','/'),$caminho);
		return $caminho;
	}
}
#
#
#
#
#
#
#
#
#
// Deleta um arquivo de uma pasta
#
#
#
#
#
#
#
if ( ! function_exists('del_file'))
{
	function del_file($file,$caminho)
	{
		$file = $caminho . $file;
		//Verifica se existe o arqivo
		if(is_file($file))
		{
			unlink($file);
		}
	}
}
#
#
#
#
#
#
#
#
#
// Deleta um Diretorio
#
#
#
#
#
#
#
if ( ! function_exists('del_dir'))
{
	function del_dir($dir)
	{
		//Verifica se existe o diretório
		if(is_dir($dir))
		{
			//Abre o diretorio
			if($handle = opendir($dir))
			{
				//Verifica se tem arquivo e exclui todos
				while(false !== ($file = readdir($handle)))
				{
					if(($file == ".") or ($file == ".."))
					{
						continue;
					}
					if(is_dir($dir . $file))
					{
						$this->del_dir($dir . $file . "/");
					}
					else
					{
						unlink($dir . $file);
					}
				}
			}
			else
			{
				print("nao foi possivel abrir o arquivo.");
				return false;
			}
			// fecha a pasta aberta
			closedir($handle);
			// apaga a pasta, que agora esta vazia
			rmdir($dir);
		}
		else
		{
			print("diretorio informado invalido");
			return false;
		}
	}
}
#
#
#
#
#
#
#
#
#
// Resize de imagem com timthumb
#
#
#
#
#
#
#
if ( ! function_exists('img_size'))
{
	function img_size($pasta = NULL, $img = NULL,$w = NULL, $h = NULL, $replace = NULL)
	{
		$pasta = ($pasta != NULL)? $pasta.'/' : NULL;
		$w = ($w == NULL)? $w : $w = '&w='.$w;
		$h = ($h == NULL)? $h : $h = '&h='.$h;
		$caminho = str_replace($replace,'',base_url());
		$timthumb = $caminho.'assets/images/img_size/img.php?src='.$caminho.'assets/images/'.$pasta.$img.$w.$h;
		return $timthumb;
	}
}
#
#
#
#
#
#
#
// Gera data para parcelas
#
#
#
#
#
#
#
if ( ! function_exists('gera_parcela'))
{
	function gera_parcela($dtVenc,$qtdParcela)
	{
		$dtArray = explode('-',$dtVenc);
		$diaVenc = $dtArray[2];
		$mesVenc = $dtArray[1];
		$anoVenc = $dtArray[0];
		
		$mesAtual = date("m");  
		$anoAtual = date("Y");
		
		for($i=0; $i < $qtdParcela; $i++)
		{
			if ($mesVenc == 13)
			{
				$mesVenc = 1;  
				$anoVenc = $anoVenc + 1;    
			}
			if ($diaVenc > 28 && $mes == 2)
			{
				$dtParcela = date("Y-m-d",strtotime($anoVenc ."-". $mesVenc ."-". 28));  
			}
			else
			{  
				$dtParcela = date("Y-m-d",strtotime($anoVenc ."-". $mesVenc ."-". $diaVenc));  
			}
			$data->$i .= $dtParcela;
			$mesVenc = $mesVenc + 1;
		}
		return $data;
	}
}
#
#
#
#
#
#
#
#
#
// Gera novo id apartir do ultimo id do banco
#
#
#
#
#
#
#
if ( ! function_exists('novo_id'))
{
	function novo_id($tabela,$coluna)
	{
		$novoId = ultimo_id($tabela,$coluna) + 1;
		return $novoId;
	}
}
if ( ! function_exists('ultimo_id'))
{
	function ultimo_id($tabela,$coluna)
	{
		$CI =& get_instance();
		$CI->db->select($coluna);
		$CI->db->order_by($coluna,'desc');
		$CI->db->limit(1);
		$ultimoId = $CI->db->get($tabela)->row()->$coluna;
		return $ultimoId;
	}
}
#
#
#
#
#
#
#
#
#
// Datas, Aniversários, Vencimentos...
#
#
#
#
#
#
#
if ( ! function_exists('vencido'))
{
	function vencido($tabela = '', $coluna = '')
	{
		$CI =& get_instance();
		$CI->db->where($coluna." < NOW()");
		return $CI->db->get($tabela);
	}
}
if ( ! function_exists('mes'))
{
	function mes($tabela = '', $coluna = '', $meses = 1)
	{
		$CI =& get_instance();
		$difMes = mktime(0,0,0, date("m")+$meses, date("d"), date("Y"));
		$difMes = date("m",$difMes);
		$CI->db->where("MONTH(". $coluna . ") = " . $difMes);
		return $CI->db->get($tabela);
	}
}
if ( ! function_exists('dias'))
{
	function dias($tabela = '', $coluna = '', $dias = 5)
	{
		$CI =& get_instance();
		$difMes = mktime(0,0,0, date("m"), date("d")+$dias, date("Y"));
		$difMes = date("d",$difMes);
		$CI->db->where("DAY(". $coluna . ") = " . $difMes);
		return $CI->db->get($tabela);
	}
}
if ( ! function_exists('compara_venc'))
{
	function compara_venc($vencimento)
	{
		list($ano, $mes, $dia) = explode("-", $vencimento);
		$difMes = mktime(0,0,0, date($mes)-1, date($dia), date($ano));
		$vencimento = strtotime($vencimento);
		$dataAtual = mktime(0,0,0, date("m"), date("d"), date("Y"));
		$diasRestantes = ((($vencimento - $dataAtual) / 60) / 60) / 24;
		$diasRestantes = intval($diasRestantes);
		
		$pluralSing = (abs($diasRestantes) > 1) ? 'dias' : 'dia';
		
		$compara_venc->diasRestantes = $diasRestantes;
		if($vencimento == $dataAtual)
			$compara_venc->msg = '<span class="label label-danger">Vencimento hoje</span>';
		elseif($vencimento <= $dataAtual)
			$compara_venc->msg = '<span class="label label-danger">Vencido à '. abs($diasRestantes) .' '.$pluralSing.'</span>';
		//elseif($dataAtual >= $difMes && $dataAtual <= $vencimento)
			//$compara_venc->msg = '<span class="label label-warning">A '. $diasRestantes  .' '.$pluralSing.' do Vencimento</span>';
		elseif($diasRestantes < 5)
			$compara_venc->msg = '<span class="label label-warning">A '. $diasRestantes  .' '.$pluralSing.' do Vencimento</span>';
		else
			$compara_venc->msg = '<span class="label label-success">A '. $diasRestantes  .' '.$pluralSing.' do Vencimento</span>';
		return $compara_venc;
	}
}
if ( ! function_exists('compara_niver'))
{
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
if ( ! function_exists('anirversario'))
{
	// Pega aniversariantes direto do banco de dados
	function anirversario($tabela = '', $coluna = '', $dias = 1)
	{
		$CI =& get_instance();
		$CI->db->where("CONCAT_WS('-',YEAR(NOW()),MONTH(". $coluna . "),DAY(". $coluna . ")) >= NOW() AND
		CONCAT_WS('-',YEAR(NOW()),MONTH(". $coluna . "),DAY(". $coluna . ")) <= DATE_ADD(NOW(), INTERVAL 7 DAY)");
		$CI->db->or_where("CONCAT_WS('-',YEAR(NOW()),MONTH(". $coluna . "),DAY(". $coluna . ")) = CURDATE()");
		return $CI->db->get($tabela);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */