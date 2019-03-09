<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../config/database.php';
include_once '../0objects/pengguna.php';

$database = new Database();
$db = $database->getConnection();

$pengguna = new Pengguna($db);

$passkey = $_GET['passkey'];
$user_email=$_GET['email'];
$user_email=filter_var($user_email, FILTER_SANITIZE_EMAIL);

if(
  !empty($passkey) &
  !empty($user_email)
){

  $pengguna->nama_user = $user_email;
  $pengguna->com_code = $passkey;

  $stmt = $pengguna->confirm_check();
  $num = $stmt->rowCount();
  if($num>0){
    if($pengguna->confirm()){
      http_response_code(201);
      $minfo = array("success"=>'true', "message"=>'Your account activated');
      $jsondata = json_encode($minfo);
      echo $jsondata;
      header("location:thanks.html");
    }
    else{
      http_response_code(503);
      $minfo = array("success"=>'false', "message"=>'Failed to verify. Please try again.');
      $jsondata = json_encode($minfo);
      echo $jsondata;
    }

  }else{
    $minfo = array("success"=>'false', "message"=>'Failed to verify. Please try again');
    $jsondata = json_encode($minfo);
    echo $jsondata;
    header("location:failcode.html");
  }

}else{

  http_response_code(400);
  $minfo = array("success"=>'false', "message"=>'Empty field found');
  $jsondata = json_encode($minfo);
} ?>
