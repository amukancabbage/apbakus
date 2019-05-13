<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');

include_once '../config/database.php';
include_once '../0objects/asesmen_detail.php';

$database = new Database();
$db = $database->getConnection();

$asesmen_detail = new Asesmen_detail($db);

$asesmen_detail->id = isset($_GET['id']) ? $_GET['id'] : die();
$asesmen_detail->readOne();

if($asesmen_detail->id_asesmen!=null){

  $asesmen_detail_arr = array(
    "id" => $asesmen_detail->id,
    "id_asesmen" => $asesmen_detail->id_asesmen,
    "id_instrumen" => $asesmen_detail->id_instrumen,
    "hasil" => $asesmen_detail->hasil,
    "catatan" => $asesmen_detail->catatan
  );

  http_response_code(200);
  echo json_encode($asesmen_detail_arr);
}

else{
  http_response_code(404);
  echo json_encode(array("message" => "Asesmen_detail tidak ditemukan"));
}
?>
