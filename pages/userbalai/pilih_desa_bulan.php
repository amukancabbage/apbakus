<?php
  if(isset($_POST['edit'])){

    $bulan = $_POST['txt1'];
    $tahun = $_POST['txt2'];
    $iddesa = $_POST['txt3'];
    $idpenyuluh = $_POST['txt4'];

    echo "<meta http-equiv='refresh' content='0; url=?page=Upsus-Data&bulan=".encD($bulan)."&tahun=".encD($tahun)."&iddesa=".encD($iddesa)."&idpenyuluh=".encD($idpenyuluh)."'>";  

  }
?>

<form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" enctype="multipart/form-data" method="POST" >
  <?php 
    $pilihan = array("Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
    $paluy = array("01","02","03","04","05","06","07","08","09","10","11","12");
    select("Bulan",1,"",$paluy,$pilihan);
    input("text","Tahun",2,""," data-parsley-type=\"digits\" data-parsley-maxlength=\"4\" data-parsley-minlength=\"4\" required"); 
    select_with_group_kecamatan($koneksidb,"Desa",3);
    $result = getDataAll($koneksidb,"SELECT id,nama_penyuluh FROM t_penyuluh");
    $pilihan = array();
    $paly = array();
    foreach ($result as $value) {
        $paluy[]=$value['0'];
        $pilihan[]=$value['1'];
    }
    //$paluy = $piliha;
    select("Penyuluh",4,"",$paluy,$pilihan);
  ?>
  <div class="ln_solid"></div>
  <div class="form-group">
    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
      <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-close"></i> Tutup</button>
      <button class="btn btn-primary" type="reset"><i class="fa fa-refresh"></i> Ulang</button>
      <button type="submit" name="edit" class="btn btn-success"><i class="fa fa-arrow-right"></i> Lanjut</button>
    </div>
  </div>

</form>