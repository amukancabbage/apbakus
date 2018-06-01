<?php 
require "library/sesadmin.php"; 
if($_GET){
    $Kode=$_GET['Kode'];
    $Kode=decD($Kode);
    $tableName = "anak";
	$namaForm = ucwords(str_replace("t_","",$tableName));
    $arrCriteria = array($Kode);
    $query = "SELECT * FROM $tableName WHERE id=?";
    $data=getDataCriteria($koneksidb,$query,$arrCriteria);
}

if(isset($_POST['edit'])){

    $txt0 = $Kode;
    $nama = $_POST['txt1'];
    $jenis_kelamin = $_POST['txt2'];
    
    $tahun = substr( $_POST['txt3'], -4, 4);
    $bulan = substr( $_POST['txt3'], 3, 2);
    $tanggal = substr( $_POST['txt3'], 0, 2);
    $tanggal_lahir = $tahun."-".$bulan."-".$tanggal;        
      
    $nama_ortu = $_POST['txt4'];
    $alamat = $_POST['txt5'];
    $no_kontak = $_POST['txt6'];

    $id_user = $_SESSION['UNCLE_userid'];

    $pesanError = array();

    if(!checkmydate($tanggal_lahir))
    $pesanError[] = "Format Tanggal Harus TGL/BLN/THN";
    
      if (count($pesanError)>=1 ){  
        showMessageRed($pesanError);
        buatLog($_SESSION['UNCLE_username'],"UPDATE FAIL",getStringArray($pesanError)); 
      } 
      else { 
        $arrCriteria = array($nama,$jenis_kelamin,$tanggal_lahir,$nama_ortu,$alamat,$no_kontak,$id_user,$Kode);
        $editQuery	= "UPDATE anak set nama=?, jenis_kelamin=?, tanggal_lahir=?, nama_ortu=?, alamat=?, no_kontak=?, id_user=? WHERE id=?"; 
        
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
    inputHidden("id",0,$Kode,"disabled"); 
    input("text","Nama",1,$data[4],"autofocus required"); 
    inputRadio("text","Jenis Kelamin",2,$data[5],"required"); 
        $tahun = substr( $data[6], 0, 4);
        $bulan = substr( $data[6], -5, 2);
        $tanggal = substr( $data[6], -2, 2);
        $tanggal_lahir = $tanggal."-".$bulan."-".$tahun;   
    input("text","Tanggal Lahir (TGL/BLN/THN)",3,$tanggal_lahir," data-inputmask=\"'mask': '99/99/9999'\" required");
    input("text","Nama Orang Tua",4,$data[7],"required"); 
    inputTextArea("text","Alamat",5,$data[8],"required"); 
    input("text","No Kontak",6,$data[9],"data-parsley-type=\"digits\" required"); 
  ?>
  <div class="ln_solid"></div>
  <div class="form-group">
    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
      <button class="btn btn-primary" type="reset" onclick="window.history.go(-1);"><i class="fa fa-arrow-left"></i> Kembali</button>
      <button type="submit" name="edit" class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
    </div>
  </div>

</form>