<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../config/database.php';
include_once '../0objects/guru.php';

$database = new Database();
$db = $database->getConnection();

$guru = new Guru($db);

$stmt = $guru->read();
$num = $stmt->rowCount();

if($num>0){
  $gurus_arr=array();
  $gurus_arr["records"]=array();

  while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
    extract($row);
    $guru_item=array(
      "id" => $id,
      "created_at" => $created_at,
      "updated_at" => $updated_at,
      "status" => $status,
      "id_pengguna" => $id_pengguna,
      "alamat" => $alamat,
      "kontak" => $kontak,
      "id_sekolah" => $id_sekolah);

      array_push($gurus_arr["records"], $guru_item);
    }

    http_response_code(200);
    echo json_encode($gurus_arr);
  }

  else{

    http_response_code(404);
    echo json_encode(
      array("message" => "data masih kosong.")
    );
  }
  ?>
