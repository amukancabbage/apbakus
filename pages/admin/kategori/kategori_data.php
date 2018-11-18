<script>
if ( window.history.replaceState ) {
  window.history.replaceState( null, null, window.location.href );
}
</script>
<?php
require "library/sesadmin.php";
// echo "<script>
//         function notif(){new PNotify({
//           title: 'INFORMASI',
//           text: 'Data berhasil dihapus',
//           type: 'success',
//           styling: 'bootstrap3'
//         });}
//       </script>";
?>
<div class="page-title">

</div>

<div class="clearfix"></div>

<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="modal fade bs-example-modal-lg"  id = "myModal" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
              </button>
              <h4 class="modal-title" id="myModalLabel">Tambah data</h4>

            </div>
            <div class="modal-body">
              <?php include "kategori_baru.php" ;?>
            </div>
        </div>
      </div>
    </div>

    <?php
    $tableName = "kategori";
    $formName = "Kategori";
    $title = "Kategori Instrumen";
    $jmlField = "4";

    $isian[0]="Id";
    $isian[1]="Created At";
    $isian[2]="Updated At";
    $isian[3]="Status";
    $isian[4]="Kategori Instrumen";

    $json=file_get_contents("http://localhost/apbakus/api/kategori/read.php");
    $data =  json_decode($json);
    $nama1 = str_replace("_","-",$formName);
    table_BEGIN($title,4,$jmlField+1,$isian);
    //$mySql = "SELECT $tableName.* FROM ".$tableName;
    $nomor  = 1;
    foreach ($data->records as $idx => $records) {
      $Kode = $records->id;
      echo("<tr>");
      echo("<td align=\"center\">".$nomor++."</td>");
      $i=4;
      echo "<td>$records->kategori_instrumen</td>";
      echo("</td>");
      echo("<td class=\"cc\" align=\"center\"><a href=\"?page=".$nama1."-Ubah&Kode=".encD($Kode)." \" target=\"_self\"><span class=\"btn btn-primary\"><i class=\"fa fa-edit\"></i> Ubah</span></a>");
      echo("<a href=\"?page=".$formName."-Hapus&Kode=".encD($Kode)."\" onclick=\"return confirm('Anda Yakin menghapus Data ? ')\"><span class=\"btn btn-danger\"><i class=\"fa fa-trash\"></i> Hapus</span></a></td>");
      echo("</tr>");
    }
    tableGentellaEND();


    ?>

  </div>
</div>
</div>
