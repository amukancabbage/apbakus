<?php 
if($_GET){
    $Kode=decD($_GET['Kode']);
    $tableName = "pengguna";
	$namaForm = ucwords(str_replace("t_","",$tableName));
    $arrCriteria = array($Kode);
    $query = "SELECT * FROM $tableName WHERE id=?";
    $data=getDataCriteria($koneksidb,$query,$arrCriteria);
}

if(isset($_POST['edit'])){

    $txt0 = $Kode;
    $txt1 = $_POST['txt1'];
    $txt2 = $_POST['txt2'];
    $txt3 = $_POST['txt3'];
    $txt4 = $_POST['txt4'];
    $txt5 = $_POST['txt5'];
    $txt6 = $_POST['txt6'];
    $txt7 = $_FILES['txt7']['name'];  

    $passEdit="";
    if($txt2!="")
      $passEdit = "user_password=?,";
    
    $pesanError = array();
    if(!empty($txt7)){
      if(cekFileTipe('txt7','jpg')!=""){
        $pesanError[]="tipe file bukan jpg";
      }else{
        $txt7 = uploadAvatar('txt7',$txt1,'jpg');
      }      
    }

    

    $arrCrit = array($txt1,$txt0);
    $cekAda = "Select count(*) FROM $tableName WHERE nama_user=? and id!=?";
    if(getDataNumber($koneksidb,$cekAda,$arrCrit)>0)
      $pesanError[]="Username sudah ada";
    
      if (count($pesanError)>=1 ){  
        showMessageRed($pesanError);
        buatLog($_SESSION['UNCLE_username'],"UPDATE FAIL",getStringArray($pesanError)); 
      } 
      else { 
        if($txt2!="")
          $arrCriteria =array($txt1,$txt4,$txt5,$txt2,$txt6,$txt7,$txt0);
        else
          $arrCriteria =array($txt1,$txt4,$txt5,$txt6,$txt7,$txt0);
        
        $editQuery	= "UPDATE $tableName set nama_user=?,nama_lengkap=?,no_kontak=?,$passEdit level=?,avatar=? WHERE id=?"; 
        
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
    input("text","Username",1,$data['nama_user'],"required"); 
    input("password","Password",2,"","data-parsley-length=\"[6, 25]\""); 
    input("password","Password (Ulangi)",3,"","data-parsley-equalto=\"#txt2\""); 
    input("text","Nama Lengkap",4,$data['nama_lengkap'],"required"); 
    input("text","No Kontak",5,$data['no_kontak'],"data-parsley-type=\"digits\" required"); 
    $pilihan = array("Admin Dinas","User Bidang","User Balai");
    $paluy = array("1","2","3");
    select("Level",6,$data['level'],$paluy,$pilihan);
    input("file","Foto",7,"","");
  ?>
  <div class="ln_solid"></div>
  <div class="form-group">
    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
      <button class="btn btn-primary" type="reset" onclick="window.history.go(-1);"><i class="fa fa-arrow-left"></i> Kembali</button>
      <button type="submit" name="edit" class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
    </div>
  </div>

</form>