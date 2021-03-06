 <?php
  header("Access-Control-Allow-Origin: *");
  header("Content-Type: application/json; charset=UTF-8");

  include_once '../config/database.php';
  include_once '../0objects/asesmen.php';

  $database = new Database();
  $db = $database->getConnection();

  $asesmen = new Asesmen($db);

  $stmt = $asesmen->read();
  $num = $stmt->rowCount();

  if($num>0){
    $asesmens_arr=array();
    $asesmens_arr["records"]=array();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
      extract($row);
      $asesmen_item=array( 
"id" => $id, 
 "created_at" => $created_at, 
 "updated_at" => $updated_at, 
 "status" => $status, 
 "id_tipe" => $id_tipe, 
 "id_anak" => $id_anak, 
 "id_user" => $id_user, 
 "tanggal_asesmen" => $tanggal_asesmen, 
 "usia" => $usia, 
 "hasil_akhir" => $hasil_akhir, 
 "catatan_akhir " => $catatan_akhir );

      array_push($asesmens_arr["records"], $asesmen_item);
    }

    http_response_code(200);
    echo json_encode($asesmens_arr);
  }

  else{

    http_response_code(404);
    echo json_encode(
      array("message" => "data masih kosong.")
    );
  }
  ?>