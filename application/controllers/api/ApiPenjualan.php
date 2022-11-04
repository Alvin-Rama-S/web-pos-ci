<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ApiPenjualan extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('ModelPenjualan');
		$this->load->library('form_validation');
	}

	function index()
	{
		$data = $this->ModelPenjualan->fetch_all();
		echo json_encode($data->result_array());
	}

	function insert()
	{
		// $this->form_validation->set_rules('idjual', 'idjual', 'required');
		$this->form_validation->set_rules('kdbarang', 'kdbarang', 'required');
		$this->form_validation->set_rules('tgljual', 'tgljual', 'required');
		$this->form_validation->set_rules('jumlah', 'jumlah', 'required');
		if($this->form_validation->run())
		{
			$data = array(
				// 'idjual'	=>	$this->input->post('idjual'),
				'kdbarang'	=>	$this->input->post('kdbarang'),
				'tgljual'	=>	$this->input->post('tgljual'),
				'jumlah'		=>	$this->input->post('jumlah')
			);

			$this->ModelPenjualan->insert_api($data);

			$array = array(
				'success'		=>	true
			);
		}
		else
		{
			$array = array(
				'error'					=>	true,
				'idjual_error'		=>	form_error('idjual'),
				'kdbarang_error'		=>	form_error('kdbarang'),
				'tgljual_error'		=>	form_error('tgljual'),
				'jumlah_error'		=>	form_error('jumlah')
			);
		}
		echo json_encode($array);
	}
	
	function fetch_single()
	{
		if($this->input->post('idjual'))
		{
			$data = $this->ModelPenjualan->fetch_single_user($this->input->post('idjual'));

			foreach($data as $row)
			{
				$output['idjual'] = $row['idjual'];
				$output['kdbarang'] = $row['kdbarang'];
				$output['tgljual'] = $row['tgljual'];
				$output['jumlah'] = $row['jumlah'];
			}
			echo json_encode($output);
		}
	}

	function update()
	{
		// $this->form_validation->set_rules('idjual', 'idjual', 'required');
		$this->form_validation->set_rules('kdbarang', 'kdbarang', 'required');

		$this->form_validation->set_rules('tgljual', 'tgljual', 'required');

		$this->form_validation->set_rules('jumlah', 'jumlah', 'required');
		if($this->form_validation->run())
		{	
			$data = array(
				'idjual'		=>	$this->input->post('idjual'),	
				'kdbarang'		=>	$this->input->post('kdbarang'),
				'tgljual'		=>	$this->input->post('tgljual'),
				'jumlah'		=>	$this->input->post('jumlah')
			);

			$this->ModelPenjualan->update_api($this->input->post('idjual'), $data);

			$array = array(
				'success'		=>	true
			);
		}
		else
		{
			$array = array(
				'error'				=>	true,
				'idjual_error'		=>	form_error('idjual'),
				'kdbarang_error'	=>	form_error('kdbarang'),
				'tgljual_error'		=>	form_error('tgljual'),
				'jumlah_error'		=>	form_error('jumlah')
			);
		}
		echo json_encode($array);
	}

	function delete()
	{
		if($this->input->post('idjual'))
		{
			if($this->ModelPenjualan->delete_single_user($this->input->post('idjual')))
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