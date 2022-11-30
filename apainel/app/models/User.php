<?php
class User extends CI_Model
{
	function login($username, $password)
	{
		$this->db->where('fk_idstatus', 'A');
		$this->db->where('username', $username);
		$this->db->where('password', $password);
		$this->db->limit(1);
		
		$query = $this->db->get('user')->row();
		
		if(!empty($query->username))
		{
			return $query;
		}
		else
		{
			return false;
		}
	}
}
?>
