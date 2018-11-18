<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');

include_once '../config/database.php';
include_once '../objects/kategori.php';

$database = new Database();
$db = $database->getConnection();

$kategori = new Kategori($db);

$kategori->id = isset($_GET['id']) ? $_GET['id'] : die();
$kategori->readOne();

if($kategori->kategori_instrumen!=null){

    $kategori_arr = array(
        "id" => $kategori->id,
        "kategori_instrumen" => $kategori->kategori_instrumen,
        "deskripsi" => $kategori->deskripsi,
        "id_tipe" => $kategori->id_tipe,
        "nama_tipe" => $kategori->nama_tipe
    );

    http_response_code(200);
    echo json_encode($kategori_arr);
}

else{
    http_response_code(404);
    echo json_encode(array("message" => "Kategori tidak ditemukan"));
}
?>
