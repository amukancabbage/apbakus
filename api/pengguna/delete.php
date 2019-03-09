<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../config/database.php';
include_once '../0objects/pengguna.php';

$database = new Database();
$db = $database->getConnection();
$pengguna = new Pengguna($db);
$data = json_decode(file_get_contents("php://input"));
$pengguna->id = $data->id;

if($pengguna->delete()){

  http_response_code(200);
  echo json_encode(array("message" => "Pengguna sudah dihapus."));
}else{
  http_response_code(503);
  echo json_encode(array("message" => "Pengguna GAGAL dihapus."));
} ?>
