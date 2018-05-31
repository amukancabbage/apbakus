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
    
            
            case 'Kabupaten-Baru' :				
                if(!file_exists ('pages/admin/kabkot_baru.php')) die ($nopage); 
                include 'pages/admin/kabkot_baru.php';	break;	
            
            case 'Kabupaten-Data' :				
                if(!file_exists ('pages/admin/kabkot_data.php')) die ($nopage); 
                include 'pages/admin/kabkot_data.php';	break;	
        
            case 'Kabupaten-Ubah' :				
                if(!file_exists ('pages/admin/kabkot_ubah.php')) die ($nopage); 
                include 'pages/admin/kabkot_ubah.php';	break;	
    
            case 'Kecamatan-Baru' :				
                if(!file_exists ('pages/admin/kecamatan_baru.php')) die ($nopage); 
                include 'pages/admin/kecamatan_baru.php';	break;	
            
            case 'Kecamatan-Data' :				
                if(!file_exists ('pages/admin/kecamatan_data.php')) die ($nopage); 
                include 'pages/admin/kecamatan_data.php';	break;	
        
            case 'Kecamatan-Ubah' :				
                if(!file_exists ('pages/admin/kecamatan_ubah.php')) die ($nopage); 
                include 'pages/admin/kecamatan_ubah.php';	break;	
    
            case 'Desa-Baru' :				
                if(!file_exists ('pages/admin/desa_baru.php')) die ($nopage); 
                include 'pages/admin/desa_baru.php';	break;	
            
            case 'Desa-Data' :				
                if(!file_exists ('pages/admin/desa_data.php')) die ($nopage); 
                include 'pages/admin/desa_data.php';	break;	
        
            case 'Desa-Ubah' :				
                if(!file_exists ('pages/admin/desa_ubah.php')) die ($nopage); 
                include 'pages/admin/desa_ubah.php';	break;	
            
            //MASTER USER BIDANG
            case 'Peternak-Baru' :				
                if(!file_exists ('pages/userbidang/peternak_baru.php')) die ($nopage); 
                include 'pages/userbidang/peternak_baru.php';	break;	
            
            case 'Peternak-Data' :				
                if(!file_exists ('pages/userbidang/peternak_data.php')) die ($nopage); 
                include 'pages/userbidang/peternak_data.php';	break;	
        
            case 'Peternak-Ubah' :				
                if(!file_exists ('pages/userbidang/peternak_ubah.php')) die ($nopage); 
                include 'pages/userbidang/peternak_ubah.php';	break;	
            
            case 'Poktan-Baru' :				
                if(!file_exists ('pages/userbidang/poktan_baru.php')) die ($nopage); 
                include 'pages/userbidang/poktan_baru.php';	break;	
            
            case 'Poktan-Data' :				
                if(!file_exists ('pages/userbidang/poktan_data.php')) die ($nopage); 
                include 'pages/userbidang/poktan_data.php';	break;	
        
            case 'Poktan-Ubah' :				
                if(!file_exists ('pages/userbidang/poktan_ubah.php')) die ($nopage); 
                include 'pages/userbidang/poktan_ubah.php';	break;	
    
            case 'Komoditas-Baru' :				
                if(!file_exists ('pages/userbidang/komoditas_baru.php')) die ($nopage); 
                include 'pages/userbidang/komoditas_baru.php';	break;	
            
            case 'Komoditas-Data' :				
                if(!file_exists ('pages/userbidang/komoditas_data.php')) die ($nopage); 
                include 'pages/userbidang/komoditas_data.php';	break;	
        
            case 'Komoditas-Ubah' :				
                if(!file_exists ('pages/userbidang/komoditas_ubah.php')) die ($nopage); 
                include 'pages/userbidang/komoditas_ubah.php';	break;	
    
            case 'Penyuluh-Baru' :				
                if(!file_exists ('pages/userbalai/penyuluh_baru.php')) die ($nopage); 
                include 'pages/userbalai/penyuluh_baru.php';	break;	
            
            case 'Penyuluh-Data' :				
                if(!file_exists ('pages/userbalai/penyuluh_data.php')) die ($nopage); 
                include 'pages/userbalai/penyuluh_data.php';	break;	
        
            case 'Penyuluh-Ubah' :				
                if(!file_exists ('pages/userbalai/penyuluh_ubah.php')) die ($nopage); 
                include 'pages/userbalai/penyuluh_ubah.php';	break;	
    
          
            //::MASTER DATA END

            //::PROSES DATA BEGIN

            case 'Tahunkomoditas-Baru' :				
                if(!file_exists ('pages/userbidang/tahunkomoditas_baru.php')) die ($nopage); 
                include 'pages/userbidang/tahunkomoditas_baru.php';	break;	
            
            case 'Tahunkomoditas-Data' :				
                if(!file_exists ('pages/userbidang/tahunkomoditas_data.php')) die ($nopage); 
                include 'pages/userbidang/tahunkomoditas_data.php';	break;	
        
            case 'Tahunkomoditas-Ubah' :				
                if(!file_exists ('pages/userbidang/tahunkomoditas_ubah.php')) die ($nopage); 
                include 'pages/userbidang/tahunkomoditas_ubah.php';	break;


            case 'Upsus-Data' :				
                if(!file_exists ('pages/userbalai/upsus_data.php')) die ($nopage); 
                include 'pages/userbalai/upsus_data.php';	break;	

            case 'Asesmen-Anak' :				
                if(!file_exists ('pages/asesor/input_data_anak.php')) die ($nopage); 
                include 'pages/asesor/input_data_anak.php';	break;	
            
            case 'Asesmen-Instrumen' :				
                if(!file_exists ('pages/asesor/input_data_asesmen.php')) die ($nopage); 
                include 'pages/asesor/input_data_asesmen.php';	break;	
            //::PROSES DATA END

            //::ETC BEGIN
            case 'Pilih-Kategori' :				
                if(!file_exists ('pages/admin/pilih_kategori.php')) die ($nopage); 
                include 'pages/admin/pilih_kategori.php';	break;

            //::ETC END

            default:
                echo "<meta http-equiv='refresh' content='0; url=page_404.html'>";
        }
    }else{
        include 'pages/admin/touchdown.php';
    }
?>