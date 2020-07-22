<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../config/database.php';
include_once '../0objects/asesmen_detail.php';
include_once '../0objects/kategori.php';

$database = new Database();
$db = $database->getConnection();


$kategori = new Kategori($db);
$kategori->id_tipe = isset($_GET['id_tipe']) ? $_GET['id_tipe'] : die();

$asesmen_detail = new Asesmen_detail($db);
$asesmen_detail->id_asesmen = isset($_GET['id_asesmen']) ? $_GET['id_asesmen'] : die();

$stmt = $kategori->readByTipe();
$num = $stmt->rowCount();

if($num>0){
  $kategoris_arr=array();
  $kategoris_arr["records"]=array();

  while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
    extract($row);

    $stmt2 = $asesmen_detail->readByAsesmenKategori($id);
    $num2 = $stmt2->rowCount();

    if($num2>0){
      $asesmen_details_arr=array();
      // $asesmen_details_arr["details"]=array();

      while ($row2 = $stmt2->fetch(PDO::FETCH_ASSOC)){
        extract($row2);
        $asesmen_detail_item=array(
          "id_kategori_instrumen" => $id_kategori_instrumen,
          "kategori_instrumen" => $kategori_instrumen,
          "id_instrumen" => $id_instrumen,
          "butir" => $butir,
          "id_asesmen" => $id_asesmen,
          "id" => $id,
          "hasil" => $hasil);

          array_push($asesmen_details_arr, $asesmen_detail_item);
      }
    }

    $kategori_item=array(
      "kategori_instrumen" => $kategori_instrumen,
      "deskripsi" => $deskripsi,
      "id_tipe" => $id_tipe,
      "details"=>$asesmen_details_arr);
      array_push($kategoris_arr["records"], $kategori_item);
    }

    http_response_code(200);
    var_dump($kategoris_arr);
    echo json_encode($kategoris_arr);
  }

  else{

    http_response_code(404);
    echo json_encode(
      array("message" => "data masih kosong.")
    );
  }
  ?>
