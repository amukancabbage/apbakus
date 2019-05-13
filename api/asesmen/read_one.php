 <?php 

  header("Access-Control-Allow-Origin: *");
  header("Access-Control-Allow-Headers: access");
  header("Access-Control-Allow-Methods: GET");
  header("Access-Control-Allow-Credentials: true");
  header('Content-Type: application/json');

  include_once '../config/database.php';
  include_once '../0objects/asesmen.php';

  $database = new Database();
  $db = $database->getConnection();

  $asesmen = new Asesmen($db);

  $asesmen->id = isset($_GET['id']) ? $_GET['id'] : die();
  $asesmen->readOne();

  if($asesmen->id_tipe!=null){

      $asesmen_arr = array(
          "id" => $asesmen->id,
"id_tipe" => $asesmen->id_tipe,
"id_anak" => $asesmen->id_anak,
"id_user" => $asesmen->id_user,
"tanggal_asesmen" => $asesmen->tanggal_asesmen,
"usia" => $asesmen->usia,
"hasil_akhir" => $asesmen->hasil_akhir,
"catatan_akhir " => $asesmen->catatan_akhir 
      );

      http_response_code(200);
      echo json_encode($asesmen_arr);
  }

  else{
      http_response_code(404);
      echo json_encode(array("message" => "Asesmen tidak ditemukan"));
  }
 ?>