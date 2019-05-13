<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../config/database.php';
include_once '../0objects/asesmen.php';
include_once '../0objects/tipe.php';
include_once '../0objects/instrumen.php';

$database = new Database();
$db = $database->getConnection();

$asesmen = new Asesmen($db);
// $data = json_decode(file_get_contents("php://input"));
$id_tipe=$_POST['id_tipe'];
$id_anak=$_POST['id_anak'];
$id_user=$_POST['id_user'];
$tanggal_lahir=$_POST['tanggal_lahir'];


if(
  !empty($id_tipe) &
  !empty($id_anak) &
  !empty($id_user) &
  !empty($tanggal_lahir)
){
  //
  $asesmen->status = 1;
  $asesmen->id_tipe = $id_tipe;
  $asesmen->id_anak = $id_anak;
  $asesmen->id_user = $id_user;
  $tanggal_lahir = $tanggal_lahir;
  //

  if($asesmen->createByMobile($tanggal_lahir)){
    $id_asesmen = $asesmen->lastInsertedId();

    $instrumen = new Instrumen($db);
    $stmt = $instrumen->readByTipe($id_tipe);
    $num = $stmt->rowCount();

    if($num>0){
      $instrumens_arr=array();
      $instrumens_arr["records"]=array();

      try{
        $db->beginTransaction();
        while($records=$stmt->fetch(PDO::FETCH_ASSOC))
        {
          $id = $records['id'];
          $butir = $records['butir'];
          $gambar = $records['gambar'];
          $keterangan = $records['keterangan'];
          $db->query("INSERT INTO asesmen_detail SET status=1, id_asesmen=$id_asesmen, id_instrumen=$id, hasil='TIDAK'");
        }
        $db->commit();
        
      }catch(Exception $e){
        $db->rollback();
      }
    }
    // else{
    //
    //   http_response_code(404);
    //   echo json_encode(
    //     array("message" => "data masih kosong.")
    //   );
    // }

    $minfo = array("success"=>'false', "message"=>'Asesmen sukses insert'.$asesmen->id_tipe.$asesmen->id_anak.$asesmen->id_user.$tanggal_lahir);
    $jsondata = json_encode($minfo);
    echo $jsondata;

    //echo $jsondata;
  }else{
    $minfo = array("success"=>'false', "message"=>'Asesmen gagal insert');
    $jsondata = json_encode($minfo);
    echo $jsondata;
  }

}else{

  http_response_code(400);
  // echo json_encode(array("message" => "Lengkapi Data Asesmen"));
  $minfo = array("success"=>'false', "message"=>'Asesmen gagal 400 ');
  $jsondata = json_encode($minfo);
  echo $jsondata;

}
?>
