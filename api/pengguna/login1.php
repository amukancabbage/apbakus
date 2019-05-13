<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../config/database.php';
include_once '../0objects/pengguna.php';

$database = new Database();
$db = $database->getConnection();

$pengguna = new Pengguna($db);

$pengguna->nama_user=isset($_GET["nama_user"]) ? $_GET["nama_user"] : "";
$pengguna->user_password=isset($_GET["user_password"]) ? $_GET["user_password"] : "";

$stmt = $pengguna->readAnak();
$num = $stmt->rowCount();

if($num>0){

  $penggunas_arr=array();
  $penggunas_arr["records"]=array();

  while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
    extract($row);
    $pengguna_item=array(
      "id_user" => $id_user,
      "id_anak" => $id_anak,
      "nama" => $nama,
      "jumlah_pengguna" => $jumlah_pengguna);

      array_push($penggunas_arr["records"], $pengguna_item);
  }

  http_response_code(200);
  echo json_encode($penggunas_arr);
}

else{
  http_response_code(404);
  echo json_encode(
    array("message" => "No anak found.")
  );
}
?>
