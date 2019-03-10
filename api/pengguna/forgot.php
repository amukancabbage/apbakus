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

$user_email=$_GET['email'];
$user_email=filter_var($user_email, FILTER_SANITIZE_EMAIL);
// print_r($user_email);
if(
  !empty($user_email)
){

  $pengguna->nama_user = $user_email;
  $stmt = $pengguna->forgot_check();

  $num = $stmt->rowCount();
  if($num>0){
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $code = $row['forgot'];
    require '../../PHPMailer_5.2.0/class.phpmailer.php';
    // $link=$serveradd.'reset.php?passkey=' . $code .'&email='.$user_email;
    $link='mirzayogy.com/apbakus/api/pengguna/reset.php?passkey=' . $code .'&email='.$user_email;

    $message = file_get_contents('emailheadreset.php');
    $message .= '<tr style="margin: 0; padding: 0; box-sizing: border-box; font-family:Helvetica Neue, Helvetica, Helvetica, Arial, sans-serif; color: #8F9BB3; font-size: 14px; line-height: 22px;">
    <td class="action" style="margin: 0; padding: 0; box-sizing: border-box; font-family: Helvetica Neue, Helvetica, Helvetica, Arial, sans-serif; color: #8F9BB3; font-size: 14px; line-height: 22px; vertical-align: top; padding-top: 20px;">
    <a href="'.$link.'" class="btn-primary" style="line-height: 22px; margin: 0; box-sizing: border-box; font-family: Helvetica Neue, Helvetica, Helvetica, Arial, sans-serif; color: #ffffff; font-size: 18px; padding: 20px; display: block; font-weight: bold; background: #ee8027; border-radius: 3px; text-decoration: none; text-align: center;">Reset your password here</a>
    </td>
    </tr>';
    $message .= file_get_contents('emailfoot.php');
    include 'mailconfig.php';
    $mail->Subject = "Reset Password pada Apbakus";
    $mail->AddAddress($user_email);
    if(!$mail->Send()) {
      echo "Mailer Error: " . $mail->ErrorInfo;
    } else {

      $minfo = array("success"=>'true', "message"=>'Reset Instructions Sent to Your Mail');
      $jsondata = json_encode($minfo);
    }

  }else{

    $minfo = array("success"=>'false', "message"=>'Account Not Found');
    $jsondata = json_encode($minfo);
  }

}else{

  http_response_code(400);
  $minfo = array("success"=>'false', "message"=>'Empty field found');
  $jsondata = json_encode($minfo);
} ?>
