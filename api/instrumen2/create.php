 <?php
  header("Access-Control-Allow-Origin: *");
  header("Content-Type: application/json; charset=UTF-8");
  header("Access-Control-Allow-Methods: POST");
  header("Access-Control-Max-Age: 3600");
  header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

  include_once '../config/database.php';
  include_once '../0objects/instrumen2.php';

  $database = new Database();
  $db = $database->getConnection();

  $instrumen2 = new Instrumen2($db);
  $data = json_decode(file_get_contents("php://input"));

  if(
      !empty($data->status)  & 
!empty($data->butir) & 
!empty($data->gambar)
  ){

      $instrumen2->status = $data->status; 
$instrumen2->butir = $data->butir;
$instrumen2->gambar = $data->gambar;

      if($instrumen2->create()){
          http_response_code(201);
          echo json_encode(array("message" => "Instrumen2 berhasil disimpan."));
      }
      else{
          http_response_code(503);
          echo json_encode(array("message" => "Instrumen2 gagal disimpan"));
      }
  }else{

      http_response_code(400);
      echo json_encode(array("message" => "Lengkapi Data Instrumen2"));
  } ?>