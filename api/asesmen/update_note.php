<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../config/database.php';
include_once '../0objects/asesmen.php';

$database = new Database();
$db = $database->getConnection();
$asesmen = new Asesmen($db);
// $data = json_decode(file_get_contents("php://input"));
$asesmen->id = $_POST['id'];
$asesmen->catatan_akhir=$_POST['catatan_akhir'];

if(
  !empty($asesmen->id) &
  !empty($asesmen->catatan_akhir)
){
  if($asesmen->updateNote()){
    $minfo = array("success"=>'true', "message"=>'Catatan Akhir Berhasil Disimpan');
    $jsondata = json_encode($minfo);
    echo $jsondata;

    //echo $jsondata;
  }else{
    $minfo = array("success"=>'false', "message"=>'Catatan Akhir Gagal Disimpan '.$asesmen->id.' - '.$asesmen->catatan_akhir);
    $jsondata = json_encode($minfo);
    echo $jsondata;
  }

}else{

  http_response_code(400);
  // echo json_encode(array("message" => "Lengkapi Data Asesmen"));
  $minfo = array("success"=>'false', "message"=>'Catatan Akhir gagal 400 ');
  $jsondata = json_encode($minfo);
  echo $jsondata;

}
?>
