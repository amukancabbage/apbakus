<?php
require "library/sesadmin.php";
  if($_GET){
    $Kode=$_GET['Kode'];
    $Kode=decD($Kode);
    $tableName = "tipe";
    $namaForm = ucwords(str_replace("t_","",$tableName));

if(isset($_POST['edit'])){
    $txt0 = $Kode;
    $txt1 = $_POST['txt1'];
    $txt2 = $_POST['txt2'];

    $pesanError = array();

    $arrCrit = array($txt1,$txt0);
    $cekAda = "Select count(*) FROM $tableName WHERE tipe=? and id!=?";
    if(getDataNumber($koneksidb,$cekAda,$arrCrit)>0)
    $pesanError[]="tipe yang sama sudah ada";

    if (count($pesanError)>=1 ){
      showMessageRed2($pesanError);
      buatLog($_SESSION['UNCLE_username'],"UPDATE FAIL",getStringArray($pesanError));
    }
    else {

      $url = 'http://localhost/apbakus/api/tipe/update.php';
      $ch = curl_init($url);

      $jsonData = array(
        'id' => $Kode,
        'status' => '1',
        'tipe' => $txt1,
        'deskripsi' => $txt2
      );

      $jsonDataEncoded = json_encode($jsonData);
      curl_setopt($ch, CURLOPT_POST, 1);
      curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonDataEncoded);
      $result = curl_exec($ch);
      if($result){
        buatLog($_SESSION['UNCLE_username'],"UPDATE tipe SUCCESS",$Kode);
        //echo "<meta http-equiv='refresh' content='0; url=?page=".$namaForm."-Data'>";
        $pesanSukses[] = "Data sudah diubah";
        showMessageGreen2($pesanSukses);
      }
    }
  }
  $arrCriteria = array($Kode);
  $query = "SELECT * FROM $tableName WHERE id=?";
  $data=getDataCriteria($koneksidb,$query,$arrCriteria);
}

?>
<div class="x_panel">
  <div class="x_title">
    <h2>Ubah Data Tipe</h2>
    <div class="clearfix">
    </div>
  </div>
  <div class="x_content">

    <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" enctype="multipart/form-data" method="POST" >
      <?php
      inputHidden("id",0,$Kode,"disabled");
      input("text","Tipe",1,$data[4],"autofocus required");
      inputTextArea("text","Deskripsi",2,$data[5],"required data-parsley-trigger=\"keyup\" data-parsley-minlength=\"20\" data-parsley-maxlength=\"200\"
      data-parsley-minlength-message=\"Minimal 20 karakter\" data-parsley-validation-threshold=\"10\"");
      ?>
      <div class="ln_solid"></div>
      <div class="form-group">
        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
          <button type="submit" name="edit" class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
          <a href="?page=<?php echo $namaForm;?>-Data"><span class="btn btn-primary"><i class="fa fa-arrow-left"></i> Kembali</span></a>
        </div>
      </div>

    </form>
  </div>

</div>
