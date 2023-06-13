<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');
class Api extends CI_Controller {
    function index() {
        render("api/index");
    }

    function setup_product_from_api() {
		/* Endpoint */
        $url = 'https://recruitment.fastprint.co.id/tes/api_tes_programmer';

		$date = date("d", time() + 3600);
		$month = date("m", time() + 3600);
		$year = date("y", time() + 3600);
		$hour = date("H", time() + 3600);
		$username = "tesprogrammer$date$month$year"."C".$hour;
		$password = md5("bisacoding-$date-$month-$year");
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

		if ($http_status == 200) {
            $response = json_decode($response);
            $this->db->empty_table("produk");
            foreach ($response->data as $product_data) {
                
                $this->db->insert("produk",[
                    "id_produk"		=>	$product_data->id_produk,
                    "nama_produk"		=>	$product_data->nama_produk,
                    "kategori"		=>	$product_data->kategori,
                    "harga"		=>	$product_data->harga,
                    "status"		=>	$product_data->status,
                ]);
            }   
            echo json_encode([
                "status"    =>  200,
                "message"   =>  "Request data dari API berhasil"
            ]);
        }else{
            echo json_encode([
                "status"    =>  400,
                "message"   =>  "Request data dari API gagal. Silahkan hubungi administrator"
            ]);
        }
		

		// $products = $this->db->get("produk")->result();
		// echo "<pre>";
		// print_r($products);
		// echo "</pre>";
	}
}