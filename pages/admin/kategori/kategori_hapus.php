<?php
if($_GET) {
  if(empty($_GET['Kode'])) {
    buatLog($_SESSION['UNCLE_username'],"DELETE FILE",deleteAny($koneksidb,$mySql,$_GET['Kode']));
    echo "<b>Data yang dihapus tidak ada</b>";
  }
  else {
    $url = 'http://localhost/apbakus/api/tipe/delete.php';
    $ch = curl_init($url);

    $delete_id = decD($_GET['Kode']);

    $jsonData = array(
      'id' => $delete_id
    );

    $jsonDataEncoded = json_encode($jsonData);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonDataEncoded);
    $result = curl_exec($ch);

    if ($result){
      showMessageGreen("Data berhasil dihapus");
      echo "<meta http-equiv='refresh' content='1; url=?page=Tipe-Data'>";
    }else{
      showMessageRed("Data gagal dihapus");
    }
  }
}
?>
