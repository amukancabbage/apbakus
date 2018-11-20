<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../config/database.php';
include_once '../0objects/kategori.php';

$database = new Database();
$db = $database->getConnection();

$kategori = new Kategori($db);

$stmt = $kategori->read();
$num = $stmt->rowCount();

if($num>0){

    $kategoris_arr=array();
    $kategoris_arr["records"]=array();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($row);

        $kategori_item=array(
            "id" => $id,
            "kategori_instrumen" => $kategori_instrumen,
            "id_tipe" => $id_tipe,
            "nama_tipe" => $nama_tipe,
            "deskripsi" => html_entity_decode($deskripsi)
        );

        array_push($kategoris_arr["records"], $kategori_item);
    }

    http_response_code(200);
    echo json_encode($kategoris_arr);
}

else{

    http_response_code(404);
    echo json_encode(
        array("message" => "data Kategori masih kosong.")
    );
}
?>
