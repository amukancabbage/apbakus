<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../config/database.php';
include_once '../0objects/asesmen.php';

$database = new Database();
$db = $database->getConnection();

$asesmen = new Asesmen($db);

$asesmen->id=isset($_POST["id_asesmen"]) ? $_POST["id_asesmen"] : "";

$stmt = $asesmen->readNote();
$num = $stmt->rowCount();

if($num>0){

  $asesmens_arr=array();
  $asesmens_arr["records"]=array();
  $cat = "";
  while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
    extract($row);
    $cat = $catatan_akhir;
    // $asesmen_item=array(
    //   "id" => $id,
    //   "keterangan" => $keterangan);
    //
    //   array_push($asesmens_arr["records"], $asesmen_item);
  }

  http_response_code(200);
  $minfo = array("success"=>'true', "message"=>$cat);
  $jsondata = json_encode($minfo);
  echo $jsondata;

}

else{
  http_response_code(404);
  $minfo = array("success"=>'false', "message"=>"Assessment Data Not Found");
  $jsondata = json_encode($minfo);
  echo $jsondata;
}
?>
