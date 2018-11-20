<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');

include_once '../config/database.php';
include_once '../0objects/tipe.php';

$database = new Database();
$db = $database->getConnection();

$tipe = new Tipe($db);

$tipe->id = isset($_GET['id']) ? $_GET['id'] : die();
$tipe->readOne();

if($tipe->tipe!=null){

    $tipe_arr = array(
        "id" => $tipe->id,
        "tipe" => $tipe->tipe,
        "deskripsi" => $tipe->deskripsi
    );

    http_response_code(200);
    echo json_encode($tipe_arr);
}

else{
    http_response_code(404);
    echo json_encode(array("message" => "Tipe tidak ditemukan"));
}
?>
