<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('api_model');
		$this->load->library('form_validation');
	}

	function index()
	{
		$data = $this->api_model->fetch_all();
		echo json_encode($data->result_array());
	}

	function insert()
	{
		$this->form_validation->set_rules('kdbarang', 'kdbarang', 'required');
		$this->form_validation->set_rules('namabrg', 'namabrg', 'required');
		$this->form_validation->set_rules('harga', 'harga', 'required');
		$this->form_validation->set_rules('stock', 'stock', 'required');
		if($this->form_validation->run())
		{
			$data = array(
				'kdbarang'	=>	$this->input->post('kdbarang'),
				'namabrg'	=>	$this->input->post('namabrg'),
				'harga'	=>	$this->input->post('harga'),
				'stock'		=>	$this->input->post('stock')
			);

			$this->api_model->insert_api($data);

			$array = array(
				'success'		=>	true
			);
		}
		else
		{
			$array = array(
				'error'					=>	true,
				'kdbarang_error'		=>	form_error('kdbarang'),
				'namabrg_error'		=>	form_error('namabrg'),
				'harga_error'		=>	form_error('harga'),
				'stock_error'		=>	form_error('stock')
			);
		}
		echo json_encode($array);
	}
	
	function fetch_single()
	{
		if($this->input->post('kdbarang'))
		{
			$data = $this->api_model->fetch_single_user($this->input->post('kdbarang'));

			foreach($data as $row)
			{
				$output['kdbarang'] = $row['kdbarang'];
				$output['namabrg'] = $row['namabrg'];
				$output['harga'] = $row['harga'];
				$output['stock'] = $row['stock'];
			}
			echo json_encode($output);
		}
	}

	function update()
	{
		// $this->form_validation->set_rules('kdbarang', 'kdbarang', 'required');
		$this->form_validation->set_rules('namabrg', 'namabrg', 'required');

		$this->form_validation->set_rules('harga', 'harga', 'required');

		$this->form_validation->set_rules('stock', 'stock', 'required');
		if($this->form_validation->run())
		{	
			$data = array(
				'kdbarang'		=>	$this->input->post('kdbarang'),
				'namabrg'		=>	$this->input->post('namabrg'),
				'harga'		=>	$this->input->post('harga'),
				'stock'			=>	$this->input->post('stock')
			);

			$this->api_model->update_api($this->input->post('kdbarang'), $data);

			$array = array(
				'success'		=>	true
			);
		}
		else
		{
			$array = array(
				'error'				=>	true,
				'kdbarang_error'	=>	form_error('kdbarang'),
				'namabrg_error'	=>	form_error('namabrg'),
				'harga_error'	=>	form_error('harga'),
				'stock_error'	=>	form_error('stock')
			);
		}
		echo json_encode($array);
	}

	function delete()
	{
		if($this->input->post('id'))
		{
			if($this->api_model->delete_single_user($this->input->post('id')))
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