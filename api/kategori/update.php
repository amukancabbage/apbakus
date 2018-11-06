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
$kategori->id = $data->id;
$kategori->kategori_instrumen = $data->kategori_instrumen;
$kategori->deskripsi = $data->deskripsi;

if($kategori->update()){
  http_response_code(200);
  echo json_encode(array("message" => "Product was updated."));
}else{
  http_response_code(503);
  echo json_encode(array("message" => "Unable to update kategori."));
}
?>
