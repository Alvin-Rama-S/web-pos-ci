<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PenjualanController extends CI_Controller {

	function index()
	{
		$this->load->view('templates/navbar');
        $this->load->view('templates/setting');
        $this->load->view('templates/sidebar');
		$this->load->view('Penjualan');
        $this->load->view('templates/footer');
	}

	function action()
	{
		if($this->input->post('data_action'))
		{
			$data_action = $this->input->post('data_action');

			if($data_action == "Delete")
			{
				$api_url = "http://localhost/web-pos-ci/api/ApiPenjualan/delete";

				$form_data = array(
					'idjual'		=>	$this->input->post('idjual')
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
				$api_url = "http://localhost/web-pos-ci/api/ApiPenjualan/update";

				$form_data = array(
					'idjual'		=>	$this->input->post('idjual'),
					'kdbarang'		=>	$this->input->post('kdbarang'),
					'tgljual'		=>	$this->input->post('tgljual'),
					'jumlah'			=>	$this->input->post('jumlah')
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
				$api_url = "http://localhost/web-pos-ci/api/ApiPenjualan/fetch_single";

				$form_data = array(
					'idjual'		=>	$this->input->post('idjual')
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
				$api_url = "http://localhost/web-pos-ci/api/ApiPenjualan/insert";
			

				$form_data = array(
					'idjual'		=>	$this->input->post('idjual'),
					'kdbarang'		=>	$this->input->post('kdbarang'),
					'tgljual'		=>	$this->input->post('tgljual'),
					'jumlah'			=>	$this->input->post('jumlah')
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
				$api_url = "http://localhost/web-pos-ci/api/ApiPenjualan";

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
							<td>'.$row->idjual.'</td>
							<td>'.$row->kdbarang.'</td>
							<td>'.$row->tgljual.'</td>
							<td>'.$row->jumlah.'</td>
							<td align="center"><button type="button" name="edit" class="btn btn-warning btn-sm edit" id="'.$row->idjual.'">Edit</button>
							<button type="button" name="delete" class="btn btn-danger btn-sm delete" id="'.$row->idjual.'">Delete</button></td>
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