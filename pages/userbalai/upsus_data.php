<?php 
if($_GET){
  $bulan=decD($_GET['bulan']);
  $tahun=decD($_GET['tahun']);
  $iddesa=decD($_GET['iddesa']);
  $idpenyuluh=decD($_GET['idpenyuluh']);
  
  // $tableName = "t_komoditas";
  // $namaForm = ucwords(str_replace("t_","",$tableName));
  // $arrCriteria = array($Kode);
  // $query = "SELECT * FROM $tableName WHERE id=?";
  // $data=getDataCriteria($koneksidb,$query,$arrCriteria);

if(isset($_POST['insert'])){
  $userid = $_SESSION['UNCLE_userid'];

  $txt1 = $_POST['txt1'];
  $arrCriteria = array($tahun);
  $jumlah = getDataNumber2($koneksidb,"SELECT t_tahunkomoditas.id, t_komoditas.nama_komoditas, t_komoditas.id FROM t_tahunkomoditas INNER JOIN t_komoditas ON t_tahunkomoditas.id_komoditas = t_komoditas.id WHERE t_tahunkomoditas.tahun=? AND t_komoditas.jenis='Horti' ",$arrCriteria);
  $txt = array();
  for($i=1;$i<=$jumlah;$i++){
    $txt[$i."2"] = $_POST["txt".$i."2"];
    $txt[$i."3"] = $_POST["txt".$i."3"];
    $txt[$i."4"] = $_POST["txt".$i."4"];
    $txt[$i."5"] = $_POST["txt".$i."5"];
    $txt[$i."6"] = $_POST["txt".$i."6"];
    $txt[$i."7"] = $_POST["txt".$i."7"];

    if($txt[$i."3"]!=null){

    $arrCriteria = array(1,$userid,$idpenyuluh,$txt1,$txt[$i."7"],$bulan,$tahun,$txt[$i."2"],$txt[$i."3"],$txt[$i."4"],$txt[$i."5"],$txt[$i."6"]);
    $insertQuery	= "INSERT INTO t_upsus (status,id_pengguna,id_penyuluh,id_poktan,id_komoditas,bulan,tahun,tanam_tanggal,tanam_luas,panen_tanggal,panen_luas,produksi) VALUES (?,?,?,?,?,?,?,?,?,?,?,?)"; 
    $execution = execSql($koneksidb,$insertQuery,$arrCriteria);
      if($execution){ 
        buatLog($_SESSION['UNCLE_username'],"INSERT SUCCESS",$insertQuery." : ".getStringArray($arrCriteria)); 
        showMessageGreen("Data berhasil ditambahkan ");
      }else{
        //showMessageRed($execution);
      }
    }
  }

  
  
  

}
}
?>
<div class="row">
  <div class="x_panel">
    <div class="x_title">
      <h2>DATA UPSUS</h2>
      <div class="clearfix"></div>
    </div>
    <div class="x_content">
      <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" enctype="multipart/form-data" method="POST" >
        <?php     
          $result = getDataAll($koneksidb,"SELECT id, poktan, nama_petani FROM t_poktan order by poktan");
          $pilihan = array();
          $paluy = array();
          foreach ($result as $value) {
              $paluy[]=$value['0'];
              $pilihan[]=$value['1']." - ".$value[2];
          }
          //$paluy = $piliha;
          select("Kelompok Tani",1,"",$paluy,$pilihan);

          // $result = getDataAll($koneksidb,"SELECT t_tahunkomoditas.id, t_komoditas.nama_komoditas FROM t_tahunkomoditas INNER JOIN t_komoditas ON t_tahunkomoditas.id_komoditas = t_komoditas.id WHERE t_tahunkomoditas.tahun=$tahun AND t_komoditas.jenis='Horti' ");
          // $pilihan = array();
          // $paluy = array();
          // foreach ($result as $value) {
          //     $paluy[]=$value['0'];
          //     $pilihan[]=$value['1'];
          // }
          // //$paluy = $piliha;
          // select("Komoditas",1,"",$paluy,$pilihan);
          $queryTahunKomoditas = "SELECT t_tahunkomoditas.id, t_komoditas.nama_komoditas, t_komoditas.id FROM t_tahunkomoditas INNER JOIN t_komoditas ON t_tahunkomoditas.id_komoditas = t_komoditas.id WHERE t_tahunkomoditas.tahun=$tahun AND t_komoditas.jenis='Horti' ";
          $result = getDataAll($koneksidb,$queryTahunKomoditas);
         
          $nokomponen = 1;
          $pilihan = array();
          $paluy = array();
          foreach ($result as $value) {
            $paluy[]=$value['0'];
            $pilihan[]=$value['1'];
          ?>
        <div class="ln_solid"></div>
        <h2><?php echo $value['1']; ?></h2>
        <?php 
        input("text","Tanggal Tanam",$nokomponen."2",""," data-inputmask=\"'mask': '99/99/9999'\" "); 
        input("text","Luas Tanam",$nokomponen."3",""," data-parsley-type=\"digits\" "); 
        input("text","Tanggal Panen",$nokomponen."4",""," data-inputmask=\"'mask': '99/99/9999'\" "); 
        input("text","Luas Panen",$nokomponen."5",""," data-parsley-type=\"digits\" ");
        input("text","Produksi",$nokomponen."6",""," data-parsley-type=\"digits\" ");
        input("text","IDKOMODITAS",$nokomponen."7",$value['2']," data-parsley-type=\"digits\" ");
        $nokomponen++;
        } ?>
        <div class="ln_solid"></div>
        <div class="form-group">
          <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
          <button type="submit" name="insert" class="btn btn-success"><i class="fa fa-arrow-right"></i> Lanjut</button>
          <button class="btn btn-primary" type="reset"><i class="fa fa-refresh"></i> Ulang</button>
        </div>
        </div>
        <div class="ln_solid"></div>
      
      <?php
      input("text","Bulan/Tahun","",$bulan."/".$tahun," readonly "); 
      $arrCriteria = array($iddesa);
      $query = "SELECT nama_desa FROM t_desa WHERE id=?";
      $data=getDataCriteria($koneksidb,$query,$arrCriteria);
      $desa = $data[0];
      $arrCriteria = array($idpenyuluh);
      $query = "SELECT nama_penyuluh FROM t_penyuluh WHERE id=?";
      $data=getDataCriteria($koneksidb,$query,$arrCriteria);
      input("text","Desa/Penyuluh","",$desa."/".$data[0]," readonly "); 
            
      $formName = "Upsus"; 
      $jmlField = "10"; 
      $tableName = "t_upsus";
      $field[0]="id"; 
      $isian[0]="Id"; 
      $field[1]="created_at"; 
      $isian[1]="Created At"; 
      $field[2]="updated_at"; 
      $isian[2]="Updated At"; 
      $field[3]="status"; 
      $isian[3]="Status"; 
      $field[4]="poktan"; 
      $isian[4]="Kelompok Tani"; 
      $field[5]="nama_komoditas"; 
      $isian[5]="Komoditas"; 
      $field[6]="tanam_tanggal"; 
      $isian[6]="Tanggal Tanam"; 
      $field[7]="tanam_luas"; 
      $isian[7]="Luas Tanam"; 
      $field[8]="panen_tanggal"; 
      $isian[8]="Tanggal Panen"; 
      $field[9]="panen_luas"; 
      $isian[9]="Luas Panen"; 
      $field[10]="produksi"; 
      $isian[10]="Total Produksi"; 

      //$arrCriteria = array($bulan,$tahun,$iddesa,$idpenyuluh);
      $arrCriteria = array($bulan);
      $query = "SELECT t_upsus.id,t_poktan.poktan,t_komoditas.nama_komoditas, t_upsus.tanam_tanggal, t_upsus.tanam_luas,t_upsus.panen_tanggal,t_upsus.panen_luas,t_upsus.produksi FROM `t_upsus`
      INNER JOIN t_komoditas ON t_komoditas.id = t_upsus.id_komoditas 
      INNER JOIN t_poktan ON t_poktan.id = t_upsus.id_poktan
      INNER JOIN t_penyuluh ON t_penyuluh.id = t_upsus.id_penyuluh
      WHERE t_upsus.bulan=?";
      
        showTableCriteria($koneksidb,$tableName,$isian,$field,$formName,$jmlField,$query,$arrCriteria);
        //showTable($koneksidb,$tableName,$isian,$field,$formName,$jmlField,$query);
        ?>
        </form>
    </div>
  </div>
</div>