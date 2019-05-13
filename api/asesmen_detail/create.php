<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../config/database.php';
include_once '../0objects/asesmen_detail.php';

$database = new Database();
$db = $database->getConnection();

$asesmen_detail = new Asesmen_detail($db);
$data = json_decode(file_get_contents("php://input"));

if(
  !empty($data->status)  &
  !empty($data->id_asesmen) &
  !empty($data->id_instrumen) &
  !empty($data->hasil) &
  !empty($data->catatan)
){

  $asesmen_detail->status = $data->status;
  $asesmen_detail->id_asesmen = $data->id_asesmen;
  $asesmen_detail->id_instrumen = $data->id_instrumen;
  $asesmen_detail->hasil = $data->hasil;
  $asesmen_detail->catatan = $data->catatan;

  if($asesmen_detail->create()){
    http_response_code(201);
    echo json_encode(array("message" => "Asesmen_detail berhasil disimpan."));
  }
  else{
    http_response_code(503);
    echo json_encode(array("message" => "Asesmen_detail gagal disimpan"));
  }
}else{

  http_response_code(400);
  echo json_encode(array("message" => "Lengkapi Data Asesmen_detail"));
} ?>
