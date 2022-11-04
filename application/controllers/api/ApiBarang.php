<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ApiBarang extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('ModelBarang');
		$this->load->library('form_validation');
	}

	function index()
	{
		$data = $this->ModelBarang->fetch_all();
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

			$this->ModelBarang->insert_api($data);

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
			$data = $this->ModelBarang->fetch_single_user($this->input->post('kdbarang'));

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

			$this->ModelBarang->update_api($this->input->post('kdbarang'), $data);

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
		if($this->input->post('kdbarang'))
		{
			if($this->ModelBarang->delete_single_user($this->input->post('kdbarang')))
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