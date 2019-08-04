<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../config/database.php';
include_once '../0objects/kategori.php';

$database = new Database();
$db = $database->getConnection();

$kategori = new Kategori($db);
$kategori->id_tipe = isset($_GET['id_tipe']) ? $_GET['id_tipe'] : die();

$stmt = $kategori->readByTipe();
$num = $stmt->rowCount();

if($num>0){
  $kategoris_arr=array();
  $kategoris_arr["records"]=array();

  while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
    extract($row);
    $kategori_item=array(
      "id" => $id,
      "created_at" => $created_at,
      "updated_at" => $updated_at,
      "status" => $status,
      "kategori_instrumen" => $kategori_instrumen,
      "deskripsi" => $deskripsi,
      "id_tipe" => $id_tipe);

      array_push($kategoris_arr["records"], $kategori_item);
    }

    http_response_code(200);
    echo json_encode($kategoris_arr);
  }

  else{

    http_response_code(404);
    echo json_encode(
      array("message" => "data masih kosong.")
    );
  }
  ?>
