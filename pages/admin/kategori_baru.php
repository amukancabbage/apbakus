<?php
if(isset($_POST['insert']))
{
  $txt1 = $_POST['txt1'];
  $txt2 = $_POST['txt2'];

  $pesanError = array();

  // $arrCrit = array($txt1);
  // $cekAda = "Select count(*) FROM kategori WHERE kategori_instrumen=?";
  // if(getDataNumber($koneksidb,$cekAda,$arrCrit)>0)
  // $pesanError[]="Kategori sudah ada";
  //
  // if (count($pesanError)>=1 ){
  //   showMessageRed($pesanError);
  //   buatLog($_SESSION['UNCLE_username'],"INSERT FAIL",getStringArray($pesanError));
  // }
  // else {
  //   $arrCriteria = array(1,$txt1,$txt2);
  //   $insertQuery	= "INSERT INTO kategori (status,kategori_instrumen,deskripsi) VALUES (?,?,?)";
  //
  //   if(execSql($koneksidb,$insertQuery,$arrCriteria)){
  //     buatLog($_SESSION['UNCLE_username'],"INSERT SUCCESS",$insertQuery." : ".getStringArray($arrCriteria));
  //     showMessageGreen("Data berhasil ditambahkan");
  //   }
  //   //exit;
  // }
  //API Url
$url = 'http://localhost/apbakus/api/kategori/create.php';
$ch = curl_init($url);

$jsonData = array(
    'status' => '1',
    'kategori_instrumen' => $txt1,
    'deskripsi' => $txt2
);

$jsonDataEncoded = json_encode($jsonData);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonDataEncoded);
$result = curl_exec($ch);
if ($result){
   ?>
  <!-- <div class="alert alert-success alert-dismissible fade in" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
              </button>
              <strong>Holy guacamole!</strong> Best check yo self, you're not looking too good.
            </div> -->
  <?php
  showMessageGreen("Data berhasil ditambahkan");
}else{
  showMessageRed("Data gagal ditambahkan");
}
}
?>
<form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" enctype="multipart/form-data" method="POST" >
  <?php
  input("text","Kategori",1,"","autofocus required");
  inputTextArea("text","Deskripsi",2,"","required data-parsley-trigger=\"keyup\" data-parsley-minlength=\"20\" data-parsley-maxlength=\"200\"
  data-parsley-minlength-message=\"Minimal 20 karakter\" data-parsley-validation-threshold=\"10\"");
  ?>
  <div class="ln_solid"></div>
  <div class="form-group">
    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
      <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-close"></i> Tutup</button>
      <button class="btn btn-primary" type="reset"><i class="fa fa-refresh"></i> Ulang</button>
      <button type="submit" name="insert" class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
    </div>
  </div>

</form>
