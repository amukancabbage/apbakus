<?php 
if($_GET){
    $Kode=decD($_GET['Kode']);
    $tableName = "instrumen";
	$namaForm = ucwords(str_replace("t_","",$tableName));
    $arrCriteria = array($Kode);
    $query = "SELECT * FROM $tableName WHERE id=?";
    $data=getDataCriteria($koneksidb,$query,$arrCriteria);
}

if(isset($_POST['edit'])){

    $txt0 = $Kode;
    $txt1 = $_POST['txt1'];
    $txt2 = $_FILES['txt2']['name'];  
    $txt3 = $_POST['txt3'];
    

    $passEdit="";
    if($txt2!="")
      $passEdit = "user_password=?,";
    
    $pesanError = array();
    if(!empty($txt2)){
      if(cekFileTipe('txt2','jpg')!=""){
        $pesanError[]="tipe file bukan jpg";
      }else{
        $query = "Select gambar from instrumen WHERE id=?";
        $arrCriteria = array(decD($_GET['Kode']));
        $data = getDataCriteria($koneksidb,$query,$arrCriteria);
        if(file_exists("./images/gambar_instrumen/".$data['gambar']))
				  unlink("./images/gambar_instrumen/".$data['gambar']);
        $txt2 = uploadGambar('txt2',date("ymdhisa")."-".$userid,'jpg');
      }      
    }

    

    // $arrCrit = array($txt1,$txt0);
    // $cekAda = "Select count(*) FROM $tableName WHERE nama_user=? and id!=?";
    // if(getDataNumber($koneksidb,$cekAda,$arrCrit)>0)
    //   $pesanError[]="Username sudah ada";
    
      if (count($pesanError)>=1 ){  
        showMessageRed($pesanError);
        buatLog($_SESSION['UNCLE_username'],"UPDATE FAIL",getStringArray($pesanError)); 
      } 
      else { 
        if(!empty($txt2)){
          $arrCriteria =array($txt1,$txt2,$txt3,$txt0);
          $editQuery	= "UPDATE $tableName set butir=?, gambar=?, keterangan=? WHERE id=?"; 
        }
        else{
          $arrCriteria =array($txt1,$txt3,$txt0);
          $editQuery	= "UPDATE $tableName set butir=?, keterangan=? WHERE id=?"; 
        }
        
        
        if(execSql($koneksidb,$editQuery,$arrCriteria)){ 
          buatLog($_SESSION['UNCLE_username'],"UPDATE SUCCESS",$editQuery." : ".getStringArray($arrCriteria)); 
          echo "<meta http-equiv='refresh' content='0; url=?page=Pilih-Kategori&Kode=View-Instrumen'>";  
        } 
        exit; 
      } 
}


?>

<form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" enctype="multipart/form-data" method="POST" >
  <?php 
    inputTextArea("text","Butir Instrumen",1,$data[6],"autofocus required");
    lihatGambar("Gambar tersimpan",$data[7]);
    input("file","Foto",2,"","");
    inputTextArea("text","Keterangan",3,$data[8],"required"); 
  ?>
  <div class="ln_solid"></div>                      
  <div class="form-group">
    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
      <button class="btn btn-primary" type="reset" onclick="window.history.go(-1);"><i class="fa fa-arrow-left"></i> Kembali</button>
      <button type="submit" name="edit" class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
    </div>
  </div>

</form>