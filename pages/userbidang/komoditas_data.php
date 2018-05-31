<?php 
  require "library/sesadmin.php"; 
  $tableName = "t_komoditas"; 
  if(isset($_POST['insert']))
	{ 
    $txt1 = strtoupper($_POST['txt1']);
    $txt2 = $_POST['txt2'];
    $userid = $_SESSION['UNCLE_userid'];

    $pesanError = array();

    // $arrCrit = array($txt2);
    // $cekAda = "Select count(*) FROM $tableName WHERE nama_peternak=?";
    // if(getDataNumber($koneksidb,$cekAda,$arrCrit)>0)
    //   $pesanError[]="Kelurahan/Desa sudah ada";
    
    // $arrCrit = array($txt1);
    // $cekAda = "Select count(*) FROM $tableName WHERE kode=?";
    // if(getDataNumber($koneksidb,$cekAda,$arrCrit)>0)
    //   $pesanError[]="Kode Kelurahan/Desa sudah ada";
    
      if (count($pesanError)>=1 ){  
        showMessageRed($pesanError);
        buatLog($_SESSION['UNCLE_username'],"INSERT FAIL",getStringArray($pesanError)); 
      } 
      else { 
        $arrCriteria = array(1,$txt1,$txt2,$userid);
        $insertQuery	= "INSERT INTO $tableName (status,nama_komoditas,jenis,id_pengguna) VALUES (?,?,?,?)"; 
        
        $execution = execSql($koneksidb,$insertQuery,$arrCriteria);
        if($execution){ 
          buatLog($_SESSION['UNCLE_username'],"INSERT SUCCESS",$insertQuery." : ".getStringArray($arrCriteria)); 
          showMessageGreen("Data berhasil ditambahkan");
        }else{
          showMessageRed($execution);
        }
        //exit; 
      } 
   
  }
?>
<div class="page-title">
    <div class="title_left">
    <h3>Data Komoditas <small></small></h3>
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
                          <?php include "komoditas_baru.php" ;?>                            
                        </div>
                        <!-- <div class="modal-footer">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                          <button type="button" class="btn btn-primary">Save changes</button>
                        </div> -->

                      </div>
                    </div>
                  </div>  
    <?php
      
      $formName = "Komoditas"; 
      $jmlField = "5"; 

      $field[0]="id"; 
      $isian[0]="Id"; 
      $field[1]="created_at"; 
      $isian[1]="Created At"; 
      $field[2]="updated_at"; 
      $isian[2]="Updated At"; 
      $field[3]="status"; 
      $isian[3]="Status"; 
      $field[4]="nama_komoditas"; 
      $isian[4]="Nama Komoditas"; 
      $field[5]="jenis"; 
      $isian[5]="Jenis"; 
      $mySql = "SELECT t_komoditas.id, t_komoditas.nama_komoditas, t_komoditas.jenis FROM t_komoditas";
        showTable($koneksidb,$tableName,$isian,$field,$formName,$jmlField,$mySql);
    ?> 
    </div>
  </div>
</div>