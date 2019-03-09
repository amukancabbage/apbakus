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

if(
  !empty($data->status)  &
  !empty($data->butir) &
  !empty($data->gambar) &
  !empty($data->keterangan) &
  !empty($data->id_kategori)
){

  $instrumen->status = $data->status;
  $instrumen->butir = $data->butir;
  $instrumen->gambar = $data->gambar;
  $instrumen->keterangan = $data->keterangan;
  $instrumen->id_kategori = $data->id_kategori;

  if($instrumen->create()){
    http_response_code(201);
    echo json_encode(array("message" => "Instrumen berhasil disimpan."));
  }
  else{
    http_response_code(503);
    echo json_encode(array("message" => "Instrumen gagal disimpan"));
  }
}else{

  http_response_code(400);
  echo json_encode(array("message" => "Lengkapi Data Instrumen"));
} ?>
