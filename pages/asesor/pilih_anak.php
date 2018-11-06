<?php
if($_GET){
    $Kode=$_GET['Kode'];
}
if(isset($_POST['lanjut'])){

$idkategori = $_POST['txt1'];
    if($Kode=="View-Instrumen")
        echo "<meta http-equiv='refresh' content='0; url=?page=Instrumen-Data&idk=".encD($idkategori)."'>";  

}
if(isset($_POST['insert'])){
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

  if (count($pesanError)>=1 ){  
  showMessageRed($pesanError);
  buatLog($_SESSION['UNCLE_username'],"INSERT FAIL",getStringArray($pesanError)); 
  } 
  else { 
  $arrCriteria = array(1,$nama,$jenis_kelamin,$tanggal_lahir,$nama_ortu,$alamat,$no_kontak,$id_user);
  $insertQuery	= "INSERT INTO anak (status,nama,jenis_kelamin,tanggal_lahir,nama_ortu,alamat,no_kontak,id_user) 
                    VALUES (?,?,?,?,?,?,?,?)"; 

  if(execSql($koneksidb,$insertQuery,$arrCriteria)){ 
  buatLog($_SESSION['UNCLE_username'],"INSERT SUCCESS",$insertQuery." : ".getStringArray($arrCriteria)); 
  $id_anak = $koneksidb->lastInsertId();
  echo "<meta http-equiv='refresh' content='0; url=?page=Pilih-Kategori-Asesmen&ida=".encD($id_anak)."'>"; 
    //showMessageGreen("Data berhasil ditambahkan");
  } 
  //exit; 
  } 
}
?>

<div class="page-title">
    <div class="title_left">
    <h3>Pilih Data Anak Berkebutuhan Khusus<small></small></h3>
    </div>
</div>

<div class="clearfix"></div>


<?php if($Kode=="Asesmen"){ ?>
<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
    <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" enctype="multipart/form-data" method="POST" >
    <button type="button" class="btn btn-primary bg-green" data-toggle="modal" data-target=".bs-example-modal-lg"  ><i class="fa fa-plus"></i> BUAT DATA BARU</button>

                    <div class="modal fade bs-example-modal-lg"  id = "myModal" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                      <div class="modal-content">

                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                          </button>
                          <h4 class="modal-title" id="myModalLabel">Tambah data</h4>
                          
                        </div>
                        <div class="modal-body">
                          <?php include "anak_baru.php" ;?>                            
                        </div>
                         <!-- <div class="modal-footer">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                          <button type="button" class="btn btn-primary">Save changes</button>
                        </div>  -->

                      </div>
                    </div>
                  </div>   
    <?php
}
      $tableName = "siswa"; 
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

      // $arrCriteria = array($jmlField);
      $mySql = "SELECT * from anak";
      // showTable($koneksidb,$tableName,$isian,$field,$formName,$jmlField,$mySql,$arrCriteria);
      if($Kode=="Asesmen")
        showTablePilih($koneksidb,$isian,$field,"Pilih-Kategori-Asesmen",$jmlField,$mySql);
      else if($Kode=="Lihat")
        showTablePilih($koneksidb,$isian,$field,"Pilih-Asesmen",$jmlField,$mySql);
    ?> 
      <!-- <button type="button" class="btn btn-default" onclick="window.history.go(-1);"><i class="fa fa-arrow-left"></i> Kembali</button>
      <button class="btn btn-primary" type="reset"><i class="fa fa-refresh"></i> Ulang</button>
      <button type="submit" name="lanjut" class="btn btn-success"><i class="fa fa-arrow-right"></i> Lanjut</button> -->
    </div>
  </div>

</form>