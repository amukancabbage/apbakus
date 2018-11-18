<?php
if(isset($_POST['insert']))
{
  $txt1 = $_POST['txt1'];
  $txt2 = $_POST['txt2'];

  $pesanError = array();

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
  showMessageGreen("Data berhasil ditambahkan");
}else{
  showMessageRed("Data gagal ditambahkan");
}
}
?>
<form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" enctype="multipart/form-data" method="POST" >
  <?php
  input("text","Tipe",1,"","autofocus required");
  inputTextArea("text","Deskripsi",2,"","required data-parsley-trigger=\"keyup\" data-parsley-minlength=\"20\" data-parsley-maxlength=\"200\"
  data-parsley-minlength-message=\"Minimal 20 karakter\" data-parsley-validation-threshold=\"10\"");

  $result = getDataAll($koneksidb,"SELECT id,kategori_instrumen FROM kategori");
  $pilihan = array();
  $paly = array();
  foreach ($result as $value) {
      $paluy[]=$value['0'];
      $pilihan[]=$value['1'];
  }
  //$paluy = $piliha;
  select("Kategori",1,"",$paluy,$pilihan);
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
