<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../config/database.php';
include_once '../0objects/anak.php';

$database = new Database();
$db = $database->getConnection();
$anak = new Anak($db);
$anak->id = $_POST['id'];

if($anak->delete()){
  http_response_code(200);
  $minfo = array("success"=>'true', "message"=>'Deleted.');
  $jsondata = json_encode($minfo);
  echo $jsondata;
}else{
  $minfo = array("success"=>'false', "message"=>'Failed.');
  $jsondata = json_encode($minfo);
  echo $jsondata;
} ?>
