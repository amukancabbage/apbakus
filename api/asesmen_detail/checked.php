<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../config/database.php';
include_once '../0objects/asesmen_detail.php';

$database = new Database();
$db = $database->getConnection();
$asesmen_detail = new Asesmen_detail($db);

$asesmen_detail->id=$_POST['id'];
$asesmen_detail->hasil=$_POST['hasil'];

if($asesmen_detail->checked()){
  $minfo = array("success"=>'true', "message"=>'Updated.');
  $jsondata = json_encode($minfo);
  echo $jsondata;
}
else{
  $minfo = array("success"=>'false', "message"=>'Failed.');
  $jsondata = json_encode($minfo);
  echo $jsondata;
}
?>
