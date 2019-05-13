<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../config/database.php';
include_once '../0objects/pengguna.php';

$database = new Database();
$db = $database->getConnection();

$pengguna = new Pengguna($db);
$pengguna->nama_user = $_POST['email'];
$pengguna->user_password = md5($_POST['password']);

if(!empty($pengguna->nama_user) && !empty($pengguna->user_password)){

  $stmt = $pengguna->login_check();
  $num = $stmt->rowCount();
  if($num>0){
    $rows = $stmt->fetch(PDO::FETCH_ASSOC);
    $userid=$rows['id'];
    $nama_lengkap = $rows['nama_lengkap'];
    $codecheck=$rows['com_code'];

    if($pengguna->nama_user==$rows['nama_user'] && $pengguna->user_password==$rows['user_password']){
      if(empty($codecheck))
      {
        $minfo = array("success"=>'true', "message"=>'Log in successfully',"userid"=>$userid,"namaLengkap"=>$nama_lengkap);
        $jsondata = json_encode($minfo);
      }
      else
      {
        if(!empty($codecheck)){
          $minfo = array("success"=>'notactive', "message"=>'Account verification is pending. Please confirm your email.',"userid"=>$userid);
          $jsondata = json_encode($minfo);
        }
      }
    }else
    {
      if($pengguna->nama_user==$rows['nama_user']){
        $minfo = array("success"=>'false', "message"=>'Invalid email or password');
        $jsondata = json_encode($minfo);
      }else
      {
        $minfo = array("success"=>'false', "message"=>'Account does not exist. Please signup');
        $jsondata = json_encode($minfo);
      }
    }
  }else
  {
    $minfo = array("success"=>'false', "message"=>'Account does not exist. Please signup');
    $jsondata = json_encode($minfo);
  }
}else
{
  echo 'empty fileds';
  $minfo = array("success"=>'false', "message"=>'Empty field either username or password');
  $jsondata = json_encode($minfo);

}
print_r($jsondata);

?>
