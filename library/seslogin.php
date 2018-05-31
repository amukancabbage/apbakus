<?php
if(empty($_SESSION['MAIN_DAS_L4H'])) {
	echo "<center>";
	echo "<br> <br> <b>Maaf Akses Anda Ditolak!</b> <br>
		  Silahkan masukkan Data Login Anda dengan benar untuk bisa mengakses halaman ini.";
	echo "</center>";
	include_once "index.php";
	exit;
}
?>