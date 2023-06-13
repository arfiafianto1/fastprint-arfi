<?php
function render($view,$data = [],$pagetitle = "",$breadcrumbs = []) {
    $ci = get_instance();
    // global $ci;
    $data += [
        "content_file"  => $view,
        "page_title"    =>  $pagetitle,
        "breadcrumbs"    =>  $breadcrumbs,
    ];
    $ci->load->view("_includes/index",$data);
}

function to_currency($number,$decimal = 0) {
    return number_format($number,$decimal,",",".");
}

function clean_currency($formatted_money) {
    $formatted_money = str_replace(".","",$formatted_money);
    $formatted_money = str_replace(",",".",$formatted_money);
    return $formatted_money;
}