<?php

defined('BASEPATH') OR exit('No direct script access allowed');
class Produk_model extends CI_Model {
    function get_data_produk() {
        $this->db->from("produk");
        if (!empty($this->input->get("kategori"))) {
            $this->db->where("kategori",$this->input->get("kategori"));
        }
        $status = !empty($this->input->get("status")) ? $this->input->get("status") : "dijual";
        switch ($status) {
            case 'dijual':
                $this->db->where("status","bisa dijual");
                break;
            case 'tidak_dijual':
                $this->db->where("status","tidak bisa dijual");
                break;
        }
        return $this->db->get()->result();
    }

    function get_category_product() {
        return $this->db->from("produk")
            ->select("kategori")
            ->group_by("kategori")
            ->get()->result();
    }

    function insert_or_update_product() {
        $data = [
            "id_produk" =>  $this->input->post("id_produk"),
            "nama_produk" =>  $this->input->post("nama_produk"),
            "kategori" =>  $this->input->post("kategori"),
            "status" =>  $this->input->post("status"),
            "harga" =>  clean_currency($this->input->post("harga")),
        ];
        if (!empty($this->input->post("id"))) {
            $this->db->update("produk",$data,["id"=>$this->input->post("id")]);
        }else{
            $this->db->insert("produk",$data);
        }
        return $this->db->affected_rows();
    }
}