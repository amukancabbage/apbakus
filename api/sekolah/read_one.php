<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');

include_once '../config/database.php';
include_once '../0objects/sekolah.php';

$database = new Database();
$db = $database->getConnection();

$sekolah = new Sekolah($db);

$sekolah->id = isset($_GET['id']) ? $_GET['id'] : die();
$sekolah->readOne();

if($sekolah->nama_sekolah!=null){

  $sekolah_arr = array(
    "id" => $sekolah->id,
    "nama_sekolah" => $sekolah->nama_sekolah,
    "alamat" => $sekolah->alamat,
    "kontak" => $sekolah->kontak
  );

  http_response_code(200);
  echo json_encode($sekolah_arr);
}

else{
  http_response_code(404);
  echo json_encode(array("message" => "Sekolah tidak ditemukan"));
}
?>
