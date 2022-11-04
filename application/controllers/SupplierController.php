<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SupplierController extends CI_Controller {

	function index()
	{
		$this->load->view('templates/navbar');
        $this->load->view('templates/setting');
        $this->load->view('templates/sidebar');
		$this->load->view('Supplier');
        $this->load->view('templates/footer');
	}

	function action()
	{
		if($this->input->post('data_action'))
		{
			$data_action = $this->input->post('data_action');

			if($data_action == "Delete")
			{
				$api_url = "http://localhost/web-pos-ci/api/ApiSupplier/delete";

				$form_data = array(
					'idsupplier'		=>	$this->input->post('idsupplier')
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
				$api_url = "http://localhost/web-pos-ci/api/ApiSupplier/update";

				$form_data = array(
					'idsupplier'		=>	$this->input->post('idsupplier'),
					'kdbarang'		=>	$this->input->post('kdbarang'),
					'tglpemasukan'		=>	$this->input->post('tglpemasukan'),
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
				$api_url = "http://localhost/web-pos-ci/api/ApiSupplier/fetch_single";

				$form_data = array(
					'idsupplier'		=>	$this->input->post('idsupplier')
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
				$api_url = "http://localhost/web-pos-ci/api/ApiSupplier/insert";
			

				$form_data = array(
					'idsupplier'		=>	$this->input->post('idsupplier'),
					'kdbarang'		=>	$this->input->post('kdbarang'),
					'tglpemasukan'		=>	$this->input->post('tglpemasukan'),
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
				$api_url = "http://localhost/web-pos-ci/api/ApiSupplier";

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
							<td>'.$row->idsupplier.'</td>
							<td>'.$row->kdbarang.'</td>
							<td>'.$row->tglpemasukan.'</td>
							<td>'.$row->jumlah.'</td>
							<td align="center"><button type="button" name="edit" class="btn btn-warning btn-sm edit" id="'.$row->idsupplier.'">Edit</button>
							<button type="button" name="delete" class="btn btn-danger btn-sm delete" id="'.$row->idsupplier.'">Delete</button></td>
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