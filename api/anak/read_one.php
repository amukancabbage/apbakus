<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');

include_once '../config/database.php';
include_once '../0objects/anak.php';

$database = new Database();
$db = $database->getConnection();

$anak = new Anak($db);

$anak->id = isset($_GET['id']) ? $_GET['id'] : die();
$anak->readOne();

if($anak->nama!=null){

  $anak_arr = array(
    "id" => $anak->id,
    "nama" => $anak->nama,
    "jenis_kelamin" => $anak->jenis_kelamin,
    "tanggal_lahir" => $anak->tanggal_lahir,
    "nama_ortu" => $anak->nama_ortu,
    "alamat" => $anak->alamat,
    "no_kontak" => $anak->no_kontak,
    "id_sekolah" => $anak->id_sekolah,
    "id_pengguna" => $anak->id_pengguna,
    "username" => $anak->username,
    "password" => $anak->password
  );

  http_response_code(200);
  echo json_encode($anak_arr);
}

else{
  http_response_code(404);
  echo json_encode(array("message" => "Anak tidak ditemukan"));
}
?>
