<?php 
require "library/sesadmin.php"; 
if($_GET){
    $Kode=$_GET['Kode'];
    $Kode=decD($Kode);
    $tableName = "t_kabupaten";
	$namaForm = ucwords(str_replace("t_","",$tableName));
    $arrCriteria = array($Kode);
    $query = "SELECT * FROM $tableName WHERE id=?";
    $data=getDataCriteria($koneksidb,$query,$arrCriteria);
}

if(isset($_POST['edit'])){

    $txt0 = $Kode;
    $txt1 = strtoupper($_POST['txt1']);
    $txt2 = $_POST['txt2'];
    $txt3 = $_POST['txt3'];

    $pesanError = array();

    $arrCrit = array($txt2,$txt0);
    $cekAda = "Select count(*) FROM $tableName WHERE nama_kabupaten=? and id!=?";
    if(getDataNumber($koneksidb,$cekAda,$arrCrit)>0)
      $pesanError[]="Kabupaten sudah ada";
    
    $arrCrit = array($txt1,$txt0);
    $cekAda = "Select count(*) FROM $tableName WHERE kode=? and id!=?";
    if(getDataNumber($koneksidb,$cekAda,$arrCrit)>0)
      $pesanError[]="Kode Kabupaten sudah ada";
    
      if (count($pesanError)>=1 ){  
        showMessageRed($pesanError);
        buatLog($_SESSION['UNCLE_username'],"UPDATE FAIL",getStringArray($pesanError)); 
      } 
      else { 
        $arrCriteria =array($txt1,$txt2,$txt3,$txt0);
        $editQuery	= "UPDATE t_kabupaten set kode=?,nama_kabupaten=?,id_provinsi=? WHERE id=?"; 
        
        if(execSql($koneksidb,$editQuery,$arrCriteria)){ 
          buatLog($_SESSION['UNCLE_username'],"UPDATE SUCCESS",$editQuery." : ".getStringArray($arrCriteria)); 
          echo "<meta http-equiv='refresh' content='0; url=?page=".$namaForm."-Data'>";  
        } 
        exit; 
      } 
}


?>

<form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" enctype="multipart/form-data" method="POST" >
  <?php 
    input("text","Kode",1,$data[5],"autofocus required style=\"text-transform:uppercase\""); 
    input("text","Kabupaten",2,$data[6],"required"); 
    $result = getDataAll($koneksidb,"SELECT id,nama_provinsi FROM t_provinsi");
    $pilihan = array();
    $paly = array();
    foreach ($result as $value) {
        $paluy[]=$value['0'];
        $pilihan[]=$value['1'];
    }
    //$paluy = $piliha;
    select("Provinsi",3,$data[4],$paluy,$pilihan);
  ?>
  <div class="ln_solid"></div>
  <div class="form-group">
    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
      <button class="btn btn-primary" type="reset" onclick="window.history.go(-1);"><i class="fa fa-arrow-left"></i> Kembali</button>
      <button type="submit" name="edit" class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
    </div>
  </div>

</form>