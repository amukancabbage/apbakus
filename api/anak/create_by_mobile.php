<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../config/database.php';
include_once '../0objects/anak.php';

$database = new Database();
$db = $database->getConnection();

$anak = new Anak($db);


$nama=$_POST['nama'];
$jenis_kelamin=$_POST['jenis_kelamin'];
$tanggal_lahir=$_POST['tanggal_lahir'];
$nama_ortu=$_POST['nama_ortu'];
$alamat="[DEFAULT]";
$no_kontak=$_POST['no_kontak'];
$id_sekolah= 0;
$id_pengguna=$_POST['id_pengguna'];
$nama_anak_array = explode(" ",$nama);
$nama_ortu_array = explode(" ",$nama_ortu);
$nama_depan_anak = $nama_anak_array[0];
$nama_depan_ortu = $nama_ortu_array[0];
$last_id = $anak->lastId();
$username = $nama_depan_anak.$last_id;
$password=$username;

if(
  // !empty($data->status)  &
  !empty($nama)
){

  $anak->status=1;
  $anak->nama=$nama;
  $anak->jenis_kelamin=$jenis_kelamin;
  $anak->tanggal_lahir=$tanggal_lahir;
  $anak->nama_ortu=$nama_ortu;
  $anak->alamat=$alamat;
  $anak->no_kontak=$no_kontak;
  $anak->id_sekolah=$id_sekolah;
  $anak->id_pengguna=$id_pengguna;
  $anak->username=$username;
  $anak->password=$password;

    // $anak->nama='1';
    // $anak->jenis_kelamin='1';
    // $anak->tanggal_lahir='2019-09-09';
    // $anak->nama_ortu='1';
    // $anak->alamat='1';
    // $anak->no_kontak='1';
    // $anak->id_sekolah='1';
    // $anak->id_pengguna='1';
    // $anak->username='1';
    // $anak->password='1';

  $stmt = $anak->user_check();
  $num = $stmt->rowCount();
  if(!$num>0){
    if($anak->create()){
      // http_response_code(201);
      //echo json_encode(array("message" => "Pengguna berhasil disimpan."));

      // $lastid = $pengguna->lastInsertedId();
      // $minfo = array("success"=>'true', "message"=>'Account confimation email sent successfully to your email address',"userid"=>$lastid,"nama_lengkap"=>'unverified');
      $minfo = array("success"=>'true', "message"=>'Data created successfully',"user"=>$anak->username);
      $jsondata = json_encode($minfo);
      echo $jsondata;

    }
    else{
      // http_response_code(503);
      // echo json_encode(array("message" => "Pengguna gagal disimpan"));
      $minfo = array("success"=>'false', "message"=>'Failed to create data. Please try again.');
      $jsondata = json_encode($minfo);
      echo $jsondata;

    }

  }else{
    $minfo = array("success"=>'false', "message"=>'Username already exist');
    $jsondata = json_encode($minfo);
    echo $jsondata;
  }

}else{

  http_response_code(400);
  $minfo = array("success"=>'false', "message"=>'Empty field found');
  $jsondata = json_encode($minfo);
} ?>
