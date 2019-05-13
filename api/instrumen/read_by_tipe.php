<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../config/database.php';
include_once '../0objects/instrumen.php';

$database = new Database();
$db = $database->getConnection();

$instrumen = new Instrumen($db);

$id_tipe = isset($_GET['id_tipe']) ? $_GET['id_tipe'] : die();
$stmt = $instrumen->readByTipe($id_tipe);
$num = $stmt->rowCount();

if($num>0){
  $instrumens_arr=array();
  $instrumens_arr["records"]=array();

  while($records=$stmt->fetch(PDO::FETCH_ASSOC))
  {
    $id = $records['id'];
    $butir = $records['butir'];
    $gambar = $records['gambar'];
    $keterangan = $records['keterangan'];
    $json1 []= array("id" => $id, "butir" => $butir,"gambar"=>$gambar,"keterangan"=>$keterangan);
  }
  http_response_code(200);
  echo json_encode($json1);

  // echo json_encode($main, JSON_UNESCAPED_SLASHES);
}

else{

  http_response_code(404);
  echo json_encode(
    array("message" => "data masih kosong.")
  );
}
?>
