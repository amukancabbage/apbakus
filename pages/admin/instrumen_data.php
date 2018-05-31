<?php 
    require "library/sesadmin.php"; 

    if($_GET){
    $idk=decD($_GET['idk']);
    $arrCriteria = array($idk);
    $query = "SELECT kategori_instrumen FROM kategori WHERE id=?";
    $data=getDataCriteria($koneksidb,$query,$arrCriteria);
    $kategori = $data[0];
    
  }
  if(isset($_POST['insert']))
	{ 
    $txt1 = $_POST['txt1'];
    $txt2 = $_FILES['txt2']['name']; 
    $txt3 = $_POST['txt3'];
    
    $userid = $_SESSION['UNCLE_userid']; 


    
    $pesanError = array();

    if(!empty($txt2)){
      if(cekFileTipe('txt2','jpg')!=""){
        $pesanError[]="tipe file bukan jpg";
      }else{
        $txt2 = uploadGambar('txt2',date("ymdhisa")."-".$userid,'jpg');
      }      
    }else{
      $txt2="no_image.jpg";
    }

    // $arrCrit = array($txt1);
    // $cekAda = "Select count(*) FROM instrumen WHERE nama_user=?";
    // if(getDataNumber($koneksidb,$cekAda,$arrCrit)>0)
    //   $pesanError[]="username sudah ada";

    
    
    
      if (count($pesanError)>=1 ){  
        showMessageRed($pesanError);
        buatLog($_SESSION['UNCLE_username'],"INSERT FAIL",getStringArray($pesanError)); 
      } 
      else { 
        $arrCriteria = array(1,$userid,$idk,$txt1,$txt2,$txt3);
        $insertQuery	= "INSERT INTO instrumen (status,id_pengguna,id_kategori_instrumen, butir, gambar, keterangan) VALUES (?,?,?,?,?,?)"; 
        
        if(execSql($koneksidb,$insertQuery,$arrCriteria)){ 
          buatLog($_SESSION['UNCLE_username'],"INSERT SUCCESS",$insertQuery." : ".getStringArray($arrCriteria)); 
          showMessageGreen("Data berhasil ditambahkan");
        } 
        //exit; 
      } 
   
  }
    //$idk=$_GET['idk'];
    
?>
<div class="page-title">
    <div class="title_left">
    <h3>Data <?php echo $kategori; ?> <small></small></h3>
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
                          <?php include "instrumen_baru.php" ;?>
                        </div>
                        <!-- <div class="modal-footer">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                          <button type="button" class="btn btn-primary">Save changes</button>
                        </div> -->

                      </div>
                    </div>
                  </div>  
    <?php
      $tableName = "instrumen"; 
      $formName = "Instrumen"; 
      $jmlField = "6"; 

      $field[0]="id"; 
      $isian[0]="Id"; 
      $field[1]="created_at"; 
      $isian[1]="Created At"; 
      $field[2]="updated_at"; 
      $isian[2]="Updated At"; 
      $field[3]="status"; 
      $isian[3]="Status"; 
      $field[4]="butir"; 
      $isian[4]="Butir Instrumen"; 
      $field[5]="gambar"; 
      $isian[5]="Nama Gambar"; 
      $field[6]="keterangan"; 
      $isian[6]="Keterangan"; 
      $mySql = "SELECT $tableName.* FROM ".$tableName." WHERE id_kategori_instrumen = $idk";
        showTable($koneksidb,$tableName,$isian,$field,$formName,$jmlField,$mySql);
    ?> 
    </div>
  </div>
</div>