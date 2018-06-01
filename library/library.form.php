<?php
// MENAMPILKAN TABLE DALAM DATATABLES
function showTable($koneksidb,$tableName,$isian,$field,$formName,$jmlField,$mySql){
	$nama1 = str_replace("_","-",$formName);
	tableGentellaBEGIN(4,$jmlField+1,$isian);
	//$mySql = "SELECT $tableName.* FROM ".$tableName;
	$nomor  = 1; 
	$kolomDat = getDataAll($koneksidb,$mySql);
	foreach ($kolomDat as $kolomData) {
		$Kode = $kolomData[$field[0]];
		echo("<tr>");
		echo("<td align=\"center\">".$nomor++."</td>");
		$i=4;
		while($i<=$jmlField){
			echo("<td> ".$kolomData[$field[$i]]." </td>");
			$i++;
		}
		echo("</td>");	
		echo("<td class=\"cc\" align=\"center\"><a href=\"?page=".$nama1."-Ubah&Kode=".encD($Kode)." \" target=\"_self\"><span class=\"btn btn-primary\"><i class=\"fa fa-edit\"></i> Ubah</span></a>");
		echo("<a href=\"?page=Delete&Kode=".encD($Kode)."&table=".encD($tableName)." \" onclick=\"return confirm('Anda Yakin menghapus Data ? ')\"><span class=\"btn btn-danger\"><i class=\"fa fa-trash\"></i> Hapus</span></a></td>");
		echo("</tr>");	
	}
	
	tableGentellaEND();
}

function showTableCriteria($koneksidb,$tableName,$isian,$field,$formName,$jmlField,$mySql,$arrCriteria){
	$nama1 = str_replace("_","-",$formName);
	tableGentellaBEGIN(4,$jmlField+1,$isian);
	//$mySql = "SELECT $tableName.* FROM ".$tableName;
	$jmlData = getDataNumber2($koneksidb,$mySql,$arrCriteria);
	$nomor  = 1; 
	//$kolomDat = getDataCriteria($koneksidb,$mySql,$arrCriteria);
	$kolomData = getDataCriteria($koneksidb,$mySql,$arrCriteria);
	//foreach ($kolomDat as $kolomData) {
	while($nomor<=$jmlData){
		$Kode = $kolomData[0];
		echo("<tr>");
		echo("<td align=\"center\">".$nomor++."</td>");
		$i=4;
		while($i<=$jmlField){
			echo("<td> ".$kolomData[$field[$i]]." </td>");
			$i++;
		}
		echo("</td>");	
		echo("<td class=\"cc\" align=\"center\"><a href=\"?page=".$nama1."-Ubah&Kode=".encD($Kode)." \" target=\"_self\"><span class=\"btn btn-primary\"><i class=\"fa fa-edit\"></i> Ubah</span></a>");
		echo("<a href=\"?page=Delete&Kode=".encD($Kode)."&table=".encD($tableName)." \" onclick=\"return confirm('Anda Yakin menghapus Data ? ')\"><span class=\"btn btn-danger\"><i class=\"fa fa-trash\"></i> Hapus</span></a></td>");
		echo("</tr>");	
	}
	
	tableGentellaEND();
}

function showTableAsesmen($koneksidb,$tableName,$isian,$field,$formName,$jmlField,$mySql,$arrCriteria){
	$nama1 = str_replace("_","-",$formName);
	tableGentellaBEGIN(4,$jmlField+1,$isian);
	//$mySql = "SELECT $tableName.* FROM ".$tableName;
	$jmlData = getDataNumber2($koneksidb,$mySql,$arrCriteria);
	$nomor  = 1; 
	//$kolomDat = getDataCriteria($koneksidb,$mySql,$arrCriteria);
	$kolomDat = getDataCriteriaAll($koneksidb,$mySql,$arrCriteria);
	foreach ($kolomDat as $kolomData) {
	//while($nomor<=$jmlData){
		$Kode = $kolomData[$field[0]];
		echo("<tr>");
		echo("<td align=\"center\">".$nomor++."</td>");
		$i=4;
		while($i<=$jmlField){
			if($field[$i]=='gambar')
				echo("<td><img style=\"width: 100px; display: block;\" src=\"./images/gambar_instrumen/".$kolomData[$field[$i]]."\" alt=\"Gambar tidak ada\"></td>");
			
			else if($field[$i]=='butir1')
				echo("<td><textarea> ".$kolomData[$field[$i]]." </textarea></td>");	
			else
				echo("<td> ".$kolomData[$field[$i]]." </td>");
			$i++;
		}
		echo("</td>");
		?>
		<td>
			<label>
				<input type="checkbox"  value="<?php echo $Kode?>" name="cbmampu[]" class="js-switch" 
				<?php

						if($kolomData['hasil']=="MAMPU")
							echo ' checked';
					
				?>
				/> Mampu
				<span class="label label-success success<?php echo $Kode; ?>" style="display:none"> Nilai Sudah Disimpan</span>
			</label>
		</td>
		<!-- <script type="text/javascript" src="js/jquery.min.js"></script>
		<script type="text/javascript" >
		$(function() {
			$("#cb<?php echo $Kode?>").change(function () {
			var value = $(this).val();
			$.ajax({
				type: "POST",
				url: "set_home_vid.php",
				async: true,
				data: {
					action1: value // as you are getting in php $_POST['action1'] 
				},
				success: function (msg) {
					alert('Success');
					if (msg != 'success') {
						alert('Fail');
					}
				}
			});
		});
                        $("#submitpengajaran<?php echo $nomor?>").click(function() {
                            
                            var id = $("#idpengajaran<?php echo $nomor;?>").val();
                            var inc = $("#incpengajaran").val();
                            var Kode = $("#Kode").val();
                            var NamaTabel = $("#NamaTabelPengajaran").val();
                            var user = $("#user").val();
                            var t2 = $("#t2pengajaran").val();
                            var ak = $("#akpengajaran<?php echo $nomor;?>").val();
                            var dataString = 'id='+ id +
                                            '&Kode='+ Kode +
                                            '&user='+ user +                                            
                                            '&inc=' + inc + 
                                            '&t2=' + t2 + 
                                            '&nomor=' + <?php echo $nomor?> + 
                                            '&ak<?php echo $nomor?>=' + ak;
                            var alamat = "?<?php echo hash_pass('page')."=Usulan-Nilai&Kode=".$Kode;?> #card-pendidikan"

                            if(id=='' || inc=='' || t2=='' || ak=='')
                            {
                                //alert(dataString);
                                $('.successpengajaran<?php echo $nomor; ?>').fadeOut(200).hide();
                                $('.errorpengajaran<?php echo $nomor; ?>').fadeOut(200).show();
                            }
                            else
                            {
                                //alert(dataString);
                                //alert(alamat)
                                $.ajax({
                                    type: "POST",
                                    url: "pages/penilai/subm.php",
                                    data: dataString,
                                    success: function(){
                                        $('.successpengajaran<?php echo $nomor; ?>').fadeIn(200).show();
                                        $('.errorpengajaran<?php echo $nomor; ?>').fadeOut(200).hide();
                                        tampilkanNilai(NamaTabel,id,'setujupengajaran<?php echo $nomor; ?>');
                                        //$("#card-pendidikan").load(alamat);
                                    }
                                });
                            }
                            return false;
                        });
                    });
                    </script> -->
		<?php
		
		echo("</tr>");	
	}
	
	tableGentellaEND();
}

function showTableUpsus($koneksidb,$tableName,$isian,$field,$formName,$jmlField,$mySql,$arrCriteria){
	$nama1 = str_replace("_","-",$formName);
	tableGentellaBEGIN(4,$jmlField+1,$isian);
	//$mySql = "SELECT $tableName.* FROM ".$tableName;
	$jmlData = getDataNumber2($koneksidb,$mySql,$arrCriteria);
	$nomor  = 1; 
	//$kolomDat = getDataCriteria($koneksidb,$mySql,$arrCriteria);
	$kolomData = getDataCriteria($koneksidb,$mySql,$arrCriteria);
	//foreach ($kolomDat as $kolomData) {
	while($nomor<=$jmlData){
		$Kode = $kolomData[0];
		echo("<tr>");
		echo("<td align=\"center\">".$nomor++."</td>");
		$i=4;
		while($i<=$jmlField){
			echo("<td> ".$kolomData[$field[$i]]." </td>");
			$i++;
		}
		echo("</td>");	
		echo("<td class=\"cc\" align=\"center\"><a href=\"?page=".$nama1."-Ubah&Kode=".encD($Kode)." \" target=\"_self\"><span class=\"btn btn-primary\"><i class=\"fa fa-edit\"></i> Ubah</span></a>");
		echo("<a href=\"?page=Delete&Kode=".encD($Kode)."&table=".encD($tableName)." \" onclick=\"return confirm('Anda Yakin menghapus Data ? ')\"><span class=\"btn btn-danger\"><i class=\"fa fa-trash\"></i> Hapus</span></a></td>");
		echo("</tr>");	
	}
	
	tableGentellaEND();
}

function tableGentellaBEGIN($start,$jmlField,$isian){
	?>
	<div class="x_content">
		<table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
		<thead>
			<tr>
				<th width="10px">No</th>;
				<?php
					for($i=$start;$i<=$jmlField-1;$i++){
						echo('			<th>'.$isian[$i].'</th> ');
					}
				?>
				<th width="80px" >Action</th>
			</tr>
		</thead>
		<tbody>
	<?php
}

function tableGentellaEND(){
	?>
		</tbody>
	</div>
	<?php
}

function input($type,$text,$i,$data,$tambahan){
	?>
		<div class="form-group">
    		<label class="control-label col-md-3 col-sm-3 col-xs-12" for="txt<?php echo $i;?>"><?php echo $text ;?><span class="required">*</span>
    		</label>
			<div class="col-md-6 col-sm-6 col-xs-12">
				<input type="<?php echo $type;?>" 
						id="txt<?php echo $i;?>" 
						name="txt<?php echo $i;?>" 
						class="form-control col-md-7 col-xs-12" 
						value="<?php echo $data; ?>" 
						<?php echo $tambahan;?>>
			</div>
  		</div>
	<?php
}
function lihatGambar($text,$source){
	?>
		<div class="form-group">
    		<label class="control-label col-md-3 col-sm-3 col-xs-12" <span class="required"><?php echo $text ;?>*</span>
    		</label>
			<div class="col-md-6 col-sm-6 col-xs-12">
				<img style="width: 100px; display: block;" src="./images/gambar_instrumen/<?php echo $source;?>" alt="gambar tidak ditemukan">
			</div>
  		</div>
	<?php
}

function inputTextarea($type,$text,$i,$data,$tambahan){
	?>
		<div class="form-group">
    		<label class="control-label col-md-3 col-sm-3 col-xs-12" for="txt<?php echo $i;?>"><?php echo $text ;?><span class="required">*</span>
    		</label>
			<div class="col-md-6 col-sm-6 col-xs-12">
				<textarea type="<?php echo $type;?>" 
						id="txt<?php echo $i;?>" 
						name="txt<?php echo $i;?>" 
						class="form-control col-md-7 col-xs-12" 
						 
						<?php echo $tambahan;?>><?php echo $data; ?></textarea>
			</div>
  		</div>
	<?php
}

function inputRadio($type,$text,$i,$data,$tambahan){
	?>  
		  <div class="form-group">
    		<label class="control-label col-md-3 col-sm-3 col-xs-12" for="txt<?php echo $i;?>"><?php echo $text ;?><span class="required">*</span>
    		</label>
			<div class="col-md-6 col-sm-6 col-xs-12">
                      <p>
						Laki-laki:<input type="radio" class="flat" name="txt<?php echo $i;?>"  id="Laki-laki" value="Laki-laki" <?php if($data="Laki-laki") echo "checked" ?> required /> 
						Perempuan:<input type="radio" class="flat" name="txt<?php echo $i;?>"  id="Perempuan" value="Perempuan" <?php if($data="Perempuan") echo "checked" ?>/>
					  </p>
					  </div>
		  </div>                
	<?php
}

function inputHidden($text,$i,$data,$tambahan){
	?>
		<div class="form-group">
			<div class="col-md-6 col-sm-6 col-xs-12">
				<input type="hidden" 
						id="txt<?php echo $i;?>" 
						name="txt<?php echo $i;?>" 
						class="form-control col-md-7 col-xs-12" 
						value="<?php echo $data; ?>" 
						<?php echo $tambahan;?>>
			</div>
  		</div>
	<?php
}

function select($text,$i,$data,$arrayValue,$arrayTampil){
	?>
	<div class="form-group">
		<label class="control-label col-md-3 col-sm-3 col-xs-12"><?php echo $text;?><span class="required">*</span></label>
		<div class="col-md-6 col-sm-6 col-xs-12">
			<select class="form-control" name="txt<?php echo $i; ?>" required>
			<option value="">Pilih <?php echo $text;?></option>
			<?php 
				$jmlField=count($arrayTampil);
				for($i=0;$i<=$jmlField-1;$i++){
					if ($data == $arrayValue[$i]) {
						$cek = "selected";
					} else { $cek=""; }		
					echo "<option value='$arrayValue[$i]' $cek>$arrayTampil[$i]</option>";
				}	
			?>
			</select>
		</div>
	</div>
	<?php 
}

function select_with_group_kecamatan($koneksidb,$text,$i){
	?>
	<div class="form-group">
		<label class="control-label col-md-3 col-sm-3 col-xs-12"><?php echo $text;?><span class="required">*</span></label>
		<div class="col-md-6 col-sm-6 col-xs-12">
			<select class="form-control" name="txt<?php echo $i; ?>" required>
			<option value="">Pilih <?php echo $text;?></option>
			<?php 
				$result = getDataAll($koneksidb,"SELECT t_kecamatan.id, t_kecamatan.nama_kecamatan, t_kabupaten.nama_kabupaten FROM t_kecamatan INNER JOIN t_kabupaten ON t_kecamatan.id_kabupaten = t_kabupaten.id");
				
				$pilihan = array();
				$paluy = array();
				foreach ($result as $value) {
					$paluy[]=$value['0'];
					$pilihan[]=$value['1'];
				}
				$jmlField=count($paluy);
				for($i=0;$i<=$jmlField-1;$i++){
					?>
					<optgroup label="<?php echo $pilihan[$i]; ?>"> 					
					<?php
					$result2 = getDataAll($koneksidb,"SELECT t_desa.id, t_desa.nama_desa FROM t_desa WHERE id_kecamatan=".$paluy[$i]);
					$pilihan2 = array();
					$paluy2 = array();
					foreach ($result2 as $value2) {
						$paluy2[]=$value2['0'];
						$pilihan2[]=$value2['1'];
					}
					$jmlField2=count($paluy2);
					for($j=0;$j<=$jmlField2-1;$j++){
					 	echo "<option value=$paluy2[$j] >$pilihan2[$j]</option>";
					}
					?> 
					</optgroup>
					<?php
				}
			
			?>
			</select>
		</div>
	</div>
	<?php 
}


function uploadAvatar($txtFile,$username,$tipeFile){
    $tmpFilePath = $_FILES[$txtFile]['tmp_name'];
    if($tmpFilePath != ""){
        $directoryName = './images/avatars/';
        if(!is_dir($directoryName)){
            mkdir($directoryName, 0755, True);
        }				
        $filePath = $directoryName.'/'.$username.'.'.$tipeFile;
        move_uploaded_file($tmpFilePath, $filePath);
		$width_size = 180;		
		$filesave = $filePath;		
		$resize_image = $filePath;

		// mendapatkan ukuran width dan height dari image
		list( $width, $height ) = getimagesize($filesave);

		// mendapatkan nilai pembagi supaya ukuran skala image yang dihasilkan sesuai dengan aslinya
		$k = $height / $width_size;

		// menentukan width yang baru
		$newwidth = $width / $k;

		// menentukan height yang baru
		$newheight = $height / $k;

		// fungsi untuk membuat image yang baru
		$thumb = imagecreatetruecolor($newwidth, $newheight);
		$source = imagecreatefromjpeg($filesave);

		// men-resize image yang baru
		imagecopyresized($thumb, $source, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);

		// menyimpan image yang baru
		imagejpeg($thumb, $resize_image);

		imagedestroy($thumb);
		imagedestroy($source);

        return $username.".".$tipeFile;             
    } 
}

function uploadGambar($txtFile,$username,$tipeFile){
	$tmpFilePath = $_FILES[$txtFile]['tmp_name'];
    if($tmpFilePath != ""){
        $directoryName = './images/gambar_instrumen/';
        if(!is_dir($directoryName)){
            mkdir($directoryName, 0755, True);
        }				
        $filePath = $directoryName.'/'.$username.'.'.$tipeFile;
        move_uploaded_file($tmpFilePath, $filePath);
		$width_size = 180;		
		$filesave = $filePath;		
		$resize_image = $filePath;

		// mendapatkan ukuran width dan height dari image
		list( $width, $height ) = getimagesize($filesave);

		// mendapatkan nilai pembagi supaya ukuran skala image yang dihasilkan sesuai dengan aslinya
		$k = $height / $width_size;

		// menentukan width yang baru
		$newwidth = $width / $k;

		// menentukan height yang baru
		$newheight = $height / $k;

		// fungsi untuk membuat image yang baru
		$thumb = imagecreatetruecolor($newwidth, $newheight);
		$source = imagecreatefromjpeg($filesave);

		// men-resize image yang baru
		imagecopyresized($thumb, $source, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);

		// menyimpan image yang baru
		imagejpeg($thumb, $resize_image);

		imagedestroy($thumb);
		imagedestroy($source);

        return $username.".".$tipeFile;             
    } 
}


function tampilTabel($koneksidb,$tableName,$isian,$field,$formName,$jmlField){
	$nama1 = str_replace("_","-",$formName);
	tabelBSBsingkronBEGIN($formName,4,$jmlField+1,$isian);
	$mySql = "SELECT $tableName.* FROM ".$tableName." ORDER BY ".$field[4]." ASC";
	$myQry = mysqli_query($koneksidb, $mySql)  or die ("Query salah : ".mysqli_error($koneksidb));
	$nomor  = 1; 
	while ($kolomData = mysqli_fetch_array($myQry)) {
		$Kode = $kolomData[$field[0]];
		echo("<tr>");
		echo("<td align=\"center\">".$nomor++."</td>");
		$i=4;
		while($i<=$jmlField){
			echo("<td> ".$kolomData[$field[$i]]." </td>");
			$i++;
		}
		echo("</td>");	
		echo("<td class=\"cc\" align=\"center\"><a href=\"?".hash_pass('page')."=".$nama1."-Edit&Kode=".$Kode." \" target=\"_self\"><i class=\"material-icons\">edit</i></a>");
		echo("<a href=\"?".hash_pass('page')."=". $nama1."-Delete&Kode=".$Kode." \" onclick=\"return confirm('Anda Yakin menghapus Data ? ')\"><i class=\"material-icons\">delete</i></a></td>");
		echo("</tr>");	
	}
	
	tabelBSBsingkronEND();
}
// MENAMPILKAN TABLE DALAM DATATABLES DENGAN QUERY CUSTOM
function tampilTabelCustom($koneksidb,$customQuery,$isian,$field,$formName){
	$jmlField = count($isian);
	$nama1 = str_replace("_","-",$formName);
	tabelBSBsingkronBEGIN($formName,0,$jmlField,$isian);

	$mySql = $customQuery;
	$myQry = mysqli_query($koneksidb, $mySql)  or die ("Query salah : ".mysqli_error($koneksidb));
	$nomor  = 1; 
	while ($kolomData = mysqli_fetch_array($myQry)) {
		$Kode = $kolomData[0];
		echo("<tr>");
		echo("<td align=\"center\">".$nomor++."</td>");
		$i=0;
		while($i<=$jmlField-1){
			echo("<td> ".$kolomData[$field[$i]]." </td>");
			$i++;
		}
		echo("</td>");	
		echo("<td class=\"cc\" align=\"center\"><a href=\"?".hash_pass('page')."=".$nama1."-Edit&Kode=".$Kode." \" target=\"_self\"><i class=\"material-icons\">edit</i></a>");
		echo("<a href=\"?".hash_pass('page')."=". $nama1."-Delete&Kode=".$Kode." \" onclick=\"return confirm('Anda Yakin menghapus Data ? ')\"><i class=\"material-icons\">delete</i></a></td>");
		echo("</tr>");	
	}
	
	tabelBSBsingkronEND();
}
// MENAMPILKAN TABLE DALAM DATATABLES UNTUK PESAN 
function tampilTabelCustomPesan($koneksidb,$customQuery,$isian,$field,$formName){
	$jmlField = count($isian);
	$nama1 = str_replace("_","-",$formName);
	tabelBSBsingkronBEGIN($formName,0,$jmlField,$isian);

	$mySql = $customQuery;
	$myQry = mysqli_query($koneksidb, $mySql)  or die ("Query salah dari tampilTabelCustom3 : ".mysqli_error($koneksidb));	
	$listFieldTanggal = getFieldDateTime($myQry);
	if (count($listFieldTanggal)==0)
		$end = 1000;
	else
		$end=count($listFieldTanggal)-1;
	$mySql = $customQuery;
	$myQry = mysqli_query($koneksidb, $mySql)  or die ("Query salah : ".mysqli_error($koneksidb));
	$nomor  = 1; 
	// echo "ini end :$listFieldTanggal[0]"; opo iki 
	while ($kolomData = mysqli_fetch_array($myQry)) {
		$Kode = $kolomData['id'];
		$pengirim = $kolomData['dari'];
		echo("<tr>");
		echo("<td align=\"center\">".$nomor++."</td>");
		$i=0;
		while($i<=$jmlField-1){
			$cont = $kolomData[$field[$i]];
			if($end<1000){
			for($j=0;$j<=$end;$j++){
				if($field[$i]==$listFieldTanggal[$j])
					$cont = str_replace(" ","<br/>",$kolomData[$field[$i]]);
			}
			}
			if($cont=='BARU')
				echo '<td><i class="material-icons">check</i></td>' ;
			else if ($cont=='DIBACA')
				echo '<td><i class="material-icons">remove_red_eye</i></td>' ;
			else
				echo("<td> ".$cont." </td>");
			
			$i++;
		}
		echo("</td>");	
		if($kolomData['dari']!=$_SESSION['ID_CRAB']) {
		echo('<td class="cc" align="center"><a href="?'.hash_pass('page').'='. $nama1.'-Balas&Kode='.$pengirim.' " target="_self"><i class="material-icons">reply</i></a>' );
		}
		else {
		echo('<td class="cc" align="center"> <i class="material-icons">send</i></a>' );
			
		}
		echo("</tr>");	
	}
	
	tabelBSBsingkronEND();
}
// MENAMPILKAN TABLE DALAM DATATABLES DENGAN QUERY CUSTOM PADA FORM USULAN (ADMIN)
function tampilTabelCustom2($koneksidb,$customQuery,$isian,$field,$formName,$formSubmit,$icon){
	$jmlField = count($isian);
	$nama1 = str_replace("_","-",$formName);
	tabelBSBsingkronBEGIN($formName,0,$jmlField,$isian);

	$mySql = $customQuery;
	$myQry = mysqli_query($koneksidb, $mySql)  or die ("Query salah dari tampilTabelCustom2 : ".mysqli_error($koneksidb));
	$nomor  = 1; 
	$listFieldTanggal = getFieldTanggal($myQry);
	if (count($listFieldTanggal)==0)
		$end = 1000;
	else
		$end=count($listFieldTanggal)-1;

	//echo "isi : ".$listFieldTanggal[0];
	
	while ($kolomData = mysqli_fetch_array($myQry)) {
		$Kode = $kolomData[0];
		echo("<tr>");
		echo("<td align=\"center\">".$nomor++."</td>");
		$i=0;
		while($i<=$jmlField-1){
			$cont = $kolomData[$field[$i]];
			if($end<1000){
				for($j=0;$j<=$end;$j++){
					//echo count($listFieldTanggal)." | ".$end." | ".$i." | ".$field[$i]." | ".$j." | ".$listFieldTanggal[$j]." \n";
					if($field[$i]==$listFieldTanggal[$j])
						$cont = Indonesia2Tgl($kolomData[$field[$i]]);
					if($field[$i]=="nidn"){
						$s = "select t_dosen.*,t_universitas.nama_universitas, t_prodi.nama_prodi from t_dosen 
							  left join t_universitas on t_dosen.id_universitas = t_universitas.id
							  left join t_prodi on t_dosen.id_prodi = t_prodi.id							  
							  where nidn='".$kolomData[$field[$i]]."'";
						$m = mysqli_query($koneksidb, $s)  or die ("Query salah dari tampilTabelNyanyuk : ".mysqli_error($koneksidb));
						$k = mysqli_fetch_array($m);
						$cont = "<div class=\"button-demo js-modal-buttons\"><button type=\"button\" data-color=\"blue\" class=\"btn bg-blue waves-effect\" 
										data-nidn=\"".$kolomData[$field[$i]]."\" 
										data-nama=\"".$k['gelar_depan']."".$k['nama_dosen'].",".$k['gelar_belakang']."\" 
										data-univ=\"".$k['nama_universitas']."\" 
										data-prodi=\"".$k['nama_prodi']."\" 
										data-toggle=\"modal\" >".$kolomData[$field[$i]]."</button></div>";
					}
						
				}
			}
			echo("<td> ".$cont." </td>");
			$i++;
		}
		echo("</td>");	
		echo("<td class=\"cc\" align=\"center\"><a href=\"?".hash_pass('page')."=".$formSubmit."&Kode=".$Kode." \" target=\"_self\"><i class=\"material-icons\">".$icon."</i></a>");
		if($_SESSION['LEVEL']!= "Penilai") {
		echo("<a href=\"?".hash_pass('page')."=". $formSubmit."-Delete&Kode=".$Kode." \" onclick=\"return confirm('Anda Yakin menghapus Data ? ')\"><i class=\"material-icons\">delete</i></a>
		</td>");
		}
		echo("</tr>");	
	}
	
	tabelBSBsingkronEND();
}
//table tanpa icon delete bisa ada edit atau bisa ada delete
function tampilTabelCustom3($koneksidb,$customQuery,$isian,$field,$formName,$formSubmit,$opsi,$jmlField,$deleteTable){
	//$jmlField = count($isian);
	$nama1 = str_replace("_","-",$formName);
	tabelBSBsingkronBEGIN($formName,0,$jmlField,$isian);

	
	$mySql = $customQuery;
	$myQry = mysqli_query($koneksidb, $mySql)  or die ("Query salah dari tampilTabelCustom3 : ".mysqli_error($koneksidb));
	$nomor  = 1; 
	$zz = mysqli_fetch_array($myQry);
	$IDUSULAN = $zz['id_usulan'];
	$NIDN='';
	if($IDUSULAN!=''){
		if($_SESSION['LEVEL'] == "Dosen")
			$mySql = "SELECT * FROM t_dosen where id_pengguna=".$_SESSION['ID_CRAB'];
		else{
			$mySql = "SELECT t_dosen.nidn, t_usulan.id FROM t_dosen 
					LEFT JOIN t_pengguna ON t_pengguna.id = t_dosen.id_pengguna 
					LEFT JOIN t_usulan ON t_usulan.id_dosen = t_pengguna.id
					WHERE t_usulan.id = $IDUSULAN";
		}
		$myQry1 = mysqli_query($koneksidb, $mySql)  or die ("Query salah dari getNIDN : ".mysqli_error($koneksidb)." | QUERY :".$mySql);
		$data = mysqli_fetch_array($myQry1);
		$NIDN = $data['nidn'];
	}

	$mySql = $customQuery;
	$myQry = mysqli_query($koneksidb, $mySql)  or die ("Query salah dari tampilTabelCustom3 : ".mysqli_error($koneksidb));	
	$listFieldTanggal = getFieldTanggal($myQry);
	if (count($listFieldTanggal)==0)
		$end = 1000;
	else
		$end=count($listFieldTanggal)-1;

	while ($kolomData = mysqli_fetch_array($myQry)) {

		$Kode = $kolomData[0];
		echo("<tr>");
		echo("<td align=\"center\">".$nomor++."</td>");
		$i=0;

		while($i<=$jmlField-1){
			$cont = $kolomData[$field[$i]];

			$ext = pathinfo($cont, PATHINFO_EXTENSION);

			if($ext=='pdf')
				$cont="<a href=\"?".hash_pass('page')."=File&Fo=".$NIDN."&Fi=$cont \" target=\"_blank\" ><i class=\"material-icons\">picture_as_pdf</i></a></td>";

			if($end<1000){
			for($j=0;$j<=$end;$j++){
				if($field[$i]==$listFieldTanggal[$j])
					$cont = Indonesia2Tgl($kolomData[$field[$i]]);
			}
			}
			
			if (strpos($cont, 'http') !== false){
				$cont="<a href=\"".$cont."\" target=\"_blank\" ><i class=\"material-icons\">link</i></a></td>";
			}
			echo("<td> ".$cont." </td>");
			$i++;
		}
		echo("</td>");
	 
if($opsi=='edit') {		
		$XXX=str_replace("t_det_","",$deleteTable);
		echo("<td class=\"cc\" align=\"center\"><a href=\"?".hash_pass('page')."=".$XXX."-Edit&Kode=".$Kode." \" target=\"_self\"><i class=\"material-icons\">edit</i></a>
		<a href=\"?".hash_pass('page')."=". $formSubmit."-Delete&Kode=".$Kode." &tabel=".$deleteTable." \" onclick=\"return confirm('Anda Yakin menghapus Data ? ')\"><i class=\"material-icons\">delete</i></a>	
			</td>"); 
}
elseif($opsi=='delete') {
		echo("<td class=\"cc\" align=\"center\"><a href=\"?".hash_pass('page')."=". $formSubmit."-Delete&Kode=".$Kode." &tabel=".$deleteTable." \" onclick=\"return confirm('Anda Yakin menghapus Data ? ')\"><i class=\"material-icons\">delete</i></a></td>
		");
}
else {
	echo("<td class=\"cc\" align=\"center\"><i class=\"material-icons\">info_outline</i></td>");
}

	echo("</tr>");	
	}
	
	tabelBSBsingkronEND();
}
//table tanpa icon delete bisa ada edit atau bisa ada delete KHUSUSAN PENILAI TAKUTAN KLO ERROR YANG LAIN
function tampilTabelCustom4($koneksidb,$customQuery,$isian,$field,$formName,$formSubmit,$opsi,$jmlField,$deleteTable){
	//$jmlField = count($isian);
	$nama1 = str_replace("_","-",$formName);
	tabelBSBsingkronBEGIN($formName,0,$jmlField,$isian);

	
	$mySql = $customQuery;
	$myQry = mysqli_query($koneksidb, $mySql)  or die ("Query salah dari tampilTabelCustom4 : ".mysqli_error($koneksidb));
	$nomor  = 1; 
	$zz = mysqli_fetch_array($myQry);
	$IDUSULAN = $zz['id'];
	$NIDN='';
	if($IDUSULAN!=''){
		if($_SESSION['LEVEL'] == "Dosen")
			$mySql = "SELECT * FROM t_dosen where id_pengguna=".$_SESSION['ID_CRAB'];
		else{
			$mySql = "SELECT t_dosen.nidn, t_usulan.id FROM t_dosen 
					LEFT JOIN t_pengguna ON t_pengguna.id = t_dosen.id_pengguna 
					LEFT JOIN t_usulan ON t_usulan.id_dosen = t_pengguna.id
					WHERE t_usulan.id = $IDUSULAN";
		}
		$myQry1 = mysqli_query($koneksidb, $mySql)  or die ("Query salah dari getNIDN : ".mysqli_error($koneksidb)." | QUERY :".$mySql);
		$data = mysqli_fetch_array($myQry1);
		$NIDN = $data['nidn'];
	}

	$mySql = $customQuery;
	$myQry = mysqli_query($koneksidb, $mySql)  or die ("Query salah dari tampilTabelCustom4 : ".mysqli_error($koneksidb));	
	$listFieldTanggal = getFieldTanggal($myQry);
	if (count($listFieldTanggal)==0)
		$end = 0;
	else
		$end=count($listFieldTanggal)-1;

	while ($kolomData = mysqli_fetch_array($myQry)) {

		$Kode = $kolomData[0];
		echo("<tr>");
		echo("<td align=\"center\">".$nomor++."</td>");
		$i=0;

		while($i<=$jmlField-1){
			$cont = $kolomData[$field[$i]];

			$ext = pathinfo($cont, PATHINFO_EXTENSION);

			if($ext=='pdf')
				$cont="<a href=\"?".hash_pass('page')."=File&Fo=".$NIDN."&Fi=$cont \" ><i class=\"material-icons\">picture_as_pdf</i></a></td>";

			if($end>0){
			for($j=0;$j<=$end;$j++){
				if($field[$i]==$listFieldTanggal[$j])
					$cont = Indonesia2Tgl($kolomData[$field[$i]]);
			}
			}
			echo("<td> ".$cont." </td>");
			$i++;
		}
		echo("</td>");
	 
if($opsi=='edit') {		
		echo("<td class=\"cc\" align=\"center\"><a href=\"?".hash_pass('page')."=".$formSubmit."&Kode=".$Kode." \" target=\"_self\"><i class=\"material-icons\">pageview</i></a></td>"); 
}
elseif($opsi=='delete') {
		echo("<td class=\"cc\" align=\"center\"><a href=\"?".hash_pass('page')."=". $formSubmit."-Delete&Kode=".$Kode." &tabel=".$deleteTable." \" onclick=\"return confirm('Anda Yakin menghapus Data ? ')\"><i class=\"material-icons\">delete</i></a></td>
		");
}
else {
	echo("<td class=\"cc\" align=\"center\"><a href=\"?".hash_pass('page')."=".$formSubmit."&Kode=".$Kode." \" target=\"_self\"> <i class=\"material-icons\">info_outline</i> </a></td>");
}

	echo("</tr>");	
	}
	
	tabelBSBsingkronEND();
}

function tampilTabelCustomVerifikasi($koneksidb,$customQuery,$isian,$field,$formName,$formSubmit,$opsi,$jmlField){
	//$jmlField = count($isian);
	$nama1 = str_replace("_","-",$formName);
	tabelBSBsingkronBEGIN($formName,0,$jmlField,$isian);

	$mySql = $customQuery;
	$myQry = mysqli_query($koneksidb, $mySql)  or die ("Query salah dari tampilTabelCustomVerifikasi : ".mysqli_error($koneksidb)." Q: ".$mySql);
	$nomor  = 1; 

	$listFieldTanggal = getFieldTanggal($myQry);
	if (count($listFieldTanggal)==0)
		$end = 0;
	else
		$end=count($listFieldTanggal)-1;

	while ($kolomData = mysqli_fetch_array($myQry)) {

		$Kode = $kolomData[0];
		echo("<tr>");
		echo("<td align=\"center\">".$nomor++."</td>");
		$i=0;

		while($i<=$jmlField-1){
			$cont = $kolomData[$field[$i]];
			$ext = pathinfo($cont, PATHINFO_EXTENSION);

			if($ext=='pdf')
				$cont="<a href=\"?".hash_pass('page')."=File&Fo=".$kolomData['nidn']."&Fi=$cont \" ><i class=\"material-icons\">picture_as_pdf</i></a></td>";

			if($end>0){
			for($j=0;$j<=$end;$j++){
				if($field[$i]==$listFieldTanggal[$j])
					$cont = Indonesia2Tgl($kolomData[$field[$i]]);
			}
			}
			if($field[$i]=='status_verifikasi'){
				
				if($kolomData['status_verifikasi']==0) {
				$cont = "<span class=\"badge bg-pink\">Belum Diverifikasi</span>";
				$option = "<td class=\"cc\" align=\"center\"><a href=\"?".hash_pass('page')."=". $formSubmit."-Verify&Kode=".$Kode." \" ><i class=\"material-icons\">verified_user</i></a> <a href=\"?".hash_pass('page')."=". $formSubmit."-Delete&Kode=".$Kode." \" onclick=\"return confirm('Anda Yakin menghapus Data ? ')\"><i class=\"material-icons\">delete</i></a></td>"; }
				else  {
				$cont = "<span class=\"badge bg-teal\">Sudah Diverifikasi</span>";
			$option = "<td class=\"cc\" align=\"center\"><i class=\"material-icons\">verified_user</i> <a href=\"?".hash_pass('page')."=". $formSubmit."-Delete&Kode=".$Kode." \" onclick=\"return confirm('Anda Yakin menghapus Data ? ')\"><i class=\"material-icons\">delete</i></a></td>";
			}
			}
			if($field[$i]=="nidn"){
				$s = "select t_dosen.*,t_universitas.nama_universitas, t_prodi.nama_prodi,t_pengguna.avatar from t_dosen 
					  left join t_universitas on t_dosen.id_universitas = t_universitas.id
					  left join t_prodi on t_dosen.id_prodi = t_prodi.id
						LEFT JOIN t_pengguna ON t_pengguna.id=t_dosen.id_pengguna
					  where nidn='".$kolomData[$field[$i]]."'";
				$m = mysqli_query($koneksidb, $s)  or die ("Query salah dari tampilTabelNyanyuk : ".mysqli_error($koneksidb));
				$k = mysqli_fetch_array($m);
				$cont = "<div class=\"button-demo js-modal-buttons\"><button type=\"button\" data-color=\"blue\" class=\"btn bg-blue waves-effect\" 
								data-nidn=\"".$kolomData[$field[$i]]."\" 
								data-nama=\"".$k['gelar_depan']."".$k['nama_dosen'].",".$k['gelar_belakang']."\" 
								data-univ=\"".$k['nama_universitas']."\" 
								data-prodi=\"".$k['nama_prodi']."\" 
								data-avatar=\"".$k['avatar']."\" 
								data-toggle=\"modal\" >".$kolomData[$field[$i]]."</button></div>";
			}
				
			echo("<td> ".$cont." </td>");
			$i++;

		}
		echo("</td>");
		
if($opsi=='edit') {		
		echo("<td class=\"cc\" align=\"center\"><a href=\"?".hash_pass('page')."=".$formSubmit."&Kode=".$Kode." \" target=\"_self\"><i class=\"material-icons\">pageview</i></a></td>"); 
}
elseif($opsi=='delete') {
		echo("<td class=\"cc\" align=\"center\"><a href=\"?".hash_pass('page')."=". $formSubmit."-Delete&Kode=".$Kode." \" onclick=\"return confirm('Anda Yakin menghapus Data ? ')\"><i class=\"material-icons\">delete</i></a></td>");
}
elseif($opsi=='verify') {
		echo $option; 
}
else {
	echo("<td class=\"cc\" align=\"center\"><i class=\"material-icons\">info_outline</i></td>");
}

	echo("</tr>");	
	}
	
	tabelBSBsingkronEND();
}

// KOMBO tampilInputA DAN tampilInputB UNTUK MEMBUNGKUS FORM INPUT
function tampilInputA($formName){
	$nama1 = str_replace("_","-",$formName);
	$nama2 = str_replace("_"," ",$formName);
 
	echo("<form action=\"?".hash_pass('page')."=".$nama1."-Data\" method=\"post\" name=\"form1\" target=\"_self\"> \n");
	echo ('<div class="panel-group" id="accordion_1" role="tablist" aria-multiselectable="true"> ');
	echo ('	<div class="panel panel-col-light-blue"> ');
	echo ('		<div class="panel-heading" role="tab" id="headingOne_1"> ');
	echo ('			<h4 class="panel-title"> ');
	echo ('				<a role="button" data-toggle="collapse" data-parent="#accordion_1" href="#collapseOne_1" aria-expanded="false" aria-controls="collapseOne_1"> ');
	echo (' <i class="material-icons">launch</i>		Tambah Data '.$nama2);
	echo ('				</a> ');
	echo ('			</h4> ');	
	echo ('		</div> ');
	echo ('		<div id="collapseOne_1" class="panel-collapse collapse out" role="tabpanel" aria-labelledby="headingOne_1"> ');
	echo ('			<div class="panel-body"> ');
}

//custom tampil input untuk form yang berbeda
function tampilInputAcustom($formName,$newname,$collapse){
	$nama1 = str_replace("_","-",$formName);
	$nama2 = str_replace("_"," ",$formName);
 
	echo("<form action=\"?".hash_pass('page')."=".$newname."\" method=\"post\" name=\"form1\" target=\"_self\"> \n");
	echo ('<div class="panel-group" id="accordion_1" role="tablist" aria-multiselectable="true"> ');
	echo ('	<div class="panel panel-col-light-blue"> ');
	echo ('		<div class="panel-heading" role="tab" id="headingOne_1"> ');
	echo ('			<h4 class="panel-title"> ');
	echo ('				<a role="button" data-toggle="collapse" data-parent="#accordion_1" href="#collapseOne_1" aria-expanded="false" aria-controls="collapseOne_1"> ');
	echo (' <i class="material-icons">launch</i>		Tambah Data '.$nama2);
	echo ('				</a> ');
	echo ('			</h4> ');	
	echo ('		</div> ');
	echo ('		<div id="collapseOne_1" class="panel-collapse collapse '.$collapse.'" role="tabpanel" aria-labelledby="headingOne_1"> ');
	echo ('			<div class="panel-body"> ');
}

function tampilInputB(){
	echo ("<button type=\"submit\"  name=\"btnSave\" class=\"btn bg-green waves-effect\"><i class=\"material-icons\">save</i><span>Simpan</span></button>");
	echo ("<button type=\"reset\"   class=\"btn bg-orange waves-effect \" name=\"reset\" id=\"reset\" onclick=\"return confirm('Reset data yang telah anda ketik?')\"/><i class=\"material-icons\">undo</i><span>Reset</span></button>"); 
		echo ('			</div> ');
		echo ('		</div> ');
		echo ('	</div> ');
		echo ('</div> ');	
		echo("</form>"); 
	}

function tampilCetakB(){
	echo ("<button type=\"submit\"  name=\"btnSave\" class=\"btn bg-green waves-effect\"><i class=\"material-icons\">print</i><span>Cetak</span></button>");
	echo ("<button type=\"reset\"   class=\"btn bg-orange waves-effect \" name=\"reset\" id=\"reset\" onclick=\"return confirm('Reset data yang telah anda ketik?')\"/><i class=\"material-icons\">undo</i><span>Reset</span></button>"); 
		echo ('			</div> ');
		echo ('		</div> ');
		echo ('	</div> ');
		echo ('</div> ');	
		echo("</form>"); 
	}

// AKHIR KOMBO

// CUSTOM PADA FORM IDENTITAS PROJECT SINGKRON
function tampilInputA1($formName){
	echo("<form action=\"?".hash_pass('page')."=".$formName."\" method=\"post\" name=\"form1\" target=\"_self\" enctype=\"multipart/form-data\"> \n");
	echo ('<div class="panel-group" id="accordion_1" role="tablist" aria-multiselectable="true"> ');
	echo ('	<div class="panel panel-col-light-blue"> ');
	echo ('		<div class="panel-heading" role="tab" id="headingOne_1"> ');
	echo ('			<h4 class="panel-title"> ');
	echo ('				<a role="button" data-toggle="collapse" data-parent="#accordion_1" href="#collapseOne_1" aria-expanded="false" aria-controls="collapseOne_1"> ');
	echo (' <i class="material-icons">launch</i>FORM');
	echo ('				</a> ');
	echo ('			</h4> ');
	echo ('		</div> ');
	echo ('		<div id="collapseOne_1" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne_1"> ');
	echo ('			<div class="panel-body"> ');
}
// CUSTOM CETAK FUNGSIONAL DOSEN
function tampilCetakA1($formName){
	echo("<form action=\"./pages/laporan/laporan_jabfung-pdf.php?txt1=['txt1']&txt2=['txt2']&txt3=['txt3']\" method=\"get\" name=\"form1\" enctype=\"multipart/form-data\"  target=\"_blank\"> \n");
	echo ('<div class="panel-group" id="accordion_1" role="tablist" aria-multiselectable="true"> ');
	echo ('	<div class="panel panel-col-light-blue"> ');
	echo ('		<div class="panel-heading" role="tab" id="headingOne_1"> ');
	echo ('			<h4 class="panel-title"> ');
	echo ('				<a role="button" data-toggle="collapse" data-parent="#accordion_1" href="#collapseOne_1" aria-expanded="false" aria-controls="collapseOne_1"> ');
	echo (' <i class="material-icons">launch</i> '.$formName);
	echo ('				</a> ');
	echo ('			</h4> ');
	echo ('		</div> ');
	echo ('		<div id="collapseOne_1" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne_1"> ');
	echo ('			<div class="panel-body"> ');
}
// CUSTOM CETAK USULAN
function tampilCetakA2($formName){
	echo("<form action=\"./pages/laporan/laporan_usulan-pdf.php?txt1=['txt1']&txt2=['txt2']&txt3=['txt3']&txt4=['txt4']\" method=\"get\" name=\"form1\" enctype=\"multipart/form-data\"  target=\"_blank\"> \n");
	echo ('<div class="panel-group" id="accordion_1" role="tablist" aria-multiselectable="true"> ');
	echo ('	<div class="panel panel-col-light-blue"> ');
	echo ('		<div class="panel-heading" role="tab" id="headingOne_1"> ');
	echo ('			<h4 class="panel-title"> ');
	echo ('				<a role="button" data-toggle="collapse" data-parent="#accordion_1" href="#collapseOne_1" aria-expanded="false" aria-controls="collapseOne_1"> ');
	echo (' <i class="material-icons">launch</i> '.$formName);
	echo ('				</a> ');
	echo ('			</h4> ');
	echo ('		</div> ');
	echo ('		<div id="collapseOne_1" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne_1"> ');
	echo ('			<div class="panel-body"> ');
}

// KOMBO CUSTOM PADA USULAN-BARU
$collapse = 'out';
function tampilInputA2($formName,$Judul,$id,$collapse){
	echo("<form action=\"?".hash_pass('page')."=".$formName."\" method=\"post\" name=\"form1\" target=\"_self\" enctype=\"multipart/form-data\"> \n"); 
	echo ('	<div class="panel panel-col-light-blue"> ');
	echo ('		<div class="panel-heading" role="tab" id="headingOne_'.$id.'"> ');
	echo ('			<h4 class="panel-title"> ');
	echo ('				<a role="button" data-toggle="collapse" data-parent="#accordion_'.$id.'" href="#collapseOne_'.$id.'" aria-expanded="false" aria-controls="collapseOne_'.$id.'"> ');
	echo (' <i class="material-icons">library_add</i>		Data '.$Judul);
	echo ('				</a> ');
	echo ('			</h4> ');
	echo ('		</div> ');
	echo ('		<div id="collapseOne_'.$id.'" class="panel-collapse collapse '.$collapse.'" role="tabpanel" aria-labelledby="headingOne_'.$id.'"> ');
	echo ('			<div class="panel-body"> ');
}
// KOMBO CUSTOM 2 PADA USULAN-BARU
function tampilInputA3($formName,$Judul,$id){
	echo("<form action=\"?".hash_pass('page')."=".$formName."\" method=\"post\" name=\"form1\" target=\"_self\"> \n"); 
	echo ('	<div class="panel panel-col-light-blue"> ');
	echo ('		<div class="panel-heading" role="tab" id="headingOne_'.$id.'"> ');
	echo ('			<h4 class="panel-title"> ');
	echo ('				<a role="button" data-toggle="collapse" data-parent="#accordion_'.$id.'" href="#collapseOne_'.$id.'" aria-expanded="true" aria-controls="collapseOne_'.$id.'"> ');
	echo (' <i class="material-icons">library_books</i>		Data '.$Judul);
	echo ('				</a> ');
	echo ('			</h4> ');
	echo ('		</div> ');
	echo ('		<div id="collapseOne_'.$id.'" class="panel-collapse collapse out" role="tabpanel" aria-labelledby="headingOne_'.$id.'"> ');
	echo ('			<div class="panel-body"> ');
}

// CUSTOM PADA USULAN-BARU
function tampilInputB2($simpan){
echo ('<div class="col-md-12">');
echo ("<button type=\"submit\"  name=\"".$simpan."\" class=\"btn bg-green waves-effect\"><i class=\"material-icons\">save</i><span>Simpan</span></button>");
echo ("<button type=\"reset\"   class=\"btn bg-orange waves-effect \" name=\"reset\" id=\"reset\" onclick=\"return confirm('Reset data yang telah anda ketik?')\"/><i class=\"material-icons\">undo</i><span>Reset</span></button>");
	echo ('			</div> ');
	echo ('		</div> ');
	echo ('	</div> '); 
	echo ('</div> ');	
	echo("</form>"); 
}
// AKHIR KOMBO

// KOMBO tampilEditA DAN tampilEditB UNTUK MEMBUNGKUS FORM EDIT
function tampilEditA($formName){
	$nama1 = str_replace("_","-",$formName);
	$nama2 = str_replace("_"," ",$formName);
	echo("<form action=\"?".hash_pass('page')."=".$nama1."-Edit\" method=\"post\" name=\"form1\" target=\"_self\"> \n");
	echo ('<div class="panel-group" id="accordion_1" role="tablist" aria-multiselectable="true"> ');
	echo ('	<div class="panel panel-col-light-blue"> ');
	echo ('		<div class="panel-heading" role="tab" id="headingOne_1"> ');
	echo ('			<h4 class="panel-title"> ');
	echo ('				<a role="button" data-toggle="collapse" data-parent="#accordion_1" href="#collapseOne_1" aria-expanded="true" aria-controls="collapseOne_1"> ');
	echo ('					Ubah Data '.$nama2);
	echo ('				</a> ');
	echo ('			</h4> ');
	echo ('		</div> ');
	echo ('		<div id="collapseOne_1" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne_1"> ');
	echo ('			<div class="panel-body"> ');
}

function tampilEditB(){
echo ("<button type=\"submit\"  name=\"btnSave\" class=\"btn bg-green waves-effect\"><i class=\"material-icons\">save</i><span>Simpan</span></button>");
echo ("<button type=\"reset\"   class=\"btn bg-orange waves-effect \" name=\"reset\" id=\"reset\" onclick=\"return confirm('Reset data yang telah anda ketik?')\"/><i class=\"material-icons\">undo</i><span>Reset</span></button>");

	echo ('			</div> ');
	echo ('		</div> ');
	echo ('	</div> ');
	echo ('</div> ');	
	echo("</form>");
}
// AKHIR KOMBO

function buatInputText1($text,$i,$data){
	echo('<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-control-label"><div class="form-group form-float">');
	echo('	<div class="form-line">');
	echo("		<input name=\"txt".$i."\" id=\"txt".$i."\" type=\"text\" class=\"form-control\" value=\"".$data."\"   />  \n");
	echo('		<label class="form-label">'.$text.'</label>');
	echo('	</div>');
	echo('</div></div>');
} 

function buatInputText($text,$i,$data){
	echo('<label for="txt'.$i.'">'.$text.'</label>
			<div class="form-group">
				<div class="form-line">
					<input type="text" name="txt'.$i.'" id="txt'.$i.'" class="form-control" value="'.$data.'" placeholder="">
				</div>
			</div>');
}

function buatInputTextNIDN($text,$i,$data){
	echo('<label for="txt'.$i.'">'.$text.'</label>
			<div class="form-group">
				<div class="form-line">
					<input type="text" name="txt'.$i.'" id="txt'.$i.'" class="form-control" value="'.$data.'" placeholder=""   pattern="([0-9]).{9}" title="Sesuaikan Format NIDN Anda" required autofocus/>
				</div>
			</div>');
}

function buatInputRadio($text,$i,$arrayIsi,$data){
	echo('<label for="txt'.$i.'">'.$text.'</label>
			<div class="form-group">
				<div class="form-line demo-radio-button">');
				$status="";
				foreach ($arrayIsi as $isi){
					if($isi==$data)
						$status="checked";
					else $status="";
					echo '<input name="txt'.$i.'" type="radio" id="radio_'.$isi.'" value="'.$isi.'" class="radio-col-blue" '.$status.' />
						  <label for=\"'.$isi.'\">'.$isi.'</label>';
				}
	echo('</div>
	</div>');			
				
}

function buatInputEmail($text,$i,$data){
	echo('<label for="txt'.$i.'">'.$text.'</label>
			<div class="form-group">
				<div class="form-line">
					<input type="email" name="txt'.$i.'" id="txt'.$i.'" class="form-control" value="'.$data.'" placeholder="">
				</div>
			</div>');
}

function buatInputPass($text,$i,$data){
	echo('<label for="txt'.$i.'">'.$text.'</label>
			<div class="form-group">
				<div class="form-line">
					<input type="password" name="txt'.$i.'" id="txt'.$i.'" class="form-control" value="'.$data.'" placeholder="">
				</div>
			</div>');
}

function buatInputText2($text,$i,$data,$placeholder){
	divBSBsingkronBEGIN($i,$text);
	echo('<input type="text" name="txt'.$i.'" id="txt'.$i.'" class="form-control" value="'.$data.'" placeholder="'.$placeholder.'">');
	divBSBsingkronEND();
}

function buatInputTextArea2($text,$i,$data,$placeholder){
	divBSBsingkronBEGIN($i,$text);
	echo('<textarea name="txt'.$i.'" id="txt'.$i.'" class="form-control no-resize" rows="6"  required placeholder="'.$placeholder.'">'.$data.'</textarea>');
	divBSBsingkronEND();
}


function buatInputTanggal2($text,$i,$data){
	divBSBsingkronBEGIN($i,$text);
	echo('	<input name="txt'.$i.'"  id="txt'.$i.'" type="date" class="form-control date" value="'.$data.'" placeholder="Pilih Tanggal..">');
	divBSBsingkronEND();
}

function buatInputSelectManual2($text,$i,$data,$arrayIsi){
	divBSBsingkronBEGIN($i,$text);
	echo ('<select class="form-control show-tick" data-live-search="true" name="txt'.$i.'" required> 
				<option value="">-- Pilih '.$text.' --</option> ');
				$jmlField=count($arrayIsi);
				for($i=0;$i<=$jmlField-1;$i++){
					if ($data == $arrayIsi[$i]) {
						$cek = "selected";
					} else { $cek=""; }		
					echo "<option value='$arrayIsi[$i]' $cek>$arrayIsi[$i]</option>";
				}	
	echo('</select>');
	divBSBsingkronEND();
}
function buatInputSelectManual3($text,$i,$data,$arrayIsi){
	 
	echo ('<label for="txt'.$i.'">'.$text.'</label>
	<select class="form-control show-tick" data-live-search="true" name="txt'.$i.'" required>   ');
				$jmlField=count($arrayIsi);
				for($i=0;$i<=$jmlField-1;$i++){
					if ($data == $arrayIsi[$i]) {
						$cek = "selected";
					} else { $cek=""; }		
	echo "<option value='$arrayIsi[$i]' $cek>$arrayIsi[$i]</option>";
			}	
	echo('</select>'); 
}

function buatInputSelect2($text,$i,$data,$koneksidb,$namaTable,$orderby){
	divBSBsingkronBEGIN($i,$text);
	echo('<select class="form-control show-tick" data-live-search="true" name="txt'.$i.'" required> 
			<option value="">-- Pilih '.$text.' --</option> ');
			$mySql = "SELECT * FROM ".$namaTable." ORDER BY ".$orderby." ASC";										
			$myQry = mysqli_query($koneksidb, $mySql) or die ("Gagal Query Select  ".$mySql);										
			while ($kolomData1 = mysqli_fetch_array($myQry)) {
				if ($data == $kolomData1['id']) {
					$cek = "selected";
				} else { $cek=""; }											
			echo "<option value='$kolomData1[id]' $cek>$kolomData1[$orderby] </option>";
			}
	echo('</select>');
	divBSBsingkronEND();
} 


function buatInputNumber2($text,$i,$data,$placeholder){
	divBSBsingkronBEGIN($i,$text);
	echo('<input type="number" name="txt'.$i.'" id="txt'.$i.'" class="form-control" value="'.$data.'" placeholder="'.$placeholder.'">');
	divBSBsingkronEND();
}

function buatInputNumber3($text,$i,$data,$placeholder){
	divBSBsingkronBEGIN($i,$text);
	echo ('<input type="number" name="txt'.$i.'" id="txt'.$i.'" class="form-control" value="'.$data.'" placeholder="'.$placeholder.'" step="0.01" min = "0" >');
	divBSBsingkronEND();
}


function buatInputFile2($text,$i,$data){
	divBSBsingkronBEGIN($i,$text);
	echo('<input type="file" name="txt'.$i.'" id="txt'.$i.'" class="form-control" value="'.$data.'" placeholder="" >');
	divBSBsingkronEND();
} 

function buatInputFileImage($text,$i,$data){
	echo('
	<div class="col-md-6">
	<label for="txt'.$i.'">'.$text.'</label>
	<div class="form-group">
		<div class="form-line ">
			<input type="file" name="txt'.$i.'"  accept="image/*" id="txt'.$i.'" class="form-control" value="'.$data.'" placeholder="">
		</div>
	</div>
	</div>
	');
} 

function buatInputFile($text,$i,$data){
	echo('<label for="txt'.$i.'">'.$text.'</label>
	<div class="form-group">
		<div class="form-line">
			<input type="file" name="txt'.$i.'" id="txt'.$i.'" class="form-control" value="'.$data.'" placeholder="">
		</div>
	</div>');
} 

function buatInputSelect($text,$i,$data,$koneksidb,$namaTable,$orderby){
	echo('<label for="txt'.$i.'">'.$text.'</label>
	<div class="form-group">
	<div class="form-line">
		<select class="form-control show-tick" data-live-search="true" name="txt'.$i.'"> 
		<option value="">-- Pilih '.$text.' --</option> ');
	
	$mySql = "SELECT * FROM ".$namaTable." ORDER BY ".$orderby." ASC";										
	$myQry = mysqli_query($koneksidb, $mySql) or die ("Gagal Query Select  ".$mySql);										
	while ($kolomData1 = mysqli_fetch_array($myQry)) {
		if ($data == $kolomData1['id']) {
			$cek = "selected";
		} else { $cek=""; }											
	echo "<option value='$kolomData1[id]' $cek>$kolomData1[$orderby] </option>";
	}
	echo("		</select></div></div>");
} 

// fungsi ini diolah gara2 salah merelasi di prodi dan universitas
function buatInputSelectId($text,$i,$data,$koneksidb,$namaTable,$orderby,$id){
	echo('<label for="txt'.$i.'">'.$text.'</label>
	<div class="form-group">
	<div class="form-line">
		<select class="form-control show-tick" data-live-search="true" name="txt'.$i.'"> 
		<option value="">-- Pilih '.$text.' --</option> ');
	
	$mySql = "SELECT * FROM ".$namaTable." ORDER BY ".$orderby." ASC";										
	$myQry = mysqli_query($koneksidb, $mySql) or die ("Gagal Query Select  ".$mySql);										
	while ($kolomData1 = mysqli_fetch_array($myQry)) {
		if ($data == $kolomData1[$id]) {
			$cek = "selected";
		} else { $cek=""; }											
	echo "<option value='$kolomData1[$id]' $cek>$kolomData1[$id] - $kolomData1[$orderby] </option>";
	}
	echo("		</select></div></div>");
} 

// fungsi ini diolah gara2 salah merelasi jua di prodi dan universitas
function buatInputSelectIdId($text,$i,$data,$koneksidb,$namaTable,$orderby,$id){
	echo('<label for="txt'.$i.'">'.$text.'</label>
	<div class="form-group">
	<div class="form-line">
		<select class="form-control show-tick" data-live-search="true" name="txt'.$i.'" required> 
		<option value="">-- Pilih '.$text.' --</option> ');
	
	$mySql = "SELECT * FROM ".$namaTable." ORDER BY ".$orderby." ASC";										
	$myQry = mysqli_query($koneksidb, $mySql) or die ("Gagal Query Select  ".$mySql);										
	while ($kolomData1 = mysqli_fetch_array($myQry)) {
		if ($data == $kolomData1[0]) {
			$cek = "selected";
		} else { $cek=""; }											
	echo "<option value='$kolomData1[0]' $cek>$kolomData1[$id] - $kolomData1[$orderby] </option>";
	}
	echo("		</select></div></div>");
} 

// fungsi ini diolah gara2 salah merelasi jua di prodi dan universitas
function buatInputSelectIdId2($text,$i,$data,$koneksidb,$namaTable,$orderby,$id){
	echo('<label for="txt'.$i.'">'.$text.'</label>
	<div class="form-group">
	<div class="form-line">
		<select class="form-control show-tick" data-live-search="true" name="txt'.$i.'" required> 
		<option value="Semua">-- Semua --</option> ');
	
	$mySql = "SELECT * FROM ".$namaTable." ORDER BY ".$orderby." ASC";										
	$myQry = mysqli_query($koneksidb, $mySql) or die ("Gagal Query Select  ".$mySql);										
	while ($kolomData1 = mysqli_fetch_array($myQry)) {
		if ($data == $kolomData1[0]) {
			$cek = "selected";
		} else { $cek=""; }											
	echo "<option value='$kolomData1[0]' $cek>$kolomData1[$id] - $kolomData1[$orderby] </option>";
	}
	echo("		</select></div></div>");
} 

//fungsi ini selain gara2 salah meolah relasi supaya membedakan jua jenjang contoh Ilmu Komunikasi, mun itu ja kada jelas S1 atau S2
function buatInputSelect2FIelds($text,$i,$data,$koneksidb,$namaTable,$orderby,$id,$field2nd){
	echo('<label for="txt'.$i.'">'.$text.'</label>
	<div class="form-group">
	<div class="form-line">
		<select class="form-control show-tick" data-live-search="true" name="txt'.$i.'"> 
		<option value="">-- Pilih '.$text.' --</option> ');
	
	$mySql = "SELECT * FROM ".$namaTable." ORDER BY ".$orderby." ASC";										
	$myQry = mysqli_query($koneksidb, $mySql) or die ("Gagal Query Select  ".$mySql);										
	while ($kolomData1 = mysqli_fetch_array($myQry)) {
		if ($data == $kolomData1[$id]) {
			$cek = "selected";
		} else { $cek=""; }											
	echo "<option value='$kolomData1[$id]' $cek>$kolomData1[$id] - $kolomData1[$orderby] - $kolomData1[$field2nd] </option>";
	}
	echo("		</select></div></div>");
} 

function buatInputSelect2FIeldsId($text,$i,$data,$koneksidb,$namaTable,$orderby,$id,$field2nd){
	echo('<label for="txt'.$i.'">'.$text.'</label>
	<div class="form-group">
	<div class="form-line">
		<select class="form-control show-tick" data-live-search="true" name="txt'.$i.'" required> 
		<option value="">-- Pilih '.$text.' --</option> ');
	
	$mySql = "SELECT * FROM ".$namaTable." ORDER BY ".$orderby." ASC";										
	$myQry = mysqli_query($koneksidb, $mySql) or die ("Gagal Query Select  ".$mySql);										
	while ($kolomData1 = mysqli_fetch_array($myQry)) {
		if ($data == $kolomData1[0]) {
			$cek = "selected";
		} else { $cek=""; }											
	echo "<option value='$kolomData1[0]' $cek>$kolomData1[$id] - $kolomData1[$orderby] - $kolomData1[$field2nd] </option>";
	}
	echo("		</select></div></div>");
} 

function buatInputSelectManual($text,$i,$data,$arrayIsi){
	echo('<label for="txt'.$i.'">'.$text.'</label>
			<div class="form-group">
			<div class="form-line">
				<select class="form-control show-tick" data-live-search="true" name="txt'.$i.'" required> 
				<option value="">-- Pilih '.$text.' --</option> ');
				$jmlField=count($arrayIsi);
				for($i=0;$i<=$jmlField-1;$i++){
					if ($data == $arrayIsi[$i]) {
						$cek = "selected";
					} else { $cek=""; }		
					echo "<option value='$arrayIsi[$i]' $cek>$arrayIsi[$i]</option>";
				}	
	echo("		</select></div></div>");
} 

function buatInputTanggal($text,$i,$data){
	echo('<label for="txt'.$i.'">'.$text.'</label>
	<div class="form-group">
		<div class="form-line">
			<input type="date" name="txt'.$i.'" id="txt'.$i.'" class="form-control" value="'.$data.'" placeholder="">
		</div>
	</div>');
}


function buatHiddenText($data,$i){
	echo(' <input type="hidden" name="txt'.$i.'" id="txt'.$i.'" class="form-control" value="'.$data.'" > ');
}

function buatLog($user, $activity, $data){
	$ippengguna=$_SERVER['REMOTE_ADDR'];
	$line="[".date("h:i:sa")."][".$user."][".$ippengguna."][".$activity."][".$data."]". PHP_EOL;
	//Save string to log, use FILE_APPEND to append.
	file_put_contents('logs/log_'.date("d.m.Y").'.txt', $line, FILE_APPEND);
}

function editBukafile($folderOutput, $namaForm){
	$source="pages/buka_file.php";
	$target="pages/buka_file_backup.php";
	// copy operation
	$ada = false;
	$namaFile = strtolower($namaForm);
	$nama1 = str_replace("_","-",$namaForm);
	$sh=fopen($source, "r");
	$th=fopen($target, "w");
	while (!feof($sh)) {
		$line=fgets($sh);
		if (strpos($line,$nama1."-Data")!==false){
			$ada=true;
		}
		if (strpos($line, '#MARKER')!==false && $ada==false) {
			$line=" 
			case '".$nama1."-Data' :			
			if(!file_exists ('".$folderOutput."/".$namaFile."_data.php')) die (\$nopage); 
			include '".$folderOutput."/".$namaFile."_data.php'; break;\n  
			case '".$nama1."-Edit' :		
			if(!file_exists ('".$folderOutput."/".$namaFile."_edit.php')) die (\$nopage);  
			include '".$folderOutput."/".$namaFile."_edit.php'; break;\n  
			case '".$nama1."-Delete' :			
			if(!file_exists ('".$folderOutput."/".$namaFile."_delete.php')) die (\$nopage); 
			include '".$folderOutput."/".$namaFile."_delete.php'; break;\n  						
			#MARKER \n
			" . PHP_EOL;
					}
		
		fwrite($th, $line);
	}
	fclose($sh);
	fclose($th);
	// delete old source file
	unlink($source);
	// rename target file to source file
	rename($target, $source);
}

function buatMenu($namaForm){
	$source="partials/leftbar_admin.php";
	$target="partials/leftbar_admin_backup.php";
	$ada = false;
	$sh=fopen($source, "r");
	$th=fopen($target, "w");
	$nama1 = str_replace("_","-",$namaForm);
	$nama2 = str_replace("_"," ",$namaForm);
	$ippengguna=$_SERVER['REMOTE_ADDR'];
	while (!feof($sh)) {
		$line=fgets($sh);
		if (strpos($line,$nama1."-Data")!==false){
			$ada=true;
		}
		if (strpos($line, '<!-- MARKER -->')!==false && $ada == false) {
		 $line="<li><a href=\"?<?php echo hash_pass('page');?>=".$nama1."-Data\">".$nama2."</a></li>
		 <!-- MARKER -->". PHP_EOL;
		}
		fwrite($th, $line);
	}

	fclose($sh);
	fclose($th);
	// delete old source file
	unlink($source);
	// rename target file to source file
	rename($target, $source);
}

function divBSBsingkronBEGIN($i,$text){
echo('
<div class="col-md-6">
<p for="txt'.$i.'">'.$text.'</p>
	<div class="form-group">
		<div class="form-line">');
}

function divBSBsingkronEND(){
	echo('</div></div></div>');
}

function tabelBSBsingkronBEGIN($formName,$start,$jmlField,$isian){
	echo('<div class="row clearfix"> ');
	echo('<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"> ');
	echo('<div class="card"> ');
	$formName = str_replace("temp_","",$formName);
	echo('<div class="header"> <h2>Data '.$formName.'  </h2> ');
	echo('</div> ');
	echo('<div class="body"> ');
	echo('<div class="table-responsive"> ');
	echo('<table class="table table-bordered table-striped table-hover js-basic-example dataTable"> ');
	echo('	<thead>');
	echo('		<tr>');
	echo('			<th width ="10px">No</th>');
for($i=$start;$i<=$jmlField-1;$i++){
	echo('			<th>'.$isian[$i].'</th> ');
}
	echo('			<th width ="20px">Action</th>');
	echo('		</tr>');
	echo('	</thead>');
	echo('	<tfoot>');
	echo('		<tr>');
	echo('			<th width ="10px">No</th>');
for($i=$start;$i<=$jmlField-1;$i++){
	echo('			<th>'.$isian[$i].'</th> ');
}
	echo('			<th width ="20px">Action</th>');
	echo('		</tr>');
	echo('	</tfoot>');
	echo('	<tbody>');
}
	
function tabelBSBsingkronEND(){
	echo('</tbody>');
	echo('</table>');
	echo('</div>');
	echo('</div>');
	echo('</div>');
	echo('</div>');
	echo('</div>');
}

function getFieldTanggal($myQry){
	$j=0;
	$out='';
	while ($finfo = $myQry->fetch_field()) {
		if($finfo->type==10){
			$out[$j]=$finfo->name;
			$j++;
		}			
	}
	return $out;
	//$end=$j-1;
}

function getFieldDateTime($myQry){
	$j=0;
	$out='';
	while ($finfo = $myQry->fetch_field()) {
		if($finfo->type==12){
			$out[$j]=$finfo->name;
			$j++;
		}			
	}
	return $out;
	//$end=$j-1;
}

// FRAMEWORK BAHARI
function isiTabel($nomor,$kolom,$field){
	echo("<tr>");
	echo("<td aligh=\"center\">".$nomor++."</td>");
	$i=1;
	while($i<=count($field)-1){
		echo("<td> ".$kolom[$field[$i]]." </td>");
		$i++;
	}
	echo("</td>");	
}

function buatTombol($formName,$Kode,$kolom){
echo("<td class=\"cc\" align=\"center\"><a href=\"?page=".$formName."-Edit&Kode=".$Kode." \" target=\"_self\"><i class=\"icon-edit\"></i></a></td>");
echo("<td class=\"cc\" align=\"center\"><a href=\"?page=". $formName."-Delete&Kode=".$Kode." \" onclick=\"return confirm('Anda Yakin menghapus Data ".$formName." dengan Nama ".$kolom."? ')\"><i class=\"icon-trash\"></i></a></td>");
}

function cekPDF($cont,$NIDN){
	$ext = pathinfo($cont, PATHINFO_EXTENSION);
	if($ext=='pdf')
		return "<a href=\"?".hash_pass('page')."=File&Fo=".$NIDN."&Fi=$cont \" target=\"_blank\">Lihat Lampiran<i class=\"material-icons\">picture_as_pdf</i></a>";
	else
		return $cont;
}

function encD($f1){
    return base64_encode(base64_encode(base64_encode(base64_encode($f1))));
 }

 function decD($f1){
    return base64_decode(base64_decode(base64_decode(base64_decode($f1))));
 }

?>