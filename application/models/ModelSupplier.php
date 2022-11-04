<?php
class ModelSupplier extends CI_Model
{
	function fetch_all()
	{
		$this->db->order_by('idsupplier', 'ASC');
		return $this->db->get('tbsupplier');
	}

	function insert_api($data)
	{
		$this->db->insert('tbsupplier', $data);
	}

	function fetch_single_user($idsupplier)
	{
		$this->db->where('idsupplier', $idsupplier);
		$query = $this->db->get('tbsupplier');
		return $query->result_array();
	}

	function update_api($idsupplier, $data)
	{
		$this->db->where('idsupplier', $idsupplier);
		$this->db->update('tbsupplier', $data);
	}

	function delete_single_user($idsupplier)
	{
		$this->db->where('idsupplier', $idsupplier);
		$this->db->delete('tbsupplier');
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