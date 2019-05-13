<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../config/database.php';
include_once '../0objects/tipe.php';
include_once '../0objects/instrumen.php';

$database = new Database();
$db = $database->getConnection();

$tipe = new Tipe($db);

$stmt = $tipe->read();
$num = $stmt->rowCount();

if($num>0){
  $tipes_arr=array();
  $tipes_arr["records"]=array();

  $main = array();
  $json = array();
  $json_instrumen = array();
  //$records = ;
  while($records=$stmt->fetch(PDO::FETCH_ASSOC))
  {
    $id = $records['id'];
    $tipe = $records['tipe'];
    $deskripsi = $records['deskripsi'];
    $json []= array("id" => $id, "tipe" => $tipe,"deskripsi"=>$deskripsi);

    $instrumen = new Instrumen($db);
    $stmt_instrumen = $instrumen->readByTipe($id);

    while($records_instrumen=$stmt_instrumen->fetch(PDO::FETCH_ASSOC)){
      $id_instrumen = $records_instrumen['id'];
      $butir = $records_instrumen['butir'];
      $gambar = $records_instrumen['gambar'];
      $keterangan = $records_instrumen['keterangan'];

      $json_instrumen[] = array("id_instrumen" => $id_instrumen, "butir" => $butir,"gambar"=>$gambar,"keterangan"=>$keterangan);
    }
    // $json['instrumen'] = $json_instrumen;
    $main[]=$json;
    unset($json);
    unset($json_instrumen);
  }
  http_response_code(200);
  echo json_encode($main);

  // echo json_encode($main, JSON_UNESCAPED_SLASHES);
}

else{

  http_response_code(404);
  echo json_encode(
    array("message" => "data masih kosong.".$num)
  );
}
?>
