<?php 
require "library/sesadmin.php"; 
if($_GET){
    $Kode=$_GET['Kode'];
    $Kode=decD($Kode);
    $tableName = "kategori";
	$namaForm = ucwords(str_replace("t_","",$tableName));
    $arrCriteria = array($Kode);
    $query = "SELECT * FROM $tableName WHERE id=?";
    $data=getDataCriteria($koneksidb,$query,$arrCriteria);
}

if(isset($_POST['edit'])){

    $txt0 = $Kode;
    $txt1 = $_POST['txt1'];
    $txt2 = $_POST['txt2'];

    $pesanError = array();

    $arrCrit = array($txt1,$txt0);
    $cekAda = "Select count(*) FROM $tableName WHERE kategori_instrumen=? and id!=?";
    if(getDataNumber($koneksidb,$cekAda,$arrCrit)>0)
      $pesanError[]="kategori sudah ada";
    
      if (count($pesanError)>=1 ){  
        showMessageRed($pesanError);
        buatLog($_SESSION['UNCLE_username'],"UPDATE FAIL",getStringArray($pesanError)); 
      } 
      else { 
        $arrCriteria =array($txt1,$txt2,$txt0);
        $editQuery	= "UPDATE kategori set kategori_instrumen=?, deskripsi=? WHERE id=?"; 
        
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
    input("text","Kategori Instrumen",1,$data[4],"autofocus required"); 
    inputTextArea("text","Deskripsi",2,$data[5],"required data-parsley-trigger=\"keyup\" data-parsley-minlength=\"20\" data-parsley-maxlength=\"200\" 
    data-parsley-minlength-message=\"Minimal 20 karakter\" data-parsley-validation-threshold=\"10\""); 
  ?>
  <div class="ln_solid"></div>
  <div class="form-group">
    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
      <button class="btn btn-primary" type="reset" onclick="window.history.go(-1);"><i class="fa fa-arrow-left"></i> Kembali</button>
      <button type="submit" name="edit" class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
    </div>
  </div>

</form>