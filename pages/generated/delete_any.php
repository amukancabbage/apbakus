<?php
if($_GET) {
	if(empty($_GET['Kode']) || empty($_GET['table'])){
		buatLog($_SESSION['UNCLE_username'],"DELETE FILE",deleteAny($koneksidb,$mySql,$_GET['Kode']));
		echo "<b>Data yang dihapus tidak ada</b>";
	}
	else {
		$tableName = decD($_GET['table']);
		$namaForm = ucwords(str_replace("t_","",$tableName));
		$mySql = "DELETE FROM ".$tableName." WHERE id=?";
		$arrayCriteria = array(decD($_GET['Kode']));
		if($tableName=="pengguna"){
			$query = "Select avatar from t_pengguna WHERE id=?";
			$arrCriteria = array(decD($_GET['Kode']));
			$data = getDataCriteria($koneksidb,$query,$arrCriteria);
			if(file_exists("./images/avatars/".$data['avatar']))
				unlink("./images/avatars/".$data['avatar']);
		}
		if($tableName=="instrumen"){
			$query = "Select gambar from instrumen WHERE id=?";
			$arrCriteria = array(decD($_GET['Kode']));
			$data = getDataCriteria($koneksidb,$query,$arrCriteria);
			if(file_exists("./images/gambar_instrumen/".$data['gambar']))
				unlink("./images/gambar_instrumen/".$data['gambar']);
		}
		if(execSql($koneksidb,$mySql,$arrayCriteria)){
			buatLog($_SESSION['UNCLE_username'],"DELETE SUCCESS",$mySql." : ".getStringArray($arrayCriteria));
			if($tableName=="instrumen")
				echo "<meta http-equiv='refresh' content='0; url=?page=Pilih-Kategori&Kode=View-Instrumen'>";
			else
				showMessageGreen("Data Berhasil dihapus");
				echo "<meta http-equiv='refresh' content='1; url=?page=".$namaForm."-Data'>";
        }else{
			showMessageRed("Data Gagal dihapus");
		}
	}
}
