<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../config/database.php';
include_once '../0objects/instrumen.php';

$database = new Database();
$db = $database->getConnection();
$instrumen = new Instrumen($db);

$data = json_decode(file_get_contents("php://input"));
$instrumen->id = $data->id;
$instrumen->status = $data->status;
$instrumen->butir = $data->butir;
$instrumen->gambar = $data->gambar;
$instrumen->keterangan = $data->keterangan;
$instrumen->id_kategori = $data->id_kategori;

if($instrumen->update()){
  http_response_code(200);
  // echo json_encode(array("message" => "Instrumen Sudah Diubah."));
}else{
  http_response_code(503);
  // echo json_encode(array("message" => "Instrumen GAGAL Diubah."));
}
?>
