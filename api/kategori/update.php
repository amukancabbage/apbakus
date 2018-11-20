<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../config/database.php';
include_once '../0objects/kategori.php';

$database = new Database();
$db = $database->getConnection();
$kategori = new Kategori($db);

$data = json_decode(file_get_contents("php://input"));
$kategori->id = $data->id;
$kategori->status = $data->status;
$kategori->kategori_instrumen = $data->kategori_instrumen;
$kategori->deskripsi = $data->deskripsi;
$kategori->id_tipe = $data->id_tipe;

if($kategori->update()){
  http_response_code(200);
  // echo json_encode(array("message" => "Kategori Sudah Diubah."));
}else{
  http_response_code(503);
  // echo json_encode(array("message" => "Kategori GAGAL Diubah."));
}
?>
