<?php
if($_GET){
    $Kode=$_GET['Kode'];
}
if(isset($_POST['lanjut'])){

$idkategori = $_POST['txt1'];
    if($Kode=="View-Instrumen")
        echo "<meta http-equiv='refresh' content='0; url=?page=Instrumen-Data&idk=".encD($idkategori)."'>";  

}
?>

<form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" enctype="multipart/form-data" method="POST" >
  <?php 

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
      <button type="button" class="btn btn-default" onclick="window.history.go(-1);"><i class="fa fa-arrow-left"></i> Kembali</button>
      <button class="btn btn-primary" type="reset"><i class="fa fa-refresh"></i> Ulang</button>
      <button type="submit" name="lanjut" class="btn btn-success"><i class="fa fa-arrow-right"></i> Lanjut</button>
    </div>
  </div>

</form>