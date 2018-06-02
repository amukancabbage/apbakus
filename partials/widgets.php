<?php
    $query = "select * from pengguna";
    $arrCriteria = array();
    $jumlah_pengguna = getDataNumber2($koneksidb,$query,$arrCriteria);
    $query = "select * from anak";
    $arrCriteria = array();
    $jumlah_anak = getDataNumber2($koneksidb,$query,$arrCriteria);
    $query = "select * from asesmen";
    $arrCriteria = array();
    $jumlah_asesmen = getDataNumber2($koneksidb,$query,$arrCriteria);
    $query = "select * from kategori";
    $arrCriteria = array();
    $jumlah_kategori = getDataNumber2($koneksidb,$query,$arrCriteria);
    $query = "select * from instrumen";
    $arrCriteria = array();
    $jumlah_instrumen = getDataNumber2($koneksidb,$query,$arrCriteria);
    $query = "select * from pengguna where level=2";
    $arrCriteria = array();
    $jumlah_asesor = getDataNumber2($koneksidb,$query,$arrCriteria);
?>

<div class="row tile_count">
    <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
        <span class="count_top"><i class="fa fa-user"></i> Jumlah Pengguna</span>
        <div class="count"><?php echo $jumlah_pengguna ?></div>
        <!-- <span class="count_bottom"><i class="green">4% </i> From last Week</span> -->
    </div>
    <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
        <span class="count_top"><i class="fa fa-user"></i> Total Kategori Instrumen</span>
        <div class="count"><?php echo $jumlah_kategori ?></div>
        <!-- <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>3% </i> From last Week</span> -->
    </div>
    <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
        <span class="count_top"><i class="fa fa-user"></i> Total Butir Instrumen</span>
        <div class="count green"><?php echo $jumlah_instrumen ?></div>
        <!-- <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>34% </i> From last Week</span> -->
    </div>
    <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
        <span class="count_top"><i class="fa fa-user"></i> Total Asesor</span>
        <div class="count"><?php echo $jumlah_asesor ?></div>
        <!-- <span class="count_bottom"><i class="red"><i class="fa fa-sort-desc"></i>12% </i> From last Week</span> -->
    </div>
    <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
        <span class="count_top"><i class="fa fa-user"></i> Total Data Anak</span>
        <div class="count"><?php echo $jumlah_anak ?></div>
        <!-- <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>34% </i> From last Week</span> -->
    </div>
    <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
        <span class="count_top"><i class="fa fa-user"></i> Total Data Asesmen</span>
        <div class="count"><?php echo $jumlah_asesmen ?></div>
        <!-- <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>34% </i> From last Week</span> -->
    </div>
</div>