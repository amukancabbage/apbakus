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
$pengguna->status = $data->status;
$pengguna->nama_user = $data->nama_user;
$pengguna->user_password = $data->user_password;
$pengguna->nama_lengkap = $data->nama_lengkap;
$pengguna->no_kontak = $data->no_kontak;
$pengguna->level = $data->level;
$pengguna->avatar = $data->avatar;
$pengguna->com_code = $data->com_code;
$pengguna->forgot = $data->forgot;

if($pengguna->update()){
  http_response_code(200);
  // echo json_encode(array("message" => "Pengguna Sudah Diubah."));
}else{
  http_response_code(503);
  // echo json_encode(array("message" => "Pengguna GAGAL Diubah."));
}
?>
