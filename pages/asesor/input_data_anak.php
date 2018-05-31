<?php
if($_GET){
    //$Kode=$_GET['Kode'];
}
if(isset($_POST['lanjut'])){

// $idkategori = $_POST['txt1'];
//     if($Kode=="View-Instrumen")
//         echo "<meta http-equiv='refresh' content='0; url=?page=Instrumen-Data&idk=".encD($idkategori)."'>";  

  $nama = $_POST['txt1'];
  $jenis_kelamin = $_POST['txt2'];
  $tahun = substr( $_POST['txt3'], -4, 4);
  $bulan = substr( $_POST['txt3'], 3, 2);
  $tanggal = substr( $_POST['txt3'], 0, 2);
  $tanggal_lahir = $tahun."-".$bulan."-".$tanggal;

	// Convert Ke Date Time
  $biday = new DateTime($tanggal_lahir);
  $tgl = date('Y-m-d',$biday);
	$today = new DateTime();
	
	$diff = $today->diff($biday);

  echo "Umur: ". $diff->y ." Tahun ".$diff->m." Bulan";
  $usia = $diff->y." Tahun ".$diff->m." Bulan";
  $nama_ortu = $_POST['txt4'];
  $alamat = $_POST['txt5'];
  $no_kontak = $_POST['txt6'];
  

  $tanggal_asesmen = date('Y-m-d');
  $id_kategori = $_POST['txt7'];
  $id_user = $_SESSION['UNCLE_userid'];

  $pesanError = array();
  //$pesanError[]=$tahun."-".$bulan."-".$tanggal;
  // $arrCrit = array($txt1);
  // $cekAda = "Select count(*) FROM kategori WHERE kategori_instrumen=?";
  // if(getDataNumber($koneksidb,$cekAda,$arrCrit)>0)
  //   $pesanError[]="Kategori sudah ada";
  
    if (count($pesanError)>=1 ){  
      showMessageRed($pesanError);
      buatLog($_SESSION['UNCLE_username'],"INSERT FAIL",getStringArray($pesanError)); 
    } 
    else { 
      $arrCriteria = array(1,$nama,$jenis_kelamin,$tanggal_lahir,$usia,$nama_ortu,$alamat,$no_kontak,$tanggal_asesmen,$id_kategori,$id_user);
      $insertQuery	= "INSERT INTO siswa (status,nama,jenis_kelamin,tanggal_lahir,usia,nama_ortu,alamat,no_kontak,tanggal_asesmen,id_kategori,id_user) 
                          VALUES (?,?,?,?,?,?,?,?,?,?,?)"; 
      
      if(execSql($koneksidb,$insertQuery,$arrCriteria)){ 
        buatLog($_SESSION['UNCLE_username'],"INSERT SUCCESS",$insertQuery." : ".getStringArray($arrCriteria)); 
        $id_siswa = $koneksidb->lastInsertId();
        
        echo $id_siswa;
        $arrCriteria = array($id_kategori);
        $result = getDataCriteriaAll($koneksidb,"SELECT id FROM instrumen WHERE id_kategori_instrumen=?",$arrCriteria);
        //echo $result;
        $ids_instrumen = array();
    
        foreach ($result as $value) {
            $ids_instrumen[]=$value['0'];           
        }

        $jmlData = count($ids_instrumen);
        echo $jmlData;
        for($i=0;$i<$jmlData;$i++){
          $arrCriteria = array(1,$id_siswa,$ids_instrumen[$i]);
          $insertQuery	= "INSERT INTO asesmen_siswa (status,id_siswa,id_instrumen) 
                          VALUES (?,?,?)"; 
          $hasil = execSql($koneksidb,$insertQuery,$arrCriteria);
        }
        
        
        echo "<meta http-equiv='refresh' content='0; url=?page=Asesmen-Instrumen&ids=".encD($id_siswa)."'>"; 

        
      } 
      //exit; 
    } 

}
?>

<form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" enctype="multipart/form-data" method="POST" >
  <?php 

input("text","Nama",1,"","autofocus required"); 
inputRadio("text","Jenis Kelamin",2,"","required"); 
input("text","Tanggal Lahir (TGL/BLN/THN)",3,""," data-inputmask=\"'mask': '99/99/9999'\" required");
input("text","Nama Orang Tua",4,"","required"); 
inputTextArea("text","Alamat",5,"","required"); 
input("text","No Kontak",6,"","data-parsley-type=\"digits\" required"); 
    $result = getDataAll($koneksidb,"SELECT id,kategori_instrumen FROM kategori");
    $pilihan = array();
    $paly = array();
    foreach ($result as $value) {
        $paluy[]=$value['0'];
        $pilihan[]=$value['1'];
    }
    //$paluy = $piliha;
select("Kategori",7,"",$paluy,$pilihan);
  ?>
  <div class="ln_solid"></div>
  <div class="form-group">
    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
      <button type="button" class="btn btn-default" onclick="window.history.go(-1);"><i class="fa fa-arrow-left"></i> Kembali</button>
      <button class="btn btn-primary" type="reset"><i class="fa fa-refresh"></i> Ulang</button>
      <button type="submit" name="lanjut" class="btn btn-success"><i class="fa fa-arrow-right"></i> Lanjut</button>
    </div>
    
  </div>
  <div class="ln_solid"></div>
    <div class="ln_solid"></div>
    <div class="ln_solid"></div>

</form>