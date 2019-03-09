<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../config/database.php';
include_once '../0objects/sekolah.php';

$database = new Database();
$db = $database->getConnection();

$sekolah = new Sekolah($db);
$data = json_decode(file_get_contents("php://input"));

if(
  !empty($data->status)  &
  !empty($data->nama_sekolah) &
  !empty($data->alamat) &
  !empty($data->kontak)
){

  $sekolah->status = $data->status;
  $sekolah->nama_sekolah = $data->nama_sekolah;
  $sekolah->alamat = $data->alamat;
  $sekolah->kontak = $data->kontak;

  if($sekolah->create()){
    http_response_code(201);
    echo json_encode(array("message" => "Sekolah berhasil disimpan."));
  }
  else{
    http_response_code(503);
    echo json_encode(array("message" => "Sekolah gagal disimpan"));
  }
}else{

  http_response_code(400);
  echo json_encode(array("message" => "Lengkapi Data Sekolah"));
} ?>
