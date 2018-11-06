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
    <td align="center" colspan="3" width="800" class="g3">LAPORAN UPSUS</td>
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
          <td class="ctr bold" rowspan="3">No</td>
          <td class="ctr bold" rowspan="3">POKTAN</td>
          <td class="ctr bold" rowspan="3">NAMA & <br>KONTAK PETANI</td>
          <?php
            $queryTahunKomoditas = "SELECT t_tahunkomoditas.id, t_komoditas.nama_komoditas FROM t_tahunkomoditas INNER JOIN t_komoditas ON t_tahunkomoditas.id_komoditas = t_komoditas.id WHERE t_tahunkomoditas.tahun=$tahun AND t_komoditas.jenis='Horti' ";
            $result = getDataAll($koneksidb,$queryTahunKomoditas);

            $arrCriteria = array($tahun);
            $queryTahunKomoditas1 = "SELECT t_tahunkomoditas.id, t_komoditas.nama_komoditas FROM t_tahunkomoditas INNER JOIN t_komoditas ON t_tahunkomoditas.id_komoditas = t_komoditas.id WHERE t_tahunkomoditas.tahun=? AND t_komoditas.jenis='Horti' ";
            $jml_komoditas = getDataNumber2($koneksidb,$queryTahunKomoditas1,$arrCriteria);
            
            $nokomponen = 1;
            $pilihan = array();
            $paluy = array();            
            foreach ($result as $value) {
              $paluy[]=$value['0'];      
              $pilihan[]=$value['1'];
              ?>
                <td class="ctr bold" colspan="3" style="text-align:center"><?php echo $value['1'];?></td>
              <?php
            }
          ?>
        </tr> 
        <tr>
            <?php
            foreach ($result as $value) {
              ?>
                <td class="ctr bold">TANAM</td>
                <td class="ctr bold">PANEN</td>
                <td class="ctr bold">PRODUKSI</td>
              <?php
            }
          ?>
        </tr>
        <tr>
            <?php
            foreach ($result as $value) {
              ?>
                <td>TGL & LUAS</td>
                <td>TGL & LUAS</td>
                <td>(KUINTAL)</td>
              <?php
            }
          ?>
        </tr>
        <?php 
          $arrCriteria = array($bulan,$tahun,$iddesa);
          $query = "SELECT nama_desa FROM t_desa WHERE id=?";
          $qry_utama = "SELECT t_poktan.id, t_poktan.poktan, t_poktan.nama_petani, t_poktan.no_kontak FROM t_upsus INNER JOIN t_poktan ON t_upsus.id_poktan =  t_poktan.id
                WHERE t_upsus.bulan = ? AND t_upsus.tahun=? AND t_poktan.id_desa = ?
                GROUP BY t_upsus.id_poktan";
          $jml_utama = getDataNumber2($koneksidb,$qry_utama,$arrCriteria);
          $data_utama=getDataCriteriaAll($koneksidb,$qry_utama,$arrCriteria);
          $no=1;
          
          $jml_tanam_luas = array();
          $jml_panen_luas = array();
          $jml_produksi = array();
          $mo=1;
          foreach ($result as $value) {
            $jml_tanam_luas[$mo] = 0; 
            $jml_panen_luas[$mo] = 0; 
            $jml_produksi[$mo] = 0; 
            $mo++;
          }

          foreach($data_utama as $value_utama){
        ?>
          <tr>
            <td><?php echo $no;?></td>
            <td><?php echo $value_utama['1'];?></td>
            <td><?php echo $value_utama['2'];?><br><?php echo $value_utama['3'];?></td>
            <?php
              
              $mo=1;
              

              foreach ($result as $value) {
                $arrCriteria = array($value['0'],$value_utama['0'],$bulan,$tahun);
                $query = "SELECT tanam_tanggal, tanam_luas, panen_tanggal, panen_luas, produksi FROM t_upsus WHERE id_komoditas=? AND id_poktan=? AND bulan=? AND tahun=?";

                $data=getDataCriteria($koneksidb,$query,$arrCriteria);
                echo "<td align=\"center\">".IndonesiaTgl($data[0])."<br>".$data[1]."</td>";
                echo "<td align=\"center\">".IndonesiaTgl($data[2])."<br>".$data[3]."</td>";
                $produksi = $data[4] != "" ? $data[4] : "--";
                echo "<td style=\"text-align:center\">".$produksi."</td>";


                $jml_tanam_luas[$mo] = $data[1] != "" ? $jml_tanam_luas[$mo] + $data[1] : $jml_tanam_luas[$mo] + 0; 
                $jml_panen_luas[$mo] = $data[3] != "" ? $jml_panen_luas[$mo] + $data[3] : $jml_panen_luas[$mo] + 0; 
                $jml_produksi[$mo] = $data[4] != "" ? $jml_produksi[$mo] + $data[4] : $jml_produksi[$mo] + 0; 
                $mo++;
              }
            ?>
            
          </tr>
        <?php
          $no++;
          }?> 
          <tr>
            <td colspan="3" align="right"> Jumlah</td>
            <?php
              
              $mo=1;
              foreach ($result as $value) {
                
                echo "<td align=\"center\">".$jml_tanam_luas[$mo]."</td>";
                echo "<td align=\"center\">".$jml_panen_luas[$mo]."</td>";               
                echo "<td style=\"text-align:center\">".$jml_produksi[$mo]."</td>";
                $mo++;
              }
            ?>
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