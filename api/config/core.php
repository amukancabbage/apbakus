<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

$ippengguna=$_SERVER['REMOTE_ADDR'];
        if($ippengguna=="::1")
		$home_url="http://localhost/apbakus/api/";
	else
		$home_url="http://apbakus.id/api/";


$page = isset($_GET['page']) ? $_GET['page'] : 1;
$records_per_page = 5;
$from_record_num = ($records_per_page * $page) - $records_per_page;
?>
