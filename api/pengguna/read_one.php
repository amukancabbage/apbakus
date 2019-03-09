<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');

include_once '../config/database.php';
include_once '../0objects/pengguna.php';

$database = new Database();
$db = $database->getConnection();

$pengguna = new Pengguna($db);

$pengguna->id = isset($_GET['id']) ? $_GET['id'] : die();
$pengguna->readOne();

if($pengguna->nama_user!=null){

  $pengguna_arr = array(
    "id" => $pengguna->id,
    "nama_user" => $pengguna->nama_user,
    "user_password" => $pengguna->user_password,
    "nama_lengkap" => $pengguna->nama_lengkap,
    "no_kontak" => $pengguna->no_kontak,
    "level" => $pengguna->level,
    "avatar" => $pengguna->avatar,
    "com_code" => $pengguna->com_code,
    "forgot" => $pengguna->forgot
  );

  http_response_code(200);
  echo json_encode($pengguna_arr);
}

else{
  http_response_code(404);
  echo json_encode(array("message" => "Pengguna tidak ditemukan"));
}
?>
