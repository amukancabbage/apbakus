<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../config/database.php';
include_once '../0objects/sekolah.php';

$database = new Database();
$db = $database->getConnection();

$sekolah = new Sekolah($db);

$stmt = $sekolah->read();
$num = $stmt->rowCount();

if($num>0){
  $sekolahs_arr=array();
  $sekolahs_arr["records"]=array();

  while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
    extract($row);
    $sekolah_item=array(
      "id" => $id,
      "created_at" => $created_at,
      "updated_at" => $updated_at,
      "status" => $status,
      "nama_sekolah" => $nama_sekolah,
      "alamat" => $alamat,
      "kontak" => $kontak);

      array_push($sekolahs_arr["records"], $sekolah_item);
    }

    http_response_code(200);
    echo json_encode($sekolahs_arr);
  }

  else{

    http_response_code(404);
    echo json_encode(
      array("message" => "data masih kosong.")
    );
  }
  ?>
