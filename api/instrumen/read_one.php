<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');

include_once '../config/database.php';
include_once '../0objects/instrumen.php';

$database = new Database();
$db = $database->getConnection();

$instrumen = new Instrumen($db);

$instrumen->id = isset($_GET['id']) ? $_GET['id'] : die();
$instrumen->readOne();

if($instrumen->butir!=null){

  $instrumen_arr = array(
    "id" => $instrumen->id,
    "butir" => $instrumen->butir,
    "gambar" => $instrumen->gambar,
    "keterangan" => $instrumen->keterangan,
    "id_kategori" => $instrumen->id_kategori
  );

  http_response_code(200);
  echo json_encode($instrumen_arr);
}

else{
  http_response_code(404);
  echo json_encode(array("message" => "Instrumen tidak ditemukan"));
}
?>
