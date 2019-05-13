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
// $data = json_decode(file_get_contents("php://input"));
$user_email=$_POST['email'];
// $user_email=$data->email;
$user_email=filter_var($user_email, FILTER_SANITIZE_EMAIL);
$name=$_POST['name'];
// $name=$data->name;
$com_code = md5(uniqid(rand()));
$forgot = md5(uniqid(rand()));
$password=md5($_POST['password']);
$logintype=$_POST['logintype'];
// $password=$data->password;
// $logintype=$data->logintype;

if(
  // !empty($data->status)  &
  !empty($name) &
  !empty($user_email) &
  !empty($password)
){

  $pengguna->status = 1;
  $pengguna->nama_user = $user_email;
  $pengguna->user_password = $password;
  $pengguna->nama_lengkap = $name;
  $pengguna->no_kontak =  "888";
  $pengguna->level = $logintype;
  $pengguna->avatar = "user_default.png";
  $pengguna->com_code = $com_code;
  $pengguna->forgot = $forgot;

  $stmt = $pengguna->email_check();
  $num = $stmt->rowCount();
  if(!$num>0){
    if($pengguna->create()){
      // http_response_code(201);
      //echo json_encode(array("message" => "Pengguna berhasil disimpan."));

      // $lastid = $pengguna->lastInsertedId();
      // $minfo = array("success"=>'true', "message"=>'Account confimation email sent successfully to your email address',"userid"=>$lastid,"nama_lengkap"=>'unverified');
      $minfo = array("success"=>'true', "message"=>'Account confimation email sent successfully to your email address');
      $jsondata = json_encode($minfo);
      echo $jsondata;


      require '../../PHPMailer_5.2.0/class.phpmailer.php';
      $link='mirzayogy.com/apbakus/api/pengguna/confirm.php?passkey=' . $com_code .'&email='.$user_email;
      $message = file_get_contents('emailhead.php');
      $message .= '
      <a href="'.$link.'" class="btn-primary" style="line-height: 22px; margin: 0;
      box-sizing: border-box; font-family: Helvetica Neue, Helvetica, Helvetica, Arial, sans-serif;
      color: #ffffff; font-size: 18px; padding: 20px; display: block; font-weight: bold;
      background: #ee8027; border-radius: 3px; text-decoration: none; text-align: center;"
      >Konfirmasi alamat surel anda</a>
      </td>
      </tr>';
      $message .= file_get_contents('emailfoot.php');
      include 'mailconfig.php';
      $mail->Subject = "Email konfirmasi akun untuk APKBAKUS";//"Confirmation Email For Ecommerce Store App Demo";
      $mail->AddAddress($user_email);

      if(!$mail->Send()) {
        // echo "Mailer Error: " . $mail->ErrorInfo;
      } else {
        //echo "Message has been sent"
        //echo "Your Confirmation link Has Been Sent To Your Email Address.";
      }


    }
    else{
      // http_response_code(503);
      // echo json_encode(array("message" => "Pengguna gagal disimpan"));
      $minfo = array("success"=>'false', "message"=>'Failed to register. Please try again.');
      $jsondata = json_encode($minfo);
      echo $jsondata;

    }

  }else{
    $minfo = array("success"=>'false', "message"=>'E-Mail already exist. Please Signin');
    $jsondata = json_encode($minfo);
    echo $jsondata;
  }

}else{

  http_response_code(400);
  $minfo = array("success"=>'false', "message"=>'Empty field found');
  $jsondata = json_encode($minfo);
} ?>
