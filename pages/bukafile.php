<?php 
$nopage = "<meta http-equiv='refresh' content='0; url=page_404.html'> ";
    if($_GET) {
        switch ($_GET['page']){				
            case '' :				
                if(!file_exists ('pages/admin/touchdown.php')) die ($nopage); 
                include 'pages/admin/touchdown.php';	break;		
            
            case 'Home' :				
                if(!file_exists ('pages/admin/touchdown.php')) die ($nopage); 
                include 'pages/admin/touchdown.php';	break;	
            
            case 'Info' :				
                if(!file_exists ('pages/info.php')) die ($nopage); 
                include 'pages/info.php';	break;	

            case 'Generator' :				
                if(!file_exists ('pages/admin/generator.php')) die ($nopage); 
                include 'pages/admin/generator.php';	break;	

            case 'Logout' :
                if(!file_exists ('accounts/logout.php')) die ($nopage); 
                include 'accounts/logout.php';	break;	
        
            case 'Delete' :
                if(!file_exists ('pages/generated/delete_any.php')) die ($nopage); 
                include 'pages/generated/delete_any.php';	break;	
        

            //::MASTER DATA BEGIN
            case 'Pengguna-Baru' :				
                if(!file_exists ('pages/admin/pengguna_baru.php')) die ($nopage); 
                include 'pages/admin/pengguna_baru.php';	break;	
            
            case 'Pengguna-Data' :				
                if(!file_exists ('pages/admin/pengguna_data.php')) die ($nopage); 
                include 'pages/admin/pengguna_data.php';	break;	
        
            case 'Pengguna-Ubah' :				
                if(!file_exists ('pages/admin/pengguna_ubah.php')) die ($nopage); 
                include 'pages/admin/pengguna_ubah.php';	break;	
    

            case 'Kategori-Baru' :				
                if(!file_exists ('pages/admin/kategori_baru.php')) die ($nopage); 
                include 'pages/admin/kategori_baru.php';	break;	
            
            case 'Kategori-Data' :				
                if(!file_exists ('pages/admin/kategori_data.php')) die ($nopage); 
                include 'pages/admin/kategori_data.php';	break;	
        
            case 'Kategori-Ubah' :				
                if(!file_exists ('pages/admin/kategori_ubah.php')) die ($nopage); 
                include 'pages/admin/kategori_ubah.php';	break;	
    
            case 'Instrumen-Baru' :				
                if(!file_exists ('pages/admin/instrumen_baru.php')) die ($nopage); 
                include 'pages/admin/instrumen_baru.php';	break;	
            
            case 'Instrumen-Data' :				
                if(!file_exists ('pages/admin/instrumen_data.php')) die ($nopage); 
                include 'pages/admin/instrumen_data.php';	break;	
        
            case 'Instrumen-Ubah' :				
                if(!file_exists ('pages/admin/instrumen_ubah.php')) die ($nopage); 
                include 'pages/admin/instrumen_ubah.php';	break;	
    
            
           
            
            //MASTER USER BIDANG
        
            case 'Anak-Baru' :				
                if(!file_exists ('pages/asesor/anak_baru.php')) die ($nopage); 
                include 'pages/asesor/anak_baru.php';	break;	
            
            case 'Anak-Data' :				
                if(!file_exists ('pages/asesor/anak_data.php')) die ($nopage); 
                include 'pages/asesor/anak_data.php';	break;	
        
            case 'Anak-Ubah' :				
                if(!file_exists ('pages/asesor/anak_ubah.php')) die ($nopage); 
                include 'pages/asesor/anak_ubah.php';	break;	
    
          
            //::MASTER DATA END

            //::PROSES DATA BEGIN

            case 'Asesmen-Anak' :				
                if(!file_exists ('pages/asesor/input_data_anak.php')) die ($nopage); 
                include 'pages/asesor/input_data_anak.php';	break;	
            
            case 'Asesmen-Instrumen' :				
                if(!file_exists ('pages/asesor/input_data_asesmen.php')) die ($nopage); 
                include 'pages/asesor/input_data_asesmen.php';	break;	

            case 'Lihat-Siswa' :				
                if(!file_exists ('pages/asesor/lihat_data_siswa.php')) die ($nopage); 
                include 'pages/asesor/lihat_data_siswa.php';	break;	
            //::PROSES DATA END

            //::ETC BEGIN
            case 'Pilih-Kategori' :				
                if(!file_exists ('pages/admin/pilih_kategori.php')) die ($nopage); 
                include 'pages/admin/pilih_kategori.php';	break;
            
            case 'Pilih-Kategori-Asesmen' :				
                if(!file_exists ('pages/asesor/pilih_kategori_asesmen.php')) die ($nopage); 
                include 'pages/asesor/pilih_kategori_asesmen.php';	break;
            
            case 'Pilih-Anak' :				
                if(!file_exists ('pages/asesor/pilih_anak.php')) die ($nopage); 
                include 'pages/asesor/pilih_anak.php';	break;
           
            case 'Pilih-Asesmen' :				
                if(!file_exists ('pages/asesor/pilih_asesmen.php')) die ($nopage); 
                include 'pages/asesor/pilih_asesmen.php';	break;

            //::ETC END

            default:
                echo "<meta http-equiv='refresh' content='0; url=page_404.html'>";
        }
    }else{
        include 'pages/admin/touchdown.php';
    }
?>