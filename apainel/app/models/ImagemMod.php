<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class imagemMod extends CI_Model {
	
	function lista()
	{
		$this->db->where('fk_idgaleria IS NULL');
		$this->db->order_by('idimg','desc');
		return $this->db->get('img')->result();
	}
	function img_gal_lista($id)
	{
		$this->db->order_by('idimg','desc');
		return $this->db->get_where('img',array('fk_idgaleria' => $id))->result();
	}
	function get($id)
	{
		return $this->db->get_where('img',array('idimg' => $id))->row();
	}
	function up_img()
	{
		$idgaleria = $this->input->post('idgaleria');
		// caminho da imagem
		$caminho = up_path('assets/images/uploads');
		// Envia arquivo
		$retUp = add_img($caminho);
		if($retUp['up'] === false)
		{
			return array('up' => false, 'msg' => $retUp['msg']);
		}
		// Renderiza imagem
		$retRsize = rsize_img($retUp, 1000);
		if($retRsize['up'] === false)
		{
			return array('add' => false, 'msg' => $retRsize['msg']);
		}
		else
		{
			$nomeImg = $retRsize['imgNome'];
			if($idgaleria)
			{
				$this->add_img_gal($idgaleria, $nomeImg);
			}
			else
			{
				$this->add($nomeImg);
			}
		}
	}
	function add($nomeImg)
	{
		$dadosImg = array(
			'nomeImg'    => $nomeImg,
			'dtCadastro' => date("Y-m-d"),
			);
			
		$this->db->insert('img',$dadosImg);
		
		return array('add' => true);
	}
	function add_img_gal($id, $nomeImg)
	{
		$dadosImg = array(
			'nomeImg'    => $nomeImg,
			'dtCadastro'   => date("Y-m-d"),
			'fk_idgaleria' => $id,
			);
		$this->db->insert('img',$dadosImg);
		
		return array('add' => true);
	}
	function del_img_gal($id)
	{
		$arq = $this->img_gal_lista($id);
		if($this->db->delete('img',array('fk_idgaleria'=>$id)) == FALSE)
		{
			return false;
		}
		else
		{
			// caminho da imagem
			$caminho = up_path();
			foreach($arq as $img)
			{
				del_file($img->nomeImg,$caminho);
			}
			return true;
		}
	}
	function del($id)
	{
		$img = $this->get($id);
		$this->db->db_debug = FALSE;
		if($this->db->delete('img',array('idimg'=>$id)) == FALSE)
		{
			return false;
		}
		else
		{
			// caminho da imagem
			$caminho = up_path();
			del_file($img->nomeImg,$caminho);
			return true;
		}
	}
}
/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */