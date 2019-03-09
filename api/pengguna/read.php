<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../config/database.php';
include_once '../0objects/pengguna.php';

$database = new Database();
$db = $database->getConnection();

$pengguna = new Pengguna($db);

$stmt = $pengguna->read();
$num = $stmt->rowCount();

if($num>0){
  $penggunas_arr=array();
  $penggunas_arr["records"]=array();

  while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
    extract($row);
    $pengguna_item=array(
      "id" => $id,
      "created_at" => $created_at,
      "updated_at" => $updated_at,
      "status" => $status,
      "nama_user" => $nama_user,
      "user_password" => $user_password,
      "nama_lengkap" => $nama_lengkap,
      "no_kontak" => $no_kontak,
      "level" => $level,
      "avatar" => $avatar,
      "com_code" => $com_code,
      "forgot" => $forgot);

      array_push($penggunas_arr["records"], $pengguna_item);
    }

    http_response_code(200);
    echo json_encode($penggunas_arr);
  }

  else{

    http_response_code(404);
    echo json_encode(
      array("message" => "data masih kosong.")
    );
  }
  ?>
