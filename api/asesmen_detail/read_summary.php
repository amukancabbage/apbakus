<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../config/database.php';
include_once '../0objects/asesmen_detail.php';

$database = new Database();
$db = $database->getConnection();

$asesmen_detail = new Asesmen_detail($db);
$asesmen_detail->id_asesmen = isset($_POST['id_asesmen']) ? $_POST['id_asesmen'] : die();
// $asesmen_detail->id_asesmen = 16;

$stmt = $asesmen_detail->readSummary();
$num = $stmt->rowCount();

if($num>0){
  $asesmen_details_arr=array();
  $asesmen_details_arr["records"]=array();

  while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
    extract($row);
    $asesmen_detail_item=array(
      "kategori_instrumen" => $kategori_instrumen,
      "jumlah_mampu" => $jumlah_mampu,
      "jumlah_tidak" => $jumlah_tidak,
      "jumlah" => $jumlah,
      "per" => $per,
      "persen" => $persen);

      array_push($asesmen_details_arr["records"], $asesmen_detail_item);
    }

    http_response_code(200);
    echo json_encode($asesmen_details_arr);
  }

  else{

    http_response_code(404);
    echo json_encode(
      array("message" => "data masih kosong.")
    );
  }
  ?>
