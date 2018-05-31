<?php

function getTotalNilai($bagian,$koneksidb,$Kode,$palui){
    if($bagian=="pendidikan"){
        $tbl2="t_".$bagian."_pengajaran" ;
        $tbl3 = array("t_det_pelatihan","t_det_pendidikan");
    }
    else if($bagian=="pengajaran"){
        $bagian="pendidikan";
        $tbl2="t_pendidikan_pengajaran" ;
        $tbl3 = array("t_det_detasering","t_det_membimbing","t_det_mengembangkan_bajar",
                      "t_det_mengembangkan_progkul","t_det_menjabat","t_det_orasi",
                      "t_det_pembimbing_akademik","t_det_pembimbing_dosen","t_det_membimbing_seminar",
                      "t_det_pembimbing_kknpkl","t_det_pengajaran","t_det_penguji");
                      
    }else{
        $tbl2="t_".$bagian;
        $tbl3=array("t_det_".$bagian);
    }
        $jml=0;
        foreach($tbl3 as $value){
            $q = "SELECT $tbl2.id, sum($value.$palui) as jml
                    FROM $tbl2 
                    INNER JOIN $value ON $value.id_$bagian = $tbl2.id
                    WHERE $tbl2.id_usulan =".$Kode; 
            $s = mysqli_query($koneksidb, $q)  or die ("Query ambil data salah : ".mysqli_error($koneksidb));
            $t = mysqli_fetch_array($s); 
            $jml=$jml+$t['jml'];
             
        }   
        return $jml;   
}

function getIdPendidikan($koneksidb,$idusulan){
    $ada = cekAda($koneksidb,'t_pendidikan_pengajaran','id_usulan','id_usulan',$idusulan); 
    if(!$ada) {  
    $sqlCheck = "INSERT INTO `t_pendidikan_pengajaran`(`id_usulan`, `total_nilai_usulan`, `total_nilai_tim`) VALUES ('".$idusulan."',0,0)";
    $qryCheck = mysqli_query($koneksidb, $sqlCheck)  or die ("Query Nambah pendidikan pengajaran kada beres : ".mysqli_error($koneksidb));		 
    }
    $pageSql = "SELECT * FROM t_pendidikan_pengajaran WHERE id_usulan='".$idusulan."' "; 
    $qryShow = mysqli_query($koneksidb, $pageSql)  or die ("Query ambil data salah : ".mysqli_error($koneksidb));
    $dataQry = mysqli_fetch_array($qryShow);
    return $dataQry['id'];
}

function getNilaiPendidikan($koneksidb,$idusulan){
    $pageSql = "SELECT * FROM t_pendidikan_pengajaran WHERE id_usulan='".$idusulan."' "; 
    $qryShow = mysqli_query($koneksidb, $pageSql)  or die ("Query ambil data salah : ".mysqli_error($koneksidb));
    $dataQry = mysqli_fetch_array($qryShow);
    return $dataQry['total_nilai_usulan'];
}

function getPanggol($koneksidb,$iddosen){
    $pageSql = "SELECT * FROM t_riwayat_kepangkatan WHERE id_kepegawaian='".$iddosen."' AND status_verifikasi=1 "; 
    $qryShow = mysqli_query($koneksidb, $pageSql)  or die ("Query ambil data salah : ".mysqli_error($koneksidb));
    $dataQry = mysqli_fetch_array($qryShow);
    $panggol =  $dataQry['panggol'];
    if($panggol=='')
        return '-';
    else
        return $panggol;
}

function hit_usulan($koneksidb,$tableDetail,$tableMum,$tot,$id){
    $pageSql = " SELECT SUM(".$tableDetail.".nilai_usulan) AS ".$tot." FROM ".$tableDetail." LEFT JOIN ".$tableMum." ON ".$tableMum.".id=".$tableDetail.".id_pendidikan WHERE id_usulan=".$id." "; 
    $qryShow = mysqli_query($koneksidb, $pageSql)  or die ("Query ambil data salah : ".mysqli_error($koneksidb));
    $jmQry = mysqli_fetch_array($qryShow);
    // $id_dikjar = $jmQry[$tot];

    return  $jmQry[$tot];
}

function nilaiPendidikan($Kode,$koneksidb,$pendidikan){
    $sqlA = " SELECT * FROM t_det_pendidikan 
    LEFT JOIN t_pendidikan_pengajaran ON t_pendidikan_pengajaran.id=t_det_pendidikan.id_pendidikan 
    WHERE id_usulan=".$Kode." AND Kegiatan_pendidikan = '$pendidikan'"; 
    $qryShow = mysqli_query($koneksidb, $sqlA)  or die ("Query ambil data salah : ".mysqli_error($koneksidb));
    $dataA = mysqli_fetch_array($qryShow);
     return $dataA['nilai_usulan'];
}   

function nilai($Kode,$koneksidb,$tmas,$tdet,$idmas){
    $sqlA = " SELECT sum(nilai_usulan) AS nilai,$tmas.id_usulan FROM $tdet 
    LEFT JOIN $tmas ON $tmas.id=$tdet.$idmas 
    GROUP BY $tdet.$idmas
    HAVING id_usulan=".$Kode; 
    $qryShow = mysqli_query($koneksidb, $sqlA)  or die ("Query ambil data salah : ".mysqli_error($koneksidb));
    $dataA = mysqli_fetch_array($qryShow);
     return $dataA['nilai'];
}

function nilaiMKategori($Kode,$koneksidb,$tmas,$tdet,$tkat,$idmas,$idmk,$isiidmk){
    $sqlA = " SELECT sum(nilai_usulan) AS nilai,$tmas.id_usulan, $tkat.$idmk  FROM $tdet 
    LEFT JOIN $tmas ON $tmas.id=$tdet.$idmas 
    LEFT JOIN $tkat ON $tdet.idkategori=$tkat.id
    GROUP BY $tdet.$idmas
    HAVING id_usulan=".$Kode." AND $idmk=".$isiidmk; 
    $qryShow = mysqli_query($koneksidb, $sqlA)  or die ("Query ambil data salah : ".mysqli_error($koneksidb));
    $dataA = mysqli_fetch_array($qryShow);
     return $dataA['nilai'];
}

function nilaiPer($Kode,$koneksidb,$tmas,$tdet,$idmas,$prevId){
    if(is_numeric($prevId)){
       $sqlA = " SELECT $tdet.nilai_usulan AS nilai,$tmas.id_usulan,$tdet.id FROM $tdet 
        LEFT JOIN $tmas ON $tmas.id=$tdet.$idmas 
        WHERE id_usulan=".$Kode." AND $tdet.id > $prevId"; 
        $qryShow = mysqli_query($koneksidb, $sqlA)  or die ("Query ambil data salah : ".mysqli_error($koneksidb));
        if (mysqli_num_rows($qryShow)>0){
            $dataA = mysqli_fetch_array($qryShow);
            if($dataA)
            $a = array($dataA['nilai'],$dataA['id'],$sqlA);
            return $a;
        }
        else{
            $a = array("","ZONK","ZONK2");
            return $a;
        }
    }else{
        $a = array("","ZONK","ZONK2");
        return $a; 
   }
}

//function getPrevId

function cekFileUkuran($txtFile){
    $imageSize = $_FILES[$txtFile]['size'];
	if($imageSize >10000000) {  
		return "Maaf, File Yang anda Upload  <b> lebih dari 10 mb </b>";	 
    }  
    else return "";
}
function cekFileUkuran2mb($txtFile){
    $imageSize = $_FILES[$txtFile]['size'];
	if($imageSize >2000000) {  
		return "Maaf, File Yang anda Upload  <b> lebih dari 2 mb </b>";	 
    }  
    else return "";
}

function cekFileTipe($txtFile,$tipeFile){
    $imageFileType = strtolower(pathinfo($_FILES[$txtFile]['name'],PATHINFO_EXTENSION));
    if($imageFileType!=$tipeFile) {  
        return "Maaf, File Yang anda Upload  bukan tipe <b> $tipeFile </b>";	 
    }  
    else return "";
} 

function cekKosongSemua($jmlField,$txt,$isian){
    $hasilArray = array();
    for($i=4;$i<=$jmlField;$i++){ 
        if (trim($txt[$i])=="") { 
            $hasilArray = "Data <b>".$isian[$i]."</b> tidak boleh kosong !"; 
        } 
    }
    return $hasilArray;
} 

function tampilkanPesanError($pesanError){
    $noPesan=0; 
			foreach ($pesanError as $value) {  
				$noPesan++;  
				echo '
 				<div class="alert alert-warning alert-dismissible" role="alert"> 
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button> 
				<h4 class="alert-heading">Error!</h4>'.$noPesan.'. '.$value.'</div><br>';	 
			}  
			echo " <br>";  
}

function uploadFile($txtFile,$nidn,$idPendidikan,$tipeFile){
    $tmpFilePath = $_FILES[$txtFile]['tmp_name'];
    if($tmpFilePath != ""){
        $directoryName = './Uploads/'.$nidn.'/';
        if(!is_dir($directoryName)){
            mkdir($directoryName, 0755, True);
        }				
        $filePath = $directoryName.'/'.date('Ymd-His').'-'.$nidn."-pendidikan-".$idPendidikan.".".$tipeFile;
        move_uploaded_file($tmpFilePath, $filePath);
        return date('Ymd-His').'-'.$nidn."-pendidikan-".$idPendidikan.".".$tipeFile;             
    } 
}

function uploadFile2($txtFile,$nidn,$idPendidikan,$tipeFile){
    $tmpFilePath = $_FILES[$txtFile]['tmp_name'];
    if($tmpFilePath != ""){
        $directoryName = './Uploads/'.$nidn.'/';
        if(!is_dir($directoryName)){
            mkdir($directoryName, 0755, True);
        }				
        $filePath = $directoryName.'/'.date('Ymd-His').'-'.$nidn."-".$idPendidikan.".".$tipeFile;
        move_uploaded_file($tmpFilePath, $filePath);
        return date('Ymd-His').'-'.$nidn."-".$idPendidikan.".".$tipeFile;             
    } 
}
function uploadAvatar1($txtFile,$nidn,$idPendidikan,$tipeFile){
    $tmpFilePath = $_FILES[$txtFile]['tmp_name'];
    if($tmpFilePath != ""){
        $directoryName = './Uploads/'.$nidn.'/';
        if(!is_dir($directoryName)){
            mkdir($directoryName, 0755, True);
        }				
        $filePath = $directoryName.'/'.$nidn."-".$idPendidikan.".".$tipeFile;
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

        return $nidn."-".$idPendidikan.".".$tipeFile;             
    } 
}

function cekJabungAda($koneksidb,$jabung,$id_dosen){
        $sqlShow = "SELECT jabakademik FROM t_riwayat_jabakademin 
                        WHERE id_dosen =$id_dosen
                        AND jabakademik='$jabung'";
        $qryShow = mysqli_query($koneksidb, $sqlShow)  or die ("Query fun cekJabung salah : ".mysqli_error($koneksidb));
        $jml = mysqli_num_rows($qryShow);
        if($jml>0){
           return "Data $jabung sudah ada";
        }else{
            return false;
        }
    
}

function cekTanggalLewat($tanggal,$item){
    if($tanggal>date('Y-m-d'))
        return "<b>$item</b> Tidak Valid"; 
    else
        return false;
}

function cekTanggalLuarPeriode($koneksidb,$idusulan,$tanggal,$item){
    $sql = "SELECT tanggal_penilaian_1, tanggal_penilaian_2 FROM t_usulan
            WHERE id=$idusulan";
    $result = mysqli_query($koneksidb,$sql)  or die ("Query fun cek tanggal salah : ".mysqli_error($koneksidb));
    $data = mysqli_fetch_array($result);

    if($tanggal<$data['tanggal_penilaian_1'] || $tanggal>$data['tanggal_penilaian_2'])
        return "<b>$item</b> Harus dalam Periode Penilaian di antara ".Indonesia2Tgl($data['tanggal_penilaian_1']).
                " dan ".Indonesia2Tgl($data['tanggal_penilaian_2']) ; 
    else
        return false;
}

function ifadaPDF($param){
    $cont = $param;
    $NIDN = $_SESSION['BONCLINK_M4SUK'];
    $ext = pathinfo($cont, PATHINFO_EXTENSION);
    if($ext=='pdf')
        $cont="<a href=\"?".hash_pass('page')."=File&Fo=".$NIDN."&Fi=$cont \" target=\"_blank\" ><i class=\"material-icons\">picture_as_pdf</i></a>";
    return $cont;
}

?>