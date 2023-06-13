<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');
class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/userguide3/general/urls.html
	 */
	public function index()
	{
		// $this->load->view("_includes/index");
		render("_includes/_blank");
	}

	function setup_product_from_api() {
		/* Endpoint */
        $url = 'https://recruitment.fastprint.co.id/tes/api_tes_programmer';

		$date = date("d");
		$month = date("m");
		$year = date("y");
		$hour = date("H", time() + 3600);
		$username = "tesprogrammer$date$month$year"."C".$hour;
		$password = md5("bisacoding-$date-$month-$year");
		$password = md5("bisacodinga-$date-$month-$year");

		$curl = curl_init();

		curl_setopt_array($curl, array(
			CURLOPT_URL => $url,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => '',
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 0,
			CURLOPT_FOLLOWLOCATION => true,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => 'POST',
			// CURLOPT_POSTFIELDS => array('username' => 'tesprogrammer110623C22','password' => 'ec3f23841cc59f98779595e615e2aa5b'),
			CURLOPT_POSTFIELDS => array('username' => $username,'password' => $password),
			CURLOPT_HTTPHEADER => array(
				'Cookie: ci_session=hdh5q3gtlru3700t7ol6lniloj6gafdr'
			),
		));

		$response = curl_exec($curl);
		$http_status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
		curl_close($curl);
		echo "<pre>";
		// print_r(json_decode($response));
		echo $http_status;
		echo "</pre>";
		return false;
		$response = json_decode($response);
		foreach ($response->data as $product_data) {
			$this->db->delete("produk",['id_produk'=>$product_data->id_produk]);
			
			$this->db->insert("produk",[
				"id_produk"		=>	$product_data->id_produk,
				"nama_produk"		=>	$product_data->nama_produk,
				"kategori"		=>	$product_data->kategori,
				"harga"		=>	$product_data->harga,
				"status"		=>	$product_data->status,
			]);
		}

		$products = $this->db->get("produk")->result();
		echo "<pre>";
		print_r($products);
		echo "</pre>";
	}
}
