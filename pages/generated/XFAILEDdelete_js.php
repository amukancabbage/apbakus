<?php
// check if value was posted
  include "library/library.form.php"
  include "library/library.gentella.php"
  include "library/connection.php"
  echo "<script> alert('A');</script>";

  function buatLog($user, $activity, $data){
    $ippengguna=$_SERVER['REMOTE_ADDR'];
    $line="[".date("h:i:sa")."][".$user."][".$ippengguna."][".$activity."][".$data."]". PHP_EOL;
    //Save string to log, use FILE_APPEND to append.
    file_put_contents('log_'.date("d.m.Y").'.txt', $line, FILE_APPEND);
  }

  buatLog("MAUK","UK","MA");

if($_POST){
    // $Kode = decD($_POST['kode']);

    $Kode = $_POST['kode'];
    // $table = decD($_POST['table']);

    $mySql = "DELETE FROM tipe WHERE id=?";
		$arrayCriteria = array($Kode);

    if(execSql($koneksidb,$mySql,$arrayCriteria)){
        showMessageGreen("Sukses Delete");
         echo "Object was deleted.";
    }else{
      showMessageRed("Gagal Delete");
       echo "Object was NOT deleted.";
    }
}
?>
