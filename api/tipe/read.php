<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../config/database.php';
include_once '../objects/tipe.php';

$database = new Database();
$db = $database->getConnection();

$tipe = new Tipe($db);

$stmt = $tipe->read();
$num = $stmt->rowCount();

if($num>0){

    $tipes_arr=array();
    $tipes_arr["records"]=array();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($row);

        $tipe_item=array(
            "id" => $id,
            "tipe" => $tipe,
            "deskripsi" => html_entity_decode($deskripsi)
        );

        array_push($tipes_arr["records"], $tipe_item);
    }

    http_response_code(200);
    echo json_encode($tipes_arr);
}

else{

    http_response_code(404);
    echo json_encode(
        array("message" => "data tipe masih kosong.")
    );
}
?>
