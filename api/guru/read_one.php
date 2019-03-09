<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');

include_once '../config/database.php';
include_once '../0objects/guru.php';

$database = new Database();
$db = $database->getConnection();

$guru = new Guru($db);

$guru->id = isset($_GET['id']) ? $_GET['id'] : die();
$guru->readOne();

if($guru->id_pengguna!=null){

  $guru_arr = array(
    "id" => $guru->id,
    "id_pengguna" => $guru->id_pengguna,
    "alamat" => $guru->alamat,
    "kontak" => $guru->kontak,
    "id_sekolah" => $guru->id_sekolah
  );

  http_response_code(200);
  echo json_encode($guru_arr);
}

else{
  http_response_code(404);
  echo json_encode(array("message" => "Guru tidak ditemukan"));
}
?>
