<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class BarangController extends CI_Controller {

	function index()
	{
		$this->load->view('templates/navbar');
        $this->load->view('templates/setting');
        $this->load->view('templates/sidebar');
		$this->load->view('Barang');
        $this->load->view('templates/footer');
	}

	function action()
	{
		if($this->input->post('data_action'))
		{
			$data_action = $this->input->post('data_action');

			if($data_action == "Delete")
			{
				$api_url = "http://localhost/web-pos-ci/api/ApiBarang/delete";

				$form_data = array(
					'kdbarang'		=>	$this->input->post('kdbarang')
				);

				$client = curl_init($api_url);

				curl_setopt($client, CURLOPT_POST, true);

				curl_setopt($client, CURLOPT_POSTFIELDS, $form_data);

				curl_setopt($client, CURLOPT_RETURNTRANSFER, true);

				$response = curl_exec($client);

				curl_close($client);

				echo $response;




			}

			if($data_action == "Edit")
			{
				$api_url = "http://localhost/web-pos-ci/api/ApiBarang/update";

				$form_data = array(
					'kdbarang'		=>	$this->input->post('kdbarang'),
					'namabrg'		=>	$this->input->post('namabrg'),
					'harga'		=>	$this->input->post('harga'),
					'stock'			=>	$this->input->post('stock')
				);

				$client = curl_init($api_url);

				curl_setopt($client, CURLOPT_POST, true);

				curl_setopt($client, CURLOPT_POSTFIELDS, $form_data);

				curl_setopt($client, CURLOPT_RETURNTRANSFER, true);

				$response = curl_exec($client);

				curl_close($client);

				echo $response;

			}

			if($data_action == "fetch_single")
			{
				$api_url = "http://localhost/web-pos-ci/api/ApiBarang/fetch_single";

				$form_data = array(
					'kdbarang'		=>	$this->input->post('kdbarang')
				);

				$client = curl_init($api_url);

				curl_setopt($client, CURLOPT_POST, true);

				curl_setopt($client, CURLOPT_POSTFIELDS, $form_data);

				curl_setopt($client, CURLOPT_RETURNTRANSFER, true);

				$response = curl_exec($client);

				curl_close($client);

				echo $response;






			}

			if($data_action == "Insert")
			{
				$api_url = "http://localhost/web-pos-ci/api/ApiBarang/insert";
			

				$form_data = array(
					'kdbarang'		=>	$this->input->post('kdbarang'),
					'namabrg'		=>	$this->input->post('namabrg'),
					'harga'		=>	$this->input->post('harga'),
					'stock'			=>	$this->input->post('stock')
				);

				$client = curl_init($api_url);

				curl_setopt($client, CURLOPT_POST, true);

				curl_setopt($client, CURLOPT_POSTFIELDS, $form_data);

				curl_setopt($client, CURLOPT_RETURNTRANSFER, true);

				$response = curl_exec($client);

				curl_close($client);

				echo $response;


			}





			if($data_action == "fetch_all")
			{
				$api_url = "http://localhost/web-pos-ci/api/ApiBarang";

				$client = curl_init($api_url);

				curl_setopt($client, CURLOPT_RETURNTRANSFER, true);

				$response = curl_exec($client);

				curl_close($client);

				$result = json_decode($response);

				$output = '';

				if(count($result) > 0)
				{
					foreach($result as $row)
					{
						$output .= '
						<tr>
							<td>'.$row->kdbarang.'</td>
							<td>'.$row->namabrg.'</td>
							<td>'.$row->harga.'</td>
							<td>'.$row->stock.'</td>
							<td align="center"><button type="button" name="delete" class="btn btn-danger btn-sm delete" id="'.$row->kdbarang.'">Delete</button></td>

						</tr>

						';
					}
				}
				else
				{
					$output .= '
					<tr>
						<td colspan="4" align="center">No Data Found</td>
					</tr>
					';
				}

				echo $output;
			}
		}
	}
	
}

?>