<?php 
function getTot($koneksidb,$tableMaster,$id){
										$pageSql = "SELECT * FROM $tableMaster WHERE id_usulan=$id "; 
										$qryShow = mysqli_query($koneksidb, $pageSql)  or die ("Query ambil data salah : ".mysqli_error($koneksidb));
										$jmQry = mysqli_fetch_array($qryShow);
										$tot = $jmQry['total_nilai_usulan'];
										return $tot;	
									}
									
$sqlShow = "SELECT t_usulan.*,t_dosen.id AS iddosen, t_dosen.nama_dosen,t_dosen.nidn, t_dosen.gelar_depan,t_dosen.gelar_belakang, t_dosen.jenis_kelamin,t_dosen.tempat_lahir,t_dosen.tanggal_lahir,t_dosen.no_telepon, t_dosen.email,t_dosen.status_kepegawaian, t_dosen.nipnik,t_dosen.pendidikan_tertinggi,t_dosen.tmt_tenaga_pendidik, t_universitas.no_induk,t_universitas.nama_universitas, t_prodi.id_Prodi,t_prodi.nama_prodi, 
	SUM(t_det_pendidikan.nilai_usulan) AS us_pendidikan,
	SUM(t_det_pelatihan.nilai_usulan) AS us_pelatihan, 
	t_pendidikan_pengajaran.total_nilai_usulan AS us_dikjar,
	t_penelitian.total_nilai_usulan AS us_penelitian, 
	t_pengabdian.total_nilai_usulan AS us_pengabdian, 
	t_penunjang.total_nilai_usulan AS us_penunjang,  
	SUM(t_det_pendidikan.nilai_tim) AS nt_pendidikan,
	SUM(t_det_pelatihan.nilai_tim) AS nt_pelatihan, 
	t_pendidikan_pengajaran.total_nilai_tim AS nt_dikjar,
	t_penelitian.total_nilai_tim AS nt_penelitian, 
	t_pengabdian.total_nilai_tim AS nt_pengabdian, 
	t_penunjang.total_nilai_tim AS nt_penunjang  
	FROM `t_usulan` 
	LEFT JOIN t_pengguna ON t_pengguna.id=t_usulan.id_dosen
	LEFT JOIN t_dosen ON t_dosen.id_pengguna=t_pengguna.id
	LEFT JOIN t_periode ON t_periode.id=t_usulan.id_periode
	LEFT JOIN t_universitas ON t_universitas.id=t_dosen.id_universitas
	LEFT JOIN t_prodi ON t_prodi.id=t_dosen.id_prodi
	LEFT JOIN t_pendidikan_pengajaran ON t_pendidikan_pengajaran.id_usulan=t_usulan.id
	LEFT JOIN t_penelitian ON t_penelitian.id_usulan=t_usulan.id
	LEFT JOIN t_pengabdian ON t_pengabdian.id_usulan=t_usulan.id
	LEFT JOIN t_penunjang ON t_penunjang.id_usulan=t_usulan.id
	LEFT JOIN t_riwayat_jabakademin ON t_riwayat_jabakademin.id_dosen=t_dosen.id
	LEFT JOIN t_det_pendidikan ON t_det_pendidikan.id_pendidikan=t_pendidikan_pengajaran.id 
	LEFT JOIN t_det_pelatihan ON t_det_pelatihan.id_pendidikan=t_pendidikan_pengajaran.id 
	WHERE t_usulan.id=".$Kode." ";
$qryShow = mysqli_query($koneksidb, $sqlShow)  or die ("Query ambil data awal salah : ".mysqli_error($koneksidb));
$dataShow = mysqli_fetch_array($qryShow);

$lasttime = date('Y-m-d',strtotime(date('Y-m-d') . "-1 year"));
$jabfungSql = "SELECT  t_riwayat_jabakademin.* FROM t_riwayat_jabakademin 
	WHERE t_riwayat_jabakademin.id_dosen=".$dataShow['iddosen']." AND status_verifikasi=1 DESC LIMIT 1";
$qryJF = mysqli_query($koneksidb, $jabfungSql)  or die ("Query ambil data salah : ".mysqli_error($koneksidb));
$dataJF = mysqli_fetch_array($qryJF);
 
$jabfungSqlnew = "SELECT  t_riwayat_jabakademin.* FROM t_riwayat_jabakademin 
	WHERE t_riwayat_jabakademin.id_dosen=".$dataShow['iddosen']." AND status_verifikasi=1 AND tmt_jabakademik>'".$lasttime."' ";
$qryJFN = mysqli_query($koneksidb, $jabfungSqlnew)  or die ("Query ambil data salah : ".mysqli_error($koneksidb));
$dataJFN = mysqli_fetch_array($qryJFN);



$tglbaru = strtotime ( '+1 day' , strtotime($dataShow['tanggal_penilaian_2'])); 
$tmtdate = date ( 'Y-m-d' , $tglbaru ); 
	
	

$unsurPendidikan = array("(1). Mengikuti pendidikan sekolah dan memperoleh gelar / sebutan ijazah / akta","(2). Mengikuti pendidikan sekolah dan memperoleh gelar / sebutan ijazah / akta tambahan setingkat atau lebih tinggi diluar bidang ilmunya","(3). Mengikuti pendidikan dan pelatihan fungsional dosen dan memperoleh Surat Tanda Tamat Pendidikan dan Pelatihan"); 

$unsurPengajaran = array("(1). Melaksanakan Perkuliahan / tutorial dan membimbing, menguji serta menyelenggarakan pendidikan di laboratorium, praktik keguruan, bengkel / studio / kebun percobaan / teknologi pengajaran dan praktik-lapangan
      ","(2). Membimbing seminar mahasiswa
      ","(3). Membimbing Kuliah Kerja Nyata, Praktik Kerja Nyata, Praktik Kerja Lapangan
      ","(4). Membimbing  dan   ikut   membimbing dalam menghasilkan  desertasi, thesis, skripsi dan laporan akhir studi
      ","(5). Bertugas sebagai penguji pada ujian akhir
      ","(6). Membina  kegiatan  mahasiswa di  bidang  akademik   dan  kemahasiswaan  
      ","(7). Mengembangkan   program   kuliah
      ","(8). Mengembangkan bahan pelajaran
      ","(9). Menyampaikan orasi ilmiah
      ","(10). Menduduki jabatan pimpinan  perguruan tinggi
      ","(11). Membimbing dosen yang lebih rendah jabatan fungsionalnya 
      ","(12). Melaksanakan kegiatan deta sering dan pencangkokkan dosen"); 
$unsurPenelitian = array("(1). Menghasilkan karya ilmiah 
		","(2). Menerjemahkan / menyadur buku ilmiah  
		","(3). Mengedit / menyunting karya  buku ilmiah  
		","(4). Membuat rancangan dan karya teknologi yang dipatenkan  
		","(5). Membuat rancangan dan karya teknologi, rancangan dan karya seni monumental / seni pertunjuk kan / karya sastra "); 
$unsurPenelitian2 = array("Menghasilkan karya ilmiah
		","Menerjemahkan / menyadur buku ilmiah
		","Mengedit / menyunting karya  buku ilmiah
		","Membuat rancangan dan karya teknologi yang dipatenkan
		","Membuat rancangan dan karya teknologi, rancangan dan karya seni monumental / seni pertunjuk kan / karya sastra"); 
$unsurPengabdian = array("(1). Menduduki jabatan pimpinan  
			pada lembaga pemerintah/pejabat
			Negara yang harus dibebaskan
			dari jabatan organiknya","(2). Melaksanakan pengembangan 
			hasil pendidikan, dan penelitian
			yang dapat dimanfaatkan oleh masyarakat 
			","(3). Memberi latihan / penyuluhan /
			penataran / ceramah pada masyarakat  
			","(4). Memberi pelayanan kepada 
			masyarakat atau kegiatan lain 
			yang menunjang pelaksanaan 
			tugas umum pemerintahan dan pembangunan 
			","(5). Membuat / menulis   karya    pengabdian pada masyarakat yang tidak dipublikasikan "); 
$unsurPengabdian2 = array("Menduduki jabatan pimpinan  
			pada lembaga pemerintah/pejabat
			Negara yang harus dibebaskan
			dari jabatan organiknya
			","Melaksanakan pengembangan 
			hasil pendidikan, dan penelitian
			yang dapat dimanfaatkan oleh masyarakat
			","Memberi latihan / penyuluhan /
			penataran / ceramah pada masyarakat 
			","Memberi pelayanan kepada 
			masyarakat atau kegiatan lain 
			yang menunjang pelaksanaan 
			tugas umum pemerintahan dan pembangunan 
			","Membuat / menulis   karya    pengabdian pada masyarakatyang tidak dipublikasikan"); 
$unsurPenunjang = array("(1). Menjadi anggota dalam suatu Panitia /
			Badan pada perguruan tinggi  
			","(2). Menjadi anggota panitia / badan pada
			lembaga pemerintah  
			","(3). Menjadi anggota organisasi profesi  
			","(4). Mewakili Perguruan Tinggi / Lembaga
			Pemerintah duduk dalam Panitia Antar
			Lembaga  
			","(5). Menjadi anggota delegasi nasional ke
			pertemuan internasional  
			","(6). Berperan serta aktif dalam pertemuan
			ilmiah 
			","(7). Mendapat tanda jasa / penghargaan   
			","(8). Menulis  buku  pelajaran   SLTA   ke bawah yang diterbitkan dan diedarkan secara nasional  
			","(9). Mempunyai prestasi dibidang olahraga / humaniora "); 

$unsurPenunjang2 = array("Menjadi anggota dalam suatu Panitia /
			Badan pada perguruan tinggi","Menjadi anggota panitia / badan pada
			lembaga pemerintah","Menjadi anggota organisasi profesi","Mewakili Perguruan Tinggi / Lembaga
			Pemerintah duduk dalam Panitia Antar
			Lembaga","Menjadi anggota delegasi nasional ke
			pertemuan internasional","Berperan serta aktif dalam pertemuan
			ilmiah","Mendapat tanda jasa / penghargaan","Menulis  buku  pelajaran   SLTA ke bawah yang diterbitkan dan diedarkan secara nasional","Mempunyai prestasi dibidang olahraga / humaniora"); 

?>