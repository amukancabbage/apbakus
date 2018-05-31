<?php 
  require "library/sesadmin.php"; 
  if(isset($_POST['insert']))
	{ 
    $txt1 = $_POST['txt1'];
    $txt2 = $_POST['txt2'];
    $txt3 = $_POST['txt3'];
    $txt4 = $_POST['txt4'];
    $txt5 = $_POST['txt5'];
    $txt6 = $_POST['txt6'];
    $txt7 = $_FILES['txt7']['name'];  


    
    $pesanError = array();
    if(cekFileTipe('txt7','jpg')!=""){
      $pesanError[]="tipe file bukan jpg";
    }

    $arrCrit = array($txt1);
    $cekAda = "Select count(*) FROM pengguna WHERE nama_user=?";
    if(getDataNumber($koneksidb,$cekAda,$arrCrit)>0)
      $pesanError[]="username sudah ada";

    
      $txt7 = uploadAvatar('txt7',$txt1,'jpg');
    
      if (count($pesanError)>=1 ){  
        showMessageRed($pesanError);
        buatLog($_SESSION['UNCLE_username'],"INSERT FAIL",getStringArray($pesanError)); 
      } 
      else { 
        $arrCriteria = array(1,$txt1,md5($txt2),$txt4,$txt5,$txt6,$txt7);
        $insertQuery	= "INSERT INTO pengguna (status,nama_user,user_password,nama_lengkap,no_kontak,level,avatar) VALUES (?,?,?,?,?,?,?)"; 
        
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
    <h3>Data Pengguna <small></small></h3>
    </div>
</div>

<div class="clearfix"></div>

<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
    <button type="button" class="btn btn-primary bg-green" data-toggle="modal" data-target=".bs-example-modal-lg"><i class="fa fa-plus"></i> TAMBAH DATA</button>

                    <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                      <div class="modal-content">

                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                          </button>
                          <h4 class="modal-title" id="myModalLabel">Tambah data</h4>
                        </div>
                        <div class="modal-body">
                          <?php include "pengguna_baru.php" ;?>
                        </div>
                        <!-- <div class="modal-footer">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                          <button type="button" class="btn btn-primary">Save changes</button>
                        </div> -->

                      </div>
                    </div>
                  </div>  
    <?php
      $tableName = "pengguna"; 
      $formName = "Pengguna"; 
      $jmlField = "8"; 

      $field[0]="id"; 
      $isian[0]="Id"; 
      $field[1]="created_at"; 
      $isian[1]="Created At"; 
      $field[2]="updated_at"; 
      $isian[2]="Updated At"; 
      $field[3]="status"; 
      $isian[3]="Status"; 
      $field[4]="nama_user"; 
      $isian[4]="Nama User"; 
      $field[5]="nama_lengkap"; 
      $isian[5]="Nama Lengkap"; 
      $field[6]="no_kontak"; 
      $isian[6]="No Kontak"; 
      $field[7]="level"; 
      $isian[7]="Level"; 
      $field[8]="avatar"; 
      $isian[8]="Avatar"; 
      $mySql = "SELECT $tableName.* FROM ".$tableName;
        showTable($koneksidb,$tableName,$isian,$field,$formName,$jmlField,$mySql);
    ?> 
    </div>
  </div>
</div>