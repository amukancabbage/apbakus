<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../config/database.php';
include_once '../0objects/instrumen.php';

$database = new Database();
$db = $database->getConnection();

$instrumen = new Instrumen($db);

$stmt = $instrumen->read();
$num = $stmt->rowCount();

if($num>0){
  $instrumens_arr=array();
  $instrumens_arr["records"]=array();

  while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
    extract($row);
    $instrumen_item=array(
      "id" => $id,
      "created_at" => $created_at,
      "updated_at" => $updated_at,
      "status" => $status,
      "butir" => $butir,
      "gambar" => $gambar,
      "keterangan" => $keterangan,
      "id_kategori" => $id_kategori);

      array_push($instrumens_arr["records"], $instrumen_item);
    }

    http_response_code(200);
    echo json_encode($instrumens_arr);
  }

  else{

    http_response_code(404);
    echo json_encode(
      array("message" => "data masih kosong.")
    );
  }
  ?>
