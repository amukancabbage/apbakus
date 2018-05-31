<!DOCTYPE html>
<html lang="id">
  <head>
  <?php
    session_start(); 
    if(empty($_SESSION['UNCLE_level'])) {
      echo "<meta http-equiv='refresh' content='0; url=index.php'>";
    }else{
      include_once "library/connection.php";
      include_once "library/library.php";
      include_once "library/library.pdo.php";
      include_once "library/library.generator.php";
      include_once "library/library.gentella.php";
      
      $default_image_profile = "images/avatars/user_m.png";
      $image_profil = $_SESSION['UNCLE_avatar']=="" ? $default_image_profile : "images/avatars/".$_SESSION['UNCLE_avatar'];
      $image_profil = file_exists($image_profil) ? $image_profil : $default_image_profile;
      $nama_lengkap = $_SESSION['UNCLE_nama'];
     
    
?>
    <?php include_once "partials/include.link.php"; ?>
  </head>

  <body class="nav-md footer_fixed" onload="notif()">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <?php include "partials/leftbar.php"; ?>
          </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">
          <?php include "partials/topbar.php"; ?>
        </div>
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main">
          <?php include "pages/bukafile.php"; ?>  
                  
        </div>
        <!-- /page content -->

        <!-- footer content -->
        <footer>
          <div class="pull-right">
            APBAKUS | Aplikasi Asesmen Anak Berkebutuhan Khusus
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
      </div>
    </div>

    <?php include "partials/include.script.php"; ?>
	
  </body>
</html>

    <?php } ?>
