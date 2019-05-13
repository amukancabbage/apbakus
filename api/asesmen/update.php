 <?php header("Access-Control-Allow-Origin: *");
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
  $asesmen->id = $data->id;
  $asesmen->status = $data->status;
$asesmen->id_tipe = $data->id_tipe;
$asesmen->id_anak = $data->id_anak;
$asesmen->id_user = $data->id_user;
$asesmen->tanggal_asesmen = $data->tanggal_asesmen;
$asesmen->usia = $data->usia;
$asesmen->hasil_akhir = $data->hasil_akhir;
$asesmen->catatan_akhir  = $data->catatan_akhir ;

  if($asesmen->update()){
    http_response_code(200);
    // echo json_encode(array("message" => "Asesmen Sudah Diubah."));
  }else{
    http_response_code(503);
    // echo json_encode(array("message" => "Asesmen GAGAL Diubah."));
  }
?>