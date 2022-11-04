<?php
class ModelPenjualan extends CI_Model
{
	function fetch_all()
	{
		$this->db->order_by('idjual', 'ASC');
		return $this->db->get('tbjual');
	}

	function insert_api($data)
	{
		$this->db->insert('tbjual', $data);
	}

	function fetch_single_user($idjual)
	{
		$this->db->where('idjual', $idjual);
		$query = $this->db->get('tbjual');
		return $query->result_array();
	}

	function update_api($idjual, $data)
	{
		$this->db->where('idjual', $idjual);
		$this->db->update('tbjual', $data);
	}

	function delete_single_user($idjual)
	{
		$this->db->where('idjual', $idjual);
		$this->db->delete('tbjual');
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