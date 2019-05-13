<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../config/database.php';
include_once '../0objects/anak.php';

$database = new Database();
$db = $database->getConnection();

$anak = new Anak($db);
$anak->id_pengguna = isset($_GET['id_pengguna']) ? $_GET['id_pengguna'] : die();
$keywords=isset($_GET["s"]) ? $_GET["s"] : "";

$stmt = $anak->search($keywords);
$num = $stmt->rowCount();

if($num>0){

  $anaks_arr=array();
  $anaks_arr["records"]=array();

  while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
    extract($row);
    $anak_item=array(
      "id" => $id,
      "created_at" => $created_at,
      "updated_at" => $updated_at,
      "status" => $status,
      "nama" => $nama,
      "jenis_kelamin" => $jenis_kelamin,
      "tanggal_lahir" => $tanggal_lahir,
      "nama_ortu" => $nama_ortu,
      "alamat" => $alamat,
      "no_kontak" => $no_kontak,
      "id_sekolah" => $id_sekolah,
      "id_pengguna" => $id_pengguna,
      "username" => $username,
      "password" => $password);

      array_push($anaks_arr["records"], $anak_item);
  }

  http_response_code(200);
  echo json_encode($anaks_arr);
}

else{
  http_response_code(404);
  echo json_encode(
    array("message" => "No anak found.")
  );
}
?>
