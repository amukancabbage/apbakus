<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>SIRINTIK</title>

    <!-- Bootstrap -->
    <link href="vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- Animate.css -->
    <link href="vendors/animate.css/animate.min.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="build/css/custom.min.css" rel="stylesheet">

    <!-- iCheck -->
    <link href="vendors/iCheck/skins/flat/green.css" rel="stylesheet">
    <!-- bootstrap-progressbar -->
    <link href="vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">
    <!-- PNotify -->
    <link href="vendors/pnotify/dist/pnotify.css" rel="stylesheet">
    <link href="vendors/pnotify/dist/pnotify.buttons.css" rel="stylesheet">
    <link href="vendors/pnotify/dist/pnotify.nonblock.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="build/css/custom.min.css" rel="stylesheet">
  
  </head>
  <?php 
    include_once 'library/connection.php';
    include_once 'library/library.php';
    include_once 'library/library.pdo.php';
    include_once 'library/library.gentella.php';
if($_POST) { 
// 	if(isset($_POST['btnLogin'])){
    $user = $_POST["user"];
    $pass = md5($_POST["pass"]);
    $hasil = $_POST["hasil"];
    $jumla = $_POST['jumlah'];
    $arrCrit = array($user,$pass);
    
    if($hasil!=$jumla){
      $pesanError[]="Hasil penjumlahan tidak sesuai";
      showMessageRed($pesanError);
    }
    else if(getDataNumber($koneksidb,"Select count(*) FROM pengguna WHERE nama_user=? AND user_password=?",$arrCrit)==0){
      $pesanError[]="Username/Password salah";
      showMessageRed($pesanError);
    }else{

      $inactive = 3; 
        ini_set('session.gc_maxlifetime', $inactive); // set the session max lifetime to 2 hours

        session_start();

        if (isset($_SESSION['testing']) && (time() - $_SESSION['testing'] > $inactive)) {
          // last request was more than 2 hours ago
          session_unset();     // unset $_SESSION variable for this page
          session_destroy();   // destroy session data
        }
      $_SESSION['testing'] = time(); // Update session
      $loginData=getDataCriteria($koneksidb,"SELECT * FROM pengguna WHERE nama_user=? AND user_password=?",$arrCrit);
      $_SESSION['UNCLE_username'] = $loginData['nama_user']; 
      $_SESSION['UNCLE_nama'] = $loginData['nama_lengkap']; 
      $_SESSION['UNCLE_level'] = $loginData['level']; 
      $_SESSION['UNCLE_userid'] = $loginData['id'];     
      $_SESSION['UNCLE_avatar'] = $loginData['avatar'];     
            echo "<meta http-equiv='refresh' content='0; url=main.php'>";
            //echo "<meta http-equiv='refresh' content='0; url=?".hash_pass('page')."=Home'>";
    }
}
?>
  <body onload="notif()" class="login">
    <div>
      <a class="hiddenanchor" id="signup"></a>
      <a class="hiddenanchor" id="signin"></a>

      <div class="login_wrapper">
        <div class="animate form login_form">
          <section class="login_content">
            <form method="POST">
              <h1>Login Form</h1>
              <div class="form-group has-feedback">
                <input type="text" class="form-control" placeholder="Username" required name="user" autofocus/>
                <span class="fa fa-user form-control-feedback right" aria-hidden="true"></span>
              </div>
              <div class="form-group has-feedback">
                <input type="password" class="form-control" placeholder="Password" required name="pass"/>
                <span class="fa fa-lock form-control-feedback right" aria-hidden="true"></span>
              </div>
              <div class="form-group">
              <?php
                //meng-generate angka random integer antara 20 - 50
                $jx = rand(5,9);
                //meregisterkan angka tersebut ke session
                //$_SESSION['captchakuis'] = $jx;
                $kx = rand(1,4);
                $yx = $jx - $kx;
                //mencetak ke halaman
                echo "<input type=\"text\" class=\"form-control\" value=\"                                           ".$yx." + ".$kx." \" disabled  />";
                echo "<input type=\"hidden\" value=\"".$jx."\"name=\"jumlah\">";
                ?>   
              </div>
              <div class="form-group has-feedback">
                <input type="text" class="form-control" placeholder="Hasil" required name="hasil"/>
                <span class="fa fa-plus form-control-feedback right" aria-hidden="true"></span>
              </div>
                     

        
                          
              <div>
                       
                <a class="reset_pass" href="#">Lupa password?</a>
                 <button type="submit" class="btn btn-success">Masuk</button>
              </div>

              <div class="clearfix"></div>

              <div class="separator">
                <p class="change_link">
                  <!-- New to site? -->
                  <a href="#signup" class="to_register"><span  class="btn btn-primary"> Daftar akun baru</span></a>
                </p> 

                <div class="clearfix"></div>
                <br />

                <div>
                  <!-- <h1><i class="fa fa-paw"></i> Gentelella Alela!</h1>
                  <p>©2016 All Rights Reserved. Gentelella Alela! is a Bootstrap 3 template. Privacy and Terms</p> -->
                </div>
              </div>
            </form>
<hr />

<!-- </div> -->
          </section>
        </div>
        <div id="register" class="animate form registration_form">
          <section class="login_content">
            <form>
              <h1>Create Account</h1>
              <div>
                <input type="text" class="form-control" placeholder="Username" required="" />
              </div>
              <div>
                <input type="email" class="form-control" placeholder="Email" required="" />
              </div>
              <div>
                <input type="password" class="form-control" placeholder="Password" required="" />
              </div>
              <div>
                <a class="btn btn-default submit" href="index.html">Submit</a>
              </div>

              <div class="clearfix"></div>

              <div class="separator">
                <p class="change_link">Already a member ?
                  <a href="#signin" class="to_register"> Log in </a>
                </p>

                <div class="clearfix"></div>
                <br />

                <div>
                  <h1><i class="fa fa-paw"></i> Gentelella Alela!</h1>
                  <p>©2016 All Rights Reserved. Gentelella Alela! is a Bootstrap 3 template. Privacy and Terms</p>
                </div>
              </div>
            </form>
          </section>
        </div>
      </div>
    </div>
    <?php include "partials/include.script.php"?>
  </body>
</html>
