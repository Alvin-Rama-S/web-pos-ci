<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ApiSupplier extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('ModelSupplier');
		$this->load->library('form_validation');
	}

	function index()
	{
		$data = $this->ModelSupplier->fetch_all();
		echo json_encode($data->result_array());
	}

	function insert()
	{
		// $this->form_validation->set_rules('idsupplier', 'idsupplier', 'required');
		$this->form_validation->set_rules('kdbarang', 'kdbarang', 'required');
		$this->form_validation->set_rules('tglpemasukan', 'tglpemasukan', 'required');
		$this->form_validation->set_rules('jumlah', 'jumlah', 'required');
		if($this->form_validation->run())
		{
			$data = array(
				// 'idsupplier'	=>	$this->input->post('idsupplier'),
				'kdbarang'	=>	$this->input->post('kdbarang'),
				'tglpemasukan'	=>	$this->input->post('tglpemasukan'),
				'jumlah'		=>	$this->input->post('jumlah')
			);

			$this->ModelSupplier->insert_api($data);

			$array = array(
				'success'		=>	true
			);
		}
		else
		{
			$array = array(
				'error'					=>	true,
				'idsupplier_error'		=>	form_error('idsupplier'),
				'kdbarang_error'		=>	form_error('kdbarang'),
				'tglpemasukan_error'	=>	form_error('tglpemasukan'),
				'jumlah_error'			=>	form_error('jumlah')
			);
		}
		echo json_encode($array);
	}
	
	function fetch_single()
	{
		if($this->input->post('idsupplier'))
		{
			$data = $this->ModelSupplier->fetch_single_user($this->input->post('idsupplier'));

			foreach($data as $row)
			{
				$output['idsupplier'] 	= $row['idsupplier'];
				$output['kdbarang'] 	= $row['kdbarang'];
				$output['tglpemasukan'] = $row['tglpemasukan'];
				$output['jumlah'] 		= $row['jumlah'];
			}
			echo json_encode($output);
		}
	}

	function update()
	{
		// $this->form_validation->set_rules('idsupplier', 'idsupplier', 'required');
		$this->form_validation->set_rules('kdbarang', 'kdbarang', 'required');

		$this->form_validation->set_rules('tglpemasukan', 'tglpemasukan', 'required');

		$this->form_validation->set_rules('jumlah', 'jumlah', 'required');
		if($this->form_validation->run())
		{	
			$data = array(
				'idsupplier'	=>	$this->input->post('idsupplier'),	
				'kdbarang'		=>	$this->input->post('kdbarang'),
				'tglpemasukan'		=>	$this->input->post('tglpemasukan'),
				'jumlah'		=>	$this->input->post('jumlah')
			);

			$this->ModelSupplier->update_api($this->input->post('idsupplier'), $data);

			$array = array(
				'success'		=>	true
			);
		}
		else
		{
			$array = array(
				'error'					=>	true,
				'idsupplier_error'		=>	form_error('idsupplier'),
				'kdbarang_error'		=>	form_error('kdbarang'),
				'tglpemasukan_error'	=>	form_error('tglpemasukan'),
				'jumlah_error'			=>	form_error('jumlah')
			);
		}
		echo json_encode($array);
	}

	function delete()
	{
		if($this->input->post('idsupplier'))
		{
			if($this->ModelSupplier->delete_single_user($this->input->post('idsupplier')))
			{
				$array = array(

					'success'	=>	true
				);
			}
			else
			{
				$array = array(
					'error'		=>	true
				);
			}
			echo json_encode($array);
		}
	}

}


?>