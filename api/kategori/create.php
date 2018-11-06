<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
include_once '../config/database.php';
include_once '../objects/kategori.php';
 
$database = new Database();
$db = $database->getConnection();
 
$kategori = new Kategori($db);
$data = json_decode(file_get_contents("php://input"));
 
if(
    !empty($data->kategori_instrumen) &&
    !empty($data->deskripsi)
){
 
    $kategori->kategori_instrumen = $data->kategori_instrumen;
    $kategori->deskripsi = $data->deskripsi;
 
    if($kategori->create()){
        http_response_code(201);
        echo json_encode(array("message" => "Kategori berhasil disimpan."));
    }
 
    else{
        http_response_code(503);
        echo json_encode(array("message" => "Kategori gagal disimpan"));
    }
}
 
else{
 
    http_response_code(400);
    echo json_encode(array("message" => "Lengkapi Data Kategori"));
}
?>