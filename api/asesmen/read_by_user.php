<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../config/database.php';
include_once '../0objects/asesmen.php';

$database = new Database();
$db = $database->getConnection();

$asesmen = new Asesmen($db);

$asesmen->id_user=isset($_GET["id_pengguna"]) ? $_GET["id_pengguna"] : "";

$stmt = $asesmen->readByUser();
$num = $stmt->rowCount();

if($num>0){

  $asesmens_arr=array();
  $asesmens_arr["records"]=array();

  while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
    extract($row);
    $asesmen_item=array(  
      "id" => $id_azezmen,
      "id_azezmen" => $id_azezmen,
      "id_user" => $id_user,
      "id_anak" => $id_anak,
      "nama" => $nama,
      "tipe" => $tipe,
      "id_tipe" => $id_tipe,
      "hasil_akhir" => $hasil_akhir,
      "catatan_akhir" => $catatan_akhir,
      "tanggal_lahir" => $tanggal_lahir,
      "tanggal_asesmen" => $tanggal_asesmen,
      "usia" => $usia);

      array_push($asesmens_arr["records"], $asesmen_item);
  }

  http_response_code(200);
  echo json_encode($asesmens_arr);
}

else{
  http_response_code(404);
  echo json_encode(
    array("message" => "No anak found.")
  );
}
?>
