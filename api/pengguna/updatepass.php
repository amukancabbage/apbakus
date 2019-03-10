<?php
include_once '../config/database.php';
include_once '../0objects/pengguna.php';
$database = new Database();
$db = $database->getConnection();

$passkey = $_GET['passkey'];
$user_email=$_GET['email'];

if(isset($_POST['submitbtn'])){
  $newpass=$_POST['newpass'];
  $confirm=$_POST['password'];

  if(!empty($newpass) && !empty($confirm))
  {
    $pengguna = new Pengguna($db);
    $pengguna->nama_user = $user_email;
    $pengguna->forgot = $passkey;
    $pengguna->user_password = $newpass;
    $stmt = $pengguna->forgot_check_code();
    $num = $stmt->rowCount();
    if($num>0)
    {
      if($newpass==$confirm)
      {
        if($pengguna->reset_pass())
        {
          echo'<script>alert("Password Updated Successfully")</script>';
          echo"<script>
          window.location = 'resetthank.html';
          </script>";
          exit();
        }
      }else ?> <?php
      {
        echo'<script>alert("Password did not match")</script>';

      }
    } else {
      echo '<script> alert("Access code expired ")</script>';
      echo"<script>
      window.location = 'resetfail.html';
      </script>";
    }
  }else
  { echo'<script>alert("Empty password not allowed")</script>';
    echo"<script>
    window.location = 'resetfail.html';
    </script>";

  }
} else {
  echo'<script>alert("Unauthorized access not allowed ")</script>';
  echo"<script>
  window.location = 'resetfail.html';
  </script>";
}

?>
