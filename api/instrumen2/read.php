 <?php
  header("Access-Control-Allow-Origin: *");
  header("Content-Type: application/json; charset=UTF-8");

  include_once '../config/database.php';
  include_once '../0objects/instrumen2.php';

  $database = new Database();
  $db = $database->getConnection();

  $instrumen2 = new Instrumen2($db);

  $stmt = $instrumen2->read();
  $num = $stmt->rowCount();

  if($num>0){
    $instrumen2s_arr=array();
    $instrumen2s_arr["records"]=array();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
      extract($row);
      $instrumen2_item=array( 
"id" => $id, 
 "created_at" => $created_at, 
 "updated_at" => $updated_at, 
 "status" => $status, 
 "butir" => $butir, 
 "gambar" => $gambar);

      array_push($instrumen2s_arr["records"], $instrumen2_item);
    }

    http_response_code(200);
    echo json_encode($instrumen2s_arr);
  }

  else{

    http_response_code(404);
    echo json_encode(
      array("message" => "data masih kosong.")
    );
  }
  ?>