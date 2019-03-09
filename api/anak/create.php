<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../config/database.php';
include_once '../0objects/anak.php';

$database = new Database();
$db = $database->getConnection();

$anak = new Anak($db);
$data = json_decode(file_get_contents("php://input"));

if(
  !empty($data->status)  &
  !empty($data->nama) &
  !empty($data->jenis_kelamin) &
  !empty($data->tanggal_lahir) &
  !empty($data->nama_ortu) &
  !empty($data->alamat) &
  !empty($data->no_kontak) &
  !empty($data->id_sekolah) &
  !empty($data->id_pengguna) &
  !empty($data->username) &
  !empty($data->password)
){

  $anak->status = $data->status;
  $anak->nama = $data->nama;
  $anak->jenis_kelamin = $data->jenis_kelamin;
  $anak->tanggal_lahir = $data->tanggal_lahir;
  $anak->nama_ortu = $data->nama_ortu;
  $anak->alamat = $data->alamat;
  $anak->no_kontak = $data->no_kontak;
  $anak->id_sekolah = $data->id_sekolah;
  $anak->id_pengguna = $data->id_pengguna;
  $anak->username = $data->username;
  $anak->password = $data->password;

  if($anak->create()){
    http_response_code(201);
    echo json_encode(array("message" => "Anak berhasil disimpan."));
  }
  else{
    http_response_code(503);
    echo json_encode(array("message" => "Anak gagal disimpan"));
  }
}else{

  http_response_code(400);
  echo json_encode(array("message" => "Lengkapi Data Anak"));
} ?>
