<?php
    function pictureClean($pdo) {
        if(isset($_POST['pictureSil'])) {
            if(isset($_POST['pictureClean'])) {
                $clean_id = $_POST['pictureClean'];
                $id = count($clean_id);

                if(count($id) > 0) {
                    foreach($clean_id as $PID) {
                        $pictureSQL = $pdo->prepare("DELETE FROM picture WHERE id = '$PID'");
                        $pictureSQL->execute();
                    }
                    echo "<div class='DbOk'><i class='fa fa-check-circle'></i><br/>Tebrikler, <b>Resimler</b> başarıyla silinmiştir !</div>";
                    header('Refresh:2; url=picture-clean.php');
                }
            } else {
                echo "<div class='DbOk'><i class='fa fa-frown-o'></i><br/>Lütfen <b>en az 1 resim</b> seçiniz !</div>";
                header('Refresh:2; url=picture-clean.php');
            }
        } else {
            header("Refresh:0; url=picture-clean.php");
        }
    }
?>