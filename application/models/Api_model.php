<?php
class Api_model extends CI_Model
{
	function fetch_all()
	{
		$this->db->order_by('kdbarang', 'DESC');
		return $this->db->get('tbbarang');
	}

	function insert_api($data)
	{
		$this->db->insert('tbbarang', $data);
	}

	function fetch_single_user($kdbarang)
	{
		$this->db->where('kdbarang', $kdbarang);
		$query = $this->db->get('tbbarang');
		return $query->result_array();
	}

	function update_api($kdbarang, $data)
	{
		$this->db->where('kdbarang', $kdbarang);
		$this->db->update('tbbarang', $data);
	}

	function delete_single_user($kdbarang)
	{
		$this->db->where('kdbarang', $kdbarang);
		$this->db->delete('tbbarang');
		if($this->db->affected_rows() > 0)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
}

?>