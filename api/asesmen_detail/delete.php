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
  $data = json_decode(file_get_contents("php://input"));
  $asesmen_detail->id = $data->id;

  if($asesmen_detail->delete()){

    http_response_code(200);
    echo json_encode(array("message" => "Asesmen_detail sudah dihapus."));
  }else{
    http_response_code(503);
    echo json_encode(array("message" => "Asesmen_detail GAGAL dihapus."));
  } ?>