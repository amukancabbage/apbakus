<?php 
require "library/sesadmin.php"; 
if($_GET){
    $Kode=$_GET['Kode'];
    $Kode=decD($Kode);
    $tableName = "t_komoditas";
	  $namaForm = ucwords(str_replace("t_","",$tableName));
    $arrCriteria = array($Kode);
    $query = "SELECT * FROM $tableName WHERE id=?";
    $data=getDataCriteria($koneksidb,$query,$arrCriteria);
}

if(isset($_POST['edit'])){

    $txt0 = $Kode;
    $txt1 = strtoupper($_POST['txt1']);
    $txt2 = $_POST['txt2'];
    $userid = $_SESSION['UNCLE_userid'];

    $pesanError = array();

    // $arrCrit = array($txt2,$txt0);
    // $cekAda = "Select count(*) FROM $tableName WHERE nama_desa=? and id!=?";
    // if(getDataNumber($koneksidb,$cekAda,$arrCrit)>0)
    //   $pesanError[]="Kelurahan/Desa sudah ada";
    
    // $arrCrit = array($txt1,$txt0);
    // $cekAda = "Select count(*) FROM $tableName WHERE kode=? and id!=?";
    // if(getDataNumber($koneksidb,$cekAda,$arrCrit)>0)
    //   $pesanError[]="Kode Kelurahan/Desa sudah ada";
    
      if (count($pesanError)>=1 ){  
        showMessageRed($pesanError);
        buatLog($_SESSION['UNCLE_username'],"UPDATE FAIL",getStringArray($pesanError)); 
      } 
      else { 
        $arrCriteria =array($txt1,$txt2,$userid,$txt0);
        $editQuery	= "UPDATE t_komoditas set nama_komoditas=?, jenis=?, id_pengguna=? WHERE id=?"; 
        
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
    input("text","Nama Komoditas",1,$data[4],"autofocus required style=\"text-transform:uppercase\""); 
    $pilihan = array("Horti","Pangan","Perkebunan","Peternakan");
    $paluy = array("Horti","Pangan","Perkebunan","Peternakan");
    select("Level",2,$data[5],$paluy,$pilihan);
  ?>
  <div class="ln_solid"></div>
  <div class="form-group">
    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
      <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-close"></i> Tutup</button>
      <button class="btn btn-primary" type="reset"><i class="fa fa-refresh"></i> Ulang</button>
      <button type="submit" name="edit" class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
    </div>
  </div>

</form>