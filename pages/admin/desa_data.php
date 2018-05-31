<?php 
  require "library/sesadmin.php"; 
  $tableName = "t_desa"; 
  if(isset($_POST['insert']))
	{ 
    $txt1 = strtoupper($_POST['txt1']);
    $txt2 = $_POST['txt2'];
    $txt3 = $_POST['txt3'];

    $pesanError = array();

    $arrCrit = array($txt2);
    $cekAda = "Select count(*) FROM $tableName WHERE nama_desa=?";
    if(getDataNumber($koneksidb,$cekAda,$arrCrit)>0)
      $pesanError[]="Kelurahan/Desa sudah ada";
    
    $arrCrit = array($txt1);
    $cekAda = "Select count(*) FROM $tableName WHERE kode=?";
    if(getDataNumber($koneksidb,$cekAda,$arrCrit)>0)
      $pesanError[]="Kode Kelurahan/Desa sudah ada";
    
      if (count($pesanError)>=1 ){  
        showMessageRed($pesanError);
        buatLog($_SESSION['UNCLE_username'],"INSERT FAIL",getStringArray($pesanError)); 
      } 
      else { 
        $arrCriteria = array(1,$txt3,$txt1,$txt2);
        $insertQuery	= "INSERT INTO $tableName (status,id_kecamatan,kode,nama_desa) VALUES (?,?,?,?)"; 
        
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
    <h3>Data Kelurahan/Desa <small></small></h3>
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
                          <?php include "desa_baru.php" ;?>                            
                        </div>
                        <!-- <div class="modal-footer">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                          <button type="button" class="btn btn-primary">Save changes</button>
                        </div> -->

                      </div>
                    </div>
                  </div>  
    <?php
      
      $formName = "Desa"; 
      $jmlField = "6"; 

      $field[0]="id"; 
      $isian[0]="Id"; 
      $field[1]="created_at"; 
      $isian[1]="Created At"; 
      $field[2]="updated_at"; 
      $isian[2]="Updated At"; 
      $field[3]="status"; 
      $isian[3]="Status"; 
      $field[4]="kode"; 
      $isian[4]="Kode"; 
      $field[5]="nama_desa"; 
      $isian[5]="Nama Kelurahan/Desa"; 
      $field[6]="nama_kecamatan"; 
      $isian[6]="Nama Kecamatan"; 
      $mySql = "SELECT t_desa.id, t_desa.kode, t_desa.nama_desa, t_kecamatan.nama_kecamatan FROM t_desa INNER JOIN t_kecamatan ON t_kecamatan.id=t_desa.id_kecamatan";
        showTable($koneksidb,$tableName,$isian,$field,$formName,$jmlField,$mySql);
    ?> 
    </div>
  </div>
</div>