<?php
    function videoClean($pdo) {
        if(isset($_POST['videoSil'])) {
            if(isset($_POST['videoClean'])) {
                $clean_id = $_POST['videoClean'];
                $id = count($clean_id);

                if(count($id) > 0) {
                    foreach($clean_id as $VID) {
                        $videoSQL = $pdo->prepare("DELETE FROM video WHERE id = '$VID'");
                        $videoSQL->execute();
                    }
                    echo "<div class='DbOk'><i class='fa fa-check-circle'></i><br/>Tebrikler, <b>Videolar</b> başarıyla silinmiştir !</div>";
                    header('Refresh:2; url=video-clean.php');
                }
            } else {
                echo "<div class='DbOk'><i class='fa fa-frown-o'></i><br/>Lütfen <b>en az 1 video</b> seçiniz !</div>";
                header('Refresh:2; url=video-clean.php');
            }
        } else {
            header("Refresh:0; url=video-clean.php");
        }
    }
?>