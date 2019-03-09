<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../config/database.php';
include_once '../0objects/guru.php';

$database = new Database();
$db = $database->getConnection();
$guru = new Guru($db);

$data = json_decode(file_get_contents("php://input"));
$guru->id = $data->id;
$guru->status = $data->status;
$guru->id_pengguna = $data->id_pengguna;
$guru->alamat = $data->alamat;
$guru->kontak = $data->kontak;
$guru->id_sekolah = $data->id_sekolah;

if($guru->update()){
  http_response_code(200);
  // echo json_encode(array("message" => "Guru Sudah Diubah."));
}else{
  http_response_code(503);
  // echo json_encode(array("message" => "Guru GAGAL Diubah."));
}
?>
