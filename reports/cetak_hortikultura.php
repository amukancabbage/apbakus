<?php 

include_once "../library/connection.php";
include_once "../library/library.php";
include_once "../library/library.pdo.php";
include_once "../library/library.generator.php";
include_once "../library/library.gentella.php";


if($_GET){
  $bulan=decD($_GET['bulan']);
  $tahun=decD($_GET['tahun']);
  $iddesa=decD($_GET['iddesa']);
  $idpenyuluh=decD($_GET['idpenyuluh']);

  $arrCriteria = array($iddesa);
  $query = "SELECT nama_desa, nama_kecamatan FROM t_desa INNER JOIN t_kecamatan ON t_desa.id_kecamatan = t_kecamatan.id WHERE t_desa.id=?";
  $data=getDataCriteria($koneksidb,$query,$arrCriteria);
  $desa = $data[0];
  $kecamatan = $data[1];

  $arrCriteria = array($idpenyuluh);
  $query = "SELECT nama_penyuluh, nip FROM t_penyuluh WHERE id=?";
  $data=getDataCriteria($koneksidb,$query,$arrCriteria);
  $nama_penyuluh = $data[0];
  $nip = $data[1];

}
?>
<link href="style-pdf.css" rel="stylesheet" type="text/css" />
<table  class="tk" align="center">
  <tr>
    <td align="center" colspan="3" width="800" class="g3">LAPORAN HORTIKULTURA</td>
  </tr>
  <tr>
    <td align="right" width="100"> DESA :</td>
    <td width="200"> <?php echo $desa ?></td>
    <td width="605">&nbsp;</td>
  </tr>
  <tr>
    <td align="right"> KECAMATAN :</td>
    <td> <?php echo $kecamatan ?></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="right"> BULAN :</td>
    <td> <?php echo namaBulan($bulan)." ".$tahun ?> </td>
    <td>&nbsp;</td>
  </tr>
</table> 
<table class="tg" align="center">
        
        <tr>
          <td class="ctr bold" >NO</td>
          <td class="ctr bold" >KELOMPOK TANI</td>
          <td class="ctr bold" >NAMA PETANI</td>
          <td class="ctr bold" >KONTAK PETANI</td>
          <td class="ctr bold" >TANAMAN</td>
          <td class="ctr bold" >LUAS TANAM</td>
          <td class="ctr bold" >LUAS PANEN</td>
          <td class="ctr bold" >PRODUKSI</td>
        </tr> 
        
        <?php 
          $arrCriteria = array($bulan,$tahun,$iddesa,$idpenyuluh);
          $query = "SELECT nama_desa FROM t_desa WHERE id=?";
          $qry_utama = "SELECT t_upsus.id, t_poktan.poktan, t_poktan.nama_petani, t_poktan.no_kontak, t_komoditas.nama_komoditas, tanam_luas, panen_luas, produksi, bulan, tahun, id_penyuluh, t_poktan.id_desa 
          FROM t_upsus 
          INNER JOIN t_komoditas ON t_upsus.id_komoditas = t_komoditas.id 
          INNER JOIN t_poktan ON t_upsus.id_poktan = t_poktan.id 
          WHERE bulan=? AND tahun=? AND id_desa=? AND id_penyuluh=?
          ORDER BY poktan";
          $jml_utama = getDataNumber2($koneksidb,$qry_utama,$arrCriteria);
          $data_utama=getDataCriteriaAll($koneksidb,$qry_utama,$arrCriteria);
          $no=1;
          //while ($no<=$jml_utama) {
            $jml_tanam=0;
            $jml_panen=0;
            $jml_produksi=0;
          foreach($data_utama as $value_utama){
        ?>
          <tr>
            <td><?php echo $no;?></td>
            <td><?php echo $value_utama['1'];?></td>
            <td><?php echo $value_utama['2'];?></td>
            <td><?php echo $value_utama['3'];?></td>
            <td><?php echo $value_utama['4'];?></td>
            <td style="text-align:right"><?php echo $value_utama['5'];$jml_tanam=$jml_tanam+$value_utama['5'];?></td>
            <td style="text-align:right"><?php echo $value_utama['6'];$jml_panen=$jml_panen+$value_utama['6'];?></td>
            <td style="text-align:right"><?php echo $value_utama['7'];$jml_produksi=$jml_produksi+$value_utama['7'];?></td>
            
          </tr>
        <?php
          $no++;
          }?> 
          <tr>
            <td colspan = "5" >Jumlah</td>
            <td colspan = "5" >Jumlah</td>
            <td colspan = "5" >Jumlah</td>
            <td colspan = "5" >Jumlah</td>
            <td colspan = "5" >Jumlah</td>
            <td style="text-align:right"><?php echo $jml_tanam; ?></td>
            <td style="text-align:right"><?php echo $jml_panen;?></td>
            <td style="text-align:right"><?php echo $jml_produksi;?></td>
          </tr>
</table>
<br/>
<table class="tk" align="center">
	<tr>
    <td width="500">  </td>
    <td colspan="2" width="200"> ...................... <?php echo namaBulan($bulan)." ".$tahun ?></td>
	</tr>
	<tr>
    <td width="200">  </td>
    <td colspan="2">Petugas Penyuluh Lapangan</td>
	</tr>
	<tr>
    <td width="200">&nbsp;</td>
    <td colspan="2">&nbsp;</td>
	</tr>
	<tr>
    <td width="200">  </td>
    <td colspan="2"><?php echo $nama_penyuluh ?></td>
	</tr>
	<tr>
    <td width="200">  </td>
    <td colspan="2"><?php echo $nip ?></td>
	</tr>
</table>