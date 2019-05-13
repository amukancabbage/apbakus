<?php
$ippengguna=$_SERVER['REMOTE_ADDR'];
if($ippengguna=="::1") {
  $nHost	= 'localhost';
  $nUser	= 'root';
  $nPass	= '';
  $nDbs	  = 'db_abk';
}else{
  $nHost	= 'mysql.hostinger.co.id';
  $nUser	= 'u713260332_yogy';
  $nPass	= 'kurniawan86';
  $nDbs	  = 'u713260332_abk';
}

try {
  $koneksidb = new PDO("mysql:host=$nHost;dbname=$nDbs", $nUser, $nPass);
  $koneksidb->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}catch(PDOException $e) {
  echo "Error: " . $e->getMessage();
}

?>
