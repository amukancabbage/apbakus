<div class="navbar nav_title" style="border: 0;">
    <a href="main.php?page=Home" class="site_title"><i class="fa fa-umbrella"></i> <span>APBAKUS</span></a>    
</div>

<div class="clearfix"></div>

<!-- menu profile quick info -->
<div class="profile clearfix">
    <div class="profile_pic">
    <img src="<?php echo $image_profil;?>" alt="..." class="img-circle profile_img">
    </div>
    <div class="profile_info">
    <span>Welcome,</span>
    <h2><?php echo $nama_lengkap?> <?php //echo " ".$_SESSION['UNCLE_avatar']?></h2>
    </div>
</div>
<!-- /menu profile quick info -->

<br />

<!-- sidebar menu -->
<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
    <div class="menu_section">
    <h3>General</h3>
    <ul class="nav side-menu">
        <li><a href="?page=Home"><i class="fa fa-home"></i> Home </a>
        <li><a><i class="fa fa-edit"></i> Data Master <span class="fa fa-chevron-down"></span></a>
        <ul class="nav child_menu">
            <li><a href="?page=Pengguna-Data">Pengguna</a></li>
            <li><a href="?page=Kategori-Data">Kategori</a></li>
            <li><a href="?page=Pilih-Kategori&Kode=View-Instrumen">Instrumen</a></li>
            <li><a href="?page=Kabupaten-Data">Kabupaten/Kota</a></li>
            <li><a href="?page=Kecamatan-Data">Kecamatan</a></li>
            <li><a href="?page=Desa-Data">Kelurahan/Desa</a></li>
        </ul>
        </li>
        <li><a><i class="fa fa-user"></i>User Asesor <span class="fa fa-chevron-down"></span></a>
        <ul class="nav child_menu">
            <li><a href="?page=Asesmen-Anak">Asesmen Anak</a></li>
        </ul>
        </li>
        <li><a><i class="fa fa-user"></i>User Bidang <span class="fa fa-chevron-down"></span></a>
        <ul class="nav child_menu">
            <li><a>Master<span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    
                    <li><a href="?page=Poktan-Data">Kelompok Tani</a></li>
                    <li><a href="?page=Komoditas-Data">Komoditas</a></li>
                    <li class="sub_menu"><a href="?page=Peternak-Data">Peternak</a></li>
                </ul>
            </li>
            <li><a>Proses<span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li class="sub_menu"><a href="?page=Tahunkomoditas-Data">Tahun Komoditas</a></li>
                    <li><a href="?page=Poktan-Data">Kelompok Tani</a></li>
                </ul>
            </li>
        </ul>
        </li>

        <li><a><i class="fa fa-users"></i>User Balai <span class="fa fa-chevron-down"></span></a>
        <ul class="nav child_menu">
            <li><a href="?page=Penyuluh-Data">Penyuluh</a></li>
            <li><a href="?page=Pilih-Desa-Bulan">Upaya Khusus</a></li>
        </ul>
        </li>
        <li><a href="?page=Logout"><i class="fa fa-sign-out"></i> Log Out </a>
    </ul>
    </div>

</div>
<!-- /sidebar menu -->

<!-- /menu footer buttons -->
<div class="sidebar-footer hidden-small">
    <a data-toggle="tooltip" data-placement="top" title="Settings">
        <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
    </a>
    <a data-toggle="tooltip" data-placement="top" title="FullScreen">
        <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
    </a>
    <a data-toggle="tooltip" data-placement="top" title="Lock">
        <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
    </a>
    <a data-toggle="tooltip" data-placement="top" title="Logout" href="?page=Logout">
        <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
    </a>
</div>
        <!-- /menu footer buttons -->