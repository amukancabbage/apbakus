<?php
function showMessageRed($isiPesan){
  if(count($isiPesan)>1){
    ?><script>
    function notif(){
      <?php
      $noPesan=0;

      foreach ($isiPesan as $indeks=>$pesan_tampil) {
        $noPesan++; ?>

        new PNotify({
          title: 'KESALAHAN',
          text: '<?php $pesan_tampil ?>',
          type: 'error',
          styling: 'bootstrap3'
        });
        <?php } ?>
      }
      </script>";
      <?php
    }else{
      echo "<script>
      function notif(){new PNotify({
        title: 'KESALAHAN',
        text: '$isiPesan[0]',
        type: 'error',
        styling: 'bootstrap3'
      });}
      </script>";
    }
  }
  function showMessageGreen($isiPesan){
    echo "<script>
    function notif(){new PNotify({
      title: 'INFORMASI',
      text: '$isiPesan',
      type: 'success',
      styling: 'bootstrap3'
    });}
    </script>";
  }

  function showMessageGreen2($isi_pesan){
    $pesan = getStringArray($isi_pesan)
    ?>
    <div class="clearfix">

    </div>
    <div class="alert alert-success alert-dismissible fade in" role="alert">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
      </button>
      <strong>Sukses!</strong> <?php echo $pesan; ?>
    </div>
    <?php
  }
  function showMessageRed2($isi_pesan){
    $pesan = getStringArray($isi_pesan)
    ?>
    <div class="clearfix">

    </div>
    <div class="alert alert-error alert-dismissible fade in" role="alert">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
      </button>
      <strong>Gagal</strong> <?php echo $pesan; ?>
    </div>
    <?php
  }
  ?>
