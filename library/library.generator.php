<?php
// MEMBUAT FILE _config.php
function buatConfig($folderOutput, $namaForm, $koneksidb, $namaTable,$jmlField){
	$namaFile = strtolower($namaForm);
	if(file_exists ($folderOutput."/".$namaFile."_config.php"))
	unlink($folderOutput."/".$namaFile."_config.php");
	$myfile = fopen($folderOutput."/".$namaFile."_config.php", "w") or die("Unable to open file!");
	$pageSql="SELECT $namaTable.* FROM ".$namaTable; 
	$field = getColumn($koneksidb,$pageSql); 
	$isian = getColumnSpace($koneksidb,$pageSql); 

	fwrite($myfile, "<?php \n");
	fwrite($myfile, "\$tableName = \"".$namaTable."\"; \n");
	fwrite($myfile, "\$formName = \"".$namaForm."\"; \n");
	fwrite($myfile, "\$jmlField = \"".$jmlField."\"; \n");
	fwrite($myfile, "\n");
for($i=0;$i<=$jmlField;$i++){
	fwrite($myfile, "\$field[".$i."]=\"".$field[$i]."\"; \n");
	fwrite($myfile, "\$isian[".$i."]=\"".$isian[$i]."\"; \n");
}

	fwrite($myfile, "?>");
	fclose($myfile);
}

//MEMBUAT FILE _delete.php
function buatDelete($folderOutput, $namaForm, $namaTable){
	$namaFile = strtolower($namaForm);
	if(file_exists ($folderOutput."/".$namaFile."_data.php"))
	unlink($folderOutput."/".$namaFile."_delete.php");
	$myfile = fopen($folderOutput."/".$namaFile."_delete.php", "w") or die("Unable to open file!");
	fwrite($myfile, "<?php \n");
	fwrite($myfile, "require_once \"lib/sesladmin.php\"; \n");
	fwrite($myfile, "include_once \"".$namaFile."_config.php\"; \n");
	fwrite($myfile, "\n");
	fwrite($myfile, "if(\$_GET) { \n");
	fwrite($myfile, "	if(empty(\$_GET['Kode'])){ \n");
	fwrite($myfile, "		buatLog(\$_SESSION['BONCLINK_M4SUK'],\"DELETE FAIL\",\"NULL\"); \n");
	fwrite($myfile, "		echo \"<b>Data yang dihapus tidak ada</b>\"; \n");
	fwrite($myfile, "	} \n");
	fwrite($myfile, "	else { \n");
	fwrite($myfile, "		\$mySql = \"DELETE FROM \".\$tableName.\" WHERE \".\$field[0].\"='\".\$_GET['Kode'].\"'\"; \n");
	fwrite($myfile, "		\$myQry = mysqli_query(\$koneksidb,\$mySql) or die (\"Eror hapus data\".mysqli_error(\$koneksidb));  \n");
	fwrite($myfile, "		if(\$myQry){  \n");
	fwrite($myfile, "		buatLog(\$_SESSION['BONCLINK_M4SUK'],\"DELETE SUCCESS\",\$mySql); \n");
	fwrite($myfile, "		\$nama1 = str_replace(\"_\",\"-\",\$formName); \n");
	fwrite($myfile, "		echo \"<meta http-equiv='refresh' content='0; url=?\".hash_pass('page').\"=\".\$nama1.\"-Data'>\";  \n");
	fwrite($myfile, "		} \n");
	fwrite($myfile, "	} \n");
	fwrite($myfile, "} \n");		
	fwrite($myfile, "?>");
	fclose($myfile);
}

// MEMBUAT FILE _edit.php
function buatEdit($folderOutput, $namaForm, $namaTable,$jmlField){
	$namaFile = strtolower($namaForm);
	$myfile = fopen($folderOutput."/".$namaFile."_edit.php", "w") or die("Unable to open file!");
	buatBtnSave($myfile,$namaFile,$jmlField,"UPDATE");
	fwrite($myfile, "	} \n");
	fwrite($myfile, " \n");

	fwrite($myfile, "\$Kode	 = isset(\$_GET['Kode']) ?  \$_GET['Kode'] : \$_POST['txt0']; \n");
	fwrite($myfile, "\$sqlShow = \"SELECT * FROM \".\$tableName.\" WHERE \".\$field[0].\"='\$Kode'\";\n");
	fwrite($myfile, "\$qryShow = mysqli_query(\$koneksidb, \$sqlShow)  or die (\"Query ambil data salah : \".mysqli_error(\$koneksidb));\n");
	fwrite($myfile, "\$dataShow = mysqli_fetch_array(\$qryShow);\n");
	fwrite($myfile, " \n");
	fwrite($myfile, "for(\$i=0;\$i<=\$jmlField;\$i++){\n");
	fwrite($myfile, "	\$data[\$i] = \$dataShow[\$field[\$i]];\n");
	fwrite($myfile, "}\n");
	fwrite($myfile, "} // Penutup GET\n");
	fwrite($myfile, "?>\n");

	
	fwrite($myfile, "<?php tampilEditA(\$formName);  \n");	
	fwrite($myfile, " buatHiddenText(\$data[0],0);  \n");	
for($i=1;$i<=$jmlField;$i++){
	if(($i!=1) && ($i!=2) && ($i!=3)){
	fwrite($myfile, "		buatInputText(\$isian[$i],$i,\$data[$i]); \n");
	}
}
	fwrite($myfile, "	tampilEditB(); \n");
	fwrite($myfile, "		?> \n");	
}

// MEMBUAT FILE _data.php
function buatData($folderOutput, $namaForm, $namaTable,$jmlField){
	$namaFile = strtolower($namaForm);
	if(file_exists ($folderOutput."/".$namaFile."_data.php"))
	unlink($folderOutput."/".$namaFile."_data.php");
	$myfile = fopen($folderOutput."/".$namaFile."_data.php", "w") or die("Unable to open file!");
	buatBtnSave($myfile,$namaFile,$jmlField,"INSERT");
	fwrite($myfile, "	} \n");
	fwrite($myfile, " \n");
	
for($i=1;$i<=$jmlField;$i++){
	fwrite($myfile, "	\$data[".$i."]	= isset(\$_POST['txt".$i."']) ? \$_POST['txt".$i."'] : ''; \n");		
}
	fwrite($myfile, "} \n");
	fwrite($myfile, "\$pageSql = \"SELECT \$tableName.* FROM \".\$tableName; \n");
	fwrite($myfile, "\$pageQry = mysqli_query(\$koneksidb, \$pageSql) or die (\"error paging: \".\$pageSql); \n");
	fwrite($myfile, " \n");
	fwrite($myfile, "?> \n");
	fwrite($myfile, " \n");
		
	fwrite($myfile, "<?php tampilInputA(\$formName);  \n");
for($i=4;$i<=$jmlField;$i++){
	fwrite($myfile, "	buatInputText(\$isian[".$i."],".$i.",\$data[".$i."]); \n"); 
}
	fwrite($myfile, " tampilInputB(); \n");
	fwrite($myfile, "/* \n");
	fwrite($myfile, "\$customQuery = \"select * from ".$namaTable."\"; \n");
for($i=0;$i<=$jmlField-1;$i++){
	fwrite($myfile, "\$head[$i]=\$isian[$i]; \n");
}

for($i=0;$i<=$jmlField-5;$i++){
	$j=$i+4;
	fwrite($myfile, "\$isi[$i]=\$field[$i]; \n");
}
	fwrite($myfile, "tampilTabelCustom(\$koneksidb,\$customQuery,\$head,\$isi,\$formName);\n");
	
	fwrite($myfile, "*/ \n");
	fwrite($myfile, "tampilTabel(\$koneksidb,\$tableName,\$isian,\$field,\$formName,\$jmlField); \n?>");
}

// GENERATE ISI BUTTON SAVE
function buatBtnSave($myfile,$namaFile,$jmlField,$mode){
	fwrite($myfile, "<?php \n");
	fwrite($myfile, "require_once \"lib/sesladmin.php\"; \n");
	fwrite($myfile, "include_once \"".$namaFile."_config.php\"; \n");
	fwrite($myfile, "if(\$_GET) { \n");
	fwrite($myfile, "	if(isset(\$_POST['btnSave'])){ \n");
	fwrite($myfile, " \n");
	
if($mode=="INSERT"){
	fwrite($myfile, "		\$txt[1] = date(\"Y-m-d h:i:sa\"); \n");
	fwrite($myfile, "		\$txt[2] = NULL; \n");
	fwrite($myfile, "		\$txt[3] = 0; \n");
}else{
    fwrite($myfile, "		\$txt[0] = \$_POST['txt0']; \n");
	fwrite($myfile, "		\$txt[2] = date(\"Y-m-d h:i:sa\"); \n");
	fwrite($myfile, "		\$txt[3] = 0; \n");
}
for($i=4;$i<=$jmlField;$i++){
	fwrite($myfile, "		\$txt[".$i."] = \$_POST['txt".$i."']; \n");		
}
	fwrite($myfile, " \n");
	fwrite($myfile, "		\$pesanError = array(); \n");
	fwrite($myfile, "		for(\$i=4;\$i<=\$jmlField;\$i++){ \n");
	fwrite($myfile, "			if (trim(\$txt[\$i])==\"\") { \n");
	fwrite($myfile, "				\$pesanError[] = \"Data <b>\".\$isian[\$i].\"</b> tidak boleh kosong !\"; \n"); 		
	fwrite($myfile, "			} \n");
	fwrite($myfile, "		} \n");	
	fwrite($myfile, " \n");
if($mode=="INSERT"){
	fwrite($myfile, "		\$ada = cekAda(\$koneksidb,\$tableName,\$field[4],\$isian[4],\$txt[4]); \n");
	fwrite($myfile, "		if(\$ada)        {  \n");
	fwrite($myfile, "			\$pesanError[] = \"Maaf, \".\$isian[4].\" <b> \".\$txt[4].\" </b> Sudah Ada.\";	 \n");
	fwrite($myfile, "		} \n");
}else{
	fwrite($myfile, "		//\$ada = cekAda(\$koneksidb,\$tableName,\$field[4],\$isian[4],\$txt[4]); \n");
	fwrite($myfile, "		//if(\$ada)        {  \n");
	fwrite($myfile, "		//	\$pesanError[] = \"Maaf, \".\$isian[4].\" <b> \".\$txt[4].\" </b> Sudah Ada.\";	 \n");
	fwrite($myfile, "		//} \n");
}
	fwrite($myfile, " \n");
	fwrite($myfile, "		if (count(\$pesanError)>=1 ){  \n");
	fwrite($myfile, "			\$noPesan=0; \n");
	fwrite($myfile, "			foreach (\$pesanError as \$indeks=>\$pesan_tampil) {  \n");
	fwrite($myfile, "				\$noPesan++;  \n");
	fwrite($myfile, "				echo '\n ");
	fwrite($myfile, "				<div class=\"alert alert-warning alert-dismissible\" role=\"alert\"> \n");
	fwrite($myfile, "				<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button> \n");
	fwrite($myfile, "				<h4 class=\"alert-heading\">Error!</h4>'.\$noPesan.'. '.\$pesan_tampil.'</div><br>';	 \n"); 
fwrite($myfile, "			}  \n");
	fwrite($myfile, "			echo \" <br>\";  \n");
if($mode=="INSERT"){
	fwrite($myfile, "			buatLog(\$_SESSION['BONCLINK_M4SUK'],\"INSERT FAIL\",getStringArray(\$pesanError)); \n");
	fwrite($myfile, "		} \n");
	fwrite($myfile, "		else { \n");
	fwrite($myfile, "			\$mySql	= \"INSERT INTO \".\$tableName.\" \".getInsert(\$jmlField,\$field,\$txt); \n");
	fwrite($myfile, "			\$myQry	= mysqli_query(\$koneksidb, \$mySql) or die (\"Gagal query insert :\".getInsert(\$jmlField,\$field,\$txt)); \n");
	fwrite($myfile, "			if(\$myQry){ \n");
	fwrite($myfile, "			buatLog(\$_SESSION['BONCLINK_M4SUK'],\"INSERT SUCCESS\",\$mySql); \n");
}else{
	fwrite($myfile, "			buatLog(\$_SESSION['BONCLINK_M4SUK'],\"UPDATE FAIL\",getStringArray(\$pesanError)); \n");
	fwrite($myfile, "		} \n");
	fwrite($myfile, "		else { \n");
	fwrite($myfile, "			\$mySql	= \"UPDATE \".\$tableName.\" SET \".getUpdate(\$jmlField,\$field,\$txt); \n");
	fwrite($myfile, "			\$myQry	= mysqli_query(\$koneksidb, \$mySql) or die (\"Gagal query update :\".\$mySql); \n");
	fwrite($myfile, "			if(\$myQry){ \n");
	fwrite($myfile, "			buatLog(\$_SESSION['BONCLINK_M4SUK'],\"UPDATE SUCCESS\",\$mySql); \n");
}	

	fwrite($myfile, "		\$nama1 = str_replace(\"_\",\"-\",\$formName); \n");
	fwrite($myfile, "		echo \"<meta http-equiv='refresh' content='0; url=?\".hash_pass('page').\"=\".\$nama1.\"-Data'>\";  \n");

	fwrite($myfile, "			} \n");
	fwrite($myfile, "			exit; \n");
	fwrite($myfile, "		} \n");
	fwrite($myfile, " \n");
	
}

?>