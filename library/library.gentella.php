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
?>