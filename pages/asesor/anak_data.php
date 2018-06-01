<?php 
  require "library/sesadmin.php"; 
  if(isset($_POST['insert']))
	{ 
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

        //$biday = new DateTime($tanggal_lahir);
        // $today = new DateTime();
        // $diff = $today->diff($biday);
        // echo "Umur: ". $diff->y ." Tahun ".$diff->m." Bulan";
        // $usia = $diff->y." Tahun ".$diff->m." Bulan";
        

    $pesanError = array();

    // $arrCrit = array($txt1);
    // $cekAda = "Select count(*) FROM kategori WHERE kategori_instrumen=?";
    // if(getDataNumber($koneksidb,$cekAda,$arrCrit)>0)
    //   $pesanError[]="Kategori sudah ada";
    
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
          showMessageGreen("Data berhasil ditambahkan");
        } 
        //exit; 
      } 
   
  }
?>
<div class="page-title">
    <div class="title_left">
    <h3>Data Anak Berkebutuhan Khusus <small></small></h3>
    </div>
</div>

<div class="clearfix"></div>

<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
   
    <button type="button" class="btn btn-primary bg-green" data-toggle="modal" data-target=".bs-example-modal-lg"  ><i class="fa fa-plus"></i> TAMBAH DATA</button>

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
                        </div> -->

                      </div>
                    </div>
                  </div>  
    <?php
      $tableName = "anak"; 
      $formName = "Anak"; 
      $jmlField = "9"; 

      $field[0]="id"; 
      $isian[0]="Id"; 
      $field[1]="created_at"; 
      $isian[1]="Created At"; 
      $field[2]="updated_at"; 
      $isian[2]="Updated At"; 
      $field[3]="status"; 
      $isian[3]="Status"; 
      $field[4]="nama"; 
      $isian[4]="Nama Anak"; 
      $field[5]="jenis_kelamin"; 
      $isian[5]="Jenis Kelamin"; 
      $field[6]="tanggal_lahir"; 
      $isian[6]="Tanggal Lahir"; 
      $field[7]="nama_ortu"; 
      $isian[7]="Nama Orang Tua"; 
      $field[8]="alamat"; 
      $isian[8]="Alamat"; 
      $field[9]="no_kontak"; 
      $isian[9]="Nomor Kontak"; 
      // $field[5]="deskripsi"; 
      // $isian[5]="Deskripsi"; 
      $mySql = "SELECT $tableName.* FROM ".$tableName;
        showTable($koneksidb,$tableName,$isian,$field,$formName,$jmlField,$mySql);
    ?> 
    </div>
  </div>
</div>