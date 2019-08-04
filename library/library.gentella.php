<?php
  function showMessageRed($isiPesan){
  if(count($isiPesan)>1){
    ?><script>
    function notif(){
      <?php
      $i=0;
      while($i<count($isiPesan)){
        echo "{new PNotify({
          title: 'KESALAHAN',
          text: '$isiPesan[$i]',
          type: 'error',
          styling: 'bootstrap3'
        });}";
        $i++;
      }?>
      }</script>
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

  function get_http_response_code($url) {
    $headers = get_headers($url);
    return substr($headers[0], 9, 3);
  }
  ?>
