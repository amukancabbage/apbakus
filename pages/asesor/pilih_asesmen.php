<?php
if($_GET){
    $id_anak=decD($_GET['ida']);

    $arrCriteria = array($id_anak);
    $query = "SELECT * FROM anak WHERE id=?";
    $data=getDataCriteria($koneksidb,$query,$arrCriteria);

    $today = new DateTime();	
    $biday = new DateTime($data[6]);
    $diff = $today->diff($biday);
    $usia = $diff->y." Tahun ".$diff->m." Bulan";
    
}
if(isset($_POST['lanjut'])){

  $tanggal_asesmen = date('Y-m-d');
  $id_kategori = $_POST['txt9'];
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
      $arrCriteria = array(1,$id_anak,$id_kategori,$tanggal_asesmen,$usia,$id_user);
      $insertQuery	= "INSERT INTO asesmen (status,id_anak,id_kategori,tanggal_asesmen,usia,id_user) 
                          VALUES (?,?,?,?,?,?)"; 
      
      if(execSql($koneksidb,$insertQuery,$arrCriteria)){ 
        buatLog($_SESSION['UNCLE_username'],"INSERT SUCCESS",$insertQuery." : ".getStringArray($arrCriteria)); 
        $id_asesmen = $koneksidb->lastInsertId();
        
        echo $id_asesmen;
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
          $arrCriteria = array(1,$id_asesmen,$ids_instrumen[$i]);
          $insertQuery	= "INSERT INTO asesmen_detail (status,id_asesmen,id_instrumen) 
                          VALUES (?,?,?)"; 
          $hasil = execSql($koneksidb,$insertQuery,$arrCriteria);
        }
        
        
        echo "<meta http-equiv='refresh' content='0; url=?page=Asesmen-Instrumen&ida=".encD($id_asesmen)."'>"; 

        
      } 
      //exit; 
    } 

}
 
?>

<form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" enctype="multipart/form-data" method="POST" >
  <?php 

    input("text","Nama",1,$data[4]," disabled"); 
    input("text","Jenis Kelamin",2,$data[5]," disabled"); 
        $tahun = substr( $data[6], 0, 4);
        $bulan = substr( $data[6], -5, 2);
        $tanggal = substr( $data[6], -2, 2);
        $tanggal_lahir = $tahun."-".$bulan."-".$tanggal;   
    input("text","Tanggal Lahir (TGL/BLN/THN)",3,Indonesia2Tgl($data[6]),"  disabled");
    input("text","Nama Orang Tua",4,$data[7]," disabled"); 
    inputTextArea("text","Alamat",5,$data[8]," disabled"); 
    input("text","No Kontak",6,$data[9],"data-parsley-type=\"digits\"  disabled");
    input("text","Tanggal Asesmen",7,Indonesia2Tgl(date("Y-m-d"))," disabled"); 
    input("text","Usia",8,$usia," disabled"); 
    
    $result = getDataAll($koneksidb,"SELECT id,kategori_instrumen FROM kategori");
    $pilihan = array();
    $paly = array();
    foreach ($result as $value) {
        $paluy[]=$value['0'];
        $pilihan[]=$value['1'];
    }
    //$paluy = $piliha;
select("Kategori",9,"",$paluy,$pilihan);
  ?>
  <div class="ln_solid"></div>
  <div class="form-group">
    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
      <button type="button" class="btn btn-default" onclick="window.history.go(-1);"><i class="fa fa-arrow-left"></i> Kembali</button>
      <button class="btn btn-primary" type="reset"><i class="fa fa-refresh"></i> Ulang</button>
      <button type="submit" name="lanjut" class="btn btn-success"><i class="fa fa-arrow-right"></i> Lanjut</button>

       <?php

      $tableName = "asesmen"; 
      $formName = "Siswa"; 
      $jmlField = "7"; 

      $field[0]="id"; 
      $isian[0]="Id"; 
      $field[1]="created_at"; 
      $isian[1]="Created At"; 
      $field[2]="updated_at"; 
      $isian[2]="Updated At"; 
      $field[3]="status"; 
      $isian[3]="Status"; 
      $field[4]="nama"; 
      $isian[4]="Nama"; 
      $field[5]="jenis_kelamin"; 
      $isian[5]="Jenis Kelamin"; 
      $field[6]="tanggal_lahir"; 
      $isian[6]="Tanggal Lahir"; 
      $field[7]="nama_ortu"; 
      $isian[7]="Nama Orang Tua"; 


      $mySql = "SELECT * from asesmen";
      showTablePilih($koneksidb,$isian,$field,"Hasil-Asesmen",$jmlField,$mySql);

    ?> 
    </div>
    
  </div>
  <div class="ln_solid"></div>
    <div class="ln_solid"></div>
    <div class="ln_solid"></div>

</form>