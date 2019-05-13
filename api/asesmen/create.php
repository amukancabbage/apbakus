 <?php
  header("Access-Control-Allow-Origin: *");
  header("Content-Type: application/json; charset=UTF-8");
  header("Access-Control-Allow-Methods: POST");
  header("Access-Control-Max-Age: 3600");
  header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

  include_once '../config/database.php';
  include_once '../0objects/asesmen.php';

  $database = new Database();
  $db = $database->getConnection();

  $asesmen = new Asesmen($db);
  $data = json_decode(file_get_contents("php://input"));

  if(
    !empty($data->status)  & 
!empty($data->id_tipe) & 
!empty($data->id_anak) & 
!empty($data->id_user) & 
!empty($data->tanggal_asesmen) & 
!empty($data->usia) & 
!empty($data->hasil_akhir) & 
!empty($data->catatan_akhir )
  ){

    $asesmen->status = $data->status; 
$asesmen->id_tipe = $data->id_tipe;
$asesmen->id_anak = $data->id_anak;
$asesmen->id_user = $data->id_user;
$asesmen->tanggal_asesmen = $data->tanggal_asesmen;
$asesmen->usia = $data->usia;
$asesmen->hasil_akhir = $data->hasil_akhir;
$asesmen->catatan_akhir  = $data->catatan_akhir ;

    if($asesmen->create()){
      http_response_code(201);
      echo json_encode(array("message" => "Asesmen berhasil disimpan."));
    }
    else{
      http_response_code(503);
      echo json_encode(array("message" => "Asesmen gagal disimpan"));
    }
  }else{

    http_response_code(400);
    echo json_encode(array("message" => "Lengkapi Data Asesmen"));
  } ?>