<?php 

if($_GET){
//   $bulan=decD($_GET['bulan']);
//   $tahun=decD($_GET['tahun']);
//   $iddesa=decD($_GET['iddesa']);
//   $idpenyuluh=decD($_GET['idpenyuluh']);

//   $arrCriteria = array($iddesa);
//   $query = "SELECT * FROM anak";
//   $data=getDataCriteria($koneksidb,$query,$arrCriteria);
//   $desa = $data[0];
//   $kecamatan = $data[1];

//   $arrCriteria = array($idpenyuluh);
//   $query = "SELECT nama_penyuluh, nip FROM t_penyuluh WHERE id=?";
//   $data=getDataCriteria($koneksidb,$query,$arrCriteria);
//   $nama_penyuluh = $data[0];
//   $nip = $data[1];

}
?>
<link href="style-pdf.css" rel="stylesheet" type="text/css" />
<table  class="tk" align="center">
  <tr>
    <td align="center"  width="800" class="g3">DATA ANAK BERKEBUTUHAN KHUSUS</td>
  </tr>
  <!-- <tr>
    <td align="right" width="100"> DESA :</td>
    <td width="200"> <?php //echo $desa ?></td>
    <td width="605">&nbsp;</td>
  </tr>
  <tr>
    <td align="right"> KECAMATAN :</td>
    <td> <?php //echo $kecamatan ?></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="right"> BULAN :</td>
    <td> <?php //echo namaBulan($bulan)." ".$tahun ?> </td>
    <td>&nbsp;</td>
  </tr> -->
</table> 
<br>
<br>
<table class="tg" align="center">
        
        <tr>
          <td class="ctr bold" width="20" >NO</td>
          <td class="ctr bold" width="160">NAMA</td>
          <td class="ctr bold" >JENIS KELAMIN</td>
          <td class="ctr bold" >TANGGAL LAHIR</td>
          <td class="ctr bold"  width="160">NAMA ORANG TUA</td>
          <td class="ctr bold"  width="230">ALAMAT</td>
          <td class="ctr bold" width="80" >NO KONTAK</td>
        </tr> 
        
        <?php 
          //$arrCriteria = array($bulan,$tahun,$iddesa,$idpenyuluh);
          //$query = "SELECT nama_desa FROM t_desa WHERE id=?";
          $qry_utama = "SELECT * FROM anak";
          //$jml_utama = getDataNumber2($koneksidb,$qry_utama,$arrCriteria);
          //$data_utama=getDataCriteriaAll($koneksidb,$qry_utama,$arrCriteria);
          $data_utama=getDataAll($koneksidb,$qry_utama);
          $no=1;
          foreach($data_utama as $value_utama){
        ?>
          <tr>
            <td align="center"><?php echo $no;?></td>
            <td><?php echo $value_utama['4'];?></td>
            <td><?php echo $value_utama['5'];?></td>
            <td><?php echo Indonesia2Tgl($value_utama['6']);?></td>
            <td><?php echo $value_utama['7'];?></td>
            <td><?php echo $value_utama['8'];?></td>
            <td><?php echo $value_utama['9'];?></td>
            
          </tr>
        <?php
          $no++;
          }?> 
</table>
<br/>
<table class="tk" align="center">
	<tr>
    <td width="500">  </td>
    <td colspan="2" width="200"> ...................... <?php $tanggal=date('Y-m-d');echo  Indonesia2Tgl($tanggal);?></td>
	</tr>
	<tr>
    <td width="200">  </td>
    <td colspan="2">Petugas</td>
	</tr>
	<tr>
    <td width="200">&nbsp;</td>
    <td colspan="2">&nbsp;</td>
	</tr>
	<tr>
    <td width="200">  </td>
    <td colspan="2"><?php echo $_SESSION['UNCLE_nama'] ?></td>
	</tr>
	<tr>
    <td width="200">  </td>
    <td colspan="2"><?php //echo $nip ?></td>
	</tr>
</table>