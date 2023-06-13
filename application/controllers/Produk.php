<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Produk extends CI_Controller {
    // private function default_header() {
    //     return [
    //         "pagetitle"     =>  "Data Produk",
    //         "breadcrumbs"   => [ "Produk" => base_url("produk") ]
    //     ];
    // }
    function __construct(){
        parent::__construct();
        $this->load->model("Produk_model","mproduk");
    }
    function index() {
        
        $data['products'] = $this->mproduk->get_data_produk();
        $data["categories"] = $this->mproduk->get_category_product();
        render("produk/index",$data);
    }

    function delete($id) {
        $this->db->delete("produk",["id"=>$id]);
        if ($this->db->affected_rows() > 0) {
            echo json_encode(["status"=>200, "message" => "Data Produk berhasil dihapus"]);
        }else{
            echo json_encode(["status"=>400, "message" => "Data Produk gagal dihapus"]);
        }
    }

    function new() {
        $data['title'] = "Produk Baru";
        $data["categories"] = $this->mproduk->get_category_product();
        render("produk/form",$data);
    }

    function edit($id) {
        $data['title'] = "Edit Data Produk";
        $data['product'] = $this->db->get_where("produk",["id"=>$id])->row();
        $data["categories"] = $this->mproduk->get_category_product();
        render("produk/form",$data);
    }

    function save() {
        // $this->input->post("harga") = 0;
        $this->load->library("form_validation");
        $this->form_validation->set_error_delimiters('', '');
        $this->form_validation->set_rules('id_produk', 'ID Produk', 'trim|required|callback_id_check');
        $this->form_validation->set_rules('nama_produk', 'Nama Produk', 'trim|required');
        $this->form_validation->set_rules('harga', 'Harga Produk', 'trim|required|callback_price_check');
        $errors = [];
        if ($this->form_validation->run() == FALSE) {
            foreach ($this->input->post() as $column => $value) {
                if (!empty(form_error($column))) {
                    $errors[$column] = form_error($column);
                }
            }
            echo json_encode([
                "status"        =>  400,
                "errors"        =>  $errors,
                "table_name"    =>  "produk"
            ]);
        } else {
            $submit = $this->mproduk->insert_or_update_product();
            if ($submit > 0) {
                echo json_encode([
                    "status"    =>  200,
                    "message"   =>  "Data Produk berhasil disimpan",
                    "url"       =>  base_url()
                ]);    
            }else{
                echo json_encode([
                    "status"    =>  401,
                    "message"   =>  "Data Produk gagal disimpan atau tidak ada perubahan apapun"
                ]);    
            }
        }
    }

    public function price_check($price){
        $price = clean_currency($price);
            if ((int)$price > 0){
                return TRUE;
            }else{
                $this->form_validation->set_message('price_check', '{field} harus berupa angka dan tidak boleh 0');
                return FALSE;
            }
    }
    public function id_check($id_produk){
        $this->db->from("produk");
        $this->db->where("id_produk",$id_produk);
        if (!empty($this->input->post("id"))) {
            $this->db->where("id !=",$this->input->post("id"));
        }
        if ($this->db->get()->num_rows() > 0) {
            $this->form_validation->set_message('id_check', '{field} tersebut sudah dipakai oleh Produk lain. Silahkan masukkan ID yang lain');
            return FALSE;
        };

        return TRUE;
    }
}