<?php
// include ("lib/connection.php");
include ("library.form.php");
include ("library.singkron.php");
include ("library.generator.php");
# Pengaturan tanggal komputer
date_default_timezone_set("Asia/Makassar");
$client =get_client_ip();
# Fungsi mysqli_field_name dan len
function mysqli_field_name($result, $field_offset)
{
    $properties = mysqli_fetch_field_direct($result, $field_offset);
    return is_object($properties) ? $properties->name : null;
}

function mysqli_field_len($result, $field_offset)
{
    $properties = mysqli_fetch_field_direct($result, $field_offset);
    return is_object($properties) ? $properties->length : null;
}
# Fungsi Enkripsi
function hash_pass($pass){
	$length = 31;
	// $randomString = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length);
    $salt="yabscdefhizklmnopqrstu123467805"; //must be the same as all your other files
    // $salt=$randomString; //must be the same as all your other files
	$day =date("d");
    return md5($pass.$salt.$day);
}
 

// Function to get the client IP address
function get_client_ip() {
    $ipaddress = '';
    if (getenv('HTTP_CLIENT_IP'))
        $ipaddress = getenv('HTTP_CLIENT_IP');
    else if(getenv('HTTP_X_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
    else if(getenv('HTTP_X_FORWARDED'))
        $ipaddress = getenv('HTTP_X_FORWARDED');
    else if(getenv('HTTP_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_FORWARDED_FOR');
    else if(getenv('HTTP_FORWARDED'))
       $ipaddress = getenv('HTTP_FORWARDED');
    else if(getenv('REMOTE_ADDR'))
        $ipaddress = getenv('REMOTE_ADDR');
    else
        $ipaddress = 'UNKNOWN';
    return $ipaddress;
}

# Fungsi Enkripsi
function hash_2me($pass,$client){
	$length = 31;
	$ua = $_SERVER["HTTP_USER_AGENT"];
	// $randomString = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length);
    $salt="ya!#@sc-=fhizklmnopqrstu123467805"; //must be the same as all your other files
    // $salt=$randomString; //must be the same as all your other files
	$day =date("h");
	$harat = substr($pass.$salt.$day.$client.$ua, 0, $length);
    // return md5($pass.$salt.$day.$client.$ua);
    return md5($harat);
}
#otomatis perbaiki cache browser (CSS)
function auto_version($file)
{
  if(strpos($file, '/') !== 0 || !file_exists($_SERVER['DOCUMENT_ROOT'] . $file))
    return $file;

  $mtime = filemtime($_SERVER['DOCUMENT_ROOT'] . $file);
  return preg_replace('{\\.([^./]+)$}', ".$mtime.\$1", $file);
}
 
# Fungsi untuk membalik tanggal dari format Indo (d-m-Y) -> English (Y-m-d)
function InggrisTgl($tanggal){
	$tgl=substr($tanggal,0,2);
	$bln=substr($tanggal,3,2);
	$thn=substr($tanggal,6,4);
	$tanggal="$thn-$bln-$tgl";
	return $tanggal;
}

# Fungsi untuk membalik tanggal dari format English (Y-m-d) -> Indo (d-m-Y)
function IndonesiaTgl($tanggal){
	$tgl=substr($tanggal,8,2);
	$bln=substr($tanggal,5,2);
	$thn=substr($tanggal,0,4);
	$tanggal="$tgl-$bln-$thn";
	return $tanggal;
}

# Fungsi untuk membalik tanggal dari format English (Y-m-d) -> Indo (d-m-Y)
function Indonesia2Tgl($tanggal){
	$namaBln = array("01" => "Januari", "02" => "Februari", "03" => "Maret", "04" => "April", "05" => "Mei", "06" => "Juni", 
					 "07" => "Juli", "08" => "Agustus", "09" => "September", "10" => "Oktober", "11" => "November", "12" => "Desember");
				 
	$tgl=substr($tanggal,8,2);
	$bln=substr($tanggal,5,2);
	$thn=substr($tanggal,0,4);

	if($bln=="00"){
		return "INVALID";
	}

	$tanggal ="$tgl ".$namaBln[$bln]." $thn";
	return $tanggal;
}
# PINDAH NAMA BULAN JADI ANGKA
function angkaBulan($bulan){
	$namaBln = array("Januari" => "01", "Februari" => "02", "Maret" => "03", "April" => "04", "Mei" => "05", "Juni" => "06",  "Juli" => "07", "Agustus" => "08", "September" => "09", "Oktober" => "10", "November" => "11", "Desember" => "12"); 
					 
	 if($bulan=="Semua"){
		return "Semua";
	}

	$bulannya =$namaBln[$bulan]; 
	return $bulannya;
}



# Fungsi untuk membuat format rupiah pada angka (uang)
function format_angka($angka) {
	$hasil =  number_format($angka,0, ",",".");
	return $hasil;
}

// Mendapatkan Tahun Ajaran
function getTahunAjar(){
	$hariIni = date("Y-m-d");
	$tahun = date("Y");
	$tahun1 = date("Y")-1;
	$tahun2 = date("Y")+1;
	$bulan = date("m");

	if($bulan="1" || $bulan="2" || $bulan="3" || $bulan="4" || $bulan="5" || $bulan="6" )
		return $tahun1."/".$tahun;
	else
		return $tahun."/".$tahun2;
}

// Mendapatkan Semester Ganjil/Genap
function getSemester(){
	$hariIni = date("Y-m-d");
	$tahun = date("Y");
	$tahun1 = date("Y")-1;
	$tahun2 = date("Y")+1;
	$bulan = date("m");

	if($bulan="7" || $bulan="8" || $bulan="9" || $bulan="10" || $bulan="11" || $bulan="12" )
		return "GANJIL";
	else
		return "GENAP";
}
 
function angkaTerbilang($x){
  $abil = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
  if ($x < 12)
    return " " . $abil[$x];
  elseif ($x < 20)
    return angkaTerbilang($x - 10) . " belas";
  elseif ($x < 100)
    return angkaTerbilang($x / 10) . " puluh" . angkaTerbilang($x % 10);
  elseif ($x < 200)
    return " seratus" . angkaTerbilang($x - 100);
  elseif ($x < 1000)
    return angkaTerbilang($x / 100) . " ratus" . angkaTerbilang($x % 100);
  elseif ($x < 2000)
    return " seribu" . angkaTerbilang($x - 1000);
  elseif ($x < 1000000)
    return angkaTerbilang($x / 1000) . " ribu" . angkaTerbilang($x % 1000);
  elseif ($x < 1000000000)
    return angkaTerbilang($x / 1000000) . " juta" . angkaTerbilang($x % 1000000);
}

function getNamaField($qry){

		$i=0;
  	while ($fieldinfo=mysqli_fetch_field($qry))
    {
			$out[$i] = $fieldinfo->name;
			$i++;
    }
		mysqli_free_result($qry);
		return $out;
}

function getIsian($qry){
	
			$i=0;
		  while ($fieldinfo=mysqli_fetch_field($qry))
		{
				$out[$i] = $fieldinfo->name;
				$out[$i] = strtolower($out[$i]);
				if(strpos($out[$i],"_")!=0){
				$out[$i] = substr_replace($fieldinfo->name," ",strpos($fieldinfo->name,"_"),1);
				}
				
				$out[$i]=ucwords($out[$i]);
				$i++;
		}
			mysqli_free_result($qry);
			return $out;
}

// GENERATE UNTUK SEBAGIAN QUERY INSERT
function getInsert($jml,$field,$txt){
	$s="(".$field[1];
	for($i=2;$i<=$jml;$i++){
		$s = $s.", ".$field[$i];
	}
	
	$s = $s." ) VALUES ('".$txt[1]."'";
	
	for($i=2;$i<=$jml;$i++){
		$s = $s.", '".$txt[$i]."'";
	}
	$s = $s.")";
	return $s;
}

// GENERATE UNTUK SEBAGIAN QUERY UPDATE
function getUpdate($jml,$field,$txt){
	$s = $field[2]."='".$txt[2]."'";

	for($i=3;$i<=$jml;$i++){
		$s = $s.", ".$field[$i]."='".$txt[$i]."'";
	}
	
	$s = $s." WHERE ".$field[0]."='".$txt[0]."'";
	
	return $s;
}

function goQue($koneksidb,$SQL){
	$cekSql=$SQL;
	$cekQry=mysqli_query($koneksidb, $cekSql) or die ("QUERY ERROR :".mysqli_error($koneksidb)." || QUERY :".$SQL); 
	$jml=mysqli_num_rows($cekQry);
	if($jml>=1){
		return mysqli_fetch_array($cekQry);
	}		
	else{
		return false;
	}
}

function getArray(){
	
}

function cekAda($koneksidb,$tableName,$field,$isian,$txt){
	$cekSql="SELECT * FROM ".$tableName." WHERE ".$field."='".$txt."'";
	$cekQry=mysqli_query($koneksidb, $cekSql) or die ("Eror Query".mysqli_error($koneksidb));
	$jml=mysqli_num_rows($cekQry);
	if($jml>=1){
		return true;
	}		
	else{
		return false;
	}
}
//query biasa
function cekAda2($koneksidb,$tableName,$field,$txt,$sortby,$sortway){
	$cekSql="SELECT * FROM ".$tableName." WHERE ".$field."='".$txt."' ORDER BY '".$sortby."' ".$sortway." ";
	$cekQry=mysqli_query($koneksidb, $cekSql) or die ("Eror Query ".mysqli_error($koneksidb)); 
	return $cekQry;
}

// Mendapatkan String dari Array, dipakai untuk membuat LOG
function getStringArray($pesanError){
	$jml = count($pesanError)-1;
	$s="(".$pesanError[0];
	for($i=1;$i<=$jml;$i++){
		$s = $s.", ".$pesanError[$i];
	}
	
	$s = $s." )";
	return $s;
}


function hitView($koneksidb,$tableMaster,$case){
$pageSql = "SELECT * FROM $tableMaster WHERE status_usulan='".$case."' "; 
$qryShow = mysqli_query($koneksidb, $pageSql)  or die ("Query ambil data salah : ".mysqli_error($koneksidb));
$jmQry = mysqli_num_rows($qryShow); 
return $jmQry;
}

function hitNew($koneksidb,$tableMaster,$fieldcase,$case){
$pageSql = "SELECT * FROM $tableMaster WHERE ".$fieldcase."='".$case."' "; 
$qryShow = mysqli_query($koneksidb, $pageSql)  or die ("Query ambil data salah : ".mysqli_error($koneksidb));
$jmQry = mysqli_num_rows($qryShow); 
return $jmQry;
}

function hitJa($koneksidb,$tableMaster){
$pageSql = "SELECT * FROM $tableMaster  "; 
$qryShow = mysqli_query($koneksidb, $pageSql)  or die ("Query ambil data salah : ".mysqli_error($koneksidb));
$jmQry = mysqli_num_rows($qryShow); 
return $jmQry;
}

// ---------------------------- FUNCTION DIBUAT KARENA BUAT REPORT -------------
// fungsi potong tulisan di tabel
function patah($kata,$jumlah) {
		$foo = str_repeat($kata,1);
		$kata = wordwrap($foo, $jumlah, '<br />', true);
		return $kata;
}
// fungsi cek file ada ato tidak
function cekFile($file) {
		$ext = pathinfo($file, PATHINFO_EXTENSION);
		if($ext=='pdf')
		$file ="File Terlampir";
		else
			$file ="File Tidak Ada";
		return $file;
} 
// selisih ditampilkan dalam tahun dan bulan saja
function selisihTahunBulan($awal,$akhir) {
$awal  = date_create($awal);
$akhir = date_create($akhir);
$diff  = date_diff( $awal, $akhir );

echo $diff->format('%y Tahun %m Bulan');
}	

//otomatis usulan yang diambil dosen												 
function usulJabatan($jabatan_terakhir){
	if ($jabatan_terakhir=='Tenaga Pendidik')
		$jabatan_terakhir='Asisten Ahli (150)';
	if ($jabatan_terakhir=='Asisten Ahli')
		$jabatan_terakhir='Lektor';
	return $jabatan_terakhir;
}


//LAMPIRAN 1 PENELITIAN QUERY
function KategoriPenelitian($koneksidb,$Kode,$idkategori,$jumAK) {
	$penelitianSql = "SELECT  t_mkategori_penelitian.id, SUM(t_det_penelitian.nilai_usulan) AS ".$jumAK." FROM t_det_penelitian
		LEFT JOIN t_penelitian ON t_penelitian.id=t_det_penelitian.id_penelitian
		LEFT JOIN t_kategori_penelitian ON t_kategori_penelitian.id=t_det_penelitian.kategori
		LEFT JOIN t_mkategori_penelitian ON t_mkategori_penelitian.id=t_kategori_penelitian.id_mkpenelitian
		LEFT JOIN t_usulan ON t_usulan.id=t_penelitian.id_usulan
		WHERE t_usulan.id=".$Kode." AND t_mkategori_penelitian.id=".$idkategori."  ";
	$qryPeneliti = mysqli_query($koneksidb, $penelitianSql)  or die ("Query ambil data salah : ".mysqli_error($koneksidb));
	$dataPenelitian = mysqli_fetch_array($qryPeneliti);
	$jumAK = $dataPenelitian[$jumAK];
	return $jumAK;
}
function KategoriPenelitianAll($koneksidb,$Kode,$jumAK) {
	$penelitianSql = "SELECT  SUM(t_det_penelitian.nilai_usulan) AS ".$jumAK." FROM t_det_penelitian
		LEFT JOIN t_penelitian ON t_penelitian.id=t_det_penelitian.id_penelitian
		LEFT JOIN t_kategori_penelitian ON t_kategori_penelitian.id=t_det_penelitian.kategori
		LEFT JOIN t_mkategori_penelitian ON t_mkategori_penelitian.id=t_kategori_penelitian.id_mkpenelitian
		LEFT JOIN t_usulan ON t_usulan.id=t_penelitian.id_usulan
		WHERE t_usulan.id=".$Kode." ";
	$qryPeneliti = mysqli_query($koneksidb, $penelitianSql)  or die ("Query ambil data salah : ".mysqli_error($koneksidb));
	$dataPenelitian = mysqli_fetch_array($qryPeneliti);
	$jumAK = $dataPenelitian[$jumAK];
	return $jumAK;
}

//LAMPIRAN 1 PENGABDIAN QUERY
function KategoriPengabdian($koneksidb,$Kode,$idkategori,$jumAK) {
	$pengabdianSql = "SELECT  t_mkategori_pengabdian.id, SUM(t_det_pengabdian.nilai_usulan) AS ".$jumAK." FROM t_det_pengabdian
		LEFT JOIN t_pengabdian ON t_pengabdian.id=t_det_pengabdian.id_pengabdian
		LEFT JOIN t_kategori_pengabdian ON t_kategori_pengabdian.id=t_det_pengabdian.idkategori
		LEFT JOIN t_mkategori_pengabdian ON t_mkategori_pengabdian.id=t_kategori_pengabdian.id_mkpengabdian
		LEFT JOIN t_usulan ON t_usulan.id=t_pengabdian.id_usulan
		WHERE t_usulan.id=".$Kode." AND t_mkategori_pengabdian.id=".$idkategori."  ";
	$qryPengabdi = mysqli_query($koneksidb, $pengabdianSql)  or die ("Query ambil data salah : ".mysqli_error($koneksidb));
	$datapengabdian = mysqli_fetch_array($qryPengabdi);
	$jumAK = $datapengabdian[$jumAK];
	return $jumAK;
}
function KategoriPengabdianAll($koneksidb,$Kode,$jumAK) {
	$penunjangSql = "SELECT  SUM(t_det_pengabdian.nilai_usulan) AS ".$jumAK." FROM t_det_pengabdian
		LEFT JOIN t_pengabdian ON t_pengabdian.id=t_det_pengabdian.id_pengabdian
		LEFT JOIN t_kategori_pengabdian ON t_kategori_pengabdian.id=t_det_pengabdian.idkategori
		LEFT JOIN t_mkategori_pengabdian ON t_mkategori_pengabdian.id=t_kategori_pengabdian.id_mkpengabdian
		LEFT JOIN t_usulan ON t_usulan.id=t_pengabdian.id_usulan
		WHERE t_usulan.id=".$Kode." ";
	$qryPengabdi = mysqli_query($koneksidb, $penunjangSql)  or die ("Query ambil data salah : ".mysqli_error($koneksidb));
	$datapengabdian = mysqli_fetch_array($qryPengabdi);
	$jumAK = $datapengabdian[$jumAK];
	return $jumAK;
}

//LAMPIRAN 1 PENUNJANG QUERY
function KategoriPenunjang($koneksidb,$Kode,$idkategori,$jumAK) {
	$penunjangSql = "SELECT  t_mkategori_penunjang.id, SUM(t_det_penunjang.nilai_usulan) AS ".$jumAK." FROM t_det_penunjang
		LEFT JOIN t_penunjang ON t_penunjang.id=t_det_penunjang.id_penunjang
		LEFT JOIN t_kategori_penunjang ON t_kategori_penunjang.id=t_det_penunjang.idkategori
		LEFT JOIN t_mkategori_penunjang ON t_mkategori_penunjang.id=t_kategori_penunjang.id_mkpenunjang
		LEFT JOIN t_usulan ON t_usulan.id=t_penunjang.id_usulan
		WHERE t_usulan.id=".$Kode." AND t_mkategori_penunjang.id=".$idkategori."  ";
	$qryPenunjang = mysqli_query($koneksidb, $penunjangSql)  or die ("Query ambil data salah : ".mysqli_error($koneksidb));
	$datapenunjang = mysqli_fetch_array($qryPenunjang);
	$jumAK = $datapenunjang[$jumAK];
	return $jumAK;
}
function KategoriPenunjangAll($koneksidb,$Kode,$jumAK) {
	$penunjangSql = "SELECT  SUM(t_det_penunjang.nilai_usulan) AS ".$jumAK." FROM t_det_penunjang
		LEFT JOIN t_penunjang ON t_penunjang.id=t_det_penunjang.id_penunjang
		LEFT JOIN t_kategori_penunjang ON t_kategori_penunjang.id=t_det_penunjang.idkategori
		LEFT JOIN t_mkategori_penunjang ON t_mkategori_penunjang.id=t_kategori_penunjang.id_mkpenunjang
		LEFT JOIN t_usulan ON t_usulan.id=t_penunjang.id_usulan
		WHERE t_usulan.id=".$Kode." ";
	$qryPenunjang = mysqli_query($koneksidb, $penunjangSql)  or die ("Query ambil data salah : ".mysqli_error($koneksidb));
	$datapenunjang = mysqli_fetch_array($qryPenunjang);
	$jumAK = $datapenunjang[$jumAK];
	return $jumAK;
}

//LAMPIRAN 2 masih Gagal kayapa sekira arraynya dikirim semuaan?
function queryAjar($koneksidb,$Kode,$tabel,$data) {
	$sQL = "SELECT  ".$tabel.".* FROM ".$tabel." 
	LEFT JOIN t_pendidikan_pengajaran ON t_pendidikan_pengajaran.id=".$tabel.".id_pendidikan
	LEFT JOIN t_usulan ON t_usulan.id=t_pendidikan_pengajaran.id_usulan
	WHERE t_usulan.id=".$Kode." ";
$qry = mysqli_query($koneksidb, $sQL)  or die ("Query ambil data salah : ".mysqli_error($koneksidb)); 
$data= mysqli_fetch_array($qry);
return $data;
}

			
function pangCek($golongan) {
	if ($golongan='Tenaga Pendidik') {
	$gol='Penata Muda TK.I/ III/B';	}
	if ($golongan='Asisten Ahli'){
	$gol='Penata Muda TK.II/ III/C';}
	if ($golongan='lektor'){
	$gol='Penata TK.I/ III/D';} 
	return $gol;
}


function infoFlash($bg,$message) {
	echo'
	<div id="flash" class="alert '.$bg.' alert-dismissible" role="alert">
		<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span> </button>
						'.$message.'
	</div> 
							
		';					
}
?>